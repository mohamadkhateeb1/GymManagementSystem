<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WorkoutController extends Controller
{
   
    public function index(Request $request)
    {
        /** @var \App\Models\Player $player */
        $player = $request->user();

        $exercises = $player->trainingPlans()
            ->with(['exercises' => function ($query) {
                $query->orderByRaw('day_of_week IS NULL, day_of_week ASC')->orderBy('order');
            }])
            ->get()
            ->pluck('exercises')  
            ->flatten()           
            ->map(function ($exercise) {
                return [
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
                ];
            })
            ->values();

        return response()->json([
            'exercises' => $exercises,
        ], 200);
    }
}