@extends('Admin.layouts.app')

@section('title', 'إدارة اللاعبين | Elite Club')

@section('styles')
    <style>
        /* ===== الهيدر ===== */
        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 32px;
            flex-wrap: wrap;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .header-accent {
            width: 5px;
            height: 46px;
            border-radius: 6px;
            background: linear-gradient(180deg, var(--accent), #8a6d2f);
            box-shadow: 0 0 18px rgba(201, 169, 97, 0.5);
        }

        .header-title {
            font-size: 26px;
            font-weight: 800;
            color: #fff;
            margin-bottom: 6px;
        }

        .count-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 3px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            color: var(--accent);
            background: rgba(201, 169, 97, 0.1);
            border: 1px solid rgba(201, 169, 97, 0.25);
        }

        /* ===== الكارد والجدول ===== */
        .card {
            background: rgba(16, 19, 28, 0.65);
            backdrop-filter: blur(14px);
            border: 1px solid rgba(201, 169, 97, 0.18);
            border-radius: 20px;
            padding: 22px;
            overflow-x: auto;
        }

        .table {
            width: 100%;
            min-width: 640px;
            border-collapse: separate;
            border-spacing: 0 12px;
        }

        .table th {
            padding: 16px;
            font-size: 11px;
            letter-spacing: 0.5px;
            color: var(--accent);
            text-transform: uppercase;
            text-align: right;
        }

        .table td {
            padding: 16px;
            background: rgba(0, 0, 0, 0.22);
            color: #e8e6e1;
            font-size: 14px;
            vertical-align: middle;
        }

        /* تدوير حواف أول وآخر خلية بالصف */
        .table td:first-child {
            border-top-right-radius: 12px;
            border-bottom-right-radius: 12px;
        }

        .table td:last-child {
            border-top-left-radius: 12px;
            border-bottom-left-radius: 12px;
        }

        .table tbody tr {
            transition: 0.25s ease;
        }

        .table tbody tr:hover td {
            background: rgba(201, 169, 97, 0.06);
        }

        .player-cell {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .avatar {
            width: 42px;
            height: 42px;
            flex-shrink: 0;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            background: linear-gradient(135deg, var(--accent), #d9bd7c);
            color: #1a1305;
        }

        .status-chip {
            display: inline-flex;
            align-items: center;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            white-space: nowrap;
        }

        .status-chip.active {
            background: rgba(90, 156, 122, 0.15);
            color: #5a9c7a;
        }

        .status-chip.expired {
            background: rgba(197, 90, 90, 0.15);
            color: #c55a5a;
        }

        .status-chip.none {
            background: rgba(128, 128, 128, 0.1);
            color: #9ca3af;
        }

        /* ===== أزرار الهيدر ===== */
        .actions-wrapper {
            display: flex;
            gap: 12px;
        }

        .actions-wrapper form {
            margin: 0;
        }

        .btn-header {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 11px 20px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: 0.3s ease;
        }

        .btn-header:hover {
            transform: translateY(-2px);
            filter: brightness(1.08);
        }

        .btn-add {
            background: linear-gradient(135deg, var(--accent), #d9bd7c);
            color: #1a1305;
            box-shadow: 0 6px 18px rgba(201, 169, 97, 0.25);
        }

        .btn-danger {
            background: rgba(239, 68, 68, 0.08);
            color: #ef4444;
            border: 1px solid rgba(239, 68, 68, 0.3);
        }

        .btn-danger:hover {
            background: rgba(239, 68, 68, 0.16);
        }

        /* ===== أزرار الإجراءات داخل الجدول ===== */
        .action-group {
            display: flex;
            align-items: center;
            gap: 6px;
            flex-wrap: wrap;
        }

        .action-group form {
            margin: 0;
            display: inline-flex;
        }

        .btn-action {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            height: 32px;
            padding: 0 14px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 600;
            line-height: 1;
            text-decoration: none;
            border: 1px solid transparent;
            cursor: pointer;
            transition: 0.2s ease;
        }

        .btn-action:hover {
            transform: translateY(-1px);
        }

        .btn-edit {
            background: rgba(201, 169, 97, 0.1);
            color: var(--accent);
        }

        .btn-edit:hover {
            background: rgba(201, 169, 97, 0.2);
        }

        .btn-show {
            background: rgba(108, 99, 255, 0.1);
            color: #818cf8;
        }

        .btn-show:hover {
            background: rgba(108, 99, 255, 0.2);
        }

        .btn-delete {
            background: rgba(239, 68, 68, 0.1);
            color: #ef4444;
        }

        .btn-delete:hover {
            background: rgba(239, 68, 68, 0.2);
        }

        .btn-renew {
            background: rgba(90, 156, 122, 0.1);
            color: #5a9c7a;
        }

        .btn-renew:hover {
            background: rgba(90, 156, 122, 0.2);
        }

        .empty-row td {
            text-align: center;
            padding: 40px;
            color: #9ca3af;
        }

        /* ===== موبايل ===== */
        @media (max-width: 600px) {
            .header {
                align-items: flex-start;
            }

            .actions-wrapper {
                width: 100%;
            }

            .btn-header {
                flex: 1;
                justify-content: center;
            }
        }
    </style>
@endsection

@section('content')
    <div class="header">
        <div class="header-left">
            <div class="header-accent"></div>
            <div>
                <div class="header-title">سجل اللاعبين</div>
                <span class="count-badge"><i class="fas fa-users"></i> {{ $players->count() }} لاعب</span>
            </div>
        </div>
        <div class="actions-wrapper">
            <form action="{{ route('players.destroyAll') }}" method="POST"
                onsubmit="return confirm('هل أنت متأكد من حذف الجميع؟');">
                @csrf @method('DELETE')
                <button type="submit" class="btn-header btn-danger"><i class="fas fa-trash-alt"></i> حذف الكل</button>
            </form>
            <a href="{{ route('players.create') }}" class="btn-header btn-add"><i class="fas fa-plus"></i> إضافة لاعب</a>
        </div>
    </div>

    <div class="card">
        <table class="table">
            <thead>
                <tr>
                    <th>الاسم</th>
                    <th>الخطة</th>
                    <th>الحالة</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse($players as $player)
                    <tr>
                        <td>
                            <div class="player-cell">
                                <div class="avatar">{{ mb_strtoupper(mb_substr($player->name, 0, 1)) }}</div>
                                <span>{{ $player->name }}</span>
                            </div>
                        </td>
                        <td>{{ $player->subscription->plan_name ?? 'غير مشترك' }}</td>
                        <td>
                            @if ($player->subscription)
                                <span class="status-chip {{ $player->subscription->isExpired() ? 'expired' : 'active' }}">
                                    {{ $player->subscription->isExpired() ? 'منتهي' : 'فعال' }}
                                </span>
                            @else
                                <span class="status-chip none">لا يوجد</span>
                            @endif
                        </td>
                        <td>
                            <div class="action-group">
                                <a href="{{ route('players.show', $player->id) }}" class="btn-action btn-show">عرض</a>
                                <a href="{{ route('players.edit', $player->id) }}" class="btn-action btn-edit">تعديل</a>
                                <form action="{{ route('players.destroy', $player->id) }}" method="POST"
                                    onsubmit="return confirm('تأكيد الحذف؟');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-action btn-delete">حذف</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr class="empty-row">
                        <td colspan="4">لا يوجد لاعبون مسجّلون</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
