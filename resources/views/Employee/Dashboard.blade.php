@extends('Employee.layouts.app')

@section('title', 'لوحة تحكم الموظف | Elite Club')

@section('styles')

    <style>
        /* =========================================================
           EMPLOYEE DASHBOARD
           ELITE CLUB
           ========================================================= */

        .dashboard-page {
            width: 100%;
        }

        /* =========================================================
           PAGE HEADER
           ========================================================= */

        .dashboard-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 22px;
            padding: 4px 2px;
        }

        .dashboard-header-info {
            min-width: 0;
        }

        .dashboard-title {
            margin: 0;
            color: var(--text);
            font-size: 25px;
            font-weight: 850;
            line-height: 1.4;
            letter-spacing: -.5px;
        }

        .dashboard-subtitle {
            display: block;
            margin-top: 5px;
            color: var(--muted);
            font-size: 11px;
            font-weight: 500;
        }

        /* =========================================================
           HEADER ACTION
           ========================================================= */

        .dashboard-header-action {
            display: flex;
            align-items: center;
            gap: 9px;
        }

        .dashboard-date {
            min-height: 40px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 13px;
            color: var(--text-soft);
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 11px;
            box-shadow: var(--shadow-sm);
            font-size: 10px;
            font-weight: 650;
        }

        .dashboard-date i {
            color: var(--gold);
        }

        /* =========================================================
           STAT CARDS
           ========================================================= */

        .dashboard-stats {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 15px;
            margin-bottom: 20px;
        }

        .stat-card {
            position: relative;
            min-height: 132px;
            padding: 19px;
            overflow: hidden;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 17px;
            box-shadow: var(--shadow-sm);
            transition: transform .2s ease, border-color .2s ease, background .25s ease, box-shadow .2s ease;
            opacity: 0;
            animation: statCardIn .5s cubic-bezier(.2, .7, .2, 1) both;
        }

        @keyframes statCardIn {
            from { opacity: 0; transform: translateY(14px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .dashboard-stats .stat-card:nth-child(1) { animation-delay: .05s; }
        .dashboard-stats .stat-card:nth-child(2) { animation-delay: .10s; }
        .dashboard-stats .stat-card:nth-child(3) { animation-delay: .15s; }
        .dashboard-stats .stat-card:nth-child(4) { animation-delay: .20s; }

        .stat-card:hover {
            transform: translateY(-3px);
            border-color: color-mix(in srgb, var(--gold) 25%, var(--border));
            box-shadow: var(--shadow);
        }

        .stat-card:hover .stat-icon {
            transform: scale(1.08) rotate(-4deg);
        }

        .stat-card::after {
            content: "";
            position: absolute;
            left: -25px;
            bottom: -35px;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: color-mix(in srgb, var(--gold) 7%, transparent);
            pointer-events: none;
        }

        .stat-card-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
        }

        .stat-icon {
            width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            color: var(--gold);
            background: color-mix(in srgb, var(--gold) 9%, var(--surface-2));
            border: 1px solid var(--border-soft);
            font-size: 15px;
            transition: transform .25s cubic-bezier(.34, 1.56, .64, 1);
        }

        .stat-label {
            color: var(--muted);
            font-size: 10px;
            font-weight: 650;
        }

        .stat-value {
            margin-top: 15px;
            color: var(--text);
            font-size: 27px;
            font-weight: 850;
            line-height: 1;
        }

        .stat-description {
            margin-top: 8px;
            color: var(--muted);
            font-size: 9px;
            font-weight: 500;
        }

        /* =========================================================
           STAT VARIANTS
           ========================================================= */

        .stat-card.success .stat-icon {
            color: var(--success);
            background: color-mix(in srgb, var(--success) 8%, var(--surface-2));
        }

        .stat-card.warning .stat-icon {
            color: var(--warning);
            background: color-mix(in srgb, var(--warning) 8%, var(--surface-2));
        }

        .stat-card.info .stat-icon {
            color: var(--info);
            background: color-mix(in srgb, var(--info) 8%, var(--surface-2));
        }

        /* =========================================================
           MAIN GRID
           ========================================================= */

        .dashboard-grid {
            display: grid;
            grid-template-columns: minmax(0, 1.4fr) minmax(300px, .9fr);
            gap: 18px;
            margin-bottom: 20px;
        }

        /* =========================================================
           PANEL
           ========================================================= */

        .dashboard-panel {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 18px;
            box-shadow: var(--shadow-sm);
            overflow: hidden;
            transition: background .25s ease, border-color .25s ease, box-shadow .25s ease;
            opacity: 0;
            animation: statCardIn .5s cubic-bezier(.2, .7, .2, 1) both;
            animation-delay: .22s;
        }

        .dashboard-panel-header {
            min-height: 68px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            padding: 15px 19px;
            border-bottom: 1px solid var(--border);
        }

        .dashboard-panel-title {
            display: flex;
            align-items: center;
            gap: 9px;
            color: var(--text);
            font-size: 13px;
            font-weight: 800;
        }

        .dashboard-panel-title i {
            color: var(--gold);
            font-size: 13px;
        }

        .dashboard-panel-subtitle {
            color: var(--muted);
            font-size: 9px;
            font-weight: 500;
        }

        .dashboard-panel-body {
            padding: 18px;
        }

        /* =========================================================
           LEVELS
           ========================================================= */

        .level-list {
            display: flex;
            flex-direction: column;
            gap: 13px;
        }

        .level-row {
            display: grid;
            grid-template-columns: 110px 1fr 35px;
            align-items: center;
            gap: 12px;
        }

        .level-name {
            color: var(--text-soft);
            font-size: 10px;
            font-weight: 650;
        }

        .level-progress {
            height: 8px;
            overflow: hidden;
            background: var(--surface-3);
            border-radius: 99px;
        }

        .level-progress-bar {
            height: 100%;
            min-width: 3px;
            border-radius: inherit;
            background: linear-gradient(90deg, var(--gold-dark), var(--gold-light));
            transition: width .5s ease;
        }

        .level-count {
            text-align: left;
            color: var(--text);
            font-size: 10px;
            font-weight: 800;
        }

        /* =========================================================
           LEVEL EMPTY
           ========================================================= */

        .dashboard-empty {
            min-height: 170px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 9px;
            color: var(--muted);
            text-align: center;
        }

        .dashboard-empty i {
            color: var(--gold);
            font-size: 26px;
            opacity: .7;
            animation: emptyBreathe 2.4s ease-in-out infinite;
        }

        @keyframes emptyBreathe {
            0%, 100% { transform: scale(1); opacity: .7; }
            50% { transform: scale(1.08); opacity: .95; }
        }

        .dashboard-empty strong {
            color: var(--text-soft);
            font-size: 12px;
        }

        .dashboard-empty span {
            font-size: 10px;
        }

        /* =========================================================
           ATTENDANCE
           ========================================================= */

        .attendance-card {
            position: relative;
            padding: 20px;
            background: linear-gradient(135deg, color-mix(in srgb, var(--gold) 7%, var(--surface)), var(--surface));
            border: 1px solid var(--border);
            border-radius: 16px;
        }

        .attendance-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            margin-bottom: 17px;
        }

        .attendance-icon {
            width: 44px;
            height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            color: var(--gold);
            background: color-mix(in srgb, var(--gold) 10%, var(--surface-2));
            border: 1px solid var(--border-soft);
        }

        .attendance-status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 9px;
            border-radius: 999px;
            font-size: 9px;
            font-weight: 700;
        }

        .attendance-status.present {
            color: var(--success);
            background: color-mix(in srgb, var(--success) 8%, var(--surface));
            border: 1px solid color-mix(in srgb, var(--success) 20%, var(--border));
        }

        .attendance-status.late {
            color: var(--warning);
            background: color-mix(in srgb, var(--warning) 8%, var(--surface));
            border: 1px solid color-mix(in srgb, var(--warning) 20%, var(--border));
        }

        .attendance-status i {
            font-size: 7px;
        }

        .attendance-title {
            margin: 0;
            color: var(--text);
            font-size: 15px;
            font-weight: 800;
        }

        .attendance-text {
            margin: 6px 0 0;
            color: var(--muted);
            font-size: 10px;
            line-height: 1.8;
        }

        .attendance-btn {
            width: 100%;
            min-height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            margin-top: 18px;
            border: 0;
            border-radius: 11px;
            color: #171717;
            background: linear-gradient(135deg, var(--gold-light), var(--gold-dark));
            box-shadow: 0 8px 20px rgba(184, 146, 62, .16);
            cursor: pointer;
            font-size: 11px;
            font-weight: 800;
            transition: transform .2s ease, box-shadow .2s ease;
        }

        .attendance-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 28px rgba(184, 146, 62, .23);
        }

        .attendance-btn:disabled {
            cursor: not-allowed;
            opacity: .65;
            transform: none;
        }

        /* =========================================================
           PLAN CARDS
           ========================================================= */

        .plan-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
        }

        .plan-card {
            min-height: 115px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 17px;
            background: var(--surface-2);
            border: 1px solid var(--border);
            border-radius: 14px;
            transition: background .25s ease, transform .2s ease, border-color .2s ease;
        }

        .plan-card:hover {
            transform: translateY(-2px);
            border-color: color-mix(in srgb, var(--gold) 25%, var(--border));
            box-shadow: var(--shadow-sm);
        }

        .plan-card:hover .plan-card-icon {
            transform: scale(1.1) rotate(-4deg);
        }

        .plan-card-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .plan-card-icon {
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            color: var(--gold);
            background: color-mix(in srgb, var(--gold) 8%, var(--surface));
            transition: transform .25s cubic-bezier(.34, 1.56, .64, 1);
        }

        .plan-card-label {
            color: var(--muted);
            font-size: 9px;
            font-weight: 600;
        }

        .plan-card-value {
            margin-top: 12px;
            color: var(--text);
            font-size: 22px;
            font-weight: 850;
        }

        /* =========================================================
           PLAYER SUBSCRIPTION TABLE
           ========================================================= */

        .players-panel {
            margin-bottom: 20px;
        }

        .players-table-wrapper {
            width: 100%;
            overflow-x: auto;
        }

        .players-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 650px;
        }

        .players-table th {
            padding: 13px 15px;
            color: var(--muted);
            background: var(--surface-2);
            border-bottom: 1px solid var(--border);
            font-size: 9px;
            font-weight: 750;
            text-align: right;
            white-space: nowrap;
        }

        .players-table td {
            padding: 14px 15px;
            color: var(--text-soft);
            border-bottom: 1px solid var(--border);
            font-size: 10px;
            transition: background .15s ease;
        }

        .players-table tr:hover td {
            background: color-mix(in srgb, var(--gold) 4%, transparent);
        }

        .players-table tr:hover .player-avatar {
            transform: scale(1.08);
        }

        .players-table tr:last-child td {
            border-bottom: 0;
        }

        .player-name {
            display: flex;
            align-items: center;
            gap: 9px;
            color: var(--text);
            font-weight: 750;
        }

        .player-avatar {
            width: 31px;
            height: 31px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex: 0 0 31px;
            border-radius: 9px;
            color: var(--gold);
            background: color-mix(in srgb, var(--gold) 9%, var(--surface-2));
            border: 1px solid var(--border-soft);
            transition: transform .2s cubic-bezier(.34, 1.56, .64, 1);
        }

        .subscription-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 5px 8px;
            border-radius: 999px;
            font-size: 8px;
            font-weight: 700;
        }

        .subscription-badge.expired {
            color: var(--danger);
            background: color-mix(in srgb, var(--danger) 8%, var(--surface));
            border: 1px solid color-mix(in srgb, var(--danger) 20%, var(--border));
        }

        .subscription-badge.expiring {
            color: var(--warning);
            background: color-mix(in srgb, var(--warning) 8%, var(--surface));
            border: 1px solid color-mix(in srgb, var(--warning) 20%, var(--border));
        }

        .subscription-date {
            color: var(--muted);
            font-size: 9px;
        }

        /* =========================================================
           ALERTS
           ========================================================= */

        .dashboard-alert {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 13px 15px;
            margin-bottom: 18px;
            border-radius: 12px;
            font-size: 10px;
            font-weight: 600;
        }

        .dashboard-alert.success {
            color: var(--success);
            background: color-mix(in srgb, var(--success) 7%, var(--surface));
            border: 1px solid color-mix(in srgb, var(--success) 18%, var(--border));
        }

        .dashboard-alert.error {
            color: var(--danger);
            background: color-mix(in srgb, var(--danger) 7%, var(--surface));
            border: 1px solid color-mix(in srgb, var(--danger) 18%, var(--border));
        }

        /* =========================================================
           RESPONSIVE
           ========================================================= */

        @media (max-width: 1150px) {
            .dashboard-stats {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .dashboard-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 700px) {
            .dashboard-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .dashboard-title {
                font-size: 21px;
            }

            .dashboard-header-action,
            .dashboard-date {
                width: 100%;
            }

            .dashboard-date {
                justify-content: center;
            }

            .dashboard-stats {
                grid-template-columns: 1fr;
            }

            .plan-grid {
                grid-template-columns: 1fr;
            }

            .dashboard-panel-header {
                padding: 14px;
            }

            .dashboard-panel-body {
                padding: 14px;
            }

            .level-row {
                grid-template-columns: 90px 1fr 30px;
                gap: 8px;
            }
        }
    </style>

@endsection

@section('content')

    <div class="dashboard-page"> 
        {{-- =====================================================
         FLASH MESSAGES
    ====================================================== --}}

        @if (session('success'))
            <div class="dashboard-alert success">

                <i class="fas fa-circle-check"></i>

                <span>                     {{ session('success') }}
                </span>

            </div>
        @endif

        @if (session('error'))
            <div class="dashboard-alert error">

                <i class="fas fa-circle-exclamation"></i>

                <span>                     {{ session('error') }}
                </span>

            </div>
        @endif 
        {{-- =====================================================
         HEADER
    ====================================================== --}}

        <div class="dashboard-header">

            <div class="dashboard-header-action">

             
            </div>

        </div> 
        {{-- =====================================================
         STATISTICS
    ====================================================== --}}

        <div class="dashboard-stats"> 
            {{-- Players --}}

            <div class="stat-card">

                <div class="stat-card-top">

                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>

                    <span class="stat-label">
                        إجمالي اللاعبين
                    </span>

                </div>

                <div class="stat-value">                     {{ $totalPlayers }}
                </div>

                <div class="stat-description">
                    اللاعبون المسجلون تحت إشرافك
                </div>

            </div> 
            {{-- Training --}}

            <div class="stat-card info">

                <div class="stat-card-top">

                    <div class="stat-icon">
                        <i class="fas fa-dumbbell"></i>
                    </div>

                    <span class="stat-label">
                        خطط التدريب
                    </span>

                </div>

                <div class="stat-value">                     {{ $totalTrainingPlans }}
                </div>

                <div class="stat-description">
                    خطط التدريب العامة
                </div>

            </div> 
            {{-- Diet --}}

            <div class="stat-card success">

                <div class="stat-card-top">

                    <div class="stat-icon">
                        <i class="fas fa-utensils"></i>
                    </div>

                    <span class="stat-label">
                        خطط التغذية
                    </span>

                </div>

                <div class="stat-value">                     {{ $totalDietPlans }}
                </div>

                <div class="stat-description">
                    خطط التغذية العامة
                </div>

            </div> 
            {{-- Expiring --}}

            <div class="stat-card warning">

                <div class="stat-card-top">

                    <div class="stat-icon">
                        <i class="fas fa-clock"></i>
                    </div>

                    <span class="stat-label">
                        تنتهي قريباً
                    </span>

                </div>

                <div class="stat-value">                     {{ $expiringSoonPlayers->count() }}
                </div>

                <div class="stat-description">
                    اشتراكات خلال 7 أيام
                </div>

            </div>

        </div> 
        {{-- =====================================================
         MAIN GRID
    ====================================================== --}}

        <div class="dashboard-grid"> 
            {{-- =================================================
             PLAYER LEVELS
        ================================================== --}}

            <section class="dashboard-panel">

                <div class="dashboard-panel-header">

                    <div class="dashboard-panel-title">

                        <i class="fas fa-chart-column"></i>

                        توزيع اللاعبين حسب المستوى

                    </div>

                    <span class="dashboard-panel-subtitle">                         {{ $totalPlayers }} لاعب
                    </span>

                </div>

                <div class="dashboard-panel-body">

                    @if ($totalPlayers > 0)
                        <div class="level-list"> 
                            {{-- Beginner --}}

                            <div class="level-row">

                                <span class="level-name">
                                    مبتدئ
                                </span>

                                <div class="level-progress">

                                    <div class="level-progress-bar"
                                        style="width: {{ $totalPlayers > 0 ? ($beginnerCount / $totalPlayers) * 100 : 0 }}%;">
                                    </div>

                                </div>

                                <span class="level-count">                                     {{ $beginnerCount }}
                                </span>

                            </div> 
                            {{-- Intermediate --}}

                            <div class="level-row">

                                <span class="level-name">
                                    متوسط
                                </span>

                                <div class="level-progress">

                                    <div class="level-progress-bar"
                                        style="width: {{ $totalPlayers > 0 ? ($intermediateCount / $totalPlayers) * 100 : 0 }}%;">
                                    </div>

                                </div>

                                <span class="level-count">                                     {{ $intermediateCount }}
                                </span>

                            </div> 
                            {{-- Advanced --}}

                            <div class="level-row">

                                <span class="level-name">
                                    متقدم
                                </span>

                                <div class="level-progress">

                                    <div class="level-progress-bar"
                                        style="width: {{ $totalPlayers > 0 ? ($advancedCount / $totalPlayers) * 100 : 0 }}%;">
                                    </div>

                                </div>

                                <span class="level-count">                                     {{ $advancedCount }}
                                </span>

                            </div>

                        </div>
                    @else
                        <div class="dashboard-empty">

                            <i class="fas fa-users-slash"></i>

                            <strong>
                                لا يوجد لاعبين حالياً
                            </strong>

                            <span>
                                ستظهر الإحصائيات هنا عند إضافة اللاعبين.
                            </span>

                        </div>
                    @endif

                </div>

            </section> 
            {{-- =================================================
             ATTENDANCE
        ================================================== --}}

            <section class="dashboard-panel">

                <div class="dashboard-panel-header">

                    <div class="dashboard-panel-title">

                        <i class="fas fa-calendar-check"></i>

                        حضور الموظف

                    </div>

                    <span class="dashboard-panel-subtitle">
                        حضور اليوم
                    </span>

                </div>

                <div class="dashboard-panel-body">

                    <div class="attendance-card">

                        <div class="attendance-top">

                            <div class="attendance-icon">

                                <i class="fas fa-user-check"></i>

                            </div>

                            @if ($attendance)

                                @if ($attendance->status === 'late')
                                    <span class="attendance-status late">

                                        <i class="fas fa-circle"></i>

                                        متأخر

                                    </span>
                                @else
                                    <span class="attendance-status present">

                                        <i class="fas fa-circle"></i>

                                        حاضر

                                    </span>
                                @endif
                            @else
                                <span class="attendance-status">

                                    لم يتم التسجيل

                                </span>

                            @endif

                        </div>

                        <h3 class="attendance-title">
                            تسجيل حضور اليوم
                        </h3>

                        @if ($attendance)

                            <p class="attendance-text">

                                تم تسجيل حضورك اليوم بنجاح.

                                @if ($attendance->recorded_at)
                                    <br>

                                    وقت التسجيل:                                     {{ \Carbon\Carbon::parse($attendance->recorded_at)->format('h:i A') }}
                                @endif

                            </p>
                        @else
                            <p class="attendance-text">
                                قم بتسجيل حضورك لليوم من خلال الزر التالي.
                            </p>

                        @endif

                        <form action="{{ route('employee.dashboard.attendance.toggle') }}" method="POST">

                            @csrf

                            <button type="submit" class="attendance-btn" {{ $attendance ? 'disabled' : '' }}>

                                @if ($attendance)
                                    <i class="fas fa-check"></i>

                                    تم تسجيل الحضور
                                @else
                                    <i class="fas fa-fingerprint"></i>

                                    تسجيل الحضور
                                @endif

                            </button>

                        </form>

                    </div>

                </div>

            </section>

        </div> 
        {{-- =====================================================
         PLANS
    ====================================================== --}}

        <section class="dashboard-panel players-panel">

            <div class="dashboard-panel-header">

                <div class="dashboard-panel-title">

                    <i class="fas fa-layer-group"></i>

                    ملخص الخطط

                </div>

                <span class="dashboard-panel-subtitle">
                    الخطط الخاصة بك
                </span>

            </div>

            <div class="dashboard-panel-body">

                <div class="plan-grid">

                    <div class="plan-card">

                        <div class="plan-card-top">

                            <span class="plan-card-icon">

                                <i class="fas fa-dumbbell"></i>

                            </span>

                            <span class="plan-card-label">
                                بنك التدريب
                            </span>

                        </div>

                        <div class="plan-card-value">                             {{ $totalTrainingPlans }}
                        </div>

                    </div>

                    <div class="plan-card">

                        <div class="plan-card-top">

                            <span class="plan-card-icon">

                                <i class="fas fa-utensils"></i>

                            </span>

                            <span class="plan-card-label">
                                بنك التغذية
                            </span>

                        </div>

                        <div class="plan-card-value">                             {{ $totalDietPlans }}
                        </div>

                    </div>

                </div>

            </div>

        </section> 
        {{-- =====================================================
         EXPIRING PLAYERS
    ====================================================== --}}

        <section class="dashboard-panel players-panel">

            <div class="dashboard-panel-header">

                <div class="dashboard-panel-title">

                    <i class="fas fa-hourglass-half"></i>

                    الاشتراكات التي تنتهي قريباً

                </div>

                <span class="dashboard-panel-subtitle">
                    خلال 7 أيام
                </span>

            </div>

            <div class="players-table-wrapper">

                @if ($expiringSoonPlayers->count() > 0)

                    <table class="players-table">

                        <thead>

                            <tr>

                                <th>
                                    اللاعب
                                </th>

                                <th>
                                    تاريخ الانتهاء
                                </th>

                                <th>
                                    الحالة
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach ($expiringSoonPlayers as $player)
                                <tr>

                                    <td>

                                        <div class="player-name">

                                            <span class="player-avatar">

                                                <i class="fas fa-user"></i>

                                            </span> 
                                            {{ $player->name }}

                                        </div>

                                    </td>

                                    <td>

                                        @if ($player->subscription)
                                            <span class="subscription-date"> 
                                                {{ \Carbon\Carbon::parse($player->subscription->end_date)->format('Y-m-d') }}

                                            </span>
                                        @else
                                            —
                                        @endif

                                    </td>

                                    <td>

                                        <span class="subscription-badge expiring">

                                            <i class="fas fa-clock"></i>

                                            ينتهي قريباً

                                        </span>

                                    </td>

                                </tr>
                            @endforeach

                        </tbody>

                    </table>
                @else
                    <div class="dashboard-empty">

                        <i class="fas fa-circle-check"></i>

                        <strong>
                            لا توجد اشتراكات تنتهي قريباً
                        </strong>

                        <span>
                            لا يوجد لاعب لديه اشتراك ينتهي خلال 7 أيام.
                        </span>

                    </div>

                @endif

            </div>

        </section> 
        {{-- =====================================================
         EXPIRED PLAYERS
    ====================================================== --}}

        <section class="dashboard-panel players-panel">

            <div class="dashboard-panel-header">

                <div class="dashboard-panel-title">

                    <i class="fas fa-triangle-exclamation"></i>

                    الاشتراكات المنتهية

                </div>

                <span class="dashboard-panel-subtitle">                     {{ $expiredPlayers->count() }} لاعب
                </span>

            </div>

            <div class="players-table-wrapper">

                @if ($expiredPlayers->count() > 0)

                    <table class="players-table">

                        <thead>

                            <tr>

                                <th>
                                    اللاعب
                                </th>

                                <th>
                                    تاريخ الانتهاء
                                </th>

                                <th>
                                    الحالة
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach ($expiredPlayers as $player)
                                <tr>

                                    <td>

                                        <div class="player-name">

                                            <span class="player-avatar">

                                                <i class="fas fa-user"></i>

                                            </span> 
                                            {{ $player->name }}

                                        </div>

                                    </td>

                                    <td>

                                        @if ($player->subscription)
                                            <span class="subscription-date"> 
                                                {{ \Carbon\Carbon::parse($player->subscription->end_date)->format('Y-m-d') }}

                                            </span>
                                        @else
                                            —
                                        @endif

                                    </td>

                                    <td>

                                        <span class="subscription-badge expired">

                                            <i class="fas fa-circle-xmark"></i>

                                            منتهي

                                        </span>

                                    </td>

                                </tr>
                            @endforeach

                        </tbody>

                    </table>
                @else
                    <div class="dashboard-empty">

                        <i class="fas fa-shield-check"></i>

                        <strong>
                            لا توجد اشتراكات منتهية
                        </strong>

                        <span>
                            جميع اشتراكات اللاعبين تحت إشرافك فعالة.
                        </span>

                    </div>

                @endif

            </div>

        </section>

    </div>

@endsection