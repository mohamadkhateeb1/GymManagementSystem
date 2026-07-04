@extends('Employee.layouts.app')

@section('title', 'ملف اللاعب والخطط | Elite Club')

@section('styles')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .player-profile-container {
            --gold: #c9a961;
            --gold-soft: rgba(201, 169, 97, 0.12);
            --gold-line: rgba(201, 169, 97, 0.16);
            --surface: #1c1f27;
            --surface-2: #232733;
            --text: #f2f3f5;
            --muted: #8a8f9c;
            --tracker-blue: #3b82f6;
            --tracker-blue-soft: rgba(59, 130, 246, 0.1);
            font-family: 'Tajawal', sans-serif;
            color: var(--text);
        }

        .back-btn {
            background: var(--surface-2);
            color: var(--text);
            border: 1px solid var(--gold-line);
            padding: 8px 16px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s;
        }

        .back-btn:hover {
            border-color: var(--gold);
            color: var(--gold);
        }

        .btn-add-custom {
            background: var(--gold-soft);
            color: var(--gold);
            border: 1px solid rgba(201, 169, 97, 0.3);
            padding: 6px 12px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 12px;
            font-weight: 600;
            font-family: 'Tajawal', sans-serif;
            transition: all 0.2s;
        }

        .btn-add-custom:hover {
            background: var(--gold);
            color: #1c1f27;
        }

        .btn-rate-player {
            background: rgba(234, 179, 8, 0.1);
            color: #eab308;
            border: 1px solid rgba(234, 179, 8, 0.3);
            padding: 6px 14px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 12px;
            font-weight: 600;
            transition: all 0.2s;
        }

        .btn-rate-player:hover {
            background: #eab308;
            color: #1c1f27;
        }

        .btn-add-progress {
            background: var(--tracker-blue-soft);
            color: var(--tracker-blue);
            border: 1px solid rgba(59, 130, 246, 0.3);
            padding: 6px 14px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 12px;
            font-weight: 600;
            transition: all 0.2s;
        }

        .btn-add-progress:hover {
            background: var(--tracker-blue);
            color: #fff;
        }

        .profile-header-card {
            background: linear-gradient(135deg, var(--surface), #15171c);
            border: 1px solid var(--gold-line);
            border-radius: 16px;
            padding: 24px;
            margin-bottom: 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        .player-info-block {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .player-avatar-icon {
            width: 60px;
            height: 60px;
            background: var(--gold-soft);
            border: 1px solid var(--gold);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gold);
            font-size: 24px;
        }

        .player-meta h2 {
            margin: 0 0 6px 0;
            font-size: 20px;
            font-weight: 800;
        }

        .meta-badges {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .badge-item {
            font-size: 12px;
            padding: 4px 10px;
            border-radius: 6px;
            font-weight: 600;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .badge-gold {
            background: var(--gold-soft);
            border: 1px solid var(--gold);
            color: var(--gold);
            text-transform: capitalize;
        }

        /* 📊 الهيكلية الجديدة لتقسيم اللوحة على السوا */
        .profile-main-layout {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
            align-items: start;
        }

        .inner-tabs-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .side-tracking-grid {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        @media (max-width: 1200px) {
            .profile-main-layout {
                grid-template-columns: 1fr;
            }
        }

        .plan-panel {
            background: var(--surface);
            border: 1px solid var(--gold-line);
            border-radius: 16px;
            overflow: hidden;
        }

        .panel-title-bar {
            padding: 16px 20px;
            border-bottom: 1px solid var(--gold-soft);
            background: rgba(255, 255, 255, 0.01);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
        }

        .panel-title-bar h3 {
            margin: 0;
            font-size: 15px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .panel-title-bar i {
            color: var(--gold);
        }

        .plan-list {
            padding: 15px;
            display: flex;
            flex-direction: column;
            gap: 12px;
            max-height: 450px;
            overflow-y: auto;
        }

        .plan-card {
            background: var(--surface-2);
            border: 1px solid rgba(201, 169, 97, 0.05);
            border-radius: 10px;
            padding: 15px;
        }

        .plan-card.rating-card-item {
            border-right: 4px solid #eab308;
        }

        .plan-card.progress-card-item {
            border-right: 4px solid var(--tracker-blue);
        }

        .plan-card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.03);
            padding-bottom: 8px;
        }

        .plan-card-title {
            font-weight: 700;
            color: #fff;
            font-size: 14px;
        }

        .plan-card-calories {
            font-size: 12px;
            color: var(--gold);
            background: var(--gold-soft);
            padding: 2px 8px;
            border-radius: 4px;
            font-weight: 700;
        }

        .plan-details-text {
            font-size: 13px;
            color: var(--muted);
            line-height: 1.6;
            white-space: pre-line;
        }

        .plan-dates {
            margin-top: 10px;
            font-size: 11px;
            color: var(--muted);
            display: flex;
            gap: 15px;
        }

        .empty-plan-box {
            text-align: center;
            padding: 40px 20px;
            color: var(--muted);
            font-size: 13px;
        }

        .stars-display {
            color: #eab308;
            font-size: 13px;
        }

        /* Modals */
        .modal {
            display: none;
            position: fixed;
            z-index: 9999;
            inset: 0;
            background: rgba(0, 0, 0, 0.75);
            backdrop-filter: blur(4px);
            align-items: center;
            justify-content: center;
        }

        .modal.open {
            display: flex;
        }

        .modal-content {
            background: var(--surface);
            border: 1px solid var(--gold-line);
            width: 100%;
            max-width: 500px;
            border-radius: 16px;
            overflow: hidden;
        }

        .modal-header {
            padding: 16px 20px;
            border-bottom: 1px solid var(--gold-soft);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header h4 {
            margin: 0;
            color: var(--text);
            font-size: 15px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .close-modal {
            color: var(--muted);
            cursor: pointer;
            font-size: 24px;
            font-weight: bold;
            line-height: 1;
        }

        .modal-body {
            padding: 20px;
        }

        .field-group {
            margin-bottom: 16px;
        }

        .field-label {
            display: block;
            margin-bottom: 6px;
            font-size: 13px;
            color: var(--text);
            font-weight: 600;
        }

        .field-input {
            width: 100%;
            padding: 12px;
            background: var(--surface-2);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 8px;
            color: var(--text);
            font-family: 'Tajawal', sans-serif;
            outline: none;
            box-sizing: border-box;
        }

        .btn-submit {
            width: 100%;
            padding: 12px;
            font-weight: 700;
            border-radius: 8px;
            color: #1c1f27;
            background: linear-gradient(135deg, #e7cd8e, #c9a961);
            border: none;
            cursor: pointer;
            font-family: 'Tajawal', sans-serif;
        }
    </style>
@endsection

@section('content')
    <div class="dashboard-wrapper player-profile-container">
        <div style="margin-bottom: 15px;">
            <x-flash-message />
        </div>

        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h2 style="color: #fff; margin: 0; font-weight: 800;">مراقبة ملف اللاعب</h2>
            <a href="{{ route('employee.monitoring') }}" class="back-btn"><i class="fas fa-arrow-left"></i> عودة للقائمة</a>
        </div>

        <!-- كارد الهيدر المرجعي الفاخر -->
        <div class="profile-header-card">
            <div class="player-info-block">
                <div class="player-avatar-icon"><i class="fas fa-user-running"></i></div>
                <div class="player-meta">
                    <h2>{{ $player->name }}</h2>
                    <div class="meta-badges">
                        <span class="badge-item badge-gold"><i class="fas fa-layer-group"
                                style="margin-left: 5px;"></i>المستوى: {{ $player->level ?? 'غير محدد' }}</span>

                        <span class="badge-item"
                            style="color: #60a5fa; background: rgba(96, 165, 250, 0.05); border-color: rgba(96, 165, 250, 0.15);">
                            <i class="fas fa-arrows-up-down" style="margin-left: 5px;"></i>الطول:
                            {{ $player->height ?? '---' }} سم
                        </span>

                        <span class="badge-item"
                            style="color: #34d399; background: rgba(52, 211, 153, 0.05); border-color: rgba(52, 211, 153, 0.15);">
                            <i class="fas fa-weight-scale" style="margin-left: 5px;"></i>الوزن المبدئي:
                            {{ $player->weight ?? '---' }} كغ
                        </span>

                        @if ($player->subscription)
                            <span class="badge-item"
                                style="color: {{ $player->subscription->status == 'active' ? '#4ade80' : '#f87171' }}; background: rgba(255,255,255,0.02)">
                                <i class="fas fa-circle" style="font-size: 8px; margin-left: 5px; color: currentColor;"></i>
                                اشتراك {{ $player->subscription->status == 'active' ? 'نشط' : 'منتهي/مجمد' }}
                            </span>
                        @else
                            <span class="badge-item" style="color: var(--muted);">غير مشترك حالياً</span>
                        @endif
                    </div>
                </div>
            </div>
            <div style="font-size: 12.5px; color: var(--muted);">انضم في: <span
                    style="color: #fff; font-weight: 600;">{{ $player->created_at->format('Y-m-d') }}</span></div>
        </div>

        @php
            $isActive = $player->subscription && $player->subscription->status == 'active';
        @endphp

        <!-- 🚀 بداية التوزيع الهيكلي الجديد على السوا -->
        <div class="profile-main-layout">

            <!-- العمود الأيمن: جداول التمارين والتغذية التفاعلية -->
            <div class="inner-tabs-grid">

                <!-- 1. التمارين الحالية -->
                <div class="plan-panel">
                    <div class="panel-title-bar">
                        <h3><i class="fas fa-dumbbell"></i> الخطط التدريبية الحالية</h3>
                        @if ($isActive)
                            <button class="btn-add-custom" onclick="openModal('addTrainingModal')"><i
                                    class="fas fa-plus"></i>
                                إضافة تمرين خاص</button>
                        @endif
                    </div>
                    <div class="plan-list">
                        @forelse($player->trainingPlans as $trainingPlan)
                            <div class="plan-card">
                                <div class="plan-card-header">
                                    <span class="plan-card-title">حزمة تمارين - مستوى {{ $trainingPlan->level }}</span>
                                    @if (empty($trainingPlan->player_id))
                                        <span class="badge-item" style="font-size: 11px; color: var(--gold);">عامة</span>
                                    @else
                                        <span class="badge-item"
                                            style="font-size: 11px; color: #818cf8; background: rgba(129,140,248,0.1);">خاصة
                                            باللاعب</span>
                                    @endif
                                </div>
                                <div class="plan-details-text">{{ $trainingPlan->plan_details }}</div>
                                <div class="plan-dates">
                                    <span>البدء: {{ $trainingPlan->start_date }}</span>
                                    <span>الانتهاء: {{ $trainingPlan->end_date }}</span>
                                </div>
                            </div>
                        @empty
                            <div class="empty-plan-box">لا توجد خطط تدريبية منزّلة حالياً.</div>
                        @endforelse
                    </div>
                </div>

                <!-- 2. التغذية الحالية -->
                <div class="plan-panel">
                    <div class="panel-title-bar">
                        <h3><i class="fas fa-utensils"></i> البرنامج الغذائي المعتمد</h3>
                        @if ($isActive)
                            <button class="btn-add-custom" onclick="openModal('addDietModal')"><i class="fas fa-plus"></i>
                                إضافة وجبة خاصة</button>
                        @endif
                    </div>
                    <div class="plan-list">
                        @forelse($player->dietPlans as $dietPlan)
                            <div class="plan-card">
                                <div class="plan-card-header">
                                    <span class="plan-card-title">{{ $dietPlan->meal_name }}</span>
                                    <span class="plan-card-calories">{{ $dietPlan->calories }} سعرة</span>
                                </div>
                                <div class="plan-details-text">{{ $dietPlan->plan_details }}</div>
                                <div class="plan-dates">
                                    <span>البدء: {{ $dietPlan->start_date }}</span>
                                    <span>الانتهاء: {{ $dietPlan->end_date }}</span>
                                </div>
                            </div>
                        @empty
                            <div class="empty-plan-box">لا توجد خطط غذائية منزّلة حالياً.</div>
                        @endforelse
                    </div>
                </div>

            </div>

            <!-- العمود الأيسر (الجانبي): المتابعة، الأوزان، والتقييمات التراكمية -->
            <div class="side-tracking-grid">

                <!-- 3. سجل تتبع القياسات والأوزان البدنية -->
                <div class="plan-panel">
                    <div class="panel-title-bar">
                        <h3><i class="fas fa-weight-scale" style="color: var(--tracker-blue);"></i> سجل القياسات والأوزان
                        </h3>
                        @if ($isActive)
                            <button class="btn-add-progress" onclick="openModal('addProgressModal')">
                                <i class="fas fa-plus"></i> تحديث
                            </button>
                        @endif
                    </div>
                    <div class="plan-list" style="max-height: 380px;">
                        @forelse($player->bodyProgress as $progress)
                            <div class="plan-card progress-card-item">
                                <span
                                    style="font-size: 14px; font-weight: 800; color: #fff; display: block; margin-bottom: 5px;">الوزن:
                                    {{ $progress->weight }} كغ</span>
                                <div
                                    style="display: flex; flex-direction: column; gap: 4px; font-size: 11.5px; color: var(--muted);">
                                    <span>دهون: {{ $progress->body_fat_pct ?? '---' }}% | عضل:
                                        {{ $progress->muscle_mass ?? '---' }} كغ</span>
                                    <span style="font-size: 10.5px; margin-top: 4px; color: #8a8f9c;">التاريخ:
                                        {{ \Carbon\Carbon::parse($progress->created_at)->format('Y-m-d') }}</span>
                                </div>
                            </div>
                        @empty
                            <div class="empty-plan-box">لا توجد قياسات مسجلة بعد.</div>
                        @endforelse
                    </div>
                </div>

                <!-- 4. سجل تقييم ومراجعات الأداء لللاعب -->
                <div class="plan-panel">
                    <div class="panel-title-bar">
                        <h3><i class="fas fa-star" style="color: #eab308;"></i> التقييم ومراجعات الأداء</h3>
                        @if ($isActive)
                            <button class="btn-rate-player" onclick="openModal('addRatingModal')">
                                <i class="fas fa-star-half-alt"></i> تقييم
                            </button>
                        @endif
                    </div>
                    <div class="plan-list" style="max-height: 380px;">
                        @forelse($ratings as $rate)
                            <div class="plan-card rating-card-item">
                                <div class="plan-card-header" style="margin-bottom: 6px; padding-bottom: 4px;">
                                    <div class="stars-display">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i class="{{ $i <= $rate->rating ? 'fas' : 'far' }} fa-star"></i>
                                        @endfor
                                    </div>
                                    <span
                                        style="font-size: 10.5px; color: var(--muted);">{{ \Carbon\Carbon::parse($rate->created_at)->format('Y-m-d') }}</span>
                                </div>
                                <div class="plan-details-text" style="color: #fff; font-weight: 500; font-size: 12.5px;">
                                    {{ $rate->feedback }}
                                </div>
                            </div>
                        @empty
                            <div class="empty-plan-box">لا توجد مراجعات مسجلة بعد.</div>
                        @endforelse
                    </div>
                </div>

            </div>

        </div>
        <!-- 🏁 نهاية التوزيع الهيكلي الجديد -->

    </div>

    {{-- ===== Modal إضافة ميزان وقياس بدني جديد للاعب من قبل المدرب ===== --}}
    <div id="addProgressModal" class="modal">
        <div class="modal-content" style="border-color: rgba(59, 130, 246, 0.3);">
            <div class="modal-header" style="border-bottom-color: rgba(59, 130, 246, 0.1);">
                <h4><i class="fas fa-weight-scale" style="color: var(--tracker-blue);"></i> تسجيل قياسات الميزان الحالي
                    بالصالة</h4>
                <span class="close-modal" onclick="closeModal('addProgressModal')">&times;</span>
            </div>
            <form action="{{ route('employee.monitoring.custom-progress', $player->id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="field-group">
                        <label class="field-label">الوزن الفعلي الحالي (بالكيلوجرام) *</label>
                        <input type="number" name="weight" step="0.01" class="field-input"
                            placeholder="مثال: 78.5" required>
                    </div>
                    <div class="field-group">
                        <label class="field-label">نسبة الدهون % (اختياري)</label>
                        <input type="number" name="body_fat_pct" step="0.1" class="field-input"
                            placeholder="مثال: 14.2">
                    </div>
                    <div class="field-group">
                        <label class="field-label">كتلة العضلات (بالكيلوجرام - اختياري)</label>
                        <input type="number" name="muscle_mass" step="0.01" class="field-input"
                            placeholder="مثال: 36.8">
                    </div>
                    <button type="submit" class="btn-submit"
                        style="background: linear-gradient(135deg, #93c5fd, var(--tracker-blue)); color: #fff;">تنزيل
                        وتحديث سجل القياسات</button>
                </div>
            </form>
        </div>
    </div>

    {{-- ===== Modal إعطاء تقييم ومراجعة أداء جديدة لللاعب ===== --}}
    <div id="addRatingModal" class="modal">
        <div class="modal-content" style="border-color: rgba(234, 179, 8, 0.3);">
            <div class="modal-header" style="border-bottom-color: rgba(234, 179, 8, 0.1);">
                <h4><i class="fas fa-star" style="color: #eab308;"></i> إضافة تقييم أداء ومراجعة للاعب</h4>
                <span class="close-modal" onclick="closeModal('addRatingModal')">&times;</span>
            </div>
            <form action="{{ route('employee.monitoring.store-rating', $player->id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="field-group">
                        <label class="field-label">اختر تقييم الأداء العام بالنجوم</label>
                        <select name="rating" class="field-input" style="color: #eab308; font-weight: 700;" required>
                            <option value="5">⭐⭐⭐⭐⭐ (5 - ملتزم وممتاز جداً)</option>
                            <option value="4">⭐⭐⭐⭐ (4 - تطور ملحوظ جيد جداً)</option>
                            <option value="3">⭐⭐⭐ (3 - أداء متوسط يحتاج تركيز)</option>
                            <option value="2">⭐⭐ (2 - ضعيف الالتزام بالجدول)</option>
                            <option value="1">⭐ (1 - عدم التزام كامل بالبرنامج)</option>
                        </select>
                    </div>
                    <div class="field-group">
                        <label class="field-label">مراجعة المدرب والملاحظات الفنية</label>
                        <textarea name="feedback" class="field-input" rows="5"
                            placeholder="اكتب نصائحك الفنية أو نسبة الالتزام وملاحظاتك المخصصة هنا للاعب..." required></textarea>
                    </div>
                    <button type="submit" class="btn-submit"
                        style="background: linear-gradient(135deg, #fef08a, #eab308); color: #1c1f27;">حفظ المراجعة وتسجيل
                        التقييم</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Modals الإضافات الخاصة المخصصة المحمية --}}
    <div id="addTrainingModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h4><i class="fas fa-dumbbell" style="color: var(--gold);"></i> إضافة جدول تمارين خاص للاعب</h4>
                <span class="close-modal" onclick="closeModal('addTrainingModal')">&times;</span>
            </div>
            <form action="{{ route('employee.monitoring.custom-training', $player->id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="field-group">
                        <label class="field-label">تفاصيل التمارين والمجموعات الحصرية</label>
                        <textarea name="plan_details" class="field-input" rows="6" placeholder="اكتب تفاصيل التمارين الخاصة به هنا..."
                            required></textarea>
                    </div>
                    <button type="submit" class="btn-submit">تنزيل الجدول الخاص باللاعب</button>
                </div>
            </form>
        </div>
    </div>

    <div id="addDietModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h4><i class="fas fa-utensils" style="color: var(--gold);"></i> إضافة وجبة غذائية خاصة للاعب</h4>
                <span class="close-modal" onclick="closeModal('addDietModal')">&times;</span>
            </div>
            <form action="{{ route('employee.monitoring.custom-diet', $player->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="field-group">
                        <label class="field-label">اسم الوجبة</label>
                        <input type="text" name="meal_name" class="field-input"
                            placeholder="مثال: عشاء خاص - بياض بيض مع أفوكادو" required>
                    </div>
                    <div class="field-group">
                        <label class="field-label">عدد السعرات الحرارية</label>
                        <input type="number" name="calories" class="field-input" placeholder="مثال: 410" required>
                    </div>
                    <div class="field-group">
                        <label class="field-label">صورة الوجبة (اختياري)</label>
                        <input type="file" name="image" class="field-input" accept="image/*">
                    </div>
                    <div class="field-group">
                        <label class="field-label">المكونات وطريقة التحضير والملاحظات</label>
                        <textarea name="plan_details" class="field-input" rows="4"
                            placeholder="اكتب تفاصيل ومكونات الوجبة الحصرية هنا..." required></textarea>
                    </div>
                    <button type="submit" class="btn-submit">تنزيل الوجبة الخاصة باللاعب</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function openModal(id) {
            document.getElementById(id).classList.add('open');
        }

        function closeModal(id) {
            document.getElementById(id).classList.remove('open');
        }
        window.onclick = function(event) {
            if (event.target.classList.contains('modal')) {
                event.target.classList.remove('open');
            }
        }
    </script>
@endsection
