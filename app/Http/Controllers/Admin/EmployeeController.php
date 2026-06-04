<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Role;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    use AuthorizesRequests;
    public function index()
    {
        $this->authorize('viewAny', Employee::class);
        $employees = Employee::with('roles')->latest()->get();

        return view('Admin.Employees.index', [
            'employees' => $employees
        ]);
    }
    public function create()
    {
        return view('Admin.Employees.create', [
            'employees' => new Employee(),
            'roles' => Role::all(),
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:employees',
            'password' => 'required|string|min:8',
            'specialization' => 'nullable|string|max:255',
        ]);

        Employee::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'specialization' => $request->specialization,
        ]);

        return redirect()->route('employees.index')->with('success', 'تم إضافة الموظف بنجاح.');
    }
    public function edit(Employee $employee)
    {
        return view('Admin.Employees.edit', [
            'employee' => $employee,
            'roles' => Role::all(),

        ]);
    }
    public function show(Employee $employee)
    {
        return view('Admin.Employees.show', [
            'employee' => $employee,
        ]);
    }
    public function update(Request $request, Employee $employee)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:employees,email,' . $employee->id,
            'specialization' => 'nullable|string|max:255',
        ]);
        $employee->update($data);
        if (!empty($request->password)) {
            $employee->update([
                'password' => bcrypt($request->password),
            ]);
        }
        return redirect()->route('employees.index')->with('success', 'تم تحديث بيانات الموظف بنجاح.');
    }
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'تم حذف الموظف بنجاح.');
    }
    public function destroy_all()
    {
        $employees = Employee::all();
        if ($employees->isEmpty()) {
            return redirect()->route('employees.index')->with('success', 'لا يوجد موظفين لحذفهم.');
        }
        foreach ($employees as $employee) {
            $employee->delete();
        }
        return redirect()->route('employees.index')->with('success', 'تم حذف جميع الموظفين بنجاح.');
    }
}
