@extends('Admin.layouts.app')

@section('title', 'التقارير المالية | Elite Club')

@section('styles')
    <style>
        /* بطاقات الأرقام المالية */
        .financial-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .fin-card {
            background: #121722;
            padding: 25px;
            border-radius: 12px;
            border: 1px solid rgba(201, 169, 97, 0.12);
        }

        .fin-label {
            color: #8a8f9c;
            font-size: 13px;
            margin-bottom: 10px;
        }

        .fin-value {
            color: #c9a961;
            font-size: 28px;
            font-weight: 700;
        }

        /* جدول الحركات */
        .panel {
            background: #121722;
            border-radius: 12px;
            border: 1px solid rgba(201, 169, 97, 0.12);
        }

        .panel-head {
            padding: 20px;
            border-bottom: 1px solid rgba(201, 169, 97, 0.12);
            font-weight: 600;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th {
            padding: 15px;
            color: #8a8f9c;
            font-size: 12px;
            text-align: right;
        }

        .table td {
            padding: 15px;
            border-top: 1px solid rgba(201, 169, 97, 0.06);
        }

        .text-income {
            color: #5a9c7a;
        }

        /* لون الدخل */
        .text-expense {
            color: #c55a5a;
        }

        /* لون المصروف */
    </style>
@endsection

@section('content')
    <div class="header">
        <div class="header-title">التقارير المالية</div>
    </div>

    <div class="financial-grid">
        <div class="fin-card">
            <div class="fin-label">إجمالي الدخل هذا الشهر</div>
            {{-- <div class="fin-value">{{ number_format($totalIncome) }} ر.س</div> --}}
        </div>
        <div class="fin-card">
            <div class="fin-label">إجمالي المصروفات</div>
            {{-- <div class="fin-value">{{ number_format($totalExpenses) }} ر.س</div> --}}
        </div>
        <div class="fin-card">
            <div class="fin-label">صافي الأرباح</div>
            {{-- <div class="fin-value">{{ number_format($totalIncome - $totalExpenses) }} ر.س</div> --}}
        </div>
    </div>

    <div class="panel">
        <div class="panel-head">أحدث الحركات المالية</div>
        <table class="table">
            <thead>
                <tr>
                    <th>التاريخ</th>
                    <th>البيان</th>
                    <th>النوع</th>
                    <th>المبلغ</th>
                </tr>
            </thead>
            {{-- <tbody>
            @foreach ($recentTransactions as $transaction)
            <tr>
                <td>{{ $transaction->created_at->format('Y-m-d') }}</td>
                <td>{{ $transaction->description }}</td>
                <td>
                    <span class="{{ $transaction->type == 'income' ? 'text-income' : 'text-expense' }}">
                        {{ $transaction->type == 'income' ? 'دخل' : 'مصروف' }}
                    </span>
                </td>
                <td style="font-weight: 700;">{{ number_format($transaction->amount) }} ر.س</td>
            </tr>
            @endforeach
        </tbody> --}}
        </table>
    </div>
@endsection
