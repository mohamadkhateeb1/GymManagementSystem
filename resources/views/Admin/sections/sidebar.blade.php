<aside class="sidebar">
    <div class="brand">
        <div class="brand-logo">
            <div class="brand-mark"><i class="fas fa-crown"></i></div>
            <div class="brand-text">
                <h2>ELITE CLUB</h2>
                <span>Admin Dashboard</span>
            </div>
        </div>
    </div>

    <x-side />

    <div class="nav-section" style="margin-top: auto; padding-top: 15px; border-top: 1px solid var(--border);">
        <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
            @csrf
            <button type="submit" class="sidebar-logout">
                <i class="fas fa-sign-out-alt"></i> تسجيل الخروج
            </button>
        </form>
    </div>
</aside>