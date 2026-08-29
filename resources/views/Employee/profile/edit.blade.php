@extends('Employee.layouts.app')

@section('title', 'الملف الشخصي | Elite Club')

@section('styles')

<style>
    /* =========================================================
       ELITE CLUB — EMPLOYEE PROFILE
       DESIGN ONLY
       ========================================================= */

    .profile-wrapper {
        width: 100%;
    }

    /* =========================================================
       PAGE TITLE
       ========================================================= */

    .profile-page-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        margin-bottom: 20px;
        padding: 4px 2px;
    }

    .profile-page-title {
        margin: 0;
        color: var(--text);
        font-size: 25px;
        font-weight: 850;
        line-height: 1.4;
        letter-spacing: -.5px;
    }

    .profile-page-subtitle {
        display: block;
        margin-top: 5px;
        color: var(--muted);
        font-size: 10px;
        font-weight: 500;
    }

    /* =========================================================
       PROFILE HERO
       ========================================================= */

    .profile-header-card {
        position: relative;
        min-height: 130px;
        display: flex;
        align-items: center;
        gap: 18px;
        padding: 22px;
        margin-bottom: 18px;
        overflow: hidden;
        background:
            linear-gradient(
                135deg,
                color-mix(in srgb, var(--gold) 5%, var(--surface)),
                var(--surface)
            );
        border: 1px solid var(--border);
        border-radius: 18px;
        box-shadow: var(--shadow-sm);
        transition:
            background .25s ease,
            border-color .25s ease,
            box-shadow .25s ease,
            transform .2s ease;
        opacity: 0;
        animation: profileFadeIn .5s cubic-bezier(.2, .7, .2, 1) both;
    }

    .profile-header-card::after {
        content: "";
        position: absolute;
        left: -40px;
        bottom: -55px;
        width: 145px;
        height: 145px;
        border-radius: 50%;
        background: color-mix(in srgb, var(--gold) 7%, transparent);
        pointer-events: none;
    }

    .profile-header-card:hover {
        border-color: color-mix(in srgb, var(--gold) 25%, var(--border));
        box-shadow: var(--shadow);
    }

    @keyframes profileFadeIn {
        from {
            opacity: 0;
            transform: translateY(12px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .profile-avatar {
        width: 72px;
        height: 72px;
        flex: 0 0 72px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 18px;
        color: #fff;
        background: linear-gradient(
            135deg,
            var(--gold-light),
            var(--gold-dark)
        );
        border: 1px solid color-mix(
            in srgb,
            var(--gold) 45%,
            var(--border)
        );
        box-shadow: 0 9px 22px rgba(184, 146, 62, .18);
        font-size: 27px;
        font-weight: 850;
        transition:
            transform .25s cubic-bezier(.34, 1.56, .64, 1),
            box-shadow .25s ease;
    }

    .profile-header-card:hover .profile-avatar {
        transform: scale(1.05) rotate(-3deg);
        box-shadow: 0 12px 27px rgba(184, 146, 62, .24);
    }

    .profile-name {
        color: var(--text);
        font-size: 20px;
        font-weight: 850;
        line-height: 1.5;
    }

    .profile-sub {
        margin-top: 5px;
        color: var(--muted);
        font-size: 10px;
        font-weight: 550;
        line-height: 1.8;
    }

    /* =========================================================
       QUICK STATS
       ========================================================= */

    .quick-stats {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 15px;
        margin-bottom: 20px;
    }

    .quick-stats .stat-card {
        position: relative;
        min-height: 112px;
        padding: 18px;
        overflow: hidden;
        text-align: right;
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 16px;
        box-shadow: var(--shadow-sm);
        transition:
            transform .2s ease,
            border-color .2s ease,
            box-shadow .2s ease,
            background .25s ease;
        opacity: 0;
        animation: profileFadeIn .5s cubic-bezier(.2, .7, .2, 1) both;
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
        left: -25px;
        bottom: -35px;
        width: 95px;
        height: 95px;
        border-radius: 50%;
        background: color-mix(
            in srgb,
            var(--gold) 6%,
            transparent
        );
        pointer-events: none;
    }

    .quick-stats .stat-card:hover {
        transform: translateY(-3px);
        border-color: color-mix(
            in srgb,
            var(--gold) 25%,
            var(--border)
        );
        box-shadow: var(--shadow);
    }

    .stat-value {
        color: var(--gold);
        font-size: 27px;
        font-weight: 850;
        line-height: 1;
        margin-bottom: 9px;
    }

    .stat-label {
        display: flex;
        align-items: center;
        gap: 7px;
        color: var(--muted);
        font-size: 9px;
        font-weight: 650;
    }

    .stat-label i {
        color: var(--gold);
        font-size: 10px;
    }

    /* =========================================================
       PANELS
       ========================================================= */

    .plan-panel {
        overflow: hidden;
        margin-bottom: 18px;
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 18px;
        box-shadow: var(--shadow-sm);
        transition:
            background .25s ease,
            border-color .25s ease,
            box-shadow .25s ease;
        opacity: 0;
        animation: profileFadeIn .5s cubic-bezier(.2, .7, .2, 1) both;
    }

    .quick-stats + .plan-panel {
        animation-delay: .21s;
    }

    .plan-panel + .plan-panel {
        animation-delay: .26s;
    }

    /* =========================================================
       PANEL HEADER
       ========================================================= */

    .panel-title-bar {
        min-height: 64px;
        display: flex;
        align-items: center;
        padding: 14px 19px;
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
        gap: 9px;
        color: var(--text);
        font-size: 13px;
        font-weight: 800;
    }

    .panel-title-bar i {
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 9px;
        color: var(--gold);
        background: color-mix(
            in srgb,
            var(--gold) 8%,
            var(--surface-2)
        );
        border: 1px solid var(--border-soft);
        font-size: 11px;
    }

    /* =========================================================
       PANEL BODY
       ========================================================= */

    .panel-body {
        padding: 20px;
        background: var(--surface);
        transition: background .25s ease;
    }

    /* =========================================================
       FORM
       ========================================================= */

    .field-group {
        margin-bottom: 17px;
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
        min-height: 45px;
        display: block;
        padding: 10px 13px;
        color: var(--text);
        background: var(--surface-2);
        border: 1px solid var(--border);
        border-radius: 11px;
        outline: none;
        font-family: inherit;
        font-size: 10px;
        font-weight: 550;
        transition:
            background .2s ease,
            border-color .2s ease,
            box-shadow .2s ease,
            color .2s ease;
    }

    .field-input:hover {
        border-color: color-mix(
            in srgb,
            var(--gold) 20%,
            var(--border)
        );
    }

    .field-input:focus {
        border-color: color-mix(
            in srgb,
            var(--gold) 55%,
            var(--border)
        );
        box-shadow:
            0 0 0 3px color-mix(
                in srgb,
                var(--gold) 9%,
                transparent
            );
        background: var(--surface-2);
    }

    .field-input::placeholder {
        color: var(--muted);
    }

    .field-error {
        display: flex;
        align-items: center;
        gap: 5px;
        margin-top: 6px;
        color: var(--danger);
        font-size: 9px;
        font-weight: 600;
    }

    /* =========================================================
       SUBMIT BUTTON
       ========================================================= */

    .btn-submit {
        min-height: 45px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 10px 22px;
        color: #171717;
        background: linear-gradient(
            135deg,
            var(--gold-light),
            var(--gold-dark)
        );
        border: 0;
        border-radius: 11px;
        box-shadow: 0 8px 20px rgba(184, 146, 62, .15);
        cursor: pointer;
        font-family: inherit;
        font-size: 10px;
        font-weight: 800;
        transition:
            transform .2s ease,
            box-shadow .2s ease,
            filter .2s ease;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 27px rgba(184, 146, 62, .22);
        filter: brightness(1.03);
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
            linear-gradient(
                135deg,
                color-mix(in srgb, var(--gold) 5%, var(--surface)),
                var(--surface)
            );
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

    /* =========================================================
       RESPONSIVE
       ========================================================= */

    @media (max-width: 900px) {

        .quick-stats {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }

        .profile-page-title {
            font-size: 22px;
        }

        .profile-header-card {
            padding: 19px;
        }

        .panel-body {
            padding: 17px;
        }
    }

    @media (max-width: 700px) {

        .profile-page-header {
            margin-bottom: 17px;
        }

        .profile-page-title {
            font-size: 21px;
        }

        .profile-page-subtitle {
            font-size: 9px;
        }

        .profile-header-card {
            align-items: center;
            gap: 14px;
            padding: 17px;
        }

        .profile-avatar {
            width: 60px;
            height: 60px;
            flex-basis: 60px;
            border-radius: 15px;
            font-size: 23px;
        }

        .profile-name {
            font-size: 17px;
        }

        .profile-sub {
            font-size: 9px;
        }

        .quick-stats {
            grid-template-columns: 1fr;
            gap: 10px;
        }

        .quick-stats .stat-card {
            min-height: 92px;
            padding: 15px;
        }

        .stat-value {
            font-size: 24px;
        }

        .panel-title-bar {
            min-height: 59px;
            padding: 13px 14px;
        }

        .panel-body {
            padding: 14px;
        }

        .field-input {
            min-height: 44px;
        }

        .btn-submit {
            width: 100%;
        }
    }

    @media (max-width: 480px) {

        .profile-header-card {
            align-items: flex-start;
        }

        .profile-avatar {
            width: 54px;
            height: 54px;
            flex-basis: 54px;
            font-size: 21px;
        }

        .profile-name {
            font-size: 15px;
        }

        .profile-sub {
            line-height: 1.7;
        }

        .panel-title-bar h3 {
            font-size: 11px;
        }
    }
</style>

@endsection

@section('content')

<div class="dashboard-wrapper profile-wrapper">

    <div style="margin-bottom: 15px;">
        <x-flash-message />
    </div>

   

    <!-- هيدر البروفايل -->

    <div class="profile-header-card">

        <div class="profile-avatar">
            {{ mb_strtoupper(mb_substr($employee->name, 0, 1)) }}
        </div>

        <div>

            <div class="profile-name">
                {{ $employee->name }}
            </div>

            <div class="profile-sub">
                {{ $employee->specialization ?? 'مدرب' }} — منضم منذ
                {{ $employee->created_at->format('Y-m-d') }}
            </div>

        </div>

    </div>

    <!-- إحصائيات سريعة -->

    <div class="quick-stats">

        <div class="stat-card">

            <div class="stat-value">
                {{ $playersCount }}
            </div>

            <div class="stat-label">
                <i class="fas fa-users"></i>
                لاعبون تحت إشرافك
            </div>

        </div>

        <div class="stat-card">

            <div class="stat-value" style="color: #5a9c7a;">
                {{ $presentCount }}
            </div>

            <div class="stat-label">
                <i class="fas fa-circle-check"></i>
                أيام حضور هذا الشهر
            </div>

        </div>

        <div class="stat-card">

            <div class="stat-value" style="color: #eab308;">
                {{ $lateCount }}
            </div>

            <div class="stat-label">
                <i class="fas fa-clock"></i>
                أيام تأخير هذا الشهر
            </div>

        </div>

    </div>

    <!-- تعديل البيانات الأساسية -->

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

                <div class="field-group">

                    <label class="field-label">
                        الاسم الكامل
                    </label>

                    <input
                        type="text"
                        name="name"
                        class="field-input"
                        value="{{ old('name', $employee->name) }}"
                    >

                    @error('name')

                        <div class="field-error">
                            {{ $message }}
                        </div>

                    @enderror

                </div>

                <div class="field-group">

                    <label class="field-label">
                        البريد الإلكتروني
                    </label>

                    <input
                        type="email"
                        name="email"
                        class="field-input"
                        dir="ltr"
                        value="{{ old('email', $employee->email) }}"
                    >

                    @error('email')

                        <div class="field-error">
                            {{ $message }}
                        </div>

                    @enderror

                </div>

                <div class="field-group">

                    <label class="field-label">
                        التخصص
                    </label>

                    <input
                        type="text"
                        name="specialization"
                        class="field-input"
                        value="{{ old('specialization', $employee->specialization) }}"
                        placeholder="مثال: كمال أجسام / لياقة بدنية"
                    >

                    @error('specialization')

                        <div class="field-error">
                            {{ $message }}
                        </div>

                    @enderror

                </div>

                <button type="submit" class="btn-submit">
                    حفظ التعديلات
                </button>

            </form>

        </div>

    </div>

    <!-- تغيير كلمة المرور -->

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

                <div class="field-group">

                    <label class="field-label">
                        كلمة المرور الحالية
                    </label>

                    <input
                        type="password"
                        name="current_password"
                        class="field-input"
                        dir="ltr"
                    >

                    @error('current_password')

                        <div class="field-error">
                            {{ $message }}
                        </div>

                    @enderror

                </div>

                <div class="field-group">

                    <label class="field-label">
                        كلمة المرور الجديدة
                    </label>

                    <input
                        type="password"
                        name="password"
                        class="field-input"
                        dir="ltr"
                    >

                    @error('password')

                        <div class="field-error">
                            {{ $message }}
                        </div>

                    @enderror

                </div>

                <div class="field-group">

                    <label class="field-label">
                        تأكيد كلمة المرور الجديدة
                    </label>

                    <input
                        type="password"
                        name="password_confirmation"
                        class="field-input"
                        dir="ltr"
                    >

                </div>

                <button type="submit" class="btn-submit">
                    تغيير كلمة المرور
                </button>

            </form>

        </div>

    </div>

</div>

@endsection
