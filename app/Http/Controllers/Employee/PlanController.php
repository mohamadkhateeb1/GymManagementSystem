<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\TrainingPlan;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PlanController extends Controller // هاد الكلاس مسؤول عن إدارة التمارين داخل خطة التدريب الخاصة بالمدرب. يحتوي على وظائف لعرض، إضافة، تعديل، وحذف التمارين، بالإضافة إلى عرض مكتبة التمارين الخاصة بالمدرب.
{


    public function index($planId)
    {
       
        
        $coachId = Auth::guard('employee')->id();

        $trainingPlan = TrainingPlan::where('coach_id', $coachId)->findOrFail($planId);

        $exercises = Plan::where('training_plan_id', $trainingPlan->id)
            ->orderByRaw('day_of_week IS NULL, day_of_week ASC')
            ->orderBy('order')
            ->orderBy('id')
            ->get();

        return view('Employee.TrainingBank.Plans.plans', compact('trainingPlan', 'exercises'));
    }



    public function store(Request $request, $planId)
    {
     $request->validate([
    'name' => 'required|string|max:255',
    'sets' => 'required|numeric',
    'reps' => 'required|numeric',
    'rest_time' => 'required|string|max:50',
    'day_of_week' => 'required|integer|min:1|max:7',
    'order' => 'required|integer|min:0',
    'instructions' => 'required|string',
    'image' => 'required|image|max:5120',
    'video_url' => 'required|string',
], [
    // اسم التمرين
    'name.required' => 'حقل اسم التمرين مطلوب.',
    'name.string' => 'حقل اسم التمرين يجب أن يكون نصًا.',
    'name.max' => 'حقل اسم التمرين يجب أن لا يتجاوز 255 حرفًا.',

    // المجموعات
    'sets.required' => 'حقل عدد المجموعات مطلوب.',
    'sets.numeric' => 'حقل عدد المجموعات يجب أن يكون رقمًا.',

    // التكرارات
    'reps.required' => 'حقل عدد التكرارات مطلوب.',
    'reps.numeric' => 'حقل عدد التكرارات يجب أن يكون رقمًا.',

    // وقت الراحة
    'rest_time.required' => 'حقل وقت الراحة مطلوب.',
    'rest_time.string' => 'حقل وقت الراحة يجب أن يكون نصًا.',
    'rest_time.max' => 'حقل وقت الراحة يجب أن لا يتجاوز 50 حرفًا.',

    // يوم الأسبوع
    'day_of_week.required' => 'يجب اختيار يوم الأسبوع.',
    'day_of_week.integer' => 'حقل يوم الأسبوع يجب أن يكون رقمًا.',
    'day_of_week.min' => 'يجب أن يكون يوم الأسبوع على الأقل 1 (الأحد).',
    'day_of_week.max' => 'يجب أن يكون يوم الأسبوع على الأكثر 7 (السبت).',

    // ترتيب التمرين
    'order.required' => 'حقل ترتيب التمرين مطلوب.',
    'order.integer' => 'حقل ترتيب التمرين يجب أن يكون رقمًا.',
    'order.min' => 'ترتيب التمرين يجب أن يكون على الأقل 0.',

    // التعليمات
    'instructions.required' => 'حقل التعليمات مطلوب.',
    'instructions.string' => 'حقل التعليمات يجب أن يكون نصًا.',

    // الصورة
    'image.required' => 'صورة التمرين مطلوبة.',
    'image.image' => 'الملف المرفق يجب أن يكون صورة.',
    'image.max' => 'حجم صورة التمرين يجب ألا يتجاوز 5 ميجابايت.',

    // رابط الفيديو
    'video_url.required' => 'رابط الفيديو مطلوب.',
    'video_url.string' => 'رابط الفيديو يجب أن يكون نصًا.',
]);

        $coachId = Auth::guard('employee')->id();

        $trainingPlan = TrainingPlan::where('coach_id', $coachId)->findOrFail($planId);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('exercises', 'public');
        }

        Plan::create([
            'training_plan_id' => $trainingPlan->id,
            'name' => $request->name,
            'sets' => $request->sets,
            'reps' => $request->reps,
            'rest_time' => $request->rest_time,
            'day_of_week' => $request->day_of_week,
            'order' => $request->order ?? 0,
            'instructions' => $request->instructions,
            'image_path' => $imagePath,
            'video_url' => $request->video_url,
        ]);

        return redirect()->back()->with('success', 'تمت إضافة التمرين للخطة بنجاح.');
    }

    public function edit($id)
    {
        $coachId = Auth::guard('employee')->id();

        $exercise = Plan::whereHas('trainingPlan', function ($q) use ($coachId) {
            $q->where('coach_id', $coachId);
        })->findOrFail($id);

        return view('Employee.TrainingBank.Plans.edit', compact('exercise'));
    }



    public function update(Request $request, $id)
    {
            $request->validate([
    'name' => 'required|string|max:255',
    'sets' => 'required|numeric',
    'reps' => 'required|numeric',
    'rest_time' => 'required|string|max:50',
    'day_of_week' => 'required|integer|min:1|max:7',
    'order' => 'required|integer|min:0',
    'instructions' => 'required|string',
    'image' => 'nullable|image|max:5120',
    'video_url' => 'nullable|string',
], [
    // اسم التمرين
    'name.required' => 'حقل اسم التمرين مطلوب.',
    'name.string' => 'حقل اسم التمرين يجب أن يكون نصًا.',
    'name.max' => 'حقل اسم التمرين يجب أن لا يتجاوز 255 حرفًا.',

    // المجموعات
    'sets.required' => 'حقل عدد المجموعات مطلوب.',
    'sets.numeric' => 'حقل عدد المجموعات يجب أن يكون رقمًا.',

    // التكرارات
    'reps.required' => 'حقل عدد التكرارات مطلوب.',
    'reps.numeric' => 'حقل عدد التكرارات يجب أن يكون رقمًا.',

    // وقت الراحة
    'rest_time.required' => 'حقل وقت الراحة مطلوب.',
    'rest_time.string' => 'حقل وقت الراحة يجب أن يكون نصًا.',
    'rest_time.max' => 'حقل وقت الراحة يجب أن لا يتجاوز 50 حرفًا.',

    // يوم الأسبوع
    'day_of_week.required' => 'يجب اختيار يوم الأسبوع.',
    'day_of_week.integer' => 'حقل يوم الأسبوع يجب أن يكون رقمًا.',
    'day_of_week.min' => 'يجب أن يكون يوم الأسبوع على الأقل 1 (الأحد).',
    'day_of_week.max' => 'يجب أن يكون يوم الأسبوع على الأكثر 7 (السبت).',

    // ترتيب التمرين
    'order.required' => 'حقل ترتيب التمرين مطلوب.',
    'order.integer' => 'حقل ترتيب التمرين يجب أن يكون رقمًا.',
    'order.min' => 'ترتيب التمرين يجب أن يكون على الأقل 0.',

    // التعليمات
    'instructions.required' => 'حقل التعليمات مطلوب.',
    'instructions.string' => 'حقل التعليمات يجب أن يكون نصًا.',

    // الصورة
    'image.required' => 'صورة التمرين مطلوبة.',
    'image.image' => 'الملف المرفق يجب أن يكون صورة.',
    'image.max' => 'حجم صورة التمرين يجب ألا يتجاوز 5 ميجابايت.',

    // رابط الفيديو
    'video_url.required' => 'رابط الفيديو مطلوب.',
    'video_url.string' => 'رابط الفيديو يجب أن يكون نصًا.',
]);
        $coachId = Auth::guard('employee')->id();

        $exercise = Plan::whereHas('trainingPlan', function ($q) use ($coachId) {
            $q->where('coach_id', $coachId);
        })->findOrFail($id);

        $exercise->name = $request->name;
        $exercise->sets = $request->sets;
        $exercise->reps = $request->reps;
        $exercise->rest_time = $request->rest_time;
        $exercise->day_of_week = $request->day_of_week;
        $exercise->order = $request->order ?? 0;
        $exercise->instructions = $request->instructions;
        $exercise->video_url = $request->video_url;

        if ($request->hasFile('image')) {
            if (
                $exercise->image_path &&
                Storage::disk('public')->exists($exercise->image_path)
            ) {
                Storage::disk('public')->delete($exercise->image_path);
            }

            $exercise->image_path = $request->file('image')->store('exercises', 'public');
        }

        $exercise->save();

        return redirect()
            ->route('employee.training.exercises.index', $exercise->training_plan_id)
            ->with('success', 'تم تعديل التمرين بنجاح.');
    }



    public function destroy($id)
    {
        $exercise = Plan::whereHas('trainingPlan', function ($q) {
            $q->where('coach_id', Auth::guard('employee')->id());
        })->findOrFail($id);

        $imageStillUsed = $exercise->image_path
            ? Plan::where('image_path', $exercise->image_path)
            ->where('id', '!=', $exercise->id)
            ->exists()
            : false;

        if (
            $exercise->image_path &&
            !$imageStillUsed &&
            Storage::disk('public')->exists($exercise->image_path)
        ) {
            Storage::disk('public')->delete($exercise->image_path);
        }

        $exercise->delete();

        return redirect()->back()->with('success', 'تم حذف التمرين بنجاح.');
    }



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



    public function showExercise($id)
    {
        $coachId = Auth::guard('employee')->id();

        $exercise = Plan::whereHas('trainingPlan', function ($q) use ($coachId) {
            $q->where('coach_id', $coachId);
        })->findOrFail($id);

        return view('Employee.TrainingBank.Library.show', compact('exercise'));
    }
}
