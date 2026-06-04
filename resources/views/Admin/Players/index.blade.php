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

        /* شريط ذهبي مزخرف قبل العنوان */
        .header-accent {
            width: 5px;
            height: 46px;
            border-radius: 6px;
            background: linear-gradient(180deg, var(--accent), #8a6d2f);
            box-shadow: 0 0 18px rgba(201, 169, 97, 0.5);
        }

        .header-titles .header-title {
            font-size: 26px;
            font-weight: 800;
            color: #fff;
            line-height: 1.2;
            letter-spacing: 0.3px;
        }

        .header-titles .header-sub {
            margin-top: 6px;
            font-size: 13px;
            color: var(--text-muted, #8b8b8b);
            display: flex;
            align-items: center;
            gap: 8px;
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

        /* ===== الكارد ===== */
        .card {
            position: relative;
            background: rgba(16, 19, 28, 0.65);
            backdrop-filter: blur(14px);
            border: 1px solid rgba(201, 169, 97, 0.18);
            border-radius: 20px;
            padding: 10px 22px 18px;
            box-shadow:
                0 20px 50px rgba(0, 0, 0, 0.45),
                inset 0 1px 0 rgba(255, 255, 255, 0.04);
            overflow: hidden;
        }

        /* لمعة ذهبية خفيفة أعلى الكارد */
        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg,
                    transparent,
                    rgba(201, 169, 97, 0.6),
                    transparent);
        }

        /* ===== الجدول ===== */
        .table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 12px;
        }

        .table th {
            padding: 18px 22px;
            font-size: 11px;
            color: var(--accent);
            text-transform: uppercase;
            letter-spacing: 1.5px;
            font-weight: 700;
            text-align: right;
        }

        .table td {
            padding: 16px 22px;
            background: rgba(0, 0, 0, 0.22);
            color: #e8e6e1;
            font-size: 14px;
            border-top: 1px solid rgba(255, 255, 255, 0.03);
            border-bottom: 1px solid rgba(255, 255, 255, 0.03);
            vertical-align: middle;
            transition: background 0.3s ease, transform 0.3s ease;
        }

        /* في RTL: أول خلية على اليمين وآخر خلية على اليسار */
        .table tbody tr td:first-child {
            border-top-right-radius: 12px;
            border-bottom-right-radius: 12px;
            border-right: 3px solid transparent;
        }

        .table tbody tr td:last-child {
            border-top-left-radius: 12px;
            border-bottom-left-radius: 12px;
        }

        .table tbody tr:hover td {
            background: rgba(201, 169, 97, 0.07);
        }

        .table tbody tr:hover td:first-child {
            border-right-color: var(--accent);
        }

        /* خلية الاسم: أفاتار + الاسم */
        .player-cell {
            display: flex;
            align-items: center;
            gap: 14px;
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
            color: #1a1305;
            background: linear-gradient(135deg, var(--accent), #d9bd7c);
            box-shadow: 0 4px 14px rgba(201, 169, 97, 0.3);
        }

        .player-name {
            font-weight: 700;
            color: #fff;
        }

        /* رقم الهاتف */
        .phone-cell {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            direction: ltr;
            font-variant-numeric: tabular-nums;
            letter-spacing: 0.5px;
        }

        .phone-cell i {
            color: var(--accent);
            opacity: 0.8;
            font-size: 12px;
        }

        .phone-empty {
            color: var(--text-muted, #8b8b8b);
            font-style: italic;
            font-size: 13px;
        }

        /* ===== الأزرار العلوية ===== */
        .actions-wrapper {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .btn-header {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 11px 20px;
            border-radius: 10px;
            font-weight: 700;
            font-size: 14px;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 1px solid transparent;
        }

        .btn-danger {
            background: rgba(239, 68, 68, 0.08);
            color: #ef4444;
            border-color: rgba(239, 68, 68, 0.3);
        }

        .btn-danger:hover {
            background: #ef4444;
            color: #fff;
            box-shadow: 0 8px 22px rgba(239, 68, 68, 0.35);
            transform: translateY(-2px);
        }

        .btn-add {
            background: linear-gradient(135deg, var(--accent), #d9bd7c);
            color: #1a1305;
            box-shadow: 0 6px 18px rgba(201, 169, 97, 0.3);
        }

        .btn-add:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 26px rgba(201, 169, 97, 0.45);
        }

        /* ===== أزرار الجدول ===== */
        .action-group {
            display: flex;
            gap: 8px;
            align-items: center;
            justify-content: flex-start;
        }

        .btn-action {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 13px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s ease;
            border: 1px solid transparent;
            cursor: pointer;
        }

        .btn-action:hover {
            transform: translateY(-1px);
        }

        .btn-edit {
            background: rgba(201, 169, 97, 0.1);
            color: var(--accent);
            border-color: rgba(201, 169, 97, 0.3);
        }

        .btn-edit:hover {
            background: var(--accent);
            color: #1a1305;
            box-shadow: 0 6px 16px rgba(201, 169, 97, 0.3);
        }

        .btn-show {
            background: rgba(108, 99, 255, 0.1);
            color: #818cf8;
            border-color: rgba(108, 99, 255, 0.3);
        }

        .btn-show:hover {
            background: #6c63ff;
            color: #fff;
            box-shadow: 0 6px 16px rgba(108, 99, 255, 0.35);
        }

        .btn-delete {
            background: rgba(239, 68, 68, 0.1);
            color: #ef4444;
            border-color: rgba(239, 68, 68, 0.3);
        }

        .btn-delete:hover {
            background: #ef4444;
            color: #fff;
            box-shadow: 0 6px 16px rgba(239, 68, 68, 0.35);
        }

        /* ===== حالة فارغة ===== */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: var(--text-muted, #8b8b8b);
        }

        .empty-state i {
            font-size: 46px;
            color: rgba(201, 169, 97, 0.4);
            margin-bottom: 16px;
            display: block;
        }

        .empty-state .empty-title {
            font-size: 16px;
            font-weight: 700;
            color: #cfcbc2;
            margin-bottom: 6px;
        }

        /* ===== أنيميشن دخول الصفوف ===== */
        @keyframes rowIn {
            from {
                opacity: 0;
                transform: translateY(8px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .table tbody tr {
            animation: rowIn 0.45s ease both;
        }

        /* تجاوب */
        @media (max-width: 640px) {
            .header {
                flex-direction: column;
                align-items: stretch;
            }

            .actions-wrapper {
                justify-content: space-between;
            }

            .table th:nth-child(2),
            .table td:nth-child(2) {
                display: none;
            }
        }
    </style>
@endsection

@section('content')
    <div class="header">
        <div class="header-left">
            <div class="header-accent"></div>
            <div class="header-titles">
                <div class="header-title">سجل اللاعبين</div>
                <div class="header-sub">
                    إدارة وعرض جميع لاعبي النادي
                    <span class="count-badge">
                        <i class="fas fa-users"></i> {{ count($players) }} لاعب
                    </span>
                </div>
            </div>
        </div>

        <div class="actions-wrapper">
            <form action="{{ route('players.destroyAll') }}" method="POST"
                onsubmit="return confirm('تحذير: هل أنت متأكد من حذف جميع اللاعبين؟');">
                @csrf @method('DELETE')
                <button type="submit" class="btn-header btn-danger">
                    <i class="fas fa-trash-alt"></i> حذف الكل
                </button>
            </form>

            <a href="{{ route('players.create') }}" class="btn-header btn-add">
                <i class="fas fa-plus"></i> إضافة لاعب جديد
            </a>
        </div>
    </div>

    <div class="card">
        <table class="table">
            <thead>
                <tr>
                    <th>الاسم</th>
                    <th>رقم الهاتف</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse($players as $player)
                    <tr style="animation-delay: {{ $loop->index * 0.05 }}s;">
                        <td>
                            <div class="player-cell">
                                <div class="avatar">{{ mb_strtoupper(mb_substr($player->name, 0, 1)) }}</div>
                                <span class="player-name">{{ $player->name }}</span>
                            </div>
                        </td>
                        <td>
                            @if ($player->phone)
                                <span class="phone-cell">
                                    <i class="fas fa-phone"></i> {{ $player->phone }}
                                </span>
                            @else
                                <span class="phone-empty">غير متوفر</span>
                            @endif
                        </td>
                        <td>
                            <div class="action-group">
                                <a href="{{ route('players.show', $player->id) }}" class="btn-action btn-show">
                                    <i class="fas fa-eye"></i> عرض
                                </a>
                                <a href="{{ route('players.edit', $player->id) }}" class="btn-action btn-edit">
                                    <i class="fas fa-edit"></i> تعديل
                                </a>
                                <form action="{{ route('players.destroy', $player->id) }}" method="POST"
                                    style="display: inline-block;">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-action btn-delete"
                                        onclick="return confirm('هل أنت متأكد؟')">
                                        <i class="fas fa-trash-alt"></i> حذف
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" style="background: transparent; border: none;">
                            <div class="empty-state">
                                <i class="fas fa-user-slash"></i>
                                <div class="empty-title">لا يوجد لاعبون مسجّلون</div>
                                <div>ابدأ بإضافة أول لاعب من زر «إضافة لاعب جديد»</div>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
