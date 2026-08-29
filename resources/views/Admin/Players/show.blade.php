@extends('Admin.layouts.app')

@section('title', 'ملف اللاعب | Elite Club')

@section('styles')
    <style>
/* =========================================================
   ELITE CLUB - PLAYER PROFILE
   SHOW PAGE
   ========================================================= */

.profile-wrapper {
    width: 100%;
    direction: rtl;
}

.hero-card {
    width: 100%;

    padding: 28px;

    background: #ffffff;

    border: 1px solid #e3e7ee;
    border-radius: 20px;

    box-shadow:
        0 10px 32px rgba(25, 35, 50, 0.06);
}

/* =========================
   HERO HEADER
   ========================= */

.hero-head {
    display: flex;
    align-items: center;

    gap: 17px;

    padding-bottom: 25px;

    border-bottom: 1px solid #edf0f4;
}

.hero-avatar {
    width: 72px;
    height: 72px;

    display: flex;
    align-items: center;
    justify-content: center;

    flex-shrink: 0;

    color: #a97920;

    background:
        linear-gradient(
            135deg,
            #fff4d1,
            #e9c875
        );

    border: 1px solid #e0bd69;
    border-radius: 18px;

    box-shadow:
        0 8px 20px rgba(185, 135, 36, 0.14);

    font-size: 25px;
    font-weight: 900;
}

.hero-info {
    min-width: 0;
}

.hero-name {
    color: #202631;

    font-size: 23px;
    font-weight: 900;
}

.hero-chips {
    display: flex;
    align-items: center;

    gap: 8px;

    margin-top: 9px;

    flex-wrap: wrap;
}

/* =========================
   CHIPS
   ========================= */

.chip {
    display: inline-flex;
    align-items: center;

    gap: 6px;

    padding: 6px 11px;

    border-radius: 20px;

    font-size: 10px;
    font-weight: 800;
}

.chip i {
    font-size: 8px;
}

.chip-gold {
    color: #a47720;

    background: #fff8e6;

    border: 1px solid #ecd7a4;
}

.chip-green {
    color: #12865a;

    background: #e8f8f0;

    border: 1px solid #c4ebd9;
}

.chip-red {
    color: #d34848;

    background: #fff0f0;

    border: 1px solid #f1cccc;
}

.chip-muted {
    color: #7e8793;

    background: #f1f3f5;

    border: 1px solid #dfe3e8;
}

/* =========================
   BLOCK TITLE
   ========================= */

.block-title {
    display: flex;
    align-items: center;

    gap: 9px;

    margin-top: 26px;
    margin-bottom: 14px;

    color: #343b47;

    font-size: 14px;
    font-weight: 850;
}

.block-title i {
    width: 31px;
    height: 31px;

    display: flex;
    align-items: center;
    justify-content: center;

    color: #b47f22;

    background: #fff8e8;

    border: 1px solid #eedcad;
    border-radius: 9px;

    font-size: 12px;
}

/* =========================
   STAT ROW
   ========================= */

.stat-row {
    display: grid;

    grid-template-columns: repeat(3, 1fr);

    gap: 13px;
}

.stat-big {
    position: relative;

    min-height: 130px;

    padding: 18px;

    background: #fbfcfd;

    border: 1px solid #e7ebf0;
    border-radius: 13px;

    text-align: center;

    transition: all 0.2s ease;
}

.stat-big:hover {
    border-color: #dec27d;
    transform: translateY(-2px);

    box-shadow: 0 7px 18px rgba(25, 35, 50, 0.05);
}

.stat-ic {
    width: 36px;
    height: 36px;

    margin: 0 auto 8px;

    display: flex;
    align-items: center;
    justify-content: center;

    color: #b98222;

    background: #fff7e3;

    border: 1px solid #ecd9a9;
    border-radius: 10px;

    font-size: 14px;
}

.stat-big .num {
    color: #202631;

    font-size: 22px;
    font-weight: 900;

    line-height: 1.3;
}

