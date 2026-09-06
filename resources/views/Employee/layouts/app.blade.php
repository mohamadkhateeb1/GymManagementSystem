<!DOCTYPE html>

<html lang="ar" dir="rtl">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'Elite Club - Admin')
    </title>


    {{-- Google Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">


    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">


    {{-- Bootstrap RTL --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">


    {{-- تحميل الوضع قبل ظهور الصفحة --}}
    <script>
        (function() {

            const savedTheme =
                localStorage.getItem('elite-theme');

            const theme =
                savedTheme === 'dark' ?
                'dark' :
                'light';

            document.documentElement.setAttribute(
                'data-theme',
                theme
            );

        })();
    </script>


    <style>
        /* =====================================================
           GLOBAL
        ===================================================== */

        * {
            box-sizing: border-box;
        }

        html {
            margin: 0;
            padding: 0;
            min-height: 100%;
        }

        body {
            margin: 0;
            padding: 0;

            min-height: 100vh;

            font-family: 'Tajawal', sans-serif;
            font-size: 16px;

            background: var(--app-bg);
            color: var(--text);

            overflow-x: hidden;

            transition:
                background .25s ease,
                color .25s ease;
        }

        button,
        input,
        select,
        textarea {
            font-family: 'Tajawal', sans-serif;
        }

        button {
            outline: none;
        }

        a {
            text-decoration: none;
        }


        /* =====================================================
           LIGHT THEME
        ===================================================== */

        :root {

            --gold: #b89445;
            --gold-light: #d7bd7b;
            --gold-dark: #8f6d2d;

            --app-bg: #f4f5f7;

            --surface: #ffffff;
            --surface-2: #fafbfc;
            --surface-3: #f1f3f5;
            --surface-hover: #fbf7ee;

            --text: #272b31;
            --text-soft: #565d67;

            --muted: #6b7280;
            --muted-light: #939aa3;

            --border: #e3e6ea;
            --border-soft: #edf0f2;

            --sidebar-bg: #ffffff;
            --sidebar-text: #4b525c;
            --sidebar-hover: #fbf8f0;
            --sidebar-active: #f8f1df;

            --input-bg: #ffffff;
            --input-border: #dfe3e7;

            --success: #3f916a;
            --success-bg: #edf8f2;

            --danger: #c45d5d;
            --danger-bg: #fff2f2;

            --warning: #a97925;
            --warning-bg: #fff8e9;

            --info: #66809f;
            --info-bg: #f0f5fa;

            --shadow-sm:
                0 2px 10px rgba(30, 35, 42, .035);

            --shadow-md:
                0 7px 24px rgba(30, 35, 42, .055);

            --shadow-lg:
                0 14px 35px rgba(30, 35, 42, .075);

            --sidebar-width: 270px;

            --topbar-height: 76px;
        }


        /* =====================================================
           DARK THEME
        ===================================================== */

        html[data-theme="dark"] {

            --app-bg: #181b20;

            --surface: #20242a;
            --surface-2: #252a30;
            --surface-3: #2b3037;
            --surface-hover: #302b21;

            --text: #f0f1f3;
            --text-soft: #c4c8ce;

            --muted: #a3aab3;
            --muted-light: #838a93;

            --border: #343941;
            --border-soft: #2b3036;

            --sidebar-bg: #1d2126;
            --sidebar-text: #cfd4da;

            --sidebar-hover: #292823;
            --sidebar-active: #302b20;

            --input-bg: #252a30;
            --input-border: #3a4048;

            --success: #6bc99a;
            --success-bg: rgba(65, 175, 120, .12);

            --danger: #df7b7b;
            --danger-bg: rgba(210, 80, 80, .12);

            --warning: #dfae52;
            --warning-bg: rgba(220, 165, 65, .12);

            --info: #91a9c8;
            --info-bg: rgba(90, 120, 160, .12);

            --shadow-sm:
                0 3px 12px rgba(0, 0, 0, .15);

            --shadow-md:
                0 8px 25px rgba(0, 0, 0, .20);

            --shadow-lg:
                0 16px 38px rgba(0, 0, 0, .27);
        }


        /* =====================================================
           MAIN WRAPPER
        ===================================================== */

        .main-wrapper {

            width: calc(100% - var(--sidebar-width));

            min-height: 100vh;

            margin-right: var(--sidebar-width);

            display: flex;
            flex-direction: column;

            background: var(--app-bg);

            transition:
                background .25s ease,
                margin .25s ease,
                width .25s ease;
        }


        /* =====================================================
           TOP NAVBAR
        ===================================================== */

        .top-navbar {

            min-height: var(--topbar-height);

            width: 100%;

            display: flex;
            align-items: center;
            justify-content: space-between;

            gap: 20px;

            padding: 10px 28px;

            background: var(--surface);

            border-bottom: 1px solid var(--border);

            box-shadow: var(--shadow-sm);

            position: sticky;
            top: 0;

            z-index: 900;

            transition:
                background .25s ease,
                border-color .25s ease,
                box-shadow .25s ease;
        }


        /* =====================================================
           PAGE TITLE
        ===================================================== */

        .nav-page-title {

            min-width: 0;

            display: flex;
            flex-direction: column;

            align-items: flex-start;
            justify-content: center;

            text-align: right;

            line-height: 1;

            margin: 0;
        }


        .nav-page-title h1 {

            margin: 0;

            color: var(--text);

            font-size: 26px;
            font-weight: 900;

            line-height: 1.2;

            letter-spacing: -.3px;
        }


        .nav-page-title p {

            margin: 6px 0 0;

            color: var(--text-soft);

            font-size: 13px;
            font-weight: 600;

            line-height: 1.5;
        }


        .nav-title-line {

            display: block;

            width: 42px;
            height: 3px;

            margin-top: 7px;

            border-radius: 99px;

            background:
                linear-gradient(90deg,
                    var(--gold-dark),
                    var(--gold-light));
        }


        .nav-right {

            display: flex;
            align-items: center;

            flex-shrink: 0;
        }


        /* =====================================================
           CONTENT
        ===================================================== */

        .content-area {

            flex: 1;

            min-width: 0;

            padding: 25px 30px 35px;

            background: var(--app-bg);

            transition:
                background .25s ease;
        }


        /* =====================================================
           SIDEBAR DESKTOP
        ===================================================== */

        #eliteSidebar {

            position: fixed;

            top: 0;
            right: 0;

            width: var(--sidebar-width);
            height: 100vh;

            z-index: 1200;

            background: var(--sidebar-bg);

            transition:
                transform .3s ease,
                box-shadow .3s ease;
        }


        /* =====================================================
           RESPONSIVE TABLET
        ===================================================== */

        @media (max-width: 1100px) {

            :root {
                --sidebar-width: 240px;
            }

            .content-area {
                padding: 22px 20px 30px;
            }

        }


        /* =====================================================
           MOBILE
        ===================================================== */

        @media (max-width: 768px) {

            :root {
                --sidebar-width: 270px;
            }


            /* المحتوى يأخذ الشاشة كاملة */

            .main-wrapper {

                width: 100%;

                margin-right: 0;
            }


            .content-area {

                padding: 18px 14px 28px;
            }


            /* ================================
               SIDEBAR MOBILE
            ================================= */

            #eliteSidebar {

                width: min(var(--sidebar-width),
                        85vw);

                right: 0;
                left: auto;

                transform: translateX(100%);

                box-shadow:
                    -12px 0 35px rgba(0, 0, 0, .12);

                z-index: 1300;
            }


            /* القائمة مفتوحة */

            body.sidebar-open #eliteSidebar {

                transform: translateX(0);
            }


            /* ================================
               BACKDROP
            ================================= */

            body.sidebar-open::before {

                content: "";

                position: fixed;

                inset: 0;

                background:
                    rgba(0, 0, 0, .38);

                z-index: 1250;

                cursor: pointer;

                animation:
                    eliteOverlayIn .25s ease;
            }


            /* ================================
               NAVBAR
            ================================= */

            .top-navbar {

                min-height: 68px;

                padding: 8px 15px;

                gap: 10px;
            }


            .nav-page-title h1 {
                font-size: 20px;
            }


            .nav-page-title p {
                display: none;
            }


            .nav-title-line {

                width: 32px;
                height: 2px;

                margin-top: 5px;
            }

        }


        /* =====================================================
           SMALL MOBILE
        ===================================================== */

        @media (max-width: 480px) {

            .content-area {
                padding: 14px 10px 24px;
            }

            .top-navbar {
                padding-left: 12px;
                padding-right: 12px;
            }

            .nav-page-title h1 {
                font-size: 18px;
            }

        }


        /* =====================================================
           ANIMATION
        ===================================================== */

        @keyframes eliteOverlayIn {

            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }

        }
    </style>


    @yield('styles')

