<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Membership;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SubscriptionsController extends Controller
{
    
 public function index()
    {
        $memberships = Membership::with('player')->latest()->paginate(15);
        return view('Admin.Subscriptions.index',[
            'memberships' => $memberships
        ]);
    }

    // تجديد اشتراك موجود
public function renew(Request $request, $id)
{
    $membership = Membership::findOrFail($id);
    
    // تحديد المدة بناءً على نوع الاشتراك الحالي
    $duration = 1; // الافتراضي شهر
    if (str_contains($membership->plan_name, 'ربع سنوي')) {
        $duration = 3;
    } elseif (str_contains($membership->plan_name, 'سنوي')) {
        $duration = 12;
    }

    // تحديث الاشتراك
    $membership->update([
        'start_date' => \Carbon\Carbon::now(),
        'end_date'   => \Carbon\Carbon::now()->addMonths($duration),
        'status'     => 'active'
    ]);

    return back()->with('success', 'تم تجديد الاشتراك بنجاح لنوع: ' . $membership->plan_name);
}

    // إضافة اشتراك جديد للاعب (عند تسجيل لاعب جديد مثلاً)
    public function store(Request $request)
    {
        $request->validate([
            'player_id' => 'required|exists:players,id',
            'plan_name' => 'required',
            'duration'  => 'required|integer', // عدد الأشهر
        ]);

        Membership::create([
            'player_id'  => $request->player_id,
            'plan_name'  => $request->plan_name,
            'start_date' => Carbon::now(),
            'end_date'   => Carbon::now()->addMonths($request->duration),
            'status'     => 'active',
        ]);

        return back()->with('success', 'تم إضافة الاشتراك بنجاح');
    }
}
