@extends('Admin.layouts.app')

@section('title', 'لوحة تحكم المدير | Elite Club')

@section('page-title', 'لوحة التحكم')

@section('page-description', 'نظرة سريعة على أداء النادي والاشتراكات والموظفين')

@section('styles')

<style>

/* =========================================================
   DASHBOARD
   ========================================================= */

.dashboard-wrapper {
    width: 100%;
}


/* =========================================================
   PANELS
   ========================================================= */

.panel {

    background: var(--surface);

    border: 1px solid var(--border);

    border-radius: 16px;

    box-shadow: var(--shadow-sm);

    overflow: hidden;

    transition:
        background .25s ease,
        border-color .25s ease,
        box-shadow .25s ease;
}


.panel-head {

    min-height: 64px;

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 15px;

    padding: 14px 18px;

    border-bottom: 1px solid var(--border-soft);
}


.panel-head h3 {

    margin: 0;

    display: flex;

    align-items: center;

    gap: 9px;

    color: var(--text);

    font-size: 14px;

    font-weight: 800;
}


.panel-head h3 i {

    color: var(--gold);

    font-size: 14px;
}


.panel-sub {

    color: var(--muted);

    font-size: 10px;
}


/* =========================================================
   KPI CARDS
   ========================================================= */

.kpi-card {

    position: relative;

    min-height: 145px;

    padding: 18px;

    background: var(--surface);

    border: 1px solid var(--border);

    border-radius: 16px;

    box-shadow: var(--shadow-sm);

    overflow: hidden;

    transition:
        transform .2s ease,
        box-shadow .2s ease,
        background .25s ease;
}


.kpi-card::before {

    content: "";

    position: absolute;

    top: 0;

    right: 0;

    width: 100%;

    height: 3px;

    background: var(--kpi-color);
}


.kpi-card:hover {

    transform: translateY(-2px);

    box-shadow: var(--shadow-md);
}


.kpi-top {

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 10px;
}


.kpi-icon {

    width: 39px;

    height: 39px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 11px;

    background:
        color-mix(
            in srgb,
            var(--kpi-color) 12%,
            transparent
        );

    color: var(--kpi-color);

    font-size: 14px;
}


.kpi-trend {

    padding: 5px 8px;

    border-radius: 7px;

    background: var(--surface-3);

    color: var(--muted);

    font-size: 9px;

    font-weight: 700;
}


.kpi-trend.up {

    background: var(--success-bg);

    color: var(--success);
}


.kpi-trend.down {

    background: var(--danger-bg);

    color: var(--danger);
}


.kpi-trend.warn {

    background: var(--warning-bg);

    color: var(--warning);
}


.kpi-value {

    margin-top: 15px;

    color: var(--text);

    font-size: 27px;

    font-weight: 900;

    line-height: 1;
}


.kpi-label {

    margin-top: 7px;

    color: var(--muted);

    font-size: 10.5px;

    font-weight: 500;
}


/* =========================================================
   CHARTS
   ========================================================= */

.chart-wrap {

    padding: 20px;
}


.doughnut-canvas-box {

    position: relative;

    width: 190px;

    height: 190px;

    margin: 0 auto;
}


.doughnut-canvas-box canvas {

    width: 100% !important;

    height: 100% !important;
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

    color: var(--text);

    font-size: 27px;

    font-weight: 900;
}


.doughnut-center-label .cap {

    margin-top: 3px;

    color: var(--muted);

    font-size: 10px;
}


.legend {

    display: flex;

    flex-direction: column;

    gap: 9px;

    margin-top: 15px;
}


.legend-item {

    display: flex;

    align-items: center;

    gap: 8px;

    color: var(--text-soft);

    font-size: 11px;
}


.legend-dot {

    width: 8px;

    height: 8px;

    border-radius: 50%;
}


.legend-item .val {

    margin-right: auto;

    color: var(--text);

    font-weight: 800;
}


.revenue-chart-box {

    position: relative;

    height: 280px;
}


/* =========================================================
   SECTION TITLE
   ========================================================= */

.section-kicker {

    margin: 25px 3px 10px;

    color: var(--muted);

    font-size: 10px;

    font-weight: 800;

    letter-spacing: .3px;
}


/* =========================================================
   FILTER
   ========================================================= */

