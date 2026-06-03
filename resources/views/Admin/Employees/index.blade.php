<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إدارة الموظفين</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;900&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Cairo', sans-serif;
            background: #0d0f14;
            color: #e8eaf6;
            min-height: 100vh;
            padding: 48px 24px;
        }

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

        .header-title {
            font-size: 28px;
            font-weight: 900;
            color: #e8eaf6;
            letter-spacing: -0.5px;
        }

        .header-sub {
            font-size: 13px;
            color: #6b7280;
            margin-top: 3px;
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
            gap: 6px;
            padding: 10px 22px;
            border-radius: 10px;
            font-family: 'Cairo', sans-serif;
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: opacity .15s, transform .15s, box-shadow .15s;
        }

        .btn-primary-top {
            background: linear-gradient(135deg, #00d4aa, #34d399);
            color: #fff;
            box-shadow: 0 4px 18px rgba(0, 212, 170, 0.28);
        }

        .btn-primary-top:hover {
            opacity: .9;
            transform: translateY(-1px);
            box-shadow: 0 6px 24px rgba(0, 212, 170, 0.38);
        }

        .btn-danger-top {
            background: rgba(248, 113, 113, 0.1);
            color: #f87171;
            border: 1px solid rgba(248, 113, 113, 0.25);
        }

        .btn-danger-top:hover {
            background: rgba(248, 113, 113, 0.18);
            border-color: rgba(248, 113, 113, 0.4);
            transform: translateY(-1px);
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 6px;
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
            color: #e8eaf6;
            border-color: #3d4460;
            background: rgba(255, 255, 255, 0.04);
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
            background: rgba(0, 212, 170, 0.12);
            color: #34d399;
            border: 1px solid rgba(0, 212, 170, 0.2);
            font-size: 12px;
            font-weight: 700;
            padding: 4px 12px;
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
            animation: fadeUp 0.4s ease both;
        }

        tbody tr:nth-child(1) {
            animation-delay: 0.15s;
        }

        tbody tr:nth-child(2) {
            animation-delay: 0.20s;
        }

        tbody tr:nth-child(3) {
            animation-delay: 0.25s;
        }

        tbody tr:last-child {
            border-bottom: none;
        }

        tbody tr:hover {
            background: rgba(255, 255, 255, 0.03);
        }

        tbody td {
            padding: 16px 24px;
            font-size: 14px;
            color: #e8eaf6;
            text-align: right;
            vertical-align: middle;
        }

        .user-info {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .user-name {
            font-weight: 700;
            font-size: 14px;
            color: #e8eaf6;
        }

        .user-email {
            font-size: 12px;
            color: #6b7280;
        }

        .spec-badge {
            display: inline-block;
            background: rgba(108, 99, 255, 0.1);
            color: #a78bfa;
            border: 1px solid rgba(108, 99, 255, 0.2);
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
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
            padding: 8px 14px;
            border-radius: 8px;
            font-size: 12.5px;
            font-weight: 700;
            font-family: 'Cairo', sans-serif;
            cursor: pointer;
            border: none;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .btn-edit {
            background: rgba(234, 179, 8, 0.1);
            color: #fbbf24;
            border: 1px solid rgba(234, 179, 8, 0.2);
        }

        .btn-edit:hover {
            background: rgba(234, 179, 8, 0.18);
            border-color: rgba(234, 179, 8, 0.4);
            transform: translateY(-2px);
        }

        .btn-delete {
            background: rgba(248, 113, 113, 0.08);
            color: #f87171;
            border: 1px solid rgba(248, 113, 113, 0.18);
        }

        .btn-delete:hover {
            background: rgba(248, 113, 113, 0.15);
            border-color: rgba(248, 113, 113, 0.35);
            transform: translateY(-2px);
        }

        .empty {
            padding: 64px 24px;
            text-align: center;
            color: #6b7280;
        }

        .empty-icon {
            font-size: 48px;
            margin-bottom: 16px;
            opacity: 0.5;
        }

        .empty-title {
            font-size: 18px;
            font-weight: 700;
            color: #9ca3af;
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
</head>

<body>

    <div class="wrapper">

        <x-flash-message />

        <div class="header">
            <div>
                <div class="header-title">إدارة الموظفين والمدربين</div>
                <div class="header-sub">Employees & Coaches Management</div>
            </div>
            <div class="header-actions">
                <a href="{{ route('admin.dashboard') }}" class="btn-back">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
                    </svg>
                    العودة للوحة التحكم
                </a>

                @can('employee.delete')
                    <form action="{{ route('employees.destroy_all') }}" method="POST"
                        onsubmit="return confirm('هل أنت متأكد من حذف جميع الموظفين؟')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-top btn-danger-top">حذف الكل</button>
                    </form>
                @endcan

                @can('employee.create')
                    <a href="{{ route('employees.create') }}" class="btn-top btn-primary-top">
                        إضافة موظف جديد
                    </a>
                @endcan
            </div>
        </div>

        <div class="card">
            <div class="card-top">
                <span class="card-top-title">قائمة الموظفين</span>
                <span class="count-badge">{{ $employees->count() }} موظف</span>
            </div>

            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>الموظف</th>
                            <th>التخصص</th>
                            <th>الدور</th>
                            <th style="width:200px; text-align:left;">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($employees as $employee)
                            <tr>
                                <td>
                                    <div class="user-info">
                                        <span class="user-name">{{ $employee->username }}</span>
                                        <span class="user-email">{{ $employee->email }}</span>
                                    </div>
                                </td>
                                <td>
                                    @if ($employee->specialization)
                                        <span class="spec-badge">{{ $employee->specialization }}</span>
                                    @else
                                        <span style="color:#6b7280; font-size:13px;">غير محدد</span>
                                    @endif
                                </td>
                                <td>
                                    <span style="color:#e8eaf6; font-weight:600; font-size:13px;">
                                        {{ $employee->roles->first() ? $employee->roles->first()->name : 'بلا دور' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="actions">
                                        @can('employee.edit')
                                            <a href="{{ route('employees.edit', $employee->id) }}"
                                                class="btn-action btn-edit">
                                                ✏️ تعديل
                                            </a>
                                        @endcan
                                        @can('employee.delete')
                                            <form action="{{ route('employees.destroy', $employee->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-action btn-delete"
                                                    onclick="return confirm('هل أنت متأكد من حذف هذا الموظف؟')">
                                                    🗑 حذف
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
                                        <div class="empty-icon">👥</div>
                                        <div class="empty-title">لا يوجد موظفين حالياً</div>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</body>

</html>
