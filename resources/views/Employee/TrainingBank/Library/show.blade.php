@extends('Employee.layouts.app')

@section('title', 'تفاصيل التمرين | Elite Club')

@section('styles')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        /* =========================================================
               ELITE CLUB - EXERCISE DETAILS
               DESIGN ONLY
               LOGIC / ROUTES / VARIABLES PRESERVED
            ========================================================= */

        .details-container {
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
            max-width: 900px;

            margin: 0 auto;

            padding: 22px;

            box-sizing: border-box;
        }

        .details-container *,
        .details-container *::before,
        .details-container *::after {
            box-sizing: border-box;
        }

        /* =========================================================
               BACK BUTTON
            ========================================================= */

        .back-btn {
            display: inline-flex;

            align-items: center;

            gap: 8px;

            margin-bottom: 17px;

            padding: 8px 12px;

            color: var(--gold-light) !important;

            background: rgba(201, 169, 97, 0.055) !important;

            border: 1px solid rgba(201, 169, 97, 0.14) !important;

            border-radius: 9px !important;

            text-decoration: none !important;

            font-size: 14px;
            font-weight: 800;

            transition: all 0.2s ease;
        }

        .back-btn:hover {
            color: #f0dcaa !important;

            background: rgba(201, 169, 97, 0.10) !important;

            border-color: rgba(201, 169, 97, 0.25) !important;

            transform: translateX(3px);

            text-decoration: none !important;
        }

        .back-btn i {
            color: var(--gold) !important;

            font-size: 11px;
        }

        /* =========================================================
               MAIN CARD
            ========================================================= */

        .details-card {
            position: relative;

            background: #171a21 !important;

            border: 1px solid rgba(201, 169, 97, 0.16) !important;

            border-radius: 17px !important;

            overflow: hidden !important;

            box-shadow:
                0 15px 35px rgba(0, 0, 0, 0.13),
                inset 0 1px 0 rgba(255, 255, 255, 0.015) !important;
        }

        .details-card::before {
            content: "";

            position: absolute;

            right: 0;
            top: 0;

            width: 4px;
            height: 100%;

            background: linear-gradient(to bottom,
                    var(--gold-light),
                    var(--gold));

            box-shadow:
                0 0 18px rgba(201, 169, 97, 0.30);

            z-index: 2;
        }

        /* =========================================================
               IMAGE
            ========================================================= */

        .details-media {
            display: block;

            width: 100%;

            max-height: 390px;

            object-fit: cover;

            background: #111419 !important;

            border: 0 !important;
            border-bottom: 1px solid rgba(201, 169, 97, 0.10) !important;

            aspect-ratio: 16 / 8;

            transition: transform 0.3s ease;
        }

        /* =========================================================
               BODY
            ========================================================= */

        .details-body {
            padding: 27px;
        }

        /* =========================================================
               TITLE AREA
            ========================================================= */

        .exercise-title-area {
            margin-bottom: 20px;

            padding-bottom: 18px;

            border-bottom: 1px solid rgba(255, 255, 255, 0.045);
        }

        .exercise-kicker {
            display: flex;

            align-items: center;

            gap: 7px;

            margin-bottom: 7px;

            color: var(--gold) !important;

            font-size: 13px;
            font-weight: 800;
        }

        .exercise-kicker i {
            font-size: 11px;
        }

        .exercise-main-title {
            margin: 0 !important;

            color: #ffffff !important;

            font-size: 29px !important;

            font-weight: 900 !important;

            line-height: 1.5;
        }

        /* =========================================================
               INFO BADGES
            ========================================================= */

        .exercise-meta {
            display: flex;

            align-items: center;

            gap: 8px;

            flex-wrap: wrap;

            margin-top: 15px;
        }

        .badge-info {
            display: inline-flex;

            align-items: center;

            gap: 7px;

            padding: 7px 11px;

            background: rgba(201, 169, 97, 0.065) !important;

            color: #e6cf91 !important;

            border: 1px solid rgba(201, 169, 97, 0.17) !important;

            border-radius: 8px !important;

            font-size: 13px;
            font-weight: 800;

            line-height: 1.5;

            margin: 0 !important;
        }

        .badge-info i {
            color: var(--gold) !important;

            font-size: 11px;
        }

        /* =========================================================
               CONTENT SECTIONS
            ========================================================= */

        .content-section {
            margin-top: 22px;
        }

        .section-title {
            display: flex;

            align-items: center;

            gap: 9px;

            margin: 0 0 10px !important;

            padding: 0 0 10px;

            color: #ffffff !important;

            border-bottom: 1px solid rgba(201, 169, 97, 0.09) !important;

            font-size: 16px !important;

            font-weight: 800 !important;

            line-height: 1.6;
        }

        .section-title i {
            width: 28px;
            height: 28px;

            display: flex;
            align-items: center;
            justify-content: center;

            background: rgba(201, 169, 97, 0.07) !important;

            border: 1px solid rgba(201, 169, 97, 0.13) !important;

            border-radius: 8px !important;

            color: var(--gold) !important;

            font-size: 11px;

            flex-shrink: 0;
        }

        /* =========================================================
               TEXT DETAILS
            ========================================================= */

        .details-text {
            padding: 18px 19px;

            background: #1d212a !important;

            border: 1px solid rgba(255, 255, 255, 0.045) !important;

            border-radius: 11px !important;

            color: #dfe2e7 !important;

            font-size: 15.5px;
            font-weight: 600;

            line-height: 2;

            white-space: pre-line;

            min-height: 70px;

            box-shadow:
                inset 0 1px 0 rgba(255, 255, 255, 0.012);
        }

        /* =========================================================
               VIDEO
            ========================================================= */

        .video-wrapper {
            position: relative;

            width: 100%;

            height: 0;

            padding-bottom: 56.25%;

            margin-top: 10px;

            overflow: hidden;

            background: #0b0d10 !important;

            border: 1px solid rgba(201, 169, 97, 0.14) !important;

            border-radius: 12px !important;

            box-shadow:
                0 10px 25px rgba(0, 0, 0, 0.18);
        }

        .video-wrapper iframe,
        .video-wrapper video {
            position: absolute;

            top: 0;
            left: 0;

            width: 100%;
            height: 100%;

            display: block;

            border: 0 !important;

            background: #000 !important;
        }

        /* =========================================================
               EXTERNAL VIDEO
            ========================================================= */

        .external-video-box {
            padding: 22px;

            margin-top: 10px;

            background: #1d212a !important;

            border: 1px solid rgba(201, 169, 97, 0.12) !important;

            border-radius: 11px !important;

            text-align: center;
        }

        .external-video-icon {
            width: 44px;
            height: 44px;

            margin: 0 auto 11px;

            display: flex;

            align-items: center;
            justify-content: center;

            background: rgba(201, 169, 97, 0.075) !important;

            border: 1px solid rgba(201, 169, 97, 0.15) !important;

            border-radius: 11px !important;

            color: var(--gold) !important;

            font-size: 16px;
        }

        .external-video-box p {
            margin: 0 0 14px !important;

            color: #aeb3bd !important;

            font-size: 14px;
            font-weight: 600;

            line-height: 1.9;
        }

        /* =========================================================
               GREEN BUTTON
            ========================================================= */

        .btn-green {
            display: inline-flex;

            align-items: center;
            justify-content: center;

            gap: 7px;

            padding: 8px 15px;

            background: rgba(90, 156, 122, 0.08) !important;

            color: #5a9c7a !important;

            border: 1px solid rgba(90, 156, 122, 0.25) !important;

            border-radius: 8px !important;

            text-decoration: none !important;

            font-size: 13.5px;
            font-weight: 800;

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

            font-size: 11px;
        }

        /* =========================================================
               RESPONSIVE - TABLET / MOBILE
            ========================================================= */

        @media (max-width: 900px) {
            .details-container {
                max-width: 100%;
                padding: 18px;
            }

            .details-body {
                padding: 24px;
            }

            .details-media {
                max-height: 360px;
                aspect-ratio: 16 / 9;
            }

            .exercise-main-title {
                font-size: 27px !important;
            }

            .details-text {
                font-size: 15px;
            }
        }

        @media (max-width: 700px) {
            .details-container {
                width: 100%;
                padding: 12px;
            }

            .details-card {
                width: 100%;
                border-radius: 14px !important;
            }

            .details-body {
                padding: 20px;
            }

            .back-btn {
                width: 100%;
                justify-content: center;
                margin-bottom: 14px;
                padding: 10px 13px;
                font-size: 14px;
            }

            .exercise-title-area {
                margin-bottom: 18px;
                padding-bottom: 16px;
            }

            .exercise-kicker {
                font-size: 13px;
                margin-bottom: 8px;
            }

            .exercise-main-title {
                font-size: 24px !important;
                line-height: 1.55;
                overflow-wrap: anywhere;
            }

            .exercise-meta {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 8px;
                margin-top: 14px;
            }

            .badge-info {
                width: 100%;
                min-width: 0;
                justify-content: center;
                text-align: center;
                padding: 8px 7px;
                font-size: 12.5px;
                font-weight: 800;
                overflow-wrap: anywhere;
            }

            .section-title {
                font-size: 15px !important;
                gap: 8px;
            }

            .section-title i {
                width: 30px;
                height: 30px;
                font-size: 12px;
            }

            .details-text {
                padding: 16px;
                font-size: 14.5px;
                font-weight: 600;
                line-height: 1.95;
                overflow-wrap: anywhere;
            }

            .external-video-box {
                padding: 18px;
            }

            .external-video-box p {
                font-size: 13.5px;
                font-weight: 600;
            }

            .btn-green {
                width: 100%;
                padding: 10px 14px;
                font-size: 13px;
            }
        }

        @media (max-width: 480px) {
            .details-container {
                padding: 8px;
            }

            .details-card {
                border-radius: 12px !important;
            }

            .details-body {
                padding: 16px;
            }

            .details-media {
                max-height: 260px;
                aspect-ratio: 16 / 10;
            }

            .exercise-main-title {
                font-size: 22px !important;
            }

            .exercise-meta {
                grid-template-columns: 1fr;
            }

            .badge-info {
                justify-content: flex-start;
                text-align: right;
                font-size: 13px;
            }

            .section-title {
                font-size: 14.5px !important;
            }

            .details-text {
                padding: 14px;
                font-size: 14px;
            }

            .video-wrapper {
                border-radius: 10px !important;
            }
        }

        @media (max-width: 360px) {
            .details-container {
                padding: 5px;
            }

            .details-body {
                padding: 13px;
            }

            .exercise-main-title {
                font-size: 20px !important;
            }

            .details-text {
                font-size: 13.5px;
            }
        }
    </style>
