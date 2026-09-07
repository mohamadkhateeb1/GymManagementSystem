<style>
    :root {
        --elite-sidebar-width: var(--sidebar-width, 270px);
        --elite-mobile-sidebar-width: min(310px, 86vw);
    }

    .sidebar {
        width: var(--elite-sidebar-width);
        height: 100vh;
        position: fixed;
        top: 0;
        right: 0;
        z-index: 1200;
        display: flex;
        flex-direction: column;
        background: var(--surface);
        border-left: 1px solid var(--border);
        box-shadow: var(--shadow-md);
        overflow: hidden;
        transition:
            background .25s ease,
            border-color .25s ease,
            box-shadow .25s ease,
            transform .32s cubic-bezier(.22, .61, .36, 1);
    }

    .sidebar-brand {
        min-height: 105px;
        padding: 20px;
        display: flex;
        align-items: center;
        gap: 13px;
        flex-shrink: 0;
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
        background:
            linear-gradient(135deg,
                var(--gold-light),
                var(--gold-dark));
        box-shadow:
            0 9px 22px rgba(184, 146, 62, .20);
        font-size: 17px;
    }

    .sidebar-brand-text {
        min-width: 0;
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .sidebar-brand-title {
        color: var(--text);
        font-size: 20px;
        font-weight: 900;
        letter-spacing: .4px;
        white-space: nowrap;
    }

    .sidebar-brand-subtitle {
        color: var(--text-soft);
        font-size: 12.5px;
        font-weight: 600;
        white-space: nowrap;
    }

    .sidebar-quickinfo {
        margin: 14px 15px 6px;
        padding: 13px 15px;
        background: var(--surface-2);
        border: 1px solid var(--border);
        border-radius: 12px;
        flex-shrink: 0;
        transition:
            background .25s ease,
            border-color .25s ease;
    }

    .sidebar-quickinfo-title {
        color: var(--text);
        font-size: 16px;
        font-weight: 850;
        margin-bottom: 8px;
    }

    .sidebar-quickinfo-date {
        display: flex;
        align-items: center;
        gap: 7px;
        color: var(--text-soft);
        font-size: 13px;
        font-weight: 700;
    }

    .sidebar-quickinfo-date i {
        color: var(--gold);
        font-size: 13px;
    }

    .sidebar-body {
        flex: 1;
        min-height: 0;
        overflow-y: auto;
        padding: 12px 13px 18px;
        scrollbar-width: thin;
        scrollbar-color:
            var(--border) transparent;
    }

    .sidebar-body::-webkit-scrollbar {
        width: 5px;
    }

    .sidebar-body::-webkit-scrollbar-track {
        background: transparent;
    }

    .sidebar-body::-webkit-scrollbar-thumb {
        background: var(--border);
        border-radius: 999px;
    }

    .sidebar-body::-webkit-scrollbar-thumb:hover {
        background: var(--gold);
    }

    .sidebar-section-title {
        padding: 9px 13px;
        margin: 9px 0 7px;
        color: var(--text-soft);
        font-size: 12.5px;
        font-weight: 850;
        line-height: 1.5;
    }

    .sidebar-link {
        min-height: 49px;
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 9px 13px;
        margin-bottom: 5px;
        color: var(--text);
        background: transparent;
        border: 1px solid transparent;
        border-radius: 12px;
        text-decoration: none;
        font-size: 14.5px;
        font-weight: 750;
        line-height: 1.5;
        transition:
            background .18s ease,
            border-color .18s ease,
            color .18s ease,
            transform .18s ease,
            box-shadow .18s ease;
        opacity: 0;
        animation:
            sidebarLinkIn .4s ease both;
    }

    @keyframes sidebarLinkIn {

        from {
            opacity: 0;
            transform: translateX(10px);
        }

        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    .sidebar-link-icon {
        width: 34px;
        height: 34px;
        flex: 0 0 34px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--text-soft);
        background: transparent;
        border-radius: 9px;
        font-size: 15px;
        transition:
            color .18s ease,
            background .18s ease,
            transform .2s cubic-bezier(.34, 1.56, .64, 1);
    }

    .sidebar-link:hover {
        color: var(--gold);
        background:
            color-mix(in srgb,
                var(--gold) 5%,
                var(--surface-2));
        border-color: var(--border-soft);
        transform: translateX(-2px);
    }

    .sidebar-link:hover .sidebar-link-icon {
        color: var(--gold);
        background:
            color-mix(in srgb,
                var(--gold) 8%,
                transparent);
        transform: scale(1.1);
    }

    .sidebar-link.active {
        color: var(--gold-dark);
        background:
            color-mix(in srgb,
                var(--gold) 11%,
                var(--surface));
        border-color:
            color-mix(in srgb,
                var(--gold) 25%,
                var(--border));
        box-shadow:
            inset -3px 0 0 var(--gold);
    }

    .sidebar-link.active .sidebar-link-icon {
        color: var(--gold);
        background:
            color-mix(in srgb,
                var(--gold) 9%,
                transparent);
    }

    .sidebar-profile {
        margin-top: 8px;
        padding-top: 10px;
        border-top: 1px solid var(--border);
    }

    .sidebar-profile .sidebar-link {
        margin-bottom: 5px;
    }

    .sidebar-footer {
        padding: 13px;
        flex-shrink: 0;
        border-top: 1px solid var(--border);
        background:
            color-mix(in srgb,
                var(--surface) 96%,
                var(--gold) 4%);
    }

    .sidebar-logout {
        width: 100%;
        min-height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 9px;
        color: var(--danger);
        background:
            color-mix(in srgb,
                var(--danger) 5%,
                var(--surface));
        border:
            1px solid color-mix(in srgb,
                var(--danger) 20%,
                var(--border));
        border-radius: 12px;
        font-family: inherit;
        font-size: 14.5px;
        font-weight: 800;
        cursor: pointer;
        transition:
            background .18s ease,
            border-color .18s ease,
            transform .18s ease,
            box-shadow .18s ease;
    }

    .sidebar-logout:hover {
        background:
            color-mix(in srgb,
                var(--danger) 10%,
                var(--surface));
        border-color:
            color-mix(in srgb,
                var(--danger) 35%,
                var(--border));
        transform: translateY(-1px);
    }

    .mobile-sidebar-toggle {
        display: none;
        position: fixed;
        top: 13px;
        right: 13px;
        z-index: 1400;
        width: 44px;
        height: 44px;
        align-items: center;
        justify-content: center;
        color: var(--gold);
        background: var(--surface);
        border:
            1px solid color-mix(in srgb,
                var(--gold) 28%,
                var(--border));
        border-radius: 11px;
        box-shadow: var(--shadow-sm);
        cursor: pointer;
        font-size: 17px;
        transition:
            background .2s ease,
            color .2s ease,
            border-color .2s ease,
            transform .2s ease;
    }

    .mobile-sidebar-toggle:hover {
        color: #171717;
        background:
            linear-gradient(135deg,
                var(--gold-light),
                var(--gold-dark));
        border-color: var(--gold);
        transform: translateY(-1px);
    }

    .sidebar-overlay {
        display: none;
        position: fixed;
        inset: 0;
        z-index: 1100;
        background: rgba(5, 7, 10, .58);
        backdrop-filter: blur(3px);
        opacity: 0;
        transition: opacity .28s ease;
    }

    .sidebar-overlay.is-visible {
        opacity: 1;
    }

    html[data-theme="dark"] .sidebar,
    body[data-theme="dark"] .sidebar,
    body.dark .sidebar {
        background: var(--surface);
        border-color: var(--border);
        box-shadow: var(--shadow-md);
    }

    html[data-theme="dark"] .sidebar-footer,
    body[data-theme="dark"] .sidebar-footer,
    body.dark .sidebar-footer {
        background:
            color-mix(in srgb,
                var(--surface) 96%,
                var(--gold) 4%);
    }

    @media (max-width: 1000px) {

        .sidebar {
            width: var(--sidebar-width);
        }

        .sidebar-link {
            font-size: 13.5px;
        }

        .sidebar-section-title {
            font-size: 12px;
        }
    }

    @media (max-width: 768px) {

        .sidebar {
            width: var(--elite-mobile-sidebar-width);
            height: 100dvh;
            top: 0;
            right: 0;
            transform: translateX(105%);
            border-left: 1px solid var(--border);
            box-shadow:
                -12px 0 40px rgba(0, 0, 0, .18);
        }

        .sidebar.is-open {
            transform: translateX(0);
        }

        .sidebar-brand {
            min-height: 82px;
            padding: 14px 15px;
            gap: 11px;
        }

        .sidebar-brand-icon {
            width: 43px;
            height: 43px;
            flex-basis: 43px;
            border-radius: 12px;
            font-size: 15px;
        }

        .sidebar-brand-title {
            font-size: 17px;
        }

        .sidebar-brand-subtitle {
            font-size: 10.5px;
        }

        .sidebar-quickinfo {
            margin: 12px 12px 5px;
            padding: 12px 13px;
            border-radius: 11px;
        }

        .sidebar-quickinfo-title {
            font-size: 14px;
        }

        .sidebar-quickinfo-date {
            font-size: 11.5px;
        }

        .sidebar-body {
            padding: 9px 11px 15px;
        }

        .sidebar-link {
            min-height: 48px;
            padding: 8px 11px;
            margin-bottom: 5px;
            gap: 10px;
            border-radius: 11px;
            font-size: 13.5px;
        }

        .sidebar-link-icon {
            width: 32px;
            height: 32px;
            flex-basis: 32px;
            font-size: 14px;
        }

        .sidebar-section-title {
            padding: 8px 11px;
            margin: 8px 0 6px;
            font-size: 11.5px;
        }

        .sidebar-footer {
            padding: 11px;
        }

        .sidebar-logout {
            min-height: 47px;
            font-size: 13.5px;
        }

        .mobile-sidebar-toggle {
            display: flex;
        }

        .sidebar-overlay {
            display: block;
            pointer-events: none;
        }

        .sidebar-overlay.is-visible {
            pointer-events: auto;
        }
    }

    @media (max-width: 480px) {

        :root {
            --elite-mobile-sidebar-width: min(300px, 88vw);
        }

        .mobile-sidebar-toggle {
            top: 11px;
            right: 11px;
            width: 42px;
            height: 42px;
            border-radius: 10px;
            font-size: 16px;
        }

        .sidebar-brand {
            min-height: 78px;
        }

        .sidebar-brand-title {
            font-size: 16px;
        }

        .sidebar-brand-subtitle {
            font-size: 10px;
        }

        .sidebar-link {
            font-size: 13px;
        }

        .sidebar-section-title {
            font-size: 11px;
        }

        .sidebar-logout {
            min-height: 46px;
            font-size: 13px;
        }
    }

    @media (max-width: 360px) {

        :root {
            --elite-mobile-sidebar-width: 90vw;
        }

        .sidebar-brand {
            padding: 13px 12px;
        }

        .sidebar-quickinfo {
            margin-left: 10px;
            margin-right: 10px;
        }

        .sidebar-body {
            padding-left: 9px;
            padding-right: 9px;
        }

        .sidebar-link {
            min-height: 46px;
            font-size: 12.5px;
        }
    }

    @media (hover: none) {

        .sidebar-link:hover {
            transform: none;
        }

        .sidebar-link:hover .sidebar-link-icon {
            transform: none;
        }

        .sidebar-logout:hover {
            transform: none;
        }

        .mobile-sidebar-toggle:hover {
            transform: none;
        }
    }

    @media (prefers-reduced-motion: reduce) {

        .sidebar,
        .sidebar-overlay,
        .sidebar-link,
        .mobile-sidebar-toggle {
            transition: none !important;
            animation: none !important;
        }
    }
</style>

<button type="button" class="mobile-sidebar-toggle" id="mobileSidebarToggle" aria-label="فتح القائمة"
    aria-controls="employeeSidebar" aria-expanded="false">

    <i class="fas fa-bars"></i>

</button>

<div class="sidebar-overlay" id="sidebarOverlay">
</div>

<aside class="sidebar" id="employeeSidebar">

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

    <div class="sidebar-quickinfo">

        <div class="sidebar-quickinfo-title">
            لوحة التحكم
        </div>

        <div class="sidebar-quickinfo-date">

            <i class="fas fa-calendar-days"></i>

            {{ \Carbon\Carbon::now()->locale('ar')->translatedFormat('l، d F Y') }}

        </div>

    </div>

    <div class="sidebar-body">

        <x-side-employee />

    </div>

    

    <div class="sidebar-footer">

        <form action="{{ route('employee.logout') }}" method="POST">

            @csrf

            <button type="submit" class="sidebar-logout">

                <i class="fas fa-right-from-bracket"></i>

                <span>
                    تسجيل الخروج
                </span>

            </button>

        </form>

    </div>

</aside>

<script>
    (function() {

        const sidebar =
            document.getElementById('employeeSidebar');

        const toggle =
            document.getElementById('mobileSidebarToggle');

        const overlay =
            document.getElementById('sidebarOverlay');

        if (!sidebar || !toggle || !overlay) {
            return;
        }

        function openSidebar() {

            sidebar.classList.add('is-open');

            overlay.classList.add('is-visible');

            toggle.setAttribute(
                'aria-expanded',
                'true'
            );

            toggle.setAttribute(
                'aria-label',
                'إغلاق القائمة'
            );

            toggle.innerHTML =
                '<i class="fas fa-xmark"></i>';

            document.body.style.overflow = 'hidden';
        }

        function closeSidebar() {

            sidebar.classList.remove('is-open');

            overlay.classList.remove('is-visible');

            toggle.setAttribute(
                'aria-expanded',
                'false'
            );

            toggle.setAttribute(
                'aria-label',
                'فتح القائمة'
            );

            toggle.innerHTML =
                '<i class="fas fa-bars"></i>';

            document.body.style.overflow = '';
        }

        toggle.addEventListener(
            'click',
            function() {

                if (
                    sidebar.classList.contains('is-open')
                ) {
                    closeSidebar();
                } else {
                    openSidebar();
                }

            }
        );

        overlay.addEventListener(
            'click',
            closeSidebar
        );

        document.addEventListener(
            'keydown',
            function(event) {

                if (
                    event.key === 'Escape' &&
                    sidebar.classList.contains('is-open')
                ) {
                    closeSidebar();
                }

            }
        );

        sidebar
            .querySelectorAll('a.sidebar-link')
            .forEach(function(link) {

                link.addEventListener(
                    'click',
                    function() {

                        if (
                            window.innerWidth <= 768
                        ) {
                            closeSidebar();
                        }

                    }
                );

            });

        window.addEventListener(
            'resize',
            function() {

                if (
                    window.innerWidth > 768
                ) {
                    sidebar.classList.remove('is-open');

                    overlay.classList.remove(
                        'is-visible'
                    );

                    toggle.setAttribute(
                        'aria-expanded',
                        'false'
                    );

                    toggle.setAttribute(
                        'aria-label',
                        'فتح القائمة'
                    );

                    toggle.innerHTML =
                        '<i class="fas fa-bars"></i>';

                    document.body.style.overflow = '';
                }

            }
        );

    })();
</script>