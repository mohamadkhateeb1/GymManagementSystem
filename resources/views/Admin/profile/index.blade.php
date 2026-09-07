@extends('Admin.layouts.app')

@section('title', 'الملف الشخصي - Elite Club')

@section('page-title', 'الملف الشخصي')

@section('page-description', 'إدارة معلومات حسابك الشخصي وإعدادات الأمان')

@section('styles')

    <style>
        /* =====================================================
           PROFILE PAGE
        ====================================================== */

        .profile-page {
            width: 100%;
            max-width: 1180px;
            margin: 0 auto;
        }

        /* =====================================================
           PROFILE HEADER
        ====================================================== */

        .profile-header-card {
            position: relative;
            overflow: hidden;

            display: flex;
            align-items: center;
            justify-content: space-between;

            gap: 25px;

            padding: 28px 30px;

            margin-bottom: 22px;

            background: var(--surface);

            border: 1px solid var(--border);
            border-radius: 18px;

            box-shadow: var(--shadow-sm);

            transition:
                background .25s ease,
                border-color .25s ease,
                box-shadow .25s ease;
        }

        .profile-header-card::before {
            content: '';

            position: absolute;

            top: 0;
            right: 0;

            width: 100%;
            height: 3px;

            background:
                linear-gradient(90deg,
                    var(--gold-dark),
                    var(--gold-light),
                    var(--gold-dark));
        }

        .profile-header-card::after {
            content: '';

            position: absolute;

            width: 180px;
            height: 180px;

            left: -70px;
            bottom: -110px;

            border-radius: 50%;

            background: rgba(184, 148, 69, .06);

            pointer-events: none;
        }

        /* =====================================================
           IDENTITY
        ====================================================== */

        .profile-identity {
            display: flex;
            align-items: center;

            gap: 18px;

            min-width: 0;
        }

        .profile-main-avatar {
            width: 76px;
            height: 76px;

            flex-shrink: 0;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 50%;

            color: #fff;

            font-size: 27px;
            font-weight: 900;

            background:
                linear-gradient(135deg,
                    #dcc27d,
                    #ad8636);

            border: 4px solid var(--surface);

            box-shadow:
                0 6px 20px rgba(184, 146, 62, .20);
        }

        .profile-identity-text {
            min-width: 0;
        }

        .profile-identity-text h2 {
            margin: 0;

            color: var(--text);

            font-size: 23px;
            font-weight: 900;

            line-height: 1.3;
        }

        .profile-identity-text p {
            margin: 5px 0 0;

            color: var(--muted);

            font-size: 13px;
            font-weight: 500;
        }

        .profile-role-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;

            margin-top: 10px;

            padding: 6px 11px;

            border-radius: 8px;

            color: var(--gold-dark);

            background: var(--warning-bg);

            border: 1px solid rgba(184, 148, 69, .18);

            font-size: 11px;
            font-weight: 800;
        }

        html[data-theme="dark"] .profile-role-badge {
            color: var(--gold-light);
        }

        /* =====================================================
           ACCOUNT META
        ====================================================== */

        .profile-meta {
            position: relative;
            z-index: 2;

            display: flex;
            align-items: center;

            gap: 12px;
        }

        .profile-meta-item {
            min-width: 130px;

            padding: 12px 15px;

            background: var(--surface-2);

            border: 1px solid var(--border-soft);

            border-radius: 11px;

            text-align: center;
        }

        .profile-meta-item span {
            display: block;

            margin-bottom: 4px;

            color: var(--muted);

            font-size: 10px;
            font-weight: 600;
        }

        .profile-meta-item strong {
            color: var(--text);

            font-size: 12px;
            font-weight: 800;
        }

        /* =====================================================
           GRID
        ====================================================== */

        .profile-grid {
            display: grid;

            grid-template-columns:
                minmax(0, 1.15fr) minmax(0, .85fr);

            gap: 22px;

            align-items: start;
        }

        /* =====================================================
           CARDS
        ====================================================== */

        .profile-card {
            background: var(--surface);

            border: 1px solid var(--border);

            border-radius: 17px;

            box-shadow: var(--shadow-sm);

            overflow: hidden;

            transition:
                background .25s ease,
                border-color .25s ease,
                box-shadow .25s ease;
        }

        .profile-card-header {
            display: flex;
            align-items: center;

            gap: 12px;

            padding: 19px 22px;

            border-bottom: 1px solid var(--border-soft);
        }

        .profile-card-icon {
            width: 38px;
            height: 38px;

            flex-shrink: 0;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 10px;

            color: var(--gold-dark);

            background: var(--warning-bg);

            font-size: 14px;
        }

        html[data-theme="dark"] .profile-card-icon {
            color: var(--gold-light);
        }

        .profile-card-title {
            min-width: 0;
        }

        .profile-card-title h3 {
            margin: 0;

            color: var(--text);

            font-size: 15px;
            font-weight: 900;
        }

        .profile-card-title p {
            margin: 3px 0 0;

            color: var(--muted);

            font-size: 10.5px;
            font-weight: 500;
        }

        .profile-card-body {
            padding: 23px 22px;
        }

        /* =====================================================
           FORM
        ====================================================== */

        .profile-form-group {
            margin-bottom: 18px;
        }

        .profile-form-group:last-child {
            margin-bottom: 0;
        }

        .profile-label {
            display: block;

            margin-bottom: 7px;

            color: var(--text-soft);

            font-size: 11.5px;
            font-weight: 800;
        }

        .profile-input-wrapper {
            position: relative;
        }

        .profile-input-icon {
            position: absolute;

            top: 50%;
            right: 14px;

            transform: translateY(-50%);

            color: var(--muted);

            font-size: 12px;

            pointer-events: none;
        }

        .profile-input {
            width: 100%;

            min-height: 45px;

            padding:
                10px 40px 10px 13px;

            color: var(--text);

            background: var(--input-bg);

            border: 1px solid var(--input-border);

            border-radius: 10px;

            outline: none;

            font-size: 12px;
            font-weight: 500;

            transition:
                border-color .2s ease,
                box-shadow .2s ease,
                background .2s ease;
        }

        .profile-input:focus {
            border-color: var(--gold);

            box-shadow:
                0 0 0 3px rgba(184, 148, 69, .10);
        }

        .profile-input::placeholder {
            color: var(--muted-light);
        }

        .profile-input.is-invalid {
            border-color: var(--danger);
        }

        .profile-error {
            display: block;

            margin-top: 5px;

            color: var(--danger);

            font-size: 10px;
            font-weight: 600;
        }

        /* =====================================================
           BUTTON
        ====================================================== */

        .profile-submit {
            width: 100%;

            min-height: 45px;

            display: flex;
            align-items: center;
            justify-content: center;

            gap: 8px;

            margin-top: 20px;

            border: 0;

            border-radius: 10px;

            color: #fff;

            background:
                linear-gradient(135deg,
                    var(--gold-light),
                    var(--gold-dark));

            box-shadow:
                0 5px 15px rgba(184, 148, 69, .14);

            font-size: 12px;
            font-weight: 800;

            cursor: pointer;

            transition:
                transform .2s ease,
                box-shadow .2s ease;
        }

        .profile-submit:hover {
            transform: translateY(-1px);

            box-shadow:
                0 8px 20px rgba(184, 148, 69, .20);
        }

        /* =====================================================
           SECURITY INFO
        ====================================================== */

        .security-notice {
            display: flex;
            align-items: flex-start;

            gap: 10px;

            margin-bottom: 20px;

            padding: 12px 13px;

            border-radius: 10px;

            background: var(--info-bg);

            border: 1px solid var(--border-soft);
        }

        .security-notice i {
            margin-top: 2px;

            color: var(--info);

            font-size: 12px;
        }

        .security-notice p {
            margin: 0;

            color: var(--text-soft);

            font-size: 10px;
            font-weight: 500;

            line-height: 1.7;
        }

        /* =====================================================
           ROLES
        ====================================================== */

        .roles-section {
            margin-top: 22px;
        }

        .roles-title {
            display: flex;
            align-items: center;

            gap: 8px;

            margin-bottom: 12px;

            color: var(--text);

            font-size: 12px;
            font-weight: 900;
        }

        .roles-title i {
            color: var(--gold-dark);
            font-size: 11px;
        }

        html[data-theme="dark"] .roles-title i {
            color: var(--gold-light);
        }

        .roles-list {
            display: flex;
            flex-wrap: wrap;

            gap: 7px;
        }

        .role-item {
            display: inline-flex;
            align-items: center;

            padding: 7px 10px;

            border-radius: 8px;

            color: var(--text-soft);

            background: var(--surface-2);

            border: 1px solid var(--border);

            font-size: 10px;
            font-weight: 700;
        }

        .role-item i {
            margin-left: 5px;

            color: var(--gold);

            font-size: 8px;
        }

        .empty-roles {
            color: var(--muted);

            font-size: 10px;
        }

        /* =====================================================
           RESPONSIVE
        ====================================================== */

        @media (max-width: 950px) {

            .profile-header-card {
                align-items: flex-start;

                flex-direction: column;
            }

            .profile-meta {
                width: 100%;
            }

            .profile-meta-item {
                flex: 1;
            }

            .profile-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 600px) {

            .profile-header-card {
                padding: 22px 18px;
            }

            .profile-identity {
                gap: 13px;
            }

            .profile-main-avatar {
                width: 62px;
                height: 62px;

                font-size: 22px;
            }

            .profile-identity-text h2 {
                font-size: 18px;
            }

            .profile-meta {
                display: grid;

                grid-template-columns: 1fr 1fr;

                width: 100%;
            }

            .profile-meta-item {
                min-width: 0;
            }

            .profile-card-body {
                padding: 20px 17px;
            }

            .profile-card-header {
                padding: 17px;
            }
        }

        @media (max-width: 400px) {

            .profile-meta {
                grid-template-columns: 1fr;
            }
        }
    </style>

