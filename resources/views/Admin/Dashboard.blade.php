@extends('Admin.layouts.app')

@section('title', 'لوحة تحكم المدير | Elite Club')

@section('styles')
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800&display=swap" rel="stylesheet">
    <style>
        .dashboard-wrapper {
            font-family: 'Tajawal', sans-serif;
        }

        /* ===== شبكة مؤشرات الأداء (KPI) ===== */
        .kpi-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 18px;
            margin-bottom: 24px;
        }

        .kpi-card {
            position: relative;
            background: linear-gradient(160deg, #141a26, #10141d);
            border: 1px solid rgba(201, 169, 97, 0.14);
            border-radius: 16px;
            padding: 22px;
            overflow: hidden;
            transition: 0.3s ease;
        }

        .kpi-card::before {
            content: '';
            position: absolute;
            inset: 0 0 auto 0;
            height: 3px;
            background: var(--kpi-color, #c9a961);
            opacity: 0.85;
        }

        .kpi-card:hover {
            transform: translateY(-4px);
            border-color: rgba(201, 169, 97, 0.3);
            box-shadow: 0 14px 30px rgba(0, 0, 0, 0.35);
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
            color: var(--kpi-color, #c9a961);
            background: color-mix(in srgb, var(--kpi-color, #c9a961) 12%, transparent);
        }

        .kpi-tag {
            font-size: 11px;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 20px;
            color: var(--kpi-color, #c9a961);
            background: color-mix(in srgb, var(--kpi-color, #c9a961) 12%, transparent);
        }

        .kpi-value {
            font-size: 34px;
            font-weight: 800;
            line-height: 1;
            color: #f3f1ea;
            margin-bottom: 6px;
        }

        .kpi-label {
            font-size: 13px;
            color: #8a8f9c;
        }

        /* ===== الألواح ===== */
        .panel {
            background: #121722;
            border: 1px solid rgba(201, 169, 97, 0.12);
            border-radius: 16px;
            margin-bottom: 24px;
            overflow: hidden;
        }

        .panel-head {
            padding: 18px 24px;
            border-bottom: 1px solid rgba(201, 169, 97, 0.12);
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
            color: #f3f1ea;
            margin: 0;
        }

        .panel-head h3::before {
            content: '';
            width: 4px;
            height: 18px;
            border-radius: 4px;
            background: linear-gradient(180deg, #c9a961, #8a6d2f);
        }

        /* ===== صف الإحصائيات ===== */
        .stats-row {
            display: grid;
            grid-template-columns: 320px 1fr;
            gap: 24px;
            margin-bottom: 24px;
        }

        .stats-row .panel {
            margin-bottom: 0;
        }

        .donut-wrap {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 18px;
            padding: 26px 24px;
        }

        .donut {
            position: relative;
            width: 170px;
            height: 170px;
            border-radius: 50%;
            background: conic-gradient(#5a9c7a 0 var(--p-active),
                    #c55a5a var(--p-active) var(--p-expired),
                    #5a5f6e var(--p-expired) 100%);
        }

        .donut::after {
            content: '';
            position: absolute;
            inset: 22px;
            border-radius: 50%;
            background: #121722;
        }

        .donut-center {
            position: absolute;
            inset: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            z-index: 1;
        }

        .donut-center .num {
            font-size: 30px;
            font-weight: 800;
            color: #f3f1ea;
        }

        .donut-center .cap {
            font-size: 12px;
            color: #8a8f9c;
        }

        .legend {
            display: flex;
            flex-direction: column;
            gap: 10px;
            width: 100%;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13px;
            color: #cfcabb;
        }

        .legend-dot {
            width: 12px;
            height: 12px;
            border-radius: 4px;
            flex-shrink: 0;
        }

        .legend-item .val {
            margin-inline-start: auto;
            font-weight: 700;
            color: #f3f1ea;
        }

        /* أشرطة النسب */
        .bars {
            padding: 24px;
            display: flex;
            flex-direction: column;
            gap: 20px;
            height: 100%;
            justify-content: center;
        }

        .bar-block .bar-label {
            display: flex;
            justify-content: space-between;
            font-size: 13px;
            color: #cfcabb;
            margin-bottom: 8px;
        }

        .bar-track {
            height: 10px;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.05);
            overflow: hidden;
        }

        .bar-fill {
            height: 100%;
            border-radius: 20px;
            transition: width 0.6s ease;
        }

        /* ===== شريط الفلترة ===== */
        .filter-bar {
            padding: 20px 24px;
            background: rgba(0, 0, 0, 0.12);
            border-bottom: 1px solid rgba(201, 169, 97, 0.12);
        }

        .filter-form {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr auto;
            gap: 15px;
            align-items: end;
        }

        .field-label {
            display: block;
            color: var(--accent, #c9a961);
            font-size: 11px;
            margin-bottom: 6px;
        }

        .field-input {
            width: 100%;
            text-align: right;
            background: rgba(0, 0, 0, 0.25);
            border: 1px solid rgba(201, 169, 97, 0.25);
            color: #e8e6e1;
            padding: 9px 14px;
            border-radius: 8px;
            font-size: 13px;
            font-family: 'Tajawal', sans-serif;
            transition: 0.2s ease;
        }

        .field-input:focus {
            outline: none;
            border-color: #c9a961;
        }

        /* ===== الجداول ===== */
        .members-table {
            width: 100%;
            border-collapse: collapse;
            text-align: right;
        }

        .members-table th {
            font-size: 12px;
            color: #8a8f9c;
            padding: 14px 24px;
            border-bottom: 1px solid rgba(201, 169, 97, 0.12);
            font-weight: 600;
        }

        .members-table td {
            padding: 15px 24px;
            font-size: 14px;
            border-bottom: 1px solid rgba(201, 169, 97, 0.06);
            color: #e8e6e1;
        }

        .members-table tbody tr {
            transition: 0.2s ease;
        }

        .members-table tbody tr:hover {
            background: rgba(201, 169, 97, 0.04);
        }

        /* ===== الأزرار ===== */
        .action-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: transparent;
            border: 1px solid #c9a961;
            color: #c9a961;
            padding: 8px 16px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 12px;
            font-weight: 600;
            text-decoration: none;
            font-family: 'Tajawal', sans-serif;
            transition: 0.25s ease;
        }

        .action-btn:hover {
            background: #c9a961;
            color: #0a0d14;
        }

        .btn-solid {
            background: #c9a961;
            color: #0a0d14;
            border: none;
        }

        .btn-solid:hover {
            filter: brightness(1.08);
        }

        .btn-ghost {
            border-color: #5a5a5a;
            color: #8a8f9c;
        }

        .btn-ghost:hover {
            background: #5a5a5a;
            color: #fff;
        }

        .btn-green {
            border-color: #5a9c7a;
            color: #5a9c7a;
        }

        .btn-green:hover {
            background: #5a9c7a;
            color: #0a0d14;
        }

        /* ===== الشارات ===== */
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

        .status-chip.none {
            background: rgba(128, 128, 128, 0.12);
            color: #9ca3af;
        }

        .user-avatar {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: rgba(201, 169, 97, 0.15);
            color: #c9a961;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            font-weight: bold;
            border: 1px solid rgba(201, 169, 97, 0.25);
            flex-shrink: 0;
        }

        .employee-cell {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .empty-row td {
            text-align: center;
            padding: 40px;
            color: #8a8f9c;
        }

        /* ===== موبايل ===== */
        @media (max-width: 900px) {
            .stats-row {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 640px) {
            .filter-form {
                grid-template-columns: 1fr;
            }

            .panel {
                overflow-x: auto;
            }

            .members-table {
                min-width: 560px;
            }
        }
    </style>
@endsection

@section('content')
    <div class="dashboard-wrapper">
        {{-- ===== كاردات مؤشرات الأداء ===== --}}
        <div class="kpi-grid">
            <div class="kpi-card" style="--kpi-color:#c9a961;">
                <div class="kpi-top">
                    <div class="kpi-icon"><i class="fas fa-user-tie"></i></div>
                    <span class="kpi-tag">الطاقم</span>
                </div>
                <div class="kpi-value">{{ $employeesCount }}</div>
                <div class="kpi-label">إجمالي الموظفين</div>
            </div>

            <div class="kpi-card" style="--kpi-color:#818cf8;">
                <div class="kpi-top">
                    <div class="kpi-icon"><i class="fas fa-users"></i></div>
                    <span class="kpi-tag">الأعضاء</span>
                </div>
                <div class="kpi-value">{{ $playersCount }}</div>
                <div class="kpi-label">إجمالي اللاعبين</div>
            </div>

            <div class="kpi-card" style="--kpi-color:#5a9c7a;">
                <div class="kpi-top">
                    <div class="kpi-icon"><i class="fas fa-circle-check"></i></div>
                    <span class="kpi-tag">{{ $activePct }}%</span>
                </div>
                <div class="kpi-value">{{ $activeCount }}</div>
                <div class="kpi-label">اشتراكات فعّالة</div>
            </div>

            <div class="kpi-card" style="--kpi-color:#c55a5a;">
                <div class="kpi-top">
                    <div class="kpi-icon"><i class="fas fa-circle-exclamation"></i></div>
                    <span class="kpi-tag">{{ $expiredPct }}%</span>
                </div>
                <div class="kpi-value">{{ $expiredCount }}</div>
                <div class="kpi-label">اشتراكات منتهية</div>
            </div>
        </div>

        {{-- ===== صف الإحصائيات: مخطط دائري + أشرطة النسب ===== --}}
        <div class="stats-row">
            <div class="panel">
                <div class="panel-head">
                    <h3>توزيع الاشتراكات</h3>
                </div>
                <div class="donut-wrap">
                    <div class="donut" style="--p-active: {{ $activePct }}%; --p-expired: {{ $donutExpiredStop }}%;">
                        <div class="donut-center">
                            <span class="num">{{ $totalSubs }}</span>
                            <span class="cap">إجمالي</span>
                        </div>
                    </div>
                    <div class="legend">
                        <div class="legend-item">
                            <span class="legend-dot" style="background:#5a9c7a;"></span> فعّالة
                            <span class="val">{{ $activeCount }}</span>
                        </div>
                        <div class="legend-item">
                            <span class="legend-dot" style="background:#c55a5a;"></span> منتهية
                            <span class="val">{{ $expiredCount }}</span>
                        </div>
                        <div class="legend-item">
                            <span class="legend-dot" style="background:#5a5f6e;"></span> بدون اشتراك
                            <span class="val">{{ $noneCount }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel">
                <div class="panel-head">
                    <h3>نظرة سريعة</h3>
                </div>
                <div class="bars">
                    <div class="bar-block">
                        <div class="bar-label"><span>نسبة الاشتراكات الفعّالة</span><span>{{ $activePct }}%</span></div>
                        <div class="bar-track">
                            <div class="bar-fill" style="width: {{ $activePct }}%; background:#5a9c7a;"></div>
                        </div>
                    </div>
                    <div class="bar-block">
                        <div class="bar-label"><span>نسبة الاشتراكات المنتهية</span><span>{{ $expiredPct }}%</span></div>
                        <div class="bar-track">
                            <div class="bar-fill" style="width: {{ $expiredPct }}%; background:#c55a5a;"></div>
                        </div>
                    </div>
                    <div class="bar-block">
                        <div class="bar-label"><span>لاعبون بدون اشتراك</span><span>{{ $nonePct }}%</span></div>
                        <div class="bar-track">
                            <div class="bar-fill" style="width: {{ $nonePct }}%; background:#5a5f6e;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ===== لوحة إدارة اللاعبين ===== --}}
        <div class="panel">
            <div class="panel-head">
                <h3>إدارة اللاعبين والاشتراكات</h3>
            </div>
            <div class="filter-bar">
                <form action="{{ route('admin.dashboard') }}" method="GET" class="filter-form">
                    {{-- بحث بالاسم --}}
                    <div>
                        <label class="field-label">بحث بالاسم</label>
                        <input type="text" name="name" class="field-input" value="{{ request('name') }}"
                            placeholder="اسم اللاعب...">
                    </div>

                    {{-- فلترة المدرب --}}
                    <div>
                        <label class="field-label">فلترة حسب المدرب</label>
                        <select name="coach_id" class="field-input">
                            <option value="">جميع المدربين</option>
                            @foreach ($coaches as $coach)
                                <option value="{{ $coach->id }}"
                                    {{ request('coach_id') == $coach->id ? 'selected' : '' }}>{{ $coach->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- فلترة حالة الاشتراك --}}
                    <div>
                        <label class="field-label">حالة الاشتراك</label>
                        <select name="subscription_status" class="field-input">
                            <option value="">كل الحالات</option>
                            <option value="active" {{ request('subscription_status') == 'active' ? 'selected' : '' }}>فعال
                            </option>
                            <option value="expired" {{ request('subscription_status') == 'expired' ? 'selected' : '' }}>
                                منتهي</option>
                        </select>
                    </div>

                    <div style="display: flex; gap: 8px;">
                        <button type="submit" class="action-btn btn-solid">تطبيق</button>
                        <a href="{{ route('admin.dashboard') }}" class="action-btn btn-ghost">إلغاء</a>
                    </div>
                </form>
            </div>
            <table class="members-table">
                <thead>
                    <tr>
                        <th>اسم اللاعب</th>
                        <th>نوع الاشتراك</th>
                        <th>تاريخ الانتهاء</th>
                        <th>الحالة</th>
                        <th>إجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($players as $player)
                        <tr>
                            <td style="font-weight: 500;">{{ $player->name }}</td>
                            <td>{{ $player->subscription->plan_name ?? 'غير مشترك' }}</td>
                            <td>{{ $player->subscription ? \Carbon\Carbon::parse($player->subscription->end_date)->format('Y-m-d') : '---' }}
                            </td>
                            <td>
                                @if ($player->subscription)
                                    <span
                                        class="status-chip {{ $player->subscription->isExpired() ? 'expired' : 'active' }}">
                                        {{ $player->subscription->isExpired() ? 'منتهي' : 'فعال' }}
                                    </span>
                                @else
                                    <span class="status-chip none">لا يوجد</span>
                                @endif
                            </td>
                            <td>
                                @if ($player->subscription)
                                    <a href="{{ route('subscriptions.renew', $player->subscription->id) }}"
                                        class="action-btn btn-green">تجديد</a>
                                @else
                                    <a href="#" class="action-btn btn-green">اشتراك جديد</a>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr class="empty-row">
                            <td colspan="5">لا توجد نتائج</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- ===== لوحة الموظفين ===== --}}
        <div class="panel">
            <div class="panel-head">
                <h3>طاقم الموظفين</h3>
            </div>
            <table class="members-table">
                <thead>
                    <tr>
                        <th>الموظف</th>
                        <th>التخصص</th>
                        <th>الحالة</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($employees as $trainer)
                        <tr>
                            <td>
                                <div class="employee-cell">
                                    <div class="user-avatar">{{ mb_substr($trainer->name, 0, 1) }}</div>
                                    <span>{{ $trainer->name }}</span>
                                </div>
                            </td>
                            <td style="color: #8a8f9c;">{{ $trainer->specialization ?? 'موظف' }}</td>
                            <td><span class="status-chip active">متاح</span></td>
                        </tr>
                    @empty
                        <tr class="empty-row">
                            <td colspan="3">لا يوجد موظفون</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
