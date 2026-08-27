<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Player;
use App\Models\Membership;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $now = Carbon::now();

        $employeesCount = Employee::count();

        $stats = Player::query()
            ->leftJoin('memberships', function ($join) {
                $join->on('memberships.id', '=', DB::raw('(
                    SELECT MAX(m.id) FROM memberships m
                    WHERE m.player_id = players.id AND m.deleted_at IS NULL
                )'));
            })
            ->selectRaw("
                COUNT(DISTINCT players.id) as total,
                SUM(CASE WHEN memberships.status = 'active' AND memberships.end_date > ? THEN 1 ELSE 0 END) as active_count,
                SUM(CASE WHEN memberships.status = 'active' AND memberships.end_date <= ? THEN 1 ELSE 0 END) as expired_count,
                SUM(CASE WHEN memberships.id IS NULL THEN 1 ELSE 0 END) as none_count
            ", [$now, $now])
            ->first();

        $playersCount = (int) $stats->total;
        $activeCount  = (int) $stats->active_count;
        $expiredCount = (int) $stats->expired_count;
        $noneCount    = (int) $stats->none_count;

        $totalSubs  = $activeCount + $expiredCount + $noneCount;
        $activePct  = $totalSubs ? (int) round(($activeCount / $totalSubs) * 100) : 0;
        $expiredPct = $totalSubs ? (int) round(($expiredCount / $totalSubs) * 100) : 0;
        $nonePct    = $totalSubs ? max(0, 100 - $activePct - $expiredPct) : 0;

        $donutExpiredStop = $activePct + $expiredPct;

        $monthRevenue = Payment::inMonth($now)->sum('amount');

        $lastMonthRevenue = Payment::inMonth($now->copy()->subMonth())->sum('amount');
        $revenueChangePct = $lastMonthRevenue > 0
            ? round((($monthRevenue - $lastMonthRevenue) / $lastMonthRevenue) * 100)
            : ($monthRevenue > 0 ? 100 : 0);

        $monthlyRevenue = collect(range(5, 0))->map(function ($monthsAgo) use ($now) {
            $month = $now->copy()->subMonths($monthsAgo);

            return [
                'label' => $month->translatedFormat('M'),
                'total' => (float) Payment::inMonth($month)->sum('amount'),
            ];
        })->values();

        $expiringSoonCount = Membership::where('status', 'active')
            ->whereBetween('end_date', [$now->toDateString(), $now->copy()->addDays(7)->toDateString()])
            ->count();

        $coaches = Employee::all();

        $employees = Employee::with(['roles', 'attendanceLogs' => function ($q) use ($now) {
            $q->whereDate('attendance_date', $now->toDateString());
        }])->latest()->get();


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

        $players = $query->latest()->paginate(15)->withQueryString();

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
            'donutExpiredStop',
            'monthRevenue',
            'revenueChangePct',
            'monthlyRevenue',
            'expiringSoonCount'
        ));
    }
}
