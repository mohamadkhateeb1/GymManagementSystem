<div>
    @foreach ($navGroups as $group)
        <div class="nav-section">
            <div class="nav-label">{{ $group['section'] }}</div>
            
            @foreach ($group['items'] as $item)
                <a href="{{ Route::has($item['route']) ? route($item['route']) : '#' }}"
                   class="nav-item {{ request()->routeIs($item['route']) ? 'active' : '' }}">
                    <i class="{{ $item['icon'] }}"></i> {{ $item['label'] }}
                </a>
            @endforeach
        </div>
    @endforeach
</div>