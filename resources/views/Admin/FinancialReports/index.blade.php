@extends('Admin.layouts.app')

@section('title', 'التقارير المالية | Elite Club')

@section('styles')
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800&display=swap" rel="stylesheet">
    <style>
        .reports-wrapper {
            font-family: 'Tajawal', sans-serif;
        }

        .kpi-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 18px;
            margin-bottom: 24px;
        }

        .kpi-card {
            position: relative;
            background: linear-gradient(160deg, var(--surface-2, #1a1e28), var(--surface, #13161d));
            border: 1px solid var(--border, #252a38);
            border-radius: 16px;
            padding: 22px;
            overflow: hidden;
        }

        .kpi-card::before {
            content: '';
            position: absolute;
            inset: 0 0 auto 0;
            height: 3px;
            background: var(--kpi-color, var(--accent, #6c63ff));
            opacity: 0.85;
        }

        .kpi-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 18px;
        }

        .kpi-icon {
            width: 46px;
            height: 46px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            font-size: 20px;
            color: var(--kpi-color, var(--accent, #6c63ff));
            background: color-mix(in srgb, var(--kpi-color, var(--accent, #6c63ff)) 12%, transparent);
        }

        .kpi-value {
            font-size: 30px;
            font-weight: 800;
            line-height: 1;
            color: var(--text, #e8eaf6);
            margin-bottom: 6px;
        }

        .kpi-label {
            font-size: 13px;
            color: var(--text-muted, #9ca3af);
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
            flex-wrap: wrap;
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

        .month-filter {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .month-filter input {
            background: var(--surface-2, #1a1e28);
            border: 1px solid var(--border, #252a38);
            color: var(--text, #e8eaf6);
            padding: 8px 12px;
            border-radius: 8px;
            font-family: 'Tajawal', sans-serif;
            font-size: 13px;
        }

        .month-filter button {
            background: var(--accent, #6c63ff);
            color: #fff;
            border: none;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            font-family: 'Tajawal', sans-serif;
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

        .amount-tag {
            font-weight: 800;
            color: #5a9c7a;
        }

        .type-chip {
            display: inline-flex;
            align-items: center;
            padding: 5px 11px;
            border-radius: 6px;
            font-size: 11.5px;
            font-weight: 700;
        }

        .type-chip.new {
            background: rgba(96, 165, 250, 0.12);
            color: #60a5fa;
        }

        .type-chip.renewal {
            background: rgba(90, 156, 122, 0.12);
            color: #5a9c7a;
        }

        .action-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: transparent;
            border: 1px solid #c9a961;
            color: #c9a961;
            padding: 7px 14px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 12px;
            font-weight: 600;
            font-family: 'Tajawal', sans-serif;
            transition: 0.2s ease;
        }

        .action-btn:hover {
            background: #c9a961;
            color: #1a1305;
        }

        .empty-row td {
            text-align: center;
            padding: 40px;
            color: var(--text-muted, #9ca3af);
        }

        /* ===== شريط الصفحات ===== */
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
                min-width: 620px;
            }
        }
    </style>
@endsection

@section('content')
    <div class="reports-wrapper">

        <div class="kpi-grid">
            <div class="kpi-card" style="--kpi-color:#5a9c7a;">
                <div class="kpi-top">
                    <div class="kpi-icon"><i class="fas fa-sack-dollar"></i></div>
                </div>
                <div class="kpi-value">{{ number_format($monthTotal, 2) }}</div>
                <div class="kpi-label">إيرادات شهر {{ $month->translatedFormat('F Y') }}</div>
            </div>

            <div class="kpi-card" style="--kpi-color:#60a5fa;">
                <div class="kpi-top">
                    <div class="kpi-icon"><i class="fas fa-user-plus"></i></div>
                </div>
                <div class="kpi-value">{{ $newCount }}</div>
                <div class="kpi-label">اشتراكات جديدة هذا الشهر</div>
            </div>

            <div class="kpi-card" style="--kpi-color:#c9a961;">
                <div class="kpi-top">
                    <div class="kpi-icon"><i class="fas fa-rotate"></i></div>
                </div>
                <div class="kpi-value">{{ $renewalCount }}</div>
                <div class="kpi-label">تجديدات هذا الشهر</div>
            </div>

            <div class="kpi-card" style="--kpi-color:#818cf8;">
                <div class="kpi-top">
                    <div class="kpi-icon"><i class="fas fa-chart-line"></i></div>
                </div>
                <div class="kpi-value">{{ number_format($allTimeTotal, 2) }}</div>
                <div class="kpi-label">إجمالي الإيرادات منذ البداية</div>
            </div>
        </div>

        <div class="panel">
            <div class="panel-head">
                <h3><i class="fas fa-file-invoice-dollar"></i> سجل الدفعات</h3>
                <form action="{{ route('admin.financial-reports.index') }}" method="GET" class="month-filter">
                    <input type="month" name="month" value="{{ $month->format('Y-m') }}">
                    <button type="submit">عرض</button>
                </form>
            </div>

            <table class="members-table">
                <thead>
                    <tr>
                        <th>اللاعب</th>
                        <th>الباقة</th>
                        <th>المبلغ</th>
                        <th>نوع العملية</th>
                        <th>تاريخ الدفع</th>
                        <th style="text-align: center;">إجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($payments as $payment)
                        <tr>
                            <td style="font-weight: 500;">{{ $payment->player->name ?? 'لاعب محذوف' }}</td>
                            <td>{{ $payment->planType->name ?? '—' }}</td>
                            <td><span class="amount-tag">{{ number_format($payment->amount, 2) }}</span></td>
                            <td>
                                <span class="type-chip {{ $payment->type }}">
                                    {{ $payment->type === 'new' ? 'اشتراك جديد' : 'تجديد' }}
                                </span>
                            </td>
                            <td dir="ltr">{{ $payment->paid_at->format('Y-m-d H:i') }}</td>
                            <td style="text-align: center;">
                                <form action="{{ route('admin.financial-reports.archive', $payment->id) }}" method="POST"
                                    onsubmit="return confirm('سيتم رفع نسخة كاملة من بيانات هذه الدفعة إلى الأرشيف بشكل دائم. متابعة؟');">
                                    @csrf
                                    <button type="submit" class="action-btn">
                                        <i class="fas fa-box-archive"></i> أرشفة
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr class="empty-row">
                            <td colspan="6">لا توجد دفعات مسجّلة في هذا الشهر.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            @if ($payments->hasPages())
                <div class="pagination-wrap">
                    <nav class="gym-pagination">
                        <div class="gym-pagination-info">
                            عرض {{ $payments->firstItem() }} إلى {{ $payments->lastItem() }} من أصل
                            {{ $payments->total() }} دفعة
                        </div>
                        <ul class="gym-pagination-list">
                            @if ($payments->onFirstPage())
                                <li class="gym-page-item disabled"><span><i class="fas fa-chevron-right"></i></span></li>
                            @else
                                <li class="gym-page-item">
                                    <a href="{{ $payments->previousPageUrl() }}"><i class="fas fa-chevron-right"></i></a>
                                </li>
                            @endif

                            @for ($page = 1; $page <= $payments->lastPage(); $page++)
                                @if ($page == $payments->currentPage())
                                    <li class="gym-page-item active"><span>{{ $page }}</span></li>
                                @else
                                    <li class="gym-page-item">
                                        <a href="{{ $payments->url($page) }}">{{ $page }}</a>
                                    </li>
                                @endif
                            @endfor

                            @if ($payments->hasMorePages())
                                <li class="gym-page-item">
                                    <a href="{{ $payments->nextPageUrl() }}"><i class="fas fa-chevron-left"></i></a>
                                </li>
                            @else
                                <li class="gym-page-item disabled"><span><i class="fas fa-chevron-left"></i></span></li>
                            @endif
                        </ul>
                    </nav>
                </div>
            @endif
        </div>
    </div>
@endsection
