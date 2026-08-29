@extends('Admin.layouts.app')

@section('title', 'إدارة الموظفين | Elite Club')

@section('styles')

<style>
/* =========================================================
   ELITE CLUB — EMPLOYEES INDEX
   ========================================================= */

.employees-wrapper {
    width: 100%;
    max-width: 1250px;

    margin: 0 auto;

    direction: rtl;
}


/* =========================================================
   PAGE HEADER
   ========================================================= */

.employees-header {
    display: flex;

    align-items: center;
    justify-content: space-between;

    gap: 20px;

    margin-bottom: 22px;
}

.employees-heading {
    display: flex;

    align-items: center;

    gap: 12px;

    min-width: 0;
}

.employees-heading-accent {
    width: 4px;
    height: 44px;

    flex: 0 0 4px;

    border-radius: 99px;

    background:
        linear-gradient(
            180deg,
            var(--gold-light),
            var(--gold-dark)
        );
}

.employees-heading-icon {
    width: 44px;
    height: 44px;

    flex: 0 0 44px;

    display: flex;

    align-items: center;
    justify-content: center;

    border: 1px solid rgba(184, 146, 62, .18);

    border-radius: 11px;

    background: var(--sidebar-active);

    color: var(--gold-dark);

    font-size: 16px;
}

html[data-theme="dark"]
.employees-heading-icon {
    color: var(--gold-light);
}

.employees-title {
    color: var(--text);

    font-size: 20px;

    font-weight: 900;

    line-height: 1.2;
}

.employees-subtitle {
    margin-top: 5px;

    color: var(--muted);

    font-size: 11px;
}


/* =========================================================
   ACTIONS
   ========================================================= */

.employees-actions {
    display: flex;

    align-items: center;

    gap: 8px;

    flex-wrap: wrap;
}

.employees-btn {
    min-height: 39px;

    display: inline-flex;

    align-items: center;

    justify-content: center;

    gap: 7px;

    padding: 8px 13px;

    border-radius: 9px;

    font-family: 'Tajawal', sans-serif;

    font-size: 10.5px;

    font-weight: 700;

    white-space: nowrap;

    cursor: pointer;

    transition:
        transform .2s ease,
        box-shadow .2s ease,
        background .2s ease,
        border-color .2s ease;
}


/* BACK */

.employees-btn-back {
    border: 1px solid var(--border);

    background: var(--surface);

    color: var(--text-soft);
}

.employees-btn-back:hover {
    color: var(--gold-dark);

    border-color: rgba(184, 146, 62, .30);

    background: var(--surface-hover);

    transform: translateY(-1px);
}


/* ADD */

.employees-btn-add {
    border: 1px solid var(--gold-dark);

    background:
        linear-gradient(
            135deg,
            var(--gold-light),
            var(--gold-dark)
        );

    color: #fff;

    box-shadow:
        0 5px 14px rgba(184, 146, 62, .12);
}

.employees-btn-add:hover {
    color: #fff;

    transform: translateY(-1px);

    box-shadow:
        0 8px 18px rgba(184, 146, 62, .18);
}


/* DELETE ALL */

.employees-btn-delete-all {
    border: 1px solid rgba(196, 93, 93, .22);

    background: var(--danger-bg);

    color: var(--danger);
}

.employees-btn-delete-all:hover {
    color: #fff;

    background: var(--danger);

    border-color: var(--danger);

    transform: translateY(-1px);
}


/* =========================================================
   CARD
   ========================================================= */

.employees-card {
    overflow: hidden;

    border: 1px solid var(--border);

    border-radius: 14px;

    background: var(--surface);

    box-shadow: var(--shadow-sm);

    transition:
        background .25s ease,
        border-color .25s ease;
}


/* =========================================================
   CARD HEADER
   ========================================================= */

.employees-card-header {
    min-height: 60px;

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 15px;

    padding: 0 20px;

    border-bottom: 1px solid var(--border-soft);

    background: var(--surface-2);
}

