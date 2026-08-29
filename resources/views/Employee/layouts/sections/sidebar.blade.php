<style>

/* =========================================================
   ELITE CLUB — SIDEBAR
   يبدأ تحت الـ Full Width Navbar
   ========================================================= */

.sidebar {
    width: var(--sidebar-width);
    height: 100vh;
    position: fixed;
    top: 0;
    right: 0;
    z-index: 150;
    display: flex;
    flex-direction: column;
    background: var(--surface);
    border-left: 1px solid var(--border);
    box-shadow: var(--shadow);
    overflow: hidden;
    transition: background .25s ease, border-color .25s ease, box-shadow .25s ease, transform .25s ease;
}

/* =========================================================
   BRAND
   ========================================================= */

.sidebar-brand {
    min-height: 105px;
    padding: 20px;
    display: flex;
    align-items: center;
    gap: 13px;
    border-bottom: 1px solid var(--border);
}

.sidebar-brand-icon {
    width: 50px;
    height: 50px;
    flex: 0 0 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 15px;
    color: #fff;
    background: linear-gradient(135deg, var(--gold-light), var(--gold-dark));
    box-shadow: 0 9px 22px rgba(184, 146, 62, .20);
    font-size: 15px;
}

.sidebar-brand-text {
    display: flex;
    flex-direction: column;
    gap: 3px;
}

.sidebar-brand-title {
    color: var(--text);
    font-size: 17px;
    font-weight: 850;
    letter-spacing: .4px;
}

.sidebar-brand-subtitle {
    color: var(--muted);
    font-size: 8px;
    font-weight: 500;
}

/* =========================================================
   BODY
   ========================================================= */

.sidebar-body {
    flex: 1;
    overflow-y: auto;
    padding: 18px 13px;
    scrollbar-width: thin;
    scrollbar-color: var(--border) transparent;
}

/* =========================================================
   SECTION
   ========================================================= */

.sidebar-section-title {
    padding: 8px 13px;
    margin: 8px 0 7px;
    color: var(--muted);
    font-size: 9px;
    font-weight: 750;
}

/* =========================================================
   LINKS
   ========================================================= */

.sidebar-link {
    min-height: 47px;
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 9px 13px;
    margin-bottom: 5px;
    color: var(--text-soft);
    background: transparent;
    border: 1px solid transparent;
    border-radius: 12px;
    text-decoration: none;
    font-size: 11px;
    font-weight: 650;
    transition: background .18s ease, border-color .18s ease, color .18s ease, transform .18s ease, box-shadow .18s ease;
    opacity: 0;
    animation: sidebarLinkIn .4s ease both;
}

@keyframes sidebarLinkIn {
    from { opacity: 0; transform: translateX(8px); }
    to { opacity: 1; transform: translateX(0); }
}

.sidebar-link:nth-of-type(1) { animation-delay: .04s; }
.sidebar-link:nth-of-type(2) { animation-delay: .08s; }
.sidebar-link:nth-of-type(3) { animation-delay: .12s; }
.sidebar-link:nth-of-type(4) { animation-delay: .16s; }
.sidebar-link:nth-of-type(5) { animation-delay: .20s; }

.sidebar-link-icon {
    width: 30px;
    height: 30px;
    flex: 0 0 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--muted);
    background: transparent;
    border-radius: 8px;
    font-size: 12px;
    transition: color .18s ease, background .18s ease, transform .2s cubic-bezier(.34, 1.56, .64, 1);
}

.sidebar-link:hover {
    color: var(--gold);
    background: color-mix(in srgb, var(--gold) 5%, var(--surface-2));
    border-color: var(--border-soft);
    transform: translateX(-2px);
}

.sidebar-link:hover .sidebar-link-icon {
    color: var(--gold);
    background: color-mix(in srgb, var(--gold) 8%, transparent);
    transform: scale(1.12);
}

/* =========================================================
   ACTIVE
   ========================================================= */

.sidebar-link.active {
    color: var(--gold-dark);
    background: color-mix(in srgb, var(--gold) 11%, var(--surface));
    border-color: color-mix(in srgb, var(--gold) 25%, var(--border));
    box-shadow: inset -3px 0 0 var(--gold);
}

.sidebar-link.active .sidebar-link-icon {
    color: var(--gold);
    background: color-mix(in srgb, var(--gold) 9%, transparent);
}

/* =========================================================
   PROFILE
   المكان الوحيد للملف الشخصي
   ========================================================= */

.sidebar-profile {
    margin-top: 8px;
    padding-top: 10px;
    border-top: 1px solid var(--border);
}

.sidebar-profile .sidebar-link {
    margin-bottom: 0;
}

/* =========================================================
   FOOTER
   ========================================================= */

.sidebar-footer {
    padding: 13px;
    border-top: 1px solid var(--border);
    background: color-mix(in srgb, var(--surface) 96%, var(--gold) 4%);
}

/* =========================================================
   LOGOUT
   ========================================================= */

.sidebar-logout {
    width: 100%;
    min-height: 48px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 9px;
    color: var(--danger);
    background: color-mix(in srgb, var(--danger) 5%, var(--surface));
    border: 1px solid color-mix(in srgb, var(--danger) 20%, var(--border));
    border-radius: 12px;
    font-size: 11px;
    font-weight: 750;
    cursor: pointer;
    transition: background .18s ease, border-color .18s ease, transform .18s ease;
}

.sidebar-logout:hover {
    background: color-mix(in srgb, var(--danger) 10%, var(--surface));
    border-color: color-mix(in srgb, var(--danger) 35%, var(--border));
    transform: translateY(-1px);
}

/* =========================================================
   DARK MODE
   ========================================================= */

