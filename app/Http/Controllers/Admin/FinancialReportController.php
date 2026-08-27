<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FinancialReportController extends Controller
{
    public function index(Request $request)
    {
        $month = $request->filled('month')
            ? Carbon::createFromFormat('Y-m', $request->month)->startOfMonth()
            : now()->startOfMonth();

        $monthTotal = Payment::inMonth($month)->sum('amount');

        $newCount     = Payment::inMonth($month)->where('type', 'new')->count();
        $renewalCount = Payment::inMonth($month)->where('type', 'renewal')->count();

        $allTimeTotal = Payment::sum('amount');

        $payments = Payment::with(['player', 'planType'])
            ->inMonth($month)
            ->latest('paid_at')
            ->paginate(20)
            ->withQueryString();

        return view('Admin.FinancialReports.index', compact(
            'payments',
            'month',
            'monthTotal',
            'newCount',
            'renewalCount',
            'allTimeTotal'
        ));
    }
}