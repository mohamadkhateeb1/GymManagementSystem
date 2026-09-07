<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'Elite Club - Admin')
    </title>

    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">

    <script>
        (function() {
            const savedTheme = localStorage.getItem('elite-theme');
            const theme = savedTheme === 'dark' ? 'dark' : 'light';

            document.documentElement.setAttribute(
                'data-theme',
                theme
            );
        })();
    </script>

    <style>
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
            z-index: 90;
            transition:
                background .25s ease,
                border-color .25s ease,
                box-shadow .25s ease;
        }

        .nav-right {
            display: flex;
            align-items: center;
            flex: 1;
            min-width: 0;
        }

        .content-area {
            flex: 1;
            min-width: 0;
            padding: 25px 30px 35px;
            background: var(--app-bg);
            transition: background .25s ease;
        }

        #employeeSidebar {
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

        @media (max-width: 1100px) {

            :root {
                --sidebar-width: 250px;
            }

            .content-area {
                padding: 22px 20px 30px;
            }

            .top-navbar {
                padding-left: 22px;
                padding-right: 22px;
            }
        }

        @media (max-width: 768px) {

            :root {
                --sidebar-width: 270px;
            }

            .main-wrapper {
                width: 100%;
                margin-right: 0;
            }

            .content-area {
                padding: 18px 14px 28px;
            }

            .top-navbar {
                min-height: 68px;
                padding: 8px 15px 8px 15px;
                gap: 10px;
            }

            .nav-right {
                width: 100%;
            }
        }

        @media (max-width: 480px) {

            .content-area {
                padding: 14px 10px 24px;
            }

            .top-navbar {
                padding-left: 12px;
                padding-right: 12px;
            }
        }

        /* ═══════════ 🔔 إشعارات Toast — نفس تصميم لوحة الأدمن ═══════════ */
        .elite-toast-stack {
            position: fixed;
            top: 22px;
            left: 22px;
            z-index: 99999;
            display: flex;
            flex-direction: column;
            gap: 12px;
            max-width: 380px;
            width: calc(100% - 44px);
            pointer-events: none;
        }

        @keyframes eliteToastIn {
            from {
                opacity: 0;
                transform: translateX(-22px) scale(.96);
            }

            to {
                opacity: 1;
                transform: translateX(0) scale(1);
            }
        }

        @keyframes eliteToastOut {
            to {
                opacity: 0;
                transform: translateX(-14px) scale(.96);
            }
        }

        @keyframes eliteToastProgress {
            from {
                transform: scaleX(1);
            }

            to {
                transform: scaleX(0);
            }
        }

        .elite-toast {
            position: relative;
            overflow: hidden;
            pointer-events: auto;
            padding: 16px 46px 16px 18px;
            border-radius: 14px;
            font-family: 'Tajawal', sans-serif;
            font-size: 13.5px;
            font-weight: 600;
            display: flex;
            align-items: flex-start;
            gap: 12px;
            background: var(--surface, #fff);
            border: 1px solid var(--border, #e4e8ef);
            box-shadow: 0 16px 38px rgba(20, 25, 35, .14);
            animation: eliteToastIn .35s cubic-bezier(.2, .8, .3, 1) both;
            transition: box-shadow .2s ease;
        }

        .elite-toast:hover {
            box-shadow: 0 20px 46px rgba(20, 25, 35, .20);
        }

        .elite-toast.elite-toast-out {
            animation: eliteToastOut .28s ease forwards;
        }

        .elite-toast-icon {
            width: 32px;
            height: 32px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            font-size: 14px;
        }

        .elite-toast-success .elite-toast-icon {
            color: var(--success, #15915d);
            background: var(--success-bg, #e8f8f0);
        }

        .elite-toast-error .elite-toast-icon {
            color: var(--danger, #d34b4b);
            background: var(--danger-bg, #fff0f0);
        }

        .elite-toast>div {
            min-width: 0;
            flex: 1;
        }

        .elite-toast-title {
            color: var(--text, #202631);
            font-weight: 800;
            font-size: 13.5px;
            margin-bottom: 2px;
        }

        .elite-toast-body {
            color: var(--text-soft, #565d67);
            line-height: 1.7;
            word-break: break-word;
        }

        /* عرض الأخطاء بشكل متناسق: بلا نقاط افتراضية، نقطة ملوّنة أنيقة، RTL */
        .elite-toast-body ul {
            margin: 4px 0 0;
            padding: 0;
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .elite-toast-body ul li {
            position: relative;
            padding-inline-start: 15px;
            line-height: 1.6;
            word-break: break-word;
        }

        .elite-toast-body ul li::before {
            content: "";
            position: absolute;
            inset-inline-start: 0;
            top: .62em;
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: var(--danger, #d34b4b);
        }

        .elite-toast-close {
            position: absolute;
            top: 12px;
            left: 12px;
            width: 22px;
            height: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            background: var(--surface-2, #f4f5f7);
            border-radius: 7px;
            cursor: pointer;
            font-size: 11px;
            color: var(--text-soft, #565d67);
            transition: all .15s ease;
        }

        .elite-toast-close:hover {
            color: var(--danger, #d34b4b);
            background: var(--danger-bg, #fff0f0);
        }

        .elite-toast-progress {
            position: absolute;
            bottom: 0;
            right: 0;
            left: 0;
            height: 3px;
            transform-origin: right;
            animation: eliteToastProgress 5s linear forwards;
        }

        .elite-toast:hover .elite-toast-progress {
            animation-play-state: paused;
        }

        .elite-toast-success .elite-toast-progress {
            background: var(--success, #15915d);
        }

        .elite-toast-error .elite-toast-progress {
            background: var(--danger, #d34b4b);
        }

        @media (max-width: 480px) {
            .elite-toast-stack {
                top: 12px;
                left: 12px;
                width: calc(100% - 24px);
                max-width: none;
            }

            .elite-toast {
                padding: 14px 42px 14px 15px;
                font-size: 13px;
            }
        }
    </style>

    @yield('styles')

</head>

<body>

    @include('Employee.layouts.sections.sidebar')

    <div class="main-wrapper">

        <header class="top-navbar">

            <div class="nav-right">

                @include('Employee.layouts.sections.navbar')

            </div>

        </header>

        <main class="content-area">

            @if (session('success') || session('error') || $errors->any())
                <div class="elite-toast-stack">

                    @if (session('success'))
                        <div class="elite-toast elite-toast-success" data-elite-toast>
                            <span class="elite-toast-icon"><i class="fas fa-circle-check"></i></span>
                            <div>
                                <div class="elite-toast-title">تمّت العملية بنجاح</div>
                                <div class="elite-toast-body">{{ session('success') }}</div>
                            </div>
                            <button type="button" class="elite-toast-close"
                                onclick="this.closest('[data-elite-toast]').remove()"><i
                                    class="fas fa-times"></i></button>
                            <div class="elite-toast-progress"></div>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="elite-toast elite-toast-error" data-elite-toast>
                            <span class="elite-toast-icon"><i class="fas fa-circle-exclamation"></i></span>
                            <div>
                                <div class="elite-toast-title">حدث خطأ</div>
                                <div class="elite-toast-body">{{ session('error') }}</div>
                            </div>
                            <button type="button" class="elite-toast-close"
                                onclick="this.closest('[data-elite-toast]').remove()"><i
                                    class="fas fa-times"></i></button>
                            <div class="elite-toast-progress"></div>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="elite-toast elite-toast-error" data-elite-toast>
                            <span class="elite-toast-icon"><i class="fas fa-triangle-exclamation"></i></span>
                            <div>
                                <div class="elite-toast-title">تحقّق من البيانات المدخلة</div>
                                <div class="elite-toast-body">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <button type="button" class="elite-toast-close"
                                onclick="this.closest('[data-elite-toast]').remove()"><i
                                    class="fas fa-times"></i></button>
                            <div class="elite-toast-progress"></div>
                        </div>
                    @endif

                </div>

                <script>
                    document.querySelectorAll('[data-elite-toast]').forEach(function(toast) {
                        let elapsed = 0;
                        const check = setInterval(function() {
                            if (!document.body.contains(toast)) {
                                clearInterval(check);
                                return;
                            }
                            if (toast.matches(':hover')) {
                                return;
                            }
                            elapsed += 100;
                            if (elapsed >= 5000) {
                                clearInterval(check);
                                toast.classList.add('elite-toast-out');
                                setTimeout(() => toast.remove(), 300);
                            }
                        }, 100);
                    });
                </script>
            @endif

            @yield('content')

        </main>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        window.toggleEliteTheme = function() {

            const html = document.documentElement;

            const current =
                html.getAttribute('data-theme') || 'light';

            const next =
                current === 'dark' ? 'light' : 'dark';

            html.setAttribute('data-theme', next);

            localStorage.setItem('elite-theme', next);
        };
    </script>

    @yield('scripts')

</body>

</html>
