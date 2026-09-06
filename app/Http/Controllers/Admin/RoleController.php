<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Role::class);
        $roles = Role::paginate(10);
        return view('Admin.Roles.index', [
            'roles' => $roles
        ]);
    }


    public function create()
    {
        // $this->authorize('create', Role::class);
        return view('Admin.Roles.create', [
            'role' => new Role(),
        ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'ability' => 'required|array',
        ], [
            'name.required' => 'اسم الدور مطلوب.',
            'name.unique' => 'يوجد دور آخر بنفس هذا الاسم مسبقاً.',
            'ability.required' => 'يجب تحديد صلاحية واحدة على الأقل.',
            'ability.array' => 'صيغة الصلاحيات غير صحيحة.',
        ]);

        try {
            Role::createWithAbilities($request);
            return redirect()->route('admin.roles')->with('success', 'تم إنشاء الدور بنجاح.');
        } catch (\Throwable $e) {
            return back()->withInput()->with('error', 'حدث خطأ أثناء إنشاء الدور. حاول مرة أخرى.');
        }
    }

    public function show(Role $role)
    {
        //
    }


    public function edit(Role $role)
    {
        $role_abilities = $role->abilities()->pluck('type', 'ability')->toArray();
        return view('Admin.Roles.edit', [
            'role' => $role,
            'role_abilities' => $role_abilities,
        ]);
    }


    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required',
            'ability' => 'required|array',
        ], [
            'name.required' => 'اسم الدور مطلوب.',
            'ability.required' => 'يجب تحديد صلاحية واحدة على الأقل.',
            'ability.array' => 'صيغة الصلاحيات غير صحيحة.',
        ]);

        try {
            $role->updateWithAbilities($request);
            return redirect()->route('admin.roles')->with('success', 'تم تحديث الدور بنجاح.');
        } catch (\Throwable $e) {
            return back()->withInput()->with('error', 'حدث خطأ أثناء تحديث الدور. حاول مرة أخرى.');
        }
    }


    public function destroy($id)
    {
        try {
            Role::destroy($id);
            return redirect()->route('admin.roles')
                ->with('success', 'تم حذف الدور بنجاح.');
        } catch (\Illuminate\Database\QueryException $e) {
            // 🛡️ حذف يفشل بسبب ارتباط الدور بموظف/أدمن حالياً (Foreign Key)
            return redirect()->route('admin.roles')
                ->with('error', 'لا يمكن حذف هذا الدور لأنه مُسنَد حالياً لمستخدم واحد أو أكثر. ألغِ إسناده أولاً ثم أعد المحاولة.');
        } catch (\Throwable $e) {
            return redirect()->route('admin.roles')
                ->with('error', 'حدث خطأ غير متوقع أثناء حذف الدور.');
        }
    }

    public function destroy_all()
    {
        $roles = Role::all();
        if ($roles->isEmpty()) {
            return redirect()->route('admin.roles')
                ->with('error', 'لا توجد أدوار لحذفها.');
        }

        $failedCount = 0;

        foreach ($roles as $role) {
            try {
                $role->delete();
            } catch (\Illuminate\Database\QueryException $e) {
                // 🛡️ نتجاهل الأدوار المرتبطة بمستخدمين ونكمل الباقي، بدل ما نوقف العملية كاملة
                $failedCount++;
                continue;
            }
        }

        if ($failedCount > 0) {
            return redirect()->route('admin.roles')
                ->with('error', "تم حذف بعض الأدوار، لكن {$failedCount} دور لم يُحذف لأنه مُسنَد حالياً لمستخدمين.");
        }

        return redirect()->route('admin.roles')
            ->with('success', 'تم حذف جميع الأدوار بنجاح.');
    }
}
