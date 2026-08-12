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
            max-width: 850px;
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

        .btn-green {
            background: rgba(90, 156, 122, 0.15);
            color: #5a9c7a;
            border: 1px solid rgba(90, 156, 122, 0.3);
            padding: 8px 16px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            transition: all 0.2s;
        }

        .btn-green:hover {
            background: #5a9c7a;
            color: #fff;
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
            max-height: 380px;
            object-fit: cover;
            background: var(--surface-2);
            border-bottom: 1px solid var(--gold-soft);
        }

        .details-body {
            padding: 30px;
        }

        .badge-info {
            background: rgba(201, 169, 97, 0.12);
            color: var(--gold);
            padding: 6px 14px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 700;
            display: inline-block;
            border: 1px solid rgba(201, 169, 97, 0.2);
            margin-bottom: 20px;
        }

        .section-title {
            color: var(--gold);
            font-size: 17px;
            font-weight: 700;
            margin: 20px 0 12px 0;
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
        }

        .video-wrapper {
            position: relative;
            padding-bottom: 56.25%;
            height: 0;
            overflow: hidden;
            border-radius: 12px;
            border: 1px solid var(--gold-soft);
            background: #000;
            margin-top: 10px;
        }

        .video-wrapper iframe,
        .video-wrapper video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
    </style>
@endsection

@section('content')
    <div class="dashboard-wrapper details-container">
        <!-- زر العودة للمكتبة -->
        <a href="{{ route('employee.exercise.library') }}" class="back-btn">
            <i class="fas fa-arrow-right"></i> العودة لمكتبة التمارين
        </a>

        <div class="details-card">
            <!-- 📷 صورة التمرين إن وجدت -->
            @if ($exercise->image_path)
                <img src="{{ asset('storage/' . $exercise->image_path) }}" alt="صورة التمرين" class="details-media">
            @endif

            <div class="details-body">
                <h1 style="color: #fff; margin: 0 0 10px 0; font-size: 24px;">
                    {{ $exercise->exercise_name ?? $exercise->name }}
                </h1>

                <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                    <span class="badge-info"><i class="fas fa-list-alt"></i> الخطة:
                        {{ $exercise->trainingPlan->title ?? 'عام' }}</span>
                    <span class="badge-info"><i class="fas fa-layer-group"></i> المستوى:
                        {{ $exercise->trainingPlan->level ?? 'عام' }}</span>
                    <span class="badge-info"><i class="fas fa-redo"></i> {{ $exercise->sets }} جولات</span>
                    <span class="badge-info"><i class="fas fa-sync-alt"></i> {{ $exercise->repetitions ?? $exercise->reps }}
                        تكرار</span>
                </div>

                <!-- 📝 الشرح والتعليمات -->
                <div class="section-title">
                    <i class="fas fa-align-right"></i> شرح وطريقة الأداء
                </div>
                <div class="details-text">
                    {{ $exercise->instructions ?? 'لا توجد تعليمات كتابية مرفقة لهذا التمرين.' }}
                </div>

                <!-- 🎬 فيديو التمرين (إن وجد) -->
                @if ($exercise->video_url)
                    <div class="section-title">
                        <i class="fas fa-video"></i> فيديو التكنيك والأداء
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
                        <div
                            style="background: var(--surface-2); padding: 20px; border-radius: 10px; text-align: center; border: 1px solid var(--gold-soft); margin-top: 10px;">
                            <p style="color: var(--text); margin-bottom: 12px; font-size: 14px;">انقر على الزر أدناه لمشاهدة
                                فيديو الشرح والمتابعة:</p>
                            <a href="{{ $url }}" target="_blank" class="btn-green"
                                style="display: inline-flex; align-items: center; gap: 8px;">
                                <i class="fas fa-external-link-alt"></i> فتح رابط الفيديو الخارجي
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
                @endif
            </div>
        </div>
    </div>
@endsection
