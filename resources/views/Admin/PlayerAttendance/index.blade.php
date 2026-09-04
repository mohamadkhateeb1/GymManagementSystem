@extends('Admin.layouts.app')

@section('title', 'تقارير حضور اللاعبين | Elite Club')

@section('styles')

    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --attendance-bg: #f5f7fb;

            --attendance-surface: #ffffff;
            --attendance-surface-2: #f8fafc;
            --attendance-surface-3: #f1f4f8;

            --attendance-border: #e2e7ef;
            --attendance-border-soft: #edf0f5;

            --attendance-text: #172033;
            --attendance-text-2: #475569;
            --attendance-muted: #8a94a6;

            --attendance-gold: #c89b3c;
            --attendance-gold-dark: #a87d25;

            --attendance-gold-soft: rgba(200, 155, 60, 0.12);

            --attendance-gold-line: rgba(200, 155, 60, 0.28);

            --attendance-success: #31a66f;

            --attendance-blue: #4d8fe8;

            --attendance-blue-soft: rgba(77, 143, 232, 0.11);

            --attendance-danger: #e35d6a;

            --attendance-shadow: 0 10px 35px rgba(24, 35, 52, 0.07);

            --attendance-shadow-soft: 0 5px 20px rgba(24, 35, 52, 0.05);

            --attendance-radius: 18px;

            --attendance-transition: 0.25s ease;
        }

        [data-theme="dark"] {
            --attendance-bg: #10141b;

            --attendance-surface: #171d26;
            --attendance-surface-2: #1b222d;
            --attendance-surface-3: #202834;

            --attendance-border: #303a48;
            --attendance-border-soft: #293340;

            --attendance-text: #f5f7fb;
            --attendance-text-2: #c1c9d5;
            --attendance-muted: #7f8a9c;

            --attendance-gold: #d5a63f;
            --attendance-gold-dark: #b98522;

            --attendance-gold-soft: rgba(213, 166, 63, 0.10);

            --attendance-gold-line: rgba(213, 166, 63, 0.28);

            --attendance-blue: #62a0f3;

            --attendance-blue-soft: rgba(98, 160, 243, 0.10);

            --attendance-danger: #f06b76;

            --attendance-shadow: 0 15px 45px rgba(0, 0, 0, 0.28);

            --attendance-shadow-soft: 0 8px 25px rgba(0, 0, 0, 0.20);
        }

        body.dark-mode {
            --attendance-bg: #10141b;

            --attendance-surface: #171d26;
            --attendance-surface-2: #1b222d;
            --attendance-surface-3: #202834;

            --attendance-border: #303a48;
            --attendance-border-soft: #293340;

            --attendance-text: #f5f7fb;
            --attendance-text-2: #c1c9d5;
            --attendance-muted: #7f8a9c;

            --attendance-gold: #d5a63f;
            --attendance-gold-dark: #b98522;

            --attendance-gold-soft: rgba(213, 166, 63, 0.10);

            --attendance-gold-line: rgba(213, 166, 63, 0.28);

            --attendance-blue: #62a0f3;

            --attendance-blue-soft: rgba(98, 160, 243, 0.10);

            --attendance-danger: #f06b76;

            --attendance-shadow: 0 15px 45px rgba(0, 0, 0, 0.28);
        }

        .attendance-wrapper {
            width: 100%;
            max-width: 100%;
            margin: 0 auto;
            padding: 4px 0 30px;
            direction: rtl;
            color: var(--attendance-text);
            transition: background var(--attendance-transition), color var(--attendance-transition);
        }

        .attendance-wrapper>div:first-child {
            margin-bottom: 18px !important;
        }

        .kpi-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 18px;
            margin-bottom: 22px;
        }

        .kpi-card {
            position: relative;
            min-height: 120px;
            display: flex;
            align-items: center;
            gap: 18px;
            padding: 22px 24px;
            background: linear-gradient(145deg, var(--attendance-surface), var(--attendance-surface-2));
            border: 1px solid var(--attendance-border);
            border-radius: var(--attendance-radius);
            box-shadow: var(--attendance-shadow-soft);
            overflow: hidden;
            transition: transform var(--attendance-transition), border-color var(--attendance-transition), box-shadow var(--attendance-transition);
        }

        .kpi-card::before {
            content: "";
            position: absolute;
            left: 0;
            right: 0;
            bottom: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--kpi-color), transparent);
            opacity: 0.75;
        }

        .kpi-card::after {
            content: "";
            position: absolute;
            width: 130px;
            height: 130px;
            left: -45px;
            bottom: -70px;
            border-radius: 50%;
            background: var(--kpi-color);
            opacity: 0.035;
            pointer-events: none;
        }

        .kpi-card:hover {
            transform: translateY(-3px);
            border-color: var(--kpi-color);
            box-shadow: var(--attendance-shadow);
        }

        .kpi-icon {
            width: 58px;
            height: 58px;
            flex: 0 0 58px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 16px;
            color: var(--kpi-color);
            background: color-mix(in srgb, var(--kpi-color) 11%, transparent);
            border: 1px solid color-mix(in srgb, var(--kpi-color) 25%, transparent);
            font-size: 22px;
        }

        .kpi-value {
            margin: 0 0 4px;
            color: var(--attendance-text);
            font-size: 30px;
            font-weight: 800;
            line-height: 1.1;
        }

        .kpi-label {
            color: var(--attendance-text-2);
            font-size: 14px;
            font-weight: 700;
        }

        .panel {
            position: relative;
            width: 100%;
            background: linear-gradient(145deg, var(--attendance-surface), var(--attendance-surface-2));
            border: 1px solid var(--attendance-border);
            border-radius: 20px;
            box-shadow: var(--attendance-shadow);
            overflow: hidden;
        }

        .panel-head {
            min-height: 82px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px 25px;
            background: linear-gradient(180deg, var(--attendance-surface-2), var(--attendance-surface));
            border-bottom: 1px solid var(--attendance-border);
        }

        .panel-head h3 {
            display: flex;
            align-items: center;
            gap: 11px;
            margin: 0;
            color: var(--attendance-text);
            font-size: 19px;
            font-weight: 800;
        }

        .panel-head h3 i {
            width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 11px;
            color: var(--attendance-gold);
            background: var(--attendance-gold-soft);
            border: 1px solid var(--attendance-gold-line);
            font-size: 16px;
        }

        .filter-bar {
            padding: 20px 22px;
            background: linear-gradient(180deg, var(--attendance-surface-3), var(--attendance-surface-2));
            border-bottom: 1px solid var(--attendance-border);
        }

        .filter-form {
            display: grid;
            grid-template-columns: minmax(180px, 1.3fr) minmax(160px, 1fr) minmax(150px, 1fr) minmax(150px, 1fr) auto;
            align-items: end;
            gap: 13px;
        }

        .filter-form>div {
            min-width: 0;
        }

        .field-label {
            display: block;
            margin-bottom: 8px;
            color: var(--attendance-text-2);
            font-size: 13px;
            font-weight: 700;
            text-align: right;
        }

        .field-input {
            width: 100%;
            height: 48px;
            padding: 0 15px;
            border-radius: 11px;
            border: 1px solid var(--attendance-border);
            outline: none;
            background: var(--attendance-surface);
            color: var(--attendance-text);
            font-family: inherit;
            font-size: 13px;
            font-weight: 600;
            transition: border-color var(--attendance-transition), box-shadow var(--attendance-transition), background var(--attendance-transition);
        }

        .field-input::placeholder {
            color: var(--attendance-muted);
        }

        .field-input:hover {
            border-color: var(--attendance-gold-line);
        }

        .field-input:focus {
            border-color: var(--attendance-gold);
            box-shadow: 0 0 0 3px var(--attendance-gold-soft);
        }

        select.field-input {
            cursor: pointer;
            appearance: auto;
        }

        .field-input[type="date"] {
            direction: ltr;
            text-align: right;
        }

        .filter-form>div:last-child {
            display: flex !important;
            align-items: center;
            gap: 8px !important;
        }

        .action-btn {
            height: 48px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0 19px;
            border-radius: 11px;
            text-decoration: none;
            font-family: inherit;
            font-size: 13px;
            font-weight: 800;
            cursor: pointer;
            white-space: nowrap;
            transition: transform var(--attendance-transition), background var(--attendance-transition), border-color var(--attendance-transition), box-shadow var(--attendance-transition), color var(--attendance-transition);
        }

        .action-btn:hover {
            transform: translateY(-2px);
        }

        .btn-solid {
            border: 1px solid var(--attendance-gold);
            color: #ffffff;
            background: linear-gradient(135deg, var(--attendance-gold), var(--attendance-gold-dark));
            box-shadow: 0 6px 18px rgba(200, 155, 60, 0.20);
        }

        .btn-solid:hover {
            box-shadow: 0 9px 25px rgba(200, 155, 60, 0.28);
        }

        .btn-ghost {
            border: 1px solid var(--attendance-border);
            color: var(--attendance-text-2);
            background: var(--attendance-surface);
        }

        .btn-ghost:hover {
            color: var(--attendance-text);
            border-color: var(--attendance-gold-line);
            background: var(--attendance-gold-soft);
        }

        .members-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            table-layout: fixed;
            direction: rtl;
            background: var(--attendance-surface);
            color: var(--attendance-text);
        }

        .members-table thead {
            background: linear-gradient(180deg, var(--attendance-surface-2), var(--attendance-surface));
        }

        .members-table thead th {
            height: 61px;
            padding: 0 20px;
            color: var(--attendance-text);
            border-bottom: 1px solid var(--attendance-border);
            font-size: 13px;
            font-weight: 800;
            text-align: right;
            white-space: nowrap;
        }

        .members-table thead th:first-child {
            padding-right: 25px;
        }

        .members-table thead th:last-child {
            padding-left: 25px;
        }

        .members-table tbody tr {
            background: var(--attendance-surface);
            transition: background var(--attendance-transition);
        }

        .members-table tbody tr:hover {
            background: linear-gradient(90deg, var(--attendance-gold-soft), transparent);
        }

        .members-table tbody td {
            height: 70px;
            padding: 12px 20px;
            color: var(--attendance-text) !important;
            border-bottom: 1px solid var(--attendance-border-soft);
            font-size: 14px;
            font-weight: 600;
            vertical-align: middle;
        }

        .members-table tbody td:first-child {
            padding-right: 25px;
            color: var(--attendance-text) !important;
            font-weight: 700 !important;
        }

        .members-table tbody td:nth-child(2) {
            color: var(--attendance-text-2) !important;
        }

        .members-table tbody td[dir="ltr"] {
            font-family: "Inter", "Segoe UI", Arial, sans-serif;
            letter-spacing: 0.2px;
        }

        .members-table tbody tr:last-child td {
            border-bottom: none;
        }

        .source-chip {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            min-width: 90px;
            padding: 7px 12px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 800;
            white-space: nowrap;
        }

        .source-chip i {
            font-size: 11px;
        }

        .source-chip.app {
            color: var(--attendance-blue);
            background: var(--attendance-blue-soft);
            border: 1px solid rgba(77, 143, 232, 0.22);
        }

        .source-chip.coach {
            color: var(--attendance-gold);
            background: var(--attendance-gold-soft);
            border: 1px solid var(--attendance-gold-line);
        }

        .members-table .empty-row td {
            height: 230px;
            padding: 45px 20px;
            color: var(--attendance-text-2) !important;
            text-align: center;
            font-size: 14px;
            font-weight: 700;
            border-bottom: none;
        }

        .members-table .empty-row:hover {
            background: var(--attendance-surface);
        }

        .members-table .empty-row td::before {
            content: "\f03a";
            display: flex;
            align-items: center;
            justify-content: center;
            width: 54px;
            height: 54px;
            margin: 0 auto 14px;
            border-radius: 15px;
            color: var(--attendance-gold);
            background: var(--attendance-gold-soft);
            border: 1px solid var(--attendance-gold-line);
            font-family: "Font Awesome 6 Free";
            font-size: 19px;
            font-weight: 900;
        }

        .pagination-wrap {
            width: 100%;
            padding: 20px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: var(--attendance-surface-2);
            border-top: 1px solid var(--attendance-border);
            direction: rtl;
        }

        .pagination-wrap nav {
            width: 100%;
        }

        .pagination-wrap nav>div {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .pagination-wrap nav>div>div:first-child {
            display: flex;
            align-items: center;
            color: var(--attendance-text-2);
            font-size: 13px;
            font-weight: 700;
            white-space: nowrap;
        }

        .pagination-wrap nav>div>div:first-child span {
            width: auto !important;
            min-width: 0 !important;
            height: auto !important;
            display: inline !important;
            padding: 0 !important;
            margin: 0 !important;
            border: 0 !important;
            border-radius: 0 !important;
            background: transparent !important;
            color: var(--attendance-text) !important;
            box-shadow: none !important;
            font-size: inherit;
            font-weight: 800;
        }

        .pagination-wrap nav>div>div:last-child {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

        .pagination-wrap nav>div>div:last-child a,
        .pagination-wrap nav>div>div:last-child span {
            position: relative;
            width: 40px;
            height: 40px;
            min-width: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0 10px;
            margin: 0;
            border-radius: 11px;
            border: 1px solid var(--attendance-border);
            background: var(--attendance-surface);
            color: var(--attendance-text-2);
            text-decoration: none;
            font-family: inherit;
            font-size: 12px;
            font-weight: 800;
            line-height: 1;
            box-sizing: border-box;
            transition: transform 0.2s ease, background 0.2s ease, border-color 0.2s ease, color 0.2s ease, box-shadow 0.2s ease;
        }

        .pagination-wrap nav>div>div:last-child a:hover {
            transform: translateY(-2px);
            color: var(--attendance-gold);
            background: var(--attendance-gold-soft);
            border-color: var(--attendance-gold);
            box-shadow: 0 6px 16px rgba(200, 155, 60, 0.14);
        }

        .pagination-wrap nav>div>div:last-child span[aria-current="page"] {
            color: #ffffff !important;
            background: linear-gradient(135deg, var(--attendance-gold), var(--attendance-gold-dark)) !important;
            border-color: var(--attendance-gold) !important;
            box-shadow: 0 6px 18px rgba(200, 155, 60, 0.25);
            cursor: default;
        }

        .pagination-wrap nav>div>div:last-child span[aria-disabled="true"] {
            color: var(--attendance-muted) !important;
            background: var(--attendance-surface-3) !important;
            border-color: var(--attendance-border) !important;
            opacity: 0.45;
            cursor: not-allowed;
            box-shadow: none !important;
            transform: none !important;
        }

        .pagination-wrap nav>div>div:last-child svg {
            width: 15px !important;
            height: 15px !important;
            flex-shrink: 0;
        }

        .pagination-wrap nav>div>div:last-child a:focus-visible {
            outline: none;
            border-color: var(--attendance-gold);
            box-shadow: 0 0 0 3px var(--attendance-gold-soft);
        }

        [data-theme="dark"] .pagination-wrap nav>div>div:last-child a,

        [data-theme="dark"] .pagination-wrap nav>div>div:last-child span,

        body.dark-mode .pagination-wrap nav>div>div:last-child a,

        body.dark-mode .pagination-wrap nav>div>div:last-child span {
            background: var(--attendance-surface);
            color: var(--attendance-text-2);
            border-color: var(--attendance-border);
        }

        [data-theme="dark"] .pagination-wrap nav>div>div:last-child a:hover,

        body.dark-mode .pagination-wrap nav>div>div:last-child a:hover {
            color: var(--attendance-gold);
            background: var(--attendance-gold-soft);
            border-color: var(--attendance-gold);
        }

        [data-theme="dark"] .pagination-wrap nav>div>div:last-child span[aria-current="page"],

        body.dark-mode .pagination-wrap nav>div>div:last-child span[aria-current="page"] {
            color: #ffffff !important;
            background: linear-gradient(135deg, var(--attendance-gold), var(--attendance-gold-dark)) !important;
            border-color: var(--attendance-gold) !important;
        }

        @media (max-width: 1100px) {
            .kpi-grid {
                grid-template-columns: repeat(3, 1fr);
            }

            .filter-form {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .filter-form>div:last-child {
                grid-column: 1 / -1;
                justify-content: flex-start;
            }

            .panel {
                overflow-x: auto;
            }

            .members-table {
                min-width: 780px;
            }

            .panel-head {
                min-width: 780px;
            }

            .filter-bar {
                min-width: 780px;
            }

            .pagination-wrap {
                min-width: 780px;
            }
        }

        @media (max-width: 768px) {
            .attendance-wrapper {
                padding: 0 0 20px;
            }

            .kpi-grid {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .kpi-card {
                min-height: 100px;
                padding: 18px;
            }

            .kpi-icon {
                width: 50px;
                height: 50px;
                flex-basis: 50px;
                border-radius: 14px;
            }

            .kpi-value {
                font-size: 24px;
            }

            .panel {
                border-radius: 15px;
                overflow-x: auto;
            }

            .panel-head {
                min-height: 70px;
                padding: 16px 18px;
            }

            .panel-head h3 {
                font-size: 16px;
            }

            .panel-head h3 i {
                width: 34px;
                height: 34px;
            }

            .filter-bar {
                padding: 16px;
            }

            .filter-form {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .filter-form>div:last-child {
                grid-column: auto;
                width: 100%;
            }

            .action-btn {
                flex: 1;
                padding: 0 14px;
            }

            .members-table {
                min-width: 760px;
            }



            .pagination-wrap {
                min-width: 760px;
                padding: 18px 16px;
                overflow-x: auto;
                justify-content: center;
            }

            .pagination-wrap nav {
                width: auto;
                min-width: max-content;
            }

            .pagination-wrap nav>div {
                width: auto;
                justify-content: center;
            }

            .pagination-wrap nav>div>div:first-child {
                display: none;
            }

            .pagination-wrap nav>div>div:last-child {
                gap: 5px;
            }

            .pagination-wrap nav>div>div:last-child a,
            .pagination-wrap nav>div>div:last-child span {
                width: 38px;
                height: 38px;
                min-width: 38px;
                border-radius: 10px;
            }
        }

        @media (max-width: 480px) {
            .kpi-card {
                gap: 13px;
                padding: 16px;
            }

            .kpi-icon {
                width: 46px;
                height: 46px;
                flex-basis: 46px;
                font-size: 18px;
            }

            .kpi-value {
                font-size: 22px;
            }

            .kpi-label {
                font-size: 12px;
            }

            .panel-head h3 {
                font-size: 15px;
            }

            .filter-form {
                gap: 10px;
            }

            .field-input {
                height: 46px;
            }

            .action-btn {
                height: 46px;
            }

            .pagination-wrap {
                min-width: 760px;
                padding: 15px 10px;
            }

            .pagination-wrap nav>div>div:last-child {
                gap: 4px;
            }

            .pagination-wrap nav>div>div:last-child a,
            .pagination-wrap nav>div>div:last-child span {
                width: 34px;
                height: 34px;
                min-width: 34px;
                border-radius: 9px;
                font-size: 11px;
            }

            .pagination-wrap nav>div>div:last-child svg {
                width: 13px !important;
                height: 13px !important;
            }
        }

        [data-theme="dark"] .members-table,
        body.dark-mode .members-table {
            background: #171d26;
        }

        [data-theme="dark"] .members-table thead,
        body.dark-mode .members-table thead {
            background: #151b24;
        }

        [data-theme="dark"] .members-table tbody tr,
        body.dark-mode .members-table tbody tr {
            background: #171d26;
        }

        [data-theme="dark"] .members-table tbody tr:hover,
        body.dark-mode .members-table tbody tr:hover {
            background: linear-gradient(90deg, rgba(213, 166, 63, 0.08), transparent);
        }

        [data-theme="dark"] .members-table tbody td,
        body.dark-mode .members-table tbody td {
            color: #f5f7fb !important;
            border-bottom-color: #293340;
        }

        [data-theme="dark"] .members-table tbody td:nth-child(2),

        body.dark-mode .members-table tbody td:nth-child(2) {
            color: #c1c9d5 !important;
        }

        [data-theme="dark"] .members-table thead th,
        body.dark-mode .members-table thead th {
            color: #8995a8;
        }

        [data-theme="dark"] .members-table .empty-row td,
        body.dark-mode .members-table .empty-row td {
            color: #7f8a9c !important;
        }

        .attendance-wrapper ::-webkit-scrollbar {
            width: 7px;
            height: 7px;
        }

        .attendance-wrapper ::-webkit-scrollbar-track {
            background: transparent;
        }

        .attendance-wrapper ::-webkit-scrollbar-thumb {
            background: var(--attendance-border);
            border-radius: 20px;
        }

        .attendance-wrapper ::-webkit-scrollbar-thumb:hover {
            background: var(--attendance-gold);
        }

        .attendance-wrapper,
        .attendance-wrapper .kpi-card,
        .attendance-wrapper .panel,
        .attendance-wrapper .panel-head,
        .attendance-wrapper .filter-bar,
        .attendance-wrapper .field-input,
        .attendance-wrapper .members-table,
        .attendance-wrapper .members-table thead,
        .attendance-wrapper .members-table tbody tr,
        .attendance-wrapper .pagination-wrap,
        .attendance-wrapper .pagination-wrap a,
        .attendance-wrapper .pagination-wrap span {
            transition: background-color 0.25s ease, border-color 0.25s ease, color 0.25s ease, box-shadow 0.25s ease;
        }
    </style>

@endsection

@section('content')

    <div class="attendance-wrapper">

        <div style="margin-bottom: 16px;">
            <x-flash-message />
        </div>

        <div class="kpi-grid">

            <div class="kpi-card" style="--kpi-color:#5a9c7a;">

                <div class="kpi-icon">

                    <i class="fas fa-user-check"></i>

                </div>

                <div>

                    <div class="kpi-value">
                        {{ $todayCount }}
                    </div>

                    <div class="kpi-label">
                        حضروا اليوم
                    </div>

                </div>

            </div>

            <div class="kpi-card" style="--kpi-color:#60a5fa;">

                <div class="kpi-icon">

                    <i class="fas fa-calendar-week"></i>

                </div>

                <div>

                    <div class="kpi-value">
                        {{ $weekCount }}
                    </div>

                    <div class="kpi-label">
                        حضور هذا الأسبوع
                    </div>

                </div>

            </div>

            <div class="kpi-card" style="--kpi-color:#c9a961;">

                <div class="kpi-icon">

                    <i class="fas fa-list-check"></i>

                </div>

                <div>

                    <div class="kpi-value">
                        {{ $totalCount }}
                    </div>

                    <div class="kpi-label">
                        إجمالي السجلات
                    </div>

                </div>

            </div>

        </div>

        <div class="panel">

            <div class="panel-head">

                <h3>

                    <i class="fas fa-user-clock"></i>

                    سجل حضور اللاعبين

                </h3>

            </div>

            <div class="filter-bar">

                <form action="{{ route('admin.attendance.players.index') }}" method="GET" class="filter-form">

                    <div>

                        <label class="field-label">
                            بحث باسم اللاعب
                        </label>

                        <input type="text" name="player_name" class="field-input" value="{{ request('player_name') }}"
                            placeholder="اسم اللاعب...">

                    </div>

                    <div>

                        <label class="field-label">
                            المدرب
                        </label>

                        <select name="coach_id" class="field-input">

                            <option value="">
                                كل المدربين
                            </option>

                            @foreach ($coaches as $coach)
                                <option value="{{ $coach->id }}"
                                    {{ request('coach_id') == $coach->id ? 'selected' : '' }}>
                                    {{ $coach->name }}
                                </option>
                            @endforeach

                        </select>

                    </div>

                    <div>

                        <label class="field-label">
                            من تاريخ
                        </label>

                        <input type="date" name="date_from" class="field-input" value="{{ request('date_from') }}">

                    </div>

                    <div>

                        <label class="field-label">
                            إلى تاريخ
                        </label>

                        <input type="date" name="date_to" class="field-input" value="{{ request('date_to') }}">

                    </div>

                    <div>

                        <button type="submit" class="action-btn btn-solid">

                            تطبيق

                        </button>

                        <a href="{{ route('admin.attendance.players.index') }}" class="action-btn btn-ghost">

                            إلغاء

                        </a>

                    </div>

                </form>

            </div>

            <table class="members-table">

                <thead>

                    <tr>

                        <th>
                            اللاعب
                        </th>

                        <th>
                            المدرب
                        </th>

                        <th>
                            تاريخ الحضور
                        </th>

                        <th>
                            وقت التسجيل
                        </th>

                        <th>
                            المصدر
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse ($logs as $log)
                        <tr>

                            <td>

                                {{ $log->player->name ?? 'لاعب محذوف' }}

                            </td>

                            <td>

                                {{ $log->player->coach->name ?? '—' }}

                            </td>

                            <td dir="ltr">

                                {{ $log->attendance_date->format('Y-m-d') }}

                            </td>

                            <td dir="ltr">

                                {{ $log->attended_at->format('H:i') }}

                            </td>

                            <td>

                                <span class="source-chip {{ $log->source }}">

                                    <i
                                        class="fas
                                    {{ $log->source === 'app' ? 'fa-mobile-screen' : 'fa-user-tie' }}"></i>

                                    {{ $log->source === 'app' ? 'التطبيق' : 'المدرب' }}

                                </span>

                            </td>

                        </tr>

                    @empty

                        <tr class="empty-row">

                            <td colspan="5">

                                لا توجد سجلات حضور مطابقة للفلاتر الحالية.

                            </td>

                        </tr>
                    @endforelse

                </tbody>

            </table>

            @if ($logs->hasPages())
                <div class="pagination-wrap">

                    {{ $logs->withQueryString()->links() }}

                </div>
            @endif

        </div>

    </div>

@endsection