.filter-bar {

    padding: 17px 18px;

    border-bottom: 1px solid var(--border-soft);

    background: var(--surface-2);
}


.field-label {

    display: block;

    margin-bottom: 6px;

    color: var(--text-soft);

    font-size: 10px;

    font-weight: 700;
}


.field-input {

    width: 100%;

    min-height: 39px;

    padding: 7px 11px;

    border: 1px solid var(--input-border);

    border-radius: 9px;

    outline: none;

    background: var(--input-bg);

    color: var(--text);

    font-size: 11px;

    transition: .2s ease;
}


.field-input:focus {

    border-color:
        rgba(184, 146, 62, .55);

    box-shadow:
        0 0 0 3px
        rgba(184, 146, 62, .08);
}


/* =========================================================
   BUTTONS
   ========================================================= */

.action-btn {

    min-height: 38px;

    display: inline-flex;

    align-items: center;

    justify-content: center;

    gap: 6px;

    padding: 7px 12px;

    border-radius: 9px;

    border: 1px solid transparent;

    font-family: 'Tajawal', sans-serif;

    font-size: 10.5px;

    font-weight: 700;

    transition: .2s ease;

    cursor: pointer;
}


.btn-solid {

    background: var(--gold);

    color: #fff;

    border-color: var(--gold);
}


.btn-solid:hover {

    background: var(--gold-dark);

    border-color: var(--gold-dark);

    color: #fff;

    transform: translateY(-1px);
}


.btn-ghost {

    background: var(--surface);

    color: var(--text-soft);

    border-color: var(--border);
}


.btn-ghost:hover {

    color: var(--gold-dark);

    border-color:
        rgba(184, 146, 62, .35);

    background: var(--surface-hover);
}


.btn-green {

    background: var(--success-bg);

    color: var(--success);

    border-color:
        rgba(63, 140, 104, .18);
}


.btn-green:hover {

    background: var(--success);

    color: #fff;
}


.btn-red {

    background: var(--danger-bg);

    color: var(--danger);

    border-color:
        rgba(196, 93, 93, .18);
}


.btn-red:hover {

    background: var(--danger);

    color: #fff;
}


/* =========================================================
   TABLE
   ========================================================= */

.table-responsive {

    overflow-x: auto;
}


.members-table {

    width: 100%;

    border-collapse: collapse;

    min-width: 700px;
}


.members-table th {

    padding: 13px 16px;

    background: var(--surface-2);

    border-bottom: 1px solid var(--border);

    color: var(--muted);

    font-size: 9.5px;

    font-weight: 800;

    text-align: right;

    white-space: nowrap;
}


.members-table td {

    padding: 13px 16px;

    border-bottom: 1px solid var(--border-soft);

    color: var(--text-soft);

    font-size: 10.5px;

    vertical-align: middle;
}


.members-table tbody tr {

    transition: background .18s ease;
}


.members-table tbody tr:hover {

    background: var(--surface-hover);
}


.members-table tbody tr:last-child td {

    border-bottom: 0;
}


/* =========================================================
   USER
   ========================================================= */

.employee-cell {

    display: flex;

    align-items: center;

    gap: 9px;

    color: var(--text);

    white-space: nowrap;
}


.user-avatar-sm {

    width: 32px;

    height: 32px;

    display: flex;

    align-items: center;

    justify-content: center;

    flex: 0 0 32px;

    border-radius: 9px;

    background:
        linear-gradient(
            135deg,
            var(--gold-light),
            var(--gold)
        );

    color: #fff;

    font-size: 11px;

    font-weight: 800;
}


/* =========================================================
   STATUS
   ========================================================= */

.status-chip {

    display: inline-flex;

    align-items: center;

    padding: 5px 9px;

    border-radius: 7px;

    font-size: 9px;

    font-weight: 700;
}


.status-chip.active {

    background: var(--success-bg);

    color: var(--success);
}


.status-chip.expired {

    background: var(--danger-bg);

    color: var(--danger);
}


.status-chip.none {

    background: var(--surface-3);

    color: var(--muted);
}


/* =========================================================
   PAGINATION
   ========================================================= */

.pagination-wrap {

    padding: 14px 18px;

    border-top: 1px solid var(--border-soft);
}


