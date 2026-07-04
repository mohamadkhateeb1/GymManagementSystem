<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\EmployeeAttendanceLog;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminEmployeeAttendanceController extends Controller
{
    /**
     * عرض لوحة تقارير حضور الموظفين مع الفلاتر والإحصائيات
     */
    public function index(Request $request)
    {
        // 1. جلب الإحصائيات لليوم الحالي بشكل فوري لايف
        $today = Carbon::today()->toDateString();

        $stats = [
            'total_present'   => EmployeeAttendanceLog::where('attendance_date', $today)->count(),
            'total_late'      => EmployeeAttendanceLog::where('attendance_date', $today)->where('status', 'late')->count(),
            'total_completed' => EmployeeAttendanceLog::where('attendance_date', $today)->whereNotNull('check_out_time')->count(),
        ];

        // 2. بناء استعلام التقارير مع الفلترة الديناميكية
        $query = EmployeeAttendanceLog::with('employee')->latest('attendance_date');

        // فلترة حسب الموظف
        if ($request->filled('employee_id')) {
            $query->where('employee_id', $request->employee_id);
        }

        // فلترة حسب الحالة (present, late)
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // فلترة حسب نطاق التواريخ (من تاريخ - إلى تاريخ)
        if ($request->filled('date_from')) {
            $query->where('attendance_date', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->where('attendance_date', '<=', $request->date_to);
        }

        // جلب البيانات مع الترقيم الصافي (Pagination) لضمان سرعة الصفحة
        $logs = $query->paginate(15)->appends($request->all());

        // جلب قائمة الموظفين لعرضها في قائمة الفلترة المنسدلة
        $employees = Employee::orderBy('name')->get();

        return view('Admin.AttendanceEmployee.index', compact('logs', 'employees', 'stats'));
    }

    /**
     * تمكين المدير من تسجيل حضور يدوي للموظف (في حال نسي الموظف التسجيل)
     */
    public function storeManualAttendance(Request $request)
    {
        $request->validate([
            'employee_id'     => 'required|exists:employees,id',
            'attendance_date' => 'required|date|before_or_equal:today',
            'check_in_time'   => 'required|date_format:H:i',
            'check_out_time'  => 'nullable|date_format:H:i|after:check_in_time',
            'status'          => 'required|string|in:present,late',
        ]);

        // التحقق من عدم وجود سجل حضور لنفس الموظف في نفس التاريخ منعاً للتكرار
        $exists = EmployeeAttendanceLog::where('employee_id', $request->employee_id)
            ->where('attendance_date', $request->attendance_date)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'هذا الموظف لديه سجل حضور مسجل بالفعل في هذا التاريخ.');
        }

        // دمج التاريخ مع الوقت الممرر لتشكيل Timestamp صحيح لارافيل
        $checkIn = Carbon::parse($request->attendance_date . ' ' . $request->check_in_time);
        $checkOut = $request->filled('check_out_time')
            ? Carbon::parse($request->attendance_date . ' ' . $request->check_out_time)
            : null;

        EmployeeAttendanceLog::create([
            'employee_id'     => $request->employee_id,
            'attendance_date' => $request->attendance_date,
            'check_in_time'   => $checkIn,
            'check_out_time'  => $checkOut,
            'status'          => $request->status,
        ]);

        return redirect()->back()->with('success', 'تم تسجيل قيد الحضور اليدوي للموظف بنجاح.');
    }

  
    public function updateAttendance(Request $request, $id)
    {
        $log = EmployeeAttendanceLog::findOrFail($id);

        $request->validate([
            'check_in_time'  => 'required|date_format:H:i',
            'check_out_time' => 'required|date_format:H:i',
            'status'         => 'required|string|in:present,late',
        ]);

        $dateStr = $log->attendance_date->toDateString();
        $checkIn = Carbon::parse($dateStr . ' ' . $request->check_in_time);
        $checkOut = Carbon::parse($dateStr . ' ' . $request->check_out_time);

        if ($checkOut->before($checkIn)) {
            return redirect()->back()->with('error', 'وقت الانصراف لا يمكن أن يكون قبل وقت الحضور.');
        }

        $log->update([
            'check_in_time'  => $checkIn,
            'check_out_time' => $checkOut,
            'status'         => $request->status,
        ]);

        return redirect()->back()->with('success', 'تم تعديل وتحديث سجل حضور الموظف بنجاح.');
    }

    /**
     * حذف سجل حضور من قِبل المدير
     */
    public function destroyAttendance($id)
    {
        $log = EmployeeAttendanceLog::findOrFail($id);
        $log->delete();

        return redirect()->back()->with('success', 'تم حذف سجل الحضور بنجاح من النظام.');
    }
}
