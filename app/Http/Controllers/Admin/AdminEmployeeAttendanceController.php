<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\EmployeeAttendanceLog;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminEmployeeAttendanceController extends Controller
{
    public function index(Request $request)
    {
        $today = Carbon::today()->toDateString();

        $stats = [
            'total_present' => EmployeeAttendanceLog::where('attendance_date', $today)->count(),
            'total_late'    => EmployeeAttendanceLog::where('attendance_date', $today)->where('status', 'late')->count(),
        ];

        $query = EmployeeAttendanceLog::with('employee')->latest('attendance_date');

        if ($request->filled('employee_id')) {
            $query->where('employee_id', $request->employee_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('date_from')) {
            $query->where('attendance_date', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->where('attendance_date', '<=', $request->date_to);
        }

        $logs = $query->paginate(15)->appends($request->all());

        $employees = Employee::orderBy('name')->get();

        return view('Admin.AttendanceEmployee.index', compact('logs', 'employees', 'stats'));
    }

    public function storeManualAttendance(Request $request)
    {
        $request->validate([
            'employee_id'     => 'required|exists:employees,id',
            'attendance_date' => 'required|date|before_or_equal:today',
            'recorded_at'     => 'required|date_format:H:i',
            'status'          => 'required|string|in:present,late',
        ]);

        $exists = EmployeeAttendanceLog::where('employee_id', $request->employee_id)
            ->where('attendance_date', $request->attendance_date)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'هذا الموظف لديه سجل حضور مسجل بالفعل في هذا التاريخ.');
        }

        $recordedAt = Carbon::parse($request->attendance_date . ' ' . $request->recorded_at);

        EmployeeAttendanceLog::create([
            'employee_id'     => $request->employee_id,
            'attendance_date' => $request->attendance_date,
            'recorded_at'     => $recordedAt,
            'status'          => $request->status,
        ]);

        return redirect()->back()->with('success', 'تم تسجيل قيد الحضور اليدوي للموظف بنجاح.');
    }


    public function updateAttendance(Request $request, $id)
    {
        $log = EmployeeAttendanceLog::findOrFail($id);

        $request->validate([
            'recorded_at' => 'required|date_format:H:i',
            'status'      => 'required|string|in:present,late',
        ]);

        $dateStr = $log->attendance_date->toDateString();
        $recordedAt = Carbon::parse($dateStr . ' ' . $request->recorded_at);

        $log->update([
            'recorded_at' => $recordedAt,
            'status'      => $request->status,
        ]);

        return redirect()->back()->with('success', 'تم تعديل وتحديث سجل حضور الموظف بنجاح.');
    }

    
    public function destroyAttendance($id)
    {
        $log = EmployeeAttendanceLog::findOrFail($id);
        $log->delete();

        return redirect()->back()->with('success', 'تم حذف سجل الحضور بنجاح من النظام.');
    }
}
