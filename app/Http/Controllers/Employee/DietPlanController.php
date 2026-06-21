<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\DietPlan;
use App\Models\Player; // استدعاء موديل اللاعبين
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DietPlanController extends Controller
{
    public function index()
    {
        $coachId = Auth::guard('employee')->id();

        $dietPlans = DietPlan::whereNull('player_id')
            ->where('coach_id', $coachId)
            ->latest()
            ->get();

        return view('Employee.DietBank.index', compact('dietPlans'));
    }

    // حفظ وجبة جديدة بالبنك وتنزيلها لايف للاعبين المربوطين بنفس المستوى
    public function store(Request $request)
    {
        $request->validate([
            'meal_name'    => 'required|string|max:255',
            'calories'     => 'required|numeric',
            'level'        => 'required|string',
            'plan_details' => 'required|string',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/meals'), $imageName);
            $imagePath = 'uploads/meals/' . $imageName;
        }

        $coachId = Auth::guard('employee')->id();

        // 1. حفظ الوجبة الأساسية بالبنك العام (player_id = null)
        $mainDiet = DietPlan::create([
            'coach_id'     => $coachId,
            'player_id'    => null,
            'level'        => $request->level,
            'meal_name'    => $request->meal_name,
            'calories'     => $request->calories,
            'image_path'   => $imagePath,
            'plan_details' => $request->plan_details,
            'start_date'   => now(),
            'end_date'     => now()->addMonth(),
        ]);

        // 2. الأتمتة الحية: جلب جميع اللاعبين التابعين لهذا المدرب والمربوطين بهذا المستوى حالياً
        $activePlayers = Player::where('coach_id', $coachId)
            ->where('level', $request->level)
            ->get();

        // 3. نسخ وإسقاط الوجبة فوراً في حساباتهم لايف
        foreach ($activePlayers as $player) {
            DietPlan::create([
                'coach_id'     => $coachId,
                'player_id'    => $player->id, // تسند للاعب مباشرة
                'level'        => $request->level,
                'meal_name'    => $request->meal_name,
                'calories'     => $request->calories,
                'image_path'   => $imagePath,
                'plan_details' => $request->plan_details,
                'start_date'   => now(),
                'end_date'     => now()->addMonth(),
            ]);
        }

        return redirect()->route('employee.diet.bank')->with('success', 'تم حفظ الوجبة وتعميمها لايف على جميع لاعبي مستوى ' . $request->level);
    }

    public function destroy($id)
    {
        $diet = DietPlan::whereNull('player_id')
            ->where('coach_id', Auth::guard('employee')->id())
            ->findOrFail($id);

        if (!empty($diet->image_path) && file_exists(public_path($diet->image_path))) {
            unlink(public_path($diet->image_path));
        }

        DietPlan::whereNotNull('player_id')
            ->where('coach_id', $diet->coach_id)
            ->where('level', $diet->level)
            ->where('meal_name', $diet->meal_name)
            ->where('calories', $diet->calories)
            ->delete();

        $diet->delete();

        return redirect()->route('employee.diet.bank')->with('success', 'تم حذف الوجبة من البنك ومن حسابات اللاعبين.');
    }
}
