@extends('Employee.layouts.app')

@section('title', 'تفاصيل اللاعب | ' . $player->name)

@section('content')
    @php
        $status = $player->subscription?->status;
        $statusClass = $status === 'active' ? 'active' : ($status ? 'expired' : 'none');
        $statusLabel =
            $status === 'active' ? 'اشتراك فعّال' : ($status === 'expired' ? 'منتهي' : $status ?? 'لا يوجد اشتراك');
        $plansCount = $player->trainingPlans->count();
    @endphp

    <div class="dashboard-wrapper player-profile">

        {{-- ===== بطاقة اللاعب ===== --}}
        <div class="panel hero-card">
            <div class="hero-glow"></div>
            <div class="hero-main">
                <div class="hero-avatar" aria-hidden="true">
                    {{ mb_substr($player->name, 0, 1) }}
                </div>

                <div class="hero-info">
                    <span class="hero-eyebrow">ملف اللاعب</span>
                    <h2 class="hero-name">{{ $player->name }}</h2>

                    <div class="hero-meta">
                        <span class="status-chip {{ $statusClass }}">
                            <span class="chip-dot"></span>{{ $statusLabel }}
                        </span>
                        <span class="meta-pill">
                            <i class="fas fa-calendar-day"></i>
                            انضمّ في {{ $player->created_at->format('Y-m-d') }}
                        </span>
                        <span class="meta-pill">
                            <i class="fas fa-dumbbell"></i>
                            {{ $plansCount }} خطة تدريبية
                        </span>
                    </div>
                </div>

                <div class="hero-action">
                    <a href="{{ route('employee.training.create', $player->id) }}"
                        class="action-btn btn-solid add-plan-btn">
                        <i class="fas fa-plus"></i>
                        <span>إضافة خطة تدريبية</span>
                    </a>
                </div>
            </div>
        </div>

        {{-- ===== سجل الخطط ===== --}}
        <div class="panel plans-panel">
            <div class="panel-head plans-head">
                <h3><i class="fas fa-clipboard-list"></i> سجل الخطط التدريبية</h3>
                <span class="count-badge">{{ $plansCount }}</span>
            </div>

            <div class="table-wrap">
                <table class="members-table plans-table">
                    <thead>
                        <tr>
                            <th>تفاصيل الخطة</th>
                            <th class="col-date">تبدأ من</th>
                            <th class="col-date">تنتهي في</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($player->trainingPlans as $plan)
                            <tr>
                                <td>
                                    <div class="plan-cell">
                                        <span class="plan-icon"><i class="fas fa-bolt"></i></span>
                                        <span class="plan-text">{{ $plan->plan_details }}</span>
                                    </div>
                                </td>
                                <td class="col-date">
                                    <span class="date-pill start">
                                        <i class="fas fa-play"></i>{{ $plan->start_date }}
                                    </span>
                                </td>
                                <td class="col-date">
                                    <span class="date-pill end">
                                        <i class="fas fa-flag-checkered"></i>{{ $plan->end_date }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3">
                                    <div class="empty-state">
                                        <div class="empty-icon"><i class="fas fa-dumbbell"></i></div>
                                        <p class="empty-title">لا توجد خطط تدريبية بعد</p>
                                        <p class="empty-sub">ابدأ بإضافة أول خطة تدريبية لهذا اللاعب</p>
                                        <a href="{{ route('employee.training.create', $player->id) }}"
                                            class="action-btn btn-solid add-plan-btn">
                                            <i class="fas fa-plus"></i><span>إضافة خطة الآن</span>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;800&display=swap" rel="stylesheet">
    <style>
        .player-profile {
            --gold: #c9a961;
            --gold-soft: rgba(201, 169, 97, 0.12);
            --gold-line: rgba(201, 169, 97, 0.16);
            --surface: #1c1f27;
            --surface-2: #232733;
            --text: #f2f3f5;
            --muted: #8a8f9c;
            font-family: 'Tajawal', sans-serif;
        }

        /* تحريك دخول لطيف */
        .player-profile .panel {
            opacity: 0;
            transform: translateY(14px);
            animation: pf-rise .55s cubic-bezier(.2, .7, .2, 1) forwards;
        }

        .player-profile .hero-card {
            animation-delay: .05s;
        }

        .player-profile .plans-panel {
            animation-delay: .15s;
        }

        @keyframes pf-rise {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ===== بطاقة اللاعب ===== */
        .hero-card {
            position: relative;
            overflow: hidden;
            margin-bottom: 22px;
            border: 1px solid var(--gold-line);
            border-radius: 18px;
            background:
                radial-gradient(120% 140% at 100% 0%, rgba(201, 169, 97, 0.10), transparent 45%),
                var(--surface);
        }

        .hero-glow {
            position: absolute;
            inset-block-start: -90px;
            inset-inline-end: -90px;
            width: 240px;
            height: 240px;
            background: radial-gradient(circle, rgba(201, 169, 97, 0.18), transparent 70%);
            filter: blur(8px);
            pointer-events: none;
        }

        .hero-main {
            position: relative;
            display: flex;
            align-items: center;
            gap: 22px;
            padding: 26px 28px;
            flex-wrap: wrap;
        }

        .hero-avatar {
            flex-shrink: 0;
            width: 76px;
            height: 76px;
            display: grid;
            place-items: center;
            border-radius: 20px;
            font-size: 32px;
            font-weight: 800;
            color: #1c1f27;
            background: linear-gradient(135deg, #e7cd8e, #c9a961 60%, #a9863f);
            box-shadow: 0 10px 26px rgba(201, 169, 97, 0.35);
        }

        .hero-info {
            flex: 1;
            min-width: 220px;
        }

        .hero-eyebrow {
            display: inline-block;
            font-size: 12px;
            letter-spacing: .5px;
            color: var(--gold);
            text-transform: uppercase;
            margin-bottom: 4px;
        }

        .hero-name {
            margin: 0 0 12px;
            font-size: 27px;
            font-weight: 800;
            color: var(--text);
            line-height: 1.2;
        }

        .hero-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            align-items: center;
        }

        .meta-pill {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 7px 14px;
            font-size: 13px;
            font-weight: 500;
            color: var(--muted);
            background: var(--surface-2);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 999px;
        }

        .meta-pill i {
            color: var(--gold);
            font-size: 12px;
        }

        .hero-action {
            margin-inline-start: auto;
        }

        /* ===== شريحة الحالة ===== */
        .status-chip {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 7px 15px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: 700;
            color: #fff;
        }

        .status-chip .chip-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: currentColor;
            box-shadow: 0 0 0 0 currentColor;
        }

        .status-chip.active {
            color: #4ade80;
            background: rgba(56, 161, 105, 0.16);
            border: 1px solid rgba(56, 161, 105, 0.35);
        }

        .status-chip.active .chip-dot {
            animation: pulse 1.8s infinite;
        }

        .status-chip.expired {
            color: #f87171;
            background: rgba(229, 62, 62, 0.14);
            border: 1px solid rgba(229, 62, 62, 0.32);
        }

        .status-chip.none {
            color: #a0a6b2;
            background: rgba(113, 128, 150, 0.14);
            border: 1px solid rgba(113, 128, 150, 0.3);
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(74, 222, 128, 0.5);
            }

            70% {
                box-shadow: 0 0 0 7px rgba(74, 222, 128, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(74, 222, 128, 0);
            }
        }

        /* ===== زر الإضافة ===== */
        .add-plan-btn {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            padding: 12px 22px;
            font-size: 14px;
            font-weight: 700;
            border-radius: 12px;
            color: #1c1f27 !important;
            background: linear-gradient(135deg, #e7cd8e, #c9a961);
            border: none;
            text-decoration: none;
            transition: transform .18s ease, box-shadow .18s ease, filter .18s ease;
        }

        .add-plan-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 24px rgba(201, 169, 97, 0.3);
            filter: brightness(1.04);
        }

        /* ===== لوحة الخطط ===== */
        .plans-panel {
            border-radius: 18px;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.05);
            background: var(--surface);
        }

        .plans-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px 24px;
            border-bottom: 1px solid var(--gold-soft);
        }

        .plans-head h3 {
            margin: 0;
            font-size: 17px;
            font-weight: 700;
            color: var(--text);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .plans-head h3 i {
            color: var(--gold);
        }

        .count-badge {
            min-width: 28px;
            height: 28px;
            padding: 0 9px;
            display: grid;
            place-items: center;
            font-size: 13px;
            font-weight: 700;
            color: var(--gold);
            background: var(--gold-soft);
            border-radius: 999px;
        }

        .table-wrap {
            overflow-x: auto;
        }

        .plans-table {
            width: 100%;
            border-collapse: collapse;
        }

        .plans-table th {
            padding: 15px 24px;
            text-align: right;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: .3px;
            color: var(--muted);
            text-transform: uppercase;
            background: rgba(255, 255, 255, 0.02);
            border-bottom: 1px solid var(--gold-soft);
        }

        .plans-table td {
            padding: 16px 24px;
            font-size: 14px;
            color: var(--text);
            border-bottom: 1px solid rgba(255, 255, 255, 0.04);
            vertical-align: middle;
        }

        .plans-table tbody tr {
            transition: background .18s ease;
        }

        .plans-table tbody tr:hover {
            background: var(--gold-soft);
        }

        .plans-table tbody tr:last-child td {
            border-bottom: none;
        }

        .col-date {
            width: 1%;
            white-space: nowrap;
        }

        .plan-cell {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .plan-icon {
            flex-shrink: 0;
            width: 34px;
            height: 34px;
            display: grid;
            place-items: center;
            border-radius: 10px;
            color: var(--gold);
            background: var(--gold-soft);
            font-size: 13px;
        }

        .plan-text {
            font-weight: 500;
            line-height: 1.5;
        }

        .date-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            font-size: 12.5px;
            font-weight: 600;
            border-radius: 8px;
            color: var(--muted);
            background: var(--surface-2);
        }

        .date-pill i {
            font-size: 10px;
        }

        .date-pill.start i {
            color: #4ade80;
        }

        .date-pill.end i {
            color: #f87171;
        }

        /* ===== حالة فارغة ===== */
        .empty-state {
            text-align: center;
            padding: 46px 20px;
        }

        .empty-icon {
            width: 64px;
            height: 64px;
            margin: 0 auto 16px;
            display: grid;
            place-items: center;
            font-size: 24px;
            color: var(--gold);
            background: var(--gold-soft);
            border-radius: 50%;
        }

        .empty-title {
            margin: 0 0 4px;
            font-size: 16px;
            font-weight: 700;
            color: var(--text);
        }

        .empty-sub {
            margin: 0 0 18px;
            font-size: 13px;
            color: var(--muted);
        }

        /* ===== استجابة الشاشات الصغيرة ===== */
        @media (max-width: 640px) {
            .hero-main {
                padding: 22px;
            }

            .hero-action {
                width: 100%;
            }

            .add-plan-btn {
                width: 100%;
                justify-content: center;
            }

            .hero-name {
                font-size: 23px;
            }
        }
    </style>
@endsection
