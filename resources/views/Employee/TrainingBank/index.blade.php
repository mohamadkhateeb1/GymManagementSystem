@extends('Employee.layouts.app')

@section('title', 'بنك الخطط التدريبية | Elite Club')

@section('styles')

    <style>
        /* =========================================================
               ELITE CLUB — TRAINING PLAN BANK
               DESIGN ONLY
               ========================================================= */

        .training-bank-page {
            width: 100%;
        }

        /* =========================================================
               PAGE HEADER
               ========================================================= */

        .training-bank-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            margin-bottom: 20px;
            padding: 4px 2px;
        }

        .training-bank-header-info {
            min-width: 0;
        }

        .training-bank-title {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 0;
            color: var(--text);
            font-size: 24px;
            font-weight: 850;
            line-height: 1.4;
            letter-spacing: -.4px;
        }

        .training-bank-title i {
            color: var(--gold);
            font-size: 21px;
        }

        .training-bank-subtitle {
            display: block;
            margin-top: 5px;
            color: var(--muted);
            font-size: 10px;
            font-weight: 500;
        }

        /* =========================================================
               HEADER ACTION
               ========================================================= */

        .training-bank-header-action {
            display: flex;
            align-items: center;
            gap: 9px;
            flex-shrink: 0;
        }

        .btn-green {
            min-height: 42px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 9px 14px;
            color: var(--success);
            background: color-mix(in srgb, var(--success) 7%, var(--surface));
            border: 1px solid color-mix(in srgb, var(--success) 20%, var(--border));
            border-radius: 11px;
            text-decoration: none;
            font-size: 10px;
            font-weight: 750;
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
            box-shadow: 0 8px 20px color-mix(in srgb, var(--success) 18%, transparent);
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
            min-height: 34px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            padding: 7px 11px;
            color: var(--gold);
            background: color-mix(in srgb, var(--gold) 7%, var(--surface));
            border: 1px solid color-mix(in srgb, var(--gold) 22%, var(--border));
            border-radius: 9px;
            text-decoration: none;
            font-size: 9px;
            font-weight: 750;
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
            background: linear-gradient(135deg, var(--gold-light), var(--gold-dark));
            border-color: var(--gold);
            transform: translateY(-1px);
            box-shadow: 0 7px 16px rgba(184, 146, 62, .16);
        }

        /* =========================================================
               DELETE
               ========================================================= */

        .btn-delete {
            min-height: 34px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            padding: 7px 11px;
            color: var(--danger);
            background: color-mix(in srgb, var(--danger) 5%, var(--surface));
            border: 1px solid color-mix(in srgb, var(--danger) 20%, var(--border));
            border-radius: 9px;
            cursor: pointer;
            font-size: 9px;
            font-weight: 750;
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
               PANEL
               ========================================================= */

        .training-bank-panel {
            width: 100%;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 18px;
            box-shadow: var(--shadow-sm);
            overflow: hidden;
            animation: trainingPanelIn .5s cubic-bezier(.2, .7, .2, 1) both;
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
        }

        /* =========================================================
               TABLE
               ========================================================= */

        .members-table {
            width: 100%;
            min-width: 760px;
            border-collapse: collapse;
        }

        .members-table th {
            padding: 13px 15px;
            color: var(--muted);
            background: var(--surface-2);
            border-bottom: 1px solid var(--border);
            font-size: 9px;
            font-weight: 750;
            text-align: right;
            white-space: nowrap;
        }

        .members-table td {
            padding: 14px 15px;
            color: var(--text-soft);
            background: var(--surface);
            border-bottom: 1px solid var(--border);
            vertical-align: middle;
            font-size: 10px;
            transition: background .15s ease;
        }

        .members-table tbody tr {
            transition: background .15s ease;
        }

        .members-table tbody tr:hover td {
            background: color-mix(in srgb, var(--gold) 4%, var(--surface));
        }

        .members-table tbody tr:last-child td {
            border-bottom: 0;
        }

        /* =========================================================
               PLAN TITLE
               ========================================================= */

        .plan-title-cell {
            color: var(--gold) !important;
            font-weight: 800 !important;
        }

        .plan-exercises-info {
            display: block;
            margin-top: 5px;
            color: var(--muted);
            font-size: 8.5px;
            font-weight: 600;
        }

        .plan-exercises-info.empty {
            color: var(--danger);
        }

        .plan-exercises-info i {
            margin-left: 3px;
        }

        /* =========================================================
               LEVEL CHIP
               ========================================================= */

        .level-chip {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            min-height: 27px;
            padding: 5px 9px;
            color: var(--gold-dark);
            background: color-mix(in srgb, var(--gold) 9%, var(--surface));
            border: 1px solid color-mix(in srgb, var(--gold) 23%, var(--border));
            border-radius: 999px;
            font-size: 8.5px;
            font-weight: 750;
            white-space: nowrap;
        }

        .level-chip i {
            color: var(--gold);
            font-size: 8px;
        }

        /* =========================================================
               DATE
               ========================================================= */

        .plan-created-date {
            color: var(--muted);
            font-size: 9px;
            font-weight: 550;
            white-space: nowrap;
        }

        /* =========================================================
               ACTIONS
               ========================================================= */

        .plan-actions {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
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
            min-height: 230px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 35px 20px;
            color: var(--muted);
            text-align: center;
        }

        .training-bank-empty i {
            margin-bottom: 4px;
            color: var(--gold);
            font-size: 29px;
            opacity: .72;
            animation: trainingEmptyBreathe 2.4s ease-in-out infinite;
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
            font-size: 12px;
            font-weight: 750;
        }

        .training-bank-empty span {
            max-width: 450px;
            font-size: 9px;
            line-height: 1.8;
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
            background: rgba(8, 10, 13, .62);
            backdrop-filter: blur(7px);
        }

        .modal.open {
            display: flex;
        }

        .modal-content {
            width: 100%;
            max-width: 500px;
            max-height: calc(100vh - 40px);
            overflow: hidden;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 18px;
            box-shadow: var(--shadow);
            animation: modalFade .25s cubic-bezier(.2, .7, .2, 1);
        }

        @keyframes modalFade {
            from {
                opacity: 0;
                transform: translateY(-14px) scale(.985);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        /* =========================================================
               MODAL HEADER
               ========================================================= */

        .modal-header {
            min-height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            padding: 14px 18px;
            background: var(--surface);
            border-bottom: 1px solid var(--border);
        }

        .modal-header h4 {
            display: flex;
            align-items: center;
            gap: 8px;
            margin: 0;
            color: var(--text);
            font-size: 13px;
            font-weight: 800;
        }

        .modal-header h4 i {
            color: var(--gold);
            font-size: 13px;
        }

        .close-modal {
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex: 0 0 32px;
            color: var(--muted);
            background: var(--surface-2);
            border: 1px solid var(--border);
            border-radius: 9px;
            cursor: pointer;
            font-size: 20px;
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
            background: color-mix(in srgb, var(--danger) 7%, var(--surface-2));
            border-color: color-mix(in srgb, var(--danger) 25%, var(--border));
            transform: rotate(3deg);
        }

        /* =========================================================
               MODAL BODY
               ========================================================= */

        .modal-body {
            padding: 20px;
            overflow-y: auto;
            max-height: calc(100vh - 130px);
        }

        .field-group {
            margin-bottom: 16px;
        }

        .field-label {
            display: block;
            margin-bottom: 7px;
            color: var(--text-soft);
            font-size: 10px;
            font-weight: 700;
        }

        .field-input {
            width: 100%;
            min-height: 43px;
            padding: 10px 12px;
            color: var(--text);
            background: var(--surface-2);
            border: 1px solid var(--border);
            border-radius: 10px;
            outline: none;
            font-family: inherit;
            font-size: 10px;
            transition:
                border-color .2s ease,
                background .2s ease,
                box-shadow .2s ease;
        }

        .field-input:focus {
            background: var(--surface);
            border-color: color-mix(in srgb, var(--gold) 55%, var(--border));
            box-shadow: 0 0 0 3px color-mix(in srgb, var(--gold) 8%, transparent);
        }

        .field-input::placeholder {
            color: var(--muted);
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
            min-height: 46px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 11px 15px;
            margin-top: 5px;
            color: #171717;
            background: linear-gradient(135deg, var(--gold-light), var(--gold-dark));
            border: 0;
            border-radius: 11px;
            box-shadow: 0 8px 20px rgba(184, 146, 62, .15);
            cursor: pointer;
            font-family: inherit;
            font-size: 10px;
            font-weight: 800;
            transition:
                transform .2s ease,
                box-shadow .2s ease;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 27px rgba(184, 146, 62, .22);
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
            background: color-mix(in srgb, var(--gold) 4%, var(--surface));
        }

        /* =========================================================
               RESPONSIVE
               ========================================================= */

        @media (max-width: 900px) {

            .training-bank-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .training-bank-header-action,
            .training-bank-header-action .btn-green {
                width: 100%;
            }

            .training-bank-title {
                font-size: 21px;
            }

            .training-bank-panel {
                border-radius: 15px;
            }
        }

        @media (max-width: 650px) {

            .training-bank-header {
                margin-bottom: 16px;
            }

            .training-bank-title {
                font-size: 19px;
            }

            .training-bank-subtitle {
                font-size: 9px;
            }

            .members-table {
                min-width: 720px;
            }

            .members-table th,
            .members-table td {
                padding: 12px;
            }

            .modal {
                padding: 12px;
            }

            .modal-content {
                max-height: calc(100vh - 24px);
                border-radius: 15px;
            }

            .modal-header {
                padding: 13px 14px;
            }

            .modal-body {
                padding: 15px;
            }
        }

        @media (max-width: 480px) {

            .training-bank-title {
                gap: 8px;
                font-size: 18px;
            }

            .training-bank-title i {
                font-size: 17px;
            }

            .modal-header h4 {
                font-size: 11px;
            }

            .plan-actions {
                gap: 5px;
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

                <button class="btn-green" style="padding: 10px 16px; font-size: 10px;" onclick="openAddModal()">

                    <i class="fas fa-plus"></i>

                    إضافة خطة جديدة للبنك

                </button>

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

                            <th style="width: 32%;">
                                اسم الخطة التدريبية
                            </th>

                            <th style="width: 16%; text-align: center;">
                                المستوى المستهدف
                            </th>

                            <th style="width: 14%; text-align: center;">
                                تاريخ الإنشاء
                            </th>

                            <th style="width: 38%; text-align: center;">
                                إجراءات الخطة والتمارين
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($plans as $plan)
                            <tr>

                                <td class="plan-title-cell">

                                    {{ $plan->title ?? 'خطة تدريبية عامة' }}

                                    <span class="plan-exercises-info {{ $plan->exercises_count ? '' : 'empty' }}">

                                        <i class="fas fa-list-ol"></i>

                                        {{ $plan->exercises_count }}
                                        تمرين{{ $plan->exercises_count ? '' : ' — الخطة فارغة' }}

                                    </span>

                                </td>

                                <td style="text-align: center;">

                                    <span class="level-chip">

                                        <i class="fas fa-layer-group"></i>

                                        {{ $plan->level ?? 'عام' }}

                                    </span>

                                </td>

                                <td style="text-align: center;">

                                    <span class="plan-created-date">

                                        {{ $plan->created_at->format('Y-m-d') }}

                                    </span>

                                </td>

                                <td style="text-align: center;">

                                    <div class="plan-actions">

                                        {{-- =================================================
                                             زر إضافة وإدارة تمارين الخطة
                                        ================================================== --}}

                                        <a href="{{ route('employee.training.exercises.index', $plan->id) }}"
                                            class="btn-gold-action"
                                            style="white-space: nowrap; padding: 6px 12px; font-size: 9px;">

                                            <i class="fas fa-list-ol"></i>

                                            تمارين الخطة

                                        </a>

                                        {{-- =================================================
                                             زر توزيع الخطة على لاعبي نفس المستوى
                                        ================================================== --}}

                                        <form action="{{ route('employee.training.bank.distribute', $plan->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('سيتم توزيع الخطة وتمارينها على جميع لاعبي هذا المستوى، واستبدال أي نسخة قديمة لديهم. متابعة؟')"
                                            style="margin: 0; display: inline-block;">

                                            @csrf

                                            <button type="submit" class="btn-green"
                                                style="white-space: nowrap; padding: 6px 12px; font-size: 9px;"
                                                @disabled(!$plan->exercises_count)>

                                                <i class="fas fa-share-nodes"></i>

                                                توزيع

                                            </button>

                                        </form>

                                        {{-- =================================================
                                             زر حذف الخطة
                                        ================================================== --}}

                                        <form action="{{ route('employee.training.bank.destroy', $plan->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('هل أنت متأكد من حذف هذه الخطة بالكامل من البنك؟')"
                                            style="margin: 0; display: inline-block;">

                                            @csrf

                                            @method('DELETE')

                                            <button type="submit" class="btn-delete"
                                                style="white-space: nowrap; padding: 6px 12px; font-size: 9px;">

                                                <i class="fas fa-trash"></i>

                                                حذف

                                            </button>

                                        </form>

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
                                            ابدأ بإضافة خطتك التدريبية الأولى وتخصيص اسمها ومستواها.
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

        <div id="addPlanModal" class="modal">

            <div class="modal-content">

                <div class="modal-header">

                    <h4>

                        <i class="fas fa-dumbbell"></i>

                        إضافة خطة تمارين عامة للبنك

                    </h4>

                    <span class="close-modal" onclick="closeAddModal()">

                        &times;

                    </span>

                </div>

                <form action="{{ route('employee.training.bank.store') }}" method="POST">

                    @csrf

                    <div class="modal-body">

                        <div class="field-group">

                            <label class="field-label">
                                اسم الخطة التدريبية
                            </label>

                            <input type="text" name="title" class="field-input"
                                placeholder="مثال: خطة تضخيم العضلات - شهر أول" required>

                        </div>

                        <div class="field-group">

                            <label class="field-label">
                                المستوى المستهدف (الصنف)
                            </label>

                            <select name="level" class="field-input" required>

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
            document.getElementById('addPlanModal').classList.add('open');
        }

        function closeAddModal() {
            document.getElementById('addPlanModal').classList.remove('open');
        }

        window.onclick = function(event) {
            if (event.target == document.getElementById('addPlanModal')) {
                closeAddModal();
            }
        }
    </script>

@endsection
