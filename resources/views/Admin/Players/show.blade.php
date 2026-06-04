@extends('Admin.layouts.app')

@section('title', 'ملف اللاعب | Elite Club')

@section('styles')
    <style>
        .profile-wrapper {
            max-width: 920px;
            margin: 32px auto;
            position: relative;
        }

        /* أجواء ذهبية خلف البطاقة */
        .profile-wrapper::before,
        .profile-wrapper::after {
            content: '';
            position: absolute;
            border-radius: 50%;
            filter: blur(90px);
            z-index: 0;
            pointer-events: none;
        }

        .profile-wrapper::before {
            width: 340px;
            height: 340px;
            top: -80px;
            right: -60px;
            background: rgba(201, 169, 97, 0.16);
        }

        .profile-wrapper::after {
            width: 300px;
            height: 300px;
            bottom: -90px;
            left: -70px;
            background: rgba(108, 99, 255, 0.12);
        }

        /* ===== البطاقة الرئيسية (الهيرو) ===== */
        .hero-card {
            position: relative;
            z-index: 1;
            background:
                radial-gradient(120% 140% at 100% 0%, rgba(201, 169, 97, 0.10), transparent 55%),
                rgba(16, 19, 28, 0.78);
            backdrop-filter: blur(22px);
            border: 1px solid rgba(201, 169, 97, 0.28);
            border-radius: 24px;
            padding: 40px;
            overflow: hidden;
            box-shadow:
                0 30px 70px rgba(0, 0, 0, 0.55),
                inset 0 1px 0 rgba(255, 255, 255, 0.05);
            animation: fadeUp 0.6s ease both;
        }

        .hero-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(201, 169, 97, 0.7), transparent);
        }

        /* رأس الملف */
        .hero-head {
            display: flex;
            align-items: center;
            gap: 24px;
            flex-wrap: wrap;
        }

        .hero-avatar {
            position: relative;
            width: 96px;
            height: 96px;
            border-radius: 26px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
            font-weight: 800;
            color: #1a1305;
            background: linear-gradient(135deg, #f0d896, var(--accent) 55%, #8a6d2f);
            box-shadow: 0 12px 34px rgba(201, 169, 97, 0.45);
        }

        .hero-avatar::after {
            content: '';
            position: absolute;
            inset: -4px;
            border-radius: 30px;
            border: 1px solid rgba(201, 169, 97, 0.35);
        }

        .hero-info {
            flex: 1;
            min-width: 220px;
        }

        .hero-name {
            font-size: 30px;
            font-weight: 800;
            color: #fff;
            line-height: 1.15;
            margin-bottom: 10px;
        }

        .hero-chips {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .chip {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 13px;
            border-radius: 30px;
            font-size: 12px;
            font-weight: 700;
        }

        .chip-gold {
            color: var(--accent);
            background: rgba(201, 169, 97, 0.12);
            border: 1px solid rgba(201, 169, 97, 0.3);
        }

        .chip-muted {
            color: #cfcbc2;
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        /* ===== الإحصائيات البدنية الكبيرة ===== */
        .stat-row {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
            margin-top: 32px;
        }

        .stat-big {
            position: relative;
            text-align: center;
            padding: 22px 14px;
            border-radius: 16px;
            background: rgba(0, 0, 0, 0.25);
            border: 1px solid rgba(201, 169, 97, 0.15);
            overflow: hidden;
            transition: transform 0.3s ease, border-color 0.3s ease;
        }

        .stat-big:hover {
            transform: translateY(-4px);
            border-color: rgba(201, 169, 97, 0.4);
        }

        .stat-big i {
            font-size: 16px;
            color: var(--accent);
            opacity: 0.85;
        }

        .stat-big .num {
            font-size: 30px;
            font-weight: 800;
            color: #fff;
            line-height: 1.1;
            margin: 8px 0 2px;
            font-variant-numeric: tabular-nums;
        }

        .stat-big .num small {
            font-size: 13px;
            font-weight: 600;
            color: var(--accent);
        }

        .stat-big .cap {
            font-size: 11px;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: var(--text-muted, #8b8b8b);
        }

        /* ===== تفاصيل الاتصال ===== */
        .data-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            margin-top: 16px;
        }

        .data-box {
            display: flex;
            align-items: center;
            gap: 14px;
            background: rgba(0, 0, 0, 0.22);
            padding: 16px 18px;
            border-radius: 14px;
            border: 1px solid rgba(255, 255, 255, 0.04);
            border-right: 3px solid var(--accent);
            transition: background 0.3s ease, transform 0.3s ease;
        }

        .data-box:hover {
            background: rgba(201, 169, 97, 0.06);
            transform: translateX(-3px);
        }

        .data-icon {
            width: 40px;
            height: 40px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 11px;
            font-size: 14px;
            color: var(--accent);
            background: rgba(201, 169, 97, 0.1);
            border: 1px solid rgba(201, 169, 97, 0.22);
        }

        .data-text {
            min-width: 0;
        }

        .data-text .label {
            color: var(--accent);
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 3px;
            font-weight: 700;
        }

        .data-text .value {
            color: #fff;
            font-size: 15px;
            font-weight: 700;
            word-break: break-word;
        }

        .data-text .value[dir="ltr"] {
            text-align: right;
        }

        /* عنوان قسم صغير */
        .block-title {
            display: flex;
            align-items: center;
            gap: 9px;
            margin: 34px 0 14px;
            color: #fff;
            font-size: 14px;
            font-weight: 800;
        }

        .block-title::after {
            content: '';
            flex: 1;
            height: 1px;
            background: linear-gradient(90deg, rgba(201, 169, 97, 0.3), transparent);
        }

        .block-title i {
            color: var(--accent);
            font-size: 13px;
        }

        /* ===== الأزرار ===== */
        .profile-actions {
            display: flex;
            gap: 14px;
            margin-top: 34px;
            padding-top: 26px;
            border-top: 1px solid rgba(201, 169, 97, 0.15);
            flex-wrap: wrap;
        }

        .btn-edit-lg {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            background: linear-gradient(135deg, var(--accent), #d9bd7c);
            color: #1a1305;
            padding: 12px 30px;
            border-radius: 11px;
            text-decoration: none;
            font-weight: 800;
            font-size: 14px;
            box-shadow: 0 6px 18px rgba(201, 169, 97, 0.3);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .btn-edit-lg:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 26px rgba(201, 169, 97, 0.45);
        }

        .btn-back-lg {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--text-muted, #8b8b8b);
            border: 1px solid rgba(201, 169, 97, 0.2);
            padding: 12px 24px;
            border-radius: 11px;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .btn-back-lg:hover {
            color: var(--accent);
            border-color: rgba(201, 169, 97, 0.45);
            transform: translateX(3px);
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(14px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 640px) {
            .hero-card {
                padding: 26px;
            }

            .stat-row {
                grid-template-columns: 1fr;
            }

            .data-grid {
                grid-template-columns: 1fr;
            }

            .hero-head {
                justify-content: center;
                text-align: center;
            }

            .hero-chips {
                justify-content: center;
            }
        }
    </style>
@endsection

@section('content')
    @php
        $age = $player->date_of_birth ? \Carbon\Carbon::parse($player->date_of_birth)->age : null;
    @endphp

    <div class="profile-wrapper">
        <div class="hero-card">

            {{-- رأس الملف --}}
            <div class="hero-head">
                <div class="hero-avatar">{{ mb_strtoupper(mb_substr($player->name, 0, 1)) }}</div>
                <div class="hero-info">
                    <div class="hero-name">{{ $player->name }}</div>
                    <div class="hero-chips">
                        <span class="chip chip-gold"><i class="fas fa-crown"></i> عضو في Elite Club</span>
                        @if ($age !== null)
                            <span class="chip chip-muted"><i class="fas fa-cake-candles"></i> {{ $age }} سنة</span>
                        @endif
                        @if (!empty($player->phone))
                            <span class="chip chip-muted" dir="ltr"><i class="fas fa-phone"></i>
                                {{ $player->phone }}</span>
                        @endif
                    </div>
                </div>
            </div>

            {{-- الإحصائيات البدنية --}}
            <div class="block-title"><i class="fas fa-ruler-combined"></i> القياسات البدنية</div>
            <div class="stat-row">
                <div class="stat-big">
                    <i class="fas fa-up-down"></i>
                    <div class="num">{{ $player->height ?? '—' }} <small>{{ $player->height ? 'سم' : '' }}</small></div>
                    <div class="cap">الطول</div>
                </div>
                <div class="stat-big">
                    <i class="fas fa-weight-scale"></i>
                    <div class="num">{{ $player->weight ?? '—' }} <small>{{ $player->weight ? 'كجم' : '' }}</small></div>
                    <div class="cap">الوزن</div>
                </div>
            </div>

            {{-- بيانات الاتصال --}}
            <div class="block-title"><i class="fas fa-address-card"></i> بيانات الحساب</div>
            <div class="data-grid">
                <div class="data-box">
                    <div class="data-icon"><i class="fas fa-envelope"></i></div>
                    <div class="data-text">
                        <div class="label">البريد الإلكتروني</div>
                        <div class="value" dir="ltr">{{ $player->email }}</div>
                    </div>
                </div>
                <div class="data-box">
                    <div class="data-icon"><i class="fas fa-phone"></i></div>
                    <div class="data-text">
                        <div class="label">رقم الهاتف</div>
                        <div class="value" dir="ltr">{{ $player->phone ?? 'غير محدد' }}</div>
                    </div>
                </div>
                <div class="data-box">
                    <div class="data-icon"><i class="fas fa-calendar-days"></i></div>
                    <div class="data-text">
                        <div class="label">تاريخ الميلاد</div>
                        <div class="value">{{ $player->date_of_birth ?? 'غير محدد' }}</div>
                    </div>
                </div>
                <div class="data-box">
                    <div class="data-icon"><i class="fas fa-hashtag"></i></div>
                    <div class="data-text">
                        <div class="label">رقم اللاعب</div>
                        <div class="value">#{{ $player->id }}</div>
                    </div>
                </div>
            </div>

            {{-- الأزرار --}}
            <div class="profile-actions">
                <a href="{{ route('players.edit', $player->id) }}" class="btn-edit-lg">
                    <i class="fas fa-pen-to-square"></i> تعديل البيانات
                </a>
                <a href="{{ route('players.index') }}" class="btn-back-lg">
                    <i class="fas fa-arrow-right"></i> رجوع للقائمة
                </a>
            </div>

        </div>
    </div>
@endsection
