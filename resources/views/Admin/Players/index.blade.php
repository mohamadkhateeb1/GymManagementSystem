@extends('Admin.layouts.app')

@section('title', 'إدارة اللاعبين | Elite Club')

@section('styles')
    <style>
        /* =========================================================
       ELITE CLUB - PLAYERS INDEX
       ========================================================= */

        .header {
            width: 100%;

            display: flex;
            align-items: center;
            justify-content: space-between;

            gap: 20px;

            margin-bottom: 18px;
            padding: 18px 20px;

            background: #ffffff;

            border: 1px solid #e4e8ef;
            border-radius: 16px;

            box-shadow: 0 6px 22px rgba(25, 35, 50, 0.045);

            direction: rtl;
        }

        /* =========================
       HEADER LEFT
       ========================= */

        .header-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .header-accent {
            width: 4px;
            height: 42px;

            border-radius: 10px;

            background: linear-gradient(to bottom,
                    #e0ad47,
                    #ad791c);
        }

        .header-title {
            margin-bottom: 5px;

            color: #202631;

            font-size: 20px;
            font-weight: 850;
        }

        /* =========================
       COUNT
       ========================= */

        .count-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;

            padding: 5px 10px;

            color: #a87921;
            background: #fff8e8;

            border: 1px solid #f0dfb5;
            border-radius: 20px;

            font-size: 11px;
            font-weight: 750;
        }

        .count-badge i {
            font-size: 10px;
        }

        /* =========================
       HEADER ACTIONS
       ========================= */

        .actions-wrapper {
            display: flex;
            align-items: center;
            gap: 9px;
        }

        .actions-wrapper form {
            margin: 0;
        }

        .btn-header {
            height: 42px;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            gap: 7px;

            padding: 0 16px;

            border-radius: 9px;

            font-family: inherit;
            font-size: 12px;
            font-weight: 800;

            text-decoration: none;

            cursor: pointer;

            transition: all 0.2s ease;
        }

        /* ADD */

        .btn-add {
            color: #ffffff;

            background: linear-gradient(135deg,
                    #d6a441,
                    #b77f1f);

            border: 1px solid #bd8b2c;

            box-shadow: 0 5px 13px rgba(181, 128, 31, 0.18);
        }

        .btn-add:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 17px rgba(181, 128, 31, 0.25);
        }

        /* DELETE ALL */

        .btn-danger {
            color: #d84242;
            background: #fff7f7;

            border: 1px solid #efc8c8;
        }

        .btn-danger:hover {
            color: #ffffff;
            background: #d94b4b;
            border-color: #d94b4b;
        }

        /* =========================
       TABLE CARD
       ========================= */

        .card {
            width: 100%;

            padding: 8px;

            background: #ffffff;

            border: 1px solid #e4e8ef;
            border-radius: 16px;

            box-shadow: 0 7px 24px rgba(25, 35, 50, 0.05);

            overflow-x: auto;

            direction: rtl;
        }

        /* =========================
       TABLE
       ========================= */

        .table {
            width: 100%;

            border-collapse: separate;
            border-spacing: 0;

            min-width: 780px;

            color: #303744;

            font-size: 12px;
        }

        .table thead th {
            height: 48px;

            padding: 0 15px;

            color: #737c8a;
            background: #f8f9fb;

            border-bottom: 1px solid #e6e9ee;

            font-size: 11px;
            font-weight: 800;

            text-align: right;
        }

        .table thead th:first-child {
            border-radius: 0 10px 10px 0;
        }

        .table thead th:last-child {
            border-radius: 10px 0 0 10px;
        }

        .table tbody td {
            height: 64px;

            padding: 9px 15px;

            border-bottom: 1px solid #edf0f4;

            vertical-align: middle;

            font-weight: 600;
        }

        .table tbody tr {
            transition: background 0.2s ease;
        }

        .table tbody tr:hover {
            background: #fffdf8;
        }

        .table tbody tr:last-child td {
            border-bottom: 0;
        }

        /* =========================
       PLAYER CELL
       ========================= */

        .player-cell {
            display: flex;
            align-items: center;
            gap: 10px;

            font-weight: 800;
            color: #252b35;
        }

        .avatar {
            width: 36px;
            height: 36px;

            display: flex;
            align-items: center;
            justify-content: center;

            flex-shrink: 0;

            color: #a87920;

            background: linear-gradient(135deg,
                    #fff5d7,
                    #f1dca4);

            border: 1px solid #e5c777;
            border-radius: 10px;

            font-size: 13px;
            font-weight: 900;
        }

        /* =========================
       STATUS
       ========================= */

        .status-chip {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            min-width: 76px;

            padding: 6px 11px;

            border-radius: 20px;

            font-size: 10px;
            font-weight: 800;
        }

        .status-chip.active {
            color: #13865a;
            background: #e8f8f0;
            border: 1px solid #c6eedc;
        }

        .status-chip.expired {
            color: #d34b4b;
            background: #fff0f0;
            border: 1px solid #f2d0d0;
        }

        .status-chip.none {
            color: #7d8591;
            background: #f1f3f5;
            border: 1px solid #e0e4e8;
        }

        /* =========================
       ACTIONS
       ========================= */

        .action-group {
            display: flex;
            align-items: center;
            justify-content: flex-start;

            gap: 6px;

            flex-wrap: wrap;
        }

        .action-group form {
            margin: 0;
        }

        .btn-action {
            min-width: 58px;
            height: 31px;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            padding: 0 10px;

            border-radius: 7px;

            font-family: inherit;
            font-size: 10px;
            font-weight: 800;

            text-decoration: none;

            border: 1px solid transparent;

            cursor: pointer;

            transition: all 0.18s ease;
        }

        /* SHOW */

        .btn-show {
            color: #5b6573;
            background: #f2f4f7;
            border-color: #e0e4e9;
        }

        .btn-show:hover {
            color: #252b35;
            background: #e7eaee;
        }

        /* EDIT */

        .btn-edit {
            color: #a47720;
            background: #fff8e7;
            border-color: #ecd7a7;
        }

        .btn-edit:hover {
            color: #ffffff;
            background: #c59437;
        }

        /* FREEZE */

        .btn-freeze {
            color: #c58a22;
            background: #fff7df;
            border-color: #edd79f;
        }

        .btn-freeze:hover {
            color: #ffffff;
            background: #d29a30;
        }

        /* UNFREEZE */

        .btn-unfreeze {
            color: #15915d;
            background: #e8f8f0;
            border-color: #c5ead9;
        }

        .btn-unfreeze:hover {
            color: #ffffff;
            background: #15915d;
        }

        /* DELETE */

        .btn-delete {
            color: #d44747;
            background: #fff1f1;
            border-color: #efcccc;
        }

        .btn-delete:hover {
            color: #ffffff;
            background: #d44747;
        }

        /* EMPTY */

        .empty-row td {
            height: 160px !important;

            color: #969eaa;

            text-align: center !important;

            font-weight: 700 !important;
        }

        /* =========================================================
       DARK MODE
       ========================================================= */

        [data-theme="dark"] .header,
        .dark-mode .header,
        body.dark .header {
            background: #121720;
            border-color: #29313d;
            box-shadow: 0 8px 28px rgba(0, 0, 0, 0.22);
        }

        [data-theme="dark"] .header-title,
        .dark-mode .header-title,
        body.dark .header-title {
            color: #f0f2f5;
        }

        [data-theme="dark"] .count-badge,
        .dark-mode .count-badge,
        body.dark .count-badge {
            color: #dfab43;
            background: rgba(210, 158, 55, 0.09);
            border-color: rgba(210, 158, 55, 0.22);
        }

        [data-theme="dark"] .card,
        .dark-mode .card,
        body.dark .card {
            background: #121720;
            border-color: #29313d;
            box-shadow: 0 9px 28px rgba(0, 0, 0, 0.23);
        }

        [data-theme="dark"] .table,
        .dark-mode .table,
        body.dark .table {
            color: #cdd2da;
        }

        [data-theme="dark"] .table thead th,
        .dark-mode .table thead th,
        body.dark .table thead th {
            color: #8993a2;
            background: #191f28;
            border-bottom-color: #2b3440;
        }

        [data-theme="dark"] .table tbody td,
        .dark-mode .table tbody td,
        body.dark .table tbody td {
            border-bottom-color: #29313d;
        }

        [data-theme="dark"] .table tbody tr:hover,
        .dark-mode .table tbody tr:hover,
        body.dark .table tbody tr:hover {
            background: rgba(210, 158, 55, 0.035);
        }

        [data-theme="dark"] .player-cell,
        .dark-mode .player-cell,
        body.dark .player-cell {
            color: #edf0f4;
        }

        [data-theme="dark"] .avatar,
        .dark-mode .avatar,
        body.dark .avatar {
            color: #e1ad46;
            background: rgba(210, 158, 55, 0.10);
            border-color: rgba(210, 158, 55, 0.25);
        }

        [data-theme="dark"] .status-chip.active,
        .dark-mode .status-chip.active,
        body.dark .status-chip.active {
            color: #43d89b;
            background: rgba(25, 157, 100, 0.11);
            border-color: rgba(25, 157, 100, 0.24);
        }

        [data-theme="dark"] .status-chip.expired,
        .dark-mode .status-chip.expired,
        body.dark .status-chip.expired {
            color: #ff7777;
            background: rgba(210, 65, 65, 0.10);
            border-color: rgba(210, 65, 65, 0.24);
        }

        [data-theme="dark"] .status-chip.none,
        .dark-mode .status-chip.none,
        body.dark .status-chip.none {
            color: #9099a7;
            background: #1c222b;
            border-color: #303946;
        }

        [data-theme="dark"] .btn-show,
        .dark-mode .btn-show,
        body.dark .btn-show {
            color: #aeb6c1;
            background: #1c222b;
            border-color: #303946;
        }

        [data-theme="dark"] .btn-edit,
        .dark-mode .btn-edit,
        body.dark .btn-edit {
            color: #dfaa43;
            background: rgba(210, 158, 55, 0.09);
            border-color: rgba(210, 158, 55, 0.22);
        }

        [data-theme="dark"] .btn-freeze,
        .dark-mode .btn-freeze,
        body.dark .btn-freeze {
            color: #e3aa3d;
            background: rgba(210, 158, 55, 0.08);
            border-color: rgba(210, 158, 55, 0.22);
        }

        [data-theme="dark"] .btn-unfreeze,
        .dark-mode .btn-unfreeze,
        body.dark .btn-unfreeze {
            color: #42d598;
            background: rgba(25, 157, 100, 0.10);
            border-color: rgba(25, 157, 100, 0.22);
        }

        [data-theme="dark"] .btn-delete,
        .dark-mode .btn-delete,
        body.dark .btn-delete {
            color: #ff7272;
            background: rgba(210, 65, 65, 0.09);
            border-color: rgba(210, 65, 65, 0.22);
        }

        [data-theme="dark"] .btn-danger,
        .dark-mode .btn-danger,
        body.dark .btn-danger {
            color: #ff7373;
            background: rgba(210, 65, 65, 0.08);
            border-color: rgba(210, 65, 65, 0.24);
        }

        [data-theme="dark"] .empty-row td,
        .dark-mode .empty-row td,
        body.dark .empty-row td {
            color: #737d8c;
        }

        /* =========================
       RESPONSIVE
       ========================= */

        @media (max-width: 750px) {
            .header {
                align-items: stretch;
                flex-direction: column;
            }

            .actions-wrapper {
                width: 100%;
            }

            .btn-header {
                flex: 1;
            }
        }

        @media (max-width: 500px) {
            .actions-wrapper {
                flex-direction: column;
            }

            .actions-wrapper form,
            .actions-wrapper .btn-header {
                width: 100%;
            }

            .actions-wrapper form .btn-header {
                width: 100%;
            }
        }

        /* =========================================================
       PLAYERS TABLE - DARK MODE FIX
       ========================================================= */

        /* Dark mode - force table backgrounds */
        [data-theme="dark"] .card,
        [data-theme="dark"] .card .table,
        [data-theme="dark"] .card .table tbody,
        [data-theme="dark"] .card .table tbody tr,
        .dark-mode .card,
        .dark-mode .card .table,
        .dark-mode .card .table tbody,
        .dark-mode .card .table tbody tr,
        body.dark .card,
        body.dark .card .table,
        body.dark .card .table tbody,
        body.dark .card .table tbody tr {
            background: #121720 !important;
        }

        /* Table cells */
        [data-theme="dark"] .card .table tbody td,
        .dark-mode .card .table tbody td,
        body.dark .card .table tbody td {
            color: #dce1e8 !important;
            background: #121720 !important;

            border-bottom-color: #29313d !important;
        }

        /* Hover */
        [data-theme="dark"] .card .table tbody tr:hover td,
        .dark-mode .card .table tbody tr:hover td,
        body.dark .card .table tbody tr:hover td {
            color: #f0f2f5 !important;
            background: rgba(210, 158, 55, 0.055) !important;
        }

        /* Player name */
        [data-theme="dark"] .card .player-cell,
        .dark-mode .card .player-cell,
        body.dark .card .player-cell {
            color: #edf0f5 !important;
        }

        /* Player avatar */
        [data-theme="dark"] .card .avatar,
        .dark-mode .card .avatar,
        body.dark .card .avatar {
            color: #dfaa43 !important;

            background: rgba(210, 158, 55, 0.10) !important;

            border-color: rgba(210, 158, 55, 0.28) !important;
        }

        /* Plan text */
        [data-theme="dark"] .card .table td:nth-child(2),
        .dark-mode .card .table td:nth-child(2),
        body.dark .card .table td:nth-child(2) {
            color: #cbd1da !important;
        }

        /* Header */
        [data-theme="dark"] .card .table thead th,
        .dark-mode .card .table thead th,
        body.dark .card .table thead th {
            color: #929dac !important;
            background: #191f28 !important;

            border-bottom-color: #2d3642 !important;
        }

        /* Status */
        [data-theme="dark"] .status-chip.active,
        .dark-mode .status-chip.active,
        body.dark .status-chip.active {
            color: #45d89a !important;
            background: rgba(25, 157, 100, 0.11) !important;
            border-color: rgba(25, 157, 100, 0.25) !important;
        }

        [data-theme="dark"] .status-chip.expired,
        .dark-mode .status-chip.expired,
        body.dark .status-chip.expired {
            color: #ff7676 !important;
            background: rgba(210, 65, 65, 0.10) !important;
            border-color: rgba(210, 65, 65, 0.25) !important;
        }

        [data-theme="dark"] .status-chip.none,
        .dark-mode .status-chip.none,
        body.dark .status-chip.none {
            color: #929ba8 !important;
            background: #1b222b !important;
            border-color: #303946 !important;
        }

        /* Buttons */

        [data-theme="dark"] .btn-show,
        .dark-mode .btn-show,
        body.dark .btn-show {
            color: #c0c7d0 !important;
            background: #1b222b !important;
            border-color: #303946 !important;
        }

        [data-theme="dark"] .btn-edit,
        .dark-mode .btn-edit,
        body.dark .btn-edit {
            color: #dfaa43 !important;
            background: rgba(210, 158, 55, 0.09) !important;
            border-color: rgba(210, 158, 55, 0.23) !important;
        }

        [data-theme="dark"] .btn-freeze,
        .dark-mode .btn-freeze,
        body.dark .btn-freeze {
            color: #e0aa42 !important;
            background: rgba(210, 158, 55, 0.08) !important;
            border-color: rgba(210, 158, 55, 0.22) !important;
        }

        [data-theme="dark"] .btn-unfreeze,
        .dark-mode .btn-unfreeze,
        body.dark .btn-unfreeze {
            color: #45d99b !important;
            background: rgba(25, 157, 100, 0.09) !important;
            border-color: rgba(25, 157, 100, 0.23) !important;
        }

        [data-theme="dark"] .btn-delete,
        .dark-mode .btn-delete,
        body.dark .btn-delete {
            color: #ff7373 !important;
            background: rgba(210, 65, 65, 0.09) !important;
            border-color: rgba(210, 65, 65, 0.23) !important;
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
                onsubmit="return confirm('⚠️ سيتم حذف جميع اللاعبين نهائياً من النظام، بما في ذلك كل اشتراكاتهم وفواتيرهم وخططهم التدريبية والغذائية وسجلاتهم بالكامل. لا يمكن التراجع عن هذا الإجراء إطلاقاً. هل أنت متأكد فعلاً؟');">
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
                                <span class="status-chip {{ $player->hasActiveSubscription() ? 'active' : 'expired' }}">
                                    {{ $player->hasActiveSubscription() ? 'فعال' : 'منتهي/مجمد' }}
                                </span>
                            @else
                                <span class="status-chip none">لا يوجد</span>
                            @endif
                        </td>
                        <td>
                            <div class="action-group">
                                <a href="{{ route('players.show', $player->id) }}" class="btn-action btn-show">عرض</a>
                                <a href="{{ route('players.edit', $player->id) }}" class="btn-action btn-edit">تعديل</a>
                                @if ($player->subscription)
                                    <form action="{{ route('players.toggle-subscription', $player->id) }}" method="POST"
                                        onsubmit="return confirm('{{ $player->subscription->status === 'active' ? 'سيتم تجميد اشتراك هذا اللاعب: لن يستطيع مدربه إضافة أو توزيع أي خطط أو تقييمات له حتى تُعاد تفعيل اشتراكه. متابعة؟' : 'سيتم إعادة تفعيل اشتراك هذا اللاعب. متابعة؟' }}');">
                                        @csrf
                                        <button type="submit"
                                            class="btn-action {{ $player->subscription->status === 'active' ? 'btn-freeze' : 'btn-unfreeze' }}">
                                            {{ $player->subscription->status === 'active' ? 'إلغاء التفعيل' : 'تفعيل' }}
                                        </button>
                                    </form>
                                @endif
                                <form action="{{ route('players.destroy', $player->id) }}" method="POST"
                                    onsubmit="return confirm('⚠️ سيتم حذف هذا اللاعب نهائياً من النظام بالكامل، بما في ذلك جميع اشتراكاته وفواتيره وخططه التدريبية والغذائية وسجلاته. لا يمكن التراجع عن هذا الإجراء إطلاقاً.\n\nإذا كنت تريد فقط إيقاف اشتراكه مؤقتاً، استخدم زر «إلغاء التفعيل» بجانب اسمه بدلاً من الحذف.\n\nهل أنت متأكد من الحذف النهائي؟');">
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
