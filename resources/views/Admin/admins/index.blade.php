@extends('Admin.layouts.app')

@section('title', 'قسم المسؤولين | Elite Club')

@section('styles')
    <style>
        .admins-wrapper {
            max-width: 1000px;
            margin: 0 auto;
        }

        /* ===== الهيدر ===== */
        .page-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 28px;
            flex-wrap: wrap;
            gap: 16px;
            animation: fadeUp .5s ease both;
        }

        .page-head-left {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .head-accent {
            width: 5px;
            height: 48px;
            border-radius: 6px;
            background: linear-gradient(180deg, #8b80ff, #6c63ff);
            box-shadow: 0 0 18px rgba(108, 99, 255, 0.5);
        }

        .head-title {
            font-size: 26px;
            font-weight: 900;
            color: #e8eaf6;
            line-height: 1.15;
        }

        .head-sub {
            font-size: 13px;
            color: #6b7280;
            margin-top: 4px;
            letter-spacing: .5px;
        }

        .head-actions {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        /* ===== أزرار علوية ===== */
        .btn-top {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 10px 22px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: all .2s ease;
        }

        .btn-primary-top {
            background: linear-gradient(135deg, #6c63ff, #8b80ff);
            color: #fff;
            box-shadow: 0 4px 18px rgba(108, 99, 255, 0.3);
        }

        .btn-primary-top:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 26px rgba(108, 99, 255, 0.45);
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

        /* ===== الكارد ===== */
        .card {
            background: #181c27;
            border-radius: 18px;
            box-shadow: 0 8px 40px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            border: 1px solid #252a38;
            animation: fadeUp .5s ease .1s both;
        }

        .card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 18px 28px;
            border-bottom: 1px solid #252a38;
            background: rgba(255, 255, 255, 0.02);
        }

        h3.card-title {
            font-size: 15px;
            font-weight: 700;
            color: #e8eaf6;
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 0;
        }

        h3.card-title::before {
            content: '';
            display: inline-block;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #6c63ff;
            box-shadow: 0 0 8px rgba(108, 99, 255, 0.6);
        }

        .count-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(108, 99, 255, 0.12);
            color: #a78bfa;
            border: 1px solid rgba(108, 99, 255, 0.22);
            font-size: 12px;
            font-weight: 700;
            padding: 5px 13px;
            border-radius: 20px;
        }

        .table-responsive {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 680px;
        }

        thead tr {
            background: rgba(255, 255, 255, 0.02);
            border-bottom: 1px solid #252a38;
        }

        th {
            padding: 13px 28px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .1em;
            text-transform: uppercase;
            color: #6b7280;
            text-align: right;
            white-space: nowrap;
        }

        tbody tr {
            border-bottom: 1px solid #1e2233;
            transition: background .15s;
            animation: fadeUp .45s ease both;
        }

        tbody tr:last-child {
            border-bottom: none;
        }

        tbody tr:hover {
            background: rgba(108, 99, 255, 0.05);
        }

        td {
            padding: 15px 28px;
            font-size: 14px;
            color: #e8eaf6;
            vertical-align: middle;
            white-space: nowrap;
            text-align: right;
        }

        .id-badge {
            font-family: 'JetBrains Mono', monospace;
            font-size: 12px;
            color: #7c83a3;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid #252a38;
            padding: 3px 9px;
            border-radius: 6px;
        }

        /* خلية الاسم: أفاتار + اسم */
        .admin-cell {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 11px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 15px;
            color: #fff;
            background: linear-gradient(135deg, #8b80ff, #6c63ff);
            box-shadow: 0 4px 14px rgba(108, 99, 255, 0.3);
        }

        .admin-name {
            font-weight: 700;
            color: #e8eaf6;
        }

        /* badges الأدوار */
        .roles-wrap {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
        }

        .role-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background: rgba(108, 99, 255, 0.1);
            color: #a78bfa;
            border: 1px solid rgba(108, 99, 255, 0.2);
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
        }

        .muted {
            color: #6b7280;
            font-size: 13px;
        }

        /* أزرار الجدول */
        .actions {
            display: flex;
            gap: 8px;
            justify-content: flex-start;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 14px;
            border-radius: 8px;
            font-size: 12.5px;
            font-weight: 700;
            border: 1px solid transparent;
            cursor: pointer;
            text-decoration: none;
            transition: all .2s ease;
        }

        .btn:hover {
            transform: translateY(-2px);
        }

        .btn-primary {
            background: rgba(108, 99, 255, 0.12);
            color: #a78bfa;
            border-color: rgba(108, 99, 255, 0.22);
        }

        .btn-primary:hover {
            background: #6c63ff;
            color: #fff;
            box-shadow: 0 6px 16px rgba(108, 99, 255, 0.35);
        }

        .btn-danger {
            background: rgba(248, 113, 113, 0.08);
            color: #f87171;
            border-color: rgba(248, 113, 113, 0.18);
        }

        .btn-danger:hover {
            background: #f87171;
            color: #fff;
            box-shadow: 0 6px 16px rgba(248, 113, 113, 0.35);
        }

        /* حالة فارغة */
        .empty {
            padding: 60px 24px;
            text-align: center;
            color: #6b7280;
        }

        .empty-icon {
            font-size: 44px;
            color: rgba(108, 99, 255, 0.4);
            margin-bottom: 14px;
        }

        .empty-title {
            font-size: 17px;
            font-weight: 700;
            color: #9ca3af;
        }

        form {
            margin: 0;
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
    @php $visibleAdmins = $admins->filter(fn ($a) => !$a->super_admin); @endphp

    <div class="admins-wrapper">
        <div class="page-head">
            <div class="page-head-left">
                <div class="head-accent"></div>
                <div>
                    <div class="head-title">قسم المسؤولين</div>
                    <div class="head-sub">Admins Management</div>
                </div>
            </div>

            <div class="head-actions">
                @can('admin.delete')
                    <form action="{{ route('admins.destroy_all') }}" method="POST"
                        onsubmit="return confirm('هل أنت متأكد من حذف جميع المسؤولين؟ (لن يتم حذف السوبر أدمن)')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-top btn-danger-top">
                            <i class="fas fa-trash-alt"></i> Delete All
                        </button>
                    </form>
                @endcan

                @can('admin.create')
                    <a href="{{ route('admins.create') }}" class="btn-top btn-primary-top">
                        <i class="fas fa-plus"></i> Create Admin
                    </a>
                @endcan
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Admins Table</h3>
                <span class="count-badge">
                    <i class="fas fa-user-shield"></i> {{ $visibleAdmins->count() }} admins
                </span>
            </div>

            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th style="width:70px;">ID</th>
                            <th>Name</th>
                            <th>Roles</th>
                            <th style="width:220px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($admins as $admin)
                            @if ($admin->super_admin)
                                @continue
                            @endif
                            <tr style="animation-delay: {{ 0.1 + $loop->index * 0.05 }}s;">
                                <td><span class="id-badge">#{{ $admin->id }}</span></td>
                                <td>
                                    <div class="admin-cell">
                                        <div class="avatar">{{ mb_strtoupper(mb_substr($admin->name, 0, 1)) }}</div>
                                        <span class="admin-name">{{ $admin->name }}</span>
                                    </div>
                                </td>
                                <td>
                                    @if ($admin->roles->isNotEmpty())
                                        <div class="roles-wrap">
                                            @foreach ($admin->roles as $role)
                                                <span class="role-badge">
                                                    <i class="fas fa-shield-halved"></i> {{ $role->name }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @else
                                        <span class="muted">No roles</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="actions">
                                        @can('admin.edit')
                                            <a href="{{ route('admins.edit', $admin->id) }}" class="btn btn-primary">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                        @endcan
                                        @can('admin.delete')
                                            <form action="{{ route('admins.destroy', $admin->id) }}" method="POST"
                                                onsubmit="return confirm('Delete this admin?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fas fa-trash-alt"></i> Delete
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
                                        <div class="empty-icon"><i class="fas fa-user-shield"></i></div>
                                        <div class="empty-title">No admins found</div>
                                    </div>
                                </td>
                            </tr>
                        @endforelse

                        @if ($admins->isNotEmpty() && $visibleAdmins->isEmpty())
                            <tr>
                                <td colspan="4">
                                    <div class="empty">
                                        <div class="empty-icon"><i class="fas fa-user-shield"></i></div>
                                        <div class="empty-title">No admins found</div>
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
