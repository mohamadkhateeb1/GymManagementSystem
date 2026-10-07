@extends('Employee.layouts.app')

@section('title', 'مكتبة التمارين العامة | Elite Club')

@section('styles')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        /* =========================================================
                   ELITE CLUB - EXERCISE LIBRARY
                   تعتمد الآن على متغيّرات الثيم الموحّدة (فاتح/غامق تلقائياً)
                ========================================================= */

        .library-container {
            font-family: 'Tajawal', sans-serif;
            color: var(--text);
            direction: rtl;

            width: 100%;
            box-sizing: border-box;
            padding: 22px;
        }

        .library-container *,
        .library-container *::before,
        .library-container *::after {
            box-sizing: border-box;
        }

        /* =========================================================
                   HEADER
                ========================================================= */

        .library-header {
            position: relative;

            display: flex;
            align-items: center;
            justify-content: space-between;

            gap: 20px;

            padding: 23px 25px;
            margin-bottom: 18px;

            background: var(--surface);

            border: 1px solid var(--border);
            border-radius: 16px;

            overflow: hidden;

            box-shadow: var(--shadow-sm);
        }

        .library-header::before {
            content: "";

            position: absolute;
            right: 0;
            top: 0;

            width: 4px;
            height: 100%;

            background: linear-gradient(to bottom,
                    var(--gold-light),
                    var(--gold));

            box-shadow: 0 0 18px rgba(201, 169, 97, 0.30);
        }

        .library-heading {
            display: flex;
            align-items: center;
            gap: 15px;

            min-width: 0;
        }

        .library-icon {
            width: 52px;
            height: 52px;

            flex: 0 0 52px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 14px;

            background: color-mix(in srgb, var(--gold) 9%, var(--surface-2));
            border: 1px solid var(--border-soft);

            color: var(--gold);

            font-size: 21px;
        }

        .library-title {
            min-width: 0;
        }

        .library-title h2 {
            margin: 0 0 5px;

            color: var(--text);

            font-size: 22px;
            font-weight: 800;

            line-height: 1.5;
        }

        .library-title span {
            color: var(--text-soft);

            font-size: 13.5px;
            font-weight: 500;
            line-height: 1.7;
        }

        /* =========================================================
                   FILTERS
                ========================================================= */

        .library-filters {
            display: flex;
            align-items: center;
            justify-content: center;

            gap: 5px;

            padding: 5px;

            background: var(--surface-2);

            border: 1px solid var(--border);
            border-radius: 11px;

            flex-shrink: 0;
        }

        .filter-btn {
            display: inline-flex;

            align-items: center;
            justify-content: center;

            min-width: 66px;

            padding: 9px 15px;

            background: transparent;

            color: var(--text-soft);

            border: 1px solid transparent;
            border-radius: 8px;

            text-decoration: none;

            font-size: 13.5px;
            font-weight: 700;

            transition:
                color 0.2s ease,
                background 0.2s ease,
                border-color 0.2s ease,
                transform 0.2s ease;
        }

        .filter-btn:hover {
            color: var(--gold-dark);

            background: color-mix(in srgb, var(--gold) 7%, transparent);

            border-color: var(--border-soft);

            text-decoration: none;
        }

        .filter-btn.active {
            color: var(--gold-dark);

            background: color-mix(in srgb, var(--gold) 11%, var(--surface));

            border-color: color-mix(in srgb, var(--gold) 25%, var(--border));
        }

        /* =========================================================
                   MAIN PANEL
                ========================================================= */

        .library-panel {
            width: 100%;

            background: var(--surface);

            border: 1px solid var(--border);

            border-radius: 16px;

            overflow: hidden;

            box-shadow: var(--shadow-sm);
        }

        /* =========================================================
                   PANEL TOP
                ========================================================= */

        .panel-top {
            display: flex;
            align-items: center;
            justify-content: space-between;

            gap: 15px;

            padding: 16px 20px;

            background: var(--surface-2);

            border-bottom: 1px solid var(--border);
        }

        .panel-heading {
            display: flex;
            align-items: center;

            gap: 9px;

            color: var(--text);

            font-size: 16px;
            font-weight: 800;
        }

        .panel-heading i {
            color: var(--gold);

            font-size: 15px;
        }

        .panel-hint {
            color: var(--text-soft);

            font-size: 13px;
            font-weight: 500;
        }

        /* =========================================================
                   TABLE WRAPPER
                ========================================================= */

        .table-wrapper {
            width: 100%;

            overflow-x: auto;
            overflow-y: hidden;

            background: var(--surface);

            scrollbar-width: thin;
            scrollbar-color: var(--border) transparent;
        }

        /* =========================================================
                   TABLE
                ========================================================= */

        .members-table {
            width: 100%;
            min-width: 720px;

            margin: 0;

            border-collapse: separate;
            border-spacing: 0;

            background: var(--surface);
            color: var(--text);
        }

        /* =========================================================
                   THEAD
                ========================================================= */

        .members-table thead,
        .members-table thead tr {
            background: var(--surface-2);
            color: var(--text);
        }

        .members-table thead th {
            padding: 15px 18px;

            background: var(--surface-2);

            color: var(--text);

            border: 0;
            border-bottom: 1px solid var(--border);

            text-align: right;

            font-size: 13px;
            font-weight: 800;

            white-space: nowrap;
        }

        .members-table thead th:first-child {
            padding-right: 20px;
        }

        /* =========================================================
                   TBODY
                ========================================================= */

        .members-table tbody,
        .members-table tbody tr,
        .members-table tbody td {
            background: var(--surface);
        }

        .members-table tbody tr {
            transition: background 0.2s ease;
        }

        .members-table tbody td {
            padding: 15px 18px;

            color: var(--text);

            border: 0;
            border-bottom: 1px solid var(--border-soft);

            vertical-align: middle;

            font-size: 14.5px;
        }

        .members-table tbody td:first-child {
            padding-right: 20px;
        }

        /* =========================================================
                   ROW HOVER
                ========================================================= */

        .members-table tbody tr:hover,
        .members-table tbody tr:hover td {
            background: var(--surface-hover);
        }

        .members-table tbody tr:last-child td {
            border-bottom: none;
        }

        /* =========================================================
                   EXERCISE INFO
                ========================================================= */

        .exercise-info {
            display: flex;
            align-items: center;

            gap: 11px;

            min-width: 0;
        }

        .exercise-icon {
            width: 38px;
            height: 38px;

            flex: 0 0 38px;

            display: flex;
            align-items: center;
            justify-content: center;

            background: color-mix(in srgb, var(--gold) 8%, var(--surface-2));

            border: 1px solid var(--border-soft);

            border-radius: 9px;

            color: var(--gold);

            font-size: 14px;

            transition: all 0.2s ease;
        }

        .members-table tbody tr:hover .exercise-icon {
            background: color-mix(in srgb, var(--gold) 13%, var(--surface-2));
            border-color: color-mix(in srgb, var(--gold) 25%, var(--border));
        }

        .exercise-name {
            min-width: 0;

            color: var(--text);

            font-size: 15px;
            font-weight: 800;

            line-height: 1.6;
        }

        /* =========================================================
                   PLAN INFO
                ========================================================= */

        .plan-info {
            display: flex;
            align-items: center;

            gap: 8px;

            color: var(--text-soft);

            font-size: 13.5px;
            font-weight: 500;

            line-height: 1.6;
        }

        .plan-info i {
            color: var(--text-soft);

            font-size: 12px;

            flex-shrink: 0;
        }

        /* =========================================================
                   LEVEL CHIP
                ========================================================= */

        .level-chip {
            display: inline-flex;

            align-items: center;
            justify-content: center;

            min-width: 68px;

            padding: 6px 12px;

            border-radius: 7px;

            background: color-mix(in srgb, var(--gold) 10%, var(--surface-2));

            color: var(--gold-dark);

            border: 1px solid color-mix(in srgb, var(--gold) 22%, var(--border));

            font-size: 12.5px;
            font-weight: 800;
        }

        /* =========================================================
                   DETAILS BUTTON
                ========================================================= */

        .btn-green {
            display: inline-flex;

            align-items: center;
            justify-content: center;

            gap: 6px;

            padding: 8px 14px;

            background: color-mix(in srgb, var(--success) 9%, var(--surface-2));

            color: var(--success);

            border: 1px solid color-mix(in srgb, var(--success) 28%, var(--border));

            border-radius: 8px;

            text-decoration: none;

            font-size: 13px;
            font-weight: 700;

            white-space: nowrap;

            transition: all 0.2s ease;
        }

        .btn-green:hover {
            background: color-mix(in srgb, var(--success) 18%, var(--surface-2));

            color: var(--success);

            border-color: color-mix(in srgb, var(--success) 42%, var(--border));

            transform: translateY(-1px);

            box-shadow: 0 5px 15px color-mix(in srgb, var(--success) 12%, transparent);

            text-decoration: none;
        }

        .btn-green i {
            color: inherit;

            font-size: 12px;
        }

        /* =========================================================
                   EMPTY STATE
                ========================================================= */

        .members-table .empty-state {
            padding: 58px 25px;

            background: var(--surface);

            color: var(--text-soft);

            text-align: center;
        }

        .empty-icon {
            width: 60px;
            height: 60px;

            margin: 0 auto 14px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 15px;

            background: color-mix(in srgb, var(--gold) 9%, var(--surface-2));

            border: 1px solid var(--border-soft);

            color: var(--gold);

            font-size: 23px;
        }

        .empty-title {
            margin-bottom: 6px;

            color: var(--text);

            font-size: 16px;
            font-weight: 800;
        }

        .empty-description {
            color: var(--text-soft);

            font-size: 13.5px;
            font-weight: 500;
            line-height: 1.8;
        }

        /* =========================================================
                   SCROLLBAR
                ========================================================= */

        .table-wrapper::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        .table-wrapper::-webkit-scrollbar-track {
            background: var(--surface-2);
        }

        .table-wrapper::-webkit-scrollbar-thumb {
            background: color-mix(in srgb, var(--gold) 30%, var(--surface-2));

            border-radius: 10px;
        }

        .table-wrapper::-webkit-scrollbar-thumb:hover {
            background: color-mix(in srgb, var(--gold) 45%, var(--surface-2));
        }

        /* =========================================================
                   RESPONSIVE
                ========================================================= */

        @media (max-width: 850px) {

            .library-container {
                padding: 15px;
            }

            .library-header {
                align-items: flex-start;

                flex-direction: column;

                padding: 20px;
            }

            .library-heading {
                width: 100%;
            }

            .library-filters {
                width: 100%;
            }

            .filter-btn {
                flex: 1;
            }

            .panel-top {
                align-items: flex-start;

                flex-direction: column;

                gap: 6px;
            }
        }

        @media (max-width: 550px) {

            .library-container {
                padding: 10px;
            }

            .library-header {
                padding: 17px;

                border-radius: 13px;
            }

            .library-heading {
                gap: 11px;
            }

            .library-icon {
                width: 44px;
                height: 44px;

                flex-basis: 44px;

                border-radius: 11px;

                font-size: 19px;
            }

            .library-title h2 {
                font-size: 18px;
            }

            .library-title span {
                font-size: 12px;
            }

            .library-filters {
                gap: 4px;

                padding: 4px;
            }

            .filter-btn {
                min-width: 0;

                padding: 8px 8px;

                font-size: 12px;
            }

            .library-panel {
                border-radius: 13px;
            }

            .panel-top {
                padding: 14px 15px;
            }

            .members-table {
                min-width: 680px;
            }
        }

        @media (max-width: 400px) {
            .members-table {
                min-width: 600px;
            }

            .exercise-name {
                font-size: 13.5px;
            }

            .plan-info {
                font-size: 12px;
            }
        }
    </style>