.gym-pagination {

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 15px;

    flex-wrap: wrap;
}


.gym-pagination-info {

    color: var(--muted);

    font-size: 9.5px;
}


.gym-pagination-list {

    display: flex;

    align-items: center;

    gap: 5px;

    list-style: none;

    padding: 0;

    margin: 0;
}


.gym-page-item a,
.gym-page-item span {

    min-width: 30px;

    height: 30px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 8px;

    border: 1px solid var(--border);

    background: var(--surface);

    color: var(--text-soft);

    font-size: 10px;

    transition: .2s ease;
}


.gym-page-item a:hover {

    color: var(--gold-dark);

    border-color:
        rgba(184, 146, 62, .35);

    background: var(--surface-hover);
}


.gym-page-item.active span {

    color: #fff;

    background: var(--gold);

    border-color: var(--gold);
}


.gym-page-item.disabled span {

    opacity: .45;

    cursor: not-allowed;
}


/* =========================================================
   EMPTY
   ========================================================= */

.empty-row td {

    padding: 35px !important;

    text-align: center;

    color: var(--muted) !important;
}


/* =========================================================
   MOBILE
   ========================================================= */

@media (max-width: 768px) {

    .panel-head {

        min-height: 58px;

        padding: 12px 14px;
    }

    .panel-head h3 {

        font-size: 12px;
    }

    .panel-sub {

        display: none;
    }

    .chart-wrap {

        padding: 15px;
    }

    .doughnut-canvas-box {

        width: 170px;

        height: 170px;
    }

    .revenue-chart-box {

        height: 240px;
    }

    .gym-pagination {

        align-items: flex-start;

        flex-direction: column;
    }
}

</style>

