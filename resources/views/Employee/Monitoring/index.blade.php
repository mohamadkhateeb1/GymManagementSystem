@extends('Employee.layouts.app')

@section('title', 'لوحة المراقبة والمستويات | Elite Club')

@section('styles')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .monitoring-container {
            --gold: #c9a961;
            --gold-soft: rgba(201, 169, 97, 0.08);
            --gold-line: rgba(201, 169, 97, 0.15);
            --surface: #1c1f27;
            --surface-2: #232733;
            --text: #f2f3f5;
            --muted: #8a8f9c;
            --success: #4ade80;
            --danger: #f87171;
            --blue-vip: #818cf8;
            font-family: 'Tajawal', sans-serif;
            color: var(--text);
        }

        .page-header-title {
            color: #fff;
            margin: 0 0 5px 0;
            font-weight: 800;
            font-size: 24px;
            letter-spacing: -0.5px;
        }

        .panel-luxury {
            background: linear-gradient(145deg, var(--surface), #17191e);
            border: 1px solid var(--gold-line);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .panel-luxury-head {
            padding: 20px 24px;
            border-bottom: 1px solid var(--gold-soft);
            background: rgba(255, 255, 255, 0.01);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .panel-luxury-head h3 {
            margin: 0;
            font-size: 16px;
            font-weight: 700;
            color: #fff;
        }

        .panel-luxury-head i {
            color: var(--gold);
            font-size: 18px;
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
            letter-spacing: 0.5px;
        }

        .luxury-table td {
            padding: 18px 24px;
            border-bottom: 1px solid rgba(201, 169, 97, 0.04);
            color: var(--text);
            vertical-align: middle;
            font-size: 14px;
            transition: all 0.2s ease;
        }

        .luxury-table tbody tr {
            transition: background 0.2s ease;
        }

        .luxury-table tbody tr:hover {
            background: rgba(201, 169, 97, 0.02);
        }

        .luxury-table tbody tr:hover td {
            color: #fff;
        }

        /* شارات احترافية ومضيئة */
        .status-badge {
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 11.5px;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .status-badge::before {
            content: '';
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: currentColor;
            box-shadow: 0 0 8px currentColor;
        }

        .badge-active {
            background: rgba(74, 222, 128, 0.08);
            color: var(--success);
            border: 1px solid rgba(74, 222, 128, 0.15);
        }

        .badge-expired {
            background: rgba(248, 113, 113, 0.08);
            color: var(--danger);
            border: 1px solid rgba(248, 113, 113, 0.15);
        }

        .badge-none {
            background: rgba(138, 143, 156, 0.08);
            color: var(--muted);
            border: 1px solid rgba(138, 143, 156, 0.15);
        }

        .level-badge {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.08);
            color: #fff;
            padding: 5px 12px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            text-transform: capitalize;
        }

        .weight-display {
            font-weight: 800;
            color: #fff;
            background: rgba(129, 140, 248, 0.05);
            padding: 4px 10px;
            border-radius: 6px;
            border: 1px solid rgba(129, 140, 248, 0.1);
            display: inline-block;
        }

        /* التقييمات المتوهجة */
        .rating-stars-gold {
            color: #fbbf24;
            font-size: 12px;
            white-space: nowrap;
            filter: drop-shadow(0 0 4px rgba(251, 191, 36, 0.3));
        }

        /* قوائم الاختيار والأزرار الفاخرة */
        .select-level-luxury {
            padding: 8px 36px 8px 14px;
            border-radius: 8px;
            border: 1px solid var(--gold-line);
            background: var(--surface-2);
            color: var(--text);
            font-size: 12.5px;
            font-family: 'Tajawal', sans-serif;
            outline: none;
            cursor: pointer;
            transition: all 0.2s ease;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23c9a961' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: left 12px center;
            background-size: 14px;
            min-width: 175px;
        }

        .select-level-luxury:focus {
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(201, 169, 97, 0.15);
            background-color: var(--surface);
        }

        .btn-apply-luxury {
            background: linear-gradient(135deg, #e7cd8e, #c9a961);
            color: #1c1f27;
            border: none;
            padding: 9px 18px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 12.5px;
            font-weight: 700;
            font-family: 'Tajawal', sans-serif;
            transition: all 0.2s ease;
            box-shadow: 0 2px 6px rgba(201, 169, 97, 0.1);
        }

        .btn-apply-luxury:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(201, 169, 97, 0.25);
        }

        .btn-show-luxury {
            background: rgba(129, 140, 248, 0.08);
            color: var(--blue-vip);
            border: 1px solid rgba(129, 140, 248, 0.15);
            padding: 8px 16px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 12.5px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.2s ease;
        }

        .btn-show-luxury:hover {
            background: var(--blue-vip);
            color: #1c1f27;
            border-color: var(--blue-vip);
            box-shadow: 0 4px 12px rgba(129, 140, 248, 0.2);
        }

        .lock-container {
            color: var(--danger);
            font-size: 12.5px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(248, 113, 113, 0.03);
            padding: 6px 12px;
            border-radius: 6px;
            border: 1px solid rgba(248, 113, 113, 0.08);
        }
    </style>
@endsection

@section('content')
    <div class="dashboard-wrapper monitoring-container">
        <div style="margin-bottom: 18px;">
            <x-flash-message />
        </div>

        <div style="margin-bottom: 25px;">
            <h2 class="page-header-title">لوحة المراقبة وإدارة المستويات</h2>
            <span style="color: var(--muted); font-size: 13px;">تحديث ومراقبة حزم التمارين والأوزان البدنية للاعبين تلقائياً
                لايف</span>
        </div>

        <div class="panel-luxury">
            <div class="panel-luxury-head">
                <i class="fas fa-id-card-clip"></i>
                <h3>قائمة المشتركين وتفعيل الأتمتة المخصصة للمستويات</h3>
            </div>

            <div style="overflow-x: auto;">
                <table class="luxury-table">
                    <thead>
                        <tr>
                            <th>اسم اللاعب</th>
                            <th>حالة الاشتراك</th>
                            <th>المستوى الفعلي</th>
                            <th style="width: 14%; text-align: center;">الوزن الحالي</th>
                            <th style="width: 16%; text-align: center;">التقييم العام</th>
                            <th>إسقاط وتنزيل الباقات الفورية</th>
                            <th style="text-align: center;">إجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($players as $player)
                            <tr>
                                <td style="font-weight: 700; color: #fff;">
                                    <i class="fas fa-user"
                                        style="color: var(--gold); margin-left: 8px; font-size: 12px;"></i>{{ $player->name }}
                                </td>
                                <td>
                                    @if ($player->subscription)
                                        <span
                                            class="status-badge {{ $player->hasActiveSubscription() ? 'badge-active' : 'badge-expired' }}">
                                            {{ $player->hasActiveSubscription() ? 'نشط' : 'منتهي/مجمد' }}
                                        </span>
                                    @else
                                        <span class="status-badge badge-none">غير مشترك</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="level-badge">
                                        {{ $player->level ?? 'لم يحدد بعد' }}
                                    </span>
                                </td>

                                <td style="text-align: center;">
                                    @if ($player->latest_weight)
                                        <span class="weight-display">{{ $player->latest_weight }} كغ</span>
                                    @else
                                        <span class="status-badge badge-none" style="font-size: 11px;">---</span>
                                    @endif
                                </td>

                                <td style="text-align: center;">
                                    @if (!is_null($player->average_rating))
                                        @php $roundRating = round((float)$player->average_rating); @endphp
                                        <div class="rating-stars-gold"
                                            title="متوسط التقييم: {{ round((float) $player->average_rating, 1) }} من 5">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <i class="{{ $i <= $roundRating ? 'fas' : 'far' }} fa-star"></i>
                                            @endfor
                                        </div>
                                    @else
                                        <span class="status-badge badge-none" style="font-size: 11px;">لم يقيّم</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($player->hasActiveSubscription())
                                        <form action="{{ route('employee.monitoring.assign-level', $player->id) }}"
                                            method="POST" style="display: flex; gap: 10px; align-items: center;">
                                            @csrf
                                            <select name="level" class="select-level-luxury" required>
                                                <option value="">اختر المستوى لتنزيل الخطة</option>
                                                <option value="beginner"
                                                    {{ $player->level == 'beginner' ? 'selected' : '' }}>
                                                    Beginner (مبتدئ)
                                                </option>
                                                <option value="intermediate"
                                                    {{ $player->level == 'intermediate' ? 'selected' : '' }}>
                                                    Intermediate (متوسط)
                                                </option>
                                                <option value="advanced"
                                                    {{ $player->level == 'advanced' ? 'selected' : '' }}>
                                                    Advanced (متقدم)
                                                </option>
                                            </select>
                                            <button type="submit" class="btn-apply-luxury">تطبيق الأتمتة</button>
                                        </form>
                                    @else
                                        <div class="lock-container">
                                            <i class="fas fa-lock"></i> الحساب مجمد أو منتهي
                                        </div>
                                    @endif
                                </td>
                                <td style="text-align: center;">
                                    <a href="{{ route('employee.monitoring.show', $player->id) }}" class="btn-show-luxury">
                                        <i class="fas fa-chart-line"></i> عرض وتحليل الملف
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7"
                                    style="text-align: center; padding: 50px; color: var(--muted); font-size: 14px;">
                                    <i class="fas fa-folder-open fa-2x"
                                        style="display: block; margin-bottom: 12px; color: var(--gold-line);"></i>
                                    لا يوجد لاعبون مسجلون تحت إشرافك حالياً.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection