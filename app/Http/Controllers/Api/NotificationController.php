<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * 🔔 جلب إشعارات اللاعب الحالي وإرسالها للتطبيق.
     *
     *   GET {apiBaseUrl}/notifications   (يتطلب Authorization: Bearer التوكن)
     *   نجاح 200: { "notifications": [{ "type","title","body" }] }
     *
     * ⚠️ بمجرد ما يرجّع الإشعار بالرد، ينحذف فوراً من الجدول — يعني كل إشعار
     * بينبعت مرة وحدة بس، وما بيتكرر إرساله للتطبيق مرة ثانية.
     */
    public function index(Request $request)
    {
        /** @var \App\Models\Player $player */
        $player = $request->user();

        $notifications = Notification::where('player_id', $player->id)->get();

        $payload = $notifications->map(function (Notification $n) {
            return [
                'type'  => $n->type,
                'title' => $n->title,
                'body'  => $n->body,
            ];
        })->values();

        // 🗑️ حذف فوري بعد التجهيز للإرسال — ضمان عدم تكرار نفس الإشعار لاحقاً
        Notification::where('player_id', $player->id)->delete();

        return response()->json([
            'notifications' => $payload,
        ], 200);
    }
}