</head>


<body>

    {{-- Sidebar --}}
    @include('Employee.layouts.sections.sidebar')


    {{-- Main --}}
    <div class="main-wrapper">


        {{-- Navbar --}}
        <header class="top-navbar">

            <div class="nav-page-title">

                <h1>
                    @yield('page-title', 'لوحة التحكم')
                </h1>

                <p>
                    @yield('page-description', 'نظرة سريعة على أداء النادي والاشتراكات والموظفين')
                </p>

                <span class="nav-title-line"></span>

            </div>


            <div class="nav-right">

                @include('Employee.layouts.sections.navbar')

            </div>

        </header>


        {{-- Page Content --}}
        <main class="content-area">

            <x-flash-message />

            @yield('content')

        </main>

    </div>


    {{-- Bootstrap --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


    <script>
        document.addEventListener(
            'DOMContentLoaded',
            function() {

                const html =
                    document.documentElement;

                const body =
                    document.body;


                /* =================================================
                   THEME
                ================================================= */

                const themeButton =
                    document.getElementById(
                        'themeToggle'
                    );

                const themeIcon =
                    document.getElementById(
                        'themeIcon'
                    );


                function updateThemeIcon() {

                    if (!themeIcon) {
                        return;
                    }

                    const theme =
                        html.getAttribute(
                            'data-theme'
                        );


                    if (theme === 'dark') {

                        themeIcon.className =
                            'fas fa-sun';

                        themeButton?.setAttribute(
                            'title',
                            'الوضع النهاري'
                        );

                    } else {

                        themeIcon.className =
                            'fas fa-moon';

                        themeButton?.setAttribute(
                            'title',
                            'الوضع الليلي'
                        );

                    }

                }


                updateThemeIcon();


                if (themeButton) {

                    themeButton.addEventListener(
                        'click',
                        function() {

                            const current =
                                html.getAttribute(
                                    'data-theme'
                                ) || 'light';


                            const next =
                                current === 'dark' ?
                                'light' :
                                'dark';


                            html.setAttribute(
                                'data-theme',
                                next
                            );


                            localStorage.setItem(
                                'elite-theme',
                                next
                            );


                            updateThemeIcon();

                        }
                    );

                }


                /* =================================================
                   MOBILE SIDEBAR
                ================================================= */

                const sidebar =
                    document.getElementById(
                        'eliteSidebar'
                    );

                const sidebarToggle =
                    document.getElementById(
                        'eliteSidebarToggle'
                    );


                if (
                    sidebar &&
                    sidebarToggle
                ) {


                    function openSidebar() {

                        body.classList.add(
                            'sidebar-open'
                        );

                        sidebarToggle.setAttribute(
                            'aria-expanded',
                            'true'
                        );

                        sidebarToggle.setAttribute(
                            'aria-label',
                            'إغلاق القائمة'
                        );

                        sidebarToggle.setAttribute(
                            'title',
                            'إغلاق القائمة'
                        );

                    }


                    function closeSidebar() {

                        body.classList.remove(
                            'sidebar-open'
                        );

                        sidebarToggle.setAttribute(
                            'aria-expanded',
                            'false'
                        );

                        sidebarToggle.setAttribute(
                            'aria-label',
                            'فتح القائمة'
                        );

                        sidebarToggle.setAttribute(
                            'title',
                            'القائمة'
                        );

                    }


                    function toggleSidebar() {

                        if (
                            body.classList.contains(
                                'sidebar-open'
                            )
                        ) {

                            closeSidebar();

                        } else {

                            openSidebar();

                        }

                    }


                    sidebarToggle.addEventListener(
                        'click',
                        function(event) {

                            event.stopPropagation();

                            toggleSidebar();

                        }
                    );


                    /* إغلاق عند الضغط على الخلفية */

                    document.addEventListener(
                        'click',
                        function(event) {

                            if (
                                !body.classList.contains(
                                    'sidebar-open'
                                )
                            ) {
                                return;
                            }


                            if (
                                sidebar.contains(event.target) ||
                                sidebarToggle.contains(event.target)
                            ) {
                                return;
                            }


                            closeSidebar();

                        }
                    );


                    /* إغلاق عند اختيار رابط */

                    sidebar.addEventListener(
                        'click',
                        function(event) {

                            const link =
                                event.target.closest(
                                    'a'
                                );


                            if (!link) {
                                return;
                            }


                            if (
                                window.innerWidth <= 768
                            ) {

                                closeSidebar();

                            }

                        }
                    );


                    /* منع بقاء القائمة مفتوحة عند تكبير الشاشة */

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

                }

            }
        );
    </script>


    @yield('scripts')

</body>

</html>