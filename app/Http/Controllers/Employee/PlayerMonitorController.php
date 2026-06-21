<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Player;
use App\Models\TrainingPlan;
use App\Models\DietPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlayerMonitorController extends Controller
{
    // عرض قائمة اللاعبين التابعين للمدرب الحالي
    public function index()
    {
        $players = Player::where('coach_id', Auth::guard('employee')->id())
            ->with('subscription')
            ->get();

        return view('Employee.monitoring.index', compact('players'));
    }

    // دالة الأتمتة الفورية: تغيير مستوى اللاعب وسحب كل الخطط التدريبية والغذائية المطابقة من البنوك
    public function assignLevel(Request $request, $playerId)
    {
        $request->validate([
            'level' => 'required|string',
        ]);

        $player = Player::findOrFail($playerId);
        $coachId = Auth::guard('employee')->id();

        // تحديث حقل المستوى للاعب الحالي
        $player->update([
            'level' => $request->level,
        ]);

        // البحث المباشر في بنك التدريب والتغذية عن كافة الخطط المخصصة لهذا المستوى (حيث player_id هو null)
        $templateTrainingPlans = TrainingPlan::where('level', $request->level)->whereNull('player_id')->get();
        $templateDietPlans = DietPlan::where('level', $request->level)->whereNull('player_id')->get();

        // نسخ حزمة التمارين وإسقاطها للاعب
        foreach ($templateTrainingPlans as $templatePlan) {
            TrainingPlan::create([
                'coach_id'     => $coachId,
                'player_id'    => $player->id,
                'level'        => $request->level,
                'plan_details' => $templatePlan->plan_details,
                'start_date'   => now(),
                'end_date'     => now()->addMonths(1), // صلاحية افتراضية شهر
            ]);
        }

        // نسخ حزمة الوجبات الغذائية المخصصة للمستوى وإسقاطها للاعب ببياناتها المستقلة
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

    // عرض التفاصيل الشاملة والجدولين المستقلين للاعب
    public function show($id)
    {
        $player = Player::with(['subscription', 'trainingPlans' => function ($query) {
            $query->latest();
        }, 'dietPlans' => function ($query) {
            $query->latest();
        }])->findOrFail($id);

        return view('Employee.monitoring.show', compact('player'));
    }
}
