@extends('Admin.layouts.app')

@section('title', 'التقارير المالية | Elite Club')

@section('styles')
    <style>
        /* ELITE CLUB — FINANCIAL REPORTS (نسخة مختصرة تعتمد متغيّرات الثيم الموحّدة) */

        .kpi-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));
            gap: 16px;
            margin-bottom: 20px;
        }

        .kpi-card {
            position: relative;
            background: linear-gradient(160deg, var(--surface-2), var(--surface));
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 22px;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
        }

        .kpi-card::before {
            content: '';
            position: absolute;
            inset: 0 0 auto 0;
            height: 3px;
            background: var(--kpi-color, var(--gold));
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
            color: var(--kpi-color, var(--gold));
            background: color-mix(in srgb, var(--kpi-color, var(--gold)) 12%, transparent);
        }

        .kpi-value {
            font-size: 30px;
            font-weight: 800;
            line-height: 1;
            color: var(--text);
            margin-bottom: 6px;
        }

        .kpi-label {
            font-size: 14px;
            color: var(--text-soft);
            font-weight: 600;
        }

        .panel {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
        }

        .panel-head {
            padding: 18px 24px;
            border-bottom: 1px solid var(--border);
            background: var(--surface-2);
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
            font-size: 17px;
            font-weight: 800;
            color: var(--text);
            margin: 0;
        }

        .panel-head h3::before {
            content: '';
            width: 4px;
            height: 18px;
            border-radius: 4px;
            background: var(--gold);
        }

        .month-filter {
            display: flex;
            gap: 8px;
        }

        .month-filter input,
        .month-filter button {
            height: 42px;
            border-radius: 8px;
            font-family: inherit;
            font-size: 13.5px;
            font-weight: 700;
            border: 1px solid var(--border);
        }

        .month-filter input {
            background: var(--surface-2);
            color: var(--text);
            padding: 0 12px;
        }

        .month-filter button {
            background: var(--gold);
            color: #fff;
            border: none;
            padding: 0 18px;
            cursor: pointer;
        }

        .financial-table {
            width: 100%;
            border-collapse: collapse;
            text-align: right;
            font-size: 14px;
        }

        .financial-table th {
            font-size: 13px;
            color: var(--text);
            padding: 14px 24px;
            border-bottom: 1px solid var(--border);
            font-weight: 800;
        }

        .financial-table td {
            padding: 15px 24px;
            border-bottom: 1px solid var(--border-soft);
            color: var(--text);
        }

        .financial-table tbody tr:hover {
            background: var(--surface-hover);
        }

        .amount-tag {
            font-weight: 800;
            color: var(--success);
            font-size: 14.5px;
        }

        .type-chip {
            display: inline-flex;
            align-items: center;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 800;
            color: #fff;
        }

        .type-chip.new {
            background: #4d8fe8;
        }

        .type-chip.renewal {
            background: var(--success);
        }

        .action-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: transparent;
            border: 1px solid var(--gold);
            color: var(--gold-dark);
            padding: 7px 14px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 12.5px;
            font-weight: 700;
            transition: .2s ease;
        }

        .action-btn:hover {
            background: var(--gold);
            color: #fff;
        }

        .empty-row td {
            text-align: center;
            padding: 40px;
            color: var(--text-soft);
            font-weight: 600;
        }

        .pagination-wrap {
            padding: 16px 24px;
            border-top: 1px solid var(--border);
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
            color: var(--text-soft);
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
            color: var(--text-soft);
            border: 1px solid var(--border);
            background: var(--surface-2);
            transition: .2s ease;
        }

        .gym-page-item a:hover {
            border-color: var(--gold);
            color: var(--gold-dark);
        }

        .gym-page-item.active span {
            background: var(--gold);
            border-color: var(--gold);
            color: #fff;
        }

        .gym-page-item.disabled span {
            opacity: .4;
        }

        .table-wrap {
            overflow-x: auto;
        }

        .financial-table {
            min-width: 620px;
        }
    </style>
@endsection

@section('content')
    <div class="kpi-grid">
        <div class="kpi-card" style="--kpi-color:#5a9c7a;">
            <div class="kpi-top">
                <div class="kpi-icon"><i class="fas fa-sack-dollar"></i></div>
            </div>
            <div class="kpi-value">{{ number_format($monthTotal, 2) }}</div>
            <div class="kpi-label">إيرادات شهر {{ $month->translatedFormat('F Y') }}</div>
        </div>
        <div class="kpi-card" style="--kpi-color:#4d8fe8;">
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
        <div class="kpi-card" style="--kpi-color:#8a6dd8;">
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

        <div class="table-wrap">
            <table class="financial-table">
                <thead>
                    <tr>
                        <th>اللاعب</th>
                        <th>الباقة</th>
                        <th>المبلغ</th>
                        <th>نوع العملية</th>
                        <th>تاريخ الدفع</th>
                        <th style="text-align:center;">إجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($payments as $payment)
                        <tr>
                            <td style="font-weight: 700;">{{ $payment->player->name ?? 'لاعب محذوف' }}</td>
                            <td>{{ $payment->planType->name ?? '—' }}</td>
                            <td><span class="amount-tag">{{ number_format($payment->amount, 2) }}</span></td>
                            <td><span
                                    class="type-chip {{ $payment->type }}">{{ $payment->type === 'new' ? 'اشتراك جديد' : 'تجديد' }}</span>
                            </td>
                            <td dir="ltr">{{ $payment->paid_at->format('Y-m-d H:i') }}</td>
                            <td style="text-align:center;">
                                <form action="{{ route('admin.financial-reports.archive', $payment->id) }}" method="POST"
                                    onsubmit="return confirm('سيتم رفع نسخة كاملة من بيانات هذه الدفعة إلى الأرشيف بشكل دائم. متابعة؟');">
                                    @csrf
                                    <button type="submit" class="action-btn"><i class="fas fa-box-archive"></i>
                                        أرشفة</button>
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
        </div>

        @if ($payments->hasPages())
            <div class="pagination-wrap">
                <nav class="gym-pagination">
                    <div class="gym-pagination-info">
                        عرض {{ $payments->firstItem() }} إلى {{ $payments->lastItem() }} من أصل {{ $payments->total() }}
                        دفعة
                    </div>
                    <ul class="gym-pagination-list">
                        @if ($payments->onFirstPage())
                            <li class="gym-page-item disabled"><span><i class="fas fa-chevron-right"></i></span></li>
                        @else
                            <li class="gym-page-item"><a href="{{ $payments->previousPageUrl() }}"><i
                                        class="fas fa-chevron-right"></i></a></li>
                        @endif
                        @for ($page = 1; $page <= $payments->lastPage(); $page++)
                            @if ($page == $payments->currentPage())
                                <li class="gym-page-item active"><span>{{ $page }}</span></li>
                            @else
                                <li class="gym-page-item"><a href="{{ $payments->url($page) }}">{{ $page }}</a>
                                </li>
                            @endif
                        @endfor
                        @if ($payments->hasMorePages())
                            <li class="gym-page-item"><a href="{{ $payments->nextPageUrl() }}"><i
                                        class="fas fa-chevron-left"></i></a></li>
                        @else
                            <li class="gym-page-item disabled"><span><i class="fas fa-chevron-left"></i></span></li>
                        @endif
                    </ul>
                </nav>
            </div>
        @endif
    </div>
@endsection
