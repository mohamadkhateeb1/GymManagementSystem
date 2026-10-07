<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    /**
     * عرض بروفايل الأدمن
     */
    public function index()
    {
        /** @var Admin $admin */
        $admin = auth('admin')->user();

        $admin->load('roles');

        return view('Admin.profile.index', compact('admin'));
    }

    /**
     * تحديث معلومات الأدمن الشخصية
     */
    public function update(Request $request)
    {
        /** @var Admin $admin */
        $admin = auth('admin')->user();

        $data = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('admins', 'email')->ignore($admin->id),
            ],
        ]);

        $admin->update([
            'name' => $data['name'],
            'email' => $data['email'],
        ]);

        return redirect()
            ->route('admin.profile')
            ->with('success', 'تم تحديث معلومات الحساب بنجاح.');
    }

    /**
     * تغيير كلمة المرور
     */
    public function updatePassword(Request $request)
    {
        /** @var Admin $admin */
        $admin = auth('admin')->user();

        $data = $request->validate([
            'current_password' => [
                'required',
                'current_password:admin',
            ],

            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],
        ], [
            'current_password.required' => 'يرجى إدخال كلمة المرور الحالية.',
            'current_password.current_password' => 'كلمة المرور الحالية غير صحيحة.',
            'password.required' => 'يرجى إدخال كلمة المرور الجديدة.',
            'password.min' => 'كلمة المرور الجديدة يجب أن تكون 8 محارف على الأقل.',
            'password.confirmed' => 'تأكيد كلمة المرور غير مطابق.',
        ]);

        $admin->update([
            'password' => Hash::make($data['password']),
        ]);

        return redirect()
            ->route('admin.profile')
            ->with('success', 'تم تغيير كلمة المرور بنجاح.');
    }
}