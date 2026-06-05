<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Player;
use App\Models\Membership; 
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $now = Carbon::now();

        /* ============================================================
         |  الإحصائيات العامة (تخص النادي كله ومستقلة عن فلترة الجدول)
         |  هذه هي القيم التي تغذّي كاردات الـ KPI والمخطط الدائري.
         * ============================================================ */
        $employeesCount = Employee::count();
        $playersCount   = Player::count();

        // اشتراكات فعّالة: حالتها active وتاريخ انتهائها لم يمرّ بعد
        $activeCount = Player::whereHas('subscription', function ($q) use ($now) {
            $q->where('status', 'active')->where('end_date', '>', $now);
        })->count();

        // اشتراكات منتهية: حالتها active لكن تاريخ الانتهاء مرّ
        $expiredCount = Player::whereHas('subscription', function ($q) use ($now) {
            $q->where('status', 'active')->where('end_date', '<=', $now);
        })->count();

        // لاعبون بدون أي اشتراك
        $noneCount = Player::whereDoesntHave('subscription')->count();

        // النسب المئوية
        $totalSubs  = $activeCount + $expiredCount + $noneCount;
        $activePct  = $totalSubs ? (int) round(($activeCount / $totalSubs) * 100) : 0;
        $expiredPct = $totalSubs ? (int) round(($expiredCount / $totalSubs) * 100) : 0;
        $nonePct    = $totalSubs ? max(0, 100 - $activePct - $expiredPct) : 0;

        // نقطة توقّف المخطط الدائري (تراكميًا) — جاهزة للعرض مباشرةً
        $donutExpiredStop = $activePct + $expiredPct;

        /* ============================================================
         |  قوائم الجداول
         * ============================================================ */
        $coaches   = Employee::all();
        $employees = Employee::with('roles')->latest()->get();

        /* ============================================================
         |  جدول اللاعبين (متأثر بالفلترة)
         * ============================================================ */
        $query = Player::query()->with(['coach', 'subscription']);

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('coach_id')) {
            $query->where('coach_id', $request->coach_id);
        }

        if ($request->filled('subscription_status')) {
            if ($request->subscription_status === 'active') {
                $query->whereHas('subscription', function ($q) use ($now) {
                    $q->where('status', 'active')->where('end_date', '>', $now);
                });
            } elseif ($request->subscription_status === 'expired') {
                $query->whereHas('subscription', function ($q) use ($now) {
                    $q->where('status', 'active')->where('end_date', '<=', $now);
                });
            }
        }

        $players = $query->latest()->get();

        /* ============================================================
         |  تمرير البيانات الجاهزة للعرض
         * ============================================================ */
        return view('Admin.Dashboard', compact(
            'employees',
            'employeesCount',
            'playersCount',
            'players',
            'coaches',
            // إحصائيات جاهزة للعرض
            'activeCount',
            'expiredCount',
            'noneCount',
            'totalSubs',
            'activePct',
            'expiredPct',
            'nonePct',
            'donutExpiredStop'
        ));
    }
}
