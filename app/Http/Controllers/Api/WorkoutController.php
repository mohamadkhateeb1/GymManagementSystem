<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WorkoutController extends Controller
{
    /**
     * 🏋️ عرض كل تمارين اللاعب المسجَّل دخوله، من جميع خططه التدريبية
     * (النازلة من البنك + التمارين الخاصة معاً)، مجمَّعة بمصفوفة واحدة
     * مسطّحة. حقل is_custom يميّز مصدر كل تمرين، ليقرر التطبيق لاحقاً
     * هل يعرضهم بقسم واحد أو قسمين منفصلين.
     */
    public function index(Request $request)
    {
        /** @var \App\Models\Player $player */
        $player = $request->user();

        $trainingPlans = $player->trainingPlans()
            ->with(['exercises' => function ($query) {
                $query->orderByRaw('day_of_week IS NULL, day_of_week ASC')->orderBy('order');
            }])
            ->get();

        $exercises = collect();

        foreach ($trainingPlans as $plan) {
            foreach ($plan->exercises as $exercise) {
                $exercises->push([
                    'id'           => $exercise->id,
                    'name'         => $exercise->name,
                    'sets'         => $exercise->sets,
                    'reps'         => $exercise->reps,
                    'rest_time'    => $exercise->rest_time,
                    'day_of_week'  => $exercise->day_of_week,
                    'order'        => $exercise->order,
                    'video_url'    => $exercise->video_url,
                    'image_url'    => $exercise->image_path ? url('/api/media/' . $exercise->image_path) : null,
                    'instructions' => $exercise->instructions,
                    // 🆕 true = تمرين خاص أضافه المدرب يدوياً لهذا اللاعب تحديداً
                    // false = نازل من بنك المستوى العام
                    'is_custom'    => (bool) $plan->is_custom,
                ]);
            }
        }

        return response()->json([
            'exercises' => $exercises->values(),
        ], 200);
    }
}