html[data-theme="dark"] .sidebar,
body[data-theme="dark"] .sidebar,
body.dark .sidebar {
    background: var(--surface);
    border-color: var(--border);
    box-shadow: var(--shadow);
}

html[data-theme="dark"] .sidebar-footer,
body[data-theme="dark"] .sidebar-footer,
body.dark .sidebar-footer {
    background: color-mix(in srgb, var(--surface) 96%, var(--gold) 4%);
}

/* =========================================================
   TABLET
   ========================================================= */

@media (max-width: 900px) {
    .sidebar {
        width: var(--sidebar-width);
    }

}

/* =========================================================
   MOBILE
   ========================================================= */

@media (max-width: 700px) {
    .sidebar {
        height: 100vh;
        top: 0;
        width: 250px;
        transform: translateX(100%);
    }

    /*
       إذا أردت فتحه لاحقاً بالجافاسكربت:
       أضف class "is-open"
    */

    .sidebar.is-open {
        transform: translateX(0);
    }

    .sidebar-brand {
        min-height: 82px;
        padding: 14px;
    }

    .sidebar-brand-icon {
        width: 42px;
        height: 42px;
        flex-basis: 42px;
        border-radius: 12px;
    }

    .sidebar-brand-title {
        font-size: 14px;
    }

}


/* =========================================================
   QUICK INFO — لوحة التحكم + التاريخ (نُقلت من النافبار)
   ========================================================= */

.sidebar-quickinfo {
    margin: 14px 15px 6px;
    padding: 13px 15px;
    background: var(--surface-2);
    border: 1px solid var(--border);
    border-radius: 12px;
    transition: background .25s ease, border-color .25s ease;
}

.sidebar-quickinfo-title {
    color: var(--text);
    font-size: 13px;
    font-weight: 800;
    margin-bottom: 7px;
}

.sidebar-quickinfo-date {
    display: flex;
    align-items: center;
    gap: 7px;
    color: var(--muted);
    font-size: 10px;
    font-weight: 600;
}

.sidebar-quickinfo-date i {
    color: var(--gold);
    font-size: 11px;
}

</style>

<aside class="sidebar"> 
    {{-- =====================================================
         BRAND
    ====================================================== --}}

    <div class="sidebar-brand">

        <div class="sidebar-brand-icon">

            <i class="fas fa-crown"></i>

        </div>

        <div class="sidebar-brand-text">

            <span class="sidebar-brand-title">
                ELITE CLUB
            </span>

            <span class="sidebar-brand-subtitle">
                Employee Dashboard
            </span>

        </div>

    </div>

    {{-- =====================================================
         QUICK INFO — لوحة التحكم + التاريخ
         نُقلت من النافبار لتصبح هنا بدلاً منه
    ====================================================== --}}

    <div class="sidebar-quickinfo">
        <div class="sidebar-quickinfo-title">
            لوحة التحكم
        </div>
        <div class="sidebar-quickinfo-date">
            <i class="fas fa-calendar-days"></i>
            {{ \Carbon\Carbon::now()->locale('ar')->translatedFormat('l، d F Y') }}
        </div>
    </div>

    {{-- =====================================================
         BODY
    ====================================================== --}}

    <div class="sidebar-body"> 
        {{-- Dashboard --}}

        <div class="sidebar-section-title">
            لوحة التحكم
        </div>

        <a href="{{ route('employee.dashboard') }}"
           class="sidebar-link            {{ request()->routeIs('employee.dashboard') ? 'active' : '' }}">

            <span class="sidebar-link-icon">

                <i class="fas fa-grid-2"></i>

            </span>

            <span>
                لوحة التحكم
            </span>

        </a> 
        {{-- =================================================
             OPERATIONS
        ================================================== --}}

        <div class="sidebar-section-title">
            العمليات الأساسية
        </div> 
        {{-- Players --}}

        <a href="{{ route('employee.monitoring') }}"
           class="sidebar-link            {{ request()->routeIs('employee.monitoring*') ? 'active' : '' }}">

            <span class="sidebar-link-icon">

                <i class="fas fa-users"></i>

            </span>

            <span>
                إدارة اللاعبين
            </span>

        </a> 
        {{-- Training --}}

        <a href="{{ route('employee.training.bank') }}"
           class="sidebar-link            {{ request()->routeIs('employee.training.*') ? 'active' : '' }}">

            <span class="sidebar-link-icon">

                <i class="fas fa-dumbbell"></i>

            </span>

            <span>
                بنك التدريب
            </span>

        </a> 
        {{-- Diet --}}

        <a href="{{ route('employee.diet.bank') }}"
           class="sidebar-link            {{ request()->routeIs('employee.diet.*') ? 'active' : '' }}">

            <span class="sidebar-link-icon">

                <i class="fas fa-utensils"></i>

            </span>

            <span>
                بنك التغذية
            </span>

        </a> 
        {{-- =================================================
             ACCOUNT
        ================================================== --}}

        <div class="sidebar-section-title">
            الحساب
        </div> 
        {{-- PROFILE
             المكان الوحيد للملف الشخصي
        --}}

        <div class="sidebar-profile">

            <a href="{{ route('employee.profile.edit') }}"
               class="sidebar-link                {{ request()->routeIs('employee.profile.*') ? 'active' : '' }}">

                <span class="sidebar-link-icon">

                    <i class="fas fa-id-badge"></i>

                </span>

                <span>
                    الملف الشخصي
                </span>

            </a>

        </div>

    </div> 
    {{-- =====================================================
         LOGOUT
    ====================================================== --}}

    <div class="sidebar-footer">

        <form action="{{ route('logout') }}"
              method="POST">

            @csrf

            <button type="submit"
                    class="sidebar-logout">

                <i class="fas fa-right-from-bracket"></i>

                <span>
                    تسجيل الخروج
                </span>

            </button>

        </form>

    </div>

</aside>