<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FinancialArchive;
use App\Models\Membership;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FinancialArchiveController extends Controller
{
   
    public function index(Request $request)
    {
        $type = $request->get('type');

        $archives = FinancialArchive::query()
            ->when($type, fn ($q) => $q->ofType($type))
            ->latest('archived_at')
            ->paginate(20)
            ->withQueryString();

        return view('Admin.FinancialArchive.index', compact('archives', 'type'));
    }

   
    public function archiveMembership(Membership $membership)
    {
        $membership->loadMissing('player', 'planType');

        $playerName = $membership->player->name ?? 'لاعب محذوف';

        FinancialArchive::create([
            'archivable_type' => 'membership',
            'archivable_id'   => $membership->id,
            'title'           => 'اشتراك: ' . $playerName . ' - ' . $membership->plan_name,
            'player_name'     => $playerName,
            'payload'         => $membership->toArray(),
            'archived_by'     => Auth::guard('admin')->id(),
            'archived_at'     => now(),
        ]);

        return back()->with('success', 'تم رفع اشتراك "' . $playerName . '" إلى الأرشيف بشكل دائم.');
    }

    public function archivePayment(Payment $payment)
    {
        $payment->loadMissing('player', 'planType');

        $playerName = $payment->player->name ?? 'لاعب محذوف';

        FinancialArchive::create([
            'archivable_type' => 'payment',
            'archivable_id'   => $payment->id,
            'title'           => 'دفعة: ' . $playerName . ' - ' . number_format($payment->amount, 2),
            'player_name'     => $playerName,
            'payload'         => $payment->toArray(),
            'archived_by'     => Auth::guard('admin')->id(),
            'archived_at'     => now(),
        ]);

        return back()->with('success', 'تم رفع دفعة "' . $playerName . '" إلى الأرشيف بشكل دائم.');
    }
}