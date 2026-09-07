<div>
    @foreach ($navGroups as $group)

        {{-- لا نعرض عنوان القسم إذا انفلترت كل عناصره حسب صلاحيات الدور --}}
        @if (!empty($group['items']))

            <div class="sidebar-section-title">
                {{ $group['section'] }}
            </div>

            @foreach ($group['items'] as $item)

                <a href="{{ Route::has($item['route']) ? route($item['route']) : '#' }}"
                    class="sidebar-link {{ request()->routeIs($item['active_pattern'] ?? $item['route']) ? 'active' : '' }}">

                    <span class="sidebar-link-icon">
                        <i class="{{ $item['icon'] }}"></i>
                    </span>

                    <span>
                        {{ $item['label'] }}
                    </span>

                </a>

            @endforeach

        @endif

    @endforeach
</div>