.stat-big .num small {
    color: #9aa1ab;

    font-size: 10px;
    font-weight: 700;
}

.stat-big .cap {
    margin-top: 5px;

    color: #858d99;

    font-size: 10px;
    font-weight: 700;
}

/* =========================
   SUBSCRIPTION
   ========================= */

.sub-card {
    padding: 18px;

    background:
        linear-gradient(
            135deg,
            #fffdf8,
            #fffaf0
        );

    border: 1px solid #ead9ad;
    border-radius: 14px;
}

.sub-head {
    display: flex;
    align-items: center;
    justify-content: space-between;

    gap: 15px;

    padding-bottom: 15px;

    border-bottom: 1px solid #eee1c2;
}

.sub-plan {
    display: flex;
    align-items: center;

    gap: 9px;

    color: #333a45;

    font-size: 14px;
    font-weight: 850;
}

.data-icon {
    width: 34px;
    height: 34px;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    flex-shrink: 0;

    color: #b57e20;

    background: #fff5da;

    border: 1px solid #ebd49b;
    border-radius: 9px;

    font-size: 12px;
}

.sub-meta {
    display: grid;

    grid-template-columns: repeat(3, 1fr);

    gap: 10px;

    margin-top: 16px;
}

.sub-meta .item {
    padding: 11px;

    background: rgba(255, 255, 255, 0.65);

    border: 1px solid #eee4cb;
    border-radius: 9px;
}

.sub-meta .k {
    margin-bottom: 5px;

    color: #969da8;

    font-size: 10px;
    font-weight: 700;
}

.sub-meta .v {
    color: #303743;

    font-size: 12px;
    font-weight: 850;
}

/* =========================
   EMPTY SUB
   ========================= */

.sub-empty {
    display: flex;
    align-items: center;

    gap: 10px;

    min-height: 65px;

    padding: 12px 15px;

    color: #8a929e;

    background: #f8f9fa;

    border: 1px dashed #d9dee5;
    border-radius: 12px;

    font-size: 12px;
    font-weight: 700;
}

.sub-empty .data-icon {
    color: #9299a4;

    background: #eef0f3;
    border-color: #dfe3e8;
}

/* =========================
   ACCOUNT DATA
   ========================= */

.data-grid {
    display: grid;

    grid-template-columns: repeat(2, 1fr);

    gap: 12px;
}

.data-box {
    display: flex;
    align-items: center;

    gap: 12px;

    min-width: 0;

    padding: 14px;

    background: #fbfcfd;

    border: 1px solid #e7ebf0;
    border-radius: 12px;

    transition: all 0.2s ease;
}

.data-box:hover {
    border-color: #dec27d;
    background: #fffdf8;
}

.data-box .data-icon {
    width: 39px;
    height: 39px;

    color: #b47f22;

    background: #fff7e4;

    border-color: #ecd9a9;
}

.data-text {
    min-width: 0;
}

.data-text .label {
    margin-bottom: 4px;

    color: #959da8;

    font-size: 10px;
    font-weight: 700;
}

