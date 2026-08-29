<!DOCTYPE html>
<html lang="ar"
      dir="rtl"
      data-theme="light">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token"
          content="{{ csrf_token() }}">

    <title>
        @yield('title', 'Elite Club')
    </title> 
    {{-- Font Awesome --}}
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>

        /* =====================================================
           ELITE CLUB — GLOBAL THEME
           ===================================================== */

        :root {
            --page-bg: #f4f5f7;

            --surface: #ffffff;
            --surface-2: #f8fafc;
            --surface-3: #f1f3f5;
            --surface-hover: #f8f7f3;

            --border: #e4e7eb;
            --border-soft: rgba(201, 169, 97, .16);

            --text: #20242b;
            --text-soft: #4b5563;
            --muted: #8a929d;

            --gold: #c9a961;
            --gold-light: #dfc57e;
            --gold-dark: #a7833e;

            --success: #36b37e;
            --danger: #e85d5d;

            --shadow-sm: 0 4px 18px rgba(15, 23, 42, .05);

            --shadow: 0 12px 35px rgba(15, 23, 42, .07);

            --navbar-height: 82px;
            --sidebar-width: 280px;
        }

        /* =====================================================
           DARK THEME
           ===================================================== */

        html[data-theme="dark"],
        body.dark,
        body[data-theme="dark"] {
            --page-bg: #15181d;

            --surface: #1d2127;
            --surface-2: #232830;
            --surface-3: #292f37;
            --surface-hover: #2c323a;

            --border: #343b45;
            --border-soft: rgba(208, 174, 97, .18);

            --text: #f3f4f6;
            --text-soft: #c8cdd5;
            --muted: #8e97a5;

            --gold: #d0ae61;
            --gold-light: #e2c777;
            --gold-dark: #b78f40;

            --success: #43c995;
            --danger: #e85d5d;

            --shadow-sm: 0 5px 18px rgba(0, 0, 0, .22);

            --shadow: 0 15px 40px rgba(0, 0, 0, .28);
        }

        /* =====================================================
           RESET
           ===================================================== */

        *,
        *::before,
        *::after {
            box-sizing: border-box;
            scrollbar-width: thin;
            scrollbar-color: var(--border) var(--surface);
        }

        html {
            margin: 0;
            padding: 0;
            background: var(--page-bg);
            transition: background .25s ease;
        }

        body {
            margin: 0;
            min-height: 100vh;
            background: var(--page-bg);
            color: var(--text);
            font-family: "Cairo", "Tajawal", Arial, sans-serif;
            transition: background .25s ease, color .25s ease;
        }

        a {
            color: inherit;
        }

        button,
        input,
        select,
        textarea {
            font-family: inherit;
        }

        /* =====================================================
           GLOBAL DARK OVERRIDES
           ===================================================== */

        html[data-theme="dark"] input,
        html[data-theme="dark"] select,
        html[data-theme="dark"] textarea,

        body.dark input,
        body.dark select,
        body.dark textarea,

        body[data-theme="dark"] input,
        body[data-theme="dark"] select,
        body[data-theme="dark"] textarea {
            background: var(--surface-2);
            color: var(--text);
            border-color: var(--border);
        }

        html[data-theme="dark"] input::placeholder,
        html[data-theme="dark"] textarea::placeholder,

        body.dark input::placeholder,
        body.dark textarea::placeholder,

        body[data-theme="dark"] input::placeholder,
        body[data-theme="dark"] textarea::placeholder {
            color: var(--muted);
        }

        /* =====================================================
           APP WRAPPER
           ===================================================== */

        .app-wrapper {
            min-height: 100vh;
            background: var(--page-bg);
            transition: background .25s ease;
        }

        /* =====================================================
           MAIN AREA
           Navbar صار خارج الـ main
           ===================================================== */

        /* الحاوية التي تُزاح عن السايدبار — تحتوي النافبار والمحتوى معاً،
           حتى لا يمتد النافبار فوق عرض السايدبار إطلاقاً */
        .main-wrapper {
            margin-right: var(--sidebar-width);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            transition: margin-right .25s ease;
        }

        .main-content {
            flex: 1;
            padding: 25px 25px 40px;
            background: var(--page-bg);
            transition: background .25s ease;
            animation: pageFadeIn .4s cubic-bezier(.2, .7, .2, 1) both;
        }

        @keyframes pageFadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* =====================================================
           THEME STATES
           ===================================================== */

        html[data-theme="dark"] body,
        html[data-theme="dark"] .app-wrapper,
        html[data-theme="dark"] .main-wrapper,
        html[data-theme="dark"] .main-content,

        body.dark,
        body.dark .app-wrapper,
        body.dark .main-wrapper,
        body.dark .main-content,

        body[data-theme="dark"],
        body[data-theme="dark"] .app-wrapper,
        body[data-theme="dark"] .main-wrapper,
        body[data-theme="dark"] .main-content {
            background: var(--page-bg);
            color: var(--text);
        }

        /* =====================================================
           MOBILE / TABLET
           ===================================================== */

        @media (max-width: 900px) {
            :root {
                --sidebar-width: 250px;
            }

            .main-wrapper {
                margin-right: var(--sidebar-width);
            }

            .main-content {
                padding: 20px 15px 30px;
            }

        }

        @media (max-width: 700px) {
            :root {
                --navbar-height: 68px;
            }

            .main-wrapper {
                margin-right: 0;
            }

            .main-content {
                padding: 18px 12px 30px;
            }

        }

    </style>

    @yield('styles')

