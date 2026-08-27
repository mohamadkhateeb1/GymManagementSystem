@extends('Admin.layouts.app')

@section('title', 'لوحة تحكم المدير | Elite Club')

@section('styles')
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800&display=swap" rel="stylesheet">
    <style>
        .dashboard-wrapper {
            font-family: 'Tajawal', sans-serif;
        }

        /* ===== شبكة مؤشرات الأداء (KPI) — تصميم مُعاد بالكامل ===== */
        .kpi-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));
            gap: 16px;
            margin-bottom: 26px;
        }

        .kpi-card {
            position: relative;
            background: linear-gradient(150deg, #171d2b 0%, #10131c 100%);
            border: 1px solid rgba(255, 255, 255, 0.06);
            border-radius: 18px;
            padding: 20px;
            overflow: hidden;
            transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease;
        }

        .kpi-card::after {
            content: '';
            position: absolute;
            width: 130px;
            height: 130px;
            border-radius: 50%;
            background: var(--kpi-color, #c9a961);
            opacity: 0.08;
            top: -50px;
            left: -50px;
            filter: blur(10px);
            pointer-events: none;
        }

        .kpi-card:hover {
            transform: translateY(-5px);
            border-color: color-mix(in srgb, var(--kpi-color, #c9a961) 45%, transparent);
            box-shadow: 0 16px 34px rgba(0, 0, 0, 0.4);
        }

        .kpi-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
            position: relative;
            z-index: 1;
        }

        .kpi-icon {
            width: 44px;
            height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 13px;
            font-size: 18px;
            color: var(--kpi-color, #c9a961);
            background: color-mix(in srgb, var(--kpi-color, #c9a961) 14%, transparent);
            box-shadow: inset 0 0 0 1px color-mix(in srgb, var(--kpi-color, #c9a961) 25%, transparent);
        }

        .kpi-trend {
            font-size: 11px;
            font-weight: 800;
            padding: 4px 9px;
            border-radius: 20px;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .kpi-trend.up {
            color: #5a9c7a;
            background: rgba(90, 156, 122, 0.12);
        }

        .kpi-trend.down {
            color: #c55a5a;
            background: rgba(197, 90, 90, 0.12);
        }

        .kpi-trend.neutral {
            color: #9ca3af;
            background: rgba(156, 163, 175, 0.1);
        }

        .kpi-value {
            font-size: 28px;
            font-weight: 800;
            line-height: 1;
            color: #f5f3ec;
            margin-bottom: 8px;
            position: relative;
            z-index: 1;
        }

        .kpi-label {
            font-size: 12.5px;
            color: #8a8f9c;
            position: relative;
            z-index: 1;
        }

        /* ===== الألواح ===== */
        .panel {
            background: #121722;
            border: 1px solid rgba(201, 169, 97, 0.12);
            border-radius: 18px;
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
            font-size: 15.5px;
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

        .panel-sub {
            font-size: 12px;
            color: #6b7280;
        }

        /* ===== صف الرسوم البيانية ===== */
        .stats-row {
            display: grid;
            grid-template-columns: 340px 1fr;
            gap: 24px;
            margin-bottom: 24px;
            align-items: stretch;
        }

        .stats-row .panel {
            margin-bottom: 0;
        }

        .chart-wrap {
            padding: 20px 24px;
            display: flex;
            flex-direction: column;
            gap: 16px;
            height: 100%;
        }

        .doughnut-canvas-box {
            position: relative;
            max-width: 220px;
            margin: 0 auto;
        }

        .doughnut-center-label {
            position: absolute;
            inset: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            pointer-events: none;
        }

        .doughnut-center-label .num {
            font-size: 26px;
            font-weight: 800;
            color: #f3f1ea;
        }

        .doughnut-center-label .cap {
            font-size: 11px;
            color: #8a8f9c;
        }

        .legend {
            display: flex;
            flex-direction: column;
            gap: 9px;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13px;
            color: #cfcabb;
        }

        .legend-dot {
            width: 10px;
            height: 10px;
            border-radius: 3px;
            flex-shrink: 0;
        }

        .legend-item .val {
            margin-inline-start: auto;
            font-weight: 700;
            color: #f3f1ea;
        }

        .revenue-chart-box {
            flex: 1;
            min-height: 220px;
            position: relative;
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

        .btn-red {
            border-color: #c55a5a;
            color: #c55a5a;
        }

        .btn-red:hover {
            background: #c55a5a;
            color: #fff;
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

        /* ===== شريط الصفحات (Pagination) ===== */
        .pagination-wrap {
            padding: 16px 24px;
            border-top: 1px solid var(--border, rgba(201, 169, 97, 0.12));
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
            background: color-mix(in srgb, var(--accent, #6c63ff) 10%, var(--surface-2, transparent));
        }

        .gym-page-item.active span {
            background: var(--accent, #6c63ff);
            border-color: var(--accent, #6c63ff);
            color: #fff;
            box-shadow: 0 4px 12px color-mix(in srgb, var(--accent, #6c63ff) 35%, transparent);
        }

        .gym-page-item.disabled span {
            opacity: 0.35;
            cursor: default;
            background: transparent;
        }

        @media (max-width: 640px) {
            .gym-pagination {
                justify-content: center;
                text-align: center;
            }

            .gym-pagination-info {
                width: 100%;
                order: 2;
            }
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
        <div style="margin-bottom: 16px;">
            <x-flash-message />
        </div>

        {{-- ===== كاردات مؤشرات الأداء ===== --}}
        <div class="kpi-grid">
            <div class="kpi-card" style="--kpi-color:#c9a961;">
                <div class="kpi-top">
                    <div class="kpi-icon"><i class="fas fa-user-tie"></i></div>
                    <span class="kpi-trend neutral">الطاقم</span>
                </div>
                <div class="kpi-value">{{ $employeesCount }}</div>
                <div class="kpi-label">إجمالي الموظفين</div>
            </div>

            <div class="kpi-card" style="--kpi-color:#818cf8;">
                <div class="kpi-top">
                    <div class="kpi-icon"><i class="fas fa-users"></i></div>
                    <span class="kpi-trend neutral">الأعضاء</span>
                </div>
                <div class="kpi-value">{{ $playersCount }}</div>
                <div class="kpi-label">إجمالي اللاعبين</div>
            </div>

            <div class="kpi-card" style="--kpi-color:#5a9c7a;">
                <div class="kpi-top">
                    <div class="kpi-icon"><i class="fas fa-circle-check"></i></div>
                    <span class="kpi-trend up">{{ $activePct }}%</span>
                </div>
                <div class="kpi-value">{{ $activeCount }}</div>
                <div class="kpi-label">اشتراكات فعّالة</div>
            </div>

            <div class="kpi-card" style="--kpi-color:#c55a5a;">
                <div class="kpi-top">
                    <div class="kpi-icon"><i class="fas fa-circle-exclamation"></i></div>
                    <span class="kpi-trend down">{{ $expiredPct }}%</span>
                </div>
                <div class="kpi-value">{{ $expiredCount }}</div>
                <div class="kpi-label">اشتراكات منتهية</div>
            </div>

            <div class="kpi-card" style="--kpi-color:#9ca3af;">
                <div class="kpi-top">
                    <div class="kpi-icon"><i class="fas fa-user-slash"></i></div>
                    <span class="kpi-trend neutral">{{ $nonePct }}%</span>
                </div>
                <div class="kpi-value">{{ $noneCount }}</div>
                <div class="kpi-label">بدون اشتراك</div>
            </div>

            <div class="kpi-card" style="--kpi-color:#5a9c7a;">
                <div class="kpi-top">
                    <div class="kpi-icon"><i class="fas fa-sack-dollar"></i></div>
                    @if ($revenueChangePct > 0)
                        <span class="kpi-trend up"><i class="fas fa-arrow-up"></i> {{ $revenueChangePct }}%</span>
                    @elseif ($revenueChangePct < 0)
                        <span class="kpi-trend down"><i class="fas fa-arrow-down"></i> {{ abs($revenueChangePct) }}%</span>
                    @else
                        <span class="kpi-trend neutral">0%</span>
                    @endif
                </div>
                <div class="kpi-value">{{ number_format($monthRevenue, 2) }}</div>
                <div class="kpi-label">إيرادات الشهر الحالي</div>
            </div>

            <div class="kpi-card" style="--kpi-color:#f59e0b;">
                <div class="kpi-top">
                    <div class="kpi-icon"><i class="fas fa-triangle-exclamation"></i></div>
                    <span class="kpi-trend down">تنبيه</span>
                </div>
                <div class="kpi-value">{{ $expiringSoonCount }}</div>
                <div class="kpi-label">تنتهي خلال 7 أيام</div>
            </div>
        </div>

        {{-- ===== صف الرسوم البيانية ===== --}}
        <div class="stats-row">
            <div class="panel">
                <div class="panel-head">
                    <h3>توزيع الاشتراكات</h3>
                </div>
                <div class="chart-wrap">
                    <div class="doughnut-canvas-box">
                        <canvas id="subscriptionsDoughnut"></canvas>
                        <div class="doughnut-center-label">
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
                    <h3>الإيرادات — آخر 6 أشهر</h3>
                    <span class="panel-sub">{{ number_format($monthlyRevenue->sum('total'), 2) }} إجمالي الفترة</span>
                </div>
                <div class="chart-wrap">
                    <div class="revenue-chart-box">
                        <canvas id="revenueChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        {{-- ===== لوحة إدارة اللاعبين واختصارات التجميد الفوري ===== --}}
        <div class="panel">
            <div class="panel-head">
                <h3>إدارة اللاعبين والاشتراكات</h3>
            </div>
            <div class="filter-bar">
                <form action="{{ route('admin.dashboard') }}" method="GET" class="filter-form">
                    <div>
                        <label class="field-label">بحث بالاسم</label>
                        <input type="text" name="name" class="field-input" value="{{ request('name') }}"
                            placeholder="اسم اللاعب...">
                    </div>

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
                        <th style="width: 25%; text-align: center;">إجراءات الاشتراك والتحكم</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($players as $player)
                        @php
                            $isActiveNow = $player->hasActiveSubscription();
                        @endphp
                        <tr>
                            <td style="font-weight: 500;">{{ $player->name }}</td>
                            <td>{{ $player->subscription->plan_name ?? 'غير مشترك' }}</td>
                            <td>{{ $player->subscription ? \Carbon\Carbon::parse($player->subscription->end_date)->format('Y-m-d') : '---' }}
                            </td>
                            <td>
                                @if ($player->subscription)
                                    <span class="status-chip {{ $isActiveNow ? 'active' : 'expired' }}">
                                        {{ $isActiveNow ? 'فعال' : 'منتهي/مجمد' }}
                                    </span>
                                @else
                                    <span class="status-chip none">لا يوجد</span>
                                @endif
                            </td>
                            <td style="text-align: center;">
                                <div style="display: flex; gap: 6px; justify-content: center;">
                                    @if ($player->subscription)
                                        <a href="{{ route('subscriptions.renew', $player->subscription->id) }}"
                                            class="action-btn btn-green">تجديد</a>

                                        <form
                                            action="{{ route('admin.subscriptions.toggle', $player->subscription->id) }}"
                                            method="POST" style="display: inline;">
                                            @csrf
                                            @if ($player->subscription->status === 'active')
                                                <button type="submit" class="action-btn btn-red"
                                                    onclick="return confirm('هل أنت متأكد من إلغاء تفعيل اشتراك هذا اللاعب وتجميد صلاحياته الفورية؟')">
                                                    <i class="fas fa-user-slash" style="margin-left: 4px;"></i> إلغاء
                                                    التفعيل
                                                </button>
                                            @else
                                                <button type="submit" class="action-btn btn-green">
                                                    <i class="fas fa-user-check" style="margin-left: 4px;"></i> تفعيل
                                                    الاشتراك
                                                </button>
                                            @endif
                                        </form>
                                    @else
                                        <a href="#" class="action-btn btn-green">اشتراك جديد</a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr class="empty-row">
                            <td colspan="5">لا توجد نتائج</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            @if ($players->hasPages())
                <div class="pagination-wrap">
                    <nav class="gym-pagination">
                        <div class="gym-pagination-info">
                            عرض {{ $players->firstItem() }} إلى {{ $players->lastItem() }} من أصل {{ $players->total() }}
                            نتيجة
                        </div>

                        <ul class="gym-pagination-list">
                            @if ($players->onFirstPage())
                                <li class="gym-page-item disabled"><span><i class="fas fa-chevron-right"></i></span></li>
                            @else
                                <li class="gym-page-item">
                                    <a href="{{ $players->previousPageUrl() }}"><i class="fas fa-chevron-right"></i></a>
                                </li>
                            @endif

                            @for ($page = 1; $page <= $players->lastPage(); $page++)
                                @if ($page == $players->currentPage())
                                    <li class="gym-page-item active"><span>{{ $page }}</span></li>
                                @else
                                    <li class="gym-page-item">
                                        <a href="{{ $players->url($page) }}">{{ $page }}</a>
                                    </li>
                                @endif
                            @endfor

                            @if ($players->hasMorePages())
                                <li class="gym-page-item">
                                    <a href="{{ $players->nextPageUrl() }}"><i class="fas fa-chevron-left"></i></a>
                                </li>
                            @else
                                <li class="gym-page-item disabled"><span><i class="fas fa-chevron-left"></i></span></li>
                            @endif
                        </ul>
                    </nav>
                </div>
            @endif
        </div>

        {{-- ===== لوحة الموظفين مع حضورهم الفعلي اليوم ===== --}}
        <div class="panel">
            <div class="panel-head">
                <h3>طاقم الموظفين — حضور اليوم</h3>
            </div>
            <table class="members-table">
                <thead>
                    <tr>
                        <th>الموظف</th>
                        <th>التخصص</th>
                        <th>حالة الحضور اليوم</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($employees as $trainer)
                        @php
                            $todayLog = $trainer->attendanceLogs->first();
                        @endphp
                        <tr>
                            <td>
                                <div class="employee-cell">
                                    <div class="user-avatar">{{ mb_substr($trainer->name, 0, 1) }}</div>
                                    <span>{{ $trainer->name }}</span>
                                </div>
                            </td>
                            <td style="color: #8a8f9c;">{{ $trainer->specialization ?? 'موظف' }}</td>
                            <td>
                                @if (!$todayLog)
                                    <span class="status-chip none">لم يسجّل الحضور بعد</span>
                                @elseif ($todayLog->status === 'late')
                                    <span class="status-chip expired">متأخر
                                        ({{ $todayLog->recorded_at->format('H:i') }})</span>
                                @else
                                    <span class="status-chip active">حاضر
                                        ({{ $todayLog->recorded_at->format('H:i') }})</span>
                                @endif
                            </td>
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

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.4/chart.umd.min.js"></script>
    <script>
        // ===== مخطط توزيع الاشتراكات (Doughnut) =====
        new Chart(document.getElementById('subscriptionsDoughnut'), {
            type: 'doughnut',
            data: {
                labels: ['فعّالة', 'منتهية', 'بدون اشتراك'],
                datasets: [{
                    data: [{{ $activeCount }}, {{ $expiredCount }}, {{ $noneCount }}],
                    backgroundColor: ['#5a9c7a', '#c55a5a', '#5a5f6e'],
                    borderColor: '#121722',
                    borderWidth: 3,
                    hoverOffset: 6,
                }]
            },
            options: {
                cutout: '72%',
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        rtl: true,
                        titleFont: {
                            family: 'Tajawal'
                        },
                        bodyFont: {
                            family: 'Tajawal'
                        },
                    }
                }
            }
        });

        // ===== مخطط الإيرادات آخر 6 أشهر (Bar) =====
        const monthlyRevenue = @json($monthlyRevenue);

        new Chart(document.getElementById('revenueChart'), {
            type: 'bar',
            data: {
                labels: monthlyRevenue.map(m => m.label),
                datasets: [{
                    label: 'الإيرادات',
                    data: monthlyRevenue.map(m => m.total),
                    backgroundColor: '#c9a961',
                    borderRadius: 8,
                    maxBarThickness: 42,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        rtl: true,
                        titleFont: {
                            family: 'Tajawal'
                        },
                        bodyFont: {
                            family: 'Tajawal'
                        },
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#8a8f9c',
                            font: {
                                family: 'Tajawal'
                            }
                        }
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(255,255,255,0.05)'
                        },
                        ticks: {
                            color: '#8a8f9c',
                            font: {
                                family: 'Tajawal'
                            }
                        }
                    }
                }
            }
        });
    </script>
@endsection
