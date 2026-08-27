<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class ProfileController extends Controller
{
    public function edit()
    {
        /** @var \App\Models\Employee $employee */
        $employee = Auth::guard('employee')->user();
        $now = Carbon::now();

        $attendanceThisMonth = $employee->attendanceLogs()
            ->whereMonth('attendance_date', $now->month)
            ->whereYear('attendance_date', $now->year)
            ->get();

        $presentCount = $attendanceThisMonth->where('status', 'present')->count();
        $lateCount    = $attendanceThisMonth->where('status', 'late')->count();
        $playersCount = $employee->players()->count();

        return view('Employee.Profile.edit', compact('employee', 'presentCount', 'lateCount', 'playersCount'));
    }


    public function update(Request $request)
    {
        $employee = Auth::guard('employee')->user();

        $validated = $request->validate([
            'name'           => 'required|string|max:255',
            'email'          => 'required|email|max:255|unique:employees,email,' . $employee->id,
            'specialization' => 'nullable|string|max:255',
        ]);
        /** @var \App\Models\Employee $employee */
        $employee->update($validated);

        return redirect()->route('employee.profile.edit')->with('success', 'تم تحديث بيانات ملفك الشخصي بنجاح.');
    }


    public function updatePassword(Request $request)
    {
        $employee = Auth::guard('employee')->user();

        $validated = $request->validate([
            'current_password' => 'required',
            'password'         => 'required|min:6|confirmed',
        ]);

        if (! Hash::check($validated['current_password'], $employee->password)) {
            return back()->withErrors(['current_password' => 'كلمة المرور الحالية غير صحيحة.']);
        }
        /** @var \App\Models\Employee $employee */
        $employee->update(['password' => Hash::make($validated['password'])]);

        return redirect()->route('employee.profile.edit')->with('success', 'تم تغيير كلمة المرور بنجاح.');
    }
}