</head>

<body>

<div class="app-wrapper"> 
    {{-- =====================================================
         SIDEBAR — طول الشاشة كاملاً من الأعلى
    ====================================================== --}}

    @include('Employee.layouts.sections.sidebar')

    {{-- =====================================================
         MAIN WRAPPER — يحتوي النافبار والمحتوى معاً، مُزاح
         عن عرض السايدبار بالكامل، بلا أي تضارب أو تراكب بينهما
    ====================================================== --}}

    <div class="main-wrapper">

        @include('Employee.layouts.sections.navbar')

        <main class="main-content">

            @yield('content')

        </main>

    </div>

</div>

<script>

    /* =========================================================
       ELITE CLUB GLOBAL THEME SYSTEM
       ========================================================= */

    (function () {
        const STORAGE_KEY = 'elite-theme';

        const savedTheme =
            localStorage.getItem(STORAGE_KEY);

        const systemDark =
            window.matchMedia &&
            window.matchMedia(
                '(prefers-color-scheme: dark)').matches;

        const initialTheme =
            savedTheme === 'dark' ||
            savedTheme === 'light'

                ? savedTheme: (systemDark ? 'dark' : 'light');

        function applyTheme(theme) {
            if (
                theme !== 'dark' &&
                theme !== 'light'
            ) {
                theme = 'light';

            }

            /* HTML */

            document.documentElement
                .setAttribute(
                    'data-theme',
                    theme
                );

            /* BODY */

            document.body
                .setAttribute(
                    'data-theme',
                    theme
                );

            /* Legacy dark class */

            if (theme === 'dark') {
                document.body.classList.add('dark');

            } else {
                document.body.classList.remove('dark');

            }

            /* Save */

            localStorage.setItem(
                STORAGE_KEY,
                theme
            );

            /* Event */

            window.dispatchEvent(
                new CustomEvent(
                    'eliteThemeChanged',                     {
                        detail: {
                            theme: theme
                        }
                    }
                )
            );
        }

        /* Apply immediately */

        applyTheme(initialTheme);

        /* =====================================================
           GLOBAL TOGGLE
        ====================================================== */

        window.toggleEliteTheme = function () {
            const current =
                document.documentElement
                    .getAttribute('data-theme');

            const next =
                current === 'dark'
                    ? 'light'
                    : 'dark';

            applyTheme(next);
        };

        /* =====================================================
           GLOBAL SET
        ====================================================== */

        window.setEliteTheme = function (theme) {
            if (
                theme !== 'dark' &&
                theme !== 'light'
            ) {
                return;
            }

            applyTheme(theme);
        };

        /* =====================================================
           SYSTEM THEME CHANGE
           فقط إذا المستخدم لم يختر ثيم يدوي
        ====================================================== */

        if (window.matchMedia) {
            const media =
                window.matchMedia(
                    '(prefers-color-scheme: dark)');

            media.addEventListener(
                'change',
                function (event) {
                    const manualTheme =
                        localStorage.getItem(
                            STORAGE_KEY
                        );

                    if (manualTheme) {
                        return;
                    }

                    applyTheme(
                        event.matches
                            ? 'dark'
                            : 'light'
                    );

                }
            );

        }

    })();

</script>

@yield('scripts')

</body>

</html>