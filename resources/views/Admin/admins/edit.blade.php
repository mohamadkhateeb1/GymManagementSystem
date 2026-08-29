@extends('Admin.layouts.app')

@section('title', 'تعديل المسؤول | Elite Club')

@section('styles')

    <style>
        /* =========================================================
       ADMIN EDIT PAGE
    ========================================================= */

        .admin-page {
            width: 100%;
            max-width: 1050px;
            margin: 0 auto;
            padding: 10px 0 40px;
            direction: rtl;
        }

        .admin-page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 22px;
        }

        .admin-page-header-main {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .admin-page-accent {
            width: 4px;
            height: 48px;
            border-radius: 10px;
            background: linear-gradient(180deg,
                    var(--gold, #c9a961),
                    rgba(201, 169, 97, .25));
        }

        .admin-page-title {
            margin: 0;
            color: var(--text, #f5f5f5);
            font-size: 24px;
            font-weight: 800;
        }

        .admin-page-subtitle {
            margin-top: 5px;
            color: var(--muted, #8d95a3);
            font-size: 13px;
        }

        .admin-back-btn {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            padding: 10px 16px;
            border-radius: 10px;
            text-decoration: none;
            color: var(--text, #f5f5f5);
            background: var(--surface, #1a202b);
            border: 1px solid var(--border, rgba(255, 255, 255, .09));
            transition: .2s ease;
        }

        .admin-back-btn:hover {
            color: var(--gold, #c9a961);
            border-color: rgba(201, 169, 97, .35);
        }

        .admin-form-card {
            background: var(--surface, #1a202b);
            border: 1px solid var(--border, rgba(255, 255, 255, .08));
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 18px 45px rgba(0, 0, 0, .12);
        }

        .admin-form-card-head {
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 20px 24px;
            border-bottom: 1px solid var(--border, rgba(255, 255, 255, .08));
            background: linear-gradient(135deg,
                    rgba(201, 169, 97, .08),
                    transparent);
        }

        .admin-form-card-icon {
            width: 42px;
            height: 42px;
            border-radius: 11px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gold, #c9a961);
            background: rgba(201, 169, 97, .10);
            border: 1px solid rgba(201, 169, 97, .22);
        }

        .admin-form-card-head h3 {
            margin: 0;
            color: var(--text, #f5f5f5);
            font-size: 16px;
            font-weight: 800;
        }

        .admin-form-card-head span {
            display: block;
            margin-top: 3px;
            color: var(--muted, #8d95a3);
            font-size: 12px;
        }


        /* FORM */

        .admin-form {
            padding: 25px;
        }

        .form-section {
            margin-bottom: 25px;
            padding: 22px;
            border: 1px solid var(--border, rgba(255, 255, 255, .08));
            border-radius: 15px;
            background: var(--surface-2, rgba(255, 255, 255, .018));
        }

        .form-section:last-child {
            margin-bottom: 0;
        }

        .section-title {
            display: flex;
            align-items: center;
            gap: 12px;
            padding-bottom: 17px;
            margin-bottom: 20px;
            border-bottom: 1px solid var(--border, rgba(255, 255, 255, .07));
        }

        .section-title-icon {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gold, #c9a961);
            background: rgba(201, 169, 97, .10);
            border: 1px solid rgba(201, 169, 97, .20);
        }

        .section-title h3 {
            margin: 0;
            color: var(--text, #f5f5f5);
            font-size: 15px;
        }

        .section-title span {
            display: block;
            margin-top: 4px;
            color: var(--muted, #8d95a3);
            font-size: 12px;
        }

        .fields-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 20px;
        }

        .field-group {
            margin-bottom: 20px;
        }

        .field-group>label {
            display: flex;
            align-items: center;
            gap: 7px;
            margin-bottom: 8px;
            color: var(--text, #e8e9eb);
            font-size: 13px;
            font-weight: 700;
        }

        .field-group>label i {
            color: var(--gold, #c9a961);
        }

        .field-wrap {
            position: relative;
            display: flex;
            align-items: center;
        }

        .field-icon {
            position: absolute;
            right: 15px;
            z-index: 2;
            color: var(--muted, #7e8795);
            pointer-events: none;
        }

        .field-wrap input {
            width: 100%;
            min-height: 46px;
            padding: 0 43px 0 48px;
            border-radius: 10px;
            border: 1px solid var(--border, rgba(255, 255, 255, .10));
            outline: none;
            background: var(--input-bg, #131923);
            color: var(--text, #f5f5f5);
            font-family: inherit;
            font-size: 13px;
            transition: .2s ease;
        }

        .field-wrap input:focus {
            border-color: rgba(201, 169, 97, .60);
            box-shadow: 0 0 0 3px rgba(201, 169, 97, .08);
        }

        .password-toggle {
            position: absolute;
            left: 10px;
            width: 32px;
            height: 32px;
            border: none;
            background: transparent;
            color: var(--muted, #7e8795);
            cursor: pointer;
        }

        .password-toggle:hover {
            color: var(--gold, #c9a961);
        }

        .field-hint {
            display: flex;
            align-items: center;
            gap: 7px;
            margin-top: 8px;
            color: var(--muted, #808998);
            font-size: 11.5px;
        }

        .field-hint i {
            color: var(--gold, #c9a961);
        }

        .field-error {
            display: flex;
            align-items: center;
            gap: 6px;
            margin-top: 7px;
            color: #f87171;
            font-size: 11.5px;
        }


        /* ROLES */

        .roles-container {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 10px;
        }

        .role-option {
            position: relative;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 13px 14px;
            border-radius: 11px;
            border: 1px solid var(--border, rgba(255, 255, 255, .08));
            background: var(--input-bg, #131923);
            cursor: pointer;
            transition: .2s ease;
        }

        .role-option:hover {
            border-color: rgba(201, 169, 97, .35);
        }

        .role-option input {
            position: absolute;
            opacity: 0;
        }

        .custom-checkbox {
            width: 21px;
            height: 21px;
            flex: 0 0 21px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid var(--border, rgba(255, 255, 255, .15));
            color: transparent;
        }

        .role-option input:checked+.custom-checkbox {
            background: var(--gold, #c9a961);
            border-color: var(--gold, #c9a961);
            color: #171a20;
        }

        .role-option:has(input:checked) {
            border-color: rgba(201, 169, 97, .45);
            background: rgba(201, 169, 97, .07);
        }

        .role-option-content {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .role-option-name {
            color: var(--text, #f1f1f1);
            font-size: 13px;
            font-weight: 700;
        }

        .role-option-name i {
            color: var(--gold, #c9a961);
        }

        .role-option-status {
            color: var(--muted, #7d8592);
            font-size: 10.5px;
        }

        .roles-empty {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 20px;
            border-radius: 12px;
            border: 1px dashed var(--border, rgba(255, 255, 255, .12));
            color: var(--muted, #8d95a3);
        }

        .roles-empty>i {
            color: var(--gold, #c9a961);
            font-size: 22px;
        }


        /* FOOTER */

        .admin-form-footer {
            display: flex;
            justify-content: flex-start;
            gap: 10px;
            padding: 18px 25px;
            border-top: 1px solid var(--border, rgba(255, 255, 255, .08));
            background: var(--surface-2, rgba(255, 255, 255, .015));
        }

        .admin-submit-btn,
        .admin-cancel-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-width: 145px;
            padding: 11px 18px;
            border-radius: 10px;
            font-family: inherit;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            text-decoration: none;
            transition: .2s ease;
        }

        .admin-submit-btn {
            border: 1px solid rgba(201, 169, 97, .55);
            color: #17191e;
            background: linear-gradient(135deg, #dfbd68, #bd9640);
        }

        .admin-submit-btn:hover {
            transform: translateY(-1px);
        }

        .admin-cancel-btn {
            color: var(--text, #e8e9eb);
            background: transparent;
            border: 1px solid var(--border, rgba(255, 255, 255, .10));
        }

        .admin-cancel-btn:hover {
            color: var(--gold, #c9a961);
        }


        /* LIGHT */

        [data-theme="light"] .admin-form-card,
        [data-theme="light"] .form-section {
            background: #fff;
        }

        [data-theme="light"] .field-wrap input,
        [data-theme="light"] .role-option {
            background: #f8f9fb;
            color: #20242b;
        }


        /* MOBILE */

        @media (max-width: 700px) {

            .admin-page {
                padding: 5px 12px 30px;
            }

            .admin-page-header {
                flex-direction: column;
                align-items: stretch;
            }

            .admin-page-title {
                font-size: 19px;
            }

            .admin-back-btn {
                justify-content: center;
            }

            .admin-form {
                padding: 15px;
            }

            .form-section {
                padding: 16px;
            }

            .fields-grid,
            .roles-container {
                grid-template-columns: 1fr;
            }

            .admin-form-footer {
                flex-direction: column;
            }

            .admin-submit-btn,
            .admin-cancel-btn {
                width: 100%;
            }
        }
    </style>
@endsection


@section('content')

    <div class="admin-page">

        <div class="admin-page-header">

            <div class="admin-page-header-main">

                <div class="admin-page-accent"></div>

                <div>

                    <h1 class="admin-page-title">
                        تعديل المسؤول
                    </h1>

                    <div class="admin-page-subtitle">
                        تحديث بيانات وصلاحيات المسؤول:
                        <strong>{{ $admin->name }}</strong>
                    </div>

                </div>

            </div>

            <a href="{{ route('admins.index') }}" class="admin-back-btn">
                <i class="fas fa-arrow-right"></i>
                رجوع للمسؤولين
            </a>

        </div>


        <div class="admin-form-card">

            <div class="admin-form-card-head">

                <div class="admin-form-card-icon">
                    <i class="fas fa-user-pen"></i>
                </div>

                <div>
                    <h3>تعديل بيانات المسؤول</h3>
                    <span>قم بتحديث المعلومات المطلوبة ثم احفظ التغييرات</span>
                </div>

            </div>


            <form action="{{ route('admins.update', $admin->id) }}" method="POST">

                @csrf
                @method('PUT')

                @include('Admin.admins._form', ['admin' => $admin])

                <div class="admin-form-footer">

                    <button type="submit" class="admin-submit-btn">
                        <i class="fas fa-floppy-disk"></i>
                        حفظ التعديلات
                    </button>

                    <a href="{{ route('admins.index') }}" class="admin-cancel-btn">
                        <i class="fas fa-xmark"></i>
                        إلغاء
                    </a>

                </div>

            </form>

        </div>

    </div>

@endsection
