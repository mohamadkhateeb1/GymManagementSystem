@extends('Admin.layouts.app')

@section('title', 'إدارة الموظفين | Elite Club')

@section('styles')

    <style>
        .employees-wrapper {
            width: 100%;
            max-width: 1250px;
            margin: 0 auto;
            direction: rtl;
        }

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
            background: linear-gradient(180deg, var(--gold-light), var(--gold-dark));
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
            font-size: 17px;
        }

        html[data-theme="dark"] .employees-heading-icon {
            color: var(--gold-light);
        }

        .employees-title {
            color: var(--text);
            font-size: 21px;
            font-weight: 900;
            line-height: 1.2;
        }

        .employees-subtitle {
            margin-top: 5px;
            color: var(--text-soft);
            font-size: 12px;
            font-weight: 600;
        }

        .employees-actions {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .employees-btn {
            min-height: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 8px 14px;
            border-radius: 9px;
            font-family: 'Tajawal', sans-serif;
            font-size: 12px;
            font-weight: 700;
            white-space: nowrap;
            cursor: pointer;
            transition: transform .2s ease, box-shadow .2s ease, background .2s ease, border-color .2s ease;
        }

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

        .employees-btn-add {
            border: 1px solid var(--gold-dark);
            background: linear-gradient(135deg, var(--gold-light), var(--gold-dark));
            color: #fff;
            box-shadow: 0 5px 14px rgba(184, 146, 62, .12);
        }

        .employees-btn-add:hover {
            color: #fff;
            transform: translateY(-1px);
            box-shadow: 0 8px 18px rgba(184, 146, 62, .18);
        }

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
       🆕 FILTER BAR — نفس تصميم صفحات الأدمن التانية (اللاعبين، التقارير المالية)
       ========================================================= */

        .employees-filter-bar {
            padding: 18px 20px;
            margin-bottom: 18px;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 14px;
            box-shadow: var(--shadow-sm);
        }

        .employees-filter-form {
            display: grid;
            grid-template-columns: minmax(200px, 1.3fr) minmax(160px, 1fr) minmax(160px, 1fr) auto;
            gap: 13px;
            align-items: end;
        }

        .employees-field-label {
            display: block;
            margin-bottom: 7px;
            color: var(--text);
            font-size: 12px;
            font-weight: 700;
        }

        .employees-field-input {
            width: 100%;
            height: 43px;
            padding: 0 13px;
            border-radius: 9px;
            border: 1px solid var(--border);
            outline: none;
            background: var(--surface-2);
            color: var(--text);
            font-family: 'Tajawal', sans-serif;
            font-size: 12.5px;
            font-weight: 600;
            transition: all .2s ease;
        }

        .employees-field-input:hover {
            border-color: rgba(184, 146, 62, .35);
        }

        .employees-field-input:focus {
            border-color: var(--gold-dark);
            box-shadow: 0 0 0 3px rgba(184, 146, 62, .10);
        }

        .employees-filter-actions {
            display: flex;
            gap: 8px;
        }

        .employees-btn-apply {
            flex: 1;
            height: 43px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            border: 1px solid var(--gold-dark);
            background: linear-gradient(135deg, var(--gold-light), var(--gold-dark));
            color: #fff;
            border-radius: 9px;
            font-family: 'Tajawal', sans-serif;
            font-size: 12.5px;
            font-weight: 700;
            cursor: pointer;
            transition: all .2s ease;
        }

        .employees-btn-apply:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 15px rgba(184, 146, 62, .18);
        }

        .employees-btn-reset {
            flex: 1;
            height: 43px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 1px solid var(--border);
            background: var(--surface-2);
            color: var(--text-soft);
            border-radius: 9px;
            font-family: 'Tajawal', sans-serif;
            font-size: 12.5px;
            font-weight: 700;
            text-decoration: none;
            transition: all .2s ease;
        }

        .employees-btn-reset:hover {
            color: var(--gold-dark);
            border-color: rgba(184, 146, 62, .30);
            background: var(--surface-hover);
        }

        .employees-card {
            overflow: hidden;
            border: 1px solid var(--border);
            border-radius: 14px;
            background: var(--surface);
            box-shadow: var(--shadow-sm);
            transition: background .25s ease, border-color .25s ease;
        }

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
            font-size: 14px;
            font-weight: 800;
        }

        .employees-count {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 11px;
            border: 1px solid rgba(184, 146, 62, .17);
            border-radius: 99px;
            background: var(--sidebar-active);
            color: var(--gold-dark);
            font-size: 11px;
            font-weight: 700;
        }

        html[data-theme="dark"] .employees-count {
            color: var(--gold-light);
        }

        .employees-table-wrap {
            width: 100%;
            overflow-x: auto;
            scrollbar-width: thin;
            scrollbar-color: var(--border) transparent;
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

        .employees-table {
            width: 100%;
            min-width: 850px;
            border-collapse: separate;
            border-spacing: 0;
        }

        .employees-table thead th {
            height: 48px;
            padding: 0 18px;
            border-bottom: 1px solid var(--border);
            background: var(--surface-2);
            color: var(--text);
            font-size: 12px;
            font-weight: 800;
            text-align: right;
            white-space: nowrap;
        }

        .employees-table tbody td {
            padding: 14px 18px;
            border-bottom: 1px solid var(--border-soft);
            background: var(--surface);
            color: var(--text-soft);
            font-size: 12.5px;
            vertical-align: middle;
            transition: background .2s ease;
        }

        .employees-table tbody tr:last-child td {
            border-bottom: none;
        }

        .employees-table tbody tr:hover td {
            background: var(--surface-hover);
        }

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
            background: linear-gradient(135deg, var(--gold-light), var(--gold-dark));
            color: #fff;
            font-size: 13px;
            font-weight: 900;
            box-shadow: 0 4px 10px rgba(184, 146, 62, .12);
        }

        .employee-user-info {
            min-width: 0;
            display: flex;
            flex-direction: column;
        }

        .employee-name {
            color: var(--text);
            font-size: 12.5px;
            font-weight: 800;
            line-height: 1.3;
        }

        .employee-email {
            margin-top: 3px;
            color: var(--text-soft);
            font-size: 10.5px;
            font-weight: 500;
            direction: ltr;
            text-align: right;
            white-space: nowrap;
        }

        .employee-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            max-width: 190px;
            padding: 6px 10px;
            border-radius: 7px;
            font-size: 10.5px;
            font-weight: 700;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .employee-badge i {
            font-size: 9px;
        }

        .employee-specialization {
            border: 1px solid rgba(101, 125, 156, .16);
            background: var(--info-bg);
            color: var(--info);
        }

        .employee-role {
            border: 1px solid rgba(184, 146, 62, .18);
            background: var(--sidebar-active);
            color: var(--gold-dark);
        }

        html[data-theme="dark"] .employee-role {
            color: var(--gold-light);
        }

        .employee-muted {
            color: var(--text-soft);
            font-size: 11px;
            font-weight: 600;
        }

        .employee-actions {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            gap: 6px;
            flex-wrap: wrap;
        }

        .employee-action {
            min-height: 32px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            padding: 5px 10px;
            border-radius: 7px;
            font-family: 'Tajawal', sans-serif;
            font-size: 10.5px;
            font-weight: 700;
            cursor: pointer;
            transition: .2s ease;
        }

        .employee-action:hover {
            transform: translateY(-1px);
        }

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
            color: var(--text-soft);
            font-size: 22px;
        }

        .employees-empty-title {
            color: var(--text);
            font-size: 14px;
            font-weight: 800;
        }

        .employees-empty-text {
            margin-top: 5px;
            color: var(--text-soft);
            font-size: 11.5px;
            font-weight: 500;
        }

        @media (max-width: 1000px) {
            .employees-filter-form {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .employees-filter-actions {
                grid-column: 1 / -1;
            }
        }

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
                font-size: 18px;
            }

            .employees-subtitle {
                font-size: 11px;
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

            .employees-filter-form {
                grid-template-columns: 1fr;
            }

            .employees-card-header {
                padding: 0 14px;
            }

            .employees-count {
                font-size: 10px;
            }
        }
    </style>

