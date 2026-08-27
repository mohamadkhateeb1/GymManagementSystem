@extends('Admin.layouts.app')

@section('title', 'إدارة الاشتراكات | Elite Club')

@section('styles')
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800&display=swap" rel="stylesheet">
    <style>
        .dashboard-wrapper {
            font-family: 'Tajawal', sans-serif;
        }

        .panel {
            background: var(--surface, #13161d);
            border: 1px solid var(--border, #252a38);
            border-radius: 16px;
            margin-bottom: 24px;
            overflow: hidden;
        }

        .panel-head {
            padding: 18px 24px;
            border-bottom: 1px solid var(--border, #252a38);
            background: rgba(255, 255, 255, 0.02);
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
        }

        .panel-head h3 {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 16px;
            font-weight: 700;
            color: var(--text, #e8eaf6);
            margin: 0;
        }

        .panel-head h3::before {
            content: '';
            width: 4px;
            height: 18px;
            border-radius: 4px;
            background: var(--accent, #6c63ff);
        }

        .members-table {
            width: 100%;
            border-collapse: collapse;
            text-align: right;
        }

        .members-table th {
            font-size: 12px;
            color: var(--text-muted, #9ca3af);
            padding: 14px 24px;
            border-bottom: 1px solid var(--border, #252a38);
            font-weight: 600;
        }

        .members-table td {
            padding: 15px 24px;
            font-size: 14px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.04);
            color: var(--text, #e8eaf6);
        }

        .members-table tbody tr:hover {
            background: rgba(255, 255, 255, 0.02);
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

        .action-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: transparent;
            border: 1px solid var(--accent, #6c63ff);
            color: var(--accent, #6c63ff);
            padding: 8px 16px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 12px;
            font-weight: 600;
            text-decoration: none;
            font-family: 'Tajawal', sans-serif;
            transition: 0.2s ease;
        }

        .action-btn:hover {
            background: var(--accent, #6c63ff);
            color: #fff;
        }

        .btn-archive {
            border-color: #c9a961;
            color: #c9a961;
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
            color: var(--text-muted, #9ca3af);
        }

        /* ===== شريط الصفحات (Pagination) — نفس أسلوب لوحة التحكم الرئيسية ===== */
        .pagination-wrap {
            padding: 16px 24px;
            border-top: 1px solid var(--border, #252a38);
        }

        .gym-pagination {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 14px;
        }

        .gym-pagination-info {
            font-size: 12.5px;
            color: var(--text-muted, #9ca3af);
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
            font-weight: 600;
            text-decoration: none;
            color: var(--text-muted, #9ca3af);
            border: 1px solid var(--border, #252a38);
            background: var(--surface-2, rgba(255, 255, 255, 0.02));
            transition: all 0.2s ease;
            line-height: 1;
        }

        .gym-page-item a i,
        .gym-page-item span i {
            font-size: 12px;
        }

        .gym-page-item a:hover {
            border-color: var(--accent, #6c63ff);
            color: var(--accent, #6c63ff);
        }

        .gym-page-item.active span {
            background: var(--accent, #6c63ff);
            border-color: var(--accent, #6c63ff);
            color: #fff;
        }

        .gym-page-item.disabled span {
            opacity: 0.35;
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
                            // ✅ الاشتراك فعّال فقط إذا كانت حالته active والتاريخ لم ينتهِ معاً،
                            // بنفس منطق Player::hasActiveSubscription() لكن مطبَّقاً على هذا
                            // السجل تحديداً (وليس بالضرورة أحدث اشتراك للاعب).
                            $isRowActive = $membership->status === 'active' && !$membership->isExpired();
                        @endphp
                        <tr>
                            <td style="font-weight: 500;">{{ $membership->player->name ?? 'غير معروف' }}</td>
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

            {{-- 📄 روابط التنقل بين الصفحات — بنفس أسلوب لوحة التحكم الرئيسية --}}
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