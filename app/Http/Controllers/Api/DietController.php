<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DietController extends Controller
{
    /**
     * 🍽️ عرض كل وجبات اللاعب المسجَّل دخوله (نازلة من البنك + خاصة معاً).
     * حقل is_custom يميّز مصدر كل وجبة، ليقرر التطبيق لاحقاً هل يعرضهم
     * بقسم واحد أو قسمين منفصلين (تماماً مثل صفحة ملف اللاعب في الموقع).
     */
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
                    // 🆕 true = وجبة خاصة أضافها المدرب يدوياً لهذا اللاعب تحديداً
                    // false = نازلة من بنك المستوى العام
                    'is_custom'    => (bool) $meal->is_custom,
                ];
            })
            ->values();

        return response()->json([
            'meals' => $meals,
        ], 200);
    }
}