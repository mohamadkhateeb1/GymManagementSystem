<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MiscController extends Controller
{
    /**
     * 👤 بيانات المستخدم الحالي (Sanctum) — تُستخدم غالباً للتحقق من صلاحية التوكن.
     */
    public function currentUser(Request $request)
    {
        return $request->user();
    }

    /**
     * 🖼️ تقديم ملف وسائط (صور اللاعبين، الوجبات، إلخ) من storage/app/public
     * بلا الحاجة لرابط رمزي (symlink) مباشر — يفيد بالذات على بعض الاستضافات.
     */
    public function serveMedia(string $path)
    {
        $fullPath = storage_path('app/public/' . $path);

        if (! file_exists($fullPath)) {
            abort(404);
        }

        return response()->file($fullPath, [
            'Access-Control-Allow-Origin' => '*',
        ]);
    }
}