@extends('Admin.layouts.app')

@section('title', 'إدارة الأدوار | Elite Club')

@section('styles')
    <style>
        .wrapper {
            max-width: 860px;
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
            background: linear-gradient(135deg, #6c63ff, #818cf8);
            color: #fff;
            box-shadow: 0 4px 18px rgba(108, 99, 255, 0.35);
        }

        .btn-primary-top:hover {
            opacity: .9;
            transform: translateY(-1px);
            box-shadow: 0 6px 24px rgba(108, 99, 255, 0.45);
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
            background: #6c63ff;
            box-shadow: 0 0 8px rgba(108, 99, 255, 0.6);
        }

        .count-badge {
            background: rgba(108, 99, 255, 0.12);
            color: #a78bfa;
            border: 1px solid rgba(108, 99, 255, 0.2);
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
            min-width: 500px;
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

        /* حركات متتالية لظهور الصفوف */
        tbody tr:nth-child(1) {
            animation-delay: 0.15s;
        }

        tbody tr:nth-child(2) {
            animation-delay: 0.20s;
        }

        tbody tr:nth-child(3) {
            animation-delay: 0.25s;
        }

        tbody tr:nth-child(4) {
            animation-delay: 0.30s;
        }

        tbody tr:nth-child(5) {
            animation-delay: 0.35s;
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

        .id-pill {
            display: inline-block;
            background: #252a38;
            color: #9ca3af;
            font-size: 12px;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 8px;
            font-family: monospace;
        }

        .role-cell {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .role-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            flex-shrink: 0;
            box-shadow: 0 0 5px rgba(255, 255, 255, 0.2);
        }

        .role-name {
            font-weight: 600;
            font-size: 14px;
            color: #e8eaf6;
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

        .empty-sub {
            font-size: 14px;
            margin-top: 8px;
            color: #6b7280;
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

        @media (max-width: 600px) {
            .header {
                flex-direction: column;
                align-items: flex-start;
            }

            .header-actions {
                width: 100%;
                justify-content: space-between;
            }
        }
    </style>
@endsection

@section('content')
    <div class="wrapper">

        <div class="header">
            <div>
                <div class="header-title">إدارة الأدوار</div>
                <div class="header-sub">Roles Management</div>
            </div>
            <div class="header-actions">
            

                @can('role.delete')
                    <form action="{{ route('admin.roles.destroy_all') }}" method="POST"
                        onsubmit="return confirm('هل أنت متأكد من حذف جميع الأدوار؟ (لن يتم حذف دور المشرف الأساسي)')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-top btn-danger-top">حذف الكل</button>
                    </form>
                @endcan

                @can('role.create')
                    <a href="{{ route('admin.roles.create') }}" class="btn-top btn-primary-top">
                        إنشاء دور جديد
                    </a>
                @endcan
            </div>
        </div>

        <div class="card">
            <div class="card-top">
                <span class="card-top-title">جميع الأدوار</span>
                <span class="count-badge">{{ $roles->count() }} أدوار</span>
            </div>

            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th style="width:80px;">#</th>
                            <th>اسم الدور</th>
                            <th style="width:200px; text-align:left;">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($roles as $index => $role)
                            <tr>
                                <td><span class="id-pill">{{ $index + 1 }}</span></td>
                                <td>
                                    <div class="role-cell">
                                        <div class="role-dot" style="background: {{ $role->color ?? '#6c63ff' }};"></div>
                                        <span class="role-name">{{ $role->name }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="actions">
                                        @can('role.edit')
                                            <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn-action btn-edit">
                                                ✏️ تعديل
                                            </a>
                                        @endcan
                                        @can('role.delete')
                                            <form action="{{ route('admin.roles.delete', $role->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-action btn-delete"
                                                    onclick="return confirm('هل أنت متأكد من حذف هذا الدور؟')">
                                                    🗑 حذف
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
                                        <div class="empty-icon">🛡️</div>
                                        <div class="empty-title">لا توجد أدوار مسجلة حالياً</div>
                                        <div class="empty-sub">قم بالنقر على "إنشاء دور جديد" للبدء في توزيع الصلاحيات</div>
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
