<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
  
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
            ], 422);
        }

        $player = Player::where('email', $request->email)->first();

        if (! $player || ! Hash::check($request->password, $player->password)) {
            return response()->json([
                'message' => 'بيانات الدخول غير صحيحة، راجع الكوتش.',
            ], 401);
        }


        $token = $player->createToken('tiger-app-token')->plainTextToken;

        return response()->json([
            'token'  => $token,
            'player' => [
                'id'    => $player->id,
                'name'  => $player->name,
                'email' => $player->email,
                'phone' => $player->phone,
                'level' => $player->level,
            ],
        ], 200);
    }
}