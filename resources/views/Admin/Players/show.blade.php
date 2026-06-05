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

        /* البطاقة الرئيسية */
        .hero-card {
            position: relative;
            z-index: 1;
            background: radial-gradient(120% 140% at 100% 0%, rgba(201, 169, 97, 0.10), transparent 55%), rgba(16, 19, 28, 0.78);
            backdrop-filter: blur(22px);
            border: 1px solid rgba(201, 169, 97, 0.28);
            border-radius: 24px;
            padding: 40px;
            overflow: hidden;
            box-shadow: 0 30px 70px rgba(0, 0, 0, 0.55), inset 0 1px 0 rgba(255, 255, 255, 0.05);
            animation: fadeUp 0.6s ease both;
        }

        /* تصحيح: تعريف الأنميشن الذي كان مفقودًا */
        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(18px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .hero-head {
            display: flex;
            align-items: center;
            gap: 24px;
            flex-wrap: wrap;
        }

        .hero-avatar {
            width: 96px;
            height: 96px;
            border-radius: 26px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
            font-weight: 800;
            color: #1a1305;
            background: linear-gradient(135deg, #f0d896, var(--accent) 55%, #8a6d2f);
            box-shadow: 0 12px 34px rgba(201, 169, 97, 0.45);
            flex-shrink: 0;
        }

        .hero-name {
            font-size: 30px;
            font-weight: 800;
            color: #fff;
            margin-bottom: 12px;
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

        .chip i {
            font-size: 9px;
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

        .chip-green {
            color: #5a9c7a;
            background: rgba(90, 156, 122, 0.14);
            border: 1px solid rgba(90, 156, 122, 0.35);
        }

        .chip-red {
            color: #c55a5a;
            background: rgba(197, 90, 90, 0.14);
            border: 1px solid rgba(197, 90, 90, 0.35);
        }

        /* عناوين الأقسام */
        .block-title {
            display: flex;
            align-items: center;
            gap: 9px;
            margin: 34px 0 14px;
            color: #fff;
            font-weight: 800;
        }

        .block-title::after {
            content: '';
            flex: 1;
            height: 1px;
            background: linear-gradient(90deg, rgba(201, 169, 97, 0.3), transparent);
        }

        /* القياسات البدنية */
        .stat-row {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
        }

        .stat-big {
            text-align: center;
            padding: 20px 14px;
            border-radius: 16px;
            background: rgba(0, 0, 0, 0.25);
            border: 1px solid rgba(201, 169, 97, 0.15);
            transition: 0.3s;
        }

        .stat-big:hover {
            transform: translateY(-4px);
            border-color: rgba(201, 169, 97, 0.4);
        }

        .stat-ic {
            width: 44px;
            height: 44px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            color: var(--accent);
            background: rgba(201, 169, 97, 0.1);
            font-size: 16px;
        }

        .stat-big .num {
            font-size: 28px;
            font-weight: 800;
            color: #fff;
            margin: 12px 0 2px;
        }

        .stat-big .num small {
            font-size: 13px;
            font-weight: 600;
            color: #cfcbc2;
        }

        .stat-big .cap {
            font-size: 11px;
            text-transform: uppercase;
            color: #8b8b8b;
        }

        /* بلوك الاشتراك */
        .sub-card {
            background: linear-gradient(135deg, rgba(201, 169, 97, 0.08), rgba(0, 0, 0, 0.25));
            border: 1px solid rgba(201, 169, 97, 0.2);
            border-radius: 16px;
            padding: 22px;
        }

        .sub-head {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        .sub-plan {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 20px;
            font-weight: 800;
            color: #fff;
        }

        .sub-plan .data-icon {
            width: 38px;
            height: 38px;
        }

        .sub-meta {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 14px;
        }

        .sub-meta .item {
            background: rgba(0, 0, 0, 0.2);
            border-radius: 12px;
            padding: 14px 16px;
        }

        .sub-meta .item .k {
            font-size: 11px;
            text-transform: uppercase;
            color: #8b8b8b;
            margin-bottom: 5px;
        }

        .sub-meta .item .v {
            color: #fff;
            font-weight: 700;
            font-size: 15px;
        }

        .sub-empty {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #cfcbc2;
            background: rgba(0, 0, 0, 0.25);
            border: 1px dashed rgba(201, 169, 97, 0.25);
            border-radius: 16px;
            padding: 22px;
        }

        /* بيانات الحساب */
        .data-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
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
        }

        .data-icon {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 11px;
            color: var(--accent);
            background: rgba(201, 169, 97, 0.1);
            flex-shrink: 0;
        }

        .label {
            color: var(--accent);
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            margin-bottom: 3px;
        }

        .value {
            color: #fff;
            font-size: 15px;
            font-weight: 700;
            word-break: break-word;
        }

        /* الأزرار */
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
            transition: 0.25s ease;
        }

        .btn-edit-lg:hover {
            transform: translateY(-2px);
            filter: brightness(1.06);
        }

        .btn-renew-lg {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            background: rgba(90, 156, 122, 0.14);
            color: #5a9c7a;
            border: 1px solid rgba(90, 156, 122, 0.35);
            padding: 12px 24px;
            border-radius: 11px;
            text-decoration: none;
            font-weight: 700;
            transition: 0.25s ease;
        }

        .btn-renew-lg:hover {
            background: rgba(90, 156, 122, 0.25);
        }

        .btn-back-lg {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #8b8b8b;
            border: 1px solid rgba(201, 169, 97, 0.2);
            padding: 12px 24px;
            border-radius: 11px;
            text-decoration: none;
            font-weight: 600;
            margin-inline-start: auto;
            transition: 0.25s ease;
        }

        .btn-back-lg:hover {
            color: #fff;
            border-color: rgba(201, 169, 97, 0.4);
        }

        /* موبايل */
        @media (max-width: 640px) {
            .hero-card {
                padding: 26px 20px;
            }

            .stat-row,
            .sub-meta,
            .data-grid {
                grid-template-columns: 1fr;
            }

            .profile-actions {
                flex-direction: column;
            }

            .btn-edit-lg,
            .btn-renew-lg,
            .btn-back-lg {
                justify-content: center;
                margin-inline-start: 0;
            }
        }
    </style>
@endsection

@section('content')
    {{-- اختصار للوصول للاشتراك (مجرد تسمية، يمكن نقل أي حسابات إلى الكنترولر/Accessor لاحقًا) --}}
    @php $sub = $player->subscription; @endphp

    <div class="profile-wrapper">
        <div class="hero-card">
            {{-- ===== الترويسة ===== --}}
            <div class="hero-head">
                <div class="hero-avatar">{{ mb_strtoupper(mb_substr($player->name, 0, 1)) }}</div>
                <div class="hero-info">
                    <div class="hero-name">{{ $player->name }}</div>
                    <div class="hero-chips">
                        <span class="chip chip-gold"><i class="fas fa-crown"></i> عضو في Elite Club</span>
                        @if ($sub)
                            <span class="chip {{ $sub->isExpired() ? 'chip-red' : 'chip-green' }}">
                                <i class="fas fa-circle"></i>
                                {{ $sub->isExpired() ? 'اشتراك منتهي' : 'اشتراك فعّال' }}
                            </span>
                        @else
                            <span class="chip chip-muted"><i class="fas fa-ban"></i> بدون اشتراك</span>
                        @endif
                    </div>
                </div>
            </div>

            {{-- ===== القياسات البدنية ===== --}}
            <div class="block-title"><i class="fas fa-ruler-combined"></i> القياسات البدنية</div>
            <div class="stat-row">
                <div class="stat-big">
                    <div class="stat-ic"><i class="fas fa-up-down"></i></div>
                    <div class="num">{{ $player->height ?? '—' }} <small>سم</small></div>
                    <div class="cap">الطول</div>
                </div>
                <div class="stat-big">
                    <div class="stat-ic"><i class="fas fa-weight-scale"></i></div>
                    <div class="num">{{ $player->weight ?? '—' }} <small>كجم</small></div>
                    <div class="cap">الوزن</div>
                </div>
                <div class="stat-big">
                    <div class="stat-ic"><i class="fas fa-heart-pulse"></i></div>
                    <div class="num">
                        @if ($player->height && $player->weight)
                            {{ round($player->weight / pow($player->height / 100, 2), 1) }}
                        @else
                            —
                        @endif
                    </div>
                    <div class="cap">مؤشر الكتلة (BMI)</div>
                </div>
            </div>

            {{-- ===== الاشتراك ===== --}}
            <div class="block-title"><i class="fas fa-id-badge"></i> الاشتراك</div>
            @if ($sub)
                <div class="sub-card">
                    <div class="sub-head">
                        <div class="sub-plan">
                            <span class="data-icon"><i class="fas fa-gem"></i></span>
                            {{ $sub->plan_name ?? 'خطة اشتراك' }}
                        </div>
                        <span class="chip {{ $sub->isExpired() ? 'chip-red' : 'chip-green' }}">
                            {{ $sub->isExpired() ? 'منتهي' : 'فعّال' }}
                        </span>
                    </div>
                    <div class="sub-meta">
                        <div class="item">
                            <div class="k">تاريخ البدء</div>
                            <div class="v">
                                {{ $sub->start_date ? \Carbon\Carbon::parse($sub->start_date)->format('Y-m-d') : '—' }}
                            </div>
                        </div>
                        <div class="item">
                            <div class="k">تاريخ الانتهاء</div>
                            <div class="v">
                                {{ $sub->end_date ? \Carbon\Carbon::parse($sub->end_date)->format('Y-m-d') : '—' }}
                            </div>
                        </div>
                        <div class="item">
                            <div class="k">المتبقّي</div>
                            <div class="v">
                                @if ($sub->isExpired())
                                    منتهي
                                @elseif ($sub->end_date)
                                    {{ \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($sub->end_date)) }} يوم
                                @else
                                    —
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="sub-empty">
                    <span class="data-icon"><i class="fas fa-circle-exclamation"></i></span>
                    لا يوجد اشتراك مسجّل لهذا اللاعب.
                </div>
            @endif

            {{-- ===== بيانات الحساب ===== --}}
            <div class="block-title"><i class="fas fa-address-card"></i> بيانات الحساب</div>
            <div class="data-grid">
                <div class="data-box">
                    <div class="data-icon"><i class="fas fa-envelope"></i></div>
                    <div class="data-text">
                        <div class="label">البريد</div>
                        <div class="value">{{ $player->email ?? 'غير محدد' }}</div>
                    </div>
                </div>
                <div class="data-box">
                    <div class="data-icon"><i class="fas fa-phone"></i></div>
                    <div class="data-text">
                        <div class="label">الهاتف</div>
                        <div class="value">{{ $player->phone ?? 'غير محدد' }}</div>
                    </div>
                </div>
                <div class="data-box">
                    <div class="data-icon"><i class="fas fa-user-tie"></i></div>
                    <div class="data-text">
                        <div class="label">المدرب</div>
                        <div class="value">{{ $player->coach ? $player->coach->name : 'غير مخصص' }}</div>
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

            {{-- ===== الإجراءات ===== --}}
            <div class="profile-actions">
                <a href="{{ route('players.edit', $player->id) }}" class="btn-edit-lg">
                    <i class="fas fa-pen-to-square"></i> تعديل البيانات
                </a>
                @if ($sub)
                    <a href="{{ route('subscriptions.renew', $sub->id) }}" class="btn-renew-lg">
                        <i class="fas fa-rotate"></i> تجديد الاشتراك
                    </a>
                @endif
                <a href="{{ route('players.index') }}" class="btn-back-lg">
                    <i class="fas fa-arrow-right"></i> رجوع
                </a>
            </div>
        </div>
    </div>
@endsection
