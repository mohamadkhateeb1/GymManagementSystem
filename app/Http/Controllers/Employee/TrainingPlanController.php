<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\TrainingPlan;
use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrainingPlanController extends Controller
{
    public function index()
    {
        $coachId = Auth::guard('employee')->id();

        // جلب الخطط العامة المخصصة للبنك (player_id = null)
        $plans = TrainingPlan::whereNull('player_id')
            ->where('coach_id', $coachId)
            ->latest()
            ->get();

        return view('Employee.TrainingBank.index', compact('plans'));
    }

    public function show($id)
    {
        $coachId = Auth::guard('employee')->id();

        // جلب الخطة المحددة لتفاصيلها
        $plan = TrainingPlan::where('coach_id', $coachId)->findOrFail($id);

        return view('Employee.TrainingBank.show', compact('plan'));
    }

    public function store(Request $request)
    {
        // 🎯 التحقق فقط من عنوان الخطة والمستوى المستهدف
        $request->validate([
            'title' => 'required|string|max:255',
            'level' => 'required|string',
        ]);

        $coachId = Auth::guard('employee')->id();

        // 1. حفظ الخطة في البنك العام
        TrainingPlan::create([
            'coach_id'   => $coachId,
            'player_id'  => null,
            'title'      => $request->title,
            'level'      => $request->level,
            'start_date' => now(),
            'end_date'   => now()->addMonth(),
        ]);

        // 2. إسقاط الخطة أوتوماتيكياً في حسابات لاعبي نفس المستوى
        $activePlayers = Player::where('coach_id', $coachId)
            ->where('level', $request->level)
            ->get();

        foreach ($activePlayers as $player) {
            TrainingPlan::create([
                'coach_id'   => $coachId,
                'player_id'  => $player->id,
                'title'      => $request->title,
                'level'      => $request->level,
                'start_date' => now(),
                'end_date'   => now()->addMonth(),
            ]);
        }

        return redirect()->route('employee.training.bank')->with('success', 'تم حفظ الخطة وتحديث جداول لاعبي مستوى ' . $request->level . ' فوراً.');
    }

    public function destroy($id)
    {
        $plan = TrainingPlan::whereNull('player_id')
            ->where('coach_id', Auth::guard('employee')->id())
            ->findOrFail($id);

        // حذف النسخ المنسوخة للاعبين بناءً على اسم الخطة والمستوى والمشرف
        TrainingPlan::whereNotNull('player_id')
            ->where('coach_id', $plan->coach_id)
            ->where('level', $plan->level)
            ->where('title', $plan->title)
            ->delete();

        // حذف الخطة الأساسية من البنك
        $plan->delete();

        return redirect()->route('employee.training.bank')->with('success', 'تم حذف الخطة من البنك ومن جداول اللاعبين.');
    }
}
