@extends('Employee.layouts.app')

@section('title', 'تمارين الخطة | Elite Club')

@section('styles')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;800&display=swap" rel="stylesheet">

    <style>
        /* =========================================================
           ELITE CLUB — EXERCISES PAGE
           يعتمد بالكامل على Global Theme من layouts.app
        ========================================================= */

        .ex-container {
            /*
             * لا نعيد تعريف:
             * --surface
             * --surface-2
             * --surface-3
             * --text
             * --muted
             * --border
             *
             * لأنها معرفة في Employee.layouts.app
             * وتتغير تلقائياً بين Light / Dark.
             */

            --ex-gold-soft: rgba(201, 169, 97, 0.10);
            --ex-gold-line: rgba(201, 169, 97, 0.18);

            --ex-success-soft: rgba(54, 179, 126, 0.10);
            --ex-danger-soft: rgba(232, 93, 93, 0.10);
            --ex-blue-soft: rgba(96, 165, 250, 0.10);

            font-family: 'Tajawal', 'Cairo', sans-serif;
            padding: 22px;
            color: var(--text);
            direction: rtl;
        }

        /* =========================================================
           PAGE HEADER
        ========================================================= */

        .ex-page-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 24px;
            padding-bottom: 20px;
            border-bottom: 1px solid var(--border);
        }

        .ex-title-area {
            min-width: 0;
        }

        .ex-title-row {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 8px;
        }

        .ex-title-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;

            color: var(--gold);

            background: linear-gradient(
                135deg,
                rgba(201, 169, 97, 0.18),
                rgba(201, 169, 97, 0.05)
            );

            border: 1px solid var(--border-soft);

            box-shadow:
                0 0 22px rgba(201, 169, 97, 0.06);

            font-size: 18px;
        }

        .ex-title {
            margin: 0;
            color: var(--text);
            font-size: 22px;
            font-weight: 800;
            line-height: 1.4;
        }

        .ex-title span {
            color: var(--gold);
        }

        .ex-subtitle {
            margin: 0;
            color: var(--muted);
            font-size: 13px;
            padding-right: 56px;
        }

        .ex-level {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-right: 5px;
            color: var(--gold-light);
            font-weight: 700;
        }

        /* =========================================================
           BUTTONS
        ========================================================= */

        .ex-actions {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-shrink: 0;
        }

        .back-btn,
        .btn-gold {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;

            text-decoration: none;

            font-family: 'Tajawal', 'Cairo', sans-serif;

            cursor: pointer;

            transition:
                transform .2s ease,
                background .2s ease,
                border-color .2s ease,
                box-shadow .2s ease,
                color .2s ease;
        }

        .back-btn {
            min-height: 42px;
            padding: 0 15px;

            color: var(--text-soft);

            background: var(--surface);

            border: 1px solid var(--border);

            border-radius: 10px;

            font-size: 13px;
            font-weight: 700;
        }

        .back-btn i {
            color: var(--gold);
            transition: transform .2s ease;
        }

        .back-btn:hover {
            color: var(--text);

            background: var(--surface-hover);

            border-color: var(--border-soft);

            transform: translateX(3px);
        }

        .back-btn:hover i {
            transform: translateX(3px);
        }

        .btn-gold {
            min-height: 42px;
            padding: 0 18px;

            border-radius: 10px;

            border: 1px solid rgba(201, 169, 97, .4);

            color: #171a20;

            background: linear-gradient(
                135deg,
                var(--gold-light),
                var(--gold)
            );

            font-size: 13px;
            font-weight: 800;

            box-shadow:
                0 5px 18px rgba(201, 169, 97, .10);
        }

        .btn-gold:hover {
            transform: translateY(-2px);

            box-shadow:
                0 8px 24px rgba(201, 169, 97, .18);

            background: linear-gradient(
                135deg,
                #f0d99d,
                #d5b86d
            );
        }

        /* =========================================================
           ALERTS
        ========================================================= */

        .ex-alert {
            display: flex;
            align-items: flex-start;
            gap: 12px;

            padding: 14px 16px;
            margin-bottom: 18px;

            border-radius: 12px;

            font-size: 13px;
            line-height: 1.7;
        }

        .ex-alert-icon {
            width: 32px;
            height: 32px;

            border-radius: 9px;

            display: flex;
            align-items: center;
            justify-content: center;

            flex-shrink: 0;
        }

        .ex-alert-danger {
            background: var(--ex-danger-soft);
            border: 1px solid rgba(232, 93, 93, .22);
            color: var(--text);
        }

        .ex-alert-danger .ex-alert-icon {
            color: var(--danger);
            background: rgba(232, 93, 93, .12);
        }

        .ex-alert-success {
            background: var(--ex-success-soft);
            border: 1px solid rgba(54, 179, 126, .22);
            color: var(--text);
        }

        .ex-alert-success .ex-alert-icon {
            color: var(--success);
            background: rgba(54, 179, 126, .12);
        }

        .ex-alert ul {
            margin: 0;
            padding-right: 18px;
        }

        /* =========================================================
           PLAN SUMMARY
        ========================================================= */

        .plan-summary {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px;
            margin-bottom: 22px;
        }

        .summary-box {
            position: relative;
            overflow: hidden;

            display: flex;
            align-items: center;
            gap: 12px;

            min-height: 72px;
            padding: 14px 16px;

            background: var(--surface);

            border: 1px solid var(--border);

            border-radius: 12px;

            box-shadow: var(--shadow-sm);

            transition:
                background .25s ease,
                border-color .25s ease,
                box-shadow .25s ease;
        }

        .summary-box:hover {
            background: var(--surface-hover);
            border-color: var(--border-soft);
            box-shadow: var(--shadow);
        }

        .summary-box::after {
            content: "";

            position: absolute;

            left: -30px;
            bottom: -45px;

            width: 100px;
            height: 100px;

            border-radius: 50%;

            background: rgba(201, 169, 97, .035);

            pointer-events: none;
        }

        .summary-icon {
            width: 40px;
            height: 40px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 10px;

            color: var(--gold);

            background: var(--ex-gold-soft);

            border: 1px solid var(--ex-gold-line);

            flex-shrink: 0;
        }

        .summary-info {
            min-width: 0;
        }

        .summary-label {
            display: block;

            color: var(--muted);

            font-size: 11px;

            margin-bottom: 4px;
        }

        .summary-value {
            display: block;

            color: var(--text);

            font-size: 15px;
            font-weight: 800;

            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        /* =========================================================
           EXERCISES GRID
        ========================================================= */

        .ex-grid {
            display: grid;

            grid-template-columns:
                repeat(auto-fill, minmax(290px, 1fr));

            gap: 18px;
        }

        .ex-card {
            position: relative;

            min-width: 0;

            background: var(--surface);

            border: 1px solid var(--border);

            border-radius: 15px;

            overflow: hidden;

            display: flex;
            flex-direction: column;
            justify-content: space-between;

            box-shadow: var(--shadow-sm);

            transition:
                transform .25s ease,
                border-color .25s ease,
                box-shadow .25s ease,
                background .25s ease;
        }

        .ex-card::before {
            content: "";

            position: absolute;

            top: 0;
            right: 0;
            left: 0;

            height: 2px;

            background: linear-gradient(
                90deg,
                transparent,
                rgba(201, 169, 97, .55),
                transparent
            );

            opacity: 0;

            transition: opacity .25s ease;

            z-index: 2;
        }

        .ex-card:hover {
            transform: translateY(-5px);

            border-color: var(--border-soft);

            box-shadow:
                var(--shadow),
                0 0 24px rgba(201, 169, 97, .045);
        }

        .ex-card:hover::before {
            opacity: 1;
        }

        /* =========================================================
           IMAGE
        ========================================================= */

        .ex-media {
            position: relative;

            width: 100%;
            height: 190px;

            background: var(--surface-2);

            overflow: hidden;
        }

        .ex-img {
            width: 100%;
            height: 100%;

            object-fit: cover;

            display: block;

            transition: transform .4s ease;
        }

        .ex-card:hover .ex-img {
            transform: scale(1.035);
        }

        .ex-media::after {
            content: "";

            position: absolute;

            inset: 0;

            background: linear-gradient(
                to top,
                rgba(10, 12, 15, .45),
                transparent 55%
            );

            pointer-events: none;
        }

        .ex-placeholder {
            width: 100%;
            height: 100%;

            background:
                radial-gradient(
                    circle at center,
                    rgba(201, 169, 97, .09),
                    transparent 55%
                ),
                var(--surface-2);

            display: flex;
            align-items: center;
            justify-content: center;

            color: rgba(201, 169, 97, .55);

            font-size: 42px;
        }

        .ex-image-label {
            position: absolute;

            bottom: 12px;
            right: 12px;

            z-index: 3;

            padding: 5px 9px;

            border-radius: 7px;

            background: rgba(12, 14, 18, .72);

            border: 1px solid rgba(255, 255, 255, .08);

            backdrop-filter: blur(6px);

            color: #fff;

            font-size: 10px;
            font-weight: 700;
        }

        /* =========================================================
           CARD BODY
        ========================================================= */

        .ex-body {
            padding: 17px;
            flex-grow: 1;
        }

        .ex-head {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;

            gap: 10px;

            margin-bottom: 14px;
        }

        .ex-name {
            min-width: 0;

            margin: 0;

            color: var(--text);

            font-size: 16px;
            font-weight: 800;

            line-height: 1.5;
        }

        .ex-number {
            color: var(--muted);

            font-size: 10px;
            font-weight: 700;

            margin-bottom: 3px;

            display: block;
        }

        /* =========================================================
           DAY CHIP
        ========================================================= */

        .day-chip {
            display: inline-flex;
            align-items: center;

            gap: 5px;

            padding: 5px 9px;

            border-radius: 7px;

            background: var(--ex-blue-soft);

            color: var(--blue, #60a5fa);

            border: 1px solid rgba(96, 165, 250, .20);

            font-size: 10.5px;
            font-weight: 800;

            white-space: nowrap;

            flex-shrink: 0;
        }

        .day-chip-empty {
            background: var(--surface-3);

            color: var(--muted);

            border-color: var(--border);
        }

        /* =========================================================
           DATA BADGES
        ========================================================= */

        .exercise-stats {
            display: grid;

            grid-template-columns:
                repeat(3, minmax(0, 1fr));

            gap: 7px;

            margin-bottom: 14px;
        }

        .badge-info {
            min-width: 0;

            display: flex;
            align-items: center;
            justify-content: center;

            gap: 5px;

            padding: 7px 6px;

            margin: 0;

            border-radius: 8px;

            background: var(--ex-gold-soft);

            color: var(--gold-light);

            border: 1px solid var(--ex-gold-line);

            font-size: 10.5px;
            font-weight: 800;

            white-space: nowrap;
        }

        .badge-info i {
            font-size: 10px;
            opacity: .8;
        }

        /* =========================================================
           INSTRUCTIONS
        ========================================================= */

        .instructions-box {
            margin-top: 3px;

            padding: 11px 12px;

            border-radius: 9px;

            background: var(--surface-2);

            border-right: 2px solid rgba(201, 169, 97, .30);
        }

        .instructions-title {
            display: flex;
            align-items: center;

            gap: 6px;

            margin-bottom: 6px;

            color: var(--muted);

            font-size: 10px;
            font-weight: 700;
        }

        .instructions-title i {
            color: var(--gold);
        }

        .instructions-text {
            margin: 0;

            color: var(--text-soft);

            font-size: 12px;
            line-height: 1.75;

            white-space: pre-line;
        }

        /* =========================================================
           VIDEO
        ========================================================= */

        .video-link {
            display: inline-flex;
            align-items: center;

            gap: 6px;

            margin-top: 12px;

            padding: 6px 9px;

            border-radius: 7px;

            color: var(--success);

            background: var(--ex-success-soft);

            border: 1px solid rgba(54, 179, 126, .16);

            font-size: 10.5px;
            font-weight: 700;

            text-decoration: none;

            transition: all .2s ease;
        }

        .video-link:hover {
            color: #fff;

            background: var(--success);

            border-color: var(--success);
        }

        /* =========================================================
           CARD FOOTER
        ========================================================= */

        .ex-footer {
            padding: 12px 16px;

            border-top: 1px solid var(--border);

            background: var(--surface-2);
        }

        .btn-delete {
            width: 100%;

            min-height: 38px;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            gap: 7px;

            padding: 7px 12px;

            border-radius: 8px;

            cursor: pointer;

            font-family: 'Tajawal', 'Cairo', sans-serif;

            font-size: 11.5px;
            font-weight: 800;

            color: var(--danger);

            background: var(--ex-danger-soft);

            border: 1px solid rgba(232, 93, 93, .18);

            transition: all .2s ease;
        }

        .btn-delete:hover {
            color: #fff;

            background: var(--danger);

            border-color: var(--danger);

            box-shadow:
                0 5px 16px rgba(232, 93, 93, .12);
        }

        /* =========================================================
           EMPTY STATE
        ========================================================= */

        .empty-state {
            grid-column: 1 / -1;

            text-align: center;

            padding: 65px 25px;

            background: var(--surface);

            border: 1px dashed var(--border-soft);

            border-radius: 15px;

            box-shadow: var(--shadow-sm);
        }

        .empty-icon {
            width: 70px;
            height: 70px;

            margin: 0 auto 16px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 18px;

            color: var(--gold);

            background: var(--ex-gold-soft);

            border: 1px solid var(--ex-gold-line);

            font-size: 28px;
        }

        .empty-state h3 {
            margin: 0 0 7px;

            color: var(--text);

            font-size: 16px;
        }

        .empty-state p {
            margin: 0;

            color: var(--muted);

            font-size: 12px;
        }

        /* =========================================================
           MODAL
        ========================================================= */

        .modal {
            display: none;

            position: fixed;

            z-index: 9999;

            inset: 0;

            padding: 20px;

            background: rgba(5, 7, 10, .62);

            backdrop-filter: blur(9px);

            align-items: center;
            justify-content: center;
        }

        .modal.open {
            display: flex;
        }

        .modal-content {
            position: relative;

            width: 100%;

            max-width: 560px;

            max-height: calc(100vh - 40px);

            background: var(--surface);

            border: 1px solid var(--border-soft);

            border-radius: 17px;

            overflow: hidden;

            box-shadow:
                var(--shadow),
                0 0 35px rgba(201, 169, 97, .04);

            animation: modalFade .25s ease;
        }

        @keyframes modalFade {
            from {
                transform: translateY(-18px) scale(.98);
                opacity: 0;
            }

            to {
                transform: translateY(0) scale(1);
                opacity: 1;
            }
        }

        .modal-header {
            min-height: 62px;

            padding: 0 20px;

            border-bottom: 1px solid var(--border);

            display: flex;

            justify-content: space-between;
            align-items: center;

            background: var(--surface-2);
        }

        .modal-title {
            display: flex;
            align-items: center;

            gap: 9px;

            margin: 0;

            color: var(--text);

            font-size: 15px;
            font-weight: 800;
        }

        .modal-title i {
            color: var(--gold);
        }

        .close-modal {
            width: 32px;
            height: 32px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 8px;

            color: var(--muted);

            cursor: pointer;

            font-size: 21px;

            transition: all .2s ease;
        }

        .close-modal:hover {
            color: var(--text);

            background: var(--ex-danger-soft);
        }

        .modal-body {
            padding: 20px;

            max-height: calc(100vh - 105px);

            overflow-y: auto;
        }

        .modal-body::-webkit-scrollbar {
            width: 5px;
        }

        .modal-body::-webkit-scrollbar-track {
            background: transparent;
        }

        .modal-body::-webkit-scrollbar-thumb {
            background: var(--border);

            border-radius: 10px;
        }

        /* =========================================================
           FORM
        ========================================================= */

        .form-row {
            display: grid;

            grid-template-columns:
                repeat(2, minmax(0, 1fr));

            gap: 11px;
        }

        .field-group {
            margin-bottom: 14px;
        }

        .field-label {
            display: flex;
            align-items: center;

            gap: 6px;

            margin-bottom: 7px;

            color: var(--text);

            font-size: 12px;
            font-weight: 700;
        }

        .field-label i {
            color: var(--gold);

            font-size: 10px;
        }

        .field-input {
            width: 100%;

            min-height: 42px;

            padding: 9px 11px;

            box-sizing: border-box;

            background: var(--surface-2);

            border: 1px solid var(--border);

            border-radius: 9px;

            color: var(--text);

            font-family: 'Tajawal', 'Cairo', sans-serif;

            font-size: 12px;

            outline: none;

            transition:
                border-color .2s ease,
                box-shadow .2s ease,
                background .2s ease,
                color .2s ease;
        }

        .field-input::placeholder {
            color: var(--muted);
        }

        .field-input:focus {
            background: var(--surface-3);

            border-color: var(--gold);

            box-shadow:
                0 0 0 3px rgba(201, 169, 97, .07);
        }

        textarea.field-input {
            min-height: 95px;

            resize: vertical;

            line-height: 1.7;
        }

        select.field-input {
            cursor: pointer;
        }

        input[type="file"].field-input {
            padding: 8px;

            cursor: pointer;
        }

        input[type="file"]::file-selector-button {
            margin-left: 8px;

            padding: 6px 10px;

            border: 0;

            border-radius: 6px;

            background: var(--ex-gold-soft);

            color: var(--gold);

            font-family: 'Tajawal', 'Cairo', sans-serif;

            font-size: 11px;
            font-weight: 700;

            cursor: pointer;
        }

        .modal-submit {
            width: 100%;

            margin-top: 4px;

            min-height: 44px;
        }

        /* =========================================================
           RESPONSIVE
        ========================================================= */

        @media (max-width: 900px) {

            .ex-page-top {
                align-items: flex-start;

                flex-direction: column;
            }

            .ex-actions {
                width: 100%;
            }

            .back-btn,
            .ex-actions .btn-gold {
                flex: 1;
            }
        }

        @media (max-width: 700px) {

            .ex-container {
                padding: 15px;
            }

            .plan-summary {
                grid-template-columns: 1fr;
            }

            .ex-grid {
                grid-template-columns: 1fr;
            }

            .ex-title {
                font-size: 19px;
            }

            .ex-subtitle {
                padding-right: 0;
            }

            .form-row {
                grid-template-columns: 1fr;

                gap: 0;
            }
        }

        @media (max-width: 480px) {

            .ex-title-row {
                align-items: flex-start;
            }

            .ex-title-icon {
                width: 40px;
                height: 40px;
            }

            .ex-actions {
                flex-direction: column;
            }

            .back-btn,
            .ex-actions .btn-gold {
                width: 100%;

                flex: none;
            }

            .exercise-stats {
                grid-template-columns: 1fr 1fr;
            }

            .exercise-stats .badge-info:last-child {
                grid-column: 1 / -1;
            }

            .modal {
                padding: 10px;
            }

            .modal-content {
                max-height: calc(100vh - 20px);

                border-radius: 14px;
            }

            .modal-body {
                padding: 16px;
            }
        }
    </style>
@endsection

@section('content')

    @if ($errors->any())
        <div class="ex-container">
            <div class="ex-alert ex-alert-danger">
                <div class="ex-alert-icon">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>

                <div>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    @if (session('success'))
        <div class="ex-container">
            <div class="ex-alert ex-alert-success">
                <div class="ex-alert-icon">
                    <i class="fas fa-check"></i>
                </div>

                <div>
                    {{ session('success') }}
                </div>
            </div>
        </div>
    @endif

    <div class="dashboard-wrapper ex-container">

        <!-- =========================
             PAGE HEADER
        ========================== -->

        <div class="ex-page-top">

            <div class="ex-title-area">

                <div class="ex-title-row">
                    <div class="ex-title-icon">
                        <i class="fas fa-dumbbell"></i>
                    </div>

                    <h2 class="ex-title">
                        تمارين خطة:
                        <span>{{ $trainingPlan->title ?? 'خطة تدريبية' }}</span>
                    </h2>
                </div>

                <p class="ex-subtitle">
                    إدارة وتنظيم تمارين الخطة التدريبية
                    <span class="ex-level">
                        <i class="fas fa-layer-group"></i>
                        المستوى المستهدف:
                        {{ $trainingPlan->level ?? 'عام' }}
                    </span>
                </p>

            </div>

            <div class="ex-actions">

                <a href="{{ route('employee.training.bank') }}" class="back-btn">
                    <i class="fas fa-arrow-right"></i>
                    العودة لبنك الخطط
                </a>

                <button class="btn-gold" onclick="openAddModal()">
                    <i class="fas fa-plus"></i>
                    إضافة تمرين جديد
                </button>

            </div>

        </div>


        <!-- =========================
             PLAN SUMMARY
        ========================= -->

        <div class="plan-summary">

            <div class="summary-box">
                <div class="summary-icon">
                    <i class="fas fa-dumbbell"></i>
                </div>

                <div class="summary-info">
                    <span class="summary-label">الخطة التدريبية</span>

                    <span class="summary-value">
                        {{ $trainingPlan->title ?? 'خطة تدريبية' }}
                    </span>
                </div>
            </div>

            <div class="summary-box">
                <div class="summary-icon">
                    <i class="fas fa-layer-group"></i>
                </div>

                <div class="summary-info">
                    <span class="summary-label">المستوى المستهدف</span>

                    <span class="summary-value">
                        {{ $trainingPlan->level ?? 'عام' }}
                    </span>
                </div>
            </div>

            <div class="summary-box">
                <div class="summary-icon">
                    <i class="fas fa-list-ol"></i>
                </div>

                <div class="summary-info">
                    <span class="summary-label">عدد التمارين</span>

                    <span class="summary-value">
                        {{ $exercises->count() }} تمرين
                    </span>
                </div>
            </div>

        </div>


        <!-- =========================
             EXERCISES GRID
        ========================== -->

        <div class="ex-grid">

            @forelse($exercises as $ex)

                <div class="ex-card">

                    <!-- Exercise Image -->

                    <div class="ex-media">

                        @if ($ex->image_path)

                            <img src="{{ asset('storage/' . $ex->image_path) }}"
                                alt="{{ $ex->name }}"
                                class="ex-img">

                            <span class="ex-image-label">
                                <i class="fas fa-image"></i>
                                صورة التمرين
                            </span>

                        @else

                            <div class="ex-placeholder">
                                <i class="fas fa-running"></i>
                            </div>

                        @endif

                    </div>


                    <!-- Exercise Body -->

                    <div class="ex-body">

                        <div class="ex-head">

                            <div style="min-width: 0;">

                                <span class="ex-number">
                                    تمرين رقم {{ $loop->iteration }}
                                </span>

                                <h3 class="ex-name">
                                    {{ $ex->name }}
                                </h3>

                            </div>

                            <span class="day-chip {{ $ex->day_of_week ? '' : 'day-chip-empty' }}">

                                <i class="fas fa-calendar-day"></i>

                                {{ $ex->day_name }}

                            </span>

                        </div>


                        <!-- Exercise Stats -->

                        <div class="exercise-stats">

                            <span class="badge-info">
                                <i class="fas fa-redo"></i>
                                {{ $ex->sets }} جولات
                            </span>

                            <span class="badge-info">
                                <i class="fas fa-sync-alt"></i>
                                {{ $ex->reps }} تكرارات
                            </span>

                            @if ($ex->rest_time)

                                <span class="badge-info">
                                    <i class="fas fa-hourglass-half"></i>
                                    {{ $ex->rest_time }}
                                </span>

                            @endif

                        </div>


                        <!-- Instructions -->

                        @if ($ex->instructions)

                            <div class="instructions-box">

                                <div class="instructions-title">
                                    <i class="fas fa-info-circle"></i>
                                    تعليمات وملاحظات
                                </div>

                                <p class="instructions-text">
                                    {{ $ex->instructions }}
                                </p>

                            </div>

                        @endif


                        <!-- Video -->

                        @if ($ex->video_url)

                            <a href="{{ $ex->video_url }}"
                                target="_blank"
                                class="video-link">

                                <i class="fas fa-video"></i>

                                مشاهدة فيديو الشرح

                            </a>

                        @endif

                    </div>


                    <!-- Card Footer -->

                    <div class="ex-footer">

                        <form action="{{ route('employee.training.exercises.destroy', $ex->id) }}"
                            method="POST"
                            onsubmit="return confirm('هل أنت متأكد من حذف هذا التمرين؟')">

                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn-delete">

                                <i class="fas fa-trash-alt"></i>

                                حذف التمرين

                            </button>

                        </form>

                    </div>

                </div>

            @empty

                <div class="empty-state">

                    <div class="empty-icon">
                        <i class="fas fa-dumbbell"></i>
                    </div>

                    <h3>
                        لا توجد تمارين مضافة لهذه الخطة
                    </h3>

                    <p>
                        ابدأ بإضافة أول تمرين للخطة من خلال زر
                        "إضافة تمرين جديد".
                    </p>

                </div>

            @endforelse

        </div>


        <!-- =========================
             ADD EXERCISE MODAL
        ========================== -->

        <div id="addExModal" class="modal">

            <div class="modal-content">

                <div class="modal-header">

                    <h4 class="modal-title">
                        <i class="fas fa-plus-circle"></i>
                        إضافة تمرين جديد للخطة
                    </h4>

                    <span class="close-modal"
                        onclick="closeAddModal()">

                        &times;

                    </span>

                </div>


                <form action="{{ route('employee.training.exercises.store', $trainingPlan->id) }}"
                    method="POST"
                    enctype="multipart/form-data">

                    @csrf

                    <div class="modal-body">

                        <!-- Exercise Name -->

                        <div class="field-group">

                            <label class="field-label">
                                <i class="fas fa-dumbbell"></i>
                                اسم التمرين
                            </label>

                            <input type="text"
                                name="name"
                                class="field-input"
                                placeholder="مثال: بنش برس مستوي بالبار">

                        </div>


                        <!-- Sets / Reps -->

                        <div class="form-row">

                            <div class="field-group">

                                <label class="field-label">
                                    <i class="fas fa-redo"></i>
                                    عدد الجولات (Sets)
                                </label>

                                <input type="number"
                                    name="sets"
                                    value="4"
                                    min="1"
                                    class="field-input">

                            </div>

                            <div class="field-group">

                                <label class="field-label">
                                    <i class="fas fa-sync-alt"></i>
                                    عدد التكرارات (Reps)
                                </label>

                                <input type="number"
                                    name="reps"
                                    value="12"
                                    min="1"
                                    class="field-input">

                            </div>

                        </div>


                        <!-- Rest / Order -->

                        <div class="form-row">

                            <div class="field-group">

                                <label class="field-label">
                                    <i class="fas fa-hourglass-half"></i>
                                    مدة الراحة بين الجولات
                                </label>

                                <input type="text"
                                    name="rest_time"
                                    class="field-input"
                                    placeholder="مثال: 90 ثانية">

                            </div>

                            <div class="field-group">

                                <label class="field-label">
                                    <i class="fas fa-sort-numeric-down"></i>
                                    ترتيب التمرين داخل اليوم
                                </label>

                                <input type="number"
                                    name="order"
                                    value="0"
                                    min="0"
                                    class="field-input">

                            </div>

                        </div>


                        <!-- Day -->

                        <div class="field-group">

                            <label class="field-label">
                                <i class="fas fa-calendar-day"></i>
                                يوم التمرين في الأسبوع
                            </label>

                            <select name="day_of_week"
                                class="field-input">

                                <option value="">
                                    -- غير محدد (تمرين حر) --
                                </option>

                                @foreach (\App\Models\Plan::DAYS as $num => $dayName)

                                    <option value="{{ $num }}">
                                        {{ $dayName }}
                                    </option>

                                @endforeach

                            </select>

                        </div>


                        <!-- Instructions -->

                        <div class="field-group">

                            <label class="field-label">
                                <i class="fas fa-align-right"></i>
                                شرح طريقة أداء التمرين والملاحظات
                            </label>

                            <textarea name="instructions"
                                class="field-input"
                                rows="4"
                                placeholder="اكتب تعليمات التمرين والتركيز العضلي..."></textarea>

                        </div>


                        <!-- Image -->

                        <div class="field-group">

                            <label class="field-label">
                                <i class="fas fa-image"></i>
                                صورة توضيحية للتمرين

                                <span style="color: var(--muted); font-size: 10px;">
                                    (اختياري)
                                </span>
                            </label>

                            <input type="file"
                                name="image"
                                class="field-input"
                                accept="image/*">

                        </div>


                        <!-- Video -->

                        <div class="field-group">

                            <label class="field-label">
                                <i class="fas fa-video"></i>
                                رابط فيديو التمرين

                                <span style="color: var(--muted); font-size: 10px;">
                                    (اختياري)
                                </span>
                            </label>

                            <input type="url"
                                name="video_url"
                                class="field-input"
                                placeholder="https://youtube.com/...">

                        </div>


                        <!-- Submit -->

                        <button type="submit"
                            class="btn-gold modal-submit">

                            <i class="fas fa-check"></i>

                            حفظ إضافة التمرين

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>
@endsection

@section('scripts')

    <script>

        function openAddModal() {
            document.getElementById('addExModal').classList.add('open');
            document.body.style.overflow = 'hidden';
        }

        function closeAddModal() {
            document.getElementById('addExModal').classList.remove('open');
            document.body.style.overflow = '';
        }

        window.onclick = function(event) {

            if (event.target == document.getElementById('addExModal')) {
                closeAddModal();
            }

        };

        document.addEventListener('keydown', function(event) {

            if (event.key === 'Escape') {
                closeAddModal();
            }

        });

    </script>

@endsection
