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
            'roles' => 'required|array|min:1',
            'roles.*' => 'exists:roles,id',
        ], [
            'roles.required' => 'يجب اختيار دور واحد على الأقل للموظف.',
            'roles.min' => 'يجب اختيار دور واحد على الأقل للموظف.',
            'roles.*.exists' => 'أحد الأدوار المختارة غير موجود.',
        ]);

        $employee = Employee::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'specialization' => $request->specialization,
        ]);

        // 🛡️ ربط الأدوار المختارة فعلياً بالموظف
        $employee->roles()->sync($request->roles);

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
            'roles' => 'required|array|min:1',
            'roles.*' => 'exists:roles,id',
        ], [
            'roles.required' => 'يجب اختيار دور واحد على الأقل للموظف.',
            'roles.min' => 'يجب اختيار دور واحد على الأقل للموظف.',
            'roles.*.exists' => 'أحد الأدوار المختارة غير موجود.',
        ]);

        $employee->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'specialization' => $data['specialization'] ?? null,
        ]);

        if (!empty($request->password)) {
            $employee->update([
                'password' => bcrypt($request->password),
            ]);
        }

        // 🛡️ تحديث الأدوار المرتبطة
        $employee->roles()->sync($request->roles);

        return redirect()->route('employees.index')->with('success', 'تم تحديث بيانات الموظف بنجاح.');
    }

    /**
     * 🗑️ حذف نهائي (Force Delete) — بنفس نمط حذف اللاعبين بالمشروع.
     * رغم إن الموديل يدعم Soft Delete، هالحذف يتجاوزه ويشيل السجل نهائياً
     * من قاعدة البيانات مباشرة، بلا ما يضل مخفي بـ deleted_at.
     */
    public function destroy(Employee $employee)
    {
        $employee->forceDelete();
        return redirect()->route('employees.index')->with('success', 'تم حذف الموظف نهائياً من النظام.');
    }

    public function destroy_all()
    {
        // 🛡️ withTrashed() ضرورية هون — لضمان حذف حتى أي موظف محذوف "ناعم" مسبقاً
        $employees = Employee::withTrashed()->get();

        if ($employees->isEmpty()) {
            return redirect()->route('employees.index')->with('success', 'لا يوجد موظفين لحذفهم.');
        }

        foreach ($employees as $employee) {
            $employee->forceDelete();
        }

        return redirect()->route('employees.index')->with('success', 'تم حذف جميع الموظفين نهائياً من النظام.');
    }
}
