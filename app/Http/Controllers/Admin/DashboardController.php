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

        
        $employeesCount = Employee::count();
        $playersCount   = Player::count();

        // وتاريخ الانتهاء بعد الآن (active) هيئة الاشتراكات النشطة: حالتها 
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

      
        $coaches   = Employee::all();
        $employees = Employee::with('roles')->latest()->get();

        
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

        return view('Admin.Dashboard', compact(
            'employees',
            'employeesCount',
            'playersCount',
            'players',
            'coaches',
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
