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

    public function index(Request $request)
    {
        $this->authorize('viewAny', Employee::class);

        $employees = Employee::with('roles')
            // 🔍 بحث بالاسم أو البريد الإلكتروني معاً بحقل واحد
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            // 🎯 فلترة حسب التخصص
            ->when($request->filled('specialization'), function ($query) use ($request) {
                $query->where('specialization', 'like', '%' . $request->specialization . '%');
            })
            // 🛡️ فلترة حسب الدور (Role)
            ->when($request->filled('role_id'), function ($query) use ($request) {
                $query->whereHas('roles', function ($q) use ($request) {
                    $q->where('roles.id', $request->role_id);
                });
            })
            ->latest()
            ->get();

        return view('Admin.Employees.index', [
            'employees' => $employees,
            'roles' => Role::all(),
            'specializations' => Employee::whereNotNull('specialization')
                ->distinct()
                ->pluck('specialization'),
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
            'role_id'=>'required|exists:roles,id',
        ],
        [
            'name.required' => 'حقل الاسم مطلوب.',
            'name.string' => 'حقل الاسم يجب أن يكون نصًا.',
            'email.required' => 'حقل البريد الإلكتروني مطلوب.',
            'email.email' => 'يرجى إدخال بريد إلكتروني صالح.',
            'email.unique' => 'البريد الإلكتروني مستخدم بالفعل.',
            'password.required' => 'حقل كلمة المرور مطلوب.',
            'password.min' => 'كلمة المرور يجب أن تكون على الأقل 8 أحرف.',
            'specialization.string' => 'حقل التخصص يجب أن يكون نصًا.',
            'role_id.required' => 'حقل الدور مطلوب.',
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
            'role_id' => 'required|exists:roles,id',
        ],
        [
            'name.required' => 'حقل الاسم مطلوب.',
            'name.string' => 'حقل الاسم يجب أن يكون نصًا.',
            'email.required' => 'حقل البريد الإلكتروني مطلوب.',
            'email.email' => 'يرجى إدخال بريد إلكتروني صالح.',
            'email.unique' => 'البريد الإلكتروني مستخدم بالفعل.',
            'specialization.string' => 'حقل التخصص يجب أن يكون نصًا.',
            'role_id.required' => 'حقل الدور مطلوب.',
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
