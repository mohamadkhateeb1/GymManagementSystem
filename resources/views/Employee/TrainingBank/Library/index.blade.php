@extends('Employee.layouts.app')

@section('title', 'مكتبة التمارين العامة | Elite Club')

@section('styles')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        /* =========================================================
               ELITE CLUB - EXERCISE LIBRARY
               DESIGN ONLY
               LOGIC / ROUTES / VARIABLES PRESERVED
            ========================================================= */

        .library-container {
            --gold: #c9a961;
            --gold-light: #e6cf91;
            --gold-soft: rgba(201, 169, 97, 0.08);
            --gold-line: rgba(201, 169, 97, 0.16);
            --gold-border: rgba(201, 169, 97, 0.22);

            --surface: #171a21;
            --surface-2: #1d212a;
            --surface-3: #232832;
            --surface-dark: #111419;

            --text: #f4f5f7;
            --muted: #8d93a1;
            --muted-light: #aeb3bd;

            --green: #5a9c7a;
            --green-light: #74b995;

            font-family: 'Tajawal', sans-serif !important;
            color: var(--text) !important;
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

            background:
                linear-gradient(135deg,
                    rgba(201, 169, 97, 0.055),
                    rgba(255, 255, 255, 0.008)),
                #171a21 !important;

            border: 1px solid var(--gold-line) !important;
            border-radius: 16px !important;

            overflow: hidden;

            box-shadow:
                0 10px 30px rgba(0, 0, 0, 0.08),
                inset 0 1px 0 rgba(255, 255, 255, 0.015) !important;
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

            border-radius: 14px !important;

            background: rgba(201, 169, 97, 0.075) !important;
            border: 1px solid rgba(201, 169, 97, 0.18) !important;

            color: var(--gold-light) !important;

            font-size: 21px;

            box-shadow:
                inset 0 0 20px rgba(201, 169, 97, 0.025),
                0 0 18px rgba(201, 169, 97, 0.04);
        }

        .library-title {
            min-width: 0;
        }

        .library-title h2 {
            margin: 0 0 5px !important;

            color: #ffffff !important;

            font-size: 21px;
            font-weight: 800;

            line-height: 1.5;
        }

        .library-title span {
            color: #8d93a1 !important;

            font-size: 12.5px;
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

            background: #111419 !important;

            border: 1px solid rgba(255, 255, 255, 0.045) !important;
            border-radius: 11px !important;

            flex-shrink: 0;
        }

        .filter-btn {
            display: inline-flex;

            align-items: center;
            justify-content: center;

            min-width: 66px;

            padding: 8px 14px;

            background: transparent !important;

            color: #8d93a1 !important;

            border: 1px solid transparent !important;
            border-radius: 8px !important;

            text-decoration: none !important;

            font-size: 12.5px;
            font-weight: 600;

            transition:
                color 0.2s ease,
                background 0.2s ease,
                border-color 0.2s ease,
                transform 0.2s ease;
        }

        .filter-btn:hover {
            color: var(--gold-light) !important;

            background: rgba(201, 169, 97, 0.07) !important;

            border-color: rgba(201, 169, 97, 0.14) !important;

            text-decoration: none !important;
        }

        .filter-btn.active {
            color: var(--gold-light) !important;

            background: rgba(201, 169, 97, 0.11) !important;

            border-color: rgba(201, 169, 97, 0.25) !important;

            box-shadow:
                inset 0 0 15px rgba(201, 169, 97, 0.035),
                0 0 12px rgba(201, 169, 97, 0.035);
        }

        /* =========================================================
               MAIN PANEL
            ========================================================= */

        .library-panel {
            width: 100%;

            background: #171a21 !important;

            border: 1px solid rgba(201, 169, 97, 0.16) !important;

            border-radius: 16px !important;

            overflow: hidden !important;

            box-shadow:
                0 12px 30px rgba(0, 0, 0, 0.10),
                inset 0 1px 0 rgba(255, 255, 255, 0.015) !important;
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

            background:
                linear-gradient(90deg,
                    rgba(201, 169, 97, 0.025),
                    transparent),
                #171a21 !important;

            border-bottom: 1px solid rgba(201, 169, 97, 0.09) !important;
        }

        .panel-heading {
            display: flex;
            align-items: center;

            gap: 9px;

            color: #ffffff !important;

            font-size: 14px;
            font-weight: 700;
        }

        .panel-heading i {
            color: var(--gold) !important;

            font-size: 13px;
        }

        .panel-hint {
            color: #777e8c !important;

            font-size: 11.5px;
        }

        /* =========================================================
               TABLE WRAPPER
            ========================================================= */

        .table-wrapper {
            width: 100%;

            overflow-x: auto;
            overflow-y: hidden;

            background: #171a21 !important;

            scrollbar-width: thin;
            scrollbar-color:
                rgba(201, 169, 97, 0.25) #111419;
        }

        /* =========================================================
               TABLE - FORCE DARK MODE
            ========================================================= */

        .members-table,
        .members-table.table {
            width: 100% !important;
            min-width: 720px;

            margin: 0 !important;

            border-collapse: separate !important;
            border-spacing: 0 !important;

            background: #171a21 !important;

            color: #f4f5f7 !important;

            --bs-table-bg: #171a21 !important;
            --bs-table-color: #f4f5f7 !important;
            --bs-table-border-color: rgba(255, 255, 255, 0.035) !important;
            --bs-table-hover-bg: #1d212a !important;
            --bs-table-hover-color: #ffffff !important;
        }

        /*
             * إزالة تأثير Bootstrap بالكامل
             */
        .members-table.table> :not(caption)>*>*,
        .members-table> :not(caption)>*>* {
            background-color: transparent !important;
            box-shadow: none !important;
            color: inherit !important;
        }

        /* =========================================================
               THEAD
            ========================================================= */

        .members-table thead,
        .members-table thead tr {
            background: #1d212a !important;

            color: #8d93a1 !important;
        }

        .members-table thead th {
            padding: 15px 18px !important;

            background: #1d212a !important;

            color: #8d93a1 !important;

            border: 0 !important;
            border-bottom: 1px solid rgba(201, 169, 97, 0.10) !important;

            text-align: right;

            font-size: 11.5px;
            font-weight: 700;

            white-space: nowrap;
        }

        .members-table thead th:first-child {
            padding-right: 20px !important;
        }

        /* =========================================================
               TBODY
            ========================================================= */

        .members-table tbody,
        .members-table tbody tr,
        .members-table tbody td {
            background: #171a21 !important;
        }

        .members-table tbody tr {
            transition: background 0.2s ease !important;
        }

        .members-table tbody td {
            padding: 15px 18px !important;

            color: #f4f5f7 !important;

            border: 0 !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.035) !important;

            vertical-align: middle !important;

            font-size: 13px;
        }

        .members-table tbody td:first-child {
            padding-right: 20px !important;
        }

        /* =========================================================
               ROW HOVER
            ========================================================= */

        .members-table tbody tr:hover,
        .members-table.table-hover tbody tr:hover {
            background: #1d212a !important;

            --bs-table-hover-bg: #1d212a !important;
            --bs-table-hover-color: #ffffff !important;
        }

        .members-table tbody tr:hover td,
        .members-table.table-hover tbody tr:hover>td {
            background: #1d212a !important;

            color: #ffffff !important;

            border-bottom-color: rgba(201, 169, 97, 0.08) !important;
        }

        .members-table tbody tr:last-child td {
            border-bottom: none !important;
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
            width: 36px;
            height: 36px;

            flex: 0 0 36px;

            display: flex;
            align-items: center;
            justify-content: center;

            background: rgba(201, 169, 97, 0.075) !important;

            border: 1px solid rgba(201, 169, 97, 0.13) !important;

            border-radius: 9px !important;

            color: #c9a961 !important;

            font-size: 13px;

            transition: all 0.2s ease;
        }

        .members-table tbody tr:hover .exercise-icon {
            background: rgba(201, 169, 97, 0.12) !important;

            border-color: rgba(201, 169, 97, 0.24) !important;

            box-shadow:
                0 0 14px rgba(201, 169, 97, 0.08);
        }

        .exercise-name {
            min-width: 0;

            color: #f4f5f7 !important;

            font-size: 13.5px;
            font-weight: 700;

            line-height: 1.6;
        }

        /* =========================================================
               PLAN INFO
            ========================================================= */

        .plan-info {
            display: flex;
            align-items: center;

            gap: 8px;

            color: #aeb3bd !important;

            line-height: 1.6;
        }

        .plan-info i {
            color: #747b88 !important;

            font-size: 11px;

            flex-shrink: 0;
        }

        /* =========================================================
               LEVEL CHIP
            ========================================================= */

        .level-chip {
            display: inline-flex;

            align-items: center;
            justify-content: center;

            min-width: 65px;

            padding: 5px 11px;

            border-radius: 7px !important;

            background: rgba(201, 169, 97, 0.085) !important;

            color: #e6cf91 !important;

            border: 1px solid rgba(201, 169, 97, 0.20) !important;

            font-size: 11px;
            font-weight: 700;

            box-shadow:
                inset 0 0 10px rgba(201, 169, 97, 0.025);
        }

        /* =========================================================
               DETAILS BUTTON
            ========================================================= */

        .btn-green {
            display: inline-flex;

            align-items: center;
            justify-content: center;

            gap: 6px;

            padding: 7px 13px;

            background: rgba(90, 156, 122, 0.08) !important;

            color: #5a9c7a !important;

            border: 1px solid rgba(90, 156, 122, 0.25) !important;

            border-radius: 8px !important;

            text-decoration: none !important;

            font-size: 11.5px;
            font-weight: 700;

            white-space: nowrap;

            transition: all 0.2s ease;
        }

        .btn-green:hover {
            background: rgba(90, 156, 122, 0.17) !important;

            color: #74b995 !important;

            border-color: rgba(90, 156, 122, 0.40) !important;

            transform: translateY(-1px);

            box-shadow:
                0 5px 15px rgba(90, 156, 122, 0.08);

            text-decoration: none !important;
        }

        .btn-green i {
            color: inherit !important;

            font-size: 10px;
        }

        /* =========================================================
               EMPTY STATE
            ========================================================= */

        .members-table .empty-state {
            padding: 58px 25px !important;

            background: #171a21 !important;

            color: #8d93a1 !important;

            text-align: center !important;
        }

        .members-table tbody tr:hover .empty-state {
            background: #171a21 !important;

            color: #8d93a1 !important;
        }

        .empty-icon {
            width: 58px;
            height: 58px;

            margin: 0 auto 14px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 15px !important;

            background: rgba(201, 169, 97, 0.08) !important;

            border: 1px solid rgba(201, 169, 97, 0.16) !important;

            color: #c9a961 !important;

            font-size: 22px;
        }

        .empty-title {
            margin-bottom: 6px;

            color: #f2f3f5 !important;

            font-size: 14px;
            font-weight: 700;
        }

        .empty-description {
            color: #8d93a1 !important;

            font-size: 12px;
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
            background: #111419 !important;
        }

        .table-wrapper::-webkit-scrollbar-thumb {
            background: rgba(201, 169, 97, 0.25) !important;

            border-radius: 10px;
        }

        .table-wrapper::-webkit-scrollbar-thumb:hover {
            background: rgba(201, 169, 97, 0.40) !important;
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

                border-radius: 13px !important;
            }

            .library-heading {
                gap: 11px;
            }

            .library-icon {
                width: 44px;
                height: 44px;

                flex-basis: 44px;

                border-radius: 11px !important;

                font-size: 18px;
            }

            .library-title h2 {
                font-size: 17px;
            }

            .library-title span {
                font-size: 11px;
            }

            .library-filters {
                gap: 4px;

                padding: 4px;
            }

            .filter-btn {
                min-width: 0;

                padding: 7px 8px;

                font-size: 11px;
            }

            .library-panel {
                border-radius: 13px !important;
            }

            .panel-top {
                padding: 14px 15px;
            }

            .members-table {
                min-width: 680px;
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
