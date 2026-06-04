@extends('Admin.layouts.app')

@section('title', 'ملف الموظف | Elite Club')

@section('styles')
    <style>
        .profile-wrapper {
            max-width: 800px;
            margin: 40px auto;
        }

        /* الكارد الفاخر مع حواف ذهبية خفيفة */
        .luxury-card {
            background: rgba(16, 19, 28, 0.7);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(201, 169, 97, 0.3);
            border-radius: 20px;
            padding: 40px;
            position: relative;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5), inset 0 0 20px rgba(201, 169, 97, 0.05);
        }

        .luxury-card::before {
            content: "";
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            border-radius: 22px;
            background: linear-gradient(135deg, var(--accent), transparent 40%);
            z-index: -1;
            opacity: 0.3;
        }

        .avatar-placeholder {
            width: 80px;
            height: 80px;
            background: var(--accent);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            color: #000;
            margin-bottom: 20px;
        }

        .data-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
            margin-top: 30px;
        }

        .data-box {
            background: rgba(0, 0, 0, 0.2);
            padding: 15px;
            border-radius: 12px;
            border-right: 3px solid var(--accent);
        }

        .label {
            color: var(--accent);
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 5px;
        }

        .value {
            color: #fff;
            font-size: 16px;
            font-weight: 700;
        }
    </style>
@endsection

@section('content')
    <div class="profile-wrapper">
        <div class="luxury-card">
            <div class="avatar-placeholder"><i class="fas fa-user-tie"></i></div>

            <h1 style="color: #fff; margin-bottom: 5px;">{{ $employee->name }}</h1>
            <p style="color: var(--text-muted); margin-bottom: 30px;">{{ $employee->specialization }}</p>

            <div class="data-grid">
                <div class="data-box">
                    <div class="label">البريد الإلكتروني</div>
                    <div class="value">{{ $employee->email }}</div>
                </div>
                <div class="data-box">
                    <div class="label">المصادقة الثنائية (2FA)</div>
                    <div class="value">{{ $employee->two_factor_confirmed_at ? 'مُفعلة ✅' : 'غير مُفعلة ❌' }}</div>
                </div>
                <div class="data-box">
                    <div class="label">تاريخ الانضمام</div>
                    <div class="value">{{ $employee->created_at->format('Y-m-d') }}</div>
                </div>
                <div class="data-box">
                    <div class="label">آخر تحديث للبيانات</div>
                    <div class="value">{{ $employee->updated_at->diffForHumans() }}</div>
                </div>
            </div>

            <div style="margin-top: 40px; text-align: left;">
                <a href="{{ route('employees.edit', $employee->id) }}"
                    style="background: transparent; border: 1px solid var(--accent); color: var(--accent); padding: 10px 30px; border-radius: 8px; text-decoration: none; transition: 0.3s;">
                    تعديل الملف الشخصي
                </a>
            </div>
        </div>
    </div>
@endsection
