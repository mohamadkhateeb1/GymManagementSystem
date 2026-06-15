<style>
    .sidebar {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .sidebar .brand-logo {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 22px 24px;
        border-bottom: 1px solid var(--gold-line);
    }

    .sidebar .brand-mark {
        width: 40px;
        height: 40px;
        flex-shrink: 0;
        display: grid;
        place-items: center;
        border-radius: 11px;
        font-size: 16px;
        color: #0a0d14;
        background: linear-gradient(135deg, #e7cd8e, #c9a961 60%, #a9863f);
        box-shadow: 0 6px 16px rgba(201, 169, 97, 0.3);
    }

    .sidebar .brand-text {
        font-weight: 800;
        font-size: 19px;
        color: var(--gold);
        line-height: 1.25;
    }

    .sidebar .brand-text small {
        display: block;
        font-size: 11px;
        font-weight: 500;
        color: var(--muted);
        letter-spacing: .3px;
    }

    .sidebar-nav {
        padding: 18px 16px;
    }

    .sidebar-nav .nav-section {
        font-size: 11px;
        font-weight: 700;
        letter-spacing: .5px;
        color: var(--muted);
        padding: 6px 12px 10px;
        text-transform: uppercase;
    }

    .nav-link {
        position: relative;
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 14px;
        margin-bottom: 4px;
        color: var(--muted);
        text-decoration: none;
        border-radius: 10px;
        font-size: 14.5px;
        font-weight: 500;
        transition: background .18s ease, color .18s ease, transform .18s ease;
    }

    .nav-link i {
        width: 20px;
        text-align: center;
        font-size: 15px;
        transition: color .18s ease;
    }

    .nav-link:hover {
        color: var(--text);
        background: rgba(255, 255, 255, 0.04);
        transform: translateX(-3px);
    }

    .nav-link.active {
        color: var(--gold);
        background: var(--gold-soft);
        font-weight: 700;
    }

    .nav-link.active i {
        color: var(--gold);
    }

    .nav-link.active::before {
        content: "";
        position: absolute;
        inset-inline-end: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 3px;
        height: 20px;
        border-radius: 4px;
        background: var(--gold);
    }

    .nav-link.nav-2fa {
        margin-top: 16px;
        color: var(--gold);
        border: 1px solid rgba(201, 169, 97, 0.22);
        background: rgba(201, 169, 97, 0.05);
    }

    .nav-link.nav-2fa:hover {
        background: var(--gold-soft);
        transform: translateX(-3px);
    }

    .sidebar-footer {
        padding: 18px 20px;
    }

    .logout-btn {
        width: 100%;
        display: flex;
        align-items: center;
        gap: 10px;
        justify-content: flex-start;
        background: transparent;
        border: 1px solid rgba(197, 90, 90, 0.4);
        color: var(--danger);
        padding: 11px 14px;
        border-radius: 10px;
        font-family: inherit;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: background .18s ease, color .18s ease;
    }

    .logout-btn:hover {
        background: rgba(197, 90, 90, 0.12);
        color: #e08585;
    }

    .logout-btn i {
        width: 18px;
        text-align: center;
    }
</style>

<div class="sidebar">
    <div>
        <div class="brand-logo">
            <span class="brand-mark"><i class="fas fa-crown"></i></span>
            <span class="brand-text">Elite Club <small>لوحة المدرب</small></span>
        </div>

        <nav class="sidebar-nav">
            <div class="nav-section">القائمة</div>

            <a href="{{ route('employee.dashboard') }}"
                class="nav-link {{ request()->routeIs('employee.dashboard') ? 'active' : '' }}">
                <i class="fas fa-chart-line"></i> الرئيسية
            </a>

            <a href="{{ route('employee.monitoring') }}"
                class="nav-link {{ request()->routeIs('employee.monitoring') ? 'active' : '' }}">
                <i class="fas fa-users"></i> لاعبيّ
            </a>

            {{-- {{ route('employee.training') }} --}}
            <a href="#" class="nav-link">
                <i class="fas fa-dumbbell"></i> الخطط التدريبية
            </a>

            <a href="{{ route('employee.2fa') }}"
                class="nav-link nav-2fa {{ request()->routeIs('employee.2fa') ? 'active' : '' }}">
                <i class="fas fa-shield-halved"></i> التحقق بخطوتين
            </a>
        </nav>
    </div>

    <div class="sidebar-footer">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-btn">
                <i class="fas fa-sign-out-alt"></i> تسجيل خروج
            </button>
        </form>
    </div>
</div>
