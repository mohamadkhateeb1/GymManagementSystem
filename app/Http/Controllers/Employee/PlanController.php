<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\TrainingPlan;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PlanController extends Controller
{
    public function index($planId)
    {
        $coachId = Auth::guard('employee')->id();

        $trainingPlan = TrainingPlan::where('coach_id', $coachId)->findOrFail($planId);

        // جلب جميع التمارين الخاصة بهذه الخطة
        $exercises = Plan::where('training_plan_id', $trainingPlan->id)->latest()->get();

        return view('Employee.TrainingBank.Plans.plans', compact('trainingPlan', 'exercises'));
    }

    public function store(Request $request, $planId)
    {
        // 🎯 التحقق المريح للبيانات
        $request->validate([
            'name' => 'required|string|max:255',
            'sets'          => 'required|numeric',
            'reps'   => 'required|numeric',
            'rest_time'     => 'nullable|string',
            'day_of_week'   => 'nullable|string',
            'instructions'  => 'nullable|string',
            'image'         => 'nullable|image|max:5120',
            'video_url'     => 'nullable|string',
        ]);

        $coachId = Auth::guard('employee')->id();
        $trainingPlan = TrainingPlan::where('coach_id', $coachId)->findOrFail($planId);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('exercises', 'public');
        }

        // 🎯 إنشاء السجل مباشرة
        Plan::create([
            'training_plan_id' => $trainingPlan->id,
            'name'    => $request->name,
            'sets'             => $request->sets,
            'reps'      => $request->reps,
            // 'rest_time'        => $request->rest_time,
            // 'day_of_week'      => $request->day_of_week,
            'instructions'     => $request->instructions,
            'image_path'       => $imagePath,
            'video_url'        => $request->video_url,
        ]);

        return redirect()->back()->with('success', 'تمت إضافة التمرين للخطة بنجاح.');
    }

    public function destroy($id)
    {
        $exercise = Plan::findOrFail($id);

        if ($exercise->image_path && Storage::disk('public')->exists($exercise->image_path)) {
            Storage::disk('public')->delete($exercise->image_path);
        }

        $exercise->delete();

        return redirect()->back()->with('success', 'تم حذف التمرين بنجاح.');
    }
    // عرض كافة التمارين الموجودة بالمكتبة العامة للمدرب
// 🎯 عرض جدول التمارين بالمكتبة (الاسم والقسم فقط)
public function library(Request $request)
{
    $coachId = Auth::guard('employee')->id();

    $query = Plan::whereHas('trainingPlan', function ($q) use ($coachId) {
        $q->where('coach_id', $coachId);
    });

    if ($request->filled('level')) {
        $query->whereHas('trainingPlan', function ($q) use ($request) {
            $q->where('level', $request->level);
        });
    }

    $exercises = $query->with('trainingPlan')->latest()->get();

    return view('Employee.TrainingBank.Library.index', compact('exercises'));
}

// 🎯 صفحة عرض التفاصيل والشرح والفيديو للتمرين
public function showExercise($id)
{
    $coachId = Auth::guard('employee')->id();

    $exercise = Plan::whereHas('trainingPlan', function ($q) use ($coachId) {
        $q->where('coach_id', $coachId);
    })->findOrFail($id);

    return view('Employee.TrainingBank.Library.show', compact('exercise'));
}
}
