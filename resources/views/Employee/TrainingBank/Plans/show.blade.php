@extends('Employee.layouts.app')

@section('title', 'تفاصيل التمرين | Elite Club')

@section('styles')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;800&display=swap" rel="stylesheet">
    <style>
        .details-container {
            --gold: #c9a961;
            --gold-soft: rgba(201, 169, 97, 0.12);
            --gold-line: rgba(201, 169, 97, 0.2);
            --surface: #1c1f27;
            --surface-2: #232733;
            --text: #f2f3f5;
            --muted: #8a8f9c;
            font-family: 'Tajawal', sans-serif;
            padding: 20px;
            max-width: 900px;
            margin: 0 auto;
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--gold);
            text-decoration: none;
            font-weight: 600;
            margin-bottom: 20px;
            transition: transform 0.2s;
        }

        .back-btn:hover {
            transform: translateX(5px);
        }

        .details-card {
            background: var(--surface);
            border: 1px solid var(--gold-line);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
        }

        .details-media {
            width: 100%;
            max-height: 400px;
            object-fit: cover;
            background: var(--surface-2);
            border-bottom: 1px solid var(--gold-soft);
        }

        .details-body {
            padding: 30px;
        }

        .level-badge {
            display: inline-block;
            padding: 6px 14px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 700;
            background: rgba(201, 169, 97, 0.15);
            color: var(--gold);
            border: 1px solid rgba(201, 169, 97, 0.3);
            margin-bottom: 20px;
        }

        .section-title {
            color: var(--gold);
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
            border-bottom: 1px solid var(--gold-soft);
            padding-bottom: 8px;
        }

        .details-text {
            color: var(--text);
            font-size: 15px;
            line-height: 1.8;
            white-space: pre-line;
            background: var(--surface-2);
            padding: 20px;
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.05);
            margin-bottom: 25px;
        }

        .meta-info {
            display: flex;
            gap: 20px;
            color: var(--muted);
            font-size: 13px;
            margin-top: 20px;
            padding-top: 15px;
            border-top: 1px solid var(--gold-soft);
        }
    </style>
@endsection

@section('content')
    <div class="dashboard-wrapper details-container">
        <!-- زر العودة -->
        <a href="{{ route('employee.training.bank') }}" class="back-btn">
            <i class="fas fa-arrow-right"></i> العودة إلى بنك التمارين
        </a>

        <div class="details-card">
            <!-- عرض الصورة -->
            @if ($plan->image_path)
                <img src="{{ asset('storage/' . $plan->image_path) }}" alt="صورة التمرين" class="details-media">
            @endif

            <div class="details-body">
                <span class="level-badge"><i class="fas fa-layer-group"></i> المستوى المستهدف:
                    {{ $plan->level ?? 'عام' }}</span>

                <div class="section-title">
                    <i class="fas fa-align-right"></i> الشرح والتفاصيل البرمجية للتمرين
                </div>
                <div class="details-text">
                    {{ $plan->plan_details }}
                </div>

                <div class="meta-info">
                    <span><i class="far fa-calendar-alt"></i> تاريخ الإضافة: {{ $plan->created_at->format('Y-m-d') }}</span>
                    <span><i class="far fa-clock"></i> آخر تحديث: {{ $plan->updated_at->diffForHumans() }}</span>
                </div>
            </div>
        </div>
    </div>
@endsection
