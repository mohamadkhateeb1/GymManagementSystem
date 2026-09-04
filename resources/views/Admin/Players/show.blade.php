@extends('Admin.layouts.app')

@section('title', 'ملف اللاعب | Elite Club')

@section('styles')
    <style>
        /* ELITE CLUB — PLAYER PROFILE (نسخة مختصرة تعتمد متغيّرات الثيم) */

        .hero-card {
            width: 100%;
            padding: 28px;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 20px;
            box-shadow: var(--shadow-sm);
        }

        .hero-head {
            display: flex;
            align-items: center;
            gap: 17px;
            padding-bottom: 25px;
            border-bottom: 1px solid var(--border-soft);
            flex-wrap: wrap;
        }

        .hero-avatar {
            width: 72px;
            height: 72px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            color: var(--gold-dark);
            background: linear-gradient(135deg, var(--gold-light), var(--gold));
            border: 1px solid var(--gold-dark);
            border-radius: 18px;
            font-size: 26px;
            font-weight: 900;
        }

        .hero-name {
            color: var(--text);
            font-size: 25px;
            font-weight: 900;
        }

        .hero-chips {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-top: 9px;
            flex-wrap: wrap;
        }

        .chip {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 11px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 800;
        }

        .chip-gold {
            color: var(--gold-dark);
            background: var(--sidebar-active);
            border: 1px solid rgba(184, 146, 62, .25);
        }

        .chip-green {
            color: var(--success);
            background: var(--success-bg);
            border: 1px solid rgba(63, 145, 106, .20);
        }

        .chip-red {
            color: var(--danger);
            background: var(--danger-bg);
            border: 1px solid rgba(196, 93, 93, .20);
        }

        .chip-muted {
            color: #fff;
            background: var(--muted);
        }

        .block-title {
            display: flex;
            align-items: center;
            gap: 9px;
            margin: 26px 0 14px;
            color: var(--text);
            font-size: 16px;
            font-weight: 850;
        }

        .block-title i {
            width: 31px;
            height: 31px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gold-dark);
            background: var(--sidebar-active);
            border-radius: 9px;
            font-size: 12px;
        }

        .stat-big {
            min-height: 130px;
            padding: 18px;
            background: var(--surface-2);
            border: 1px solid var(--border);
            border-radius: 13px;
            text-align: center;
            transition: .2s ease;
        }

        .stat-big:hover {
            border-color: var(--gold-light);
            transform: translateY(-2px);
            box-shadow: var(--shadow-sm);
        }

        .stat-ic {
            width: 36px;
            height: 36px;
            margin: 0 auto 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gold-dark);
            background: var(--sidebar-active);
            border-radius: 10px;
            font-size: 14px;
        }

        .stat-big .num {
            color: var(--text);
            font-size: 25px;
            font-weight: 900;
        }

        .stat-big .num small {
            color: var(--text-soft);
            font-size: 11px;
            font-weight: 700;
        }

        .stat-big .cap {
            margin-top: 5px;
            color: var(--text-soft);
            font-size: 12px;
            font-weight: 700;
        }

        .sub-card {
            padding: 18px;
            background: var(--sidebar-active);
            border: 1px solid rgba(184, 146, 62, .25);
            border-radius: 14px;
        }

        .sub-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid rgba(184, 146, 62, .20);
            flex-wrap: wrap;
        }

        .sub-plan {
            display: flex;
            align-items: center;
            gap: 9px;
            color: var(--text);
            font-size: 16px;
            font-weight: 850;
        }

        .data-icon {
            width: 34px;
            height: 34px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            color: var(--gold-dark);
            background: var(--surface);
            border: 1px solid rgba(184, 146, 62, .25);
            border-radius: 9px;
            font-size: 12px;
        }

        .sub-meta .item {
            padding: 11px;
            background: var(--surface);
            border: 1px solid rgba(184, 146, 62, .18);
            border-radius: 9px;
        }

        .sub-meta .k {
            margin-bottom: 5px;
            color: var(--text-soft);
            font-size: 12px;
            font-weight: 700;
        }

        .sub-meta .v {
            color: var(--text);
            font-size: 14px;
            font-weight: 850;
        }

        .sub-empty {
            display: flex;
            align-items: center;
            gap: 10px;
            min-height: 65px;
            padding: 12px 15px;
            color: var(--text-soft);
            background: var(--surface-2);
            border: 1px dashed var(--border);
            border-radius: 12px;
            font-size: 14px;
            font-weight: 700;
        }

        .data-box {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px;
            background: var(--surface-2);
            border: 1px solid var(--border);
            border-radius: 12px;
            transition: .2s ease;
            height: 100%;
        }

        .data-box:hover {
            border-color: var(--gold-light);
            background: var(--surface-hover);
        }

        .data-box .data-icon {
            width: 39px;
            height: 39px;
        }

        .data-text .label {
            margin-bottom: 4px;
            color: var(--text-soft);
            font-size: 12px;
            font-weight: 700;
        }

        .data-text .value {
            color: var(--text);
            font-size: 14px;
            font-weight: 800;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .profile-actions {
            display: flex;
            align-items: center;
            gap: 9px;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid var(--border-soft);
            flex-wrap: wrap;
        }

        .profile-actions a {
            height: 43px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 0 17px;
            border-radius: 9px;
            text-decoration: none;
            font-size: 13.5px;
            font-weight: 800;
            transition: .2s ease;
        }

        .btn-edit-lg {
            color: #fff;
            background: linear-gradient(135deg, var(--gold-light), var(--gold-dark));
            box-shadow: 0 5px 13px rgba(181, 128, 31, .17);
        }

        .btn-edit-lg:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 17px rgba(181, 128, 31, .24);
        }

        .btn-renew-lg {
            color: var(--success);
            background: var(--success-bg);
        }

        .btn-renew-lg:hover {
            color: #fff;
            background: var(--success);
        }

        .btn-back-lg {
            color: var(--text-soft);
            background: var(--surface-2);
        }

        .btn-back-lg:hover {
            color: var(--gold-dark);
            background: var(--surface-hover);
        }

        @media (max-width: 600px) {
            .hero-card {
                padding: 18px;
                border-radius: 15px;
            }

            .hero-name {
                font-size: 19px;
            }

            .profile-actions {
                flex-direction: column;
                align-items: stretch;
            }
        }
    </style>
