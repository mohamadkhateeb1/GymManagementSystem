@extends('Admin.layouts.app')

@section('title', 'تعديل الدور | Elite Club')


@section('styles')

    <style>
        /* =========================================================
       ROLES EDIT PAGE
       ========================================================= */

        .roles-page {
            width: 100%;
            direction: rtl;
            color: var(--text, #111827);
        }

        .roles-page * {
            box-sizing: border-box;
        }


        /* HEADER */

        .roles-header {
            display: flex;
            align-items: center;
            justify-content: space-between;

            gap: 20px;
            margin-bottom: 22px;
        }

        .roles-header-info {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .header-accent {
            width: 4px;
            height: 52px;

            border-radius: 10px;

            background: linear-gradient(to bottom,
                    var(--gold, #c9a227),
                    #e8c66a);

            box-shadow: 0 0 18px rgba(201, 162, 39, .18);
        }

        .header-title {
            margin: 0;

            color: var(--text, #111827);

            font-size: 24px;
            font-weight: 800;
        }

        .header-title span {
            color: var(--gold, #c9a227);
        }

        .header-sub {
            margin-top: 5px;

            color: var(--muted, #6b7280);

            font-size: 13px;
        }


        /* BACK */

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 9px;

            padding: 11px 18px;

            border-radius: 10px;

            border: 1px solid var(--border, #e5e7eb);

            background: var(--surface, #fff);

            color: var(--text, #111827);

            text-decoration: none;

            font-size: 13px;
            font-weight: 700;

            transition: .2s ease;
        }

        .btn-back:hover {
            border-color: var(--gold, #c9a227);
            color: var(--gold, #c9a227);
        }


        /* CARD */

        .role-card {
            background: var(--surface, #fff);

            border: 1px solid var(--border, #e5e7eb);

            border-radius: 18px;

            overflow: hidden;

            box-shadow: 0 8px 30px rgba(0, 0, 0, .04);
        }

        .role-card-top {
            display: flex;
            align-items: center;
            gap: 12px;

            padding: 18px 24px;

            border-bottom: 1px solid var(--border, #e5e7eb);

            background:
                linear-gradient(90deg,
                    rgba(201, 162, 39, .07),
                    transparent);
        }

        .role-card-top i {
            width: 34px;
            height: 34px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 9px;

            background: rgba(201, 162, 39, .12);

            color: var(--gold, #c9a227);
        }

        .role-card-top span {
            color: var(--text, #111827);

            font-size: 15px;
            font-weight: 800;
        }


        /* FORM */

        .role-form {
            padding: 26px;
        }


        /* FIELD */

        .role-field {
            margin-bottom: 28px;
        }

        .role-label {
            display: flex;
            align-items: center;
            gap: 8px;

            margin-bottom: 9px;

            color: var(--text, #111827);

            font-size: 13px;
            font-weight: 700;
        }

        .role-label i {
            color: var(--gold, #c9a227);
        }

        .role-input-wrap {
            position: relative;
        }

        .role-input-wrap>i {
            position: absolute;

            right: 15px;
            top: 50%;

            transform: translateY(-50%);

            color: var(--gold, #c9a227);

            pointer-events: none;
        }

        .role-input {
            width: 100%;
            height: 48px;

            padding: 0 44px 0 15px;

            border-radius: 11px;

            border: 1px solid var(--border, #dfe3ea);

            background: var(--input-bg, #f9fafb);

            color: var(--text, #111827);

            outline: none;

            font-size: 13px;

            transition: .2s;
        }

        .role-input::placeholder {
            color: var(--muted, #9ca3af);
        }

        .role-input:focus {
            border-color: var(--gold, #c9a227);

            box-shadow: 0 0 0 3px rgba(201, 162, 39, .10);
        }


        /* ABILITIES */

        .abilities-section {
            border: 1px solid var(--border, #e5e7eb);

            border-radius: 15px;

            overflow: hidden;

            background: var(--surface-2, rgba(0, 0, 0, .015));
        }

        .abilities-header {
            padding: 18px 20px;

            border-bottom: 1px solid var(--border, #e5e7eb);
        }

        .abilities-title {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .abilities-icon {
            width: 38px;
            height: 38px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 10px;

            background: rgba(201, 162, 39, .12);

            color: var(--gold, #c9a227);
        }

        .abilities-title h3 {
            margin: 0 0 3px;

            color: var(--text, #111827);

            font-size: 15px;
        }

        .abilities-title span {
            color: var(--muted, #6b7280);

            font-size: 12px;
        }


        /* TABLE */

        .abilities-table-wrapper {
            width: 100%;
            overflow-x: auto;
        }

        .abilities-table {
            width: 100%;
            min-width: 680px;

            border-collapse: collapse;

            color: var(--text, #111827);
        }

        .abilities-table thead {
            background: var(--table-head, #f5f6f8);
        }

        .abilities-table th {
            height: 62px;

            padding: 10px 16px;

            border-bottom: 1px solid var(--border, #e5e7eb);

            color: var(--muted, #6b7280);

            font-size: 12px;
            font-weight: 800;
        }

        .ability-name-head {
            width: 45%;
            text-align: right;
        }

        .permission-head {
            width: 18.33%;
            text-align: center;
        }

        .permission-title {
            display: flex;
            justify-content: center;
            align-items: center;

            gap: 6px;

            margin-bottom: 7px;

            font-size: 12px;
        }

        .permission-dot {
            width: 7px;
            height: 7px;

            border-radius: 50%;
        }

        .allow-head .permission-dot {
            background: #22c55e;
        }

        .deny-head .permission-dot {
            background: #ef4444;
        }

        .inherit-head .permission-dot {
            background: #94a3b8;
        }

        .btn-select-all {
            border: 0;

            background: transparent;

            color: var(--gold, #c9a227);

            cursor: pointer;

            font-size: 10px;
            font-weight: 700;
        }

        .btn-select-all:hover {
            text-decoration: underline;
        }


        /* ROW */

        .abilities-table tbody tr {
            background: var(--surface, #fff);

            transition: .2s;
        }

        .abilities-table tbody tr:nth-child(even) {
            background: var(--table-row-alt, rgba(0, 0, 0, .018));
        }

        .abilities-table tbody tr:hover {
            background: rgba(201, 162, 39, .055);
        }

        .abilities-table td {
            height: 64px;

            padding: 10px 16px;

            border-bottom: 1px solid var(--border, #e5e7eb);
        }


        /* ABILITY */

        .ability-content {
            display: flex;
            align-items: center;
            gap: 11px;
        }

        .ability-icon {
            width: 32px;
            height: 32px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 8px;

            background: rgba(201, 162, 39, .09);

            color: var(--gold, #c9a227);
        }

        .ability-content strong {
            display: block;

            color: var(--text, #111827);

            font-size: 13px;
        }

        .ability-content small {
            display: block;

            margin-top: 3px;

            color: var(--muted, #9ca3af);

            direction: ltr;
            text-align: right;

            font-size: 10px;
        }


        /* RADIO */

        .permission-cell {
            text-align: center;
        }

        .radio-option {
            display: inline-flex;

            cursor: pointer;
        }

        .radio-option input {
            position: absolute;

            opacity: 0;
        }

        .custom-radio {
            width: 21px;
            height: 21px;

            border-radius: 50%;

            border: 2px solid var(--radio-border, #d1d5db);

            background: var(--surface, #fff);

            position: relative;

            transition: .2s;
        }

        .radio-option input:checked+.custom-radio::after {
            content: "";

            position: absolute;

            width: 9px;
            height: 9px;

            left: 50%;
            top: 50%;

            transform: translate(-50%, -50%);

            border-radius: 50%;
        }

        .radio-option input:checked+.allow-radio {
            border-color: #22c55e;
        }

        .radio-option input:checked+.allow-radio::after {
            background: #22c55e;
        }

        .radio-option input:checked+.deny-radio {
            border-color: #ef4444;
        }

        .radio-option input:checked+.deny-radio::after {
            background: #ef4444;
        }

        .radio-option input:checked+.inherit-radio {
            border-color: #94a3b8;
        }

        .radio-option input:checked+.inherit-radio::after {
            background: #94a3b8;
        }


        /* ACTIONS */

        .role-form-actions {
            display: flex;

            gap: 10px;

            margin-top: 24px;
            padding-top: 20px;

            border-top: 1px solid var(--border, #e5e7eb);
        }

        .role-btn {
            height: 44px;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            gap: 8px;

            padding: 0 22px;

            border-radius: 10px;

            text-decoration: none;

            font-size: 13px;
            font-weight: 800;

            cursor: pointer;

            transition: .2s;
        }

        .role-btn-save {
            border: 1px solid #b88b20;

            background: linear-gradient(135deg,
                    #d6aa3b,
                    #b98922);

            color: white;

            box-shadow: 0 6px 16px rgba(184, 139, 32, .20);
        }

        .role-btn-save:hover {
            transform: translateY(-1px);
        }

        .role-btn-cancel {
            border: 1px solid var(--border, #e5e7eb);

            background: var(--surface, #fff);

            color: var(--text, #111827);
        }

        .role-btn-cancel:hover {
            border-color: #ef4444;
            color: #ef4444;
        }


        /* ERRORS */

        .role-error {
            display: flex;
            align-items: center;
            gap: 7px;

            margin-top: 7px;

            color: #ef4444;

            font-size: 12px;
        }


        /* DARK */

        [data-theme="dark"] .abilities-table thead,
        .dark .abilities-table thead {
            background: #111720;
        }

        [data-theme="dark"] .abilities-table tbody tr,
        .dark .abilities-table tbody tr {
            background: #181e27;
        }

        [data-theme="dark"] .abilities-table tbody tr:nth-child(even),
        .dark .abilities-table tbody tr:nth-child(even) {
            background: #151a22;
        }

        [data-theme="dark"] .role-input,
        .dark .role-input {
            background: #111720;
            border-color: #303846;
        }

        [data-theme="dark"] .custom-radio,
        .dark .custom-radio {
            background: #111720;
            border-color: #414b5b;
        }


        /* MOBILE */

        @media(max-width:768px) {

            .roles-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .btn-back {
                width: 100%;
                justify-content: center;
            }

            .role-form {
                padding: 16px;
            }

            .role-form-actions {
                flex-direction: column;
            }

            .role-btn {
                width: 100%;
            }

        }
    </style>

@endsection


@section('content')

    <div class="roles-page">

        <div class="roles-header">

            <div class="roles-header-info">

                <div class="header-accent"></div>

                <div>

                    <h1 class="header-title">
                        تعديل الدور:
                        <span>{{ $role->name }}</span>
                    </h1>

                    <div class="header-sub">
                        تحديث بيانات الدور وإدارة الصلاحيات الخاصة به
                    </div>

                </div>

            </div>


            <a href="{{ route('admin.roles') }}" class="btn-back">
                <i class="fas fa-arrow-right"></i>
                رجوع للأدوار
            </a>

        </div>


        @if ($errors->any())
            <div class="role-error"
                style="
                background:rgba(239,68,68,.08);
                border:1px solid rgba(239,68,68,.2);
                padding:12px 15px;
                border-radius:10px;
                margin-bottom:16px;
            ">
                <i class="fas fa-circle-exclamation"></i>

                <span>
                    يرجى التأكد من البيانات المدخلة قبل الحفظ.
                </span>
            </div>
        @endif


        <div class="role-card">

            <div class="role-card-top">

                <i class="fas fa-pen-to-square"></i>

                <span>
                    تعديل بيانات الدور: {{ $role->name }}
                </span>

            </div>


            <form action="{{ route('admin.roles.update', $role->id) }}" method="POST">

                @csrf
                @method('PUT')

                @include('Admin.Roles._form', ['role' => $role])

            </form>

        </div>

    </div>

@endsection
