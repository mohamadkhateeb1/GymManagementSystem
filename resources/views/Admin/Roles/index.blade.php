@extends('Admin.layouts.app')

@section('title', 'إدارة الأدوار | Elite Club')


@section('styles')

<style>

/* =========================================================
   ROLES MANAGEMENT
   ========================================================= */

.roles-management {
    width: 100%;

    direction: rtl;

    color: var(--text, #111827);
}

.roles-management * {
    box-sizing: border-box;
}


/* =========================
   HEADER
   ========================= */

.roles-management .roles-header {
    display: flex;

    align-items: center;
    justify-content: space-between;

    gap: 20px;

    margin-bottom: 22px;
}

.roles-management .header-info {
    display: flex;

    align-items: center;

    gap: 14px;
}

.roles-management .header-accent {
    width: 4px;
    height: 52px;

    border-radius: 10px;

    background: linear-gradient(
        to bottom,
        var(--gold, #c9a227),
        #e8c66a
    );

    box-shadow:
        0 0 18px rgba(201,162,39,.18);
}

.roles-management .header-title {
    margin: 0;

    color: var(--text, #111827);

    font-size: 24px;

    font-weight: 800;
}

.roles-management .header-sub {
    margin-top: 5px;

    color: var(--muted, #6b7280);

    font-size: 13px;
}


/* =========================
   HEADER ACTIONS
   ========================= */

.roles-management .header-actions {
    display: flex;

    align-items: center;

    gap: 9px;
}

.roles-management .btn-top {
    min-height: 42px;

    display: inline-flex;

    align-items: center;
    justify-content: center;

    gap: 7px;

    padding: 0 17px;

    border-radius: 10px;

    font-size: 12px;

    font-weight: 800;

    text-decoration: none;

    cursor: pointer;

    transition: .2s ease;
}

.roles-management .btn-primary-top {
    border: 1px solid #b88b20;

    background: linear-gradient(
        135deg,
        #d6aa3b,
        #b98922
    );

    color: #fff;

    box-shadow:
        0 6px 15px rgba(184,139,32,.18);
}

.roles-management .btn-primary-top:hover {
    transform: translateY(-1px);

    box-shadow:
        0 8px 20px rgba(184,139,32,.27);
}

.roles-management .btn-danger-top {
    border: 1px solid rgba(239,68,68,.25);

    background: rgba(239,68,68,.07);

    color: #ef4444;
}

.roles-management .btn-danger-top:hover {
    background: rgba(239,68,68,.12);
}


/* =========================
   MAIN CARD
   ========================= */

.roles-management .roles-card {
    overflow: hidden;

    background: var(--surface, #fff);

    border: 1px solid var(--border, #e5e7eb);

    border-radius: 18px;

    box-shadow:
        0 8px 30px rgba(0,0,0,.04);
}


/* =========================
   CARD TOP
   ========================= */

.roles-management .card-top {
    min-height: 64px;

    display: flex;

    align-items: center;

    justify-content: space-between;

    padding: 14px 22px;

    border-bottom: 1px solid var(--border, #e5e7eb);

    background:
        linear-gradient(
            90deg,
            rgba(201,162,39,.055),
            transparent
        );
}

.roles-management .card-title {
    display: flex;

    align-items: center;

    gap: 10px;

    color: var(--text, #111827);

    font-size: 15px;

    font-weight: 800;
}

.roles-management .card-title i {
    width: 34px;
    height: 34px;

    display: flex;

    align-items: center;
    justify-content: center;

    border-radius: 9px;

    background: rgba(201,162,39,.11);

    color: var(--gold, #c9a227);

    font-size: 13px;
}

.roles-management .count-badge {
    display: inline-flex;

    align-items: center;

    min-height: 28px;

    padding: 0 11px;

    border-radius: 20px;

    background: rgba(201,162,39,.10);

    border: 1px solid rgba(201,162,39,.18);

    color: var(--gold, #b88920);

    font-size: 11px;

    font-weight: 800;
}


/* =========================
   TABLE
   ========================= */

.roles-management .table-responsive {
    width: 100%;

    overflow-x: auto;
}

.roles-management table {
    width: 100%;

    min-width: 650px;

    border-collapse: collapse;

    border-spacing: 0;

    background: var(--surface, #fff);

    color: var(--text, #111827);
}


/* HEAD */

.roles-management table thead {
    background: var(--table-head, #f5f6f8);
}

.roles-management table thead tr {
    background: var(--table-head, #f5f6f8);
}

.roles-management table th {
    height: 56px;

    padding: 0 18px;

    border-bottom: 1px solid var(--border, #e5e7eb);

    color: var(--muted, #6b7280);

    font-size: 11px;

    font-weight: 800;

    white-space: nowrap;

    text-align: right;
}

.roles-management table th:last-child {
    text-align: left;
}


/* BODY */

.roles-management table tbody {
    background: var(--surface, #fff);
}

.roles-management table tbody tr {
    background: var(--surface, #fff);

    transition:
        background .18s ease,
        box-shadow .18s ease;
}

.roles-management table tbody tr:nth-child(even) {
    background: var(--table-row-alt, rgba(0,0,0,.018));
}

.roles-management table tbody tr:hover {
    background: rgba(201,162,39,.055);
}

.roles-management table td {
    height: 68px;

    padding: 10px 18px;

    border-bottom: 1px solid var(--border, #e5e7eb);

    color: var(--text, #111827);

    font-size: 13px;

    vertical-align: middle;
}


/* =========================
   ID
   ========================= */

.roles-management .id-pill {
    min-width: 32px;
    height: 28px;

    display: inline-flex;

    align-items: center;
    justify-content: center;

    padding: 0 9px;

    border-radius: 8px;

    background: var(--surface-2, #f3f4f6);

    border: 1px solid var(--border, #e5e7eb);

    color: var(--muted, #6b7280);

    font-size: 11px;

    font-weight: 800;
}


/* =========================
   ROLE CELL
   ========================= */

.roles-management .role-cell {
    display: flex;

    align-items: center;

    gap: 11px;
}

.roles-management .role-dot {
    width: 11px;
    height: 11px;

    flex-shrink: 0;

    border-radius: 50%;

    box-shadow:
        0 0 0 4px rgba(201,162,39,.06);
}

.roles-management .role-name {
    color: var(--text, #111827);

    font-size: 13px;

    font-weight: 800;
}


/* =========================
   ACTIONS
   ========================= */

.roles-management .actions {
    display: flex;

    align-items: center;

    justify-content: flex-start;

    gap: 7px;
}

.roles-management .btn-action {
    min-height: 34px;

    display: inline-flex;

    align-items: center;
    justify-content: center;

    gap: 5px;

    padding: 0 12px;

    border-radius: 8px;

    font-size: 11px;

    font-weight: 800;

    text-decoration: none;

    cursor: pointer;

    transition: .2s ease;
}


/* EDIT */

.roles-management .btn-edit {
    border: 1px solid rgba(201,162,39,.25);

    background: rgba(201,162,39,.08);

    color: var(--gold, #b88920);
}

.roles-management .btn-edit:hover {
    background: rgba(201,162,39,.15);

    border-color: rgba(201,162,39,.4);
}


/* DELETE */

.roles-management .btn-delete {
    border: 1px solid rgba(239,68,68,.22);

    background: rgba(239,68,68,.07);

    color: #ef4444;
}

.roles-management .btn-delete:hover {
    background: rgba(239,68,68,.13);

    border-color: rgba(239,68,68,.35);
}


/* =========================
   EMPTY
   ========================= */

.roles-management .empty {
    min-height: 270px;

    display: flex;

    flex-direction: column;

    align-items: center;
    justify-content: center;

    text-align: center;

    padding: 40px 20px;
}

.roles-management .empty-icon {
    width: 65px;
    height: 65px;

    display: flex;

    align-items: center;
    justify-content: center;

    margin-bottom: 15px;

    border-radius: 18px;

    background: rgba(201,162,39,.09);

    border: 1px solid rgba(201,162,39,.15);

    color: var(--gold, #c9a227);

    font-size: 27px;
}

.roles-management .empty-title {
    margin-bottom: 7px;

    color: var(--text, #111827);

    font-size: 14px;

    font-weight: 800;
}

.roles-management .empty-sub {
    max-width: 430px;

    color: var(--muted, #6b7280);

    font-size: 12px;

    line-height: 1.8;
}


/* =========================================================
   DARK MODE
   ========================================================= */

/*
|--------------------------------------------------------------------------
| مهم جداً
|--------------------------------------------------------------------------
| هنا نثبت ألوان الجدول بشكل صريح حتى لا يرث Bootstrap
| أو أي CSS آخر اللون الأبيض.
|--------------------------------------------------------------------------
*/

[data-theme="dark"] .roles-management table,
.dark .roles-management table {
    background: #171c24 !important;

    color: #f3f4f6 !important;
}

[data-theme="dark"] .roles-management table thead,
[data-theme="dark"] .roles-management table thead tr,
.dark .roles-management table thead,
.dark .roles-management table thead tr {
    background: #111720 !important;
}

[data-theme="dark"] .roles-management table tbody,
.dark .roles-management table tbody {
    background: #171c24 !important;
}

[data-theme="dark"] .roles-management table tbody tr,
.dark .roles-management table tbody tr {
    background: #171c24 !important;
}

[data-theme="dark"] .roles-management table tbody tr:nth-child(even),
.dark .roles-management table tbody tr:nth-child(even) {
    background: #151a22 !important;
}

[data-theme="dark"] .roles-management table tbody tr:hover,
.dark .roles-management table tbody tr:hover {
    background: #202733 !important;
}

[data-theme="dark"] .roles-management table th,
.dark .roles-management table th {
    color: #9ca8b8 !important;

    background: #111720 !important;

    border-color: #303846 !important;
}

[data-theme="dark"] .roles-management table td,
.dark .roles-management table td {
    color: #f3f4f6 !important;

    background: transparent !important;

    border-color: #2d3542 !important;
}

[data-theme="dark"] .roles-management .role-name,
.dark .roles-management .role-name {
    color: #f3f4f6 !important;
}

[data-theme="dark"] .roles-management .id-pill,
.dark .roles-management .id-pill {
    background: #202733 !important;

    border-color: #303846 !important;

    color: #9ca8b8 !important;
}

[data-theme="dark"] .roles-management .roles-card,
.dark .roles-management .roles-card {
    background: #171c24 !important;

    border-color: #303846 !important;
}

[data-theme="dark"] .roles-management .card-top,
.dark .roles-management .card-top {
    background:
        linear-gradient(
            90deg,
            rgba(201,162,39,.08),
            transparent
        );

    border-color: #303846 !important;
}

[data-theme="dark"] .roles-management .card-title,
.dark .roles-management .card-title {
    color: #f3f4f6 !important;
}


/* =========================
   MOBILE
   ========================= */

@media (max-width: 768px) {

    .roles-management .roles-header {
        flex-direction: column;

        align-items: flex-start;
    }

    .roles-management .header-actions {
        width: 100%;
    }

    .roles-management .btn-top {
        flex: 1;
    }

    .roles-management .header-title {
        font-size: 20px;
    }

    .roles-management .card-top {
        padding: 14px 16px;
    }

    .roles-management table {
        min-width: 600px;
    }

}

@media (max-width: 480px) {

    .roles-management .header-actions {
        flex-direction: column;
    }

    .roles-management .btn-top {
        width: 100%;
    }

}

</style>

@endsection


@section('content')

<div class="roles-management">

    {{-- =========================
         PAGE HEADER
    ========================== --}}

    <div class="roles-header">

        <div class="header-info">

            <div class="header-accent"></div>

            <div>

                <h1 class="header-title">
                    إدارة الأدوار
                </h1>

                <div class="header-sub">
                    إدارة أدوار النظام وتحديد صلاحيات الوصول
                </div>

            </div>

        </div>


        <div class="header-actions">

            @can('role.delete')

                <form
                    action="{{ route('admin.roles.destroy_all') }}"
                    method="POST"
                    onsubmit="return confirm('هل أنت متأكد من حذف جميع الأدوار؟ (لن يتم حذف دور المشرف الأساسي)')"
                >

                    @csrf
                    @method('DELETE')

                    <button
                        type="submit"
                        class="btn-top btn-danger-top"
                    >
                        <i class="fas fa-trash-can"></i>
                        حذف الكل
                    </button>

                </form>

            @endcan


            @can('role.create')

                <a
                    href="{{ route('admin.roles.create') }}"
                    class="btn-top btn-primary-top"
                >
                    <i class="fas fa-plus"></i>
                    إنشاء دور جديد
                </a>

            @endcan

        </div>

    </div>


    {{-- =========================
         CARD
    ========================== --}}

    <div class="roles-card">

        <div class="card-top">

            <div class="card-title">

                <div>
                    <i class="fas fa-shield-halved"></i>
                </div>

                <span>
                    جميع الأدوار
                </span>

            </div>


            <span class="count-badge">
                {{ $roles->count() }} أدوار
            </span>

        </div>


        {{-- =========================
             TABLE
        ========================== --}}

        <div class="table-responsive">

            <table>

                <thead>

                    <tr>

                        <th style="width:80px;">
                            #
                        </th>

                        <th>
                            اسم الدور
                        </th>

                        <th style="width:220px;">
                            الإجراءات
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse ($roles as $index => $role)

                        <tr>

                            <td>

                                <span class="id-pill">
                                    {{ $index + 1 }}
                                </span>

                            </td>


                            <td>

                                <div class="role-cell">

                                    <div
                                        class="role-dot"
                                        style="background: {{ $role->color ?? '#c9a227' }};"
                                    ></div>

                                    <span class="role-name">
                                        {{ $role->name }}
                                    </span>

                                </div>

                            </td>


                            <td>

                                <div class="actions">

                                    @can('role.edit')

                                        <a
                                            href="{{ route('admin.roles.edit', $role->id) }}"
                                            class="btn-action btn-edit"
                                        >
                                            <i class="fas fa-pen-to-square"></i>
                                            تعديل
                                        </a>

                                    @endcan


                                    @can('role.delete')

                                        <form
                                            action="{{ route('admin.roles.delete', $role->id) }}"
                                            method="POST"
                                            style="display:inline;"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn-action btn-delete"
                                                onclick="return confirm('هل أنت متأكد من حذف هذا الدور؟')"
                                            >
                                                <i class="fas fa-trash-can"></i>
                                                حذف
                                            </button>

                                        </form>

                                    @endcan

                                </div>

                            </td>

                        </tr>


                    @empty

                        <tr>

                            <td colspan="3">

                                <div class="empty">

                                    <div class="empty-icon">
                                        <i class="fas fa-shield-halved"></i>
                                    </div>

                                    <div class="empty-title">
                                        لا توجد أدوار مسجلة حالياً
                                    </div>

                                    <div class="empty-sub">
                                        قم بالنقر على "إنشاء دور جديد"
                                        للبدء في توزيع الصلاحيات على المستخدمين.
                                    </div>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection