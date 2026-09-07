<!DOCTYPE html>

<html lang="ar" dir="rtl" data-theme="light">

<head>

    
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>غير مصرح بالدخول | Elite Club</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link
        href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800;900&family=Playfair+Display:wght@600;700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">


    <script>
        (function() {

            const STORAGE_KEY = 'elite-theme';

            const savedTheme = localStorage.getItem(STORAGE_KEY);

            const systemDark =
                window.matchMedia &&
                window.matchMedia('(prefers-color-scheme: dark)').matches;

            const theme =
                savedTheme === 'dark' ||
                savedTheme === 'light' ?
                savedTheme :
                (systemDark ? 'dark' : 'light');

            document.documentElement.setAttribute(
                'data-theme',
                theme
            );

        })();
    </script>


    <style>
        /* =========================================================
       ELITE CLUB — ERROR PAGE
       PREMIUM / RESPONSIVE / LIGHT + DARK
    ========================================================== */

        :root {

            --page-bg:
                radial-gradient(circle at 10% 10%,
                    rgba(201, 169, 97, .14),
                    transparent 28%),
                radial-gradient(circle at 90% 90%,
                    rgba(15, 29, 48, .09),
                    transparent 30%),
                #f3f5f7;

            --card-bg: #ffffff;

            --panel-bg:
                linear-gradient(145deg,
                    #0b1625 0%,
                    #13243a 52%,
                    #091321 100%);

            --border: #dfe5eb;

            --text: #17202b;

            --text-soft: #596575;

            --muted: #7d8897;

            --gold: #c9a961;

            --gold-light: #e5cc8c;

            --gold-dark: #a9823d;

            --danger: #dc5b5b;

            --danger-soft:
                rgba(220, 91, 91, .09);

            --shadow:
                0 35px 90px rgba(15, 23, 42, .13);

            --button-bg:
                #f8fafc;

            --button-border:
                #dfe5eb;

            --radius: 26px;
        }


        /* =========================================================
       DARK MODE
    ========================================================== */

        html[data-theme="dark"] {

            --page-bg:
                radial-gradient(circle at 10% 10%,
                    rgba(201, 169, 97, .075),
                    transparent 28%),
                radial-gradient(circle at 90% 90%,
                    rgba(0, 210, 255, .035),
                    transparent 30%),
                #0b1016;

            --card-bg: #171c23;

            --border: #303843;

            --text: #f3f5f7;

            --text-soft: #c0c7d0;

            --muted: #858f9c;

            --gold: #d3b56b;

            --gold-light: #e7cc85;

            --gold-dark: #b48c42;

            --danger: #ed6b6b;

            --danger-soft:
                rgba(237, 107, 107, .08);

            --shadow:
                0 40px 100px rgba(0, 0, 0, .48);

            --button-bg: #20262e;

            --button-border: #303843;
        }


        /* =========================================================
       RESET
    ========================================================== */

        *,
        *::before,
        *::after {

            box-sizing: border-box;

            margin: 0;

            padding: 0;
        }


        html {

            min-height: 100%;

            background: #f3f5f7;

            scroll-behavior: smooth;
        }


        html[data-theme="dark"] {

            background: #0b1016;
        }


        body {

            min-height: 100vh;

            min-height: 100dvh;

            font-family:
                'Cairo',
                sans-serif;

            color:
                var(--text);

            background:
                var(--page-bg);

            display: flex;

            align-items: center;

            justify-content: center;

            padding: 35px;

            overflow: hidden;

            transition:
                background .3s ease,
                color .3s ease;
        }


        /* =========================================================
       THEME BUTTON
    ========================================================== */

        .theme-toggle {

            position: fixed;

            top: 24px;

            right: 24px;

            z-index: 100;

            width: 45px;

            height: 45px;

            display: flex;

            align-items: center;

            justify-content: center;

            border:
                1px solid var(--button-border);

            border-radius: 13px;

            color:
                var(--text-soft);

            background:
                var(--button-bg);

            cursor: pointer;

            box-shadow:
                0 9px 28px rgba(15, 23, 42, .08);

            backdrop-filter:
                blur(14px);

            -webkit-backdrop-filter:
                blur(14px);

            transition:
                .2s ease;
        }


        .theme-toggle:hover {

            transform:
                translateY(-2px);

            color:
                var(--gold);

            border-color:
                rgba(201, 169, 97, .45);
        }


        html[data-theme="dark"] .theme-toggle:hover {

            color:
                #00d2ff;

            border-color:
                rgba(0, 210, 255, .35);
        }


        .sun-icon {

            display: none;
        }


        .moon-icon {

            display: inline-block;
        }


        html[data-theme="dark"] .sun-icon {

            display: inline-block;
        }


        html[data-theme="dark"] .moon-icon {

            display: none;
        }


        /* =========================================================
       BACKGROUND ORBS
    ========================================================== */

        .background-orb {

            position: fixed;

            width: 340px;

            height: 340px;

            border-radius: 50%;

            pointer-events: none;

            filter:
                blur(85px);

            opacity: .18;

            z-index: 0;

            animation:
                orbFloat 9s ease-in-out infinite;
        }


        .orb-one {

            top: -150px;

            left: -120px;

            background:
                var(--gold);
        }


        .orb-two {

            right: -120px;

            bottom: -160px;

            background:
                #1d3557;

            animation-delay:
                -4.5s;
        }


        @keyframes orbFloat {

            0%,
            100% {

                transform:
                    translate(0, 0);
            }

            50% {

                transform:
                    translate(17px, -22px);
            }
        }


        /* =========================================================
       ERROR CARD
    ========================================================== */

        .error-shell {

            position: relative;

            z-index: 2;

            width:
                min(920px, 100%);

            min-height:
                530px;

            display:
                grid;

            grid-template-columns:
                .82fr 1.18fr;

            overflow:
                hidden;

            background:
                var(--card-bg);

            border:
                1px solid var(--border);

            border-radius:
                var(--radius);

            box-shadow:
                var(--shadow);

            animation:
                shellEnter .7s cubic-bezier(.16, 1, .3, 1) both;

            transition:
                background .3s ease,
                border-color .3s ease,
                box-shadow .3s ease;
        }


        @keyframes shellEnter {

            from {

                opacity: 0;

                transform:
                    translateY(25px) scale(.97);
            }

            to {

                opacity: 1;

                transform:
                    translateY(0) scale(1);
            }
        }


        /* =========================================================
       BRAND PANEL
    ========================================================== */

        .brand-panel {

            position: relative;

            overflow: hidden;

            padding:
                55px 48px;

            display:
                flex;

            flex-direction:
                column;

            justify-content:
                center;

            color:
                #fff;

            background:
                var(--panel-bg);
        }


        .brand-panel::before {

            content: "";

            position: absolute;

            width: 360px;

            height: 360px;

            right: -175px;

            bottom: -175px;

            border:
                1px solid rgba(201, 169, 97, .25);

            border-radius:
                50%;

            box-shadow:
                0 0 0 35px rgba(201, 169, 97, .025),
                0 0 0 72px rgba(201, 169, 97, .018);
        }


        .brand-panel::after {

            content: "";

            position: absolute;

            width: 210px;

            height: 210px;

            top: -115px;

            left: -105px;

            border-radius: 50%;

            background:
                radial-gradient(circle,
                    rgba(201, 169, 97, .15),
                    transparent 70%);
        }


        .brand-content {

            position: relative;

            z-index: 2;

            animation:
                contentEnter .8s .1s cubic-bezier(.16, 1, .3, 1) both;
        }


        @keyframes contentEnter {

            from {

                opacity: 0;

                transform:
                    translateX(-20px);
            }

            to {

                opacity: 1;

                transform:
                    translateX(0);
            }
        }


        /* =========================================================
       BRAND MARK
    ========================================================== */

        .brand-mark {

            width: 68px;

            height: 68px;

            display: flex;

            align-items: center;

            justify-content: center;

            margin-bottom: 22px;

            border:
                1px solid rgba(201, 169, 97, .55);

            border-radius: 18px;

            color:
                var(--gold-light);

            background:
                linear-gradient(145deg,
                    rgba(201, 169, 97, .15),
                    rgba(255, 255, 255, .025));

            box-shadow:
                0 0 38px rgba(201, 169, 97, .07),
                inset 0 0 22px rgba(201, 169, 97, .025);

            font-family:
                'Playfair Display',
                serif;

            font-size:
                32px;
        }


        .brand-small {

            color:
                var(--gold-light);

            font-size:
                10px;

            font-weight:
                800;

            letter-spacing:
                4px;

            margin-bottom:
                7px;
        }


        .brand-title {

            font-family:
                'Playfair Display',
                serif;

            font-size:
                34px;

            letter-spacing:
                3px;

            line-height:
                1.2;

            margin-bottom:
                14px;
        }


        .brand-line {

            width:
                55px;

            height:
                2px;

            margin-bottom:
                26px;

            background:
                linear-gradient(90deg,
                    var(--gold-light),
                    transparent);
        }


        .brand-heading {

            font-size:
                20px;

            font-weight:
                800;

            line-height:
                1.5;

            margin-bottom:
                10px;
        }


        .brand-description {

            max-width:
                300px;

            color:
                #b3bfd0;

            font-size:
                12px;

            line-height:
                2;
        }


        .brand-footer {

            position:
                absolute;

            right:
                48px;

            bottom:
                27px;

            color:
                rgba(255, 255, 255, .35);

            font-size:
                9px;

            font-weight:
                600;

            letter-spacing:
                1px;
        }


        /* =========================================================
       ERROR PANEL
    ========================================================== */

        .error-panel {

            position:
                relative;

            padding:
                55px 58px;

            display:
                flex;

            align-items:
                center;

            justify-content:
                center;

            background:
                var(--card-bg);
        }


        .error-content {

            width:
                100%;

            max-width:
                520px;

            text-align:
                center;

            animation:
                errorEnter .75s .12s cubic-bezier(.16, 1, .3, 1) both;
        }


        @keyframes errorEnter {

            from {

                opacity: 0;

                transform:
                    translateX(20px);
            }

            to {

                opacity: 1;

                transform:
                    translateX(0);
            }
        }


        /* =========================================================
       ERROR ICON
    ========================================================== */

        .error-icon {

            position:
                relative;

            width:
                115px;

            height:
                115px;

            margin:
                0 auto 24px;

            display:
                flex;

            align-items:
                center;

            justify-content:
                center;

            border:
                1px solid rgba(220, 91, 91, .24);

            border-radius:
                50%;

            color:
                var(--danger);

            background:
                var(--danger-soft);

            box-shadow:
                0 15px 40px rgba(220, 91, 91, .08);

            animation:
                iconFloat 3s ease-in-out infinite;
        }


        .error-icon::before {

            content: "";

            position:
                absolute;

            inset:
                -10px;

            border:
                1px solid rgba(220, 91, 91, .09);

            border-radius:
                50%;
        }


        .error-icon i {

            font-size:
                42px;
        }


        @keyframes iconFloat {

            0%,
            100% {

                transform:
                    translateY(0);
            }

            50% {

                transform:
                    translateY(-5px);
            }
        }


        /* =========================================================
       ERROR CODE
    ========================================================== */

        .error-code {

            font-family:
                'Playfair Display',
                serif;

            font-size:
                64px;

            line-height:
                1;

            font-weight:
                700;

            letter-spacing:
                3px;

            color:
                var(--gold);

            margin-bottom:
                9px;
        }


        .error-title {

            font-size:
                25px;

            font-weight:
                900;

            color:
                var(--text);

            margin-bottom:
                11px;
        }


        .error-description {

            color:
                var(--muted);

            font-size:
                12.5px;

            line-height:
                2;

            max-width:
                450px;

            margin:
                0 auto 25px;
        }


        .error-description strong {

            color:
                var(--danger);

            font-weight:
                800;
        }


        /* =========================================================
       INFO BOX
    ========================================================== */

        .security-box {

            display:
                flex;

            align-items:
                center;

            gap:
                12px;

            text-align:
                right;

            padding:
                13px 15px;

            margin-bottom:
                25px;

            border:
                1px solid var(--border);

            border-radius:
                12px;

            background:
                var(--button-bg);
        }


        .security-box-icon {

            width:
                35px;

            height:
                35px;

            flex-shrink:
                0;

            display:
                flex;

            align-items:
                center;

            justify-content:
                center;

            border-radius:
                9px;

            color:
                var(--gold-dark);

            background:
                rgba(201, 169, 97, .10);

            font-size:
                13px;
        }


        .security-box-text {

            color:
                var(--muted);

            font-size:
                10.5px;

            line-height:
                1.8;
        }


        .security-box-text strong {

            display:
                block;

            color:
                var(--text-soft);

            font-size:
                11px;

            margin-bottom:
                1px;
        }


        /* =========================================================
       ACTION BUTTONS
    ========================================================== */

        .actions {

            display:
                flex;

            gap:
                10px;

            justify-content:
                center;
        }


        .action-button {

            min-width:
                145px;

            height:
                47px;

            padding:
                0 17px;

            display:
                inline-flex;

            align-items:
                center;

            justify-content:
                center;

            gap:
                8px;

            border:
                1px solid var(--button-border);

            border-radius:
                11px;

            text-decoration:
                none;

            font-family:
                inherit;

            font-size:
                11.5px;

            font-weight:
                800;

            cursor:
                pointer;

            transition:
                .2s ease;
        }


        .back-button {

            color:
                var(--text-soft);

            background:
                var(--button-bg);
        }


        .back-button:hover {

            transform:
                translateY(-2px);

            color:
                var(--gold-dark);

            border-color:
                rgba(201, 169, 97, .42);
        }


        .home-button {

            color:
                #17202b;

            border-color:
                transparent;

            background:
                linear-gradient(135deg,
                    var(--gold-light),
                    var(--gold));

            box-shadow:
                0 9px 24px rgba(201, 169, 97, .20);
        }


        .home-button:hover {

            transform:
                translateY(-2px);

            filter:
                brightness(1.04);

            box-shadow:
                0 13px 29px rgba(201, 169, 97, .28);
        }


        .corner-decoration {

            position:
                absolute;

            top:
                0;

            right:
                0;

            width:
                135px;

            height:
                135px;

            pointer-events:
                none;

            opacity:
                .60;
        }


        .corner-decoration::before {

            content: "";

            position:
                absolute;

            top:
                -62px;

            right:
                -62px;

            width:
                135px;

            height:
                135px;

            border-radius:
                50%;

            border:
                1px solid rgba(201, 169, 97, .18);
        }


        .corner-decoration::after {

            content: "";

            position:
                absolute;

            top:
                20px;

            right:
                20px;

            width:
                5px;

            height:
                5px;

            border-radius:
                50%;

            background:
                var(--gold);

            box-shadow:
                0 0 0 5px rgba(201, 169, 97, .06);
        }


        /* =========================================================
       TABLET
    ========================================================== */

        @media (max-width: 850px) {

            body {

                padding:
                    20px;
            }


            .error-shell {

                grid-template-columns:
                    1fr;

                max-width:
                    580px;
            }


            .brand-panel {

                min-height:
                    255px;

                padding:
                    38px 42px;
            }


            .brand-footer {

                display:
                    none;
            }


            .brand-title {

                font-size:
                    30px;
            }


            .brand-heading {

                font-size:
                    18px;
            }


            .brand-description {

                max-width:
                    430px;
            }


            .error-panel {

                padding:
                    42px;
            }
        }


        /* =========================================================
       MOBILE
    ========================================================== */

        @media (max-width: 560px) {

            body {

                padding:
                    12px;

                align-items:
                    flex-start;
            }


            .theme-toggle {

                top:
                    12px;

                right:
                    12px;

                width:
                    41px;

                height:
                    41px;
            }


            .error-shell {

                width:
                    100%;

                margin-top:
                    42px;

                border-radius:
                    19px;
            }


            .brand-panel {

                min-height:
                    220px;

                padding:
                    30px 27px;
            }


            .brand-mark {

                width:
                    55px;

                height:
                    55px;

                margin-bottom:
                    16px;

                border-radius:
                    15px;

                font-size:
                    26px;
            }


            .brand-small {

                font-size:
                    8px;

                letter-spacing:
                    3px;
            }


            .brand-title {

                font-size:
                    26px;

                margin-bottom:
                    9px;
            }


            .brand-line {

                width:
                    43px;

                margin-bottom:
                    17px;
            }


            .brand-heading {

                font-size:
                    16px;

                margin-bottom:
                    6px;
            }


            .brand-description {

                font-size:
                    10.5px;

                line-height:
                    1.8;
            }


            .error-panel {

                padding:
                    32px 22px 27px;
            }


            .error-icon {

                width:
                    90px;

                height:
                    90px;

                margin-bottom:
                    20px;
            }


            .error-icon i {

                font-size:
                    34px;
            }


            .error-code {

                font-size:
                    53px;
            }


            .error-title {

                font-size:
                    21px;
            }


            .error-description {

                font-size:
                    11px;

                line-height:
                    1.9;

                margin-bottom:
                    20px;
            }


            .security-box {

                padding:
                    11px 12px;

                gap:
                    9px;

                margin-bottom:
                    20px;
            }


            .security-box-icon {

                width:
                    31px;

                height:
                    31px;

                font-size:
                    11px;
            }


            .security-box-text {

                font-size:
                    9.5px;
            }


            .security-box-text strong {

                font-size:
                    10px;
            }


            .actions {

                flex-direction:
                    column;
            }


            .action-button {

                width:
                    100%;
            }
        }


        /* =========================================================
       ACCESSIBILITY
    ========================================================== */

        .theme-toggle:focus-visible,
        .action-button:focus-visible {

            outline:
                2px solid var(--gold);

            outline-offset:
                3px;
        }


        /* =========================================================
       REDUCE MOTION
    ========================================================== */

        @media (prefers-reduced-motion: reduce) {

            *,
            *::before,
            *::after {

                animation-duration:
                    .01ms !important;

                animation-iteration-count:
                    1 !important;

                transition-duration:
                    .01ms !important;

                scroll-behavior:
                    auto !important;
            }
        }
    </style>
    

</head>

<body>

    
    <!-- =========================================================
     THEME TOGGLE
========================================================== -->

    <button type="button" class="theme-toggle" id="themeToggle" aria-label="تغيير المظهر" title="تغيير المظهر">

        <i class="fas fa-sun sun-icon"></i>

        <i class="fas fa-moon moon-icon"></i>

    </button>


    <!-- =========================================================
     BACKGROUND
========================================================== -->

    <div class="background-orb orb-one"></div>

    <div class="background-orb orb-two"></div>


    <!-- =========================================================
     ERROR SHELL
========================================================== -->

    <main class="error-shell">


        <!-- =====================================================
         BRAND PANEL
    ====================================================== -->

        <section class="brand-panel">

            <div class="brand-content">

                <div class="brand-mark">
                    E
                </div>

                <div class="brand-small">
                    ELITE CLUB
                </div>

                <h2 class="brand-title">
                    SECURITY
                </h2>

                <div class="brand-line"></div>

                <h3 class="brand-heading">
                    Protected Workspace
                </h3>

                <p class="brand-description">
                    هذا النظام محمي بصلاحيات وصول
                    مخصصة لكل مستخدم، لضمان أمان
                    بيانات النادي وعملياته.
                </p>

            </div>


            <div class="brand-footer">
                ELITE CLUB • SECURE SYSTEM
            </div>

        </section>


        <!-- =====================================================
         ERROR PANEL
    ====================================================== -->

        <section class="error-panel">

            <div class="corner-decoration"></div>


            <div class="error-content">


                <!-- ERROR ICON -->

                <div class="error-icon">

                    <i class="fas fa-shield-halved"></i>

                </div>


                <!-- ERROR CODE -->

                <div class="error-code">
                    403
                </div>


                <!-- TITLE -->

                <h1 class="error-title">
                    غير مصرح بالدخول
                </h1>


                <!-- DESCRIPTION -->

                <p class="error-description">

                    عذراً، لا تملك الصلاحيات المطلوبة
                    للوصول إلى هذه الصفحة.

                    <br>

                    <strong>
                        الدور الحالي لا يتطابق مع الصلاحيات المطلوبة.
                    </strong>

                </p>


                <!-- SECURITY INFO -->

                <div class="security-box">

                    <div class="security-box-icon">

                        <i class="fas fa-lock"></i>

                    </div>


                    <div class="security-box-text">

                        <strong>
                            منطقة محمية
                        </strong>

                        تم منع الوصول حفاظاً على أمان
                        بيانات ونظام Elite Club.

                    </div>

                </div>


                <!-- ACTIONS -->

                <div class="actions">


                    <a href="{{ url()->previous() }}" class="action-button back-button">

                        <i class="fas fa-arrow-right"></i>

                        رجوع للخلف

                    </a>


                    <a href="{{ url('/') }}" class="action-button home-button">

                        <i class="fas fa-house"></i>

                        الصفحة الرئيسية

                    </a>


                </div>

            </div>

        </section>

    </main>


    <!-- =========================================================
     THEME SCRIPT
========================================================== -->

    <script>
        (function() {

            const STORAGE_KEY = 'elite-theme';

            const themeToggle =
                document.getElementById('themeToggle');


            if (!themeToggle) {
                return;
            }


            themeToggle.addEventListener(
                'click',
                function() {

                    const html =
                        document.documentElement;

                    const currentTheme =
                        html.getAttribute('data-theme');

                    const newTheme =
                        currentTheme === 'dark' ?
                        'light' :
                        'dark';

                    html.setAttribute(
                        'data-theme',
                        newTheme
                    );

                    localStorage.setItem(
                        STORAGE_KEY,
                        newTheme
                    );

                }
            );

        })();
    </script>
    

</body>

</html>
