<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MiscController extends Controller
{
    /**
     * 👤 بيانات المستخدم الحالي (Sanctum)
     */
    public function currentUser(Request $request)
    {
        return $request->user();
    }

    /**
     * 🖼️ تقديم ملف وسائط بأمان من storage/app/public
     */
    public function serveMedia(string $path)
    {
        $basePath = realpath(storage_path('app/public'));

        if ($basePath === false) {
            abort(404);
        }

        $fullPath = realpath(storage_path('app/public/' . $path));

        if (
            $fullPath === false ||
            ! is_file($fullPath) ||
            ! str_starts_with(
                $fullPath,
                $basePath . DIRECTORY_SEPARATOR
            )
        ) {
            abort(404);
        }

        return response()->file($fullPath, [
            'Access-Control-Allow-Origin' => '*',
        ]);
    }
}