<div class="topbar">
    <div class="user-profile">
        <div class="user-avatar">{{ substr(auth()->user()->name ?? 'A', 0, 1) }}</div>
        <div class="user-info">
            <h5 style="margin-bottom: 2px;">{{ auth()->user()->name ?? 'مدير النظام' }}</h5>
            <span style="font-size: 11px; color: var(--text-muted);">{{ auth()->check() && auth()->user()->roles->count() ? auth()->user()->roles->first()->name : 'مدير النظام' }}</span>
        </div>
    </div>
</div>