@endsection
@section('content')
<div class="dashboard-wrapper">
    <div class="row g-3 mb-4">

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="kpi-card" style="--kpi-color:#d4af5a;">
                <div class="kpi-top">
                    <div class="kpi-icon"><i class="fas fa-users"></i></div>
                    <span class="kpi-trend">الأعضاء</span>
                </div>
                <div class="kpi-value" data-count-to="{{ $playersCount }}">0</div>
                <div class="kpi-label">إجمالي اللاعبين</div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="kpi-card" style="--kpi-color:#51c78b;">
                <div class="kpi-top">
                    <div class="kpi-icon"><i class="fas fa-circle-check"></i></div>
                    <span class="kpi-trend up">{{ $activePct }}%</span>
                </div>
                <div class="kpi-value" data-count-to="{{ $activeCount }}">0</div>
                <div class="kpi-label">اشتراكات فعّالة</div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="kpi-card" style="--kpi-color:#4b8ff7;">
                <div class="kpi-top">
                    <div class="kpi-icon"><i class="fas fa-sack-dollar"></i></div>
                    @if ($revenueChangePct > 0)
                        <span class="kpi-trend up"><i class="fas fa-arrow-up"></i> {{ $revenueChangePct }}%</span>
                    @elseif ($revenueChangePct < 0)
                        <span class="kpi-trend down"><i class="fas fa-arrow-down"></i> {{ abs($revenueChangePct) }}%</span>
                    @else
                        <span class="kpi-trend">0%</span>
                    @endif
                </div>
                <div class="kpi-value" data-count-to="{{ (float) $monthRevenue }}" data-decimals="2">0.00</div>
                <div class="kpi-label">إيرادات الشهر الحالي</div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="kpi-card" style="--kpi-color:#e6aa35;">
                <div class="kpi-top">
                    <div class="kpi-icon"><i class="fas fa-triangle-exclamation"></i></div>
                    <span class="kpi-trend warn">تنبيه</span>
                </div>
                <div class="kpi-value" data-count-to="{{ $expiringSoonCount }}">0</div>
                <div class="kpi-label">تنتهي خلال 7 أيام</div>
            </div>
        </div>

    </div>

    <div class="row g-3 mb-4">

        <div class="col-12 col-lg-5">
            <div class="panel">
                <div class="panel-head">
                    <h3><i class="fas fa-chart-pie"></i> توزيع الاشتراكات</h3>
                    <span class="panel-sub">الحالة الحالية</span>
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
                            <span class="legend-dot" style="background:#51c78b;color:#51c78b;"></span>
                            فعّالة
                            <span class="val">{{ $activeCount }}</span>
                        </div>
                        <div class="legend-item">
                            <span class="legend-dot" style="background:#ef6262;color:#ef6262;"></span>
                            منتهية
                            <span class="val">{{ $expiredCount }}</span>
                        </div>
                        <div class="legend-item">
                            <span class="legend-dot" style="background:#777;color:#777;"></span>
                            بدون اشتراك
                            <span class="val">{{ $noneCount }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-7">
            <div class="panel">
                <div class="panel-head">
                    <h3><i class="fas fa-chart-column"></i> الإيرادات — آخر 6 أشهر</h3>
                    <span class="panel-sub">{{ number_format($monthlyRevenue->sum('total'), 2) }} إجمالي الفترة</span>
                </div>

                <div class="chart-wrap">
                    <div class="revenue-chart-box">
                        <canvas id="revenueChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="section-kicker">إدارة النادي</div>

    <div class="panel mb-4">
        <div class="panel-head">
            <h3><i class="fas fa-users"></i> إدارة اللاعبين والاشتراكات</h3>
            <span class="panel-sub">بحث وتحكم مباشر</span>
        </div>

        <div class="filter-bar">
            <form action="{{ route('admin.dashboard') }}" method="GET" class="row g-3 align-items-end">

                <div class="col-12 col-md-3">
                    <label class="field-label">بحث بالاسم</label>
                    <input type="text" name="name" class="field-input" value="{{ request('name') }}" placeholder="اسم اللاعب...">
                </div>

                <div class="col-12 col-md-3">
                    <label class="field-label">فلترة حسب المدرب</label>
                    <select name="coach_id" class="field-input">
                        <option value="">جميع المدربين</option>
                        @foreach ($coaches as $coach)
                            <option value="{{ $coach->id }}" {{ request('coach_id') == $coach->id ? 'selected' : '' }}>
                                {{ $coach->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 col-md-3">
                    <label class="field-label">حالة الاشتراك</label>
                    <select name="subscription_status" class="field-input">
                        <option value="">كل الحالات</option>
                        <option value="active" {{ request('subscription_status') == 'active' ? 'selected' : '' }}>فعال</option>
                        <option value="expired" {{ request('subscription_status') == 'expired' ? 'selected' : '' }}>منتهي</option>
                    </select>
                </div>

                <div class="col-12 col-md-3 d-flex gap-2">
                    <button type="submit" class="action-btn btn-solid flex-fill">
                        <i class="fas fa-filter"></i> تطبيق
                    </button>
                    <a href="{{ route('admin.dashboard') }}" class="action-btn btn-ghost flex-fill text-center">
                        إلغاء
                    </a>
                </div>

            </form>
        </div>

        <div class="table-responsive">
            <table class="members-table">
                <thead>
                    <tr>
                        <th>اسم اللاعب</th>
                        <th>نوع الاشتراك</th>
                        <th>تاريخ الانتهاء</th>
                        <th>الحالة</th>
                        <th style="width:25%;text-align:center;">إجراءات الاشتراك والتحكم</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($players as $player)
                        @php
                            $isActiveNow = $player->hasActiveSubscription();
                        @endphp

                        <tr>
                            <td style="font-weight:600;">
                                <div class="employee-cell">
                                    <div class="user-avatar-sm">{{ mb_substr($player->name, 0, 1) }}</div>
                                    <span>{{ $player->name }}</span>
                                </div>
                            </td>

                            <td>{{ $player->subscription->plan_name ?? 'غير مشترك' }}</td>

                            <td>
                                {{ $player->subscription ? \Carbon\Carbon::parse($player->subscription->end_date)->format('Y-m-d') : '---' }}
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

                            <td style="text-align:center;">
                                <div class="d-flex gap-2 justify-content-center flex-wrap">
                                    @if ($player->subscription)

                                        <form action="{{ route('admin.subscriptions.toggle', $player->subscription->id) }}" method="POST" class="d-inline">
                                            @csrf

                                            @if ($player->subscription->status === 'active')
                                                <button type="submit" class="action-btn btn-red"
                                                    onclick="return confirm('هل أنت متأكد من إلغاء تفعيل اشتراك هذا اللاعب وتجميد صلاحياته الفورية؟')">
                                                    <i class="fas fa-user-slash"></i> إلغاء التفعيل
                                                </button>
                                            @else
                                                <button type="submit" class="action-btn btn-green">
                                                    <i class="fas fa-user-check"></i> تفعيل الاشتراك
                                                </button>
                                            @endif
                                        </form>

                                    @else
                                        <a href="#" class="action-btn btn-green">
                                            <i class="fas fa-plus"></i> اشتراك جديد
                                        </a>
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
        </div>

        @if ($players->hasPages())
            <div class="pagination-wrap">
                <nav class="gym-pagination">

                    <div class="gym-pagination-info">
                        عرض {{ $players->firstItem() }} إلى {{ $players->lastItem() }} من أصل {{ $players->total() }} نتيجة
                    </div>

                    <ul class="gym-pagination-list">

                        @if ($players->onFirstPage())
                            <li class="gym-page-item disabled">
                                <span><i class="fas fa-chevron-right"></i></span>
                            </li>
                        @else
                            <li class="gym-page-item">
                                <a href="{{ $players->previousPageUrl() }}">
                                    <i class="fas fa-chevron-right"></i>
                                </a>
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
                                <a href="{{ $players->nextPageUrl() }}">
                                    <i class="fas fa-chevron-left"></i>
                                </a>
                            </li>
                        @else
                            <li class="gym-page-item disabled">
                                <span><i class="fas fa-chevron-left"></i></span>
                            </li>
                        @endif

                    </ul>
                </nav>
            </div>
        @endif
    </div>

    <div class="section-kicker">فريق العمل</div>

    <div class="panel">
        <div class="panel-head">
            <h3><i class="fas fa-user-tie"></i> طاقم الموظفين — حضور اليوم</h3>
            <span class="panel-sub">متابعة الحضور</span>
        </div>

        <div class="table-responsive">
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
                                    <div class="user-avatar-sm">{{ mb_substr($trainer->name, 0, 1) }}</div>
                                    <span>{{ $trainer->name }}</span>
                                </div>
                            </td>

                            <td style="color:var(--muted);">
                                {{ $trainer->specialization ?? 'موظف' }}
                            </td>

                            <td>
                                @if (!$todayLog)
                                    <span class="status-chip none">لم يسجّل الحضور بعد</span>
                                @elseif ($todayLog->status === 'late')
                                    <span class="status-chip expired">
                                        متأخر ({{ $todayLog->recorded_at->format('H:i') }})
                                    </span>
                                @else
                                    <span class="status-chip active">
                                        حاضر ({{ $todayLog->recorded_at->format('H:i') }})
                                    </span>
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

</div>
@endsection

@section('scripts')

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    /* =========================================================
       CHECK CHART.JS
       ========================================================= */

    if (typeof Chart === 'undefined') {
        console.error('Chart.js لم يتم تحميله');
        return;
    }


    /* =========================================================
       COUNT UP
       ========================================================= */

    function animateCountUp(el) {

        const target = parseFloat(
            el.getAttribute('data-count-to') || 0
        );

        const decimals = parseInt(
            el.getAttribute('data-decimals') || '0',
            10
        );

        const duration = 900;
        const startTime = performance.now();

        function step(now) {

            const progress = Math.min(
                (now - startTime) / duration,
                1
            );

            const eased =
                1 - Math.pow(1 - progress, 3);

            const current = target * eased;

            el.textContent =
                decimals > 0
                    ? current.toFixed(decimals)
                    : Math.round(current);

            if (progress < 1) {
                requestAnimationFrame(step);
            }
        }

        requestAnimationFrame(step);
    }


    document
        .querySelectorAll('[data-count-to]')
        .forEach(animateCountUp);


    /* =========================================================
       GLOBAL CHART DEFAULTS
       ========================================================= */

    Chart.defaults.font.family = 'Tajawal, sans-serif';

    Chart.defaults.animation.duration = 900;

    Chart.defaults.animation.easing = 'easeOutQuart';


    /* =========================================================
       SUBSCRIPTIONS DOUGHNUT
       ========================================================= */

    const doughnutCanvas =
        document.getElementById('subscriptionsDoughnut');

    if (doughnutCanvas) {

        const activeCount =
            Number(@json($activeCount)) || 0;

        const expiredCount =
            Number(@json($expiredCount)) || 0;

        const noneCount =
            Number(@json($noneCount)) || 0;


        new Chart(doughnutCanvas, {

            type: 'doughnut',

            data: {

                labels: [
                    'فعّالة',
                    'منتهية',
                    'بدون اشتراك'
                ],

                datasets: [{

                    data: [
                        activeCount,
                        expiredCount,
                        noneCount
                    ],

                    backgroundColor: [
                        '#51c78b',
                        '#ef6262',
                        '#777777'
                    ],

                    borderColor:
                        document.documentElement
                            .getAttribute('data-theme') === 'dark'
                            ? '#20242a'
                            : '#ffffff',

                    borderWidth: 4,

                    hoverOffset: 8
                }]
            },

            options: {

                responsive: true,

                maintainAspectRatio: false,

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

                        padding: 10
                    }
                }
            }
        });
    }


    /* =========================================================
       MONTHLY REVENUE
       ========================================================= */

    const revenueCanvas =
        document.getElementById('revenueChart');

    if (revenueCanvas) {

        const monthlyRevenue =
            @json($monthlyRevenue);


        const labels =
            monthlyRevenue.map(function (item) {
                return item.label;
            });


        const values =
            monthlyRevenue.map(function (item) {
                return Number(item.total) || 0;
            });


        new Chart(revenueCanvas, {

            type: 'bar',

            data: {

                labels: labels,

                datasets: [{

                    label: 'الإيرادات',

                    data: values,

                    backgroundColor: '#c9a961',

                    borderColor: '#c9a961',

                    borderWidth: 1,

                    borderRadius: 8,

                    borderSkipped: false,

                    maxBarThickness: 42
                }]
            },

            options: {

                responsive: true,

                maintainAspectRatio: false,

                interaction: {
                    intersect: false,
                    mode: 'index'
                },

                plugins: {

                    legend: {
                        display: false
                    },

                    tooltip: {

                        rtl: true,

                        displayColors: false,

                        backgroundColor:
                            document.documentElement
                                .getAttribute('data-theme') === 'dark'
                                ? '#252a30'
                                : '#ffffff',

                        titleColor:
                            document.documentElement
                                .getAttribute('data-theme') === 'dark'
                                ? '#f0f1f3'
                                : '#272b31',

                        bodyColor:
                            document.documentElement
                                .getAttribute('data-theme') === 'dark'
                                ? '#c4c8ce'
                                : '#565d67',

                        borderColor:
                            document.documentElement
                                .getAttribute('data-theme') === 'dark'
                                ? '#343941'
                                : '#e3e6ea',

                        borderWidth: 1,

                        padding: 10,

                        titleFont: {
                            family: 'Tajawal',
                            weight: '700'
                        },

                        bodyFont: {
                            family: 'Tajawal'
                        },

                        callbacks: {

                            label: function (context) {

                                return ' ' +
                                    Number(context.raw)
                                        .toLocaleString('ar-SA') +
                                    ' $';
                            }
                        }
                    }
                },

                scales: {

                    x: {

                        grid: {
                            display: false
                        },

                        border: {
                            display: false
                        },

                        ticks: {

                            color:
                                getComputedStyle(
                                    document.documentElement
                                ).getPropertyValue('--muted'),

                            font: {
                                family: 'Tajawal',
                                size: 11
                            }
                        }
                    },

                    y: {

                        beginAtZero: true,

                        border: {
                            display: false
                        },

                        grid: {

                            color:
                                document.documentElement
                                    .getAttribute('data-theme') === 'dark'
                                    ? 'rgba(255,255,255,.06)'
                                    : 'rgba(30,35,42,.06)'
                        },

                        ticks: {

                            color:
                                getComputedStyle(
                                    document.documentElement
                                ).getPropertyValue('--muted'),

                            font: {
                                family: 'Tajawal',
                                size: 10
                            },

                            callback: function (value) {

                                return Number(value)
                                    .toLocaleString('ar-SA');
                            }
                        }
                    }
                }
            }
        });
    }


    
    setTimeout(function () {

        window.dispatchEvent(
            new Event('resize')
        );

    }, 300);

});
</script>

@endsection