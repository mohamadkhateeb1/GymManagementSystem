<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\TrainingPlan;
use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrainingPlanController extends Controller
{

    private function copyExercises(TrainingPlan $source, TrainingPlan $target): void
    {
        foreach ($source->exercises as $exercise) {
            $target->exercises()->create($exercise->only([
                'name',
                'sets',
                'reps',
                'rest_time',
                'day_of_week',
                'order',
                'instructions',
                'image_path',
                'video_url',
            ]));
        }
    }

    public function index()
    {
        $coachId = Auth::guard('employee')->id();

        $plans = TrainingPlan::whereNull('player_id')
            ->where('coach_id', $coachId)
            ->withCount('exercises')
            ->latest()
            ->get();

        return view('Employee.TrainingBank.index', compact('plans'));
    }

    public function show($id)
    {
        $coachId = Auth::guard('employee')->id();

        $plan = TrainingPlan::where('coach_id', $coachId)->findOrFail($id);

        return view('Employee.TrainingBank.show', compact('plan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'level' => 'required|string',
        ]);

        $coachId = Auth::guard('employee')->id();

        TrainingPlan::create([
            'coach_id'   => $coachId,
            'player_id'  => null,
            'is_custom'  => false, // خطة بنك عامة، ليست حاوية تمارين خاصة
            'title'      => $request->title,
            'level'      => $request->level,
            'start_date' => now(),
            'end_date'   => now()->addMonth(),
        ]);

        return redirect()->route('employee.training.bank')->with('success', 'تم حفظ الخطة في البنك. أضف تمارينها ثم وزّعها على لاعبي مستوى ' . $request->level . '.');
    }

    public function distribute($id)
    {
        $coachId = Auth::guard('employee')->id();

        $plan = TrainingPlan::whereNull('player_id')
            ->where('coach_id', $coachId)
            ->with('exercises')
            ->findOrFail($id);

        if ($plan->exercises->isEmpty()) {
            return redirect()->back()->with('error', 'لا يمكن توزيع خطة فارغة، أضف تمارين الخطة أولاً ثم أعد المحاولة.');
        }

        $players = Player::where('coach_id', $coachId)
            ->where('level', $plan->level)
            ->get();

        if ($players->isEmpty()) {
            return redirect()->back()->with('error', 'لا يوجد لاعبون مرتبطون بمستوى ' . $plan->level . ' لتوزيع الخطة عليهم.');
        }

        foreach ($players as $player) {
            // 🛡️ where('is_custom', false) يمنع أي احتمال (نادر) بلمس حاوية
            // التمارين الخاصة للاعب لو تطابق اسمها صدفةً مع اسم خطة البنك
            TrainingPlan::whereNotNull('player_id')
                ->where('player_id', $player->id)
                ->where('coach_id', $coachId)
                ->where('level', $plan->level)
                ->where('is_custom', false)
                ->where('title', $plan->title)
                ->delete();

            $playerPlan = TrainingPlan::create([
                'coach_id'   => $coachId,
                'player_id'  => $player->id,
                'is_custom'  => false,
                'title'      => $plan->title,
                'level'      => $plan->level,
                'start_date' => now(),
                'end_date'   => now()->addMonth(),
            ]);

            $this->copyExercises($plan, $playerPlan);
        }

        return redirect()->route('employee.training.bank')->with('success', 'تم توزيع الخطة مع ' . $plan->exercises->count() . ' تمرين على ' . $players->count() . ' لاعب من مستوى ' . $plan->level . '.');
    }

    public function destroy($id)
    {
        $plan = TrainingPlan::whereNull('player_id')
            ->where('coach_id', Auth::guard('employee')->id())
            ->findOrFail($id);

        // 🛡️ نفس الحماية: لا نلمس حاوية التمارين الخاصة عند حذف خطة بنك
        TrainingPlan::whereNotNull('player_id')
            ->where('coach_id', $plan->coach_id)
            ->where('level', $plan->level)
            ->where('is_custom', false)
            ->where('title', $plan->title)
            ->delete();

        $plan->delete();

        return redirect()->route('employee.training.bank')->with('success', 'تم حذف الخطة من البنك ومن جداول اللاعبين.');
    }
}