.data-text .value {
    color: #303743;

    font-size: 12px;
    font-weight: 800;

    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

/* =========================
   PROFILE ACTIONS
   ========================= */

.profile-actions {
    display: flex;
    align-items: center;

    gap: 9px;

    margin-top: 25px;
    padding-top: 20px;

    border-top: 1px solid #edf0f4;
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

    font-size: 11px;
    font-weight: 800;

    transition: all 0.2s ease;
}

/* EDIT */

.btn-edit-lg {
    color: #ffffff;

    background: linear-gradient(
        135deg,
        #d3a13e,
        #b47d1e
    );

    border: 1px solid #bd8a2c;

    box-shadow: 0 5px 13px rgba(181, 128, 31, 0.17);
}

.btn-edit-lg:hover {
    transform: translateY(-1px);
    box-shadow: 0 8px 17px rgba(181, 128, 31, 0.24);
}

/* RENEW */

.btn-renew-lg {
    color: #12885a;

    background: #eaf8f1;

    border: 1px solid #c6ead9;
}

.btn-renew-lg:hover {
    color: #ffffff;
    background: #168f60;
}

/* BACK */

.btn-back-lg {
    color: #606977;

    background: #f5f6f8;

    border: 1px solid #dfe3e8;
}

.btn-back-lg:hover {
    color: #a47720;

    background: #fff9ed;

    border-color: #e2ca91;
}

/* =========================================================
   DARK MODE
   ========================================================= */

[data-theme="dark"] .hero-card,
.dark-mode .hero-card,
body.dark .hero-card {
    background: #121720;
    border-color: #29313d;
    box-shadow: 0 10px 35px rgba(0, 0, 0, 0.25);
}

[data-theme="dark"] .hero-head,
.dark-mode .hero-head,
body.dark .hero-head {
    border-bottom-color: #29313d;
}

[data-theme="dark"] .hero-avatar,
.dark-mode .hero-avatar,
body.dark .hero-avatar {
    color: #e0ad45;

    background: rgba(210, 158, 55, 0.10);
    border-color: rgba(210, 158, 55, 0.28);

    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.20);
}

[data-theme="dark"] .hero-name,
.dark-mode .hero-name,
body.dark .hero-name {
    color: #f0f2f5;
}

[data-theme="dark"] .chip-gold,
.dark-mode .chip-gold,
body.dark .chip-gold {
    color: #dfab43;
    background: rgba(210, 158, 55, 0.09);
    border-color: rgba(210, 158, 55, 0.22);
}

[data-theme="dark"] .chip-green,
.dark-mode .chip-green,
body.dark .chip-green {
    color: #45d99b;
    background: rgba(25, 157, 100, 0.10);
    border-color: rgba(25, 157, 100, 0.23);
}

[data-theme="dark"] .chip-red,
.dark-mode .chip-red,
body.dark .chip-red {
    color: #ff7373;
    background: rgba(210, 65, 65, 0.09);
    border-color: rgba(210, 65, 65, 0.22);
}

[data-theme="dark"] .chip-muted,
.dark-mode .chip-muted,
body.dark .chip-muted {
    color: #929ba9;
    background: #1b222b;
    border-color: #303946;
}

[data-theme="dark"] .block-title,
.dark-mode .block-title,
body.dark .block-title {
    color: #d8dce2;
}

[data-theme="dark"] .block-title i,
.dark-mode .block-title i,
body.dark .block-title i {
    color: #dba843;
    background: rgba(210, 158, 55, 0.09);
    border-color: rgba(210, 158, 55, 0.22);
}

/* stats */

[data-theme="dark"] .stat-big,
.dark-mode .stat-big,
body.dark .stat-big {
    background: #181e27;
    border-color: #2b3440;
}

[data-theme="dark"] .stat-big:hover,
.dark-mode .stat-big:hover,
body.dark .stat-big:hover {
    background: #1b222b;
    border-color: rgba(210, 158, 55, 0.30);
}

[data-theme="dark"] .stat-ic,
.dark-mode .stat-ic,
body.dark .stat-ic {
    color: #dba843;
    background: rgba(210, 158, 55, 0.09);
    border-color: rgba(210, 158, 55, 0.22);
}

[data-theme="dark"] .stat-big .num,
.dark-mode .stat-big .num,
body.dark .stat-big .num {
    color: #f1f3f6;
}

[data-theme="dark"] .stat-big .num small,
.dark-mode .stat-big .num small {
    color: #7e8795;
}

[data-theme="dark"] .stat-big .cap,
.dark-mode .stat-big .cap,
body.dark .stat-big .cap {
    color: #7f8997;
}

/* subscription */

[data-theme="dark"] .sub-card,
.dark-mode .sub-card,
body.dark .sub-card {
    background:
        linear-gradient(
            135deg,
            rgba(210, 158, 55, 0.07),
            rgba(210, 158, 55, 0.025)
        );

    border-color: rgba(210, 158, 55, 0.25);
}

