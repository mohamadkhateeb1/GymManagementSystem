@extends('Admin.layouts.app')

@section('title', 'إدارة الموظفين | Elite Club')

@section('styles')
    <style>
        .wrapper {
            max-width: 1000px;
            margin: 0 auto;
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 32px;
            animation: fadeUp 0.5s ease;
            flex-wrap: wrap;
            gap: 16px;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .header-accent {
            width: 5px;
            height: 48px;
            border-radius: 6px;
            background: linear-gradient(180deg, #34d399, #00a37f);
            box-shadow: 0 0 18px rgba(0, 212, 170, 0.5);
        }

        .header-title {
            font-size: 28px;
            font-weight: 900;
            color: #e8eaf6;
            letter-spacing: -0.5px;
            line-height: 1.15;
        }

        .header-sub {
            font-size: 13px;
            color: #6b7280;
            margin-top: 4px;
            letter-spacing: 0.5px;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        /* Top buttons */
        .btn-top {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 10px 22px;
            border-radius: 10px;
            font-family: 'Cairo', sans-serif;
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: all .2s ease;
        }

        .btn-primary-top {
            background: linear-gradient(135deg, #00d4aa, #34d399);
            color: #062b22;
            box-shadow: 0 4px 18px rgba(0, 212, 170, 0.28);
        }

        .btn-primary-top:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 26px rgba(0, 212, 170, 0.42);
        }

        .btn-danger-top {
            background: rgba(248, 113, 113, 0.1);
            color: #f87171;
            border: 1px solid rgba(248, 113, 113, 0.25);
        }

        .btn-danger-top:hover {
            background: #f87171;
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 8px 22px rgba(248, 113, 113, 0.35);
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 10px 16px;
            background: transparent;
            color: #9ca3af;
            border: 1px solid #252a38;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            transition: all .2s ease;
        }

        .btn-back:hover {
            color: #34d399;
            border-color: rgba(0, 212, 170, 0.4);
            background: rgba(0, 212, 170, 0.06);
        }

        .btn-back svg {
            width: 16px;
            height: 16px;
        }

        .card {
            background: #181c27;
            border-radius: 18px;
            border: 1px solid #252a38;
            box-shadow: 0 8px 40px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            animation: fadeUp 0.5s ease 0.1s both;
        }

        .card-top {
            padding: 18px 24px;
            border-bottom: 1px solid #252a38;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: rgba(255, 255, 255, 0.02);
        }

        .card-top-title {
            font-size: 15px;
            font-weight: 700;
            color: #e8eaf6;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .card-top-title::before {
            content: '';
            display: inline-block;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #00d4aa;
            box-shadow: 0 0 8px rgba(0, 212, 170, 0.6);
        }

        .count-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(0, 212, 170, 0.12);
            color: #34d399;
            border: 1px solid rgba(0, 212, 170, 0.2);
            font-size: 12px;
            font-weight: 700;
            padding: 5px 13px;
            border-radius: 20px;
        }

        .table-responsive {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 700px;
        }

        thead th {
            padding: 14px 24px;
            font-size: 12px;
            font-weight: 700;
            color: #9ca3af;
            text-transform: uppercase;
            letter-spacing: 0.7px;
            background: rgba(255, 255, 255, 0.02);
            border-bottom: 1px solid #252a38;
            text-align: right;
        }

        tbody tr {
            border-bottom: 1px solid #1e2233;
            transition: background 0.2s ease;
            animation: fadeUp 0.45s ease both;
        }

        tbody tr:last-child {
            border-bottom: none;
        }

        tbody tr:hover {
            background: rgba(0, 212, 170, 0.04);
        }

        tbody td {
            padding: 16px 24px;
            font-size: 14px;
            color: #e8eaf6;
            text-align: right;
            vertical-align: middle;
        }

        /* خلية الموظف: أفاتار + معلومات */
        .user-cell {
            display: flex;
            align-items: center;
            gap: 13px;
        }

        .avatar {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 16px;
            color: #062b22;
            background: linear-gradient(135deg, #34d399, #00a37f);
            box-shadow: 0 4px 14px rgba(0, 212, 170, 0.3);
        }

        .user-info {
            display: flex;
            flex-direction: column;
            gap: 3px;
            min-width: 0;
        }

        .user-name {
            font-weight: 700;
            font-size: 14px;
            color: #e8eaf6;
        }

        .user-email {
            font-size: 12px;
            color: #6b7280;
            direction: ltr;
            text-align: right;
        }

        .spec-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(108, 99, 255, 0.1);
            color: #a78bfa;
            border: 1px solid rgba(108, 99, 255, 0.2);
            padding: 5px 11px;
            border-radius: 7px;
            font-size: 12px;
            font-weight: 600;
        }

        .role-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(0, 212, 170, 0.08);
            color: #34d399;
            border: 1px solid rgba(0, 212, 170, 0.18);
            padding: 5px 11px;
            border-radius: 7px;
            font-size: 12.5px;
            font-weight: 700;
        }

        .muted {
            color: #6b7280;
            font-size: 13px;
        }

        .actions {
            display: flex;
            gap: 8px;
            justify-content: flex-end;
        }

        .btn-action {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 13px;
            border-radius: 8px;
            font-size: 12.5px;
            font-weight: 700;
            font-family: 'Cairo', sans-serif;
            cursor: pointer;
            border: 1px solid transparent;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .btn-action:hover {
            transform: translateY(-2px);
        }

        .btn-show {
            background: rgba(108, 99, 255, 0.1);
            color: #a78bfa;
            border-color: rgba(108, 99, 255, 0.22);
        }

        .btn-show:hover {
            background: #6c63ff;
            color: #fff;
            box-shadow: 0 6px 16px rgba(108, 99, 255, 0.35);
        }

        .btn-edit {
            background: rgba(234, 179, 8, 0.1);
            color: #fbbf24;
            border-color: rgba(234, 179, 8, 0.2);
        }

        .btn-edit:hover {
            background: #fbbf24;
            color: #2a2000;
            box-shadow: 0 6px 16px rgba(234, 179, 8, 0.3);
        }

        .btn-delete {
            background: rgba(248, 113, 113, 0.08);
            color: #f87171;
            border-color: rgba(248, 113, 113, 0.18);
        }

        .btn-delete:hover {
            background: #f87171;
            color: #fff;
            box-shadow: 0 6px 16px rgba(248, 113, 113, 0.35);
        }

        .empty {
            padding: 64px 24px;
            text-align: center;
            color: #6b7280;
        }

        .empty-icon {
            font-size: 46px;
            margin-bottom: 16px;
            color: rgba(0, 212, 170, 0.4);
        }

        .empty-title {
            font-size: 18px;
            font-weight: 700;
            color: #9ca3af;
            margin-bottom: 6px;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(14px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
@endsection

@section('content')
    <div class="wrapper">
        <div class="header">
            <div class="header-left">
                <div class="header-accent"></div>
                <div>
                    <div class="header-title">إدارة الموظفين والمدربين</div>
                    <div class="header-sub">Employees &amp; Coaches Management</div>
                </div>
            </div>
            <div class="header-actions">
                <a href="{{ route('admin.dashboard') }}" class="btn-back">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
                    </svg>
                    العودة للوحة التحكم
                </a>

                @can('employee.delete')
                    <form action="{{ route('employees.destroy_all') }}" method="POST"
                        onsubmit="return confirm('هل أنت متأكد من حذف جميع الموظفين؟')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-top btn-danger-top">
                            <i class="fas fa-trash-alt"></i> حذف الكل
                        </button>
                    </form>
                @endcan

                @can('employee.create')
                    <a href="{{ route('employees.create') }}" class="btn-top btn-primary-top">
                        <i class="fas fa-plus"></i> إضافة موظف جديد
                    </a>
                @endcan
            </div>
        </div>

        <div class="card">
            <div class="card-top">
                <span class="card-top-title">قائمة الموظفين</span>
                <span class="count-badge">
                    <i class="fas fa-user-tie"></i> {{ $employees->count() }} موظف
                </span>
            </div>

            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>الموظف</th>
                            <th>التخصص</th>
                            <th>الدور</th>
                            <th style="width:230px; text-align:left;">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($employees as $employee)
                            <tr style="animation-delay: {{ 0.1 + $loop->index * 0.05 }}s;">
                                <td>
                                    <div class="user-cell">
                                        <div class="avatar">{{ mb_strtoupper(mb_substr($employee->name, 0, 1)) }}</div>
                                        <div class="user-info">
                                            <span class="user-name">{{ $employee->name }}</span>
                                            <span class="user-email">{{ $employee->email }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @if ($employee->specialization)
                                        <span class="spec-badge">
                                            <i class="fas fa-star"></i> {{ $employee->specialization }}
                                        </span>
                                    @else
                                        <span class="muted">غير محدد</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($employee->roles->first())
                                        <span class="role-badge">
                                            <i class="fas fa-shield-halved"></i> {{ $employee->roles->first()->name }}
                                        </span>
                                    @else
                                        <span class="muted">بلا دور</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="actions">
                                        <a href="{{ route('employees.show', $employee->id) }}" class="btn-action btn-show">
                                            <i class="fas fa-eye"></i> عرض
                                        </a>
                                        @can('employee.edit')
                                            <a href="{{ route('employees.edit', $employee->id) }}" class="btn-action btn-edit">
                                                <i class="fas fa-edit"></i> تعديل
                                            </a>
                                        @endcan
                                        @can('employee.delete')
                                            <form action="{{ route('employees.destroy', $employee->id) }}" method="POST"
                                                style="display:inline; margin:0;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-action btn-delete"
                                                    onclick="return confirm('هل أنت متأكد من حذف هذا الموظف؟')">
                                                    <i class="fas fa-trash-alt"></i> حذف
                                                </button>
                                            </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">
                                    <div class="empty">
                                        <div class="empty-icon"><i class="fas fa-users-slash"></i></div>
                                        <div class="empty-title">لا يوجد موظفون حالياً</div>
                                        <div>ابدأ بإضافة أول موظف من زر «إضافة موظف جديد»</div>
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
