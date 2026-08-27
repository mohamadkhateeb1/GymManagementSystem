<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AttendanceLog;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
 
    public function checkIn(Request $request)
    {
        /** @var \App\Models\Player $player */
        $player = $request->user();

        $log = AttendanceLog::recordToday($player->id, 'app');

        $message = $log->wasRecentlyCreated
            ? 'تم تسجيل حضورك بنجاح'
            : 'لقد سجّلت حضورك اليوم مسبقاً';

        return response()->json([
            'message'     => $message,
            'attended_at' => $log->attended_at->toDateTimeString(),
        ], 200);
    }
}