@extends('Employee.layouts.app')

@section('title', 'الملف الشخصي | Elite Club')

@section('styles')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;800&display=swap" rel="stylesheet">
    <style>
        .profile-wrapper {
            --gold: #c9a961;
            --gold-soft: rgba(201, 169, 97, 0.12);
            --gold-line: rgba(201, 169, 97, 0.16);
            --surface: #1c1f27;
            --surface-2: #232733;
            --text: #f2f3f5;
            --muted: #8a8f9c;
            font-family: 'Tajawal', sans-serif;
            color: var(--text);
        }

        /* ===== هيدر الملف الشخصي ===== */
        .profile-header-card {
            background: linear-gradient(135deg, var(--surface), #15171c);
            border: 1px solid var(--gold-line);
            border-radius: 16px;
            padding: 26px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .profile-avatar {
            width: 72px;
            height: 72px;
            border-radius: 50%;
            background: var(--gold-soft);
            border: 1px solid var(--gold);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            font-weight: 800;
            color: var(--gold);
            flex-shrink: 0;
        }

        .profile-name {
            font-size: 20px;
            font-weight: 800;
            margin-bottom: 4px;
        }

        .profile-sub {
            font-size: 13px;
            color: var(--muted);
        }

        /* ===== شبكة الإحصائيات السريعة ===== */
        .quick-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 14px;
            margin-bottom: 24px;
        }

        .stat-card {
            background: var(--surface);
            border: 1px solid var(--gold-line);
            border-radius: 14px;
            padding: 18px;
            text-align: center;
        }

        .stat-value {
            font-size: 24px;
            font-weight: 800;
            color: var(--gold);
            margin-bottom: 4px;
        }

        .stat-label {
            font-size: 12px;
            color: var(--muted);
        }

        /* ===== ألواح الفورم ===== */
        .plan-panel {
            background: var(--surface);
            border: 1px solid var(--gold-line);
            border-radius: 16px;
            overflow: hidden;
            margin-bottom: 20px;
        }

        .panel-title-bar {
            padding: 16px 20px;
            border-bottom: 1px solid var(--gold-soft);
            background: rgba(255, 255, 255, 0.01);
        }

        .panel-title-bar h3 {
            margin: 0;
            font-size: 15px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .panel-title-bar i {
            color: var(--gold);
        }

        .panel-body {
            padding: 20px;
        }

        .field-group {
            margin-bottom: 16px;
        }

        .field-label {
            display: block;
            margin-bottom: 6px;
            font-size: 13px;
            color: var(--text);
            font-weight: 600;
        }

        .field-input {
            width: 100%;
            padding: 12px;
            background: var(--surface-2);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 8px;
            color: var(--text);
            font-family: 'Tajawal', sans-serif;
            outline: none;
            box-sizing: border-box;
        }

        .field-error {
            color: #f87171;
            font-size: 12px;
            margin-top: 6px;
        }

        .btn-submit {
            padding: 12px 24px;
            font-weight: 700;
            border-radius: 8px;
            color: #1c1f27;
            background: linear-gradient(135deg, #e7cd8e, var(--gold));
            border: none;
            cursor: pointer;
            font-family: 'Tajawal', sans-serif;
        }
    </style>
@endsection

@section('content')
    <div class="dashboard-wrapper profile-wrapper">
        <div style="margin-bottom: 15px;">
            <x-flash-message />
        </div>

        <h2 style="color: #fff; margin-bottom: 20px; font-weight: 800;">الملف الشخصي</h2>

        <!-- هيدر البروفايل -->
        <div class="profile-header-card">
            <div class="profile-avatar">{{ mb_strtoupper(mb_substr($employee->name, 0, 1)) }}</div>
            <div>
                <div class="profile-name">{{ $employee->name }}</div>
                <div class="profile-sub">{{ $employee->specialization ?? 'مدرب' }} — منضم منذ
                    {{ $employee->created_at->format('Y-m-d') }}</div>
            </div>
        </div>

        <!-- إحصائيات سريعة -->
        <div class="quick-stats">
            <div class="stat-card">
                <div class="stat-value">{{ $playersCount }}</div>
                <div class="stat-label"><i class="fas fa-users"></i> لاعبون تحت إشرافك</div>
            </div>
            <div class="stat-card">
                <div class="stat-value" style="color: #5a9c7a;">{{ $presentCount }}</div>
                <div class="stat-label"><i class="fas fa-circle-check"></i> أيام حضور هذا الشهر</div>
            </div>
            <div class="stat-card">
                <div class="stat-value" style="color: #eab308;">{{ $lateCount }}</div>
                <div class="stat-label"><i class="fas fa-clock"></i> أيام تأخير هذا الشهر</div>
            </div>
        </div>

        <!-- تعديل البيانات الأساسية -->
        <div class="plan-panel">
            <div class="panel-title-bar">
                <h3><i class="fas fa-user-pen"></i> تعديل البيانات الأساسية</h3>
            </div>
            <div class="panel-body">
                <form action="{{ route('employee.profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="field-group">
                        <label class="field-label">الاسم الكامل</label>
                        <input type="text" name="name" class="field-input" value="{{ old('name', $employee->name) }}">
                        @error('name')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="field-group">
                        <label class="field-label">البريد الإلكتروني</label>
                        <input type="email" name="email" class="field-input" dir="ltr"
                            value="{{ old('email', $employee->email) }}">
                        @error('email')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="field-group">
                        <label class="field-label">التخصص</label>
                        <input type="text" name="specialization" class="field-input"
                            value="{{ old('specialization', $employee->specialization) }}"
                            placeholder="مثال: كمال أجسام / لياقة بدنية">
                        @error('specialization')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn-submit">حفظ التعديلات</button>
                </form>
            </div>
        </div>

        <!-- تغيير كلمة المرور -->
        <div class="plan-panel">
            <div class="panel-title-bar">
                <h3><i class="fas fa-lock"></i> تغيير كلمة المرور</h3>
            </div>
            <div class="panel-body">
                <form action="{{ route('employee.profile.password') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="field-group">
                        <label class="field-label">كلمة المرور الحالية</label>
                        <input type="password" name="current_password" class="field-input" dir="ltr">
                        @error('current_password')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="field-group">
                        <label class="field-label">كلمة المرور الجديدة</label>
                        <input type="password" name="password" class="field-input" dir="ltr">
                        @error('password')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="field-group">
                        <label class="field-label">تأكيد كلمة المرور الجديدة</label>
                        <input type="password" name="password_confirmation" class="field-input" dir="ltr">
                    </div>

                    <button type="submit" class="btn-submit">تغيير كلمة المرور</button>
                </form>
            </div>
        </div>
    </div>
@endsection