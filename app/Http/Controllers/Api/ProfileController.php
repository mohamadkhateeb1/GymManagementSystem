<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function show(Request $request)
    {
        /** @var \App\Models\Player $player */
        $player = $request->user();
        $player->loadMissing('coach');

        return response()->json([
            'id'            => $player->id,
            'name'          => $player->name,
            'email'         => $player->email,
            'phone'         => $player->phone,
            'level'         => $player->level,
            'height'        => $player->height,
            'weight'        => $player->weight,
            'date_of_birth' => optional($player->date_of_birth)->toDateString(),
            'coach_name'    => $player->coach->name ?? null,
            'joined_at'     => $player->created_at->toDateString(),
        ], 200);
    }

    public function updatePassword(Request $request)
    {
        /** @var \App\Models\Player $player */
        $player = $request->user();

        $validator = Validator::make($request->all(), [
            'current_password' => 'required|string',
            'password'         => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
            ], 422);
        }

        if (! Hash::check($request->current_password, $player->password)) {
            return response()->json([
                'message' => 'كلمة المرور الحالية غير صحيحة.',
            ], 401);
        }

        $player->update(['password' => Hash::make($request->password)]);

        return response()->json([
            'message' => 'تم تغيير كلمة المرور بنجاح.',
        ], 200);
    }
}