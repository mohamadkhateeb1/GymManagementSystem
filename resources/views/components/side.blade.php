<style>
    /* التنسيقات الأساسية للعنصر */
    .nav-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 16px;
        color: #9ca3af;
        text-decoration: none;
        font-size: 14.5px;
        font-weight: 600;
        border-radius: 8px;
        margin-bottom: 4px;
        transition: all 0.2s ease;
        border-right: 3px solid transparent;
        /* مساحة للخط الجانبي */
    }

    .nav-item i {
        font-size: 18px;
        transition: color 0.2s ease;
    }

    /* تأثير المرور (Hover) للعناصر غير النشطة */
    .nav-item:hover:not(.active) {
        background: rgba(255, 255, 255, 0.04);
        color: #e8eaf6;
    }

    /* 🌟 التنسيق عندما يكون العنصر نشطاً (Active) 🌟 */
    .nav-item.active {
        background: rgba(108, 99, 255, 0.12);
        /* خلفية زرقاء/بنفسجية خفيفة تناسب Elite Club */
        color: #6c63ff;
        /* لون النص */
        border-right: 3px solid #6c63ff;
        /* خط جانبي ملون */
        font-weight: 700;
    }

    .nav-item.active i {
        color: #6c63ff;
        /* تلوين الأيقونة */
        filter: drop-shadow(0 0 8px rgba(108, 99, 255, 0.4));
        /* توهج خفيف للأيقونة */
    }
</style>

<div>
    @foreach ($navGroups as $group)
        <div class="nav-section">
            <div class="nav-label">{{ $group['section'] }}</div>

            @foreach ($group['items'] as $item)
                {{-- استخدام active_pattern إن وجد، وإلا نستخدم الـ route الأساسي --}}
                <a href="{{ Route::has($item['route']) ? route($item['route']) : '#' }}"
                    class="nav-item {{ request()->routeIs($item['active_pattern'] ?? $item['route']) ? 'active' : '' }}">
                    <i class="{{ $item['icon'] }}"></i> {{ $item['label'] }}
                </a>
            @endforeach
        </div>
    @endforeach
</div>
