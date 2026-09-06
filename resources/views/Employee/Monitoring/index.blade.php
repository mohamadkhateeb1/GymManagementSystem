@extends('Employee.layouts.app')

@section('title', 'لوحة المراقبة والمستويات | Elite Club')

@section('styles')

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link
        href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800;900&family=Tajawal:wght@400;500;700;800&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        .monitoring-container {
            width: 100%;
            padding: 0;
            color: var(--text);
            font-family:
                "Cairo",
                "Tajawal",
                Arial,
                sans-serif;
            min-width: 0;
        }

        .monitoring-header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 24px;
            padding: 2px 2px 0;
        }

        .monitoring-header-content {
            min-width: 0;
            max-width: 100%;
        }

        .page-header-title {
            margin: 0 0 7px;
            color: var(--text);
            font-size: 27px;
            font-weight: 900;
            line-height: 1.45;
            letter-spacing: -.5px;
            overflow-wrap: anywhere;
        }

        .page-header-title i {
            margin-left: 9px;
            color: var(--gold);
            font-size: 22px;
        }

        .monitoring-subtitle {
            display: block;
            color: var(--muted);
            font-size: 12px;
            font-weight: 550;
            line-height: 1.9;
            overflow-wrap: anywhere;
        }

        .flash-wrapper {
            margin-bottom: 18px !important;
            min-width: 0;
        }

        .panel-luxury {
            position: relative;
            overflow: hidden;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 19px;
            box-shadow: var(--shadow-sm);
            transition:
                border-color .25s ease,
                box-shadow .25s ease,
                background .25s ease;
            min-width: 0;
            max-width: 100%;
        }

        .panel-luxury::before {
            content: "";
            position: absolute;
            top: 0;
            right: 0;
            left: 0;
            height: 3px;
            background:
                linear-gradient(90deg,
                    transparent,
                    var(--gold),
                    var(--gold-light, #e6c978),
                    var(--gold),
                    transparent);
            opacity: .75;
            pointer-events: none;
        }

        .panel-luxury:hover {
            border-color:
                color-mix(in srgb,
                    var(--gold) 25%,
                    var(--border));
            box-shadow: var(--shadow);
        }

        .panel-luxury-head {
            min-height: 76px;
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 15px 21px;
            background:
                color-mix(in srgb,
                    var(--gold) 2%,
                    var(--surface));
            border-bottom: 1px solid var(--border);
            min-width: 0;
        }

        .panel-luxury-head-icon {
            width: 43px;
            height: 43px;
            flex: 0 0 43px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gold);
            background:
                color-mix(in srgb,
                    var(--gold) 9%,
                    var(--surface-2));
            border:
                1px solid color-mix(in srgb,
                    var(--gold) 22%,
                    var(--border));
            border-radius: 11px;
            font-size: 15px;
            box-shadow: 0 6px 15px rgba(201, 169, 97, .06);
        }

        .panel-luxury-head>div:last-child {
            min-width: 0;
        }

        .panel-luxury-head h3 {
            margin: 0;
            color: var(--text);
            font-size: 14px;
            font-weight: 850;
            line-height: 1.6;
            overflow-wrap: anywhere;
        }

        .panel-luxury-head p {
            margin: 3px 0 0;
            color: var(--muted);
            font-size: 10px;
            font-weight: 500;
            line-height: 1.7;
            overflow-wrap: anywhere;
        }

        .table-wrapper {
            width: 100%;
            max-width: 100%;
            overflow-x: auto;
            scrollbar-width: thin;
            scrollbar-color: var(--border) transparent;
            -webkit-overflow-scrolling: touch;
        }

        .table-wrapper::-webkit-scrollbar {
            height: 7px;
        }

        .table-wrapper::-webkit-scrollbar-track {
            background: transparent;
        }

        .table-wrapper::-webkit-scrollbar-thumb {
            background: var(--border);
            border-radius: 20px;
        }

        .table-wrapper::-webkit-scrollbar-thumb:hover {
            background:
                color-mix(in srgb,
                    var(--gold) 40%,
                    var(--border));
        }

        .luxury-table {
            width: 100%;
            min-width: 1180px;
            border-collapse: collapse;
            border-spacing: 0;
        }

        .luxury-table th {
            padding: 16px 20px;
            color: var(--muted);
            background: var(--surface-2);
            border-bottom: 1px solid var(--border);
            text-align: right;
            font-size: 10px;
            font-weight: 850;
            line-height: 1.6;
            letter-spacing: .1px;
            white-space: nowrap;
        }

        .luxury-table td {
            padding: 17px 20px;
            color: var(--text);
            border-bottom:
                1px solid color-mix(in srgb,
                    var(--border) 65%,
                    transparent);
            vertical-align: middle;
            font-size: 11px;
            font-weight: 550;
            line-height: 1.7;
            transition:
                background .2s ease,
                color .2s ease;
        }

        .luxury-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .luxury-table tbody tr {
            transition: background .2s ease;
        }

        .luxury-table tbody tr:hover {
            background:
                color-mix(in srgb,
                    var(--gold) 4%,
                    var(--surface));
        }

        .luxury-table tbody tr:hover td {
            color: var(--text);
        }

        .player-name {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            color: var(--text);
            font-size: 12px;
            font-weight: 850;
            white-space: nowrap;
        }

        .player-name i {
            width: 34px;
            height: 34px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex: 0 0 34px;
            color: var(--gold);
            background:
                color-mix(in srgb,
                    var(--gold) 9%,
                    var(--surface-2));
            border:
                1px solid color-mix(in srgb,
                    var(--gold) 18%,
                    var(--border));
            border-radius: 10px;
            font-size: 11px;
        }

        .status-badge {
            min-height: 29px;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 5px 11px;
            border-radius: 9px;
            font-size: 9px;
            font-weight: 850;
            line-height: 1.5;
            white-space: nowrap;
        }

        .status-badge::before {
            content: "";
            width: 6px;
            height: 6px;
            flex: 0 0 6px;
            border-radius: 50%;
            background: currentColor;
            box-shadow: 0 0 7px currentColor;
        }

        .badge-active {
            color: var(--success, #4ade80);
            background:
                color-mix(in srgb,
                    var(--success, #4ade80) 8%,
                    var(--surface-2));
            border:
                1px solid color-mix(in srgb,
                    var(--success, #4ade80) 19%,
                    var(--border));
        }

        .badge-expired {
            color: var(--danger, #f87171);
            background:
                color-mix(in srgb,
                    var(--danger, #f87171) 8%,
                    var(--surface-2));
            border:
                1px solid color-mix(in srgb,
                    var(--danger, #f87171) 19%,
                    var(--border));
        }

        .badge-none {
            color: var(--muted);
            background:
                color-mix(in srgb,
                    var(--muted) 7%,
                    var(--surface-2));
            border:
                1px solid color-mix(in srgb,
                    var(--muted) 15%,
                    var(--border));
        }

        .level-badge {
            display: inline-flex;
            align-items: center;
            min-height: 30px;
            padding: 5px 11px;
            color: var(--gold-dark);
            background:
                color-mix(in srgb,
                    var(--gold) 9%,
                    var(--surface-2));
            border:
                1px solid color-mix(in srgb,
                    var(--gold) 22%,
                    var(--border));
            border-radius: 9px;
            font-size: 9px;
            font-weight: 850;
            text-transform: capitalize;
            line-height: 1.5;
            white-space: nowrap;
        }

        .weight-display {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 30px;
            padding: 5px 11px;
            color: var(--text);
            background:
                color-mix(in srgb,
                    var(--gold) 5%,
                    var(--surface-2));
            border:
                1px solid color-mix(in srgb,
                    var(--gold) 14%,
                    var(--border));
            border-radius: 9px;
            font-size: 9px;
            font-weight: 850;
            white-space: nowrap;
        }

        .rating-stars-gold {
            color: var(--gold);
            font-size: 12px;
            white-space: nowrap;
            filter: drop-shadow(0 0 4px rgba(201, 169, 97, .20));
        }

        .rating-stars-gold i {
            margin: 0 1px;
        }

        .select-level-luxury {
            min-width: 205px;
            min-height: 42px;
            padding: 8px 38px 8px 12px;
            color: var(--text);
            background-color: var(--surface-2);
            background-image:
                url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23c9a961' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: left 11px center;
            background-size: 13px;
            border: 1px solid var(--border);
            border-radius: 10px;
            outline: none;
            appearance: none;
            cursor: pointer;
            font-family:
                "Cairo",
                "Tajawal",
                Arial,
                sans-serif;
            font-size: 9.5px;
            font-weight: 650;
            line-height: 1.5;
            transition:
                background .2s ease,
                border-color .2s ease,
                box-shadow .2s ease;
        }

        .select-level-luxury:hover {
            border-color:
                color-mix(in srgb,
                    var(--gold) 32%,
                    var(--border));
        }

        .select-level-luxury:focus {
            background-color: var(--surface);
            border-color:
                color-mix(in srgb,
                    var(--gold) 60%,
                    var(--border));
            box-shadow:
                0 0 0 4px color-mix(in srgb,
                    var(--gold) 9%,
                    transparent);
        }

        .btn-apply-luxury {
            min-height: 42px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 8px 14px;
            color: #171717;
            background:
                linear-gradient(135deg,
                    var(--gold-light, #e6c978),
                    var(--gold-dark, #b98d3e));
            border: 0;
            border-radius: 10px;
            box-shadow: 0 7px 17px rgba(184, 146, 62, .13);
            cursor: pointer;
            font-family:
                "Cairo",
                "Tajawal",
                Arial,
                sans-serif;
            font-size: 9px;
            font-weight: 900;
            line-height: 1.5;
            white-space: nowrap;
            transition:
                transform .2s ease,
                box-shadow .2s ease,
                filter .2s ease;
        }

        .btn-apply-luxury:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 23px rgba(184, 146, 62, .22);
            filter: brightness(1.04);
        }

        .btn-apply-luxury:active {
            transform: scale(.97);
        }

        .btn-show-luxury {
            min-height: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 8px 13px;
            color: var(--gold-dark);
            background:
                color-mix(in srgb,
                    var(--gold) 8%,
                    var(--surface-2));
            border:
                1px solid color-mix(in srgb,
                    var(--gold) 22%,
                    var(--border));
            border-radius: 10px;
            text-decoration: none;
            font-size: 9px;
            font-weight: 850;
            line-height: 1.5;
            white-space: nowrap;
            transition:
                transform .2s ease,
                background .2s ease,
                border-color .2s ease,
                color .2s ease,
                box-shadow .2s ease;
        }

        .btn-show-luxury:hover {
            color: #171717;
            background:
                linear-gradient(135deg,
                    var(--gold-light, #e6c978),
                    var(--gold-dark, #b98d3e));
            border-color: var(--gold);
            box-shadow: 0 8px 19px rgba(184, 146, 62, .18);
            transform: translateY(-1px);
        }

        .lock-container {
            min-height: 30px;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 6px 10px;
            color: var(--danger, #f87171);
            background:
                color-mix(in srgb,
                    var(--danger, #f87171) 6%,
                    var(--surface-2));
            border:
                1px solid color-mix(in srgb,
                    var(--danger, #f87171) 16%,
                    var(--border));
            border-radius: 9px;
            font-size: 8.5px;
            font-weight: 800;
            line-height: 1.5;
            white-space: nowrap;
        }

        .lock-container i {
            font-size: 9px;
        }

        .empty-state {
            padding: 65px 30px !important;
            color: var(--muted) !important;
            text-align: center !important;
            font-size: 11px !important;
            font-weight: 600 !important;
        }

        .empty-state i {
            display: block;
            margin-bottom: 14px;
            color:
                color-mix(in srgb,
                    var(--gold) 30%,
                    var(--border)) !important;
            font-size: 32px;
        }

        @media (max-width: 1100px) {
            .monitoring-header {
                align-items: flex-start;
                flex-direction: column;
                gap: 5px;
            }
        }

        @media (max-width: 900px) {
            .page-header-title {
                font-size: 23px;
            }

            .monitoring-subtitle {
                font-size: 11px;
            }

            .panel-luxury-head {
                min-height: 68px;
                padding: 13px 17px;
            }

            .panel-luxury-head-icon {
                width: 39px;
                height: 39px;
                flex-basis: 39px;
                font-size: 13px;
            }

            .panel-luxury-head h3 {
                font-size: 12px;
            }

            .panel-luxury-head p {
                font-size: 9px;
            }

            .luxury-table {
                min-width: 1120px;
            }
        }

        @media (max-width: 600px) {
            .monitoring-header {
                margin-bottom: 17px;
                padding: 0;
            }

            .page-header-title {
                font-size: 19px;
                line-height: 1.5;
            }

            .page-header-title i {
                margin-left: 6px;
                font-size: 16px;
            }

            .monitoring-subtitle {
                max-width: 95%;
                font-size: 9.5px;
                line-height: 1.8;
            }

            .panel-luxury {
                border-radius: 15px;
            }

            .panel-luxury-head {
                min-height: auto;
                padding: 14px 13px;
                gap: 10px;
            }

            .panel-luxury-head-icon {
                width: 35px;
                height: 35px;
                flex-basis: 35px;
                border-radius: 9px;
                font-size: 11px;
            }

            .panel-luxury-head h3 {
                font-size: 10px;
                line-height: 1.6;
            }

            .panel-luxury-head p {
                margin-top: 1px;
                font-size: 7.5px;
            }

            .table-wrapper {
                overflow-x: auto;
            }

            .luxury-table {
                min-width: 1080px;
            }

            .luxury-table th {
                padding: 13px 15px;
                font-size: 8.5px;
            }

            .luxury-table td {
                padding: 14px 15px;
                font-size: 9.5px;
            }

            .player-name {
                font-size: 10px;
            }

            .player-name i {
                width: 29px;
                height: 29px;
                flex-basis: 29px;
                border-radius: 8px;
                font-size: 9px;
            }

            .status-badge {
                min-height: 27px;
                padding: 5px 9px;
                font-size: 8px;
            }

            .level-badge {
                min-height: 27px;
                padding: 5px 9px;
                font-size: 8px;
            }

            .weight-display {
                min-height: 27px;
                padding: 5px 9px;
                font-size: 8px;
            }

            .rating-stars-gold {
                font-size: 10px;
            }

            .select-level-luxury {
                min-width: 185px;
                min-height: 38px;
                font-size: 8.5px;
            }

            .btn-apply-luxury {
                min-height: 38px;
                padding: 7px 11px;
                font-size: 8px;
            }

            .btn-show-luxury {
                min-height: 37px;
                padding: 7px 10px;
                font-size: 8px;
            }

            .lock-container {
                font-size: 7.5px;
            }

            .empty-state {
                padding: 50px 20px !important;
                font-size: 9px !important;
            }

            .empty-state i {
                font-size: 27px;
            }
        }

        @media (max-width: 390px) {
            .page-header-title {
                font-size: 17px;
            }

            .monitoring-subtitle {
                font-size: 8.5px;
            }

            .panel-luxury-head {
                padding: 12px 11px;
            }

            .panel-luxury-head-icon {
                width: 32px;
                height: 32px;
                flex-basis: 32px;
            }

            .panel-luxury-head h3 {
                font-size: 9px;
            }

            .panel-luxury-head p {
                font-size: 7px;
            }

            .luxury-table {
                min-width: 1050px;
            }
        }

        @media (prefers-reduced-motion: reduce) {

            .panel-luxury,
            .luxury-table tbody tr,
            .btn-apply-luxury,
            .btn-show-luxury {
                transition: none;
            }
        }
    </style>

@endsection

@section('content')

    <div class="dashboard-wrapper monitoring-container">

        <div class="flash-wrapper">
            <x-flash-message />
        </div>

        <div class="monitoring-header">

            <div class="monitoring-header-content">

                <h2 class="page-header-title">

                    <i class="fas fa-chart-line"></i>

                    لوحة المراقبة وإدارة المستويات

                </h2>

                <span class="monitoring-subtitle">

                    تحديث ومراقبة حزم التمارين والأوزان البدنية
                    للاعبين تلقائياً لايف

                </span>

            </div>

        </div>

        <div class="panel-luxury">

            <div class="panel-luxury-head">

                <div class="panel-luxury-head-icon">

                    <i class="fas fa-id-card-clip"></i>

                </div>

                <div>

                    <h3>
                        قائمة المشتركين وتفعيل الأتمتة المخصصة للمستويات
                    </h3>

                    <p>
                        إدارة المستويات ومتابعة حالة اللاعبين والاشتراكات
                    </p>

                </div>

            </div>

            <div class="table-wrapper">

                <table class="luxury-table">

                    <thead>

                        <tr>

                            <th>
                                اسم اللاعب
                            </th>

                            <th>
                                حالة الاشتراك
                            </th>

                            <th>
                                المستوى الفعلي
                            </th>

                            <th style="width: 14%; text-align: center;">
                                الوزن الحالي
                            </th>

                            <th style="width: 16%; text-align: center;">
                                التقييم العام
                            </th>

                            <th>
                                إسقاط وتنزيل الباقات الفورية
                            </th>

                            <th style="text-align: center;">
                                إجراءات
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($players as $player)

                            <tr>

                                <td>

                                    <span class="player-name">

                                        <i class="fas fa-user"></i>

                                        {{ $player->name }}

                                    </span>

                                </td>

                                <td>

                                    @if ($player->subscription)
                                        <span
                                            class="status-badge
                                        {{ $player->hasActiveSubscription() ? 'badge-active' : 'badge-expired' }}">

                                            {{ $player->hasActiveSubscription() ? 'نشط' : 'منتهي/مجمد' }}

                                        </span>
                                    @else
                                        <span class="status-badge badge-none">
                                            غير مشترك
                                        </span>
                                    @endif

                                </td>

                                <td>

                                    <span class="level-badge">

                                        {{ $player->level ?? 'لم يحدد بعد' }}

                                    </span>

                                </td>

                                <td style="text-align: center;">

                                    @if ($player->latest_weight)
                                        <span class="weight-display">

                                            {{ $player->latest_weight }}
                                            كغ

                                        </span>
                                    @else
                                        <span class="status-badge badge-none" style="font-size: 8px;">
                                            ---
                                        </span>
                                    @endif

                                </td>

                                <td style="text-align: center;">

                                    @if (!is_null($player->average_rating))
                                        @php

                                            $roundRating = round((float) $player->average_rating);
                                        @endphp

                                        <div class="rating-stars-gold"
                                            title="متوسط التقييم: {{ round((float) $player->average_rating, 1) }} من 5">

                                            @for ($i = 1; $i <= 5; $i++)
                                                <i class="{{ $i <= $roundRating ? 'fas' : 'far' }} fa-star"></i>
                                            @endfor

                                        </div>
                                    @else
                                        <span class="status-badge badge-none" style="font-size: 8px;">
                                            لم يقيّم
                                        </span>
                                    @endif

                                </td>

                                <td>

                                    @if ($player->hasActiveSubscription())
                                        <form action="{{ route('employee.monitoring.assign-level', $player->id) }}"
                                            method="POST"
                                            style="
                                            display:flex;
                                            gap:9px;
                                            align-items:center;
                                        ">

                                            @csrf

                                            <select name="level" class="select-level-luxury" required>

                                                <option value="">
                                                    اختر المستوى لتنزيل الخطة
                                                </option>

                                                <option value="beginner"
                                                    {{ $player->level == 'beginner' ? 'selected' : '' }}>
                                                    Beginner (مبتدئ)
                                                </option>

                                                <option value="intermediate"
                                                    {{ $player->level == 'intermediate' ? 'selected' : '' }}>
                                                    Intermediate (متوسط)
                                                </option>

                                                <option value="advanced"
                                                    {{ $player->level == 'advanced' ? 'selected' : '' }}>
                                                    Advanced (متقدم)
                                                </option>

                                            </select>

                                            <button type="submit" class="btn-apply-luxury">

                                                <i class="fas fa-bolt"></i>

                                                تطبيق الأتمتة

                                            </button>

                                        </form>
                                    @else
                                        <div class="lock-container">

                                            <i class="fas fa-lock"></i>

                                            الحساب مجمد أو منتهي

                                        </div>
                                    @endif

                                </td>

                                <td style="text-align: center;">

                                    <a href="{{ route('employee.monitoring.show', $player->id) }}" class="btn-show-luxury">

                                        <i class="fas fa-chart-line"></i>

                                        عرض وتحليل الملف

                                    </a>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="7" class="empty-state">

                                    <i class="fas fa-folder-open"></i>

                                    لا يوجد لاعبون مسجلون تحت إشرافك حالياً.

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

@endsection
