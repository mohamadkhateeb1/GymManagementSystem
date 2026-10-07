@extends('Employee.layouts.app')

@section('title', 'الملف الشخصي | Elite Club')

@section('styles')

    <style>
        /* =========================================================
           ELITE CLUB — EMPLOYEE PROFILE
           PREMIUM / RESPONSIVE / RTL
           ========================================================= */

        .profile-wrapper {
            width: 100%;
            max-width: 100%;
            margin: 0 auto;
        }

        /* =========================================================
           PAGE HEADER
           ========================================================= */

        .profile-page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            margin-bottom: 22px;
            padding: 4px 2px;
        }

        .profile-page-title {
            margin: 0;
            color: var(--text);
            font-size: 29px;
            font-weight: 900;
            line-height: 1.45;
            letter-spacing: -.6px;
        }

        .profile-page-subtitle {
            display: block;
            margin-top: 7px;
            color: var(--muted);
            font-size: 12px;
            font-weight: 600;
            line-height: 1.8;
        }

        /* =========================================================
           PROFILE HERO
           ========================================================= */

        .profile-header-card {
            position: relative;
            min-height: 145px;

            display: flex;
            align-items: center;
            gap: 22px;

            padding: 25px;

            margin-bottom: 20px;

            overflow: hidden;

            background:
                linear-gradient(135deg,
                    color-mix(in srgb, var(--gold) 7%, var(--surface)),
                    var(--surface));

            border: 1px solid var(--border);
            border-radius: 20px;

            box-shadow: var(--shadow-sm);

            transition:
                background .25s ease,
                border-color .25s ease,
                box-shadow .25s ease,
                transform .2s ease;

            opacity: 0;
            animation:
                profileFadeIn .5s cubic-bezier(.2, .7, .2, 1) both;
        }

        .profile-header-card::before {
            content: "";

            position: absolute;
            top: -75px;
            left: -55px;

            width: 190px;
            height: 190px;

            border-radius: 50%;

            background:
                radial-gradient(circle,
                    color-mix(in srgb, var(--gold) 10%, transparent),
                    transparent 68%);

            pointer-events: none;
        }

        .profile-header-card::after {
            content: "";

            position: absolute;
            right: -55px;
            bottom: -70px;

            width: 175px;
            height: 175px;

            border-radius: 50%;

            background:
                radial-gradient(circle,
                    color-mix(in srgb, var(--gold) 8%, transparent),
                    transparent 68%);

            pointer-events: none;
        }

        .profile-header-card:hover {
            border-color:
                color-mix(in srgb, var(--gold) 28%, var(--border));

            box-shadow: var(--shadow);
        }

        @keyframes profileFadeIn {

            from {
                opacity: 0;
                transform: translateY(14px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }

        }

        /* =========================================================
           AVATAR
           ========================================================= */

        .profile-avatar {
            position: relative;
            z-index: 2;

            width: 82px;
            height: 82px;

            flex: 0 0 82px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 21px;

            color: #fff;

            background:
                linear-gradient(135deg,
                    var(--gold-light),
                    var(--gold-dark));

            border:
                1px solid color-mix(in srgb,
                    var(--gold) 48%,
                    var(--border));

            box-shadow:
                0 11px 28px rgba(184, 146, 62, .22);

            font-size: 31px;
            font-weight: 900;

            transition:
                transform .25s cubic-bezier(.34, 1.56, .64, 1),
                box-shadow .25s ease;
        }

        .profile-header-card:hover .profile-avatar {
            transform: scale(1.045) rotate(-3deg);

            box-shadow:
                0 15px 34px rgba(184, 146, 62, .27);
        }

        /* =========================================================
           PROFILE INFORMATION
           ========================================================= */

        .profile-header-info {
            position: relative;
            z-index: 2;

            min-width: 0;
        }

        .profile-name {
            color: var(--text);

            font-size: 24px;
            font-weight: 900;

            line-height: 1.5;

            word-break: break-word;
        }

        .profile-sub {
            margin-top: 7px;

            color: var(--muted);

            font-size: 13px;
            font-weight: 600;

            line-height: 1.9;

            word-break: break-word;
        }

        /* =========================================================
           QUICK STATS
           ========================================================= */

        .quick-stats {
            display: grid;

            grid-template-columns:
                repeat(3, minmax(0, 1fr));

            gap: 17px;

            margin-bottom: 22px;
        }

        .quick-stats .stat-card {
            position: relative;

            min-height: 125px;

            display: flex;
            flex-direction: column;
            justify-content: center;

            padding: 21px;

            overflow: hidden;

            text-align: right;

            background: var(--surface);

            border: 1px solid var(--border);
            border-radius: 17px;

            box-shadow: var(--shadow-sm);

            transition:
                transform .22s ease,
                border-color .22s ease,
                box-shadow .22s ease,
                background .25s ease;

            opacity: 0;

            animation:
                profileFadeIn .5s cubic-bezier(.2, .7, .2, 1) both;
        }

        .quick-stats .stat-card:nth-child(1) {
            animation-delay: .06s;
        }

        .quick-stats .stat-card:nth-child(2) {
            animation-delay: .11s;
        }

        .quick-stats .stat-card:nth-child(3) {
            animation-delay: .16s;
        }

        .quick-stats .stat-card::after {
            content: "";

            position: absolute;

            left: -30px;
            bottom: -38px;

            width: 115px;
            height: 115px;

            border-radius: 50%;

            background:
                radial-gradient(circle,
                    color-mix(in srgb,
                        var(--gold) 8%,
                        transparent),
                    transparent 68%);

            pointer-events: none;
        }

        .quick-stats .stat-card:hover {
            transform: translateY(-4px);

            border-color:
                color-mix(in srgb,
                    var(--gold) 28%,
                    var(--border));

            box-shadow: var(--shadow);
        }

        /* =========================================================
           STAT VALUE
           ========================================================= */

        .stat-value {
            position: relative;
            z-index: 2;

            color: var(--gold);

            font-size: 32px;
            font-weight: 900;

            line-height: 1;

            margin-bottom: 11px;
        }

        .stat-card:nth-child(2) .stat-value {
            color: #5a9c7a !important;
        }

        .stat-card:nth-child(3) .stat-value {
            color: #eab308 !important;
        }

        .stat-label {
            position: relative;
            z-index: 2;

            display: flex;
            align-items: center;

            gap: 8px;

            color: var(--text-soft);

            font-size: 12px;
            font-weight: 700;

            line-height: 1.7;
        }

        .stat-label i {
            color: var(--gold);
            font-size: 13px;
            flex: 0 0 auto;
        }

        /* =========================================================
           PANELS
           ========================================================= */

        .plan-panel {
            overflow: hidden;

            margin-bottom: 20px;

            background: var(--surface);

            border: 1px solid var(--border);
            border-radius: 20px;

            box-shadow: var(--shadow-sm);

            transition:
                background .25s ease,
                border-color .25s ease,
                box-shadow .25s ease;

            opacity: 0;

            animation:
                profileFadeIn .5s cubic-bezier(.2, .7, .2, 1) both;
        }

        .quick-stats+.plan-panel {
            animation-delay: .21s;
        }

        .plan-panel+.plan-panel {
            animation-delay: .27s;
        }

        /* =========================================================
           PANEL HEADER
           ========================================================= */

        .panel-title-bar {
            min-height: 69px;

            display: flex;
            align-items: center;

            padding: 15px 21px;

            background: var(--surface);

            border-bottom: 1px solid var(--border);

            transition:
                background .25s ease,
                border-color .25s ease;
        }

        .panel-title-bar h3 {
            margin: 0;

            display: flex;
            align-items: center;

            gap: 11px;

            color: var(--text);

            font-size: 16px;
            font-weight: 850;

            line-height: 1.5;
        }

        .panel-title-bar i {
            width: 35px;
            height: 35px;

            display: flex;
            align-items: center;
            justify-content: center;

            flex: 0 0 35px;

            border-radius: 10px;

            color: var(--gold);

            background:
                color-mix(in srgb,
                    var(--gold) 9%,
                    var(--surface-2));

            border: 1px solid var(--border-soft);

            font-size: 13px;
        }

        /* =========================================================
           PANEL BODY
           ========================================================= */

        .panel-body {
            padding: 23px;

            background: var(--surface);

            transition:
                background .25s ease;
        }

        /* =========================================================
           FORM
           ========================================================= */

        .field-group {
            margin-bottom: 20px;
        }

        .field-label {
            display: block;

            margin-bottom: 8px;

            color: var(--text);

            font-size: 13px;
            font-weight: 800;

            line-height: 1.6;
        }

        .field-input {
            width: 100%;
            min-height: 50px;

            display: block;

            padding: 11px 15px;

            color: var(--text);

            background: var(--surface-2);

            border: 1px solid var(--border);

            border-radius: 12px;

            outline: none;

            font-family: inherit;

            font-size: 14px;
            font-weight: 600;

            line-height: 1.7;

            transition:
                background .2s ease,
                border-color .2s ease,
                box-shadow .2s ease,
                color .2s ease;
        }

        .field-input:hover {
            border-color:
                color-mix(in srgb,
                    var(--gold) 24%,
                    var(--border));
        }

        .field-input:focus {
            border-color:
                color-mix(in srgb,
                    var(--gold) 58%,
                    var(--border));

            box-shadow:
                0 0 0 4px color-mix(in srgb,
                    var(--gold) 9%,
                    transparent);

            background: var(--surface);
        }

        .field-input::placeholder {
            color: var(--muted);
            font-weight: 500;
        }

        /* =========================================================
           ERROR
           ========================================================= */

        .field-error {
            display: flex;
            align-items: flex-start;

            gap: 6px;

            margin-top: 7px;

            color: var(--danger);

            font-size: 11px;
            font-weight: 650;

            line-height: 1.7;
        }

        .field-error::before {
            content: "\f071";

            flex: 0 0 auto;

            margin-top: 2px;

            font-family: "Font Awesome 5 Free";
            font-weight: 900;

            font-size: 10px;
        }

        /* =========================================================
           SUBMIT BUTTON
           ========================================================= */

        .btn-submit {
            min-height: 50px;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            gap: 8px;

            padding: 11px 25px;

            color: #171717;

            background:
                linear-gradient(135deg,
                    var(--gold-light),
                    var(--gold-dark));

            border: 0;
            border-radius: 12px;

            box-shadow:
                0 8px 22px rgba(184, 146, 62, .17);

            cursor: pointer;

            font-family: inherit;

            font-size: 13px;
            font-weight: 850;

            transition:
                transform .2s ease,
                box-shadow .2s ease,
                filter .2s ease;
        }

        .btn-submit::before {
            content: "\f0c7";

            font-family: "Font Awesome 5 Free";
            font-weight: 900;

            font-size: 12px;
        }

        .btn-submit:hover {
            transform: translateY(-2px);

            box-shadow:
                0 13px 30px rgba(184, 146, 62, .24);

            filter: brightness(1.04);
        }

        .btn-submit:active {
            transform: translateY(0) scale(.98);
        }

        /* =========================================================
           DARK THEME
           ========================================================= */

        html[data-theme="dark"] .profile-header-card,
        body.dark .profile-header-card,
        body[data-theme="dark"] .profile-header-card {
            background:
                linear-gradient(135deg,
                    color-mix(in srgb,
                        var(--gold) 6%,
                        var(--surface)),
                    var(--surface));

            border-color: var(--border);
        }

        html[data-theme="dark"] .plan-panel,
        body.dark .plan-panel,
        body[data-theme="dark"] .plan-panel {
            background: var(--surface);
            border-color: var(--border);
        }

        html[data-theme="dark"] .panel-title-bar,
        body.dark .panel-title-bar,
        body[data-theme="dark"] .panel-title-bar {
            background: var(--surface);
            border-color: var(--border);
        }

        html[data-theme="dark"] .panel-body,
        body.dark .panel-body,
        body[data-theme="dark"] .panel-body {
            background: var(--surface);
        }

        html[data-theme="dark"] .field-input,
        body.dark .field-input,
        body[data-theme="dark"] .field-input {
            background: var(--surface-2);
            color: var(--text);
        }

        html[data-theme="dark"] .field-input:focus,
        body.dark .field-input:focus,
        body[data-theme="dark"] .field-input:focus {
            background: var(--surface-2);
        }

        /* =========================================================
           RESPONSIVE — TABLET
           ========================================================= */

        @media (max-width: 1000px) {

            .profile-page-title {
                font-size: 26px;
            }

            .profile-header-card {
                padding: 22px;
            }

            .profile-name {
                font-size: 21px;
            }

            .quick-stats {
                gap: 13px;
            }

            .quick-stats .stat-card {
                min-height: 115px;
                padding: 18px;
            }

            .stat-value {
                font-size: 29px;
            }

            .stat-label {
                font-size: 11px;
            }

            .panel-body {
                padding: 20px;
            }
        }

        /* =========================================================
           RESPONSIVE — MOBILE
           ========================================================= */

        @media (max-width: 700px) {

            .profile-page-header {
                margin-bottom: 18px;
                padding: 2px 0;
            }

            .profile-page-title {
                font-size: 23px;
                line-height: 1.45;
            }

            .profile-page-subtitle {
                margin-top: 6px;
                font-size: 10.5px;
                line-height: 1.8;
            }

            /* PROFILE HEADER */

            .profile-header-card {
                min-height: auto;

                align-items: center;

                gap: 15px;

                padding: 18px;

                margin-bottom: 16px;

                border-radius: 17px;
            }

            .profile-avatar {
                width: 65px;
                height: 65px;

                flex: 0 0 65px;

                border-radius: 17px;

                font-size: 25px;
            }

            .profile-name {
                font-size: 18px;
                line-height: 1.5;
            }

            .profile-sub {
                margin-top: 5px;

                font-size: 10.5px;

                line-height: 1.8;
            }

            /* STATS */

            .quick-stats {
                grid-template-columns: 1fr;

                gap: 10px;

                margin-bottom: 17px;
            }

            .quick-stats .stat-card {
                min-height: 88px;

                padding: 15px 17px;

                border-radius: 14px;
            }

            .stat-value {
                font-size: 27px;
                margin-bottom: 8px;
            }

            .stat-label {
                font-size: 11.5px;
            }

            .stat-label i {
                font-size: 12px;
            }

            /* PANELS */

            .plan-panel {
                margin-bottom: 15px;
                border-radius: 16px;
            }

            .panel-title-bar {
                min-height: 61px;
                padding: 13px 15px;
            }

            .panel-title-bar h3 {
                gap: 9px;
                font-size: 14px;
            }

            .panel-title-bar i {
                width: 31px;
                height: 31px;

                flex-basis: 31px;

                border-radius: 9px;

                font-size: 11px;
            }

            .panel-body {
                padding: 16px;
            }

            /* FORM */

            .field-group {
                margin-bottom: 17px;
            }

            .field-label {
                margin-bottom: 7px;
                font-size: 12px;
            }

            .field-input {
                min-height: 48px;

                padding: 10px 13px;

                border-radius: 11px;

                font-size: 13px;
            }

            .field-error {
                font-size: 10px;
            }

            .btn-submit {
                width: 100%;
                min-height: 49px;

                padding: 11px 15px;

                border-radius: 11px;

                font-size: 12px;
            }
        }

        /* =========================================================
           RESPONSIVE — SMALL MOBILE
           ========================================================= */

        @media (max-width: 480px) {

            .profile-page-title {
                font-size: 21px;
            }

            .profile-page-subtitle {
                font-size: 10px;
            }

            .profile-header-card {
                align-items: flex-start;
                gap: 13px;
                padding: 16px;
            }

            .profile-avatar {
                width: 57px;
                height: 57px;

                flex-basis: 57px;

                border-radius: 15px;

                font-size: 22px;
            }

            .profile-name {
                font-size: 16px;
            }

            .profile-sub {
                font-size: 10px;
                line-height: 1.75;
            }

            .quick-stats .stat-card {
                min-height: 84px;
                padding: 14px 15px;
            }

            .stat-value {
                font-size: 25px;
            }

            .stat-label {
                font-size: 10.5px;
            }

            .panel-title-bar {
                min-height: 57px;
                padding: 12px 13px;
            }

            .panel-title-bar h3 {
                font-size: 13px;
            }

            .panel-title-bar i {
                width: 29px;
                height: 29px;
                flex-basis: 29px;
            }

            .panel-body {
                padding: 14px;
            }

            .field-label {
                font-size: 11.5px;
            }

            .field-input {
                min-height: 47px;
                font-size: 12.5px;
            }

            .btn-submit {
                font-size: 11.5px;
            }
        }

        /* =========================================================
           VERY SMALL SCREENS
           ========================================================= */

        @media (max-width: 360px) {

            .profile-page-title {
                font-size: 19px;
            }

            .profile-header-card {
                gap: 11px;
                padding: 14px;
            }

            .profile-avatar {
                width: 52px;
                height: 52px;
                flex-basis: 52px;
                font-size: 20px;
            }

            .profile-name {
                font-size: 15px;
            }

            .profile-sub {
                font-size: 9.5px;
            }

            .panel-title-bar h3 {
                font-size: 12px;
            }

            .panel-body {
                padding: 12px;
            }
        }

        /* =========================================================
           ACCESSIBILITY
           ========================================================= */

        @media (prefers-reduced-motion: reduce) {

            .profile-header-card,
            .quick-stats .stat-card,
            .plan-panel {
                animation: none;
                opacity: 1;
            }

            .profile-header-card,
            .quick-stats .stat-card,
            .profile-avatar,
            .btn-submit {
                transition: none;
            }
        }
    </style>

@endsection


@section('content')

    <div class="dashboard-wrapper profile-wrapper">

        {{-- رسائل النظام --}}
        <div style="margin-bottom: 18px;">
            <x-flash-message />
        </div>


        {{-- =====================================================
         PROFILE HEADER
         ===================================================== --}}

        <div class="profile-header-card">

            <div class="profile-avatar">
                {{ mb_strtoupper(mb_substr($employee->name, 0, 1)) }}
            </div>

            <div class="profile-header-info">

                <div class="profile-name">
                    {{ $employee->name }}
                </div>

                <div class="profile-sub">
                    {{ $employee->specialization ?? 'مدرب' }}

                    — منضم منذ

                    {{ $employee->created_at->format('Y-m-d') }}
                </div>

            </div>

        </div>


        {{-- =====================================================
         QUICK STATS
         ===================================================== --}}

        <div class="quick-stats">

            {{-- Players --}}
            <div class="stat-card">

                <div class="stat-value">
                    {{ $playersCount }}
                </div>

                <div class="stat-label">

                    <i class="fas fa-users"></i>

                    <span>
                        لاعبون تحت إشرافك
                    </span>

                </div>

            </div>


            {{-- Attendance --}}
            <div class="stat-card">

                <div class="stat-value">
                    {{ $presentCount }}
                </div>

                <div class="stat-label">

                    <i class="fas fa-circle-check"></i>

                    <span>
                        أيام حضور هذا الشهر
                    </span>

                </div>

            </div>


            {{-- Late --}}
            <div class="stat-card">

                <div class="stat-value">
                    {{ $lateCount }}
                </div>

                <div class="stat-label">

                    <i class="fas fa-clock"></i>

                    <span>
                        أيام تأخير هذا الشهر
                    </span>

                </div>

            </div>

        </div>


        {{-- =====================================================
         BASIC INFORMATION
         ===================================================== --}}

        <div class="plan-panel">

            <div class="panel-title-bar">

                <h3>

                    <i class="fas fa-user-pen"></i>

                    تعديل البيانات الأساسية

                </h3>

            </div>


            <div class="panel-body">

                <form action="{{ route('employee.profile.update') }}" method="POST">

                    @csrf

                    @method('PUT')


                    {{-- الاسم --}}
                    <div class="field-group">

                        <label class="field-label">

                            الاسم الكامل

                        </label>

                        <input type="text" name="name" class="field-input" value="{{ old('name', $employee->name) }}"
                            autocomplete="name">

                        @error('name')
                            <div class="field-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- البريد --}}
                    <div class="field-group">

                        <label class="field-label">

                            البريد الإلكتروني

                        </label>

                        <input type="email" name="email" class="field-input" dir="ltr"
                            value="{{ old('email', $employee->email) }}" autocomplete="email">

                        @error('email')
                            <div class="field-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- التخصص --}}
                    <div class="field-group">

                        <label class="field-label">

                            التخصص

                        </label>

                        <input type="text" name="specialization" class="field-input"
                            value="{{ old('specialization', $employee->specialization) }}"
                            placeholder="مثال: كمال أجسام / لياقة بدنية" autocomplete="off">

                        @error('specialization')
                            <div class="field-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- حفظ --}}
                    <button type="submit" class="btn-submit">
                        حفظ التعديلات
                    </button>

                </form>

            </div>

        </div>


        {{-- =====================================================
         CHANGE PASSWORD
         ===================================================== --}}

        <div class="plan-panel">

            <div class="panel-title-bar">

                <h3>

                    <i class="fas fa-lock"></i>

                    تغيير كلمة المرور

                </h3>

            </div>


            <div class="panel-body">

                <form action="{{ route('employee.profile.password') }}" method="POST">

                    @csrf

                    @method('PUT')


                    {{-- Current Password --}}
                    <div class="field-group">

                        <label class="field-label">

                            كلمة المرور الحالية

                        </label>

                        <input type="password" name="current_password" class="field-input" dir="ltr"
                            autocomplete="current-password">

                        @error('current_password')
                            <div class="field-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- New Password --}}
                    <div class="field-group">

                        <label class="field-label">

                            كلمة المرور الجديدة

                        </label>

                        <input type="password" name="password" class="field-input" dir="ltr"
                            autocomplete="new-password">

                        @error('password')
                            <div class="field-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- Confirm Password --}}
                    <div class="field-group">

                        <label class="field-label">

                            تأكيد كلمة المرور الجديدة

                        </label>

                        <input type="password" name="password_confirmation" class="field-input" dir="ltr"
                            autocomplete="new-password">

                    </div>


                    {{-- Change Password --}}
                    <button type="submit" class="btn-submit">
                        تغيير كلمة المرور
                    </button>

                </form>

            </div>

        </div>

    </div>

@endsection
