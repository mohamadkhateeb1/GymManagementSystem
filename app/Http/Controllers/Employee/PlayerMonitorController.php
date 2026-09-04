<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Player;
use App\Models\TrainingPlan;
use App\Models\DietPlan;
use App\Models\BodyProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PlayerMonitorController extends Controller
{

    private function findMyPlayer($id, array $relations = []): Player
    {
        return Player::where('coach_id', Auth::guard('employee')->id())
            ->with($relations)
            ->findOrFail($id);
    }


    private function copyExercises(TrainingPlan $source, TrainingPlan $target): void
    {
        foreach ($source->exercises as $exercise) {
            $target->exercises()->create($exercise->only([
                'name',
                'sets',
                'reps',
                'rest_time',
                'day_of_week',
                'order',
                'instructions',
                'image_path',
                'video_url',
            ]));
        }
    }

    /**
     * 📦 يجيب (أو ينشئ لو أول مرة) الحاوية المخفية الوحيدة لتمارين هذا اللاعب
     * الخاصة — المدرب لا يتعامل معها إطلاقاً كـ"خطة"، هي تفصيل تقني داخلي
     * بس حتى نحتفظ بنفس بنية جدول plans (لازم كل تمرين ينتمي لخطة).
     */
    private function getOrCreateCustomContainer(Player $player, int $coachId): TrainingPlan
    {
        return TrainingPlan::firstOrCreate(
            [
                'player_id'  => $player->id,
                'coach_id'   => $coachId,
                'is_custom'  => true,
            ],
            [
                'title'      => 'تمارين خاصة',
                'level'      => $player->level,
                'start_date' => now(),
                'end_date'   => now()->addYears(10), // لا تنتهي فعلياً، هي حاوية دائمة
            ]
        );
    }

    public function index()
    {
        $coachId = Auth::guard('employee')->id();

        $players = Player::where('coach_id', $coachId)
            ->with('subscription')
            ->select('players.*')

            ->selectSub(function ($query) {
                $query->from('body_progress')
                    ->whereColumn('body_progress.player_id', 'players.id')
                    ->latest()
                    ->limit(1)
                    ->select('weight');
            }, 'progress_weight')

            ->selectSub(function ($query) {
                $query->from('player_ratings')
                    ->whereColumn('player_ratings.player_id', 'players.id')
                    ->selectRaw('AVG(rating)');
            }, 'average_rating')

            ->get()

            ->map(function ($player) {
                $player->latest_weight = $player->progress_weight ?? $player->weight;
                return $player;
            });

        return view('Employee.monitoring.index', compact('players'));
    }

    public function assignLevel(Request $request, $playerId)
    {
        $request->validate([
            'level' => 'required|string',
        ]);

        $player = $this->findMyPlayer($playerId, ['subscription']);
        $coachId = Auth::guard('employee')->id();

        if (!$player->hasActiveSubscription()) {
            return redirect()->back()->with('error', 'لا يمكن جدولة أو أتمتة الخطط للاعب اشتراكه مجمد أو منتهي.');
        }

        $player->update([
            'level' => $request->level,
        ]);

        $templateTrainingPlans = TrainingPlan::where('level', $request->level)->whereNull('player_id')->with('exercises')->get();
        $templateDietPlans = DietPlan::where('level', $request->level)->whereNull('player_id')->get();

        foreach ($templateTrainingPlans as $templatePlan) {
            if ($templatePlan->exercises->isEmpty()) {
                continue;
            }

            TrainingPlan::whereNotNull('player_id')
                ->where('player_id', $player->id)
                ->where('coach_id', $coachId)
                ->where('level', $request->level)
                ->where('is_custom', false) // ✅ لا نمس أبداً حاوية التمارين الخاصة عند إعادة التنزيل
                ->where('title', $templatePlan->title)
                ->delete();

            $playerPlan = TrainingPlan::create([
                'coach_id'     => $coachId,
                'player_id'    => $player->id,
                'is_custom'    => false,
                'title'        => $templatePlan->title,
                'level'        => $request->level,
                'start_date'   => now(),
                'end_date'     => now()->addMonths(1),
            ]);

            $this->copyExercises($templatePlan, $playerPlan);
        }

        foreach ($templateDietPlans as $templateDiet) {
            DietPlan::create([
                'coach_id'     => $coachId,
                'player_id'    => $player->id,
                'is_custom'    => false,
                'level'        => $request->level,
                'meal_name'    => $templateDiet->meal_name,
                'calories'     => $templateDiet->calories,
                'protein'      => $templateDiet->protein,
                'carbs'        => $templateDiet->carbs,
                'fats'         => $templateDiet->fats,
                'image_path'   => $templateDiet->image_path,
                'plan_details' => $templateDiet->plan_details,
                'start_date'   => now(),
                'end_date'     => now()->addMonths(1),
            ]);
        }

        return redirect()->back()->with('success', 'تم تحديث مستوى اللاعب وتنزيل حزمة الخطط التدريبية والغذائية للمستوى تلقائياً.');
    }

    public function show($id)
    {
        $player = $this->findMyPlayer($id, [
            'subscription',
            // 📋 الخطط النازلة من البنك العام فقط — الحاوية الخاصة مستبعدة هنا عمداً
            'trainingPlans' => function ($query) {
                $query->where('is_custom', false)->latest();
            },
            'dietPlans' => function ($query) {
                $query->where('is_custom', false)->latest();
            },
            'bodyProgress' => function ($query) {
                $query->latest();
            },
        ]);

        // 🏋️ التمارين الخاصة: قائمة مسطّحة مباشرة (بلا كروت "خطط")
        $customExercises = \App\Models\Plan::whereHas('trainingPlan', function ($q) use ($player) {
            $q->where('player_id', $player->id)
                ->where('coach_id', Auth::guard('employee')->id())
                ->where('is_custom', true);
        })
            ->orderByRaw('day_of_week IS NULL, day_of_week ASC')
            ->orderBy('order')
            ->get();

        // 🍽️ الوجبات الخاصة: قائمة مسطّحة منفصلة عن البرنامج المعتمد من البنك
        $customDiets = DietPlan::where('player_id', $player->id)
            ->where('coach_id', Auth::guard('employee')->id())
            ->where('is_custom', true)
            ->latest()
            ->get();

        $ratings = DB::table('player_ratings')
            ->where('player_id', $player->id)
            ->latest()
            ->get();

        return view('Employee.monitoring.show', compact('player', 'ratings', 'customExercises', 'customDiets'));
    }

    /**
     * 🔔 إرسال إشعار "اقتراب انتهاء الاشتراك" — بضغطة زر يدوية من المدرب،
     * يظهر بس لما يشوف اشتراك اللاعب قرب ينتهي.
     */
    public function sendExpiringNotification($playerId)
    {
        $player = $this->findMyPlayer($playerId, ['subscription']);

        \App\Models\Notification::create([
            'player_id' => $player->id,
            'type'      => 'subscription_expiring',
            'title'     => 'اشتراكك على وشك الانتهاء',
            'body'      => 'اشتراكك سينتهي قريباً بتاريخ ' . optional($player->subscription)->end_date . '. جدّده الآن لتجنّب انقطاع الخدمة.',
        ]);

        return redirect()->back()->with('success', 'تم إرسال تذكير اقتراب انتهاء الاشتراك للاعب.');
    }

    /**
     * 🔔 إرسال إشعار "انتهاء الاشتراك" — بضغطة زر يدوية من المدرب،
     * يظهر بس لما يشوف اشتراك اللاعب منتهي فعلياً.
     */
    public function sendExpiredNotification($playerId)
    {
        $player = $this->findMyPlayer($playerId, ['subscription']);

        \App\Models\Notification::create([
            'player_id' => $player->id,
            'type'      => 'subscription_expired',
            'title'     => 'انتهى اشتراكك',
            'body'      => 'انتهى اشتراكك. جدّده الآن لمتابعة الاستفادة من خدمات النادي.',
        ]);

        return redirect()->back()->with('success', 'تم إرسال إشعار انتهاء الاشتراك للاعب.');
    }

    /**
     * 🆕 إضافة تمرين خاص مباشرة (خطوة واحدة بلا "خطة" وسيطة يراها المدرب).
     * يُحفظ فعلياً تحت حاوية مخفية خاصة بهذا اللاعب (getOrCreateCustomContainer).
     */
    public function storeCustomTraining(Request $request, $playerId)
    {
        $request->validate([
            'name'         => 'required|string|max:255',
            'sets'         => 'required|numeric',
            'reps'         => 'required|numeric',
            'rest_time'    => 'nullable|string|max:50',
            'day_of_week'  => 'nullable|integer|min:1|max:7',
            'order'        => 'nullable|integer|min:0',
            'instructions' => 'nullable|string',
            'image'        => 'nullable|image|max:5120',
            'video_url'    => 'nullable|string',
        ]);

        $player = $this->findMyPlayer($playerId, ['subscription']);
        $coachId = Auth::guard('employee')->id();

        if (!$player->hasActiveSubscription()) {
            return redirect()->back()->with('error', 'لا يمكن إضافة تمرين خاص للاعب اشتراكه مجمد أو منتهي.');
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('exercises', 'public');
        }

        $container = $this->getOrCreateCustomContainer($player, $coachId);

        $container->exercises()->create([
            'name'         => $request->name,
            'sets'         => $request->sets,
            'reps'         => $request->reps,
            'rest_time'    => $request->rest_time,
            'day_of_week'  => $request->day_of_week,
            'order'        => $request->order ?? 0,
            'instructions' => $request->instructions,
            'image_path'   => $imagePath,
            'video_url'    => $request->video_url,
        ]);

        return redirect()->back()->with('success', 'تمت إضافة التمرين الخاص للاعب بنجاح.');
    }

    public function storeCustomDiet(Request $request, $playerId)
    {
        $request->validate([
            'meal_name'    => 'required|string|max:255',
            'calories'     => 'required|numeric',
            'protein'      => 'nullable|numeric|min:0',
            'carbs'        => 'nullable|numeric|min:0',
            'fats'         => 'nullable|numeric|min:0',
            'plan_details' => 'required|string',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $player = $this->findMyPlayer($playerId, ['subscription']);

        if (!$player->hasActiveSubscription()) {
            return redirect()->back()->with('error', 'لا يمكن إضافة وجبة مخصصة للاعب اشتراكه مجمد أو منتهي.');
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('meals', 'public');
        }

        DietPlan::create([
            'coach_id'     => Auth::guard('employee')->id(),
            'player_id'    => $player->id,
            'is_custom'    => true,
            'level'        => $player->level,
            'meal_name'    => $request->meal_name,
            'calories'     => $request->calories,
            'protein'      => $request->protein,
            'carbs'        => $request->carbs,
            'fats'         => $request->fats,
            'image_path'   => $imagePath,
            'plan_details' => $request->plan_details,
            'start_date'   => now(),
            'end_date'     => now()->addMonth(),
        ]);

        return redirect()->back()->with('success', 'تمت إضافة الوجبة الغذائية الخاصة باللاعب بنجاح.');
    }

    /**
     * 🗑️ حذف وجبة خاصة (من قسم "الوجبات الخاصة" في ملف اللاعب فقط).
     */
    public function destroyCustomDiet($playerId, $dietId)
    {
        $diet = DietPlan::where('player_id', $playerId)
            ->where('coach_id', Auth::guard('employee')->id())
            ->where('is_custom', true)
            ->findOrFail($dietId);

        $imagePath = $diet->image_path;
        $diet->delete();

        if (!empty($imagePath)) {
            $imageStillUsed = DietPlan::where('image_path', $imagePath)->exists();
            if (!$imageStillUsed && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
        }

        return redirect()->back()->with('success', 'تم حذف الوجبة الخاصة بنجاح.');
    }

    public function storeRating(Request $request, $playerId)
    {
        $request->validate([
            'rating'   => 'required|integer|min:1|max:5',
            'feedback' => 'required|string',
        ]);

        $player = $this->findMyPlayer($playerId, ['subscription']);

        if (!$player->hasActiveSubscription()) {
            return redirect()->back()->with('error', 'لا يمكن تقييم لاعب اشتراكه مجمد أو غير فعال.');
        }

        DB::table('player_ratings')->insert([
            'coach_id'   => Auth::guard('employee')->id(),
            'player_id'  => $player->id,
            'rating'     => $request->rating,
            'feedback'   => $request->feedback,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'تم تسجيل تقييم اللاعب وإرسال الملاحظات بنجاح.');
    }

    public function storeCustomProgress(Request $request, $playerId)
    {
        $request->validate([
            'weight'       => 'required|numeric|min:10|max:300',
            'body_fat_pct' => 'nullable|numeric|min:1|max:90',
            'muscle_mass'  => 'nullable|numeric|min:5|max:200',
        ]);

        $player = $this->findMyPlayer($playerId, ['subscription']);

        if (!$player->hasActiveSubscription()) {
            return redirect()->back()->with('error', 'لا يمكن إضافة قياسات بدنية للاعب اشتراكه مجمد أو منتهي.');
        }

        BodyProgress::create([
            'player_id'    => $player->id,
            'weight'       => $request->weight,
            'body_fat_pct' => $request->body_fat_pct,
            'muscle_mass'  => $request->muscle_mass,
            'recorded_by'  => 'coach',
        ]);

        return redirect()->back()->with('success', 'تم تسجيل القياسات البدنية الحالية للاعب بنجاح.');
    }
}
