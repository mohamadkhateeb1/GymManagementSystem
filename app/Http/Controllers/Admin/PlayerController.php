<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Player;
use App\Models\PlanType;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PlayerController extends Controller
{
    use AuthorizesRequests;
    //index
    public function index(Request $request)  {
        $players = Player::with('subscription')
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->when($request->filled('coach_id'), function ($query) use ($request) {
                $query->where('coach_id', $request->coach_id);
            })
            ->when($request->filled('subscription_status'), function ($query) use ($request) {
                if ($request->subscription_status === 'active') {
                    $query->whereHas('subscription', function ($q) {
                        $q->where('status', 'active')->whereDate('end_date', '>=', now());
                    });
                } elseif ($request->subscription_status === 'expired') {
                    $query->whereHas('subscription', function ($q) {
                        $q->where(function ($qq) {
                            $qq->where('status', '!=', 'active')
                                ->orWhereDate('end_date', '<', now());
                        });
                    });
                } elseif ($request->subscription_status === 'none') {
                    $query->doesntHave('subscription');
                }
            })
            ->latest()
            ->get();

        return view('Admin.Players.index', [
            'players' => $players,
            'coaches' => Employee::all(),
        ]);
    }
    //create
    public function create()  {
        $coaches = Employee::all();
        $planTypes = PlanType::active()->orderBy('duration_days')->get();

        return view('Admin.Players.create', [
            'coaches' => $coaches,
            'planTypes' => $planTypes,
        ]);
    }
    //store
    public function store(Request $request) {
        $validated = $request->validate(
            [
                'name'          => 'required|string|max:255',
                'email'         => 'required|email|unique:players,email',
                'password'      => 'required|min:8',
                'date_of_birth' => 'nullable|date',
                'height'        => 'nullable|numeric',
                'weight'        => 'nullable|numeric',
                'phone'         => 'required|numeric',
                'coach_id'      => 'nullable|exists:employees,id',
                'plan_type_id'  => 'required|exists:plan_types,id',
            ],
            [
                //name
                'name.required' => 'حقل الاسم مطلوب.',
                'name.string' => 'حقل الاسم يجب أن يكون نصًا.',
                //email
                'email.required' => 'حقل البريد الإلكتروني مطلوب.',
                'email.email' => 'يرجى إدخال بريد إلكتروني صالح.',
                'email.unique' => 'البريد الإلكتروني مستخدم بالفعل.',
                //password
                'password.required' => 'حقل كلمة المرور مطلوب.',
                'password.min' => 'كلمة المرور يجب أن تكون على الأقل 8 أحرف.',
                //date_of_birth
                'date_of_birth.date' => 'يرجى إدخال تاريخ ميلاد صالح.',
                //height
                'height.numeric' => 'الطول يجب أن يكون رقماً.',
                'weight.numeric' => 'الوزن يجب أن يكون رقماً.',
                //phone
                'phone.required' => 'حقل رقم الهاتف مطلوب.',
                'phone.numeric' => 'رقم الهاتف يجب أن يكون رقماً.',
                //coach_id
                'coach_id.exists' => 'المدرب المحدد غير موجود.',
                //plan_type_id
                'plan_type_id.required' => 'حقل نوع الباقة مطلوب.',
                'plan_type_id.exists' => 'نوع الباقة المحدد غير موجود.'
            ]
        );

        $planType = PlanType::findOrFail($request->plan_type_id);

        $validated['password'] = Hash::make($validated['password']);

        // ℹ️ $validated يحتوي أيضاً على plan_type_id (لأنه من قواعد validate أعلاه)،
        // لكن Player::create تتجاهله تلقائياً لأنه غير موجود ضمن $fillable في موديل Player،
        // فلا داعٍ لحذفه يدوياً من المصفوفة.
        $player = Player::create($validated);

        $membership = $player->subscription()->create([
            'plan_type_id' => $planType->id,
            'plan_name'    => $planType->name, // نسخة نصية للعرض المباشر في الشاشات القديمة (لوحة التحكم مثلاً)
            'price_paid'   => $planType->price,
            'start_date'   => Carbon::now(),
            'end_date'     => Carbon::now()->addDays($planType->duration_days),
            'status'       => 'active',
        ]);

        // 💰 تسجيل الدفعة الأولى في السجل المالي الدائم (منفصل عن حالة الاشتراك نفسها)
        Payment::create([
            'player_id'     => $player->id,
            'membership_id' => $membership->id,
            'plan_type_id'  => $planType->id,
            'amount'        => $planType->price,
            'type'          => 'new',
            'paid_at'       => Carbon::now(),
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'تم إضافة اللاعب بنجاح');
    }
    //edit
    public function edit($id){
        $coaches = Employee::all();
        $planTypes = PlanType::active()->orderBy('duration_days')->get();
        $player = Player::with('subscription')->findOrFail($id);

        return view('Admin.Players.edit', [
            'coaches' => $coaches,
            'planTypes' => $planTypes,
            'player' => $player
        ]);
    }
    //update
    public function update(Request $request, $id){
        $player = Player::findOrFail($id);

        $validated = $request->validate(
            [
                'name'          => 'required|string|max:255',
                'email'         => 'required|email|unique:players,email,' . $player->id,
                'password'      => 'nullable|min:6',
                'date_of_birth' => 'nullable|date',
                'height'        => 'nullable|numeric',
                'weight'        => 'nullable|numeric',
                'phone'         => 'nullable|string|max:20',
                'coach_id'      => 'nullable|exists:employees,id',
                'plan_type_id'  => 'required|exists:plan_types,id',
            ],
            [
                'name.required' => 'حقل الاسم مطلوب.',
                'name.string' => 'حقل الاسم يجب أن يكون نصًا.',
                'email.required' => 'حقل البريد الإلكتروني مطلوب.',
                'email.email' => 'يرجى إدخال بريد إلكتروني صالح.',
                'email.unique' => 'البريد الإلكتروني مستخدم بالفعل.',
                'password.min' => 'كلمة المرور يجب أن تكون على الأقل 6 أحرف.',
                'date_of_birth.date' => 'يرجى إدخال تاريخ ميلاد صالح.',
                'height.numeric' => 'الطول يجب أن يكون رقماً.',
                'weight.numeric' => 'الوزن يجب أن يكون رقماً.',
                'phone.string' => 'رقم الهاتف يجب أن يكون نصًا.',
                'phone.max' => 'رقم الهاتف يجب ألا يزيد عن 20 حرفًا.',
                'coach_id.exists' => 'المدرب المحدد غير موجود.',
                'plan_type_id.required' => 'حقل نوع الباقة مطلوب.',
                'plan_type_id.exists' => 'نوع الباقة المحدد غير موجود.'
            ]
        );

        $planType = PlanType::findOrFail($request->plan_type_id);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        } else {
            unset($validated['password']);
        }
        $player->update($validated);

        // 🛡️ نحدد اسم الجدول صراحة (memberships.player_id) لأن subscription()
        // أصبحت تستخدم latestOfMany() التي تبني الاستعلام بـ JOIN داخلي，
        // فيصبح عمود player_id مبهماً (Ambiguous) بين memberships والـ subquery
        // ما لم يُحدَّد الجدول بوضوح.
        $player->subscription()->updateOrCreate(
            ['memberships.player_id' => $player->id],
            [
                'plan_type_id' => $planType->id,
                'plan_name'    => $planType->name,
                'price_paid'   => $planType->price,
                'start_date'   => Carbon::now(),
                'end_date'     => Carbon::now()->addDays($planType->duration_days),
                'status'       => 'active',
            ]
        );

        return redirect()->route('admin.dashboard')->with('success', 'تم تحديث بيانات اللاعب واشتراكه بنجاح.');
    }
    //show
    public function show($id){
        $player = Player::findOrFail($id);
        $player->load('coach', 'subscription');

        // 🆕 الباقات المفعّلة — للنافذة المنبثقة الموحّدة عند التجديد
        $planTypes = PlanType::active()->orderBy('duration_days')->get();

        return view('Admin.Players.show', compact('player', 'planTypes'));
    }
    //destroy
    public function destroy(Player $player){
        $player->forceDelete();
        return redirect()->route('players.index')->with('success', 'تم حذف اللاعب نهائياً من النظام.');
    }
    //destroy_all
    public function destroy_all(){
        if(!$this->authorize('forceDelete', Player::class)) {
            abort(403);
        }
        $players = Player::all();
        if ($players->isEmpty()) {
            return redirect()->route('players.index')->with('success', 'لا يوجد لاعبون لحذفهم.');
        }
        foreach ($players as $player) {
            $player->forceDelete();
        }
        return redirect()->route('players.index')->with('success', 'تم حذف جميع اللاعبين نهائياً من النظام.');
    }
}