@endsection

@section('content')
    <div class="dashboard-wrapper library-container">

        <!-- هيدر المكتبة والفلترة -->
        <div class="library-header">

            <div class="library-heading">

                <div class="library-icon">
                    <i class="fas fa-book-open"></i>
                </div>

                <div class="library-title">
                    <h2>مكتبة التمارين العامة</h2>
                    <span>فهرس شامل لجميع التمارين المتاحة وأقسامها</span>
                </div>

            </div>

            <!-- أزرار تصفية المستوى -->
            <div class="library-filters">

                <a href="{{ route('employee.exercise.library') }}"
                    class="filter-btn {{ !request('level') ? 'active' : '' }}">
                    الكل
                </a>

                <a href="{{ route('employee.exercise.library', ['level' => 'beginner']) }}"
                    class="filter-btn {{ request('level') == 'beginner' ? 'active' : '' }}">
                    مبتدئ
                </a>

                <a href="{{ route('employee.exercise.library', ['level' => 'intermediate']) }}"
                    class="filter-btn {{ request('level') == 'intermediate' ? 'active' : '' }}">
                    متوسط
                </a>

                <a href="{{ route('employee.exercise.library', ['level' => 'advanced']) }}"
                    class="filter-btn {{ request('level') == 'advanced' ? 'active' : '' }}">
                    متقدم
                </a>

            </div>

        </div>

        <!-- جدول بيانات التمارين -->
        <div class="library-panel">

            <div class="panel-top">

                <div class="panel-heading">
                    <i class="fas fa-list"></i>
                    قائمة التمارين
                </div>

                <div class="panel-hint">
                    استعرض تفاصيل أي تمرين من القائمة
                </div>

            </div>

            <div class="table-wrapper">

                <table class="members-table">

                    <thead>
                        <tr>
                            <th style="width: 45%;">اسم التمرين</th>
                            <th style="width: 30%;">القسم / الخطة التابع لها</th>
                            <th style="width: 15%; text-align: center;">المستوى</th>
                            <th style="width: 10%; text-align: center;">إجراءات</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($exercises as $ex)
                            <tr>

                                <td>

                                    <div class="exercise-info">

                                        <div class="exercise-icon">
                                            <i class="fas fa-dumbbell"></i>
                                        </div>

                                        <div class="exercise-name">
                                            {{ $ex->exercise_name ?? $ex->name }}
                                        </div>

                                    </div>

                                </td>

                                <td>

                                    <div class="plan-info">
                                        <i class="fas fa-layer-group"></i>
                                        {{ $ex->trainingPlan->title ?? 'خطة عامة' }}
                                    </div>

                                </td>

                                <td style="text-align: center;">

                                    <span class="level-chip">
                                        {{ $ex->trainingPlan->level ?? 'عام' }}
                                    </span>

                                </td>

                                <td style="text-align: center;">

                                    <a href="{{ route('employee.exercise.show', $ex->id) }}" class="btn-green">
                                        <i class="fas fa-eye"></i>
                                        التفاصيل
                                    </a>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="4" class="empty-state">

                                    <div class="empty-icon">
                                        <i class="fas fa-book-open"></i>
                                    </div>

                                    <div class="empty-title">
                                        المكتبة فارغة حالياً
                                    </div>

                                    <div class="empty-description">
                                        أضف تمارين جديدة داخل بنك الخطط لتظهر هنا فوراً.
                                    </div>

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>
@endsection