.employees-card-title {
    color: var(--text);

    font-size: 13px;

    font-weight: 800;
}

.employees-count {
    display: inline-flex;

    align-items: center;

    gap: 6px;

    padding: 6px 10px;

    border: 1px solid rgba(184, 146, 62, .17);

    border-radius: 99px;

    background: var(--sidebar-active);

    color: var(--gold-dark);

    font-size: 10px;

    font-weight: 700;
}

html[data-theme="dark"]
.employees-count {
    color: var(--gold-light);
}


/* =========================================================
   TABLE WRAPPER
   ========================================================= */

.employees-table-wrap {
    width: 100%;

    overflow-x: auto;

    scrollbar-width: thin;

    scrollbar-color:
        var(--border)
        transparent;
}

.employees-table-wrap::-webkit-scrollbar {
    height: 5px;
}

.employees-table-wrap::-webkit-scrollbar-track {
    background: transparent;
}

.employees-table-wrap::-webkit-scrollbar-thumb {
    background: var(--border);

    border-radius: 99px;
}


/* =========================================================
   TABLE
   ========================================================= */

.employees-table {
    width: 100%;

    min-width: 850px;

    border-collapse: separate;

    border-spacing: 0;
}


/* HEADER */

.employees-table thead th {
    height: 48px;

    padding: 0 18px;

    border-bottom: 1px solid var(--border);

    background: var(--surface-2);

    color: var(--muted);

    font-size: 10.5px;

    font-weight: 800;

    text-align: right;

    white-space: nowrap;
}


/* BODY */

.employees-table tbody td {
    padding: 14px 18px;

    border-bottom: 1px solid var(--border-soft);

    background: var(--surface);

    color: var(--text-soft);

    font-size: 11px;

    vertical-align: middle;

    transition:
        background .2s ease;
}

.employees-table tbody tr:last-child td {
    border-bottom: none;
}

.employees-table tbody tr:hover td {
    background: var(--surface-hover);
}


/* =========================================================
   USER
   ========================================================= */

.employee-user {
    display: flex;

    align-items: center;

    gap: 10px;

    min-width: 190px;
}

.employee-avatar {
    width: 38px;
    height: 38px;

    flex: 0 0 38px;

    display: flex;

    align-items: center;
    justify-content: center;

    border-radius: 50%;

    background:
        linear-gradient(
            135deg,
            var(--gold-light),
            var(--gold-dark)
        );

    color: #fff;

    font-size: 12px;

    font-weight: 900;

    box-shadow:
        0 4px 10px rgba(184, 146, 62, .12);
}

.employee-user-info {
    min-width: 0;

    display: flex;

    flex-direction: column;
}

.employee-name {
    color: var(--text);

    font-size: 11.5px;

    font-weight: 800;

    line-height: 1.3;
}

.employee-email {
    margin-top: 3px;

    color: var(--muted);

    font-size: 9.5px;

    direction: ltr;

    text-align: right;

    white-space: nowrap;
}


/* =========================================================
   BADGES
   ========================================================= */

.employee-badge {
    display: inline-flex;

    align-items: center;

    gap: 6px;

    max-width: 190px;

    padding: 6px 9px;

    border-radius: 7px;

    font-size: 9.5px;

    font-weight: 700;

    white-space: nowrap;

    overflow: hidden;

    text-overflow: ellipsis;
}

.employee-badge i {
    font-size: 8px;
}


/* SPECIALIZATION */

.employee-specialization {
    border: 1px solid rgba(101, 125, 156, .16);

    background: var(--info-bg);

    color: var(--info);
}


/* ROLE */

.employee-role {
    border: 1px solid rgba(184, 146, 62, .18);

    background: var(--sidebar-active);

    color: var(--gold-dark);
}

html[data-theme="dark"]
.employee-role {
    color: var(--gold-light);
}


