@extends('Employee.layouts.app')

@section('title', 'بنك الخطط التدريبية | Elite Club')

@section('styles')

    <style>
        /* =========================================================
       ELITE CLUB — TRAINING PLAN BANK
       PREMIUM + RESPONSIVE + READABLE
       ========================================================= */

        .training-bank-page {
            width: 100%;
            max-width: 100%;
        }

        /* =========================================================
       PAGE HEADER
       ========================================================= */

        .training-bank-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 22px;
            margin-bottom: 24px;
            padding: 5px 2px;
        }

        .training-bank-header-info {
            min-width: 0;
        }

        .training-bank-title {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 0;
            color: var(--text);
            font-size: 27px;
            font-weight: 900;
            line-height: 1.5;
            letter-spacing: -.5px;
        }

        .training-bank-title i {
            color: var(--gold);
            font-size: 24px;
        }

        .training-bank-subtitle {
            display: block;
            margin-top: 7px;
            color: var(--muted);
            font-size: 13px;
            font-weight: 600;
            line-height: 1.8;
        }

        /* =========================================================
       HEADER ACTION
       ========================================================= */

        .training-bank-header-action {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-shrink: 0;
        }

        /* =========================================================
       GREEN BUTTON
       ========================================================= */

        .btn-green {
            min-height: 44px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 10px 17px;

            color: var(--success);
            background: color-mix(in srgb,
                    var(--success) 8%,
                    var(--surface));

            border: 1px solid color-mix(in srgb,
                    var(--success) 25%,
                    var(--border));

            border-radius: 11px;
            text-decoration: none;

            font-family: inherit;
            font-size: 12px;
            font-weight: 800;

            cursor: pointer;

            transition:
                background .2s ease,
                border-color .2s ease,
                color .2s ease,
                transform .2s ease,
                box-shadow .2s ease;
        }

        .btn-green:hover {
            color: #fff;
            background: var(--success);
            border-color: var(--success);
            transform: translateY(-2px);

            box-shadow:
                0 9px 22px color-mix(in srgb,
                    var(--success) 20%,
                    transparent);
        }

        .btn-green:disabled {
            cursor: not-allowed;
            opacity: .45;
            transform: none;
            box-shadow: none;
        }

        /* =========================================================
       GOLD ACTION
       ========================================================= */

        .btn-gold-action {
            min-height: 38px;

            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;

            padding: 8px 13px;

            color: var(--gold);

            background: color-mix(in srgb,
                    var(--gold) 7%,
                    var(--surface));

            border: 1px solid color-mix(in srgb,
                    var(--gold) 25%,
                    var(--border));

            border-radius: 9px;

            text-decoration: none;

            font-family: inherit;
            font-size: 11px;
            font-weight: 800;

            cursor: pointer;
            white-space: nowrap;

            transition:
                background .2s ease,
                border-color .2s ease,
                color .2s ease,
                transform .2s ease,
                box-shadow .2s ease;
        }

        .btn-gold-action:hover {
            color: #171717;

            background:
                linear-gradient(135deg,
                    var(--gold-light),
                    var(--gold-dark));

            border-color: var(--gold);

            transform: translateY(-1px);

            box-shadow:
                0 7px 17px rgba(184, 146, 62, .18);
        }

        /* =========================================================
       DELETE BUTTON
       ========================================================= */

        .btn-delete {
            min-height: 38px;

            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;

            padding: 8px 13px;

            color: var(--danger);

            background: color-mix(in srgb,
                    var(--danger) 6%,
                    var(--surface));

            border: 1px solid color-mix(in srgb,
                    var(--danger) 23%,
                    var(--border));

            border-radius: 9px;

            cursor: pointer;

            font-family: inherit;
            font-size: 11px;
            font-weight: 800;

            white-space: nowrap;

            transition:
                background .2s ease,
                border-color .2s ease,
                color .2s ease,
                transform .2s ease;
        }

        .btn-delete:hover {
            color: #fff;
            background: var(--danger);
            border-color: var(--danger);
            transform: translateY(-1px);
        }

        /* =========================================================
       MAIN PANEL
       ========================================================= */

        .training-bank-panel {
            width: 100%;

            background: var(--surface);

            border: 1px solid var(--border);
            border-radius: 18px;

            box-shadow: var(--shadow-sm);

            overflow: hidden;

            animation:
                trainingPanelIn .5s cubic-bezier(.2, .7, .2, 1) both;
        }

        @keyframes trainingPanelIn {
            from {
                opacity: 0;
                transform: translateY(12px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* =========================================================
       TABLE WRAPPER
       ========================================================= */

        .training-table-wrapper {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        /* =========================================================
       TABLE
       ========================================================= */

        .members-table {
            width: 100%;
            min-width: 850px;
            border-collapse: collapse;
        }

        .members-table th {
            padding: 16px 18px;

            color: var(--muted);
            background: var(--surface-2);

            border-bottom: 1px solid var(--border);

            font-family: inherit;
            font-size: 12px;
            font-weight: 850;

            text-align: right;

            white-space: nowrap;
        }

        .members-table td {
            padding: 17px 18px;

            color: var(--text-soft);
            background: var(--surface);

            border-bottom: 1px solid var(--border);

            vertical-align: middle;

            font-family: inherit;
            font-size: 12px;
            font-weight: 600;

            line-height: 1.7;

            transition: background .15s ease;
        }

        .members-table tbody tr {
            transition: background .15s ease;
        }

        .members-table tbody tr:hover td {
            background:
                color-mix(in srgb,
                    var(--gold) 4%,
                    var(--surface));
        }

        .members-table tbody tr:last-child td {
            border-bottom: 0;
        }

        /* =========================================================
       PLAN TITLE
       ========================================================= */

        .plan-title-cell {
            color: var(--gold) !important;

            font-size: 14px !important;
            font-weight: 900 !important;

            line-height: 1.6 !important;
        }

        .plan-exercises-info {
            display: block;

            margin-top: 7px;

            color: var(--muted);

            font-size: 11px;
            font-weight: 650;

            line-height: 1.6;
        }

        .plan-exercises-info.empty {
            color: var(--danger);
        }

        .plan-exercises-info i {
            margin-left: 4px;
        }

        /* =========================================================
       LEVEL CHIP
       ========================================================= */

        .level-chip {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;

            min-height: 31px;

            padding: 6px 12px;

            color: var(--gold-dark);

            background:
                color-mix(in srgb,
                    var(--gold) 10%,
                    var(--surface));

            border: 1px solid color-mix(in srgb,
                    var(--gold) 25%,
                    var(--border));

            border-radius: 999px;

            font-size: 11px;
            font-weight: 800;

            white-space: nowrap;
        }

        .level-chip i {
            color: var(--gold);
            font-size: 10px;
        }

        /* =========================================================
       DATE
       ========================================================= */

        .plan-created-date {
            color: var(--muted);

            font-size: 11px;
            font-weight: 650;

            white-space: nowrap;
        }

        /* =========================================================
       ACTIONS
       ========================================================= */

        .plan-actions {
            display: flex;

            align-items: center;
            justify-content: center;

            gap: 8px;

            flex-wrap: nowrap;
        }

        .plan-actions form {
            margin: 0;
            display: inline-block;
        }

        /* =========================================================
       EMPTY STATE
       ========================================================= */

        .training-bank-empty {
            min-height: 260px;

            display: flex;
            flex-direction: column;

            align-items: center;
            justify-content: center;

            gap: 10px;

            padding: 40px 20px;

            color: var(--muted);

            text-align: center;
        }

        .training-bank-empty i {
            margin-bottom: 5px;

            color: var(--gold);

            font-size: 38px;

            opacity: .72;

            animation:
                trainingEmptyBreathe 2.4s ease-in-out infinite;
        }

        @keyframes trainingEmptyBreathe {

            0%,
            100% {
                transform: scale(1);
                opacity: .68;
            }

            50% {
                transform: scale(1.07);
                opacity: .92;
            }
        }

        .training-bank-empty strong {
            color: var(--text-soft);

            font-size: 15px;
            font-weight: 850;
        }

        .training-bank-empty span {
            max-width: 500px;

            font-size: 11px;
            font-weight: 550;

            line-height: 1.9;
        }

        /* =========================================================
       MODAL
       ========================================================= */

        .modal {
            display: none;

            position: fixed;

            z-index: 9999;

            inset: 0;

            align-items: center;
            justify-content: center;

            padding: 20px;

            background: rgba(8, 10, 13, .68);

            backdrop-filter: blur(8px);
        }

        .modal.open {
            display: flex;
        }

        .modal-content {
            width: 100%;
            max-width: 540px;

            max-height:
                calc(100vh - 40px);

            overflow: hidden;

            background: var(--surface);

            border: 1px solid var(--border);

            border-radius: 18px;

            box-shadow: var(--shadow);

            animation:
                modalFade .25s cubic-bezier(.2, .7, .2, 1);
        }

        @keyframes modalFade {

            from {
                opacity: 0;
                transform:
                    translateY(-14px) scale(.985);
            }

            to {
                opacity: 1;
                transform:
                    translateY(0) scale(1);
            }
        }

        /* =========================================================
       MODAL HEADER
       ========================================================= */

        .modal-header {
            min-height: 70px;

            display: flex;

            align-items: center;
            justify-content: space-between;

            gap: 15px;

            padding: 15px 20px;

            background: var(--surface);

            border-bottom: 1px solid var(--border);
        }

        .modal-header h4 {
            display: flex;

            align-items: center;

            gap: 9px;

            margin: 0;

            color: var(--text);

            font-size: 16px;
            font-weight: 850;

            line-height: 1.5;
        }

        .modal-header h4 i {
            color: var(--gold);
            font-size: 16px;
        }

        .close-modal {
            width: 36px;
            height: 36px;

            display: flex;

            align-items: center;
            justify-content: center;

            flex: 0 0 36px;

            color: var(--muted);

            background: var(--surface-2);

            border: 1px solid var(--border);

            border-radius: 9px;

            cursor: pointer;

            font-size: 22px;
            font-weight: 500;

            line-height: 1;

            transition:
                background .18s ease,
                border-color .18s ease,
                color .18s ease,
                transform .18s ease;
        }

        .close-modal:hover {
            color: var(--danger);

            background:
                color-mix(in srgb,
                    var(--danger) 7%,
                    var(--surface-2));

            border-color:
                color-mix(in srgb,
                    var(--danger) 25%,
                    var(--border));

            transform: rotate(3deg);
        }

        /* =========================================================
       MODAL BODY
       ========================================================= */

        .modal-body {
            padding: 24px;

            overflow-y: auto;

            max-height:
                calc(100vh - 130px);
        }

        .field-group {
            margin-bottom: 19px;
        }

        .field-label {
            display: block;

            margin-bottom: 8px;

            color: var(--text-soft);

            font-size: 12px;
            font-weight: 800;
        }

        .field-input {
            width: 100%;

            min-height: 48px;

            padding: 11px 14px;

            color: var(--text);

            background: var(--surface-2);

            border: 1px solid var(--border);

            border-radius: 10px;

            outline: none;

            font-family: inherit;

            font-size: 12px;
            font-weight: 600;

            line-height: 1.6;

            transition:
                border-color .2s ease,
                background .2s ease,
                box-shadow .2s ease;
        }

        .field-input:focus {
            background: var(--surface);

            border-color:
                color-mix(in srgb,
                    var(--gold) 55%,
                    var(--border));

            box-shadow:
                0 0 0 3px color-mix(in srgb,
                    var(--gold) 8%,
                    transparent);
        }

        .field-input::placeholder {
            color: var(--muted);
            font-weight: 500;
        }

        .field-input option {
            background: var(--surface);
            color: var(--text);
        }

        /* =========================================================
       SUBMIT
       ========================================================= */

        .btn-submit {
            width: 100%;

            min-height: 50px;

            display: flex;

            align-items: center;
            justify-content: center;

            padding: 12px 16px;

            margin-top: 7px;

            color: #171717;

            background:
                linear-gradient(135deg,
                    var(--gold-light),
                    var(--gold-dark));

            border: 0;

            border-radius: 11px;

            box-shadow:
                0 8px 20px rgba(184, 146, 62, .17);

            cursor: pointer;

            font-family: inherit;

            font-size: 12px;
            font-weight: 900;

            transition:
                transform .2s ease,
                box-shadow .2s ease;
        }

        .btn-submit:hover {
            transform: translateY(-2px);

            box-shadow:
                0 12px 27px rgba(184, 146, 62, .24);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        /* =========================================================
       DARK MODE
       ========================================================= */

        html[data-theme="dark"] .training-bank-panel,
        body.dark .training-bank-panel,
        body[data-theme="dark"] .training-bank-panel {
            background: var(--surface);
            border-color: var(--border);
        }

        html[data-theme="dark"] .members-table td,
        body.dark .members-table td,
        body[data-theme="dark"] .members-table td {
            background: var(--surface);
        }

        html[data-theme="dark"] .members-table tbody tr:hover td,
        body.dark .members-table tbody tr:hover td,
        body[data-theme="dark"] .members-table tbody tr:hover td {
            background:
                color-mix(in srgb,
                    var(--gold) 5%,
                    var(--surface));
        }

        /* =========================================================
       RESPONSIVE — TABLET
       ========================================================= */

        @media (max-width: 1000px) {

            .training-bank-title {
                font-size: 24px;
            }

            .training-bank-subtitle {
                font-size: 12px;
            }

            .members-table {
                min-width: 800px;
            }

            .members-table th {
                font-size: 11px;
            }

            .members-table td {
                font-size: 11px;
            }

            .plan-title-cell {
                font-size: 13px !important;
            }

            .plan-actions {
                gap: 6px;
            }

            .btn-gold-action,
            .btn-delete,
            .plan-actions .btn-green {
                font-size: 10px !important;
                padding: 7px 10px !important;
            }
        }

        /* =========================================================
       RESPONSIVE — MOBILE
       ========================================================= */

        @media (max-width: 760px) {

            .training-bank-header {
                align-items: stretch;

                flex-direction: column;

                gap: 15px;

                margin-bottom: 18px;
            }

            .training-bank-title {
                font-size: 22px;

                gap: 10px;
            }

            .training-bank-title i {
                font-size: 20px;
            }

            .training-bank-subtitle {
                margin-top: 5px;

                font-size: 11px;

                line-height: 1.8;
            }

            .training-bank-header-action,
            .training-bank-header-action .btn-green {
                width: 100%;
            }

            .training-bank-header-action .btn-green {
                min-height: 46px;

                font-size: 12px !important;
            }

            .training-bank-panel {
                border-radius: 14px;
            }

            /*
           لا نخلي الجدول يضيق ويخرب.
           يبقى قابل للسحب أفقياً على الموبايل.
        */

            .training-table-wrapper {
                overflow-x: auto;
            }

            .members-table {
                min-width: 760px;
            }

            .members-table th,
            .members-table td {
                padding: 14px 13px;
            }

            .members-table th {
                font-size: 10px;
            }

            .members-table td {
                font-size: 11px;
            }

            .plan-title-cell {
                font-size: 13px !important;
            }

            .plan-exercises-info {
                font-size: 10px;
            }

            .level-chip {
                min-height: 29px;
                padding: 5px 10px;

                font-size: 10px;
            }

            .plan-created-date {
                font-size: 10px;
            }

            .btn-gold-action,
            .btn-delete,
            .plan-actions .btn-green {
                min-height: 36px;

                padding: 7px 10px !important;

                font-size: 10px !important;
            }

            .modal {
                padding: 12px;
            }

            .modal-content {
                max-height:
                    calc(100vh - 24px);

                border-radius: 15px;
            }

            .modal-header {
                min-height: 64px;
                padding: 13px 15px;
            }

            .modal-header h4 {
                font-size: 13px;
            }

            .modal-body {
                padding: 18px;
            }

            .field-label {
                font-size: 11px;
            }

            .field-input {
                min-height: 46px;
                font-size: 11px;
            }

            .btn-submit {
                min-height: 48px;
                font-size: 11px;
            }
        }

        /* =========================================================
       RESPONSIVE — SMALL MOBILE
       ========================================================= */

        @media (max-width: 480px) {

            .training-bank-title {
                font-size: 19px;
                line-height: 1.5;
            }

            .training-bank-title i {
                font-size: 18px;
            }

            .training-bank-subtitle {
                font-size: 10px;
            }

            .training-bank-header-action .btn-green {
                font-size: 11px !important;
            }

            .training-bank-empty {
                min-height: 230px;
                padding: 30px 16px;
            }

            .training-bank-empty i {
                font-size: 33px;
            }

            .training-bank-empty strong {
                font-size: 13px;
            }

            .training-bank-empty span {
                font-size: 10px;
            }

            .modal-header h4 {
                font-size: 12px;
            }

            .close-modal {
                width: 33px;
                height: 33px;
                flex-basis: 33px;
            }

            .modal-body {
                padding: 15px;
            }
        }

        /* =========================================================
       VERY SMALL SCREENS
       ========================================================= */

        @media (max-width: 360px) {

            .training-bank-title {
                font-size: 18px;
            }

            .training-bank-subtitle {
                font-size: 9.5px;
            }

            .modal {
                padding: 8px;
            }

            .modal-content {
                border-radius: 13px;
            }

            .modal-header {
                padding: 12px;
            }

            .modal-body {
                padding: 13px;
            }
        }

        /* =========================================================
       TOUCH DEVICES
       ========================================================= */

        @media (hover: none) {

            .btn-green:hover,
            .btn-gold-action:hover,
            .btn-delete:hover,
            .btn-submit:hover {
                transform: none;
            }

            .members-table tbody tr:hover td {
                background: var(--surface);
            }
        }

        /* =========================================================
       ACCESSIBILITY
       ========================================================= */

        button,
        a,
        input,
        select {
            -webkit-tap-highlight-color: transparent;
        }

        button:focus-visible,
        a:focus-visible,
        input:focus-visible,
        select:focus-visible {
            outline: 2px solid var(--gold);
            outline-offset: 2px;
        }

        /* =========================================================
       REDUCED MOTION
       ========================================================= */

        @media (prefers-reduced-motion: reduce) {

            *,
            *::before,
            *::after {
                animation-duration: .01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: .01ms !important;
            }
        }
    </style>

@endsection


@section('content')

    <div class="training-bank-page">

        {{-- =====================================================
         HEADER
    ====================================================== --}}

        <div class="training-bank-header">

            <div class="training-bank-header-info">

                <h2 class="training-bank-title">

                    <i class="fas fa-dumbbell"></i>

                    بنك الخطط التدريبية العامة

                </h2>

                <span class="training-bank-subtitle">
                    إدارة الخطط التدريبية العامة وتخصيص التمارين وتوزيعها على اللاعبين
                </span>

            </div>

            <div class="training-bank-header-action">
                @can('training_plan.create')
                <button type="button" class="btn-green" onclick="openAddModal()">

                    <i class="fas fa-plus"></i>

                    إضافة خطة جديدة للبنك

                </button>
                @endcan
            </div>

        </div>


        {{-- =====================================================
         TRAINING PLANS TABLE
    ====================================================== --}}

        <div class="training-bank-panel">

            <div class="training-table-wrapper">

                <table class="members-table">

                    <thead>

                        <tr>

                            <th style="width: 30%;">
                                اسم الخطة التدريبية
                            </th>

                            <th
                                style="
                                width: 17%;
                                text-align: center;
                            ">

                                المستوى المستهدف

                            </th>

                            <th
                                style="
                                width: 15%;
                                text-align: center;
                            ">

                                تاريخ الإنشاء

                            </th>

                            <th
                                style="
                                width: 38%;
                                text-align: center;
                            ">

                                إجراءات الخطة والتمارين

                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($plans as $plan)
                            <tr>

                                {{-- PLAN TITLE --}}

                                <td class="plan-title-cell">

                                    {{ $plan->title ?? 'خطة تدريبية عامة' }}

                                    <span
                                        class="
                                        plan-exercises-info
                                        {{ $plan->exercises_count ? '' : 'empty' }}
                                    ">

                                        <i class="fas fa-list-ol"></i>

                                        {{ $plan->exercises_count }}

                                        تمرين

                                        {{ $plan->exercises_count ? '' : ' — الخطة فارغة' }}

                                    </span>

                                </td>


                                {{-- LEVEL --}}

                                <td style="text-align: center;">

                                    <span class="level-chip">

                                        <i class="fas fa-layer-group"></i>

                                        {{ $plan->level ?? 'عام' }}

                                    </span>

                                </td>


                                {{-- DATE --}}

                                <td style="text-align: center;">

                                    <span class="plan-created-date">

                                        {{ $plan->created_at->format('Y-m-d') }}

                                    </span>

                                </td>


                                {{-- ACTIONS --}}

                                <td style="text-align: center;">

                                    <div class="plan-actions">

                                        {{-- EXERCISES --}}
                                        @can('plan_type.view')
                                        <a href="{{ route('employee.training.exercises.index', $plan->id) }}"
                                            class="btn-gold-action">

                                            <i class="fas fa-list-ol"></i>

                                            تمارين الخطة

                                        </a>
                                        <form
                                            action="{{ route('employee.training.bank.distribute', $plan->id) }}"
                                            method="POST"
                                            onsubmit="
                                            return confirm(
                                                'سيتم توزيع الخطة وتمارينها على جميع لاعبي هذا المستوى، واستبدال أي نسخة قديمة لديهم. متابعة؟'
                                            )
                                        ">
                                            @csrf
                                            <button type="submit" class="btn-green" @disabled(!$plan->exercises_count)>
                                                <i class="fas fa-share-nodes"></i>
                                                توزيع
                                            </button>
                                        </form>
                                        @endcan
                                        @can('training_plan.delete')
                                        {{-- DELETE --}}
                                    <form
                                            action="{{ route('employee.training.bank.destroy', $plan->id) }}"
                                            method="POST"
                                            onsubmit="
                                            return confirm(
                                                'هل أنت متأكد من حذف هذه الخطة بالكامل من البنك？'
                                            )
                                        ">

                                            @csrf

                                            @method('DELETE')

                                            <button type="submit" class="btn-delete">

                                                <i class="fas fa-trash"></i>

                                                حذف

                                            </button>

                                        </form>
                                        @endcan

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="4">

                                    <div class="training-bank-empty">

                                        <i class="fas fa-dumbbell"></i>

                                        <strong>
                                            البنك فارغ حالياً
                                        </strong>

                                        <span>
                                            ابدأ بإضافة خطتك التدريبية الأولى
                                            وتخصيص اسمها ومستواها.
                                        </span>

                                    </div>

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        {{-- =====================================================
         MODAL — ADD TRAINING PLAN
    ====================================================== --}}

        <div id="addPlanModal" class="modal" role="dialog" aria-modal="true" aria-labelledby="addPlanModalTitle">

            <div class="modal-content">

                <div class="modal-header">

                    <h4 id="addPlanModalTitle">

                        <i class="fas fa-dumbbell"></i>

                        إضافة خطة تمارين عامة للبنك

                    </h4>

                    <button type="button" class="close-modal" onclick="closeAddModal()" aria-label="إغلاق">

                        &times;

                    </button>

                </div>


                <form action="{{ route('employee.training.bank.store') }}" method="POST">

                    @csrf

                    <div class="modal-body">

                        {{-- TITLE --}}

                        <div class="field-group">

                            <label class="field-label" for="training-plan-title">

                                اسم الخطة التدريبية

                            </label>

                            <input id="training-plan-title" type="text" name="title" class="field-input"
                                placeholder="مثال: خطة تضخيم العضلات - شهر أول" >

                        </div>


                        {{-- LEVEL --}}

                        <div class="field-group">

                            <label class="field-label" for="training-plan-level">

                                المستوى المستهدف (الصنف)

                            </label>

                            <select id="training-plan-level" name="level" class="field-input" >

                                <option value="">
                                    -- اختر المستوى لتخصيص الخطة له تلقائياً --
                                </option>

                                <option value="beginner">
                                    Beginner (مبتدئ)
                                </option>

                                <option value="intermediate">
                                    Intermediate (متوسط)
                                </option>

                                <option value="advanced">
                                    Advanced (متقدم)
                                </option>

                            </select>

                        </div>


                        {{-- SUBMIT --}}

                        <button type="submit" class="btn-submit">

                            حفظ وتعميم الخطة بالبنك

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

            const modal =
                document.getElementById('addPlanModal');

            if (!modal) return;

            modal.classList.add('open');

            document.body.style.overflow = 'hidden';

            setTimeout(function() {

                const input =
                    document.getElementById(
                        'training-plan-title'
                    );

                if (input) {
                    input.focus();
                }

            }, 100);

        }


        function closeAddModal() {

            const modal =
                document.getElementById('addPlanModal');

            if (!modal) return;

            modal.classList.remove('open');

            document.body.style.overflow = '';

        }


        /* =========================================================
           CLOSE WHEN CLICKING OUTSIDE
           ========================================================= */

        window.addEventListener('click', function(event) {

            const modal =
                document.getElementById('addPlanModal');

            if (
                modal &&
                event.target === modal
            ) {
                closeAddModal();
            }

        });


        /* =========================================================
           ESC TO CLOSE
           ========================================================= */

        window.addEventListener('keydown', function(event) {

            if (event.key === 'Escape') {

                const modal =
                    document.getElementById('addPlanModal');

                if (
                    modal &&
                    modal.classList.contains('open')
                ) {
                    closeAddModal();
                }

            }

        });
    </script>

@endsection
