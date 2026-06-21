<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\TrainingPlan;
use App\Models\Player; // استدعاء موديل اللاعبين
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrainingPlanController extends Controller
{
    public function index()
    {
        $coachId = Auth::guard('employee')->id();

        $trainingPlans = TrainingPlan::whereNull('player_id')
            ->where('coach_id', $coachId)
            ->latest()
            ->get();

        return view('Employee.TrainingBank.index', compact('trainingPlans'));
    }

    // حفظ خطة تدريبية جديدة وتعميمها فوراً على اللاعبين لايف
    public function store(Request $request)
    {
        $request->validate([
            'level'        => 'required|string',
            'plan_details' => 'required|string',
        ]);

        $coachId = Auth::guard('employee')->id();

        // 1. حفظ الخطة بالبنك العام (player_id = null)
        TrainingPlan::create([
            'coach_id'     => $coachId,
            'player_id'    => null,
            'level'        => $request->level,
            'plan_details' => $request->plan_details,
            'start_date'   => now(),
            'end_date'     => now()->addMonth(),
        ]);

        // 2. الأتمتة الحية: جلب اللاعبين الحاليين المربوطين بنفس المستوى
        $activePlayers = Player::where('coach_id', $coachId)
            ->where('level', $request->level)
            ->get();

        // 3. نسخ وإسقاط جدول التمارين في حساباتهم لايف
        foreach ($activePlayers as $player) {
            TrainingPlan::create([
                'coach_id'     => $coachId,
                'player_id'    => $player->id, // تسند للاعب مباشرة
                'level'        => $request->level,
                'plan_details' => $request->plan_details,
                'start_date'   => now(),
                'end_date'     => now()->addMonth(),
            ]);
        }

        return redirect()->route('employee.training.bank')->with('success', 'تم حفظ الخطة التدريبية وتحديث جداول لاعبي مستوى ' . $request->level . ' فوراً.');
    }

    public function destroy($id)
    {
        $plan = TrainingPlan::whereNull('player_id')
            ->where('coach_id', Auth::guard('employee')->id())
            ->findOrFail($id);

        TrainingPlan::whereNotNull('player_id')
            ->where('coach_id', $plan->coach_id)
            ->where('level', $plan->level)
            ->where('plan_details', $plan->plan_details)
            ->delete();

        $plan->delete();

        return redirect()->route('employee.training.bank')->with('success', 'تم حذف الخطة من البنك ومن جداول اللاعبين.');
    }
}
