<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
  
    public function show(Request $request)
    {
        /** @var \App\Models\Player $player */
        $player = $request->user();

        $membership = $player->subscription;

        if (! $membership) {
            return response()->json([
                'message' => 'لا يوجد اشتراك مسجَّل لهذا اللاعب بعد.',
            ], 404);
        }

        return response()->json([
            'plan_name'  => $membership->plan_name,
            'start_date' => $membership->start_date->toDateString(),
            'end_date'   => $membership->end_date->toDateString(),
            'status'     => $membership->status,
            'is_active'  => $player->hasActiveSubscription(),
        ], 200);
    }
}