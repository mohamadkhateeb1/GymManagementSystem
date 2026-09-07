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

        /*
        |--------------------------------------------------------------------------
        | اللاعبين التابعين للكابتن الحالي
        |--------------------------------------------------------------------------
        */
        $coachPlayers = Player::where('coach_id', $coachId)
            ->with('subscription')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | إحصائيات اللاعبين
        |--------------------------------------------------------------------------
        */
        $totalPlayers = $coachPlayers->count();

        $beginnerCount = $coachPlayers
            ->where('level', 'beginner')
            ->count();

        $intermediateCount = $coachPlayers
            ->where('level', 'intermediate')
            ->count();

        $advancedCount = $coachPlayers
            ->where('level', 'advanced')
            ->count();

        /*
        |--------------------------------------------------------------------------
        | الخطط التدريبية والغذائية
        |--------------------------------------------------------------------------
        */
        $totalDietPlans = DietPlan::where('coach_id', $coachId)
            ->whereNull('player_id')
            ->count();

        $totalTrainingPlans = TrainingPlan::where('coach_id', $coachId)
            ->whereNull('player_id')
            ->count();

        /*
        |--------------------------------------------------------------------------
        | حضور الموظف اليوم
        |--------------------------------------------------------------------------
        */
        $attendance = EmployeeAttendanceLog::where('employee_id', $coachId)
            ->where('attendance_date', $today)
            ->first();

        /*
        |--------------------------------------------------------------------------
        | اللاعبين الذين انتهت اشتراكاتهم
        |--------------------------------------------------------------------------
        */
        $expiredPlayers = $coachPlayers
            ->filter(function (Player $player) {
                return $player->subscription &&
                    ! $player->hasActiveSubscription();
            })
            ->values();

        /*
        |--------------------------------------------------------------------------
        | اللاعبين الذين ستنتهي اشتراكاتهم خلال 7 أيام
        |--------------------------------------------------------------------------
        */
        $expiringSoonPlayers = $coachPlayers
            ->filter(function (Player $player) use ($now) {

                if (! $player->hasActiveSubscription()) {
                    return false;
                }

                if (! $player->subscription->end_date) {
                    return false;
                }

                $endDate = Carbon::parse($player->subscription->end_date);

                return $endDate->between(
                    $now,
                    $now->copy()->addDays(7)
                );
            })
            ->values();

        /*
        |--------------------------------------------------------------------------
        | تنبيهات الداشبورد
        |--------------------------------------------------------------------------
        |
        | كل لاعب اشتراكه سينتهي خلال 7 أيام
        | يصبح عبارة عن Notification للواجهة.
        |
        */
        $notifications = $expiringSoonPlayers->map(function (Player $player) use ($now) {

            $endDate = Carbon::parse($player->subscription->end_date);

            $daysRemaining = $now->diffInDays($endDate, false);

            return [
                'type' => 'subscription_expiring',

                'player_id' => $player->id,

                'player_name' => $player->name,

                'message' => $daysRemaining <= 0
                    ? 'اشتراك اللاعب ' . $player->name . ' أوشك على الانتهاء اليوم.'
                    : 'اشتراك اللاعب ' . $player->name .
                    ' أوشك على الانتهاء، متبقي ' .
                    $daysRemaining .
                    ' ' .
                    ($daysRemaining == 1 ? 'يوم' : 'أيام') . '.',

                'end_date' => $endDate->format('Y-m-d'),

                'days_remaining' => $daysRemaining,

                'url' => route(
                    'employee.monitoring.show',
                    $player->id
                ),
            ];
        })->values();

        /*
        |--------------------------------------------------------------------------
        | إرسال كل البيانات للداشبورد
        |--------------------------------------------------------------------------
        */
        return view('Employee.Dashboard', compact(
            'totalPlayers',
            'beginnerCount',
            'intermediateCount',
            'advancedCount',
            'totalDietPlans',
            'totalTrainingPlans',
            'attendance',
            'expiredPlayers',
            'expiringSoonPlayers',
            'notifications'
        ));
    }


    /*
    |--------------------------------------------------------------------------
    | تسجيل الحضور
    |--------------------------------------------------------------------------
    */
    public function toggleAttendance(Request $request)
    {
        $employeeId = Auth::guard('employee')->id();

        $today = Carbon::today()->toDateString();
        $now = Carbon::now();

        $attendance = EmployeeAttendanceLog::where('employee_id', $employeeId)
            ->where('attendance_date', $today)
            ->first();

        /*
        |--------------------------------------------------------------------------
        | تسجيل الحضور لأول مرة اليوم
        |--------------------------------------------------------------------------
        */
        if (! $attendance) {

            $lateAfterHour = config('gym.late_after_hour');

            $status = ($now->hour >= $lateAfterHour)
                ? 'late'
                : 'present';

            EmployeeAttendanceLog::create([
                'employee_id'     => $employeeId,
                'attendance_date' => $today,
                'recorded_at'     => $now,
                'status'          => $status,
            ]);

            return redirect()
                ->back()
                ->with(
                    'success',
                    'تم تسجيل حضورك لليوم بنجاح! طاب يومك كابتن.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | الحضور مسجل مسبقاً
        |--------------------------------------------------------------------------
        */
        return redirect()
            ->back()
            ->with(
                'error',
                'لقد قمت بتسجيل حضورك لهذا اليوم بالفعل.'
            );
    }
}
