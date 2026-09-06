{{-- =========================================================
     ADMIN SIDEBAR
========================================================= --}}

<aside class="sidebar" id="adminSidebar">

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
                Admin Dashboard
            </span>

        </div>

    </div>


    {{-- =====================================================
         MENU
    ====================================================== --}}

    <div class="sidebar-body">

        <x-side />

    </div>


    {{-- =====================================================
         FOOTER
    ====================================================== --}}

    <div class="sidebar-footer">

        <form method="POST" action="{{ route('admin.logout') }}">

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


{{-- =========================================================
     MOBILE MENU BUTTON
     نفس طريقة واجهة الموظف
========================================================= --}}

<button type="button" class="mobile-sidebar-toggle" id="adminSidebarToggle" aria-label="فتح القائمة"
    aria-controls="adminSidebar" aria-expanded="false">

    <i class="fas fa-bars"></i>

</button>


{{-- =========================================================
     MOBILE OVERLAY
========================================================= --}}

<div class="sidebar-overlay" id="adminSidebarOverlay"></div>


<style>
    /* =========================================================
   SIDEBAR
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

        padding: 18px 13px 13px;

        background: var(--sidebar-bg);

        border-left:
            1px solid var(--border);

        box-shadow:
            -7px 0 25px rgba(30, 35, 42, .045);

        overflow: hidden;

        transition:
            width .25s ease,
            background .25s ease,
            border-color .25s ease,
            box-shadow .25s ease,
            transform .32s cubic-bezier(.22, .61, .36, 1);
    }


    /* =========================================================
   BRAND
========================================================= */

    .sidebar-brand {

        min-height: 82px;

        display: flex;
        align-items: center;

        gap: 11px;

        padding:
            0 7px;

        flex-shrink: 0;

        margin-bottom: 18px;
    }


    .sidebar-brand-icon {

        width: 46px;
        height: 46px;

        flex: 0 0 46px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 13px;

        color: #fff;

        background:
            linear-gradient(135deg,
                var(--gold-light),
                var(--gold-dark));

        box-shadow:
            0 7px 18px rgba(184, 146, 62, .17);

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

        letter-spacing: .5px;

        line-height: 1;

        white-space: nowrap;
    }


    .sidebar-brand-subtitle {

        color: var(--sidebar-text);

        font-size: 11.5px;
        font-weight: 600;

        white-space: nowrap;
    }


    /* =========================================================
   SIDEBAR BODY
========================================================= */

    .sidebar-body {

        flex: 1;

        min-height: 0;

        overflow-y: auto;

        padding:
            2px 3px 15px;

        scrollbar-width: thin;

        scrollbar-color:
            var(--border) transparent;
    }


    .sidebar-body::-webkit-scrollbar {
        width: 4px;
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


    /* =========================================================
   MENU
========================================================= */

    .sidebar-body ul {

        list-style: none;

        margin: 0;

        padding: 0;
    }


    .sidebar-body li {
        margin-bottom: 4px;
    }


    .sidebar-body a,
    .sidebar-body button {

        width: 100%;

        min-height: 45px;

        display: flex;
        align-items: center;

        gap: 11px;

        padding:
            8px 11px;

        border:
            1px solid transparent;

        border-radius: 10px;

        background: transparent;

        color: var(--text);

        font-family:
            'Tajawal',
            sans-serif;

        font-size: 15px;

        font-weight: 700;

        text-decoration: none;

        cursor: pointer;

        transition:
            background .18s ease,
            color .18s ease,
            border-color .18s ease,
            transform .18s ease;
    }


    .sidebar-body i {

        width: 20px;

        min-width: 20px;

        text-align: center;

        color: var(--text-soft);

        font-size: 16px;

        transition:
            color .18s ease,
            transform .18s ease;
    }


    .sidebar-body a:hover,
    .sidebar-body button:hover {

        color: var(--gold-dark);

        background:
            var(--sidebar-hover);

        border-color:
            rgba(184, 146, 62, .16);

        transform:
            translateX(-2px);
    }


    .sidebar-body a:hover i,
    .sidebar-body button:hover i {

        color: var(--gold);

        transform:
            translateX(-2px);
    }


    /* =========================================================
   ACTIVE
========================================================= */

    .sidebar-body a.active,
    .sidebar-body .active>a {

        position: relative;

        color: var(--gold-dark);

        background:
            var(--sidebar-active);

        border-color:
            rgba(184, 146, 62, .18);

        box-shadow:
            0 3px 10px rgba(184, 146, 62, .035);
    }


    html[data-theme="dark"] .sidebar-body a.active,
    html[data-theme="dark"] .sidebar-body .active>a {

        color: var(--gold-light);
    }


    .sidebar-body a.active i,
    .sidebar-body .active>a i {

        color: var(--gold);
    }


    .sidebar-body a.active::after,
    .sidebar-body .active>a::after {

        content: "";

        position: absolute;

        right: -3px;

        top: 8px;
        bottom: 8px;

        width: 3px;

        border-radius: 99px;

        background:
            linear-gradient(180deg,
                var(--gold-light),
                var(--gold-dark));
    }


    /* =========================================================
   SUB MENU
========================================================= */

    .sidebar-body ul ul {

        margin-top: 4px;

        margin-right: 14px;

        padding-right: 9px;

        border-right:
            1px solid var(--border-soft);
    }


    .sidebar-body ul ul li {
        margin-bottom: 2px;
    }


    .sidebar-body ul ul a {

        min-height: 38px;

        padding:
            7px 9px;

        color: var(--text-soft);

        font-size: 14px;

        font-weight: 600;
    }


    /* =========================================================
   FOOTER
========================================================= */

    .sidebar-footer {

        flex-shrink: 0;

        padding:
            12px 3px 0;

        margin-top: 6px;

        border-top:
            1px solid var(--border-soft);

        background:
            var(--sidebar-bg);
    }


    .sidebar-footer form {
        margin: 0;
    }


    /* =========================================================
   LOGOUT
========================================================= */

    .sidebar-logout {

        width: 100%;

        min-height: 44px;

        display: flex;
        align-items: center;
        justify-content: center;

        gap: 8px;

        border:
            1px solid rgba(196, 93, 93, .18);

        border-radius: 10px;

        background:
            var(--danger-bg);

        color:
            var(--danger);

        font-family:
            'Tajawal',
            sans-serif;

        font-size: 14.5px;

        font-weight: 800;

        cursor: pointer;

        transition:
            background .2s ease,
            color .2s ease,
            border-color .2s ease,
            transform .2s ease,
            box-shadow .2s ease;
    }


    .sidebar-logout:hover {

        color: #fff;

        background:
            var(--danger);

        border-color:
            var(--danger);

        transform:
            translateY(-1px);

        box-shadow:
            0 5px 15px rgba(190, 80, 80, .10);
    }


    /* =========================================================
   MOBILE BUTTON
   نفس الموظف
========================================================= */

    .mobile-sidebar-toggle {

        display: none;

        position: fixed;

        top: 15px;
        right: 15px;

        z-index: 300;

        width: 44px;
        height: 44px;

        align-items: center;
        justify-content: center;

        border:
            1px solid rgba(184, 146, 62, .42);

        border-radius: 11px;

        background:
            var(--surface);

        color:
            var(--gold);

        box-shadow:
            var(--shadow-sm);

        cursor: pointer;

        font-size: 18px;

        transition:
            background .2s ease,
            border-color .2s ease,
            color .2s ease,
            transform .2s ease;
    }


    .mobile-sidebar-toggle:hover {

        color: #fff;

        background:
            linear-gradient(135deg,
                var(--gold-light),
                var(--gold-dark));

        border-color:
            var(--gold);

        transform:
            translateY(-1px);
    }


    .mobile-sidebar-toggle:active {
        transform: scale(.94);
    }


    /* =========================================================
   OVERLAY
========================================================= */

    .sidebar-overlay {

        display: none;

        position: fixed;

        inset: 0;

        z-index: 140;

        background:
            rgba(5, 7, 10, .52);

        backdrop-filter:
            blur(2px);

        opacity: 0;

        transition:
            opacity .28s ease;
    }


    .sidebar-overlay.is-visible {

        display: block;

        opacity: 1;
    }


    /* =========================================================
   MOBILE
========================================================= */

    @media (max-width: 768px) {

        .sidebar {

            width:
                min(280px, 85vw);

            max-width: 85vw;

            height: 100dvh;

            top: 0;
            right: 0;

            transform:
                translateX(105%);

            box-shadow:
                -12px 0 35px rgba(0, 0, 0, .20);
        }


        .sidebar.is-open {

            transform:
                translateX(0);
        }


        .mobile-sidebar-toggle {

            display: flex;
        }


        .sidebar-brand {

            min-height: 78px;

            margin-bottom: 15px;
        }


        .sidebar-brand-icon {

            width: 43px;
            height: 43px;

            flex-basis: 43px;

            border-radius: 12px;

            font-size: 16px;
        }


        .sidebar-brand-title {
            font-size: 18px;
        }


        .sidebar-brand-subtitle {
            font-size: 10.5px;
        }


        .sidebar-body {

            padding:
                2px 3px 12px;
        }


        .sidebar-body a,
        .sidebar-body button {

            min-height: 47px;

            font-size: 14px;
        }


        .sidebar-footer {

            padding-top: 10px;
        }


        .sidebar-logout {

            min-height: 45px;

            font-size: 14px;
        }

    }


    /* =========================================================
   SMALL MOBILE
========================================================= */

    @media (max-width: 480px) {

        .mobile-sidebar-toggle {

            top: 12px;
            right: 12px;

            width: 42px;
            height: 42px;

            border-radius: 10px;

            font-size: 17px;
        }


        .sidebar {

            width:
                min(270px, 88vw);

            max-width: 88vw;
        }


        .sidebar-brand {

            padding:
                0 5px;
        }


        .sidebar-brand-title {
            font-size: 17px;
        }


        .sidebar-body a,
        .sidebar-body button {

            font-size: 13.5px;
        }

    }


    /* =========================================================
   VERY SMALL MOBILE
========================================================= */

    @media (max-width: 360px) {

        .sidebar {

            width: 255px;

            max-width: 90vw;
        }

    }
</style>


<script>
    (function() {

        const sidebar =
            document.getElementById(
                'adminSidebar'
            );

        const toggle =
            document.getElementById(
                'adminSidebarToggle'
            );

        const overlay =
            document.getElementById(
                'adminSidebarOverlay'
            );


        if (
            !sidebar ||
            !toggle ||
            !overlay
        ) {
            return;
        }


        /* =====================================================
           OPEN
        ====================================================== */

        function openSidebar() {

            sidebar.classList.add(
                'is-open'
            );

            overlay.classList.add(
                'is-visible'
            );

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

            document.body.style.overflow =
                'hidden';
        }


        /* =====================================================
           CLOSE
        ====================================================== */

        function closeSidebar() {

            sidebar.classList.remove(
                'is-open'
            );

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

            document.body.style.overflow =
                '';
        }


        /* =====================================================
           TOGGLE
        ====================================================== */

        toggle.addEventListener(
            'click',
            function() {

                if (
                    sidebar.classList.contains(
                        'is-open'
                    )
                ) {

                    closeSidebar();

                } else {

                    openSidebar();

                }

            }
        );


        /* =====================================================
           OVERLAY
        ====================================================== */

        overlay.addEventListener(
            'click',
            closeSidebar
        );


        /* =====================================================
           ESC
        ====================================================== */

        document.addEventListener(
            'keydown',
            function(event) {

                if (
                    event.key === 'Escape' &&
                    sidebar.classList.contains(
                        'is-open'
                    )
                ) {

                    closeSidebar();

                }

            }
        );


        /* =====================================================
           CLOSE AFTER LINK
        ====================================================== */

        sidebar
            .querySelectorAll('a')
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


        /* =====================================================
           DESKTOP RESET
        ====================================================== */

        window.addEventListener(
            'resize',
            function() {

                if (
                    window.innerWidth > 768
                ) {

                    closeSidebar();

                }

            }
        );

    })();
</script>