/* MUTED */

.employee-muted {
    color: var(--muted);

    font-size: 10px;
}


/* =========================================================
   ACTIONS
   ========================================================= */

.employee-actions {
    display: flex;

    align-items: center;

    justify-content: flex-start;

    gap: 6px;

    flex-wrap: wrap;
}

.employee-action {
    min-height: 31px;

    display: inline-flex;

    align-items: center;

    justify-content: center;

    gap: 5px;

    padding: 5px 9px;

    border-radius: 7px;

    font-family: 'Tajawal', sans-serif;

    font-size: 9.5px;

    font-weight: 700;

    cursor: pointer;

    transition: .2s ease;
}

.employee-action:hover {
    transform: translateY(-1px);
}


/* SHOW */

.employee-show {
    border: 1px solid rgba(101, 125, 156, .20);

    background: var(--info-bg);

    color: var(--info);
}

.employee-show:hover {
    border-color: var(--info);

    background: var(--info);

    color: #fff;
}


/* EDIT */

.employee-edit {
    border: 1px solid rgba(184, 146, 62, .22);

    background: var(--sidebar-active);

    color: var(--gold-dark);
}

.employee-edit:hover {
    border-color: var(--gold-dark);

    background: var(--gold-dark);

    color: #fff;
}


/* DELETE */

.employee-delete {
    border: 1px solid rgba(196, 93, 93, .20);

    background: var(--danger-bg);

    color: var(--danger);
}

.employee-delete:hover {
    border-color: var(--danger);

    background: var(--danger);

    color: #fff;
}


/* =========================================================
   EMPTY
   ========================================================= */

.employees-empty {
    padding: 55px 20px;

    display: flex;

    flex-direction: column;

    align-items: center;

    justify-content: center;

    text-align: center;
}

.employees-empty-icon {
    width: 60px;
    height: 60px;

    display: flex;

    align-items: center;
    justify-content: center;

    margin-bottom: 13px;

    border-radius: 16px;

    background: var(--surface-3);

    color: var(--muted);

    font-size: 21px;
}

.employees-empty-title {
    color: var(--text);

    font-size: 13px;

    font-weight: 800;
}

.employees-empty-text {
    margin-top: 5px;

    color: var(--muted);

    font-size: 10.5px;
}


/* =========================================================
   MOBILE
   ========================================================= */

@media (max-width: 900px) {

    .employees-header {
        align-items: flex-start;

        flex-direction: column;
    }

    .employees-actions {
        width: 100%;
    }

    .employees-btn {
        flex: 1;
    }
}


@media (max-width: 576px) {

    .employees-title {
        font-size: 17px;
    }

    .employees-subtitle {
        font-size: 10px;
    }

    .employees-actions {
        display: grid;

        grid-template-columns: repeat(2, 1fr);
    }

    .employees-btn {
        width: 100%;
    }

    .employees-btn-add {
        grid-column: span 2;
    }

    .employees-card-header {
        padding: 0 14px;
    }

    .employees-count {
        font-size: 9px;
    }
}
</style>

@endsection

