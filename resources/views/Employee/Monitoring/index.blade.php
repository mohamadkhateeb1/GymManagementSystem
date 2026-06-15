@extends('Employee.layouts.app')

@section('title', 'إدارة اللاعبين | Elite Club')

@section('styles')
    <style>
        /* تنسيقات الأزرار والحالة */
        .btn-show {
            background: rgba(108, 99, 255, 0.1);
            color: #818cf8;
            border: 1px solid rgba(108, 99, 255, 0.3);
            padding: 6px 12px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 12px;
        }

        .btn-green {
            background: rgba(90, 156, 122, 0.1);
            color: #5a9c7a;
            border: 1px solid rgba(90, 156, 122, 0.3);
            padding: 6px 12px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 12px;
        }

        .status-chip {
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 600;
        }

        .active {
            background: rgba(90, 156, 122, 0.15);
            color: #5a9c7a;
        }

        .expired {
            background: rgba(197, 90, 90, 0.15);
            color: #c55a5a;
        }

        .none {
            background: rgba(128, 128, 128, 0.1);
            color: #888;
        }

        /* التأكد من تنسيق الجدول */
        .members-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .members-table th {
            padding: 15px;
            text-align: right;
            color: #8a8f9c;
            border-bottom: 1px solid rgba(201, 169, 97, 0.12);
        }

        .members-table td {
            padding: 15px;
            border-bottom: 1px solid rgba(201, 169, 97, 0.06);
        }
    </style>
@endsection

@section('content')
    <div class="dashboard-wrapper">
        <div class="panel">
            <div class="panel-head">
                <h3><i class="fas fa-users"></i> قائمة اللاعبين التابعين لي</h3>
            </div>

            <table class="members-table">
                <thead>
                    <tr>
                        <th>اسم اللاعب</th>
                        <th>حالة الاشتراك</th>
                        <th>إجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($players as $player)
                        <tr>
                            <td style="font-weight: 500;">{{ $player->name }}</td>
                            <td>
                                @if ($player->subscription)
                                    <span
                                        class="status-chip {{ $player->subscription->status == 'active' ? 'active' : 'expired' }}">
                                        {{ $player->subscription->status }}
                                    </span>
                                @else
                                    <span class="status-chip none">غير مشترك</span>
                                @endif
                            </td>
                            <td>
                                <div class="action-group" style="display: flex; gap: 8px;">
                                    <a href="{{ route('employee.monitoring.show', $player->id) }}" class="btn-show">عرض
                                        التفاصيل</a>
                                        {{-- {{ route('employee.adTrainingPlan', $player->id) }} --}}
                                    <a href="{{ route('employee.training.create', $player->id) }}"
                                        class="btn-green">إضافة خطة</a> 
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr class="empty-row">
                            <td colspan="3" style="text-align:center; padding:20px;">لا يوجد لاعبون مسجلون</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