@endsection

@section('content')

    <div class="profile-page">

        <section class="profile-header-card">

            <div class="profile-identity">

                <div class="profile-main-avatar">
                    {{ strtoupper(mb_substr($admin->name ?? 'A', 0, 1)) }}
                </div>

                <div class="profile-identity-text">

                    <h2>
                        {{ $admin->name }}
                    </h2>

                    <p>
                        {{ $admin->email }}
                    </p>

                    <span class="profile-role-badge">
                        <i class="fas fa-shield-halved"></i>
                        مدير النظام
                    </span>

                </div>

            </div>


            <div class="profile-meta">

                <div class="profile-meta-item">

                    <span>
                        تاريخ إنشاء الحساب
                    </span>

                    <strong>
                        {{ $admin->created_at?->format('Y/m/d') ?? '-' }}
                    </strong>

                </div>


                <div class="profile-meta-item">

                    <span>
                        حالة الحساب
                    </span>

                    <strong>
                        نشط
                    </strong>

                </div>

            </div>

        </section>


        {{-- =====================================================
     PROFILE FORMS
====================================================== --}}

        <div class="profile-grid">

            {{-- =================================================
         PERSONAL INFORMATION
    ================================================== --}}

            <section class="profile-card">

                <div class="profile-card-header">

                    <div class="profile-card-icon">
                        <i class="fas fa-user"></i>
                    </div>

                    <div class="profile-card-title">

                        <h3>
                            المعلومات الشخصية
                        </h3>

                        <p>
                            تعديل اسمك والبريد الإلكتروني المرتبط بالحساب
                        </p>

                    </div>

                </div>


                <div class="profile-card-body">

                    <form action="{{ route('admin.profile.update') }}" method="POST">

                        @csrf
                        @method('PUT')


                        {{-- NAME --}}

                        <div class="profile-form-group">

                            <label class="profile-label">
                                الاسم الكامل
                            </label>

                            <div class="profile-input-wrapper">

                                <i class="fas fa-user profile-input-icon"></i>

                                <input type="text" name="name" value="{{ old('name', $admin->name) }}"
                                    class="profile-input @error('name') is-invalid @enderror" placeholder="أدخل اسمك الكامل"
                                    >

                            </div>

                            @error('name')
                                <span class="profile-error">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>


                        {{-- EMAIL --}}

                        <div class="profile-form-group">

                            <label class="profile-label">
                                البريد الإلكتروني
                            </label>

                            <div class="profile-input-wrapper">

                                <i class="fas fa-envelope profile-input-icon"></i>

                                <input type="email" name="email" value="{{ old('email', $admin->email) }}"
                                    class="profile-input @error('email') is-invalid @enderror"
                                    placeholder="example@email.com" >

                            </div>

                            @error('email')
                                <span class="profile-error">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>


                        <button type="submit" class="profile-submit">

                            <i class="fas fa-check"></i>

                            حفظ التغييرات

                        </button>

                    </form>

                </div>

            </section>


            {{-- =================================================
         SECURITY
    ================================================== --}}

            <section class="profile-card">

                <div class="profile-card-header">

                    <div class="profile-card-icon">
                        <i class="fas fa-lock"></i>
                    </div>

                    <div class="profile-card-title">

                        <h3>
                            أمان الحساب
                        </h3>

                        <p>
                            تغيير كلمة المرور الخاصة بحسابك
                        </p>

                    </div>

                </div>


                <div class="profile-card-body">

                    <div class="security-notice">

                        <i class="fas fa-circle-info"></i>

                        <p>
                            استخدم كلمة مرور قوية تحتوي على 8 محارف على الأقل،
                            ويفضل أن تجمع بين الأحرف والأرقام والرموز.
                        </p>

                    </div>


                    <form action="{{ route('admin.profile.password') }}" method="POST">

                        @csrf
                        @method('PUT')


                        {{-- CURRENT PASSWORD --}}

                        <div class="profile-form-group">

                            <label class="profile-label">
                                كلمة المرور الحالية
                            </label>

                            <div class="profile-input-wrapper">

                                <i class="fas fa-key profile-input-icon"></i>

                                <input type="password" name="current_password"
                                    class="profile-input @error('current_password') is-invalid @enderror"
                                    placeholder="••••••••" >

                            </div>

                            @error('current_password')
                                <span class="profile-error">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>


                        {{-- NEW PASSWORD --}}

                        <div class="profile-form-group">

                            <label class="profile-label">
                                كلمة المرور الجديدة
                            </label>

                            <div class="profile-input-wrapper">

                                <i class="fas fa-lock profile-input-icon"></i>

                                <input type="password" name="password"
                                    class="profile-input @error('password') is-invalid @enderror" placeholder="••••••••"
                                    >

                            </div>

                            @error('password')
                                <span class="profile-error">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>


                        {{-- CONFIRM PASSWORD --}}

                        <div class="profile-form-group">

                            <label class="profile-label">
                                تأكيد كلمة المرور الجديدة
                            </label>

                            <div class="profile-input-wrapper">

                                <i class="fas fa-lock profile-input-icon"></i>

                                <input type="password" name="password_confirmation" class="profile-input"
                                    placeholder="••••••••" >

                            </div>

                        </div>


                        <button type="submit" class="profile-submit">

                            <i class="fas fa-shield-halved"></i>

                            تحديث كلمة المرور

                        </button>

                    </form>


                    {{-- ROLES --}}

                    <div class="roles-section">

                        <div class="roles-title">

                            <i class="fas fa-user-shield"></i>

                            صلاحيات الحساب

                        </div>


                        <div class="roles-list">

                            @forelse($admin->roles as $role)
                                <span class="role-item">

                                    <i class="fas fa-circle"></i>

                                    {{ $role->name }}

                                </span>

                            @empty

                                <span class="empty-roles">
                                    لا توجد صلاحيات محددة
                                </span>
                            @endforelse

                        </div>

                    </div>

                </div>

            </section>

        </div>

    </div>

@endsection
