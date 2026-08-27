<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AttendanceLog;
use App\Models\Employee;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PlayerAttendanceController extends Controller
{
    public function index(Request $request)
    {
        $today = Carbon::today();
        $startOfWeek = $today->copy()->startOfWeek();

        $todayCount = AttendanceLog::whereDate('attendance_date', $today)->count();
        $weekCount  = AttendanceLog::whereBetween('attendance_date', [$startOfWeek->toDateString(), $today->toDateString()])->count();
        $totalCount = AttendanceLog::count();

        $query = AttendanceLog::with(['player.coach'])->latest('attendance_date');

        if ($request->filled('player_name')) {
            $query->whereHas('player', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->player_name . '%');
            });
        }

        if ($request->filled('coach_id')) {
            $query->whereHas('player', function ($q) use ($request) {
                $q->where('coach_id', $request->coach_id);
            });
        }

        if ($request->filled('date_from')) {
            $query->whereDate('attendance_date', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('attendance_date', '<=', $request->date_to);
        }

        $logs = $query->paginate(20)->withQueryString();

        $coaches = Employee::orderBy('name')->get();

        return view('Admin.PlayerAttendance.index', compact(
            'logs',
            'coaches',
            'todayCount',
            'weekCount',
            'totalCount'
        ));
    }
}