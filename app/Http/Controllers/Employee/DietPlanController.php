<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\DietPlan;
use App\Models\Player; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

    public function store(Request $request)
    {
        $request->validate([
            'meal_name'    => 'required|string|max:255',
            'calories'     => 'required|numeric',
            'protein'      => 'nullable|numeric|min:0',
            'carbs'        => 'nullable|numeric|min:0',
            'fats'         => 'nullable|numeric|min:0',
            'level'        => 'required|string',
            'plan_details' => 'required|string',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

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

    public function destroy($id)
    {
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