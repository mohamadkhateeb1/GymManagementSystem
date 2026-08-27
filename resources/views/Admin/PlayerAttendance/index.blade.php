@extends('Admin.layouts.app')

@section('title', 'تقارير حضور اللاعبين | Elite Club')

@section('styles')
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800&display=swap" rel="stylesheet">
    <style>
        .attendance-wrapper {
            font-family: 'Tajawal', sans-serif;
        }

        .kpi-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
            margin-bottom: 24px;
        }

        .kpi-card {
            position: relative;
            background: linear-gradient(150deg, var(--surface-2, #1a1e28) 0%, var(--surface, #13161d) 100%);
            border: 1px solid var(--border, #252a38);
            border-radius: 16px;
            padding: 20px;
        }

        .kpi-card::before {
            content: '';
            position: absolute;
            inset: 0 0 auto 0;
            height: 3px;
            border-radius: 16px 16px 0 0;
            background: var(--kpi-color, var(--accent, #6c63ff));
        }

        .kpi-icon {
            width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            font-size: 18px;
            color: var(--kpi-color, var(--accent, #6c63ff));
            background: color-mix(in srgb, var(--kpi-color, var(--accent, #6c63ff)) 14%, transparent);
            margin-bottom: 14px;
        }

        .kpi-value {
            font-size: 26px;
            font-weight: 800;
            color: var(--text, #e8eaf6);
            margin-bottom: 4px;
        }

        .kpi-label {
            font-size: 12.5px;
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

        .filter-bar {
            padding: 20px 24px;
            background: rgba(0, 0, 0, 0.12);
            border-bottom: 1px solid var(--border, #252a38);
        }

        .filter-form {
            display: grid;
            grid-template-columns: 1.4fr 1fr 1fr 1fr auto;
            gap: 15px;
            align-items: end;
        }

        .field-label {
            display: block;
            color: var(--accent, #6c63ff);
            font-size: 11px;
            margin-bottom: 6px;
        }

        .field-input {
            width: 100%;
            text-align: right;
            background: var(--surface-2, #1a1e28);
            border: 1px solid var(--border, #252a38);
            color: var(--text, #e8eaf6);
            padding: 9px 14px;
            border-radius: 8px;
            font-size: 13px;
            font-family: 'Tajawal', sans-serif;
        }

        .field-input:focus {
            outline: none;
            border-color: var(--accent, #6c63ff);
        }

        .action-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 9px 16px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            font-family: 'Tajawal', sans-serif;
            border: 1px solid var(--border, #252a38);
        }

        .btn-solid {
            background: var(--accent, #6c63ff);
            color: #fff;
            border: none;
        }

        .btn-ghost {
            color: var(--text-muted, #9ca3af);
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

        .source-chip {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 5px 11px;
            border-radius: 6px;
            font-size: 11.5px;
            font-weight: 700;
        }

        .source-chip.app {
            background: rgba(96, 165, 250, 0.12);
            color: #60a5fa;
        }

        .source-chip.coach {
            background: rgba(201, 169, 97, 0.12);
            color: #c9a961;
        }

        .empty-row td {
            text-align: center;
            padding: 40px;
            color: var(--text-muted, #9ca3af);
        }

        .pagination-wrap {
            padding: 16px 24px;
            border-top: 1px solid var(--border, #252a38);
        }

        @media (max-width: 900px) {
            .filter-form {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 640px) {
            .panel {
                overflow-x: auto;
            }

            .members-table {
                min-width: 620px;
            }

            .filter-form {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endsection

@section('content')
    <div class="attendance-wrapper">
        <div style="margin-bottom: 16px;">
            <x-flash-message />
        </div>

        <div class="kpi-grid">
            <div class="kpi-card" style="--kpi-color:#5a9c7a;">
                <div class="kpi-icon"><i class="fas fa-user-check"></i></div>
                <div class="kpi-value">{{ $todayCount }}</div>
                <div class="kpi-label">حضروا اليوم</div>
            </div>
            <div class="kpi-card" style="--kpi-color:#60a5fa;">
                <div class="kpi-icon"><i class="fas fa-calendar-week"></i></div>
                <div class="kpi-value">{{ $weekCount }}</div>
                <div class="kpi-label">حضور هذا الأسبوع</div>
            </div>
            <div class="kpi-card" style="--kpi-color:#c9a961;">
                <div class="kpi-icon"><i class="fas fa-list-check"></i></div>
                <div class="kpi-value">{{ $totalCount }}</div>
                <div class="kpi-label">إجمالي السجلات</div>
            </div>
        </div>

        <div class="panel">
            <div class="panel-head">
                <h3><i class="fas fa-user-clock"></i> سجل حضور اللاعبين</h3>
            </div>

            <div class="filter-bar">
                <form action="{{ route('admin.attendance.players.index') }}" method="GET" class="filter-form">
                    <div>
                        <label class="field-label">بحث باسم اللاعب</label>
                        <input type="text" name="player_name" class="field-input" value="{{ request('player_name') }}"
                            placeholder="اسم اللاعب...">
                    </div>
                    <div>
                        <label class="field-label">المدرب</label>
                        <select name="coach_id" class="field-input">
                            <option value="">كل المدربين</option>
                            @foreach ($coaches as $coach)
                                <option value="{{ $coach->id }}"
                                    {{ request('coach_id') == $coach->id ? 'selected' : '' }}>{{ $coach->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="field-label">من تاريخ</label>
                        <input type="date" name="date_from" class="field-input" value="{{ request('date_from') }}">
                    </div>
                    <div>
                        <label class="field-label">إلى تاريخ</label>
                        <input type="date" name="date_to" class="field-input" value="{{ request('date_to') }}">
                    </div>
                    <div style="display: flex; gap: 8px;">
                        <button type="submit" class="action-btn btn-solid">تطبيق</button>
                        <a href="{{ route('admin.attendance.players.index') }}" class="action-btn btn-ghost">إلغاء</a>
                    </div>
                </form>
            </div>

            <table class="members-table">
                <thead>
                    <tr>
                        <th>اللاعب</th>
                        <th>المدرب</th>
                        <th>تاريخ الحضور</th>
                        <th>وقت التسجيل</th>
                        <th>المصدر</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($logs as $log)
                        <tr>
                            <td style="font-weight: 500;">{{ $log->player->name ?? 'لاعب محذوف' }}</td>
                            <td style="color: var(--text-muted, #9ca3af);">{{ $log->player->coach->name ?? '—' }}</td>
                            <td dir="ltr">{{ $log->attendance_date->format('Y-m-d') }}</td>
                            <td dir="ltr">{{ $log->attended_at->format('H:i') }}</td>
                            <td>
                                <span class="source-chip {{ $log->source }}">
                                    <i class="fas {{ $log->source === 'app' ? 'fa-mobile-screen' : 'fa-user-tie' }}"></i>
                                    {{ $log->source === 'app' ? 'التطبيق' : 'المدرب' }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr class="empty-row">
                            <td colspan="5">لا توجد سجلات حضور مطابقة للفلاتر الحالية.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            @if ($logs->hasPages())
                <div class="pagination-wrap">
                    {{ $logs->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection