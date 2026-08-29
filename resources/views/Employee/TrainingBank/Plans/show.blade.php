@extends('Employee.layouts.app')

@section('title', 'تفاصيل التمرين | Elite Club')

@section('styles') <link rel="preconnect" href="https://fonts.googleapis.com"> <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;800&display=swap" rel="stylesheet">

<style>
    .details-container {
        --gold: #c9a961;
        --gold-light: #e7cd8e;
        --gold-soft: rgba(201, 169, 97, 0.10);
        --gold-line: rgba(201, 169, 97, 0.18);

        --surface: #181b22;
        --surface-2: #20242d;
        --surface-3: #252a34;

        --text: #f4f5f7;
        --muted: #9298a5;

        font-family: 'Tajawal', sans-serif;
        padding: 24px;
        max-width: 1050px;
        margin: 0 auto;
    }

    /* =========================
       Back Button
    ========================= */
    .back-btn {
        display: inline-flex;
        align-items: center;
        gap: 9px;
        color: var(--muted);
        text-decoration: none;
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 22px;
        padding: 9px 14px;
        border-radius: 9px;
        border: 1px solid rgba(255, 255, 255, 0.06);
        background: rgba(255, 255, 255, 0.025);
        transition: all 0.25s ease;
    }

    .back-btn i {
        color: var(--gold);
        transition: transform 0.25s ease;
    }

    .back-btn:hover {
        color: var(--gold-light);
        border-color: var(--gold-line);
        background: var(--gold-soft);
    }

    .back-btn:hover i {
        transform: translateX(4px);
    }

    /* =========================
       Main Card
    ========================= */
    .details-card {
        position: relative;
        background:
            linear-gradient(
                145deg,
                rgba(201, 169, 97, 0.035),
                transparent 35%
            ),
            var(--surface);

        border: 1px solid var(--gold-line);
        border-radius: 18px;
        overflow: hidden;
        box-shadow:
            0 18px 45px rgba(0, 0, 0, 0.35),
            inset 0 1px 0 rgba(255, 255, 255, 0.025);
    }

    .details-card::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        left: 0;
        height: 2px;
        background: linear-gradient(
            90deg,
            transparent,
            var(--gold),
            transparent
        );
        opacity: 0.7;
    }

    /* =========================
       Media
    ========================= */
    .details-media-wrapper {
        position: relative;
        background: var(--surface-2);
        border-bottom: 1px solid var(--gold-soft);
        overflow: hidden;
    }

    .details-media {
        display: block;
        width: 100%;
        max-height: 430px;
        object-fit: cover;
        background: var(--surface-2);
        transition: transform 0.45s ease;
    }

    .details-card:hover .details-media {
        transform: scale(1.015);
    }

    .media-overlay {
        position: absolute;
        inset: 0;
        pointer-events: none;
        background: linear-gradient(
            to top,
            rgba(24, 27, 34, 0.35),
            transparent 45%
        );
    }

    /* =========================
       Body
    ========================= */
    .details-body {
        padding: 30px;
    }

    .details-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        margin-bottom: 24px;
        flex-wrap: wrap;
    }

    .details-heading {
        margin: 0;
        color: var(--text);
        font-size: 23px;
        font-weight: 800;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .details-heading i {
        color: var(--gold);
        font-size: 19px;
    }

    /* =========================
       Level Badge
    ========================= */
    .level-badge {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 7px 13px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 800;
        background: var(--gold-soft);
        color: var(--gold-light);
        border: 1px solid rgba(201, 169, 97, 0.25);
        white-space: nowrap;
    }

    .level-badge i {
        font-size: 11px;
    }

    /* =========================
       Section
    ========================= */
    .details-section {
        margin-top: 25px;
    }

    .section-title {
        position: relative;
        color: var(--text);
        font-size: 15px;
        font-weight: 800;
        margin-bottom: 13px;
        padding-bottom: 11px;
        display: flex;
        align-items: center;
        gap: 9px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.055);
    }

    .section-title::after {
        content: '';
        position: absolute;
        bottom: -1px;
        right: 0;
        width: 70px;
        height: 2px;
        background: var(--gold);
        border-radius: 10px;
    }

    .section-title i {
        color: var(--gold);
        font-size: 14px;
    }

    /* =========================
       Details Text
    ========================= */
    .details-text {
        color: #dfe2e7;
        font-size: 14px;
        line-height: 1.9;
        white-space: pre-line;

        background:
            linear-gradient(
                145deg,
                rgba(255, 255, 255, 0.015),
                transparent
            ),
            var(--surface-2);

        padding: 20px 22px;
        border-radius: 11px;
        border: 1px solid rgba(255, 255, 255, 0.055);

        margin-bottom: 0;

        min-height: 80px;
        box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.015);
    }

    /* =========================
       Meta Information
    ========================= */
    .meta-info {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;

        margin-top: 25px;
        padding-top: 20px;
        border-top: 1px solid rgba(201, 169, 97, 0.10);
    }

    .meta-item {
        display: flex;
        align-items: center;
        gap: 9px;

        background: rgba(255, 255, 255, 0.025);
        border: 1px solid rgba(255, 255, 255, 0.045);
        border-radius: 9px;
        padding: 11px 13px;

        color: var(--muted);
        font-size: 12px;
    }

    .meta-item i {
        color: var(--gold);
        font-size: 13px;
    }

    /* =========================
       Empty Image State
    ========================= */
    .details-no-image {
        height: 190px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        gap: 10px;
        color: var(--muted);
        background:
            radial-gradient(
                circle at center,
                rgba(201, 169, 97, 0.07),
                transparent 60%
            ),
            var(--surface-2);
        border-bottom: 1px solid var(--gold-soft);
    }

    .details-no-image i {
        font-size: 42px;
        color: var(--gold);
        opacity: 0.65;
    }

    .details-no-image span {
        font-size: 12px;
    }

    /* =========================
       Responsive
    ========================= */
    @media (max-width: 700px) {
        .details-container {
            padding: 15px;
        }

        .details-body {
            padding: 20px;
        }

        .details-top {
            align-items: flex-start;
            flex-direction: column;
        }

        .details-heading {
            font-size: 19px;
        }

        .meta-info {
            grid-template-columns: 1fr;
        }

        .details-media {
            max-height: 300px;
        }
    }

    @media (max-width: 450px) {
        .details-container {
            padding: 10px;
        }

        .details-body {
            padding: 16px;
        }

        .details-text {
            padding: 16px;
            font-size: 13px;
        }

        .back-btn {
            margin-bottom: 15px;
        }
    }
</style>

@endsection

@section('content') <div class="dashboard-wrapper details-container">

     <!-- زر العودة -->
    <a href="{{ route('employee.training.bank') }}" class="back-btn">
        <i class="fas fa-arrow-right"></i>
        العودة إلى بنك التمارين
    </a>

    <div class="details-card">

        <!-- عرض الصورة -->
        @if ($plan->image_path)
            <div class="details-media-wrapper">
                <img src="{{ asset('storage/' . $plan->image_path) }}"
                    alt="صورة التمرين"
                    class="details-media">

                <div class="media-overlay"></div>
            </div>
        @else
            <div class="details-no-image">
                <i class="fas fa-dumbbell"></i>
                <span>لا توجد صورة توضيحية لهذا التمرين</span>
            </div>
        @endif

        <div class="details-body">

            <div class="details-top">

                <h2 class="details-heading">
                    <i class="fas fa-dumbbell"></i>
                    تفاصيل التمرين
                </h2>

                <span class="level-badge">
                    <i class="fas fa-layer-group"></i>
                    المستوى المستهدف:
                    {{ $plan->level ?? 'عام' }}
                </span>

            </div>

            <div class="details-section">

                <div class="section-title">
                    <i class="fas fa-align-right"></i>
                    الشرح والتفاصيل البرمجية للتمرين
                </div>

                <div class="details-text">
                    {{ $plan->plan_details }}
                </div>

            </div>

            <div class="meta-info">

                <div class="meta-item">
                    <i class="far fa-calendar-alt"></i>
                    <span>
                        تاريخ الإضافة:
                        {{ $plan->created_at->format('Y-m-d') }}
                    </span>
                </div>

                <div class="meta-item">
                    <i class="far fa-clock"></i>
                    <span>
                        آخر تحديث:
                        {{ $plan->updated_at->diffForHumans() }}
                    </span>
                </div>

            </div>

        </div>
    </div>
</div>

@endsection
