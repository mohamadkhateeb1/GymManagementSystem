<?php
//ادارة البنك
namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\TrainingPlan;
use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrainingPlanController extends Controller 
// هاد الكلاس مسؤول عن إدارة خطط التدريب داخل بنك الخطط الخاصة بالمدرب. يحتوي على وظائف لعرض، إضافة، تعديل، وحذف الخطط، بالإضافة إلى توزيع الخطط على لاعبي المستوى المناسب.
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

        return view('Employee.TrainingBank.Plans.show', compact('plan'));
    }

    public function store(Request $request)
    {
       $request->validate([
    'name' => 'required|string|max:255',
    'sets' => 'required|numeric',
    'reps' => 'required|numeric',
    'rest_time' => 'required|string|max:50',
    'day_of_week' => 'required|integer|min:1|max:7',
    'order' => 'required|integer|min:0',
    'instructions' => 'required|string',
    'image' => 'required|image|max:5120',
    'video_url' => 'required|string',
], [
    // اسم التمرين
    'name.required' => 'حقل اسم التمرين مطلوب.',
    'name.string' => 'حقل اسم التمرين يجب أن يكون نصًا.',
    'name.max' => 'حقل اسم التمرين يجب أن لا يتجاوز 255 حرفًا.',

    // المجموعات
    'sets.required' => 'حقل عدد المجموعات مطلوب.',
    'sets.numeric' => 'حقل عدد المجموعات يجب أن يكون رقمًا.',

    // التكرارات
    'reps.required' => 'حقل عدد التكرارات مطلوب.',
    'reps.numeric' => 'حقل عدد التكرارات يجب أن يكون رقمًا.',

    // وقت الراحة
    'rest_time.string' => 'حقل وقت الراحة يجب أن يكون نصًا.',
    'rest_time.max' => 'حقل وقت الراحة يجب أن لا يتجاوز 50 حرفًا.',

    // يوم الأسبوع
    'day_of_week.required' => 'يجب اختيار يوم الأسبوع.',
    'day_of_week.integer' => 'حقل يوم الأسبوع يجب أن يكون رقمًا.',
    'day_of_week.min' => 'يجب أن يكون يوم الأسبوع على الأقل 1 (الأحد).',
    'day_of_week.max' => 'يجب أن يكون يوم الأسبوع على الأكثر 7 (السبت).',

    // ترتيب التمرين
    'order.required' => 'حقل ترتيب التمرين مطلوب.',
    'order.integer' => 'حقل ترتيب التمرين يجب أن يكون رقمًا.',
    'order.min' => 'ترتيب التمرين يجب أن يكون على الأقل 0.',

    // التعليمات
    'instructions.required' => 'حقل التعليمات مطلوب.',
    'instructions.string' => 'حقل التعليمات يجب أن يكون نصًا.',

    // الصورة
    'image.required' => 'صورة التمرين مطلوبة.',
    'image.image' => 'الملف المرفق يجب أن يكون صورة.',
    'image.max' => 'حجم صورة التمرين يجب ألا يتجاوز 5 ميجابايت.',

    // رابط الفيديو
    'video_url.required' => 'رابط الفيديو مطلوب.',
    'video_url.string' => 'رابط الفيديو يجب أن يكون نصًا.',
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

        return redirect()->route('employee.training.exercises.index')->with('success', 'تم حفظ الخطة في البنك. أضف تمارينها ثم وزّعها على لاعبي مستوى ' . $request->level . '.');
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
