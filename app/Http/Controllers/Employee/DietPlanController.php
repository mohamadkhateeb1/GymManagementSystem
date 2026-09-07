<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\DietPlan;
use App\Models\Player;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DietPlanController extends Controller
{
    use AuthorizesRequests;
    //
    public function index() {
        if (!$this->authorize('viewAny', DietPlan::class)) {
            abort(403);
        }
        $coachId = Auth::guard('employee')->id();

        $dietPlans = DietPlan::whereNull('player_id')
            ->where('coach_id', $coachId)
            ->latest()
            ->get();

        return view('Employee.DietBank.index', compact('dietPlans'));
    }

    public function store(Request $request){
        $request->validate(
            [
                'meal_name'    => 'required|string|max:255',
                'calories'     => 'required|numeric',
                'protein'      => 'required|numeric|min:0',
                'carbs'        => 'required|numeric|min:0',
                'fats'         => 'required|numeric|min:0',
                'level'        => 'required|string',
                'plan_details' => 'required|string',
                'image'        => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            ],
            [
                'meal_name.required' => 'حقل اسم الوجبة مطلوب.',
                'meal_name.string' => 'حقل اسم الوجبة يجب أن يكون نصًا.',
                'meal_name.max' => 'حقل اسم الوجبة يجب أن لا يتجاوز 255 حرفًا.',

                'calories.required' => 'حقل السعرات الحرارية مطلوب.',
                'calories.numeric' => 'حقل السعرات الحرارية يجب أن يكون رقمًا',

                'protein.required' => 'حقل البروتين مطلوب.',
                'protein.numeric' => 'حقل البروتين يجب أن يكون رقمًا',
                'protein.min' => 'حقل البروتين يجب أن يكون رقمًا موجبًا أو صفر',

                'carbs.required' => 'حقل الكربوهيدرات مطلوب.',
                'carbs.numeric' => 'حقل الكربوهيدرات يجب أن يكون رقمًا',
                'carbs.min' => 'حقل الكربوهيدرات يجب أن يكون رقمًا موجبًا أو صفر',

                'fats.required' => 'حقل الدهون مطلوب.',
                'fats.numeric' => 'حقل الدهون يجب أن يكون رقمًا',
                'fats.min' => 'حقل الدهون يجب أن يكون رقمًا موجبًا أو صفر',

                'level.required' => 'حقل المستوى مطلوب.',

                'plan_details.required' => 'حقل تفاصيل الخطة مطلوب.',
                'plan_details.string' => 'حقل تفاصيل الخطة يجب أن يكون نصًا.',

                'image.required' => 'حقل الصورة مطلوب.',
                'image.image' => 'الملف المرفق يجب أن يكون صورة.',
            ]
        );

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('meals', 'public');
        }

        $coachId = Auth::guard('employee')->id();

        $mainDiet = DietPlan::create([
            'coach_id'     => $coachId,
            'player_id'    => null,
            'level'        => $request->level,
            'meal_name'    => $request->meal_name,
            'calories'     => $request->calories,
            'protein'      => $request->protein,
            'carbs'        => $request->carbs,
            'fats'         => $request->fats,
            'image_path'   => $imagePath,
            'plan_details' => $request->plan_details,
            'start_date'   => now(),
            'end_date'     => now()->addMonth(),
        ]);

        $activePlayers = Player::where('coach_id', $coachId)
            ->where('level', $request->level)
            ->get();

        foreach ($activePlayers as $player) {
            DietPlan::create([
                'coach_id'     => $coachId,
                'player_id'    => $player->id,
                'level'        => $request->level,
                'meal_name'    => $request->meal_name,
                'calories'     => $request->calories,
                'protein'      => $request->protein,
                'carbs'        => $request->carbs,
                'fats'         => $request->fats,
                'image_path'   => $imagePath,
                'plan_details' => $request->plan_details,
                'start_date'   => now(),
                'end_date'     => now()->addMonth(),
            ]);
        }

        return redirect()->route('employee.diet.bank')->with('success', 'تم حفظ الوجبة وتعميمها لايف على جميع لاعبي مستوى ' . $request->level);
    }

    public function edit($id) {
        $dietPlan = DietPlan::whereNull('player_id')
            ->where('coach_id', Auth::guard('employee')->id())
            ->findOrFail($id);

        return view('Employee.DietBank.edit', compact('dietPlan'));
    }

    public function update(Request $request, $id){
        $dietPlan = DietPlan::whereNull('player_id')
            ->where('coach_id', Auth::guard('employee')->id())
            ->findOrFail($id);

           $request->validate(
            [
                'meal_name'    => 'required|string|max:255',
                'calories'     => 'required|numeric',
                'protein'      => 'required|numeric|min:0',
                'carbs'        => 'required|numeric|min:0',
                'fats'         => 'required|numeric|min:0',
                'level'        => 'required|string',
                'plan_details' => 'required|string',
                'image'        => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            ],
            [
                'meal_name.required' => 'حقل اسم الوجبة مطلوب.',
                'meal_name.string' => 'حقل اسم الوجبة يجب أن يكون نصًا.',
                'meal_name.max' => 'حقل اسم الوجبة يجب أن لا يتجاوز 255 حرفًا.',

                'calories.required' => 'حقل السعرات الحرارية مطلوب.',
                'calories.numeric' => 'حقل السعرات الحرارية يجب أن يكون رقمًا',

                'protein.required' => 'حقل البروتين مطلوب.',
                'protein.numeric' => 'حقل البروتين يجب أن يكون رقمًا',
                'protein.min' => 'حقل البروتين يجب أن يكون رقمًا موجبًا أو صفر',

                'carbs.required' => 'حقل الكربوهيدرات مطلوب.',
                'carbs.numeric' => 'حقل الكربوهيدرات يجب أن يكون رقمًا',
                'carbs.min' => 'حقل الكربوهيدرات يجب أن يكون رقمًا موجبًا أو صفر',

                'fats.required' => 'حقل الدهون مطلوب.',
                'fats.numeric' => 'حقل الدهون يجب أن يكون رقمًا',
                'fats.min' => 'حقل الدهون يجب أن يكون رقمًا موجبًا أو صفر',

                'level.required' => 'حقل المستوى مطلوب.',

                'plan_details.required' => 'حقل تفاصيل الخطة مطلوب.',
                'plan_details.string' => 'حقل تفاصيل الخطة يجب أن يكون نصًا.',

                'image.image' => 'الملف المرفق يجب أن يكون صورة.',
            ]
        );

        if ($request->hasFile('image')) {
            if ($dietPlan->image_path && Storage::disk('public')->exists($dietPlan->image_path)) {
                Storage::disk('public')->delete($dietPlan->image_path);
            }
            $dietPlan->image_path = $request->file('image')->store('meals', 'public');
        }

        $dietPlan->update([
            'meal_name'    => $request->meal_name,
            'calories'     => $request->calories,
            'protein'      => $request->protein,
            'carbs'        => $request->carbs,
            'fats'         => $request->fats,
            'level'        => $request->level,
            'plan_details' => $request->plan_details,
        ]);

        DietPlan::whereNotNull('player_id')
            ->where('coach_id', Auth::guard('employee')->id())
            ->where('level', $dietPlan->level)
            ->where('meal_name', $dietPlan->meal_name)
            ->where('calories', $dietPlan->calories)
            ->update([
                'meal_name'    => $request->meal_name,
                'calories'     => $request->calories,
                'protein'      => $request->protein,
                'carbs'        => $request->carbs,
                'fats'         => $request->fats,
                'level'        => $request->level,
                'plan_details' => $request->plan_details,
                'image_path'   => $dietPlan->image_path,
            ]);
        return redirect()->route('employee.diet.bank')->with('success', 'تم تعديل الوجبة وتحديثها لايف على جميع لاعبي مستوى ' . $request->level);
    }

    public function destroy($id) {
        $diet = DietPlan::whereNull('player_id')
            ->where('coach_id', Auth::guard('employee')->id())
            ->findOrFail($id);

        $imagePath = $diet->image_path;


        DietPlan::whereNotNull('player_id')
            ->where('coach_id', $diet->coach_id)
            ->where('level', $diet->level)
            ->where('meal_name', $diet->meal_name)
            ->where('calories', $diet->calories)
            ->delete();

        $diet->delete();

        if (!empty($imagePath)) {
            $imageStillUsed = DietPlan::where('image_path', $imagePath)->exists();

            if (!$imageStillUsed && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
        }

        return redirect()->route('employee.diet.bank')->with('success', 'تم حذف الوجبة من البنك ومن حسابات اللاعبين.');
    }
}
