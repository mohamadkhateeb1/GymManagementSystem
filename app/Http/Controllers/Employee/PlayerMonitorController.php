<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Player;
use App\Models\TrainingPlan;
use App\Models\DietPlan;
use App\Models\BodyProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PlayerMonitorController extends Controller
{

    private function findMyPlayer($id, array $relations = []): Player
    {
        return Player::where('coach_id', Auth::guard('employee')->id())
            ->with($relations)
            ->findOrFail($id);
    }


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

        $players = Player::where('coach_id', $coachId)
            ->with('subscription')
            ->select('players.*')

            ->selectSub(function ($query) {
                $query->from('body_progress')
                    ->whereColumn('body_progress.player_id', 'players.id')
                    ->latest()
                    ->limit(1)
                    ->select('weight');
            }, 'progress_weight')

            ->selectSub(function ($query) {
                $query->from('player_ratings')
                    ->whereColumn('player_ratings.player_id', 'players.id')
                    ->selectRaw('AVG(rating)');
            }, 'average_rating')

            ->get()

            ->map(function ($player) {
                $player->latest_weight = $player->progress_weight ?? $player->weight;
                return $player;
            });

        return view('Employee.monitoring.index', compact('players'));
    }

    public function assignLevel(Request $request, $playerId)
    {
        $request->validate([
            'level' => 'required|string',
        ]);

        $player = $this->findMyPlayer($playerId, ['subscription']);
        $coachId = Auth::guard('employee')->id();

        if (!$player->hasActiveSubscription()) {
            return redirect()->back()->with('error', 'لا يمكن جدولة أو أتمتة الخطط للاعب اشتراكه مجمد أو منتهي.');
        }

        $player->update([
            'level' => $request->level,
        ]);

        $templateTrainingPlans = TrainingPlan::where('level', $request->level)->whereNull('player_id')->with('exercises')->get();
        $templateDietPlans = DietPlan::where('level', $request->level)->whereNull('player_id')->get();

        foreach ($templateTrainingPlans as $templatePlan) {
            if ($templatePlan->exercises->isEmpty()) {
                continue;
            }

            TrainingPlan::whereNotNull('player_id')
                ->where('player_id', $player->id)
                ->where('coach_id', $coachId)
                ->where('level', $request->level)
                ->where('title', $templatePlan->title)
                ->delete();

            $playerPlan = TrainingPlan::create([
                'coach_id'     => $coachId,
                'player_id'    => $player->id,
                'title'        => $templatePlan->title,
                'level'        => $request->level,
                'start_date'   => now(),
                'end_date'     => now()->addMonths(1),
            ]);

            $this->copyExercises($templatePlan, $playerPlan);
        }

        foreach ($templateDietPlans as $templateDiet) {
            DietPlan::create([
                'coach_id'     => $coachId,
                'player_id'    => $player->id,
                'level'        => $request->level,
                'meal_name'    => $templateDiet->meal_name,
                'calories'     => $templateDiet->calories,
                'image_path'   => $templateDiet->image_path,
                'plan_details' => $templateDiet->plan_details,
                'start_date'   => now(),
                'end_date'     => now()->addMonths(1),
            ]);
        }

        return redirect()->back()->with('success', 'تم تحديث مستوى اللاعب وتنزيل حزمة الخطط التدريبية والغذائية للمستوى تلقائياً.');
    }

    public function show($id)
    {
        $player = $this->findMyPlayer($id, ['subscription', 'trainingPlans' => function ($query) {
            $query->latest();
        }, 'dietPlans' => function ($query) {
            $query->latest();
        }, 'bodyProgress' => function ($query) {
            $query->latest();
        }]);

        $ratings = DB::table('player_ratings')
            ->where('player_id', $player->id)
            ->latest()
            ->get();

        return view('Employee.monitoring.show', compact('player', 'ratings'));
    }

    public function storeCustomTraining(Request $request, $playerId)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $player = $this->findMyPlayer($playerId, ['subscription']);

        if (!$player->hasActiveSubscription()) {
            return redirect()->back()->with('error', 'لا يمكن إضافة خطة مخصصة للاعب اشتراكه مجمد أو منتهي.');
        }

        TrainingPlan::create([
            'coach_id'     => Auth::guard('employee')->id(),
            'player_id'    => $player->id,
            'title'        => $request->title,
            'level'        => $player->level,
            'start_date'   => now(),
            'end_date'     => now()->addMonth(),
        ]);

        return redirect()->back()->with('success', 'تمت إضافة الخطة التدريبية الخاصة باللاعب بنجاح.');
    }

    public function storeCustomDiet(Request $request, $playerId)
    {
        $request->validate([
            'meal_name'    => 'required|string|max:255',
            'calories'     => 'required|numeric',
            'plan_details' => 'required|string',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $player = $this->findMyPlayer($playerId, ['subscription']);

        if (!$player->hasActiveSubscription()) {
            return redirect()->back()->with('error', 'لا يمكن إضافة وجبة مخصصة للاعب اشتراكه مجمد أو منتهي.');
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('meals', 'public');
        }

        DietPlan::create([
            'coach_id'     => Auth::guard('employee')->id(),
            'player_id'    => $player->id,
            'level'        => $player->level,
            'meal_name'    => $request->meal_name,
            'calories'     => $request->calories,
            'image_path'   => $imagePath,
            'plan_details' => $request->plan_details,
            'start_date'   => now(),
            'end_date'     => now()->addMonth(),
        ]);

        return redirect()->back()->with('success', 'تمت إضافة الوجبة الغذائية الخاصة باللاعب بنجاح.');
    }

    public function storeRating(Request $request, $playerId)
    {
        $request->validate([
            'rating'   => 'required|integer|min:1|max:5',
            'feedback' => 'required|string',
        ]);

        $player = $this->findMyPlayer($playerId, ['subscription']);

        if (!$player->hasActiveSubscription()) {
            return redirect()->back()->with('error', 'لا يمكن تقييم لاعب اشتراكه مجمد أو غير فعال.');
        }

        DB::table('player_ratings')->insert([
            'coach_id'   => Auth::guard('employee')->id(),
            'player_id'  => $player->id,
            'rating'     => $request->rating,
            'feedback'   => $request->feedback,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'تم تسجيل تقييم اللاعب وإرسال الملاحظات بنجاح.');
    }

    public function storeCustomProgress(Request $request, $playerId)
    {
        $request->validate([
            'weight'       => 'required|numeric|min:10|max:300',
            'body_fat_pct' => 'nullable|numeric|min:1|max:90',
            'muscle_mass'  => 'nullable|numeric|min:5|max:200',
        ]);

        $player = $this->findMyPlayer($playerId, ['subscription']);

        if (!$player->hasActiveSubscription()) {
            return redirect()->back()->with('error', 'لا يمكن إضافة قياسات بدنية للاعب اشتراكه مجمد أو منتهي.');
        }

        BodyProgress::create([
            'player_id'    => $player->id,
            'weight'       => $request->weight,
            'body_fat_pct' => $request->body_fat_pct,
            'muscle_mass'  => $request->muscle_mass,
            'recorded_by'  => 'coach',
        ]);

        return redirect()->back()->with('success', 'تم تسجيل القياسات البدنية الحالية للاعب بنجاح.');
    }
}