@endsection

@section('content')
    <div class="dashboard-wrapper details-container">

        <!-- زر العودة للمكتبة -->
        <a href="{{ route('employee.exercise.library') }}" class="back-btn">
            <i class="fas fa-arrow-right"></i>
            العودة لمكتبة التمارين
        </a>

        <div class="details-card">

            <!-- 📷 صورة التمرين إن وجدت -->
            @if ($exercise->image_path)
                <img src="{{ asset('storage/' . $exercise->image_path) }}" alt="صورة التمرين" class="details-media">
            @endif

            <div class="details-body">

                <!-- عنوان التمرين -->
                <div class="exercise-title-area">

                    <div class="exercise-kicker">
                        <i class="fas fa-dumbbell"></i>
                        تفاصيل التمرين
                    </div>

                    <h1 class="exercise-main-title">
                        {{ $exercise->exercise_name ?? $exercise->name }}
                    </h1>

                    <!-- معلومات التمرين -->
                    <div class="exercise-meta">

                        <span class="badge-info">
                            <i class="fas fa-list-alt"></i>
                            الخطة:
                            {{ $exercise->trainingPlan->title ?? 'عام' }}
                        </span>

                        <span class="badge-info">
                            <i class="fas fa-layer-group"></i>
                            المستوى:
                            {{ $exercise->trainingPlan->level ?? 'عام' }}
                        </span>

                        <span class="badge-info">
                            <i class="fas fa-redo"></i>
                            {{ $exercise->sets }} جولات
                        </span>

                        <span class="badge-info">
                            <i class="fas fa-sync-alt"></i>
                            {{ $exercise->repetitions ?? $exercise->reps }}
                            تكرار
                        </span>

                    </div>

                </div>

                <!-- 📝 الشرح والتعليمات -->
                <div class="content-section">

                    <div class="section-title">
                        <i class="fas fa-align-right"></i>
                        شرح وطريقة الأداء
                    </div>

                    <div class="details-text">
                        {{ $exercise->instructions ?? 'لا توجد تعليمات كتابية مرفقة لهذا التمرين.' }}
                    </div>

                </div>

                <!-- 🎬 فيديو التمرين (إن وجد) -->
                @if ($exercise->video_url)

                    <div class="content-section">

                        <div class="section-title">
                            <i class="fas fa-video"></i>
                            فيديو التكنيك والأداء
                        </div>

                        @php
                            $url = trim($exercise->video_url);
                            $videoId = null;

                            // دعم كافة أنواع روابط يوتيوب (watch, youtu.be, shorts, embed)
                            if (
                                preg_match(
                                    '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=|shorts\/)|youtu\.be\/)([^"&?\/\s]{11})/',
                                    $url,
                                    $matches,
                                )
                            ) {
                                $videoId = $matches[1];
                            }
                        @endphp

                        @if ($videoId)
                            <div class="video-wrapper">

                                <iframe src="https://www.youtube.com/embed/{{ $videoId }}" title="فيديو التمرين"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
                                </iframe>

                            </div>
                        @elseif(Str::startsWith($url, ['http://', 'https://']))
                            <!-- في حال كان الرابط من موقع آخر يظهر زر مخصص للمشاهدة -->
                            <div class="external-video-box">

                                <div class="external-video-icon">
                                    <i class="fas fa-external-link-alt"></i>
                                </div>

                                <p>
                                    انقر على الزر أدناه لمشاهدة فيديو الشرح والمتابعة:
                                </p>

                                <a href="{{ $url }}" target="_blank" class="btn-green">

                                    <i class="fas fa-external-link-alt"></i>
                                    فتح رابط الفيديو الخارجي

                                </a>

                            </div>
                        @else
                            <!-- فيديو محلي مرفوع مباشرة على السيرفر -->
                            <div class="video-wrapper">

                                <video controls>

                                    <source src="{{ asset('storage/' . $url) }}" type="video/mp4">

                                    المتصفح لا يدعم تشغيل هذا الفيديو.

                                </video>

                            </div>
                        @endif

                    </div>

                @endif

            </div>

        </div>

    </div>
@endsection
