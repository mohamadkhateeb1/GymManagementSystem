<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PlanType;
use Illuminate\Http\Request;

class PlanTypeController extends Controller
{
   
    public function index()
    {
        $planTypes = PlanType::withCount('memberships')->latest()->get();

        return view('Admin.PlanTypes.index', compact('planTypes'));
    }

    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'                 => 'required|string|max:255',
            'duration_days'        => 'required|integer|min:1',
            'price'                => 'required|numeric|min:0',
            'freeze_days_allowed'  => 'nullable|integer|min:0|max:255',
        ]);

        PlanType::create([
            'name'                => $validated['name'],
            'duration_days'       => $validated['duration_days'],
            'price'               => $validated['price'],
            'freeze_days_allowed' => $validated['freeze_days_allowed'] ?? 0,
        ]);

        return redirect()->route('admin.plan-types.index')->with('success', 'تمت إضافة الباقة بنجاح.');
    }


    public function update(Request $request, PlanType $planType)
    {
        $validated = $request->validate([
            'name'                 => 'required|string|max:255',
            'duration_days'        => 'required|integer|min:1',
            'price'                => 'required|numeric|min:0',
            'freeze_days_allowed'  => 'nullable|integer|min:0|max:255',
        ]);

        $planType->update([
            'name'                => $validated['name'],
            'duration_days'       => $validated['duration_days'],
            'price'               => $validated['price'],
            'freeze_days_allowed' => $validated['freeze_days_allowed'] ?? 0,
        ]);

        return redirect()->route('admin.plan-types.index')->with('success', 'تم تحديث بيانات الباقة بنجاح.');
    }

 
    public function toggleActive(PlanType $planType)
    {
        $planType->update(['is_active' => ! $planType->is_active]);

        $message = $planType->is_active
            ? 'تم تفعيل الباقة، وستظهر الآن عند إنشاء اشتراك جديد.'
            : 'تم إخفاء الباقة عن قائمة الاشتراكات الجديدة، مع بقاء الاشتراكات القديمة عليها كما هي.';

        return redirect()->route('admin.plan-types.index')->with('success', $message);
    }
}