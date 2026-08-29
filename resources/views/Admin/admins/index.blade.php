@extends('Admin.layouts.app')

@section('title', 'إدارة المسؤولين | Elite Club')

@section('styles')

    <style>
        /* =========================================================
       ADMINS INDEX
    ========================================================= */

        .admins-page {
            width: 100%;
            direction: rtl;
        }


        /* ================= HEADER ================= */

        .admins-page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 22px;
        }

        .admins-header-main {
            display: flex;
            align-items: center;
            gap: 13px;
        }

        .admins-header-accent {
            width: 4px;
            height: 48px;
            border-radius: 10px;
            background: linear-gradient(180deg,
                    var(--gold, #c9a961),
                    rgba(201, 169, 97, .20));
        }

        .admins-title {
            margin: 0;
            color: var(--text, #f5f5f5);
            font-size: 24px;
            font-weight: 800;
        }

        .admins-subtitle {
            display: block;
            margin-top: 5px;
            color: var(--muted, #8d95a3);
            font-size: 12px;
        }


        /* ================= ACTIONS ================= */

        .admins-header-actions {
            display: flex;
            align-items: center;
            gap: 9px;
        }

        .admins-header-actions form {
            margin: 0;
        }

        .admin-top-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: 40px;
            padding: 0 15px;
            border-radius: 10px;
            text-decoration: none;
            font-family: inherit;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
            transition: .2s ease;
        }

        .admin-create-btn {
            color: #17191e;
            background: linear-gradient(135deg,
                    #dfbd68,
                    #bd9640);
            border: 1px solid rgba(201, 169, 97, .45);
            box-shadow: 0 6px 18px rgba(201, 169, 97, .10);
        }

        .admin-create-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 9px 23px rgba(201, 169, 97, .18);
        }

        .admin-delete-all {
            color: #ef7b82;
            background: rgba(239, 107, 115, .07);
            border: 1px solid rgba(239, 107, 115, .25);
        }

        .admin-delete-all:hover {
            background: rgba(239, 107, 115, .12);
            border-color: rgba(239, 107, 115, .40);
        }


        /* ================= CARD ================= */

        .admins-card {
            overflow: hidden;
            border-radius: 17px;
            background: var(--surface, #1a202b);
            border: 1px solid var(--border, rgba(255, 255, 255, .08));
            box-shadow: 0 18px 45px rgba(0, 0, 0, .10);
        }


        /* ================= CARD HEADER ================= */

        .admins-card-header {
            min-height: 67px;
            padding: 0 22px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            border-bottom: 1px solid var(--border, rgba(255, 255, 255, .08));
            background: linear-gradient(135deg,
                    rgba(201, 169, 97, .055),
                    transparent);
        }

        .admins-card-title {
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--text, #f5f5f5);
            font-size: 14px;
            font-weight: 800;
        }

        .admins-card-title i {
            color: var(--gold, #c9a961);
        }

        .admins-count {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 6px 11px;
            border-radius: 20px;
            color: var(--gold, #c9a961);
            background: rgba(201, 169, 97, .08);
            border: 1px solid rgba(201, 169, 97, .18);
            font-size: 11px;
            font-weight: 700;
        }


        /* ================= TABLE ================= */

        .admins-table-wrap {
            width: 100%;
            overflow-x: auto;
        }

        .admins-table {
            width: 100%;
            min-width: 750px;
            border-collapse: collapse;
            border-spacing: 0;
        }


        /* HEAD */

        .admins-table thead {
            background: var(--table-head, #151b25);
        }

        .admins-table th {
            height: 54px;
            padding: 0 20px;
            text-align: right;
            white-space: nowrap;
            color: var(--muted, #8d95a3);
            border-bottom: 1px solid var(--border, rgba(255, 255, 255, .09));
            font-size: 11px;
            font-weight: 800;
        }

        .admins-table th:first-child {
            padding-right: 24px;
        }

        .admins-table th:last-child {
            text-align: left;
            padding-left: 24px;
        }


        /* BODY */

        .admins-table tbody tr {
            transition: background .18s ease;
            border-bottom: 1px solid var(--border, rgba(255, 255, 255, .055));
        }

        .admins-table tbody tr:last-child {
            border-bottom: none;
        }

        .admins-table tbody tr:hover {
            background: rgba(201, 169, 97, .025);
        }

        .admins-table td {
            height: 72px;
            padding: 10px 20px;
            color: var(--text, #e8e9eb);
            font-size: 12px;
            vertical-align: middle;
        }

        .admins-table td:first-child {
            padding-right: 24px;
        }

        .admins-table td:last-child {
            padding-left: 24px;
        }


        /* ================= ID ================= */

        .admin-id {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 43px;
            height: 27px;
            padding: 0 8px;
            border-radius: 7px;
            color: var(--muted, #9ba3af);
            background: rgba(255, 255, 255, .035);
            border: 1px solid var(--border, rgba(255, 255, 255, .07));
            font-family: monospace;
            font-size: 11px;
        }


        /* ================= ADMIN CELL ================= */

        .admin-info {
            display: flex;
            align-items: center;
            gap: 11px;
        }

        .admin-avatar {
            width: 39px;
            height: 39px;
            flex: 0 0 39px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 11px;
            color: var(--gold, #c9a961);
            background: linear-gradient(135deg,
                    rgba(201, 169, 97, .18),
                    rgba(201, 169, 97, .05));
            border: 1px solid rgba(201, 169, 97, .22);
            font-size: 15px;
            font-weight: 800;
        }

        .admin-name {
            color: var(--text, #f1f1f1);
            font-weight: 700;
        }


        /* ================= ROLES ================= */

        .admin-roles {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
        }

        .admin-role {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 5px 9px;
            border-radius: 7px;
            color: var(--gold, #c9a961);
            background: rgba(201, 169, 97, .065);
            border: 1px solid rgba(201, 169, 97, .16);
            white-space: nowrap;
            font-size: 10.5px;
            font-weight: 700;
        }

        .admin-role i {
            font-size: 9px;
        }

        .no-role {
            color: var(--muted, #7d8592);
            font-size: 11px;
        }


        /* ================= ACTIONS ================= */

        .admin-row-actions {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 7px;
        }

        .admin-action {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            min-height: 32px;
            padding: 0 10px;
            border-radius: 8px;
            font-family: inherit;
            font-size: 10.5px;
            font-weight: 700;
            text-decoration: none;
            cursor: pointer;
            transition: .18s ease;
        }

        .admin-edit-action {
            color: #79aef7;
            background: rgba(96, 165, 250, .07);
            border: 1px solid rgba(96, 165, 250, .18);
        }

        .admin-edit-action:hover {
            color: #fff;
            background: rgba(96, 165, 250, .16);
        }

        .admin-delete-action {
            color: #ef777e;
            background: rgba(239, 107, 115, .06);
            border: 1px solid rgba(239, 107, 115, .18);
        }

        .admin-delete-action:hover {
            color: #fff;
            background: rgba(239, 107, 115, .14);
        }

        .admin-row-actions form {
            margin: 0;
        }


        /* ================= EMPTY ================= */

        .admin-empty {
            padding: 70px 25px;
            text-align: center;
        }

        .admin-empty-icon {
            width: 65px;
            height: 65px;
            margin: 0 auto 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 18px;
            color: var(--gold, #c9a961);
            background: rgba(201, 169, 97, .07);
            border: 1px solid rgba(201, 169, 97, .15);
            font-size: 25px;
        }

        .admin-empty-title {
            color: var(--text, #f1f1f1);
            font-size: 14px;
            font-weight: 800;
        }

        .admin-empty-subtitle {
            margin-top: 6px;
            color: var(--muted, #7e8795);
            font-size: 11px;
        }


        /* ================= LIGHT MODE ================= */

        [data-theme="light"] .admins-card {
            background: #fff;
            border-color: #e4e7eb;
        }

        [data-theme="light"] .admins-table thead {
            background: #f5f6f8;
        }

        [data-theme="light"] .admins-table tbody tr:hover {
            background: rgba(201, 169, 97, .035);
        }

        [data-theme="light"] .admins-table tbody tr {
            border-bottom-color: #eceef1;
        }

        [data-theme="light"] .admin-id {
            background: #f6f7f9;
            border-color: #e5e7eb;
        }

        [data-theme="light"] .admins-card-header {
            border-bottom-color: #e4e7eb;
        }


        /* ================= RESPONSIVE ================= */

        @media (max-width: 750px) {

            .admins-page-header {
                flex-direction: column;
                align-items: stretch;
            }

            .admins-header-actions {
                width: 100%;
            }

            .admin-top-btn {
                flex: 1;
            }

            .admins-card-header {
                padding: 0 15px;
            }

            .admins-table {
                min-width: 680px;
            }

        }

        @media (max-width: 480px) {

            .admins-header-actions {
                flex-direction: column;
            }

            .admin-top-btn {
                width: 100%;
            }

        }
    </style>
@endsection


@section('content')

    @php
        $visibleAdmins = $admins->filter(fn($a) => !$a->super_admin);
    @endphp


    <div class="admins-page">

        {{-- ================= PAGE HEADER ================= --}}

        <div class="admins-page-header">

            <div class="admins-header-main">

                <div class="admins-header-accent"></div>

                <div>

                    <h1 class="admins-title">
                        قسم المسؤولين
                    </h1>

                    <span class="admins-subtitle">
                        إدارة حسابات المسؤولين والأدوار والصلاحيات
                    </span>

                </div>

            </div>


            <div class="admins-header-actions">

                @can('admin.delete')
                    <form action="{{ route('admins.destroy_all') }}" method="POST"
                        onsubmit="return confirm('هل أنت متأكد من حذف جميع المسؤولين؟ (لن يتم حذف السوبر أدمن)')">

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="admin-top-btn admin-delete-all">
                            <i class="fas fa-trash-alt"></i>
                            حذف الكل
                        </button>

                    </form>
                @endcan


                @can('admin.create')
                    <a href="{{ route('admins.create') }}" class="admin-top-btn admin-create-btn">
                        <i class="fas fa-plus"></i>
                        إضافة مسؤول
                    </a>
                @endcan

            </div>

        </div>


        {{-- ================= TABLE CARD ================= --}}

        <div class="admins-card">

            <div class="admins-card-header">

                <div class="admins-card-title">
                    <i class="fas fa-user-shield"></i>
                    قائمة المسؤولين
                </div>

                <span class="admins-count">
                    <i class="fas fa-users"></i>
                    {{ $visibleAdmins->count() }} مسؤول
                </span>

            </div>


            <div class="admins-table-wrap">

                <table class="admins-table">

                    <thead>

                        <tr>

                            <th style="width: 80px;">
                                ID
                            </th>

                            <th>
                                المسؤول
                            </th>

                            <th>
                                الأدوار
                            </th>

                            <th style="width: 220px;">
                                الإجراءات
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse ($admins as $admin)

                            @if ($admin->super_admin)
                                @continue
                            @endif


                            <tr>

                                {{-- ID --}}
                                <td>

                                    <span class="admin-id">
                                        #{{ $admin->id }}
                                    </span>

                                </td>


                                {{-- ADMIN --}}
                                <td>

                                    <div class="admin-info">

                                        <div class="admin-avatar">
                                            {{ mb_strtoupper(mb_substr($admin->name, 0, 1)) }}
                                        </div>

                                        <span class="admin-name">
                                            {{ $admin->name }}
                                        </span>

                                    </div>

                                </td>


                                {{-- ROLES --}}
                                <td>

                                    @if ($admin->roles->isNotEmpty())
                                        <div class="admin-roles">

                                            @foreach ($admin->roles as $role)
                                                <span class="admin-role">

                                                    <i class="fas fa-shield-halved"></i>

                                                    {{ $role->name }}

                                                </span>
                                            @endforeach

                                        </div>
                                    @else
                                        <span class="no-role">
                                            لا توجد أدوار
                                        </span>
                                    @endif

                                </td>


                                {{-- ACTIONS --}}
                                <td>

                                    <div class="admin-row-actions">

                                        @can('admin.edit')
                                            <a href="{{ route('admins.edit', $admin->id) }}"
                                                class="admin-action admin-edit-action">
                                                <i class="fas fa-pen"></i>
                                                تعديل
                                            </a>
                                        @endcan


                                        @can('admin.delete')
                                            <form action="{{ route('admins.destroy', $admin->id) }}" method="POST"
                                                onsubmit="return confirm('هل أنت متأكد من حذف هذا المسؤول؟')">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="admin-action admin-delete-action">
                                                    <i class="fas fa-trash"></i>
                                                    حذف
                                                </button>

                                            </form>
                                        @endcan

                                    </div>

                                </td>

                            </tr>


                        @empty

                            <tr>

                                <td colspan="4">

                                    <div class="admin-empty">

                                        <div class="admin-empty-icon">
                                            <i class="fas fa-user-shield"></i>
                                        </div>

                                        <div class="admin-empty-title">
                                            لا يوجد مسؤولون حالياً
                                        </div>

                                        <div class="admin-empty-subtitle">
                                            قم بإضافة مسؤول جديد للبدء بإدارة الحسابات والصلاحيات.
                                        </div>

                                    </div>

                                </td>

                            </tr>

                        @endforelse


                        {{-- فقط Super Admin موجود --}}
                        @if ($admins->isNotEmpty() && $visibleAdmins->isEmpty())
                            <tr>

                                <td colspan="4">

                                    <div class="admin-empty">

                                        <div class="admin-empty-icon">
                                            <i class="fas fa-user-shield"></i>
                                        </div>

                                        <div class="admin-empty-title">
                                            لا يوجد مسؤولون إضافيون
                                        </div>

                                        <div class="admin-empty-subtitle">
                                            حساب الـ Super Admin محمي ولا يظهر ضمن قائمة المسؤولين.
                                        </div>

                                    </div>

                                </td>

                            </tr>
                        @endif

                    </tbody>

                </table>

            </div>

        </div>

    </div>

@endsection
