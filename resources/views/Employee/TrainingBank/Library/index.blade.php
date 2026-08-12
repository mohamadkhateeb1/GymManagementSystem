@extends('Employee.layouts.app')

@section('title', 'مكتبة التمارين العامة | Elite Club')

@section('styles')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;800&display=swap" rel="stylesheet">
    <style>
        .library-container {
            --gold: #c9a961;
            --gold-soft: rgba(201, 169, 97, 0.12);
            --gold-line: rgba(201, 169, 97, 0.16);
            --surface: #1c1f27;
            --surface-2: #232733;
            --text: #f2f3f5;
            --muted: #8a8f9c;
            font-family: 'Tajawal', sans-serif;
            padding: 20px;
        }

        .filter-btn {
            background: var(--surface-2);
            color: var(--muted);
            border: 1px solid rgba(255, 255, 255, 0.08);
            padding: 8px 16px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            transition: all 0.2s;
        }

        .filter-btn:hover,
        .filter-btn.active {
            background: rgba(201, 169, 97, 0.15);
            color: var(--gold);
            border-color: rgba(201, 169, 97, 0.3);
        }

        .members-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        .members-table th {
            padding: 15px;
            text-align: right;
            color: var(--muted);
            border-bottom: 1px solid var(--gold-soft);
            background: rgba(255, 255, 255, 0.01);
            font-size: 14px;
        }

        .members-table td {
            padding: 14px 15px;
            border-bottom: 1px solid rgba(201, 169, 97, 0.06);
            color: var(--text);
            vertical-align: middle;
            font-size: 14px;
        }

        .btn-green {
            background: rgba(90, 156, 122, 0.1);
            color: #5a9c7a;
            border: 1px solid rgba(90, 156, 122, 0.3);
            padding: 6px 14px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 12px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.2s;
        }

        .btn-green:hover {
            background: #5a9c7a;
            color: #fff;
        }

        .level-chip {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 700;
            background: rgba(201, 169, 97, 0.15);
            color: var(--gold);
            border: 1px solid rgba(201, 169, 97, 0.25);
        }
    </style>
@endsection

@section('content')
    <div class="dashboard-wrapper library-container">
        <!-- هيدر المكتبة والفلترة -->
        <div
            style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; flex-wrap: wrap; gap: 15px;">
            <div>
                <h2 style="color: #fff; margin: 0;"><i class="fas fa-book-open"
                        style="color: var(--gold); margin-left: 8px;"></i>
                    مكتبة التمارين العامة</h2>
                <span style="color: var(--muted); font-size: 13px;">فهرس شامل لجميع التمارين المتاحة وأقسامها</span>
            </div>

            <!-- أزرار تصفية المستوى -->
            <div style="display: flex; gap: 8px;">
                <a href="{{ route('employee.exercise.library') }}"
                    class="filter-btn {{ !request('level') ? 'active' : '' }}">الكل</a>
                <a href="{{ route('employee.exercise.library', ['level' => 'beginner']) }}"
                    class="filter-btn {{ request('level') == 'beginner' ? 'active' : '' }}">مبتدئ</a>
                <a href="{{ route('employee.exercise.library', ['level' => 'intermediate']) }}"
                    class="filter-btn {{ request('level') == 'intermediate' ? 'active' : '' }}">متوسط</a>
                <a href="{{ route('employee.exercise.library', ['level' => 'advanced']) }}"
                    class="filter-btn {{ request('level') == 'advanced' ? 'active' : '' }}">متقدم</a>
            </div>
        </div>

        <!-- 🎯 جدول بيانات التمارين البسيط -->
        <div class="panel"
            style="background: var(--surface); border: 1px solid var(--gold-line); border-radius: 14px; overflow: hidden;">
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
                            <td style="font-weight: 700; color: var(--gold);">
                                <i class="fas fa-dumbbell" style="margin-left: 8px; color: var(--muted);"></i>
                                {{ $ex->exercise_name ?? $ex->name }}
                            </td>
                            <td style="color: var(--text);">
                                {{ $ex->trainingPlan->title ?? 'خطة عامة' }}
                            </td>
                            <td style="text-align: center;">
                                <span class="level-chip">
                                    {{ $ex->trainingPlan->level ?? 'عام' }}
                                </span>
                            </td>
                            <td style="text-align: center;">
                                <!-- 🎯 زر الانتقال لصفحة التفاصيل -->
                                <a href="{{ route('employee.exercise.show', $ex->id) }}" class="btn-green">
                                    <i class="fas fa-eye"></i> التفاصيل
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" style="text-align: center; padding: 40px; color: var(--muted);">
                                <i class="fas fa-book-open"
                                    style="font-size: 32px; color: var(--gold); margin-bottom: 10px; display: block;"></i>
                                المكتبة فارغة حالياً، أضف تمارين جديدة داخل بنك الخطط لتظهر هنا فوراً.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
