<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Player;
use App\Models\DietPlan;
use App\Models\TrainingPlan;
use App\Models\EmployeeAttendanceLog; // 🔗 استدعاء موديل الحضور الجديد للموظفين
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $coachId = Auth::guard('employee')->id();
        $today = Carbon::today()->toDateString();

        // 1. إحصائيات اللاعبين
        $totalPlayers = Player::where('coach_id', $coachId)->count();

        // 2. توزيع المستويات للاعبين الحاليين
        $beginnerCount = Player::where('coach_id', $coachId)->where('level', 'beginner')->count();
        $intermediateCount = Player::where('coach_id', $coachId)->where('level', 'intermediate')->count();
        $advancedCount = Player::where('coach_id', $coachId)->where('level', 'advanced')->count();

        // 3. إحصائيات البنوك العامة للمدرب الحالي
        $totalDietPlans = DietPlan::where('coach_id', $coachId)->whereNull('player_id')->count();
        $totalTrainingPlans = TrainingPlan::where('coach_id', $coachId)->whereNull('player_id')->count();

        // 4. 🕒 جلب سجل حضور الموظف لليوم الحالي (إن وجد) لتحديث حالة زر الـ البصمة
        $attendance = EmployeeAttendanceLog::where('employee_id', $coachId)
            ->where('attendance_date', $today)
            ->first();

        return view('Employee.dashboard', compact(
            'totalPlayers',
            'beginnerCount',
            'intermediateCount',
            'advancedCount',
            'totalDietPlans',
            'totalTrainingPlans',
            'attendance' // تمريره للـ Blade
        ));
    }



     //////// ////////////////           جديد              ///////////////////////////
    /**
     * 🎯 الدالة الحركية للزر: تسجل حضور في الضغطة الأولى، وتسجل انصراف في الضغطة الثانية
     */
    public function toggleAttendance(Request $request)
    {
        $employeeId = Auth::guard('employee')->id();
        $today = Carbon::today()->toDateString();
        $now = Carbon::now();

        // فحص سجل اليوم الحالي
        $attendance = EmployeeAttendanceLog::where('employee_id', $employeeId)
            ->where('attendance_date', $today)
            ->first();

        //  الضغطة الأولى: لا يوجد سجل اليوم -> تسجيل دخول فوراً
        if (!$attendance) {
            $status = ($now->hour >= 9) ? 'late' : 'present';

            EmployeeAttendanceLog::create([
                'employee_id'     => $employeeId,
                'attendance_date' => $today,
                'check_in_time'   => $now,
                'check_out_time'  => null,
                'status'          => $status,
            ]);

            return redirect()->back()->with('success', 'تم تسجيل حضورك لليوم بنجاح! طاب يومك كابتن.');
        }

        // 🔴 الضغطة الثانية: الموظف حاضر ولكن لم يسجل خروج -> تسجيل انصراف
        if ($attendance && is_null($attendance->check_out_time)) {
            $attendance->update([
                'check_out_time' => $now,
            ]);

            return redirect()->back()->with('success', 'تم تسجيل وقت انصرافك ومغادرتك بنجاح. عطلة سعيدة!');
        }

        // حماية إضافية في حال ضغط مرة ثالثة واليوم منتهي بالكامل
        return redirect()->back()->with('error', 'لقد قمت بتسجيل الحضور والانصراف الكامل لليوم بالفعل.');
    }
}
