@extends('Admin.layouts.app')

@section('title', 'إدارة الاشتراكات | Elite Club')

@section('styles')
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800&display=swap" rel="stylesheet">
    <style>
        .dashboard-wrapper {
            font-family: 'Tajawal', sans-serif;
        }

        .panel {
            background: var(--surface, #ffffff);
            border: 1px solid var(--border, #e4e8ef);
            border-radius: 16px;
            margin-bottom: 24px;
            overflow: hidden;
            box-shadow: 0 7px 24px rgba(25, 35, 50, 0.05);
        }

        .panel-head {
            padding: 18px 24px;
            border-bottom: 1px solid var(--border, #e4e8ef);
            background: var(--surface-2, #fafbfc);
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
        }

        .panel-head h3 {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 17px;
            font-weight: 800;
            color: var(--text, #202631);
            margin: 0;
        }

        .panel-head h3::before {
            content: '';
            width: 4px;
            height: 18px;
            border-radius: 4px;
            background: var(--gold, #c9a961);
        }

        .members-table {
            width: 100%;
            border-collapse: collapse;
            text-align: right;
        }

        .members-table th {
            font-size: 12.5px;
            color: var(--text, #202631);
            padding: 14px 24px;
            border-bottom: 1px solid var(--border, #e4e8ef);
            font-weight: 800;
        }

        .members-table td {
            padding: 15px 24px;
            font-size: 14px;
            border-bottom: 1px solid var(--border-soft, #edf0f4);
            color: var(--text, #202631);
        }

        .members-table tbody tr:hover {
            background: var(--surface-hover, #fffdf8);
        }

        .status-chip {
            display: inline-flex;
            align-items: center;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 800;
            white-space: nowrap;
        }

        /* 🆕 خلفية صلبة + نص أبيض — نفس منطق باقي شارات الحالة بالمشروع */
        .status-chip.active {
            background: #17a06b;
            color: #ffffff;
        }

        .status-chip.expired {
            background: #d94b4b;
            color: #ffffff;
        }

        .action-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: transparent;
            border: 1px solid var(--gold, #c9a961);
            color: var(--gold-dark, #8a6d2f);
            padding: 8px 16px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 12.5px;
            font-weight: 700;
            text-decoration: none;
            font-family: 'Tajawal', sans-serif;
            transition: 0.2s ease;
        }

        .action-btn:hover {
            background: var(--gold, #c9a961);
            color: #ffffff;
        }

        .btn-archive {
            border-color: #c9a961;
            color: #a87921;
        }

        .btn-archive:hover {
            background: #c9a961;
            color: #1a1305;
        }

        .actions-cell {
            display: flex;
            gap: 6px;
            flex-wrap: nowrap;
        }

        .actions-cell form {
            margin: 0;
            display: inline-flex;
        }

        .empty-row td {
            text-align: center;
            padding: 40px;
            color: var(--text-soft, #4b5563);
            font-weight: 600;
        }

        /* ===== شريط الصفحات (Pagination) — نفس أسلوب لوحة التحكم الرئيسية ===== */
        .pagination-wrap {
            padding: 16px 24px;
            border-top: 1px solid var(--border, #e4e8ef);
        }

        .gym-pagination {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 14px;
        }

        .gym-pagination-info {
            font-size: 13px;
            color: var(--text-soft, #4b5563);
            font-weight: 600;
        }

        .gym-pagination-list {
            display: flex;
            align-items: center;
            gap: 6px;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .gym-page-item a,
        .gym-page-item span {
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 36px;
            height: 36px;
            padding: 0 10px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            color: var(--text-soft, #4b5563);
            border: 1px solid var(--border, #e4e8ef);
            background: var(--surface-2, #fafbfc);
            transition: all 0.2s ease;
            line-height: 1;
        }

        .gym-page-item a i,
        .gym-page-item span i {
            font-size: 12px;
        }

        .gym-page-item a:hover {
            border-color: var(--gold, #c9a961);
            color: var(--gold-dark, #8a6d2f);
        }

        .gym-page-item.active span {
            background: var(--gold, #c9a961);
            border-color: var(--gold, #c9a961);
            color: #ffffff;
        }

        .gym-page-item.disabled span {
            opacity: 0.4;
            cursor: default;
            background: transparent;
        }

        @media (max-width: 640px) {
            .panel {
                overflow-x: auto;
            }

            .members-table {
                min-width: 680px;
            }

            .gym-pagination {
                justify-content: center;
                text-align: center;
            }

            .gym-pagination-info {
                width: 100%;
                order: 2;
            }
        }
    </style>
@endsection

@section('content')
    <div class="dashboard-wrapper">
        <div class="panel">
            <div class="panel-head">
                <h3><i class="fas fa-id-card"></i> سجل اشتراكات اللاعبين</h3>
            </div>

            <table class="members-table">
                <thead>
                    <tr>
                        <th>اللاعب</th>
                        <th>نوع الخطة</th>
                        <th>تاريخ البدء</th>
                        <th>تاريخ الانتهاء</th>
                        <th>الحالة</th>
                        <th>إجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($memberships as $membership)
                        @php
                            $isRowActive = $membership->status === 'active' && !$membership->isExpired();
                        @endphp
                        <tr>
                            <td style="font-weight: 700;">{{ $membership->player->name ?? 'غير معروف' }}</td>
                            <td>{{ $membership->plan_name }}</td>
                            <td dir="ltr">{{ $membership->start_date }}</td>
                            <td dir="ltr">{{ $membership->end_date }}</td>
                            <td>
                                <span class="status-chip {{ $isRowActive ? 'active' : 'expired' }}">
                                    {{ $isRowActive ? 'فعال' : 'منتهي/مجمد' }}
                                </span>
                            </td>
                            <td>
                                <div class="actions-cell">
                                    <form action="{{ route('subscriptions.renew', $membership->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="action-btn">تجديد</button>
                                    </form>

                                    <form action="{{ route('admin.subscriptions.archive', $membership->id) }}" method="POST"
                                        onsubmit="return confirm('سيتم رفع نسخة كاملة من بيانات هذا الاشتراك إلى الأرشيف بشكل دائم. النسخة المؤرشفة لن تتأثر لاحقاً حتى لو عُدّل أو حُذف الاشتراك الأصلي. متابعة؟');">
                                        @csrf
                                        <button type="submit" class="action-btn btn-archive">
                                            <i class="fas fa-box-archive"></i> أرشفة
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr class="empty-row">
                            <td colspan="6">لا توجد اشتراكات مسجلة حالياً</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            @if ($memberships->hasPages())
                <div class="pagination-wrap">
                    <nav class="gym-pagination">
                        <div class="gym-pagination-info">
                            عرض {{ $memberships->firstItem() }} إلى {{ $memberships->lastItem() }} من أصل
                            {{ $memberships->total() }} نتيجة
                        </div>

                        <ul class="gym-pagination-list">
                            @if ($memberships->onFirstPage())
                                <li class="gym-page-item disabled"><span><i class="fas fa-chevron-right"></i></span>
                                </li>
                            @else
                                <li class="gym-page-item">
                                    <a href="{{ $memberships->previousPageUrl() }}"><i
                                            class="fas fa-chevron-right"></i></a>
                                </li>
                            @endif

                            @for ($page = 1; $page <= $memberships->lastPage(); $page++)
                                @if ($page == $memberships->currentPage())
                                    <li class="gym-page-item active"><span>{{ $page }}</span></li>
                                @else
                                    <li class="gym-page-item">
                                        <a href="{{ $memberships->url($page) }}">{{ $page }}</a>
                                    </li>
                                @endif
                            @endfor

                            @if ($memberships->hasMorePages())
                                <li class="gym-page-item">
                                    <a href="{{ $memberships->nextPageUrl() }}"><i class="fas fa-chevron-left"></i></a>
                                </li>
                            @else
                                <li class="gym-page-item disabled"><span><i class="fas fa-chevron-left"></i></span>
                                </li>
                            @endif
                        </ul>
                    </nav>
                </div>
            @endif
        </div>
    </div>
@endsection