@extends('Employee.layouts.app')

@section('title', 'لوحة تحكم الموظف | Elite Club')

@section('content')
    <div class="dashboard-wrapper">
        <!-- الهيدر الاحترافي -->
        <div class="header">
            <div class="header-titles">
                <div class="header-eyebrow"><i class="fas fa-crown"></i> Elite Club</div>
                <div class="header-title">لوحة تحكم المدرب</div>
                <div class="header-sub">أهلاً بك مجدداً يا كابتن {{ auth()->guard('employee')->user()->name }} 🎯</div>
            </div>
            <div class="header-emblem"><i class="fas fa-medal"></i></div>
        </div>

        <!-- شبكة كروت الإحصائيات الفورية (Stats Grid) -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon players-icon"><i class="fas fa-users"></i></div>
                <div class="stat-info">
                    <span class="stat-label">إجمالي اللاعبين</span>
                    <span class="stat-value">{{ $totalPlayers }}</span>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon training-icon"><i class="fas fa-dumbbell"></i></div>
                <div class="stat-info">
                    <span class="stat-label">حزمة التمارين بالبنك</span>
                    <span class="stat-value">{{ $totalTrainingPlans }}</span>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon diet-icon"><i class="fas fa-apple-alt"></i></div>
                <div class="stat-info">
                    <span class="stat-label">الوجبات الغذائية بالبنك</span>
                    <span class="stat-value">{{ $totalDietPlans }}</span>
                </div>
            </div>
        </div>

        <!-- قسمين تفاعليين لتوزيع المستويات والوصول السريع -->
        <div class="dashboard-grid">

            <!-- كارت مراقبة توزيع مستويات اللاعبين -->
            <div class="main-card">
                <div class="panel-head">
                    <h3><i class="fas fa-chart-pie"></i> توزيع اللاعبين حسب المستويات</h3>
                </div>
                <div class="levels-progress-wrapper">
                    <div class="progress-item">
                        <div class="progress-info">
                            <span>المستوى المبتدئ (Beginner)</span>
                            <strong>{{ $beginnerCount }} لاعب</strong>
                        </div>
                        <div class="progress-bar-bg">
                            <div class="progress-bar-fill beginner"
                                style="width: {{ $totalPlayers > 0 ? ($beginnerCount / $totalPlayers) * 100 : 0 }}%"></div>
                        </div>
                    </div>

                    <div class="progress-item">
                        <div class="progress-info">
                            <span>المستوى المتوسط (Intermediate)</span>
                            <strong>{{ $intermediateCount }} لاعب</strong>
                        </div>
                        <div class="progress-bar-bg">
                            <div class="progress-bar-fill intermediate"
                                style="width: {{ $totalPlayers > 0 ? ($intermediateCount / $totalPlayers) * 100 : 0 }}%">
                            </div>
                        </div>
                    </div>

                    <div class="progress-item">
                        <div class="progress-info">
                            <span>المستوى المتقدم (Advanced)</span>
                            <strong>{{ $advancedCount }} لاعب</strong>
                        </div>
                        <div class="progress-bar-bg">
                            <div class="progress-bar-fill advanced"
                                style="width: {{ $totalPlayers > 0 ? ($advancedCount / $totalPlayers) * 100 : 0 }}%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- كارت الاختصارات والوصول السريع للعمليات السريعة -->
            <div class="main-card">
                <div class="panel-head">
                    <h3><i class="fas fa-bolt"></i> إجراءات سريعة</h3>
                </div>
                <div class="quick-actions-grid">
                    <a href="{{ route('employee.monitoring') }}" class="action-tile">
                        <i class="fas fa-user-check"></i>
                        <span>أتمتة وتحديث اللاعبين</span>
                    </a>
                    <a href="{{ route('employee.training.bank') }}" class="action-tile">
                        <i class="fas fa-plus-circle"></i>
                        <span>إضافة تمارين للمستويات</span>
                    </a>
                    <a href="{{ route('employee.diet.bank') }}" class="action-tile">
                        <i class="fas fa-hamburger"></i>
                        <span>تزويد بنك الوجبات</span>
                    </a>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('styles')
    <style>
        .dashboard-wrapper {
            max-width: 1200px;
            margin: auto;
            --beginner-color: #f59e0b;
            --intermediate-color: #3b82f6;
            --advanced-color: #10b981;
        }

        /* حركات الظهور الانسيابية */
        .dashboard-wrapper .header,
        .dashboard-wrapper .stats-grid,
        .dashboard-wrapper .dashboard-grid {
            opacity: 0;
            transform: translateY(14px);
            animation: dash-rise .55s cubic-bezier(.2, .7, .2, 1) forwards;
        }

        .dashboard-wrapper .header {
            animation-delay: .05s;
        }

        .dashboard-wrapper .stats-grid {
            animation-delay: .12s;
        }

        .dashboard-wrapper .dashboard-grid {
            animation-delay: .2s;
        }

        @keyframes dash-rise {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            margin-bottom: 24px;
            padding: 24px 26px;
            border-radius: 16px;
            border: 1px solid var(--gold-line);
            background: radial-gradient(120% 160% at 100% 0%, rgba(201, 169, 97, 0.10), transparent 50%), var(--surface);
        }

        .header-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: .5px;
            color: var(--gold);
            margin-bottom: 8px;
        }

        .header-title {
            font-size: 26px;
            font-weight: 800;
            color: var(--text);
            line-height: 1.2;
        }

        .header-sub {
            font-size: 15px;
            color: var(--muted);
            margin-top: 6px;
        }

        .header-emblem {
            flex-shrink: 0;
            width: 60px;
            height: 60px;
            display: grid;
            place-items: center;
            font-size: 24px;
            color: var(--gold);
            background: var(--gold-soft);
            border: 1px solid var(--gold-line);
            border-radius: 16px;
        }

        /* شبكة كروت الإحصائيات */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            margin-bottom: 24px;
        }

        .stat-card {
            background: var(--surface);
            border: 1px solid rgba(255, 255, 255, 0.04);
            border-radius: 16px;
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: grid;
            place-items: center;
            font-size: 20px;
        }

        .players-icon {
            background: rgba(59, 130, 246, 0.1);
            color: #3b82f6;
        }

        .training-icon {
            background: rgba(201, 169, 97, 0.1);
            color: var(--gold);
        }

        .diet-icon {
            background: rgba(16, 185, 129, 0.1);
            color: #10b981;
        }

        .stat-info {
            display: flex;
            flex-direction: column;
        }

        .stat-label {
            font-size: 13px;
            color: var(--muted);
            font-weight: 600;
            margin-bottom: 4px;
        }

        .stat-value {
            font-size: 24px;
            font-weight: 800;
            color: #fff;
            line-height: 1;
        }

        /* التصميم الشبكي السفلي */
        .dashboard-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        @media (max-width: 992px) {
            .dashboard-grid {
                grid-template-columns: 1fr;
            }
        }

        .main-card {
            background: var(--surface);
            padding: 8px 24px 24px;
            border-radius: 16px;
            border: 1px solid rgba(255, 255, 255, 0.04);
        }

        .panel-head {
            padding: 18px 0;
            border-bottom: 1px solid var(--gold-soft);
            margin-bottom: 16px;
        }

        .panel-head h3 {
            margin: 0;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 16px;
            font-weight: 700;
            color: var(--text);
        }

        .panel-head h3 i {
            color: var(--gold);
        }

        /* أشرطة مراقبة مستويات مستخدمي النادي */
        .levels-progress-wrapper {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .progress-item {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .progress-info {
            display: flex;
            justify-content: space-between;
            font-size: 13.5px;
            color: var(--text);
        }

        .progress-info span {
            color: var(--muted);
            font-weight: 500;
        }

        .progress-info行 strong {
            color: #fff;
        }

        .progress-bar-bg {
            width: 100%;
            height: 8px;
            background: var(--surface-2);
            border-radius: 4px;
            overflow: hidden;
        }

        .progress-bar-fill {
            height: 100%;
            border-radius: 4px;
            transition: width 0.5s ease;
        }

        .progress-bar-fill.beginner {
            background: var(--beginner-color);
        }

        .progress-bar-fill.intermediate {
            background: var(--intermediate-color);
        }

        .progress-bar-fill.advanced {
            background: var(--advanced-color);
        }

        /* قرميدات الإجراءات السريعة */
        .quick-actions-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 12px;
        }

        .action-tile {
            background: var(--surface-2);
            border: 1px solid rgba(255, 255, 255, 0.02);
            border-radius: 12px;
            padding: 20px 12px;
            text-align: center;
            color: var(--text);
            text-decoration: none;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 12px;
            transition: all 0.2s ease;
        }

        .action-tile i {
            font-size: 22px;
            color: var(--gold);
        }

        .action-tile span {
            font-size: 13px;
            font-weight: 600;
            line-height: 1.4;
        }

        .action-tile:hover {
            border-color: var(--gold-line);
            background: var(--gold-soft);
            transform: translateY(-2px);
        }

        @media (max-width: 640px) {
            .header {
                flex-direction: column;
                align-items: flex-start;
            }

            .header-emblem {
                display: none;
            }

            .header-title {
                font-size: 22px;
            }
        }
    </style>
@endpush