@endsection

@section('content')

    <div class="employees-wrapper">

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


        {{-- ================= 🆕 FILTER BAR ================= --}}

        <div class="employees-filter-bar">
            <form action="{{ route('employees.index') }}" method="GET" class="employees-filter-form">

                <div>
                    <label class="employees-field-label">بحث بالاسم أو البريد</label>
                    <input type="text" name="search" class="employees-field-input" value="{{ request('search') }}"
                        placeholder="ابحث عن موظف...">
                </div>

                <div>
                    <label class="employees-field-label">التخصص</label>
                    <select name="specialization" class="employees-field-input">
                        <option value="">كل التخصصات</option>
                        @foreach ($specializations as $spec)
                            <option value="{{ $spec }}" {{ request('specialization') == $spec ? 'selected' : '' }}>
                                {{ $spec }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="employees-field-label">الدور</label>
                    <select name="role_id" class="employees-field-input">
                        <option value="">كل الأدوار</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}" {{ request('role_id') == $role->id ? 'selected' : '' }}>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="employees-filter-actions">
                    <button type="submit" class="employees-btn-apply">
                        <i class="fas fa-filter"></i> تطبيق
                    </button>
                    <a href="{{ route('employees.index') }}" class="employees-btn-reset">إلغاء</a>
                </div>

            </form>
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

                                <td>
                                    @if ($employee->specialization)
                                        <span class="employee-badge employee-specialization">
                                            <i class="fas fa-star"></i>
                                            {{ $employee->specialization }}
                                        </span>
                                    @else
                                        <span class="employee-muted">غير محدد</span>
                                    @endif
                                </td>

                                <td>
                                    @if ($employee->roles->first())
                                        <span class="employee-badge employee-role">
                                            <i class="fas fa-shield-halved"></i>
                                            {{ $employee->roles->first()->name }}
                                        </span>
                                    @else
                                        <span class="employee-muted">بلا دور</span>
                                    @endif
                                </td>

                                <td>
                                    <div class="employee-actions">
                                        <a href="{{ route('employees.show', $employee->id) }}"
                                            class="employee-action employee-show">
                                            <i class="fas fa-eye"></i> عرض
                                        </a>

                                        @can('employee.edit')
                                            <a href="{{ route('employees.edit', $employee->id) }}"
                                                class="employee-action employee-edit">
                                                <i class="fas fa-pen"></i> تعديل
                                            </a>
                                        @endcan

                                        @can('employee.delete')
                                            <form action="{{ route('employees.destroy', $employee->id) }}" method="POST"
                                                style="display:inline; margin:0;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="employee-action employee-delete"
                                                    onclick="return confirm('هل أنت متأكد من حذف هذا الموظف؟')">
                                                    <i class="fas fa-trash-can"></i> حذف
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
                                            @if (request()->hasAny(['search', 'specialization', 'role_id']))
                                                لا توجد نتائج مطابقة لبحثك
                                            @else
                                                لا يوجد موظفون حالياً
                                            @endif
                                        </div>
                                        <div class="employees-empty-text">
                                            @if (request()->hasAny(['search', 'specialization', 'role_id']))
                                                جرّب تعديل عوامل الفلترة أو إعادة تعيينها
                                            @else
                                                ابدأ بإضافة أول موظف من زر «إضافة موظف جديد»
                                            @endif
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
