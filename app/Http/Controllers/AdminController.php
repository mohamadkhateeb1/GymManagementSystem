<?php

namespace App\Http\Controllers;

use App\Concerns\HasRoles;
use App\Models\Admin;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\TwoFactorAuthenticatable;

class AdminController extends Controller
{

    public function index()
    {
        return view('Admin.admins.index', [
            'admins' => Admin::with('roles')->get(), // هيتجيب الأدمنز مع الرولز مالتهم
        ]);
    }
    public function create()
    {
        return view('Admin.admins.create', [
            'roles' => Role::all(), // عشان اعرضهم في الفورم
            'admin' => new Admin(), // عشان استخدم نفس الفورم في ال create وال edit
        ]);
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:admins,email',
            'password' => 'required|string|min:8',
            'roles'    => 'required|array',
        ]);

        // إنشاء الأدمن بالحقول المسموح بها
        $admin = Admin::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        // ربط الأدمن بالرولز المحددة
        $admin->roles()->attach($data['roles']);
        //$admin->roles()->attach(1,2,3)
        return redirect()->route('admins.index');
    }

    public function edit(Admin $admin)
    {
        return view('Admin.admins.edit', [
            'admin' => $admin,
            'roles' => Role::all(),
            'admin_roles' => $admin->roles()->pluck('id')->toArray(),
        ]);
    }
    public function update(Request $request, Admin $admin)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => ['required', 'email'],
            'password' => 'nullable|string|min:8',
            'roles'    => 'required|array',
        ]);

        $update = [
            'name'  => $data['name'],
            'email' => $data['email'],
        ];

        if (!empty($data['password'])) {
            $update['password'] = Hash::make($data['password']);
        }

        $admin->update($update);
        $admin->roles()->sync($data['roles']);
        //admin role_(1,2)
        //  $admin->roles()->sync(3)
        // sync : طابق بالضبط على الرولز اضف الجديد واحذف الزائد الغير محدد
        // attach :اضف فقط لا تمسح القديمين
        return redirect()->route('admins.index');
    }
    
    public function destroy(Admin $admin)
    {
        $admin->roles()->detach();
        $admin->delete();

        return redirect()->route('admins.index');
    }
}
