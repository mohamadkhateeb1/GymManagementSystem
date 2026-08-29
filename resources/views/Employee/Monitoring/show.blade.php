@extends('Employee.layouts.app')

@section('title', 'ملف اللاعب والخطط | Elite Club')
@section('styles')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        /* =========================================================
           THEME VARIABLES
           لا تعتمد على .player-profile-container
           حتى تعمل المودالات الموجودة خارج الـ container أيضاً
        ========================================================= */

        :root {
            --profile-bg: #f5f6f8;
            --profile-surface: #ffffff;
            --profile-surface-2: #f8f9fb;
            --profile-surface-3: #eef0f4;

            --profile-text: #181b22;
            --profile-text-secondary: #4b5563;
            --profile-muted: #7b8492;

            --profile-border: #e1e5eb;
            --profile-border-hover: #cdd3dc;

            --gold: #b38a38;
            --gold-soft: rgba(179, 138, 56, .10);
            --gold-line: rgba(179, 138, 56, .24);

            --tracker-blue: #2563eb;
            --tracker-blue-soft: rgba(37, 99, 235, .09);

            --special: #6366f1;
            --special-soft: rgba(99, 102, 241, .09);

            --danger: #dc2626;
            --success: #16a34a;
            --warning: #d99b00;

            --modal-bg: rgba(15, 23, 42, .58);

            --card-shadow:
                0 5px 20px rgba(15, 23, 42, .055);

            --card-shadow-hover:
                0 12px 32px rgba(15, 23, 42, .09);
        }

        /* Dark mode */
        html.dark,
        body.dark,
        html[data-theme="dark"],
        body[data-theme="dark"],
        html.dark-mode,
        body.dark-mode {
            --profile-bg: #101216;
            --profile-surface: #181b22;
            --profile-surface-2: #20242d;
            --profile-surface-3: #272c35;

            --profile-text: #f3f4f6;
            --profile-text-secondary: #c5cad3;
            --profile-muted: #8c94a3;

            --profile-border: rgba(255, 255, 255, .075);
            --profile-border-hover: rgba(255, 255, 255, .15);

            --gold: #d0ae61;
            --gold-soft: rgba(208, 174, 97, .11);
            --gold-line: rgba(208, 174, 97, .25);

            --tracker-blue: #60a5fa;
            --tracker-blue-soft: rgba(96, 165, 250, .10);

            --special: #818cf8;
            --special-soft: rgba(129, 140, 248, .10);

            --danger: #f87171;
            --success: #4ade80;
            --warning: #eab308;

            --modal-bg: rgba(0, 0, 0, .76);

            --card-shadow:
                0 12px 35px rgba(0, 0, 0, .25);

            --card-shadow-hover:
                0 18px 45px rgba(0, 0, 0, .35);
        }

        /* =========================================================
           MAIN
        ========================================================= */

        .player-profile-container {
            --surface: var(--profile-surface);
            --surface-2: var(--profile-surface-2);
            --text: var(--profile-text);
            --muted: var(--profile-muted);

            --gold: var(--gold);
            --gold-soft: var(--gold-soft);
            --gold-line: var(--gold-line);

            --tracker-blue: var(--tracker-blue);
            --tracker-blue-soft: var(--tracker-blue-soft);

            --special: var(--special);
            --special-soft: var(--special-soft);

            font-family: 'Tajawal', sans-serif;
            color: var(--profile-text);
            width: 100%;
        }

        /* =========================================================
           BACK BUTTON
        ========================================================= */

        .back-btn {
            background: var(--profile-surface);
            color: var(--profile-text);
            border: 1px solid var(--profile-border);

            padding: 9px 16px;
            border-radius: 9px;

            text-decoration: none;
            font-size: 13px;
            font-weight: 700;

            display: inline-flex;
            align-items: center;
            gap: 8px;

            transition: all .2s ease;
            box-shadow: 0 2px 8px rgba(0, 0, 0, .03);
        }

        .back-btn i {
            color: var(--gold);
        }

        .back-btn:hover {
            color: var(--gold);
            border-color: var(--gold);
            transform: translateY(-1px);
            box-shadow: var(--card-shadow);
        }

        /* =========================================================
           BUTTONS
        ========================================================= */

        .btn-add-custom,
        .btn-add-special,
        .btn-rate-player,
        .btn-add-progress {
            font-family: 'Tajawal', sans-serif;
            cursor: pointer;
            transition: all .2s ease;
        }

        .btn-add-custom {
            background: var(--gold-soft);
            color: var(--gold);
            border: 1px solid var(--gold-line);

            padding: 7px 13px;
            border-radius: 8px;

            font-size: 12px;
            font-weight: 700;
        }

        .btn-add-custom:hover {
            background: var(--gold);
            color: #fff;
            transform: translateY(-1px);
        }

        .btn-add-special {
            background: var(--special-soft);
            color: var(--special);
            border: 1px solid rgba(99, 102, 241, .28);

            padding: 7px 13px;
            border-radius: 8px;

            font-size: 12px;
            font-weight: 700;
        }

        .btn-add-special:hover {
            background: var(--special);
            color: #fff;
            transform: translateY(-1px);
        }

        .btn-rate-player {
            background: rgba(234, 179, 8, .10);
            color: var(--warning);
            border: 1px solid rgba(234, 179, 8, .28);

            padding: 7px 14px;
            border-radius: 8px;

            font-size: 12px;
            font-weight: 700;
        }

        .btn-rate-player:hover {
            background: var(--warning);
            color: #fff;
            transform: translateY(-1px);
        }

        .btn-add-progress {
            background: var(--tracker-blue-soft);
            color: var(--tracker-blue);
            border: 1px solid rgba(37, 99, 235, .25);

            padding: 7px 14px;
            border-radius: 8px;

            font-size: 12px;
            font-weight: 700;
        }

        .btn-add-progress:hover {
            background: var(--tracker-blue);
            color: #fff;
            transform: translateY(-1px);
        }

        /* =========================================================
           HEADER CARD
        ========================================================= */

        .profile-header-card {
            background: var(--profile-surface);
            border: 1px solid var(--profile-border);
            border-radius: 16px;

            padding: 22px 24px;
            margin-bottom: 24px;

            display: flex;
            justify-content: space-between;
            align-items: center;

            flex-wrap: wrap;
            gap: 20px;

            box-shadow: var(--card-shadow);

            position: relative;
            overflow: hidden;
        }

        .profile-header-card::before {
            content: "";
            position: absolute;
            top: 0;
            right: 0;
            left: 0;

            height: 3px;

            background: linear-gradient(
                90deg,
                transparent,
                var(--gold),
                transparent
            );

            opacity: .7;
        }

        .player-info-block {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .player-avatar-icon {
            width: 62px;
            height: 62px;
            flex: 0 0 62px;

            background: var(--gold-soft);
            border: 1px solid var(--gold-line);

            border-radius: 15px;

            display: flex;
            align-items: center;
            justify-content: center;

            color: var(--gold);
            font-size: 24px;
        }

        .player-meta h2 {
            margin: 0 0 7px 0;
            font-size: 20px;
            font-weight: 800;
            color: var(--profile-text);
        }

        .meta-badges {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .badge-item {
            font-size: 11.5px;
            padding: 5px 10px;

            border-radius: 7px;
            font-weight: 700;

            background: var(--profile-surface-2);
            border: 1px solid var(--profile-border);

            color: var(--profile-text-secondary);
        }

        .badge-gold {
            background: var(--gold-soft);
            border-color: var(--gold-line);
            color: var(--gold);
        }

        /* =========================================================
           MAIN GRID
        ========================================================= */

        .profile-main-layout {
            display: grid;
            grid-template-columns: minmax(0, 2fr) minmax(320px, 1fr);

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

        /* =========================================================
           PANELS / CARDS
        ========================================================= */

        .plan-panel {
            background: var(--profile-surface);

            border: 1px solid var(--profile-border);
            border-radius: 15px;

            overflow: hidden;

            box-shadow: var(--card-shadow);

            transition:
                border-color .2s ease,
                box-shadow .2s ease,
                transform .2s ease;
        }

        .plan-panel:hover {
            border-color: var(--profile-border-hover);
            box-shadow: var(--card-shadow-hover);
        }

        .plan-panel.special-panel {
            border-color: rgba(99, 102, 241, .25);
        }

        .panel-title-bar {
            min-height: 58px;

            padding: 13px 18px;

            border-bottom: 1px solid var(--profile-border);

            background: var(--profile-surface-2);

            display: flex;
            align-items: center;
            justify-content: space-between;

            gap: 10px;
        }

        .panel-title-bar h3 {
            margin: 0;

            color: var(--profile-text);

            font-size: 14px;
            font-weight: 800;

            display: flex;
            align-items: center;
            gap: 8px;
        }

        .panel-title-bar i {
            color: var(--gold);
        }

        .special-panel .panel-title-bar i {
            color: var(--special);
        }

        /* =========================================================
           LIST
        ========================================================= */

        .plan-list {
            padding: 15px;

            display: flex;
            flex-direction: column;

            gap: 12px;

            max-height: 450px;
            overflow-y: auto;

            background: var(--profile-surface);
        }

        .plan-list::-webkit-scrollbar {
            width: 5px;
        }

        .plan-list::-webkit-scrollbar-track {
            background: transparent;
        }

        .plan-list::-webkit-scrollbar-thumb {
            background: var(--profile-border-hover);
            border-radius: 20px;
        }

        /* =========================================================
           INNER CARD
        ========================================================= */

        .plan-card {
            background: var(--profile-surface-2);

            border: 1px solid var(--profile-border);

            border-radius: 11px;

            padding: 14px;

            transition: all .2s ease;
        }

        .plan-card:hover {
            border-color: var(--profile-border-hover);
            transform: translateY(-1px);
        }

        .plan-card.rating-card-item {
            border-right: 4px solid var(--warning);
        }

        .plan-card.progress-card-item {
            border-right: 4px solid var(--tracker-blue);
        }

        .plan-card.special-item {
            border-right: 4px solid var(--special);
        }

        .plan-card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;

            gap: 10px;

            margin-bottom: 10px;

            border-bottom: 1px solid var(--profile-border);

            padding-bottom: 8px;
        }

        .plan-card-title {
            font-weight: 800;
            color: var(--profile-text);
            font-size: 13.5px;
        }

        .plan-card-calories {
            font-size: 11px;

            color: var(--gold);

            background: var(--gold-soft);

            padding: 3px 8px;

            border-radius: 5px;

            font-weight: 800;
            white-space: nowrap;
        }

        .plan-details-text {
            font-size: 12.5px;
            color: var(--profile-muted);

            line-height: 1.7;

            white-space: pre-line;
        }

        .plan-dates {
            margin-top: 10px;

            font-size: 10.5px;
            color: var(--profile-muted);

            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .item-delete-btn {
            background: transparent;
            border: none;

            color: var(--danger);

            cursor: pointer;

            font-size: 12px;

            padding: 4px;

            transition: .2s ease;
        }

        .item-delete-btn:hover {
            transform: scale(1.15);
        }

        /* =========================================================
           MACROS
        ========================================================= */

        .macros-row {
            display: flex;
            gap: 6px;
            flex-wrap: wrap;
            margin-top: 9px;
        }

        .macro-chip {
            font-size: 10.5px;
            font-weight: 700;

            padding: 4px 8px;

            border-radius: 5px;
        }

        .macro-chip.protein {
            background: rgba(96, 165, 250, .12);
            color: #60a5fa;
        }

        .macro-chip.carbs {
            background: rgba(234, 179, 8, .12);
            color: #eab308;
        }

        .macro-chip.fats {
            background: rgba(248, 113, 113, .12);
            color: #f87171;
        }

        /* =========================================================
           EXERCISE
        ========================================================= */

        .exercise-meta {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;

            font-size: 11.5px;
            color: var(--profile-muted);

            margin-top: 6px;
        }

        .exercise-meta span {
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        /* =========================================================
           EMPTY
        ========================================================= */

        .empty-plan-box {
            text-align: center;

            padding: 42px 20px;

            color: var(--profile-muted);

            font-size: 12.5px;
        }

        .empty-plan-box::before {
            content: "◌";
            display: block;

            font-size: 25px;

            margin-bottom: 7px;

            opacity: .45;
        }

        /* =========================================================
           CHART
        ========================================================= */

        .progress-chart-box {
            padding: 18px 20px 10px;

            border-bottom: 1px solid var(--profile-border);

            background: var(--profile-surface);
        }

        .progress-chart-canvas-wrap {
            position: relative;
            height: 200px;
        }

        .progress-chart-empty {
            text-align: center;

            padding: 30px 20px;

            color: var(--profile-muted);

            font-size: 12.5px;

            background: var(--profile-surface);
        }

        .stars-display {
            color: #eab308;
            font-size: 13px;
        }

        /* =========================================================
           FIELDS
        ========================================================= */

        .field-row {
            display: flex;
            gap: 10px;
        }

        .field-row .field-group {
            flex: 1;
        }

        .field-hint {
            display: block;

            margin-top: -10px;
            margin-bottom: 16px;

            font-size: 11px;

            color: var(--profile-muted);
        }

        .field-group {
            margin-bottom: 16px;
        }

        .field-label {
            display: block;

            margin-bottom: 7px;

            font-size: 12.5px;

            color: var(--profile-text);

            font-weight: 700;
        }

        .field-input {
            width: 100%;

            padding: 11px 12px;

            background: var(--profile-surface-2);

            border: 1px solid var(--profile-border);

            border-radius: 8px;

            color: var(--profile-text);

            font-family: 'Tajawal', sans-serif;

            outline: none;

            box-sizing: border-box;

            transition: all .2s ease;
        }

        .field-input::placeholder {
            color: var(--profile-muted);
            opacity: .75;
        }

        .field-input:focus {
            border-color: var(--gold);

            box-shadow:
                0 0 0 3px var(--gold-soft);
        }

        textarea.field-input {
            resize: vertical;
            min-height: 90px;
        }

        select.field-input {
            cursor: pointer;
        }

        input[type="file"].field-input {
            padding: 8px;
        }

        /* =========================================================
           SUBMIT
        ========================================================= */

        .btn-submit {
            width: 100%;

            padding: 12px;

            font-weight: 800;

            border-radius: 9px;

            border: none;

            cursor: pointer;

            font-family: 'Tajawal', sans-serif;

            transition: all .2s ease;
        }

        .btn-submit:hover {
            transform: translateY(-1px);

            filter: brightness(1.05);

            box-shadow:
                0 7px 18px rgba(0, 0, 0, .14);
        }

        /* =========================================================
           MODALS
           مهم: هذه القواعد Global لأن الـ modal خارج
           .player-profile-container
        ========================================================= */

        .modal {
            display: none;

            position: fixed;

            z-index: 99999;

            inset: 0;

            background: var(--modal-bg);

            backdrop-filter: blur(7px);
            -webkit-backdrop-filter: blur(7px);

            align-items: center;
            justify-content: center;

            padding: 20px;

            box-sizing: border-box;
        }

        .modal.open {
            display: flex;
        }

        .modal-content {
            background: var(--profile-surface);

            border: 1px solid var(--profile-border);

            width: 100%;

            max-width: 500px;

            max-height: calc(100vh - 40px);

            border-radius: 16px;

            overflow: hidden;

            box-shadow:
                0 25px 70px rgba(0, 0, 0, .28);

            animation: modalShow .18s ease-out;
        }

        @keyframes modalShow {
            from {
                opacity: 0;
                transform: translateY(12px) scale(.98);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .modal-header {
            min-height: 58px;

            padding: 14px 18px;

            border-bottom: 1px solid var(--profile-border);

            background: var(--profile-surface-2);

            display: flex;
            justify-content: space-between;
            align-items: center;

            box-sizing: border-box;
        }

        .modal-header h4 {
            margin: 0;

            color: var(--profile-text);

            font-size: 14px;

            font-weight: 800;

            display: flex;
            align-items: center;

            gap: 8px;
        }

        .close-modal {
            width: 30px;
            height: 30px;

            display: flex;
            align-items: center;
            justify-content: center;

            color: var(--profile-muted);

            cursor: pointer;

            font-size: 22px;
            font-weight: 400;

            line-height: 1;

            border-radius: 7px;

            transition: all .2s ease;
        }

        .close-modal:hover {
            background: rgba(220, 38, 38, .10);
            color: var(--danger);
        }

        .modal-body {
            padding: 20px;

            max-height: calc(100vh - 120px);

            overflow-y: auto;

            background: var(--profile-surface);
        }

        .modal-body::-webkit-scrollbar {
            width: 5px;
        }

        .modal-body::-webkit-scrollbar-track {
            background: transparent;
        }

        .modal-body::-webkit-scrollbar-thumb {
            background: var(--profile-border-hover);
            border-radius: 20px;
        }

        /* =========================================================
           INLINE COLORS FIX
           لا نغيّر الـ HTML، فقط نخلي الألوان متوافقة
        ========================================================= */

        .player-profile-container [style*="color: #fff"],
        .player-profile-container [style*="color:#fff"] {
            color: var(--profile-text) !important;
        }

        /* النصوص داخل الهيدر */
        .profile-header-card > div:last-child {
            color: var(--profile-muted) !important;
        }

        .profile-header-card > div:last-child span {
            color: var(--profile-text) !important;
        }

        /* =========================================================
           RESPONSIVE
        ========================================================= */

        @media (max-width: 1200px) {
            .profile-main-layout {
                grid-template-columns: 1fr;
            }

            .side-tracking-grid {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 800px) {
            .profile-header-card {
                padding: 18px;
            }

            .player-info-block {
                width: 100%;
            }

            .side-tracking-grid {
                grid-template-columns: 1fr;
            }

            .field-row {
                flex-direction: column;
                gap: 0;
            }
        }

        @media (max-width: 600px) {
            .profile-main-layout {
                gap: 14px;
            }

            .inner-tabs-grid,
            .side-tracking-grid {
                gap: 14px;
            }

            .profile-header-card {
                border-radius: 12px;
                padding: 15px;
            }

            .player-avatar-icon {
                width: 52px;
                height: 52px;
                flex-basis: 52px;
                font-size: 20px;
            }

            .player-meta h2 {
                font-size: 17px;
            }

            .panel-title-bar {
                padding: 12px 14px;
            }

            .panel-title-bar h3 {
                font-size: 13px;
            }

            .plan-list {
                padding: 11px;
            }

            .modal {
                padding: 10px;
            }

            .modal-content {
                max-height: calc(100vh - 20px);
                border-radius: 13px;
            }

            .modal-body {
                padding: 15px;
            }
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

                        @if ($player->hasActiveSubscription())
                            <span class="badge-item"
                                style="color: #4ade80; background: rgba(255,255,255,0.02)">
                                <i class="fas fa-circle" style="font-size: 8px; margin-left: 5px; color: currentColor;"></i>
                                اشتراك نشط
                            </span>
                        @else
                            <span class="badge-item"
                                style="color: #f87171; background: rgba(255,255,255,0.02)">
                                <i class="fas fa-circle" style="font-size: 8px; margin-left: 5px; color: currentColor;"></i>
                                اشتراك منتهي/مجمد
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            <div style="font-size: 12.5px; color: var(--muted);">انضم في: <span
                    style="color: #fff; font-weight: 600;">{{ $player->created_at->format('Y-m-d') }}</span></div>
        </div>

        @php
            $isActive = $player->hasActiveSubscription();
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
                                    <span class="plan-card-title">{{ $trainingPlan->title }}</span>
                                    @if (empty($trainingPlan->player_id))
                                        <span class="badge-item" style="font-size: 11px; color: var(--gold);">عامة</span>
                                    @else
                                        <span class="badge-item"
                                            style="font-size: 11px; color: #818cf8; background: rgba(129,140,248,0.1);">خاصة
                                            باللاعب</span>
                                    @endif
                                </div>
                                <div class="plan-details-text">المستوى المستهدف: {{ $trainingPlan->level ?? 'غير محدد' }}</div>
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

                    {{-- 📈 رسم بياني لتطور الوزن ونسبة الدهون عبر الوقت — نفس شكل البيانات
                         المتوقع لاحقاً من API التطبيق (تاريخ، وزن، دهون، عضل)، حتى يسهل
                         تحويل هذه الشاشة لنقطة نهاية API تغذّي شاشة "السجل" بالتطبيق مباشرة. --}}
                    @if ($player->bodyProgress->count() >= 2)
                        <div class="progress-chart-box">
                            <div class="progress-chart-canvas-wrap">
                                <canvas id="bodyProgressChart"></canvas>
                            </div>
                        </div>
                    @elseif ($player->bodyProgress->count() === 1)
                        <div class="progress-chart-empty">
                            <i class="fas fa-chart-line" style="margin-left: 6px;"></i>
                            بحاجة لقياس ثانٍ على الأقل حتى يظهر رسم بياني لتطور اللاعب.
                        </div>
                    @endif

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
                        <label class="field-label">عنوان الخطة التدريبية الحصرية</label>
                        <input type="text" name="title" class="field-input"
                            placeholder="مثال: جدول تضخيم خاص - 4 أيام" required>
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

    @if ($player->bodyProgress->count() >= 2)
        @php
            // 📈 نرتب السجل تصاعدياً (الأقدم أولاً) لأن bodyProgress محمّلة تنازلياً
            // لعرض القائمة، بينما الرسم البياني يحتاج ترتيباً زمنياً طبيعياً.
            // هذا الشكل بالضبط (تاريخ/وزن/دهون) هو ما سيُرجعه لاحقاً API التطبيق.
            $progressChartData = [];
            foreach ($player->bodyProgress->sortBy('created_at')->values() as $p) {
                $progressChartData[] = [
                    'date' => \Carbon\Carbon::parse($p->created_at)->format('Y-m-d'),
                    'weight' => (float) $p->weight,
                    'body_fat_pct' => $p->body_fat_pct !== null ? (float) $p->body_fat_pct : null,
                ];
            }
        @endphp
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.4/chart.umd.min.js"></script>
        <script>
            const progressData = @json($progressChartData);

            new Chart(document.getElementById('bodyProgressChart'), {
                type: 'line',
                data: {
                    labels: progressData.map(p => p.date),
                    datasets: [
                        {
                            label: 'الوزن (كغ)',
                            data: progressData.map(p => p.weight),
                            borderColor: '#c9a961',
                            backgroundColor: 'rgba(201, 169, 97, 0.12)',
                            fill: true,
                            tension: 0.3,
                            yAxisID: 'y',
                        },
                        {
                            label: 'نسبة الدهون (%)',
                            data: progressData.map(p => p.body_fat_pct),
                            borderColor: '#3b82f6',
                            borderDash: [5, 4],
                            fill: false,
                            tension: 0.3,
                            yAxisID: 'y1',
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            labels: {color: '#8a8f9c', font: {family: 'Tajawal', size: 11}}
                        },
                        tooltip: {rtl: true, titleFont: {family: 'Tajawal'}, bodyFont: {family: 'Tajawal'}}
                    },
                    scales: {
                        x: {grid: {display: false}, ticks: {color: '#8a8f9c', font: {family: 'Tajawal', size: 10}}},
                        y: {
                            position: 'left',
                            grid: {color: 'rgba(255,255,255,0.05)'},
                            ticks: {color: '#c9a961', font: {size: 10}},
                            title: {display: true, text: 'كغ', color: '#c9a961', font: {size: 10}}
                        },
                        y1: {
                            position: 'right',
                            grid: {display: false},
                            ticks: {color: '#3b82f6', font: {size: 10}},
                            title: {display: true, text: '%', color: '#3b82f6', font: {size: 10}}
                        }
                    }
                }
            });
        </script>
    @endif
@endsection