[data-theme="dark"] .sub-head,
.dark-mode .sub-head,
body.dark .sub-head {
    border-bottom-color: rgba(210, 158, 55, 0.15);
}

[data-theme="dark"] .sub-plan,
.dark-mode .sub-plan,
body.dark .sub-plan {
    color: #e5e8ed;
}

[data-theme="dark"] .data-icon,
.dark-mode .data-icon,
body.dark .data-icon {
    color: #dba843;
    background: rgba(210, 158, 55, 0.09);
    border-color: rgba(210, 158, 55, 0.22);
}

[data-theme="dark"] .sub-meta .item,
.dark-mode .sub-meta .item,
body.dark .sub-meta .item {
    background: rgba(255, 255, 255, 0.025);
    border-color: #303946;
}

[data-theme="dark"] .sub-meta .k,
.dark-mode .sub-meta .k,
body.dark .sub-meta .k {
    color: #7f8997;
}

[data-theme="dark"] .sub-meta .v,
.dark-mode .sub-meta .v,
body.dark .sub-meta .v {
    color: #dce0e6;
}

/* empty */

[data-theme="dark"] .sub-empty,
.dark-mode .sub-empty,
body.dark .sub-empty {
    color: #818b99;
    background: #181e27;
    border-color: #303946;
}

/* data */

[data-theme="dark"] .data-box,
.dark-mode .data-box,
body.dark .data-box {
    background: #181e27;
    border-color: #2b3440;
}

[data-theme="dark"] .data-box:hover,
.dark-mode .data-box:hover,
body.dark .data-box:hover {
    background: rgba(210, 158, 55, 0.045);
    border-color: rgba(210, 158, 55, 0.27);
}

[data-theme="dark"] .data-box .data-icon,
.dark-mode .data-box .data-icon,
body.dark .data-box .data-icon {
    color: #dba843;
    background: rgba(210, 158, 55, 0.09);
    border-color: rgba(210, 158, 55, 0.22);
}

[data-theme="dark"] .data-text .label,
.dark-mode .data-text .label,
body.dark .data-text .label {
    color: #7e8795;
}

[data-theme="dark"] .data-text .value,
.dark-mode .data-text .value,
body.dark .data-text .value {
    color: #e1e5ea;
}

/* actions */

[data-theme="dark"] .profile-actions,
.dark-mode .profile-actions,
body.dark .profile-actions {
    border-top-color: #29313d;
}

[data-theme="dark"] .btn-back-lg,
.dark-mode .btn-back-lg,
body.dark .btn-back-lg {
    color: #b7bec8;
    background: #1b222b;
    border-color: #303946;
}

[data-theme="dark"] .btn-back-lg:hover,
.dark-mode .btn-back-lg:hover,
body.dark .btn-back-lg:hover {
    color: #dfab43;
    background: rgba(210, 158, 55, 0.08);
    border-color: rgba(210, 158, 55, 0.25);
}

[data-theme="dark"] .btn-renew-lg,
.dark-mode .btn-renew-lg,
body.dark .btn-renew-lg {
    color: #45d99b;
    background: rgba(25, 157, 100, 0.09);
    border-color: rgba(25, 157, 100, 0.22);
}

/* =========================
   RESPONSIVE
   ========================= */

@media (max-width: 800px) {
    .stat-row {
        grid-template-columns: 1fr;
    }

    .sub-meta {
        grid-template-columns: 1fr;
    }

    .data-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 600px) {
    .hero-card {
        padding: 18px;
        border-radius: 15px;
    }

    .hero-head {
        align-items: flex-start;
    }

    .hero-avatar {
        width: 58px;
        height: 58px;
        border-radius: 14px;
        font-size: 20px;
    }

    .hero-name {
        font-size: 18px;
    }

    .profile-actions {
        flex-direction: column;
        align-items: stretch;
    }

    .profile-actions a {
        width: 100%;
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
