@extends('Admin.layouts.app')

@section('title', 'إنشاء دور جديد | Elite Club')


@section('styles')

<style>

/* =========================================================
   ROLES - CREATE PAGE
   ========================================================= */

.roles-page {
    width: 100%;
    direction: rtl;
    color: var(--text, #111827);
}

.roles-page * {
    box-sizing: border-box;
}


/* =========================
   PAGE HEADER
   ========================= */

.roles-page .roles-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;

    margin-bottom: 22px;
}

.roles-page .roles-header-info {
    display: flex;
    align-items: center;
    gap: 14px;
}

.roles-page .header-accent {
    width: 4px;
    height: 52px;
    border-radius: 10px;

    background: linear-gradient(
        to bottom,
        var(--gold, #c9a227),
        #e8c66a
    );

    box-shadow: 0 0 18px rgba(201,162,39,.18);
}

.roles-page .header-title {
    margin: 0;

    font-size: 24px;
    font-weight: 800;

    color: var(--text, #111827);
}

.roles-page .header-sub {
    margin-top: 5px;

    color: var(--muted, #6b7280);
    font-size: 13px;
}


/* =========================
   BACK BUTTON
   ========================= */

.roles-page .btn-back {
    display: inline-flex;
    align-items: center;
    gap: 9px;

    padding: 11px 18px;

    border-radius: 10px;

    border: 1px solid var(--border, #e5e7eb);

    background: var(--surface, #fff);

    color: var(--text, #111827);

    text-decoration: none;

    font-size: 13px;
    font-weight: 700;

    transition: .2s ease;
}

.roles-page .btn-back:hover {
    border-color: var(--gold, #c9a227);
    color: var(--gold, #c9a227);
    transform: translateX(2px);
}


/* =========================
   MAIN CARD
   ========================= */

.roles-page .role-card {
    background: var(--surface, #ffffff);

    border: 1px solid var(--border, #e5e7eb);

    border-radius: 18px;

    overflow: hidden;

    box-shadow:
        0 8px 30px rgba(0,0,0,.04);
}

.roles-page .role-card-top {
    display: flex;
    align-items: center;
    gap: 12px;

    padding: 18px 24px;

    border-bottom: 1px solid var(--border, #e5e7eb);

    background:
        linear-gradient(
            90deg,
            rgba(201,162,39,.07),
            transparent
        );
}

.roles-page .role-card-top i {
    width: 34px;
    height: 34px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 9px;

    background: rgba(201,162,39,.12);
    color: var(--gold, #c9a227);
}

.roles-page .role-card-top span {
    font-size: 15px;
    font-weight: 800;

    color: var(--text, #111827);
}


/* =========================
   FORM
   ========================= */

.role-form {
    padding: 26px;
}


/* =========================
   FIELD
   ========================= */

.role-field {
    margin-bottom: 28px;
}

.role-label {
    display: flex;
    align-items: center;
    gap: 8px;

    margin-bottom: 9px;

    font-size: 13px;
    font-weight: 700;

    color: var(--text, #111827);
}

.role-label i {
    color: var(--gold, #c9a227);
}


.role-input-wrap {
    position: relative;
}

.role-input-wrap > i {
    position: absolute;

    right: 15px;
    top: 50%;

    transform: translateY(-50%);

    color: var(--gold, #c9a227);

    font-size: 14px;

    pointer-events: none;
}

.role-input {
    width: 100%;

    height: 48px;

    padding: 0 44px 0 15px;

    border-radius: 11px;

    border: 1px solid var(--border, #dfe3ea);

    background: var(--input-bg, #f9fafb);

    color: var(--text, #111827);

    outline: none;

    font-size: 13px;

    transition: .2s ease;
}

.role-input::placeholder {
    color: var(--muted, #9ca3af);
}

.role-input:focus {
    border-color: var(--gold, #c9a227);

    background: var(--surface, #fff);

    box-shadow:
        0 0 0 3px rgba(201,162,39,.10);
}


/* =========================
   ABILITIES
   ========================= */

.abilities-section {
    border: 1px solid var(--border, #e5e7eb);

    border-radius: 15px;

    overflow: hidden;

    background: var(--surface-2, rgba(0,0,0,.015));
}


.abilities-header {
    padding: 18px 20px;

    border-bottom: 1px solid var(--border, #e5e7eb);
}

.abilities-title {
    display: flex;
    align-items: center;
    gap: 12px;
}

.abilities-icon {
    width: 38px;
    height: 38px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 10px;

    background: rgba(201,162,39,.12);

    color: var(--gold, #c9a227);
}

.abilities-title h3 {
    margin: 0 0 3px;

    font-size: 15px;
    font-weight: 800;

    color: var(--text, #111827);
}

.abilities-title span {
    font-size: 12px;

    color: var(--muted, #6b7280);
}


/* =========================
   TABLE
   ========================= */

.abilities-table-wrapper {
    width: 100%;
    overflow-x: auto;
}

.abilities-table {
    width: 100%;

    border-collapse: collapse;

    min-width: 680px;

    color: var(--text, #111827);
}

.abilities-table thead {
    background: var(--table-head, #f5f6f8);
}

.abilities-table th {
    height: 62px;

    padding: 10px 16px;

    border-bottom: 1px solid var(--border, #e5e7eb);

    font-size: 12px;
    font-weight: 800;

    color: var(--muted, #6b7280);
}

.ability-name-head {
    text-align: right;
    width: 45%;
}

.permission-head {
    text-align: center;
    width: 18.33%;
}

.permission-title {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;

    margin-bottom: 7px;

    font-size: 12px;
    font-weight: 800;
}

.permission-dot {
    width: 7px;
    height: 7px;

    border-radius: 50%;
}

.allow-head .permission-dot {
    background: #22c55e;
}

.deny-head .permission-dot {
    background: #ef4444;
}

.inherit-head .permission-dot {
    background: #94a3b8;
}


/* =========================
   SELECT ALL
   ========================= */

.btn-select-all {
    border: 0;

    background: transparent;

    color: var(--gold, #c9a227);

    font-size: 10px;
    font-weight: 700;

    cursor: pointer;

    padding: 0;

    transition: .2s;
}

.btn-select-all:hover {
    color: #a47d18;
    text-decoration: underline;
}


/* =========================
   ROWS
   ========================= */

.abilities-table tbody tr {
    background: var(--surface, #fff);

    transition:
        background .2s ease,
        transform .2s ease;
}

.abilities-table tbody tr:nth-child(even) {
    background: var(--table-row-alt, rgba(0,0,0,.018));
}

.abilities-table tbody tr:hover {
    background: rgba(201,162,39,.055);
}

.abilities-table td {
    height: 64px;

    padding: 10px 16px;

    border-bottom: 1px solid var(--border, #e5e7eb);

    font-size: 13px;
}


/* =========================
   ABILITY NAME
   ========================= */

.ability-content {
    display: flex;
    align-items: center;
    gap: 11px;
}

.ability-icon {
    width: 32px;
    height: 32px;

    display: flex;
    align-items: center;
    justify-content: center;

    flex-shrink: 0;

    border-radius: 8px;

    background: rgba(201,162,39,.09);

    color: var(--gold, #c9a227);

    font-size: 12px;
}

.ability-content strong {
    display: block;

    color: var(--text, #111827);

    font-size: 13px;
}

.ability-content small {
    display: block;

    margin-top: 3px;

    direction: ltr;
    text-align: right;

    color: var(--muted, #9ca3af);

    font-size: 10px;
}


/* =========================
   RADIO
   ========================= */

.permission-cell {
    text-align: center;
}

.radio-option {
    display: inline-flex;

    align-items: center;
    justify-content: center;

    cursor: pointer;
}

.radio-option input {
    position: absolute;

    opacity: 0;

    pointer-events: none;
}

.custom-radio {
    width: 21px;
    height: 21px;

    display: block;

    border-radius: 50%;

    border: 2px solid var(--radio-border, #d1d5db);

    background: var(--surface, #fff);

    transition: .2s ease;

    position: relative;
}

.radio-option input:checked + .custom-radio::after {
    content: "";

    position: absolute;

    width: 9px;
    height: 9px;

    top: 50%;
    left: 50%;

    transform: translate(-50%, -50%);

    border-radius: 50%;
}

.radio-option input:checked + .allow-radio {
    border-color: #22c55e;
}

.radio-option input:checked + .allow-radio::after {
    background: #22c55e;
    box-shadow: 0 0 10px rgba(34,197,94,.35);
}

.radio-option input:checked + .deny-radio {
    border-color: #ef4444;
}

.radio-option input:checked + .deny-radio::after {
    background: #ef4444;
    box-shadow: 0 0 10px rgba(239,68,68,.35);
}

.radio-option input:checked + .inherit-radio {
    border-color: #94a3b8;
}

.radio-option input:checked + .inherit-radio::after {
    background: #94a3b8;
}


/* =========================
   ANIMATION
   ========================= */

.permission-selected {
    background: rgba(201,162,39,.12) !important;
}


/* =========================
   ERRORS
   ========================= */

.role-error {
    display: flex;
    align-items: center;
    gap: 7px;

    margin-top: 7px;

    color: #ef4444;

    font-size: 12px;
}

.ability-error {
    padding: 12px 20px;
}


/* =========================
   ACTIONS
   ========================= */

.role-form-actions {
    display: flex;

    justify-content: flex-start;

    gap: 10px;

    margin-top: 24px;

    padding-top: 20px;

    border-top: 1px solid var(--border, #e5e7eb);
}

.role-btn {
    height: 44px;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    gap: 8px;

    padding: 0 22px;

    border-radius: 10px;

    font-size: 13px;
    font-weight: 800;

    cursor: pointer;

    text-decoration: none;

    transition: .2s ease;
}

.role-btn-save {
    border: 1px solid #b88b20;

    background: linear-gradient(
        135deg,
        #d6aa3b,
        #b98922
    );

    color: #fff;

    box-shadow:
        0 6px 16px rgba(184,139,32,.20);
}

.role-btn-save:hover {
    transform: translateY(-1px);

    box-shadow:
        0 8px 20px rgba(184,139,32,.28);
}

.role-btn-cancel {
    border: 1px solid var(--border, #e5e7eb);

    background: var(--surface, #fff);

    color: var(--text, #111827);
}

.role-btn-cancel:hover {
    border-color: #ef4444;
    color: #ef4444;
}


/* =========================
   DARK MODE
   ========================= */

[data-theme="dark"] .roles-page,
.dark .roles-page {

    --role-bg: #171c24;
}

[data-theme="dark"] .role-card,
.dark .role-card {
    box-shadow: 0 10px 35px rgba(0,0,0,.22);
}

[data-theme="dark"] .abilities-table thead,
.dark .abilities-table thead {
    background: #121720;
}

[data-theme="dark"] .abilities-table tbody tr,
.dark .abilities-table tbody tr {
    background: #181e27;
}

[data-theme="dark"] .abilities-table tbody tr:nth-child(even),
.dark .abilities-table tbody tr:nth-child(even) {
    background: #161b23;
}

[data-theme="dark"] .abilities-table tbody tr:hover,
.dark .abilities-table tbody tr:hover {
    background: rgba(201,162,39,.08);
}

[data-theme="dark"] .role-input,
.dark .role-input {
    background: #121720;
    border-color: #303846;
}

[data-theme="dark"] .role-input:focus,
.dark .role-input:focus {
    background: #151b24;
}

[data-theme="dark"] .custom-radio,
.dark .custom-radio {
    background: #121720;
    border-color: #414b5b;
}


/* =========================
   MOBILE
   ========================= */

@media (max-width: 768px) {

    .roles-page .roles-header {
        align-items: flex-start;
        flex-direction: column;
    }

    .roles-page .btn-back {
        width: 100%;
        justify-content: center;
    }

    .roles-page .header-title {
        font-size: 20px;
    }

    .role-form {
        padding: 16px;
    }

    .role-form-actions {
        flex-direction: column;
    }

    .role-btn {
        width: 100%;
    }

}

</style>

@endsection


@section('content')

<div class="roles-page">

    <div class="roles-header">

        <div class="roles-header-info">

            <div class="header-accent"></div>

            <div>
                <h1 class="header-title">
                    إنشاء دور جديد
                </h1>

                <div class="header-sub">
                    إنشاء دور وتحديد الصلاحيات الخاصة به
                </div>
            </div>

        </div>


        <a
            href="{{ route('admin.roles') }}"
            class="btn-back"
        >
            <i class="fas fa-arrow-right"></i>
            رجوع للأدوار
        </a>

    </div>


    @if ($errors->any())

        <div class="role-error"
             style="
                background: rgba(239,68,68,.08);
                border:1px solid rgba(239,68,68,.2);
                padding:12px 15px;
                border-radius:10px;
                margin-bottom:16px;
             ">

            <i class="fas fa-circle-exclamation"></i>

            <span>
                يرجى التأكد من البيانات المدخلة قبل المتابعة.
            </span>

        </div>

    @endif


    <div class="role-card">

        <div class="role-card-top">

            <i class="fas fa-shield-halved"></i>

            <span>
                بيانات الدور والصلاحيات
            </span>

        </div>


        <form
            action="{{ route('admin.roles.store') }}"
            method="POST"
        >

            @csrf

            @include('Admin.Roles._form')

        </form>

    </div>

</div>

@endsection