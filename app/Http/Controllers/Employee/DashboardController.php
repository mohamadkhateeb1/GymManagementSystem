<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Player;
use App\Models\DietPlan;
use App\Models\TrainingPlan;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $coachId = Auth::guard('employee')->id();

        // 1. إحصائيات اللاعبين
        $totalPlayers = Player::where('coach_id', $coachId)->count();

        // 2. توزيع المستويات للاعبين الحاليين
        $beginnerCount = Player::where('coach_id', $coachId)->where('level', 'beginner')->count();
        $intermediateCount = Player::where('coach_id', $coachId)->where('level', 'intermediate')->count();
        $advancedCount = Player::where('coach_id', $coachId)->where('level', 'advanced')->count();

        // 3. إحصائيات البنوك العامة للمدرب الحالي
        $totalDietPlans = DietPlan::where('coach_id', $coachId)->whereNull('player_id')->count();
        $totalTrainingPlans = TrainingPlan::where('coach_id', $coachId)->whereNull('player_id')->count();

        return view('Employee.dashboard', compact(
            'totalPlayers',
            'beginnerCount',
            'intermediateCount',
            'advancedCount',
            'totalDietPlans',
            'totalTrainingPlans'
        ));
    }
}
