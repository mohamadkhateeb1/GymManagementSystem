<aside class="sidebar">


    {{-- =====================================================
         BRAND
    ====================================================== --}}

    <div class="brand">

        <div class="brand-logo">

            <div class="brand-mark">

                <i class="fas fa-crown"></i>

            </div>


            <div class="brand-text">

                <h2>
                    ELITE CLUB
                </h2>

                <span>
                    Admin Dashboard
                </span>

            </div>

        </div>

    </div>


    {{-- =====================================================
         MENU
    ====================================================== --}}

    <div class="sidebar-menu">

        <x-side/>

    </div>


    {{-- =====================================================
         FOOTER
    ====================================================== --}}

    <div class="sidebar-footer">

        <form
            method="POST"
            action="{{ route('logout') }}">

            @csrf

            <button
                type="submit"
                class="sidebar-logout">

                <i class="fas fa-right-from-bracket"></i>

                <span>
                    تسجيل الخروج
                </span>

            </button>

        </form>

    </div>

</aside>


<style>

    /* =====================================================
       SIDEBAR
    ====================================================== */

    .sidebar {

        width: var(--sidebar-width);

        height: 100vh;

        position: fixed;

        top: 0;

        right: 0;

        z-index: 1000;

        display: flex;

        flex-direction: column;

        padding: 18px 13px 13px;

        background: var(--sidebar-bg);

        border-left: 1px solid var(--border);

        box-shadow:
            -7px 0 25px
            rgba(30, 35, 42, .045);

        overflow: hidden;

        transition:
            background .25s ease,
            border-color .25s ease,
            box-shadow .25s ease,
            transform .25s ease;
    }


    /* =====================================================
       BRAND
    ====================================================== */

    .brand {

        flex: 0 0 auto;

        padding: 0 7px;

        margin-bottom: 22px;
    }


    .brand-logo {

        display: flex;

        align-items: center;

        gap: 11px;
    }


    .brand-mark {

        width: 45px;

        height: 45px;

        flex: 0 0 45px;

        display: flex;

        align-items: center;

        justify-content: center;

        border-radius: 13px;

        color: #fff;

        font-size: 16px;

        background:
            linear-gradient(
                135deg,
                #dec582 0%,
                #bd9948 55%,
                #96722c 100%
            );

        box-shadow:
            0 6px 18px
            rgba(184, 146, 62, .15);
    }


    .brand-text {

        min-width: 0;
    }


    .brand-text h2 {

        margin: 0;

        color: var(--text);

        font-size: 17px;

        font-weight: 900;

        letter-spacing: .6px;

        line-height: 1.1;

        white-space: nowrap;
    }


    .brand-text span {

        display: block;

        margin-top: 5px;

        color: var(--muted);

        font-size: 8px;

        letter-spacing: .5px;

        white-space: nowrap;
    }


    /* =====================================================
       MENU SCROLL
    ====================================================== */

    .sidebar-menu {

        flex: 1 1 auto;

        min-height: 0;

        overflow-y: auto;

        overflow-x: hidden;

        padding: 2px 3px 15px;

        scrollbar-width: thin;

        scrollbar-color:
            var(--border)
            transparent;
    }


    .sidebar-menu::-webkit-scrollbar {

        width: 4px;
    }


    .sidebar-menu::-webkit-scrollbar-track {

        background: transparent;
    }


    .sidebar-menu::-webkit-scrollbar-thumb {

        background: var(--border);

        border-radius: 99px;
    }


    .sidebar-menu::-webkit-scrollbar-thumb:hover {

        background: var(--gold);
    }


    /* =====================================================
       LIST
    ====================================================== */

    .sidebar-menu ul {

        list-style: none;

        margin: 0;

        padding: 0;
    }


    .sidebar-menu li {

        margin-bottom: 4px;
    }


    /* =====================================================
       LINKS
    ====================================================== */

    .sidebar-menu a,
    .sidebar-menu button {

        width: 100%;

        min-height: 43px;

        display: flex;

        align-items: center;

        gap: 11px;

        padding: 8px 11px;

        border: 1px solid transparent;

        border-radius: 10px;

        background: transparent;

        color: var(--sidebar-text);

        font-family: 'Tajawal', sans-serif;

        font-size: 12px;

        font-weight: 600;

        text-decoration: none;

        cursor: pointer;

        transition:
            background .18s ease,
            color .18s ease,
            border-color .18s ease,
            transform .18s ease;
    }


    /* =====================================================
       ICONS
    ====================================================== */

    .sidebar-menu i {

        width: 20px;

        min-width: 20px;

        text-align: center;

        color: var(--muted);

        font-size: 13px;

        transition:
            color .18s ease,
            transform .18s ease;
    }


    /* =====================================================
       HOVER
    ====================================================== */

    .sidebar-menu a:hover,
    .sidebar-menu button:hover {

        color: var(--gold-dark);

        background: var(--sidebar-hover);

        border-color:
            rgba(184, 146, 62, .16);

        transform: translateX(-2px);
    }


    .sidebar-menu a:hover i,
    .sidebar-menu button:hover i {

        color: var(--gold);

        transform: translateX(-2px);
    }


    /* =====================================================
       ACTIVE
    ====================================================== */

    .sidebar-menu a.active,
    .sidebar-menu .active > a {

        position: relative;

        color: var(--gold-dark);

        background: var(--sidebar-active);

        border-color:
            rgba(184, 146, 62, .18);

        box-shadow:
            0 3px 10px
            rgba(184, 146, 62, .035);
    }


    html[data-theme="dark"]
    .sidebar-menu a.active,
    html[data-theme="dark"]
    .sidebar-menu .active > a {

        color: var(--gold-light);
    }


    .sidebar-menu a.active i,
    .sidebar-menu .active > a i {

        color: var(--gold);
    }


    .sidebar-menu a.active::after,
    .sidebar-menu .active > a::after {

        content: "";

        position: absolute;

        right: -3px;

        top: 8px;

        bottom: 8px;

        width: 3px;

        border-radius: 99px;

        background:
            linear-gradient(
                180deg,
                var(--gold-light),
                var(--gold-dark)
            );
    }


    /* =====================================================
       SUB MENU
    ====================================================== */

    .sidebar-menu ul ul {

        margin-top: 4px;

        margin-right: 14px;

        padding-right: 9px;

        border-right:
            1px solid var(--border-soft);
    }


    .sidebar-menu ul ul li {

        margin-bottom: 2px;
    }


    .sidebar-menu ul ul a {

        min-height: 36px;

        padding: 7px 9px;

        color: var(--muted);

        font-size: 11px;
    }


    .sidebar-menu ul ul a:hover {

        background: var(--sidebar-hover);

        color: var(--gold-dark);
    }


    /* =====================================================
       FOOTER
    ====================================================== */

    .sidebar-footer {

        flex: 0 0 auto;

        padding: 12px 3px 0;

        margin-top: 6px;

        border-top:
            1px solid var(--border-soft);

        background: var(--sidebar-bg);
    }


    .sidebar-footer form {

        margin: 0;
    }


    /* =====================================================
       LOGOUT
    ====================================================== */

    .sidebar-logout {

        width: 100%;

        min-height: 42px;

        display: flex;

        align-items: center;

        justify-content: center;

        gap: 8px;

        border:
            1px solid
            rgba(196, 93, 93, .18);

        border-radius: 10px;

        background: var(--danger-bg);

        color: var(--danger);

        font-family: 'Tajawal', sans-serif;

        font-size: 11.5px;

        font-weight: 700;

        cursor: pointer;

        transition: all .2s ease;
    }


    .sidebar-logout:hover {

        color: #fff;

        background: var(--danger);

        border-color: var(--danger);

        transform: translateY(-1px);

        box-shadow:
            0 5px 15px
            rgba(190, 80, 80, .10);
    }


    /* =====================================================
       MOBILE
    ====================================================== */

    @media (max-width: 768px) {

        .sidebar {

            width: 270px;

            transform:
                translateX(100%);
        }


        .sidebar.open {

            transform:
                translateX(0);
        }
    }

</style>