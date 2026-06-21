@extends('Employee.layouts.app')

@section('title', 'إدارة اللاعبين | Elite Club')

@section('styles')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;800&display=swap" rel="stylesheet">
    <style>
        .monitoring-container {
            --gold: #c9a961;
            --gold-soft: rgba(201, 169, 97, 0.12);
            --gold-line: rgba(201, 169, 97, 0.16);
            --surface: #1c1f27;
            --surface-2: #232733;
            --text: #f2f3f5;
            --muted: #8a8f9c;
            font-family: 'Tajawal', sans-serif;
        }

        .btn-show {
            background: rgba(108, 99, 255, 0.1);
            color: #818cf8;
            border: 1px solid rgba(108, 99, 255, 0.2);
            padding: 8px 14px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 12.5px;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .btn-show:hover {
            background: #818cf8;
            color: #1c1f27;
        }

        .btn-apply {
            background: linear-gradient(135deg, #e7cd8e, #c9a961);
            color: #1c1f27;
            border: none;
            padding: 8px 16px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 12.5px;
            font-weight: 700;
            font-family: 'Tajawal', sans-serif;
            transition: transform 0.15s ease, box-shadow 0.15s ease;
        }

        .btn-apply:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(201, 169, 97, 0.25);
        }

        /* تنسيق الـ SELECT الاحترافي وعالي الدقة */
        .select-level {
            padding: 8px 32px 8px 12px;
            border-radius: 8px;
            border: 1px solid var(--gold-line);
            background: var(--surface-2);
            color: var(--text);
            font-size: 13px;
            font-family: 'Tajawal', sans-serif;
            outline: none;
            cursor: pointer;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
            appearance: none;
            /* إزالة السهم الافتراضي للمتصفح */
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23c9a961' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: left 10px center;
            background-size: 14px;
            min-width: 170px;
        }

        .select-level:focus {
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(201, 169, 97, 0.15);
        }

        .select-level option {
            background: var(--surface);
            color: var(--text);
        }

        .status-chip {
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            text-transform: capitalize;
        }

        .status-chip::before {
            content: '';
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: currentColor;
        }

        .active {
            background: rgba(74, 222, 128, 0.12);
            color: #4ade80;
            border: 1px solid rgba(74, 222, 128, 0.2);
        }

        .expired {
            background: rgba(248, 113, 113, 0.12);
            color: #f87171;
            border: 1px solid rgba(248, 113, 113, 0.2);
        }

        .none {
            background: rgba(138, 143, 156, 0.12);
            color: var(--muted);
            border: 1px solid rgba(138, 143, 156, 0.2);
        }

        .members-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
        }

        .members-table th {
            padding: 16px 20px;
            text-align: right;
            color: var(--muted);
            font-size: 13px;
            font-weight: 700;
            border-bottom: 1px solid var(--gold-soft);
            background: rgba(255, 255, 255, 0.01);
        }

        .members-table td {
            padding: 16px 20px;
            border-bottom: 1px solid rgba(201, 169, 97, 0.05);
            color: var(--text);
            vertical-align: middle;
            font-size: 14px;
        }

        .members-table tbody tr:hover {
            background: rgba(201, 169, 97, 0.02);
        }

        .panel {
            background: var(--surface);
            border: 1px solid var(--gold-line);
            border-radius: 16px;
            overflow: hidden;
        }

        .panel-head {
            padding: 18px 20px;
            border-bottom: 1px solid var(--gold-soft);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .panel-head h3 {
            margin: 0;
            font-size: 16px;
            font-weight: 700;
            color: var(--text);
        }

        .panel-head i {
            color: var(--gold);
        }
    </style>
@endsection

@section('content')
    <div class="dashboard-wrapper monitoring-container">

        <div style="margin-bottom: 15px;">
            <x-flash-message />
        </div>

        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h2 style="color: #fff; margin: 0; font-weight: 800;">لوحة المراقبة وإدارة المستويات</h2>
        </div>

        <div class="panel">
            <div class="panel-head">
                <i class="fas fa-users"></i>
                <h3>قائمة اللاعبين وتعيين المستويات التلقائية لايف</h3>
            </div>

            <table class="members-table">
                <thead>
                    <tr>
                        <th>اسم اللاعب</th>
                        <th>حالة الاشتراك</th>
                        <th>المستوى الحالي</th>
                        <th>تحديث المستوى والأتمتة الفورية</th>
                        <th>إجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($players as $player)
                        <tr>
                            <td style="font-weight: 700; color: #fff;">{{ $player->name }}</td>
                            <td>
                                @if ($player->subscription)
                                    <span
                                        class="status-chip {{ $player->subscription->status == 'active' ? 'active' : 'expired' }}">
                                        {{ $player->subscription->status == 'active' ? 'نشط' : 'منتهي' }}
                                    </span>
                                @else
                                    <span class="status-chip none">غير مشترك</span>
                                @endif
                            </td>
                            <td>
                                <span class="status-chip none" style="text-transform: capitalize; font-weight: 700;">
                                    {{ $player->level ?? 'لم يحدد بعد' }}
                                </span>
                            </td>
                            <td>
                                <form action="{{ route('employee.monitoring.assign-level', $player->id) }}" method="POST"
                                    style="display: flex; gap: 10px; align-items: center;">
                                    @csrf
                                    <select name="level" class="select-level" required>
                                        <option value="">اختر المستوى</option>
                                        <option value="beginner" {{ $player->level == 'beginner' ? 'selected' : '' }}>
                                            Beginner (مبتدئ)
                                        </option>
                                        <option value="intermediate"
                                            {{ $player->level == 'intermediate' ? 'selected' : '' }}>
                                            Intermediate (متوسط)
                                        </option>
                                        <option value="advanced" {{ $player->level == 'advanced' ? 'selected' : '' }}>
                                            Advanced (متقدم)
                                        </option>
                                    </select>
                                    <button type="submit" class="btn-apply">تطبيق الأتمتة</button>
                                </form>
                            </td>
                            <td>
                                <div class="action-group" style="display: flex; gap: 8px;">
                                    <a href="{{ route('employee.monitoring.show', $player->id) }}" class="btn-show">
                                        <i class="fas fa-eye" style="margin-left: 4px;"></i> عرض الملف والخطط
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr class="empty-row">
                            <td colspan="5" style="text-align: center; padding: 40px; color: var(--muted);">
                                <i class="fas fa-user-slash fa-2x"
                                    style="display: block; margin-bottom: 10px; color: var(--gold-line);"></i>
                                لا يوجد لاعبون مسجلون حالياً.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