@section('content')

    <div class="employees-wrapper">

        ```
        {{-- ================= PAGE HEADER ================= --}}

        <div class="employees-header">

            <div class="employees-heading">

                <div class="employees-heading-accent"></div>

                <div class="employees-heading-icon">
                    <i class="fas fa-users-gear"></i>
                </div>

                <div>
                    <div class="employees-title">
                        إدارة الموظفين والمدربين
                    </div>

                    <div class="employees-subtitle">
                        إدارة فريق العمل والصلاحيات في نظام Elite Club
                    </div>
                </div>

            </div>


            <div class="employees-actions">

                <a href="{{ route('admin.dashboard') }}" class="employees-btn employees-btn-back">

                    <i class="fas fa-arrow-right"></i>
                    العودة للوحة التحكم

                </a>


                @can('employee.delete')
                    <form action="{{ route('employees.destroy_all') }}" method="POST" style="margin:0;"
                        onsubmit="return confirm('هل أنت متأكد من حذف جميع الموظفين؟')">

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="employees-btn employees-btn-delete-all">

                            <i class="fas fa-trash-can"></i>
                            حذف الكل

                        </button>

                    </form>
                @endcan


                @can('employee.create')
                    <a href="{{ route('employees.create') }}" class="employees-btn employees-btn-add">

                        <i class="fas fa-user-plus"></i>
                        إضافة موظف جديد

                    </a>
                @endcan

            </div>

        </div>


        {{-- ================= EMPLOYEES CARD ================= --}}

        <div class="employees-card">

            <div class="employees-card-header">

                <div class="employees-card-title">
                    قائمة الموظفين
                </div>

                <div class="employees-count">
                    <i class="fas fa-user-tie"></i>
                    {{ $employees->count() }} موظف
                </div>

            </div>


            <div class="employees-table-wrap">

                <table class="employees-table">

                    <thead>

                        <tr>

                            <th>الموظف</th>
                            <th>التخصص</th>
                            <th>الدور</th>
                            <th>الإجراءات</th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse ($employees as $employee)
                            <tr style="animation-delay: {{ 0.08 + $loop->index * 0.04 }}s;">

                                {{-- الموظف --}}

                                <td>

                                    <div class="employee-user">

                                        <div class="employee-avatar">
                                            {{ mb_strtoupper(mb_substr($employee->name, 0, 1)) }}
                                        </div>

                                        <div class="employee-user-info">

                                            <span class="employee-name">
                                                {{ $employee->name }}
                                            </span>

                                            <span class="employee-email">
                                                {{ $employee->email }}
                                            </span>

                                        </div>

                                    </div>

                                </td>


                                {{-- التخصص --}}

                                <td>

                                    @if ($employee->specialization)
                                        <span class="employee-badge employee-specialization">

                                            <i class="fas fa-star"></i>

                                            {{ $employee->specialization }}

                                        </span>
                                    @else
                                        <span class="employee-muted">
                                            غير محدد
                                        </span>
                                    @endif

                                </td>


                                {{-- الدور --}}

                                <td>

                                    @if ($employee->roles->first())
                                        <span class="employee-badge employee-role">

                                            <i class="fas fa-shield-halved"></i>

                                            {{ $employee->roles->first()->name }}

                                        </span>
                                    @else
                                        <span class="employee-muted">
                                            بلا دور
                                        </span>
                                    @endif

                                </td>


                                {{-- الإجراءات --}}

                                <td>

                                    <div class="employee-actions">

                                        <a href="{{ route('employees.show', $employee->id) }}"
                                            class="employee-action employee-show">

                                            <i class="fas fa-eye"></i>
                                            عرض

                                        </a>


                                        @can('employee.edit')
                                            <a href="{{ route('employees.edit', $employee->id) }}"
                                                class="employee-action employee-edit">

                                                <i class="fas fa-pen"></i>
                                                تعديل

                                            </a>
                                        @endcan


                                        @can('employee.delete')
                                            <form action="{{ route('employees.destroy', $employee->id) }}" method="POST"
                                                style="display:inline; margin:0;">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="employee-action employee-delete"
                                                    onclick="return confirm('هل أنت متأكد من حذف هذا الموظف؟')">

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

                                <td colspan="4">

                                    <div class="employees-empty">

                                        <div class="employees-empty-icon">
                                            <i class="fas fa-users-slash"></i>
                                        </div>

                                        <div class="employees-empty-title">
                                            لا يوجد موظفون حالياً
                                        </div>

                                        <div class="employees-empty-text">
                                            ابدأ بإضافة أول موظف من زر «إضافة موظف جديد»
                                        </div>

                                    </div>

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>
        ```

    </div>

@endsection
