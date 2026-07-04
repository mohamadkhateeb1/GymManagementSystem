@extends('Employee.layouts.app')

@section('title', 'لوحة تحكم الموظف | Elite Club')

@section('content')
    <div class="dashboard-wrapper">
        <div style="margin-bottom: 18px;">
            <x-flash-message />
        </div>

        <div class="header">
            <div class="header-titles">
                <div class="header-eyebrow"><i class="fas fa-crown"></i> Elite Club</div>
                <div class="header-title">لوحة تحكم المدرب</div>
                <div class="header-sub">أهلاً بك مجدداً يا كابتن {{ auth()->guard('employee')->user()->name }} 🎯</div>
            </div>
            <div class="header-emblem"><i class="fas fa-medal"></i></div>
        </div>

        <div class="attendance-luxury-zone">
            <div class="attendance-meta-info">
                <div
                    class="attendance-status-badge {{ $attendance ? (is_null($attendance->check_out_time) ? 'status-active' : 'status-done') : 'status-off' }}">
                    <span class="pulse-dot"></span>
                    @if (!$attendance)
                        لم يتم تسجيل الحضور اليوم
                    @elseif($attendance && is_null($attendance->check_out_time))
                        الوردية الزمنية جارية الآن ⏳
                    @else
                        تم إنهاء الوردية بنجاح ✅
                    @endif
                </div>
                <h3><i class="fas fa-id-card-alt"></i> توثيق حضور وانصراف الكادر التدريبي</h3>
                <p>يرجى تسجيل قيد الدخول عند بدء مهامك بالصالة، وقيد الانصراف عند المغادرة لحفظ ساعات العمل بدقة.</p>
            </div>

            <div class="attendance-action-side">
                <form action="{{ route('employee.dashboard.attendance.toggle') }}" method="POST" id="attendanceForm">
                    @csrf
                    @if (!$attendance)
                        <button type="submit" class="btn-luxury-attendance state-check-in">
                            <div class="inner-glow"></div>
                            <span class="icon-box"><i class="fas fa-fingerprint"></i></span>
                            <span class="text-box">تسجيل الدخول للعمل <small>قيد الحضور</small></span>
                        </button>
                    @elseif($attendance && is_null($attendance->check_out_time))
                        <button type="submit" class="btn-luxury-attendance state-check-out" id="btnCheckOut">
                            <div class="inner-glow"></div>
                            <span class="icon-box"><i class="fas fa-power-off"></i></span>
                            <span class="text-box">تسجيل الانصراف <small>إنهاء الوردية</small></span>
                        </button>
                    @else
                        <div class="attendance-completed-card">
                            <div class="success-icon-wrap"><i class="fas fa-circle-check"></i></div>
                            <div class="completed-text">
                                <h5>تم توثيق يوميتك بنجاح!</h5>
                                <span>حضورك: {{ $attendance->check_in_time->format('H:i A') }} | انصرافك:
                                    {{ $attendance->check_out_time->format('H:i A') }}</span>
                            </div>
                        </div>
                    @endif
                </form>
            </div>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon players-icon"><i class="fas fa-users"></i></div>
                <div class="stat-info">
                    <span class="stat-label">إجمالي اللاعبين</span>
                    <span class="stat-value">{{ $totalPlayers }}</span>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon training-icon"><i class="fas fa-dumbbell"></i></div>
                <div class="stat-info">
                    <span class="stat-label">حزمة التمارين بالبنك</span>
                    <span class="stat-value">{{ $totalTrainingPlans }}</span>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon diet-icon"><i class="fas fa-apple-alt"></i></div>
                <div class="stat-info">
                    <span class="stat-label">الوجبات الغذائية بالبنك</span>
                    <span class="stat-value">{{ $totalDietPlans }}</span>
                </div>
            </div>
        </div>

        <div class="dashboard-grid">

            <div class="main-card">
                <div class="panel-head">
                    <h3><i class="fas fa-chart-pie"></i> توزيع اللاعبين حسب المستويات</h3>
                </div>
                <div class="levels-progress-wrapper">
                    <div class="progress-item">
                        <div class="progress-info">
                            <span>المستوى المبتدئ (Beginner)</span>
                            <strong>{{ $beginnerCount }} لاعب</strong>
                        </div>
                        <div class="progress-bar-bg">
                            <div class="progress-bar-fill beginner"
                                style="width: {{ $totalPlayers > 0 ? ($beginnerCount / $totalPlayers) * 100 : 0 }}%"></div>
                        </div>
                    </div>

                    <div class="progress-item">
                        <div class="progress-info">
                            <span>المستوى المتوسط (Intermediate)</span>
                            <strong>{{ $intermediateCount }} لاعب</strong>
                        </div>
                        <div class="progress-bar-bg">
                            <div class="progress-bar-fill intermediate"
                                style="width: {{ $totalPlayers > 0 ? ($intermediateCount / $totalPlayers) * 100 : 0 }}%">
                            </div>
                        </div>
                    </div>

                    <div class="progress-item">
                        <div class="progress-info">
                            <span>المستوى المتقدم (Advanced)</span>
                            <strong>{{ $advancedCount }} لاعب</strong>
                        </div>
                        <div class="progress-bar-bg">
                            <div class="progress-bar-fill advanced"
                                style="width: {{ $totalPlayers > 0 ? ($advancedCount / $totalPlayers) * 100 : 0 }}%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="main-card">
                <div class="panel-head">
                    <h3><i class="fas fa-bolt"></i> إجراءات سريعة</h3>
                </div>
                <div class="quick-actions-grid">
                    <a href="{{ route('employee.monitoring') }}" class="action-tile">
                        <i class="fas fa-user-check"></i>
                        <span>أتمتة وتحديث اللاعبين</span>
                    </a>
                    <a href="{{ route('employee.training.bank') }}" class="action-tile">
                        <i class="fas fa-plus-circle"></i>
                        <span>إضافة تمارين للمستويات</span>
                    </a>
                    <a href="{{ route('employee.diet.bank') }}" class="action-tile">
                        <i class="fas fa-hamburger"></i>
                        <span>تزويد بنك الوجبات</span>
                    </a>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('styles')
    <style>
        .dashboard-wrapper {
            max-width: 1200px;
            margin: auto;
            --beginner-color: #f59e0b;
            --intermediate-color: #3b82f6;
            --advanced-color: #10b981;
        }

        /* حركات الظهور الانسيابية */
        .dashboard-wrapper .header,
        .dashboard-wrapper .attendance-luxury-zone,
        .dashboard-wrapper .stats-grid,
        .dashboard-wrapper .dashboard-grid {
            opacity: 0;
            transform: translateY(14px);
            animation: dash-rise .55s cubic-bezier(.2, .7, .2, 1) forwards;
        }

        .dashboard-wrapper .header {
            animation-delay: .05s;
        }

        .dashboard-wrapper .attendance-luxury-zone {
            animation-delay: .10s;
        }

        .dashboard-wrapper .stats-grid {
            animation-delay: .15s;
        }

        .dashboard-wrapper .dashboard-grid {
            animation-delay: .22s;
        }

        @keyframes dash-rise {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            margin-bottom: 24px;
            padding: 24px 26px;
            border-radius: 16px;
            border: 1px solid var(--gold-line);
            background: radial-gradient(120% 160% at 100% 0%, rgba(201, 169, 97, 0.10), transparent 50%), var(--surface);
        }

        .header-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: .5px;
            color: var(--gold);
            margin-bottom: 8px;
        }

        .header-title {
            font-size: 26px;
            font-weight: 800;
            color: var(--text);
            line-height: 1.2;
        }

        .header-sub {
            font-size: 15px;
            color: var(--muted);
            margin-top: 6px;
        }

        .header-emblem {
            flex-shrink: 0;
            width: 60px;
            height: 60px;
            display: grid;
            place-items: center;
            font-size: 24px;
            color: var(--gold);
            background: var(--gold-soft);
            border: 1px solid var(--gold-line);
            border-radius: 16px;
        }

        /* 🔥 تحديث كارد البصمة المطور الفاخر بنظام الكروت الرياضية المضيئة */
        .attendance-luxury-zone {
            background: #1e222b;
            border: 1px solid rgba(201, 169, 97, 0.15);
            border-radius: 20px;
            padding: 26px;
            margin-bottom: 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 24px;
            position: relative;
            overflow: hidden;
            box-shadow: inset 0 0 20px rgba(0, 0, 0, 0.2), 0 10px 30px rgba(0, 0, 0, 0.25);
        }

        .attendance-status-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 12px;
            font-weight: 700;
            padding: 6px 14px;
            border-radius: 30px;
            margin-bottom: 12px;
            letter-spacing: 0.3px;
        }

        .status-off {
            background: rgba(239, 68, 68, 0.1);
            color: #ef4444;
            border: 1px solid rgba(239, 68, 68, 0.2);
        }

        .status-active {
            background: rgba(59, 130, 246, 0.1);
            color: #3b82f6;
            border: 1px solid rgba(59, 130, 246, 0.2);
        }

        .status-done {
            background: rgba(16, 185, 129, 0.1);
            color: #10b981;
            border: 1px solid rgba(16, 185, 129, 0.2);
        }

        .pulse-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            display: inline-block;
            animation: dotPulse 1.8s infinite ease-in-out;
            background: currentColor;
        }

        @keyframes dotPulse {

            0%,
            100% {
                opacity: 0.4;
                transform: scale(0.9);
            }

            50% {
                opacity: 1;
                transform: scale(1.2);
            }
        }

        .attendance-meta-info h3 {
            margin: 0 0 6px 0;
            font-size: 18px;
            font-weight: 800;
            color: #fff;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .attendance-meta-info h3 i {
            color: var(--gold);
        }

        .attendance-meta-info p {
            margin: 0;
            font-size: 13px;
            color: #94a3b8;
            max-width: 600px;
            line-height: 1.6;
        }

        /* ✨ زر البصمة الفاخر الجديد بتأثيرات الـ Glow الرهيبة */
        .btn-luxury-attendance {
            position: relative;
            display: inline-flex;
            align-items: center;
            border: none;
            background: transparent;
            padding: 0;
            cursor: pointer;
            border-radius: 14px;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        }

        .btn-luxury-attendance .icon-box {
            display: grid;
            place-items: center;
            width: 54px;
            height: 54px;
            font-size: 20px;
            background: rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }

        .btn-luxury-attendance .text-box {
            padding: 0 24px;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            text-align: right;
            font-family: 'Tajawal', sans-serif;
            font-size: 14px;
            font-weight: 700;
        }

        .btn-luxury-attendance .text-box small {
            font-size: 11px;
            opacity: 0.7;
            margin-top: 2px;
            font-weight: 500;
        }

        /* ثيم حضور أخضر مضيء */
        .state-check-in {
            background: linear-gradient(135deg, #10b981, #059669);
            color: #fff;
        }

        .state-check-in .icon-box {
            background: rgba(0, 0, 0, 0.15);
            color: #fff;
        }

        .state-check-in:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(16, 185, 129, 0.4);
        }

        /* ثيم انصراف أحمر مضيء ناري */
        .state-check-out {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: #fff;
        }

        .state-check-out .icon-box {
            background: rgba(0, 0, 0, 0.15);
            color: #fff;
        }

        .state-check-out:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(239, 68, 68, 0.4);
        }

        /* كارد اكتمال الحضور والتوقيع الفاخر */
        .attendance-completed-card {
            display: inline-flex;
            align-items: center;
            gap: 16px;
            background: rgba(16, 185, 129, 0.04);
            border: 1px solid rgba(16, 185, 129, 0.2);
            padding: 12px 24px;
            border-radius: 16px;
        }

        .success-icon-wrap {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(16, 185, 129, 0.1);
            display: grid;
            place-items: center;
            color: #10b981;
            font-size: 22px;
        }

        .completed-text h5 {
            margin: 0 0 4px 0;
            font-size: 14px;
            color: #fff;
            font-weight: 700;
        }

        .completed-text span {
            font-size: 12px;
            color: #94a3b8;
            display: block;
        }

        /* باقي التنسيقات والشبكة سليم 100% */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            margin-bottom: 24px;
        }

        .stat-card {
            background: var(--surface);
            border: 1px solid rgba(255, 255, 255, 0.04);
            border-radius: 16px;
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: grid;
            place-items: center;
            font-size: 20px;
        }

        .players-icon {
            background: rgba(59, 130, 246, 0.1);
            color: #3b82f6;
        }

        .training-icon {
            background: rgba(201, 169, 97, 0.1);
            color: var(--gold);
        }

        .diet-icon {
            background: rgba(16, 185, 129, 0.1);
            color: #10b981;
        }

        .stat-info {
            display: flex;
            flex-direction: column;
        }

        .stat-label {
            font-size: 13px;
            color: var(--muted);
            font-weight: 600;
            margin-bottom: 4px;
        }

        .stat-value {
            font-size: 24px;
            font-weight: 800;
            color: #fff;
            line-height: 1;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        @media (max-width: 992px) {
            .dashboard-grid {
                grid-template-columns: 1fr;
            }

            .attendance-luxury-zone {
                flex-direction: column;
                align-items: flex-start;
            }

            .btn-luxury-attendance {
                width: 100%;
            }

            .btn-luxury-attendance .text-box {
                flex-grow: 1;
                text-align: right;
            }
        }

        .main-card {
            background: var(--surface);
            padding: 8px 24px 24px;
            border-radius: 16px;
            border: 1px solid rgba(255, 255, 255, 0.04);
        }

        .panel-head {
            padding: 18px 0;
            border-bottom: 1px solid var(--gold-soft);
            margin-bottom: 16px;
        }

        .panel-head h3 {
            margin: 0;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 16px;
            font-weight: 700;
            color: var(--text);
        }

        .panel-head h3 i {
            color: var(--gold);
        }

        .levels-progress-wrapper {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .progress-item {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .progress-info {
            display: flex;
            justify-content: space-between;
            font-size: 13.5px;
            color: var(--text);
        }

        .progress-info span {
            color: var(--muted);
            font-weight: 500;
        }

        .progress-info strong {
            color: #fff;
        }

        .progress-bar-bg {
            width: 100%;
            height: 8px;
            background: var(--surface-2);
            border-radius: 4px;
            overflow: hidden;
        }

        .progress-bar-fill {
            height: 100%;
            border-radius: 4px;
            transition: width 0.5s ease;
        }

        .progress-bar-fill.beginner {
            background: var(--beginner-color);
        }

        .progress-bar-fill.intermediate {
            background: var(--intermediate-color);
        }

        .progress-bar-fill.advanced {
            background: var(--advanced-color);
        }

        .quick-actions-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 12px;
        }

        .action-tile {
            background: var(--surface-2);
            border: 1px solid rgba(255, 255, 255, 0.02);
            border-radius: 12px;
            padding: 20px 12px;
            text-align: center;
            color: var(--text);
            text-decoration: none;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 12px;
            transition: all 0.2s ease;
        }

        .action-tile i {
            font-size: 22px;
            color: var(--gold);
        }

        .action-tile span {
            font-size: 13px;
            font-weight: 600;
            line-height: 1.4;
        }

        .action-tile:hover {
            border-color: var(--gold-line);
            background: var(--gold-soft);
            transform: translateY(-2px);
        }

        @media (max-width: 640px) {
            .header {
                flex-direction: column;
                align-items: flex-start;
            }

            .header-emblem {
                display: none;
            }

            .header-title {
                font-size: 22px;
            }
        }
    </style>
@endpush

@section('scripts')
    <script>
        // 🛡️ نظام الحماية الصارم لحظر مغادرة المتصفح وإظهار تنبيه قسري عند بقاء الوردية جارية
        @if ($attendance && is_null($attendance->check_out_time))
            window.addEventListener('beforeunload', function(e) {
                // كود إجباري لمعظم المتصفحات لإظهار نافذة الحظر وتنبيه المدرب
                const confirmationMessage =
                    'انتبه كابتن! لقد قمت بتسجيل حضورك والوردية التدريبية جارية الآن. يرجى الضغط أولاً على زر (تسجيل الانصراف) قبل مغادرة المتصفح لحفظ قيد ساعات العمل بحسابك.';

                (e || window.event).returnValue = confirmationMessage;
                return confirmationMessage;
            });
        @endif
    </script>
@endsection
