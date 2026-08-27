<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Player;
use App\Models\DietPlan;
use App\Models\TrainingPlan;
use App\Models\EmployeeAttendanceLog; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $coachId = Auth::guard('employee')->id();
        $today = Carbon::today()->toDateString();
        $now = Carbon::now();

        $totalPlayers = Player::where('coach_id', $coachId)->count();

        $beginnerCount = Player::where('coach_id', $coachId)->where('level', 'beginner')->count();
        $intermediateCount = Player::where('coach_id', $coachId)->where('level', 'intermediate')->count();
        $advancedCount = Player::where('coach_id', $coachId)->where('level', 'advanced')->count();

        $totalDietPlans = DietPlan::where('coach_id', $coachId)->whereNull('player_id')->count();
        $totalTrainingPlans = TrainingPlan::where('coach_id', $coachId)->whereNull('player_id')->count();

        $attendance = EmployeeAttendanceLog::where('employee_id', $coachId)
            ->where('attendance_date', $today)
            ->first();

        $coachPlayers = Player::where('coach_id', $coachId)->with('subscription')->get();

        $expiredPlayers = $coachPlayers->filter(function (Player $player) {
            return $player->subscription && ! $player->hasActiveSubscription();
        })->values();

        $expiringSoonPlayers = $coachPlayers->filter(function (Player $player) use ($now) {
            if (! $player->hasActiveSubscription()) {
                return false;
            }

            $endDate = Carbon::parse($player->subscription->end_date);

            return $endDate->between($now, $now->copy()->addDays(7));
        })->values();

        return view('Employee.dashboard', compact(
            'totalPlayers',
            'beginnerCount',
            'intermediateCount',
            'advancedCount',
            'totalDietPlans',
            'totalTrainingPlans',
            'attendance', 
            'expiredPlayers',
            'expiringSoonPlayers'
        ));
    }



 
    public function toggleAttendance(Request $request)
    {
        $employeeId = Auth::guard('employee')->id();
        $today = Carbon::today()->toDateString();
        $now = Carbon::now();

        $attendance = EmployeeAttendanceLog::where('employee_id', $employeeId)
            ->where('attendance_date', $today)
            ->first();


        if (!$attendance) {
            $lateAfterHour = config('gym.late_after_hour');
            $status = ($now->hour >= $lateAfterHour) ? 'late' : 'present';

            EmployeeAttendanceLog::create([
                'employee_id'     => $employeeId,
                'attendance_date' => $today,
                'recorded_at'     => $now,
                'status'          => $status,
            ]);

            return redirect()->back()->with('success', 'تم تسجيل حضورك لليوم بنجاح! طاب يومك كابتن.');
        }

        return redirect()->back()->with('error', 'لقد قمت بتسجيل حضورك لهذا اليوم بالفعل.');
    }
}
