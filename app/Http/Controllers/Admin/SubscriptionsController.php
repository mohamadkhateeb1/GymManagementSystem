<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Membership;
use App\Models\Player;
use App\Models\Payment;
use App\Models\PlanType;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SubscriptionsController extends Controller
{
    public function index()
    {
        $memberships = Membership::with('player')->latest()->paginate(15);

        // 🆕 الباقات المفعّلة — تُمرَّر للنافذة المنبثقة الموحّدة لكل صفحات التجديد
        $planTypes = PlanType::active()->orderBy('duration_days')->get();

        return view('Admin.Subscriptions.index', [
            'memberships' => $memberships,
            'planTypes'   => $planTypes,
        ]);
    }

    /**
     * 🔄 تجديد اشتراك — تابع موحّد واحد تناديه كل أزرار "تجديد" بالمشروع.
     * يستقبل plan_type_id من النافذة المنبثقة، فيسمح بتغيير نوع الباقة
     * بالكامل وقت التجديد، مو بس تكرار نفس الباقة القديمة.
     */
    public function renew(Request $request, $id)
    {
        $membership = Membership::findOrFail($id);

        $validated = $request->validate([
            'plan_type_id' => 'required|exists:plan_types,id',
        ]);

        $planType = PlanType::findOrFail($validated['plan_type_id']);

        $membership->update([
            'plan_type_id' => $planType->id,
            'plan_name'    => $planType->name,
            'start_date'   => Carbon::now(),
            'end_date'     => Carbon::now()->addDays($planType->duration_days),
            'status'       => 'active',
            'price_paid'   => $planType->price,
        ]);

        Payment::create([
            'player_id'     => $membership->player_id,
            'membership_id' => $membership->id,
            'plan_type_id'  => $planType->id,
            'amount'        => $planType->price,
            'type'          => 'renewal',
            'paid_at'       => Carbon::now(),
        ]);

        return back()->with('success', 'تم تجديد الاشتراك بنجاح — الباقة: ' . $planType->name);
    }

    public function store(Request $request)
    {
        $request->validate([
            'player_id' => 'required|exists:players,id',
            'plan_name' => 'required',
            'duration'  => 'required|integer', // عدد الأشهر
        ]);

        Membership::create([
            'player_id'  => $request->player_id,
            'plan_name'  => $request->plan_name,
            'start_date' => Carbon::now(),
            'end_date'   => Carbon::now()->addMonths($request->duration),
            'status'     => 'active',
        ]);

        return back()->with('success', 'تم إضافة الاشتراك بنجاح');
    }

    public function toggleStatus($id)
    {
        $membership = Membership::findOrFail($id);

        $newStatus = $membership->status === 'active' ? 'expired' : 'active';

        $membership->update([
            'status' => $newStatus
        ]);

        $message = $newStatus === 'expired'
            ? 'تم إلغاء تفعيل اشتراك اللاعب بنجاح وتجميد صلاحياته.'
            : 'تم إعادة تفعيل اشتراك اللاعب بنجاح.';

        return back()->with('success', $message);
    }


    public function toggleByPlayer(Player $player)
    {
        $membership = $player->subscription;

        if (! $membership) {
            return back()->with('error', 'هذا اللاعب لا يملك اشتراكاً لتجميده أو تفعيله.');
        }

        $newStatus = $membership->status === 'active' ? 'expired' : 'active';

        $membership->update([
            'status' => $newStatus,
        ]);

        $message = $newStatus === 'expired'
            ? 'تم إلغاء تفعيل اشتراك ' . $player->name . ' بنجاح وتجميد صلاحياته.'
            : 'تم إعادة تفعيل اشتراك ' . $player->name . ' بنجاح.';

        return back()->with('success', $message);
    }
}
