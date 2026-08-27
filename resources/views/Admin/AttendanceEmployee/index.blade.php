@extends('Admin.layouts.app')

@section('title', 'تقارير حضور الموظفين | Elite Club')

@section('styles')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .attendance-container {
            --gold: #c9a961;
            --gold-soft: rgba(201, 169, 97, 0.08);
            --gold-line: rgba(201, 169, 97, 0.15);
            --surface: #1c1f27;
            --surface-2: #232733;
            --text: #f2f3f5;
            --muted: #8a8f9c;
            --success: #4ade80;
            --danger: #f87171;
            --warning: #fbbf24;
            --blue-vip: #818cf8;
            font-family: 'Tajawal', sans-serif;
            color: var(--text);
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .page-header-title {
            color: #fff;
            margin: 0 0 5px 0;
            font-weight: 800;
            font-size: 24px;
        }

        /* كروت الإحصائيات الفاخرة */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            margin-bottom: 25px;
        }

        .stat-card-luxury {
            background: linear-gradient(145deg, var(--surface), #17191e);
            border: 1px solid var(--gold-line);
            border-radius: 14px;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
        }

        .stat-card-luxury .info h4 {
            margin: 0 0 8px 0;
            color: var(--muted);
            font-size: 13px;
            font-weight: 700;
        }

        .stat-card-luxury .info p {
            margin: 0;
            font-size: 28px;
            font-weight: 800;
            color: #fff;
        }

        .stat-card-luxury .icon-box {
            width: 48px;
            height: 48px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        /* فلاتر البحث المتطورة */
        .filter-panel {
            background: var(--surface);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 14px;
            padding: 20px;
            margin-bottom: 25px;
        }

        .filter-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 15px;
            align-items: flex-end;
        }

        .form-group-luxury {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .form-group-luxury label {
            font-size: 12.5px;
            color: var(--muted);
            font-weight: 700;
        }

        .input-luxury {
            padding: 10px 14px;
            border-radius: 8px;
            border: 1px solid var(--gold-line);
            background: var(--surface-2);
            color: #fff;
            font-size: 13px;
            font-family: 'Tajawal', sans-serif;
            outline: none;
        }

        .input-luxury:focus {
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(201, 169, 97, 0.15);
        }

        .btn-submit-filter {
            background: linear-gradient(135deg, #e7cd8e, #c9a961);
            color: #1c1f27;
            border: none;
            padding: 11px 20px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 700;
            font-size: 13px;
            font-family: 'Tajawal', sans-serif;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-clear-filter {
            background: rgba(255, 255, 255, 0.05);
            color: var(--text);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 10px 15px;
            border-radius: 8px;
            text-decoration: none;
            text-align: center;
            font-size: 13px;
            font-weight: 600;
        }

        /* الجدول الفاخر */
        .panel-luxury {
            background: linear-gradient(145deg, var(--surface), #17191e);
            border: 1px solid var(--gold-line);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .luxury-table {
            width: 100%;
            border-collapse: collapse;
        }

        .luxury-table th {
            padding: 18px 24px;
            text-align: right;
            color: var(--muted);
            font-size: 13px;
            font-weight: 700;
            border-bottom: 1px solid var(--gold-soft);
            background: rgba(0, 0, 0, 0.1);
        }

        .luxury-table td {
            padding: 18px 24px;
            border-bottom: 1px solid rgba(201, 169, 97, 0.04);
            font-size: 14px;
            vertical-align: middle;
        }

        .luxury-table tbody tr:hover {
            background: rgba(201, 169, 97, 0.02);
        }

        /* شارات الحضور */
        .status-badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 11.5px;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .status-badge::before {
            content: '';
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: currentColor;
        }

        .badge-present {
            background: rgba(74, 222, 128, 0.08);
            color: var(--success);
            border: 1px solid rgba(74, 222, 128, 0.15);
        }

        .badge-late {
            background: rgba(251, 191, 36, 0.08);
            color: var(--warning);
            border: 1px solid rgba(251, 191, 36, 0.15);
        }

        .badge-forgot {
            background: rgba(248, 113, 113, 0.08);
            color: var(--danger);
            border: 1px solid rgba(248, 113, 113, 0.15);
        }

        .time-box {
            font-weight: 700;
            color: #fff;
            background: rgba(255, 255, 255, 0.03);
            padding: 4px 10px;
            border-radius: 6px;
            border: 1px solid rgba(255, 255, 255, 0.05);
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-add-manual {
            background: rgba(201, 169, 97, 0.1);
            color: var(--gold);
            border: 1px solid rgba(201, 169, 97, 0.2);
            padding: 10px 18px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 700;
            font-size: 13px;
            font-family: 'Tajawal', sans-serif;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s ease;
        }

        .btn-add-manual:hover {
            background: var(--gold);
            color: #1c1f27;
        }

        .btn-action {
            width: 32px;
            height: 32px;
            border-radius: 6px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: none;
            cursor: pointer;
            font-size: 13px;
            transition: all 0.15s ease;
            text-decoration: none;
        }

        .btn-delete {
            background: rgba(248, 113, 113, 0.1);
            color: var(--danger);
            border: 1px solid rgba(248, 113, 113, 0.15);
        }

        .btn-delete:hover {
            background: var(--danger);
            color: #fff;
        }
    </style>
@endsection

@section('content')
    <div class="dashboard-wrapper attendance-container">
        <div style="margin-bottom: 18px;">
            <x-flash-message />
        </div>

        <div class="page-header">
            <div>
                <h2 class="page-header-title">تقارير حضور وانصراف المدربين</h2>
                <span style="color: var(--muted); font-size: 13px;">تتبع ومراقبة الأداء الزمني وساعات العمل الفعلية للموظفين
                    والمدربين</span>
            </div>
            <button class="btn-add-manual" onclick="toggleModal('addManualModal')">
                <i class="fas fa-plus"></i> تسجيل حضور يدوي موظف
            </button>
        </div>

        <div class="stats-grid">
            <div class="stat-card-luxury">
                <div class="info">
                    <h4>حاضرين اليوم</h4>
                    <p>{{ $stats['total_present'] }}</p>
                </div>
                <div class="icon-box" style="background: rgba(74, 222, 128, 0.1); color: var(--success);">
                    <i class="fas fa-user-check"></i>
                </div>
            </div>
            <div class="stat-card-luxury">
                <div class="info">
                    <h4>حالات التأخير اليوم</h4>
                    <p>{{ $stats['total_late'] }}</p>
                </div>
                <div class="icon-box" style="background: rgba(251, 191, 36, 0.1); color: var(--warning);">
                    <i class="fas fa-user-clock"></i>
                </div>
            </div>
        </div>

        <div class="filter-panel">
            <form action="{{ route('admin.attendance.employees.index') }}" method="GET">
                <div class="filter-grid">
                    <div class="form-group-luxury">
                        <label>الموظف / المدرب</label>
                        <select name="employee_id" class="input-luxury">
                            <option value="">كل الموظفين</option>
                            @foreach ($employees as $emp)
                                <option value="{{ $emp->id }}"
                                    {{ request('employee_id') == $emp->id ? 'selected' : '' }}>{{ $emp->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group-luxury">
                        <label>الحالة</label>
                        <select name="status" class="input-luxury">
                            <option value="">كل الحالات</option>
                            <option value="present" {{ request('status') == 'present' ? 'selected' : '' }}>حاضر (Present)
                            </option>
                            <option value="late" {{ request('status') == 'late' ? 'selected' : '' }}>متأخر (Late)</option>
                        </select>
                    </div>

                    <div class="form-group-luxury">
                        <label>من تاريخ</label>
                        <input type="date" name="date_from" value="{{ request('date_from') }}" class="input-luxury">
                    </div>

                    <div class="form-group-luxury">
                        <label>إلى تاريخ</label>
                        <input type="date" name="date_to" value="{{ request('date_to') }}" class="input-luxury">
                    </div>

                    <div style="display: flex; gap: 10px;">
                        <button type="submit" class="btn-submit-filter" style="flex: 1;">
                            <i class="fas fa-filter"></i> فلترة
                        </button>
                        <a href="{{ route('admin.attendance.employees.index') }}" class="btn-clear-filter">إعادة تعيين</a>
                    </div>
                </div>
            </form>
        </div>

        <div class="panel-luxury">
            <div style="overflow-x: auto;">
                <table class="luxury-table">
                    <thead>
                        <tr>
                            <th>اسم الموظف / المدرب</th>
                            <th>تاريخ اليوم</th>
                            <th>حالة الحضور</th>
                            <th style="text-align: center;">وقت الحضور</th>
                            <th style="text-align: center;">إجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($logs as $log)
                            <tr>
                                <td style="font-weight: 700; color: #fff;">{{ $log->employee->name }}</td>
                                <td><i class="far fa-calendar-alt"
                                        style="margin-left: 6px; color: var(--gold);"></i>{{ $log->attendance_date->format('Y-m-d') }}
                                </td>
                                <td>
                                    @if ($log->status == 'present')
                                        <span class="status-badge badge-present">حاضر</span>
                                    @elseif($log->status == 'late')
                                        <span class="status-badge badge-late">متأخر</span>
                                    @else
                                        <span class="status-badge badge-present">{{ $log->status }}</span>
                                    @endif
                                </td>
                                <td style="text-align: center;">
                                    <span class="time-box"><i class="far fa-clock"
                                            style="color: var(--success);"></i>{{ $log->recorded_at ? $log->recorded_at->format('H:i A') : '---' }}</span>
                                </td>
                                <td style="text-align: center;">
                                    <form action="{{ route('admin.attendance.employees.destroy', $log->id) }}"
                                        method="POST" style="display:inline;"
                                        onsubmit="return confirm('هل أنت متأكد من حذف هذا السجل نهائياً؟');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action btn-delete" title="حذف السجل"><i
                                                class="fas fa-trash-alt"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" style="text-align: center; padding: 50px; color: var(--muted);">
                                    <i class="fas fa-clipboard-user fa-2x"
                                        style="display: block; margin-bottom: 12px; color: var(--gold-line);"></i>
                                    لا توجد سجلات حضور مطابقة للفلاتر المحددة.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div style="margin-top: 15px;">
            {{ $logs->links() }}
        </div>
    </div>

    <div id="addManualModal"
        style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.7); z-index: 9999; align-items: center; justify-content: center;">
        <div
            style="background: var(--surface); border: 1px solid var(--gold-line); border-radius: 16px; width: 500px; padding: 25px; box-shadow: 0 10px 30px rgba(0,0,0,0.5);">
            <div
                style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; border-bottom: 1px solid var(--gold-soft); padding-bottom: 10px;">
                <h3 style="margin: 0; color: #fff; font-size: 16px;"><i class="fas fa-user-plus"
                        style="color:var(--gold); margin-left: 8px;"></i>تسجيل قيد حضور يدوي</h3>
                <button onclick="toggleModal('addManualModal')"
                    style="background:none; border:none; color:var(--muted); cursor:pointer; font-size: 18px;"><i
                        class="fas fa-times"></i></button>
            </div>
            <form action="{{ route('admin.attendance.employees.store') }}" method="POST">
                @csrf
                <div style="display: flex; flex-direction: column; gap: 15px;">
                    <div class="form-group-luxury">
                        <label>اختر الموظف / المدرب</label>
                        <select name="employee_id" class="input-luxury" required>
                            <option value="">اختر موظف...</option>
                            @foreach ($employees as $emp)
                                <option value="{{ $emp->id }}">{{ $emp->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group-luxury">
                        <label>تاريخ الحضور</label>
                        <input type="date" name="attendance_date" value="{{ date('Y-m-d') }}"
                            max="{{ date('Y-m-d') }}" class="input-luxury" required>
                    </div>
                    <div class="form-group-luxury">
                        <label>وقت الحضور</label>
                        <input type="time" name="recorded_at" class="input-luxury" required>
                    </div>
                    <div class="form-group-luxury">
                        <label>حالة التواجد</label>
                        <select name="status" class="input-luxury" required>
                            <option value="present">حاضر في الوقت (Present)</option>
                            <option value="late">متأخر عن الوردية (Late)</option>
                        </select>
                    </div>
                    <div style="display: flex; gap: 10px; margin-top: 10px; justify-content: flex-end;">
                        <button type="button" onclick="toggleModal('addManualModal')" class="btn-clear-filter"
                            style="padding: 8px 16px;">إلغاء</button>
                        <button type="submit" class="btn-submit-filter" style="padding: 8px 24px;">حفظ السجل</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        function toggleModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal.style.display === 'none' || modal.style.display === '') {
                modal.style.display = 'flex';
            } else {
                modal.style.display = 'none';
            }
        }
    </script>
@endsection