@endsection

@section('content')
    @php $sub = $player->subscription; @endphp

    <div class="hero-card">
        <div class="hero-head">
            <div class="hero-avatar">{{ mb_strtoupper(mb_substr($player->name, 0, 1)) }}</div>
            <div>
                <div class="hero-name">{{ $player->name }}</div>
                <div class="hero-chips">
                    <span class="chip chip-gold"><i class="fas fa-crown"></i> عضو في Elite Club</span>
                    @if ($sub)
                        <span class="chip {{ $sub->isExpired() ? 'chip-red' : 'chip-green' }}">
                            <i class="fas fa-circle"></i> {{ $sub->isExpired() ? 'اشتراك منتهي' : 'اشتراك فعّال' }}
                        </span>
                    @else
                        <span class="chip chip-muted"><i class="fas fa-ban"></i> بدون اشتراك</span>
                    @endif
                </div>
            </div>
        </div>

        <div class="block-title"><i class="fas fa-ruler-combined"></i> القياسات البدنية</div>
        <div class="row g-3">
            <div class="col-12 col-sm-4">
                <div class="stat-big">
                    <div class="stat-ic"><i class="fas fa-up-down"></i></div>
                    <div class="num">{{ $player->height ?? '—' }} <small>سم</small></div>
                    <div class="cap">الطول</div>
                </div>
            </div>
            <div class="col-12 col-sm-4">
                <div class="stat-big">
                    <div class="stat-ic"><i class="fas fa-weight-scale"></i></div>
                    <div class="num">{{ $player->weight ?? '—' }} <small>كجم</small></div>
                    <div class="cap">الوزن</div>
                </div>
            </div>
            <div class="col-12 col-sm-4">
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
        </div>

        <div class="block-title"><i class="fas fa-id-badge"></i> الاشتراك</div>
        @if ($sub)
            <div class="sub-card">
                <div class="sub-head">
                    <div class="sub-plan"><span class="data-icon"><i class="fas fa-gem"></i></span>
                        {{ $sub->plan_name ?? 'خطة اشتراك' }}</div>
                    <span
                        class="chip {{ $sub->isExpired() ? 'chip-red' : 'chip-green' }}">{{ $sub->isExpired() ? 'منتهي' : 'فعّال' }}</span>
                </div>
                <div class="row g-2 mt-1">
                    <div class="col-12 col-sm-4">
                        <div class="item">
                            <div class="k">تاريخ البدء</div>
                            <div class="v">
                                {{ $sub->start_date ? \Carbon\Carbon::parse($sub->start_date)->format('Y-m-d') : '—' }}
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-4">
                        <div class="item">
                            <div class="k">تاريخ الانتهاء</div>
                            <div class="v">
                                {{ $sub->end_date ? \Carbon\Carbon::parse($sub->end_date)->format('Y-m-d') : '—' }}</div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-4">
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
            </div>
        @else
            <div class="sub-empty"><span class="data-icon"><i class="fas fa-circle-exclamation"></i></span> لا يوجد اشتراك
                مسجّل لهذا اللاعب.</div>
        @endif

        <div class="block-title"><i class="fas fa-address-card"></i> بيانات الحساب</div>
        <div class="row g-3">
            <div class="col-12 col-sm-6">
                <div class="data-box">
                    <div class="data-icon"><i class="fas fa-envelope"></i></div>
                    <div class="data-text">
                        <div class="label">البريد</div>
                        <div class="value">{{ $player->email ?? 'غير محدد' }}</div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6">
                <div class="data-box">
                    <div class="data-icon"><i class="fas fa-phone"></i></div>
                    <div class="data-text">
                        <div class="label">الهاتف</div>
                        <div class="value">{{ $player->phone ?? 'غير محدد' }}</div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6">
                <div class="data-box">
                    <div class="data-icon"><i class="fas fa-user-tie"></i></div>
                    <div class="data-text">
                        <div class="label">المدرب</div>
                        <div class="value">{{ $player->coach ? $player->coach->name : 'غير مخصص' }}</div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6">
                <div class="data-box">
                    <div class="data-icon"><i class="fas fa-hashtag"></i></div>
                    <div class="data-text">
                        <div class="label">رقم اللاعب</div>
                        <div class="value">#{{ $player->id }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="profile-actions">
            <a href="{{ route('players.edit', $player->id) }}" class="btn-edit-lg"><i class="fas fa-pen-to-square"></i>
                تعديل البيانات</a>
            @if ($sub)
                <a href="{{ route('subscriptions.renew', $sub->id) }}" class="btn-renew-lg"><i class="fas fa-rotate"></i>
                    تجديد الاشتراك</a>
            @endif
            <a href="{{ route('players.index') }}" class="btn-back-lg"><i class="fas fa-arrow-right"></i> رجوع</a>
        </div>
    </div>
@endsection
