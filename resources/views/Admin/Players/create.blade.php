@extends('Admin.layouts.app')

@section('title', 'إضافة لاعب جديد | Elite Club')

@section('styles')
    <style>
        /* =========================================================
   ELITE CLUB - CREATE / EDIT PAGE HEADER
   ========================================================= */

.page-header {
    width: 100%;

    display: flex;
    align-items: center;
    justify-content: space-between;

    gap: 20px;

    margin-bottom: 20px;
    padding: 18px 20px;

    background: #ffffff;
    border: 1px solid #e4e8ef;
    border-radius: 16px;

    box-shadow: 0 6px 22px rgba(25, 35, 50, 0.045);

    direction: rtl;
}

.page-header-left {
    display: flex;
    align-items: center;

    gap: 13px;

    min-width: 0;
}

.page-accent {
    width: 4px;
    height: 42px;

    flex-shrink: 0;

    border-radius: 10px;

    background: linear-gradient(
        to bottom,
        #e0ad47,
        #ad791c
    );

    box-shadow: 0 3px 10px rgba(190, 140, 40, 0.20);
}

.page-title {
    color: #202631;

    font-size: 20px;
    font-weight: 850;

    line-height: 1.5;
}

.page-title span {
    color: #b98222;
}

.page-sub {
    margin-top: 3px;

    color: #8a929f;

    font-size: 12px;
    font-weight: 500;
}

/* =========================
   PAGE AVATAR - EDIT
   ========================= */

.page-avatar {
    width: 44px;
    height: 44px;

    display: flex;
    align-items: center;
    justify-content: center;

    flex-shrink: 0;

    color: #a9781f;

    background: linear-gradient(
        135deg,
        #fff5d9,
        #f3dfaa
    );

    border: 1px solid #e6c879;
    border-radius: 12px;

    font-size: 16px;
    font-weight: 900;
}

/* =========================
   BACK BUTTON
   ========================= */

.btn-back {
    height: 42px;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    gap: 8px;

    flex-shrink: 0;

    padding: 0 17px;

    color: #596273;
    background: #f8f9fb;

    border: 1px solid #dfe4eb;
    border-radius: 10px;

    text-decoration: none;

    font-size: 12px;
    font-weight: 750;

    transition: all 0.2s ease;
}

.btn-back i {
    font-size: 11px;
}

.btn-back:hover {
    color: #a9781f;
    background: #fffaf0;
    border-color: #d9b15d;
    transform: translateX(2px);
}

/* =========================
   DARK
   ========================= */

[data-theme="dark"] .page-header,
.dark-mode .page-header,
body.dark .page-header {
    background: #121720;
    border-color: #29313d;
    box-shadow: 0 8px 28px rgba(0, 0, 0, 0.22);
}

[data-theme="dark"] .page-title,
.dark-mode .page-title,
body.dark .page-title {
    color: #f1f3f6;
}

[data-theme="dark"] .page-sub,
.dark-mode .page-sub,
body.dark .page-sub {
    color: #7f8998;
}

[data-theme="dark"] .page-avatar,
.dark-mode .page-avatar,
body.dark .page-avatar {
    color: #e0ac45;

    background: rgba(210, 158, 55, 0.10);
    border-color: rgba(210, 158, 55, 0.28);
}

[data-theme="dark"] .btn-back,
.dark-mode .btn-back,
body.dark .btn-back {
    color: #c0c6cf;
    background: #191f28;
    border-color: #323b48;
}

[data-theme="dark"] .btn-back:hover,
.dark-mode .btn-back:hover,
body.dark .btn-back:hover {
    color: #e0ac45;
    background: rgba(210, 158, 55, 0.08);
    border-color: rgba(210, 158, 55, 0.30);
}

/* =========================
   RESPONSIVE
   ========================= */

@media (max-width: 650px) {
    .page-header {
        align-items: flex-start;
        flex-direction: column;
    }

    .page-header-left {
        width: 100%;
    }

    .btn-back {
        width: 100%;
    }

    .page-title {
        font-size: 17px;
    }
}
    </style>
@endsection

@section('content')
    <div class="page-header">
        <div class="page-header-left">
            <div class="page-accent"></div>
            <div>
                <div class="page-title">إضافة لاعب جديد</div>
                <div class="page-sub">أدخل بيانات اللاعب لإضافته إلى سجل النادي</div>
            </div>
        </div>

        <a href="{{ route('players.index') }}" class="btn-back">
            <i class="fas fa-arrow-right"></i> رجوع للقائمة
        </a>
    </div>

    <form action="{{ route('players.store') }}" method="POST" class="form-card">
        @csrf
        
        @include('Admin.Players._form')
    </form>
@endsection
