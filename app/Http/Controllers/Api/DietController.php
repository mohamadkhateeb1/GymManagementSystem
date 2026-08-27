<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DietController extends Controller
{
    public function index(Request $request)
    {
        /** @var \App\Models\Player $player */
        $player = $request->user();

        $meals = $player->dietPlans()
            ->latest()
            ->get()
            ->map(function ($meal) {
                return [
                    'id'           => $meal->id,
                    'meal_name'    => $meal->meal_name,
                    'calories'     => $meal->calories,
                    'protein'      => $meal->protein,
                    'carbs'        => $meal->carbs,
                    'fats'         => $meal->fats,
                    'plan_details' => $meal->plan_details,
                    'image_url'    => $meal->image_path ? url('/api/media/' . $meal->image_path) : null,
                ];
            })
            ->values();

        return response()->json([
            'meals' => $meals,
        ], 200);
    }
}