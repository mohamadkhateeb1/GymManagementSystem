<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">

    <meta http-equiv="X-UA-Compatible"
        content="ie=edge">

    <meta name="csrf-token"
        content="{{ csrf_token() }}">

    <title>Employee Login | Elite Club</title>

    <link rel="preconnect"
        href="https://fonts.googleapis.com">

    <link
        href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800&family=Playfair+Display:wght@600;700&display=swap"
        rel="stylesheet">

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">


    <!-- =========================================================
         APPLY SAVED THEME BEFORE PAGE PAINT
    ========================================================== -->

    <script>

        (function () {

            const STORAGE_KEY = 'elite-theme';

            const savedTheme =
                localStorage.getItem(STORAGE_KEY);

            const systemDark =
                window.matchMedia &&
                window.matchMedia(
                    '(prefers-color-scheme: dark)'
                ).matches;

            const theme =
                savedTheme === 'dark' ||
                savedTheme === 'light'
                    ? savedTheme
                    : (systemDark ? 'dark' : 'light');

            document.documentElement.setAttribute(
                'data-theme',
                theme
            );

        })();

    </script>


    <style>

        /* =========================================================
           ELITE CLUB EMPLOYEE LOGIN
           LIGHT / DARK MODE
           DESIGN ONLY
        ========================================================= */


        :root {

            --page-bg:
                radial-gradient(
                    circle at 15% 15%,
                    rgba(201, 169, 97, .10),
                    transparent 28%
                ),
                radial-gradient(
                    circle at 85% 85%,
                    rgba(15, 29, 48, .08),
                    transparent 30%
                ),
                #f4f6f8;

            --card-bg: #ffffff;

            --panel-bg:
                linear-gradient(
                    145deg,
                    #101c2c,
                    #17273a 55%,
                    #0d1725
                );

            --input-bg: #f8fafc;

            --border: #e1e6ec;

            --text: #18202b;

            --text-soft: #596575;

            --muted: #8b95a3;

            --gold: #c9a961;

            --gold-light: #e5cc8c;

            --gold-dark: #a9823d;

            --gold-soft:
                rgba(201, 169, 97, .12);

            --danger: #e85d5d;

            --shadow:
                0 30px 80px
                rgba(15, 23, 42, .12);

            --input-shadow:
                0 5px 18px
                rgba(15, 23, 42, .035);

            --radius: 24px;

            --theme-button-bg:
                rgba(255,255,255,.90);

            --theme-button-border:
                rgba(15,23,42,.08);

            --theme-button-text:
                #596575;
        }


        /* =========================================================
           DARK MODE
        ========================================================= */

        html[data-theme="dark"] {

            --page-bg:
                radial-gradient(
                    circle at 15% 15%,
                    rgba(201, 169, 97, .07),
                    transparent 28%
                ),
                radial-gradient(
                    circle at 85% 85%,
                    rgba(0, 210, 255, .035),
                    transparent 30%
                ),
                #0d1117;

            --card-bg: #171c23;

            --input-bg: #20262e;

            --border: #303843;

            --text: #f3f5f7;

            --text-soft: #bdc4ce;

            --muted: #818b98;

            --gold: #d3b56b;

            --gold-light: #e5ca83;

            --gold-dark: #b48c42;

            --gold-soft:
                rgba(211, 181, 107, .10);

            --danger: #ed6868;

            --shadow:
                0 35px 90px
                rgba(0, 0, 0, .45);

            --input-shadow:
                0 8px 22px
                rgba(0, 0, 0, .12);

            --theme-button-bg:
                rgba(32,38,46,.95);

            --theme-button-border:
                rgba(255,255,255,.08);

            --theme-button-text:
                #d7dde5;
        }


        /* =========================================================
           RESET
        ========================================================= */

        * {

            box-sizing: border-box;

            margin: 0;

            padding: 0;
        }


        html {

            min-height: 100%;

            background: #f4f6f8;
        }


        html[data-theme="dark"] {

            background: #0d1117;
        }


        body {

            min-height: 100vh;

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

            overflow-x: hidden;

            transition:
                background .3s ease,
                color .3s ease;
        }


        /* =========================================================
           THEME BUTTON
        ========================================================= */

        .theme-toggle {

            position: fixed;

            top: 24px;

            right: 24px;

            z-index: 100;

            width: 44px;

            height: 44px;

            display: flex;

            align-items: center;

            justify-content: center;

            border:
                1px solid
                var(--theme-button-border);

            border-radius: 12px;

            color:
                var(--theme-button-text);

            background:
                var(--theme-button-bg);

            cursor: pointer;

            box-shadow:
                0 8px 25px
                rgba(15,23,42,.08);

            backdrop-filter:
                blur(12px);

            -webkit-backdrop-filter:
                blur(12px);

            transition:
                transform .2s ease,
                color .2s ease,
                border-color .2s ease,
                background .3s ease,
                box-shadow .2s ease;
        }


        .theme-toggle:hover {

            transform:
                translateY(-2px);

            color:
                var(--gold);

            border-color:
                rgba(201,169,97,.45);

            box-shadow:
                0 10px 28px
                rgba(15,23,42,.12);
        }


        html[data-theme="dark"]
        .theme-toggle:hover {

            color:
                #00d2ff;

            border-color:
                rgba(0,210,255,.35);

            box-shadow:
                0 0 22px
                rgba(0,210,255,.08);
        }


        .theme-toggle i {

            font-size: 16px;

            transition:
                transform .25s ease;
        }


        .theme-toggle:hover i {

            transform:
                rotate(12deg);
        }


        .sun-icon {

            display: none;
        }


        .moon-icon {

            display: inline-block;
        }


        html[data-theme="dark"]
        .sun-icon {

            display: inline-block;
        }


        html[data-theme="dark"]
        .moon-icon {

            display: none;
        }


        /* =========================================================
           BACKGROUND DECORATION
        ========================================================= */

        .background-orb {

            position: fixed;

            width: 320px;

            height: 320px;

            border-radius: 50%;

            pointer-events: none;

            filter:
                blur(80px);

            opacity: .20;

            z-index: 0;

            animation:
                orbFloat 8s
                ease-in-out
                infinite;
        }


        .orb-one {

            top: -130px;

            left: -100px;

            background:
                var(--gold);
        }


        .orb-two {

            bottom: -160px;

            right: -100px;

            background:
                #1d3557;

            animation-delay:
                -4s;
        }


        @keyframes orbFloat {

            0%,
            100% {

                transform:
                    translate(0, 0);
            }

            50% {

                transform:
                    translate(15px, -20px);
            }
        }


        /* =========================================================
           MAIN CARD
        ========================================================= */

        .login-shell {

            position: relative;

            z-index: 2;

            width:
                min(1050px, 100%);

            min-height: 620px;

            display: grid;

            grid-template-columns:
                minmax(330px, .88fr)
                minmax(420px, 1.12fr);

            background:
                var(--card-bg);

            border:
                1px solid
                var(--border);

            border-radius:
                var(--radius);

            overflow: hidden;

            box-shadow:
                var(--shadow);

            animation:
                shellEnter .7s
                cubic-bezier(.16, 1, .3, 1)
                both;

            transition:
                background .3s ease,
                border-color .3s ease,
                box-shadow .3s ease;
        }


        @keyframes shellEnter {

            from {

                opacity: 0;

                transform:
                    translateY(25px)
                    scale(.97);
            }

            to {

                opacity: 1;

                transform:
                    translateY(0)
                    scale(1);
            }
        }


        /* =========================================================
           BRANDING SIDE
        ========================================================= */

        .brand-panel {

            position: relative;

            overflow: hidden;

            padding:
                55px 48px;

            display: flex;

            flex-direction: column;

            justify-content: center;

            color: #fff;

            background:
                var(--panel-bg);
        }


        .brand-panel::before {

            content: "";

            position: absolute;

            width: 330px;

            height: 330px;

            right: -150px;

            bottom: -150px;

            border:
                1px solid
                rgba(201, 169, 97, .25);

            border-radius: 50%;

            box-shadow:
                0 0 0 35px
                rgba(201, 169, 97, .025),

                0 0 0 70px
                rgba(201, 169, 97, .018);
        }


        .brand-panel::after {

            content: "";

            position: absolute;

            width: 180px;

            height: 180px;

            top: -100px;

            left: -90px;

            border-radius: 50%;

            background:
                radial-gradient(
                    circle,
                    rgba(201, 169, 97, .13),
                    transparent 70%
                );
        }


        .brand-content {

            position: relative;

            z-index: 2;

            animation:
                brandEnter .8s
                .15s
                cubic-bezier(.16, 1, .3, 1)
                both;
        }


        @keyframes brandEnter {

            from {

                opacity: 0;

                transform:
                    translateX(-25px);
            }

            to {

                opacity: 1;

                transform:
                    translateX(0);
            }
        }


        /* =========================================================
           BRAND ICON
        ========================================================= */

        .brand-mark {

            width: 64px;

            height: 64px;

            display: flex;

            align-items: center;

            justify-content: center;

            margin-bottom: 25px;

            border:
                1px solid
                rgba(201, 169, 97, .55);

            border-radius: 17px;

            color:
                var(--gold-light);

            background:
                linear-gradient(
                    145deg,
                    rgba(201, 169, 97, .14),
                    rgba(255, 255, 255, .025)
                );

            box-shadow:
                0 0 35px
                rgba(201, 169, 97, .07),

                inset 0 0 20px
                rgba(201, 169, 97, .025);

            font-family:
                'Playfair Display',
                serif;

            font-size: 30px;

            transition:
                transform .3s ease,
                box-shadow .3s ease;
        }


        .brand-mark:hover {

            transform:
                translateY(-4px)
                rotate(-2deg);

            box-shadow:
                0 10px 35px
                rgba(201, 169, 97, .15);
        }


        .brand-small {

            color:
                var(--gold-light);

            font-size: 11px;

            font-weight: 800;

            letter-spacing: 4px;

            margin-bottom: 8px;
        }


        .brand-title {

            font-family:
                'Playfair Display',
                serif;

            font-size: 34px;

            letter-spacing: 3px;

            line-height: 1.2;

            margin-bottom: 12px;
        }


        .brand-line {

            width: 54px;

            height: 2px;

            margin-bottom: 28px;

            background:
                linear-gradient(
                    90deg,
                    var(--gold-light),
                    transparent
                );
        }


        .brand-heading {

            font-size: 24px;

            font-weight: 700;

            line-height: 1.5;

            margin-bottom: 13px;
        }


        .brand-description {

            max-width: 330px;

            color: #aebbd0;

            font-size: 13px;

            line-height: 2;
        }


        .brand-footer {

            position: absolute;

            right: 48px;

            bottom: 30px;

            color:
                rgba(255, 255, 255, .38);

            font-size: 10px;

            letter-spacing: 1px;
        }


        /* =========================================================
           LOGIN SIDE
        ========================================================= */

        .login-panel {

            position: relative;

            padding:
                58px 58px 45px;

            display: flex;

            align-items: center;

            background:
                var(--card-bg);

            transition:
                background .3s ease;
        }


        .login-content {

            width: 100%;

            max-width: 500px;

            margin: auto;

            animation:
                formEnter .75s
                .1s
                cubic-bezier(.16, 1, .3, 1)
                both;
        }


        @keyframes formEnter {

            from {

                opacity: 0;

                transform:
                    translateX(25px);
            }

            to {

                opacity: 1;

                transform:
                    translateX(0);
            }
        }


        .login-heading {

            margin-bottom: 32px;
        }


        .login-heading h1 {

            font-size: 28px;

            font-weight: 800;

            line-height: 1.4;

            margin-bottom: 7px;

            color:
                var(--text);
        }


        .login-heading p {

            color:
                var(--muted);

            font-size: 13px;

            line-height: 1.8;
        }


        .login-heading::after {

            content: "";

            display: block;

            width: 38px;

            height: 2px;

            margin-top: 15px;

            background:
                var(--gold);

            border-radius: 10px;
        }


        /* =========================================================
           FORM
        ========================================================= */

        .field {

            margin-bottom: 20px;

            animation:
                fieldEnter .55s
                cubic-bezier(.16, 1, .3, 1)
                both;
        }


        .field:nth-child(2) {

            animation-delay:
                .08s;
        }


        @keyframes fieldEnter {

            from {

                opacity: 0;

                transform:
                    translateY(10px);
            }

            to {

                opacity: 1;

                transform:
                    translateY(0);
            }
        }


        .field label {

            display: flex;

            align-items: center;

            gap: 7px;

            margin-bottom: 8px;

            color:
                var(--text);

            font-size: 12px;

            font-weight: 700;
        }


        .field label i {

            color:
                var(--gold);

            font-size: 11px;
        }


        .input-wrapper {

            position: relative;
        }


        .input-icon {

            position: absolute;

            top: 50%;

            left: 15px;

            transform:
                translateY(-50%);

            color:
                #98a3b2;

            font-size: 14px;

            pointer-events: none;

            transition:
                color .25s ease,
                transform .25s ease;
        }


        html[data-theme="dark"]
        .input-icon {

            color:
                #7c8794;
        }


        .field input {

            width: 100%;

            height: 52px;

            padding:
                0 17px
                0 45px;

            border:
                1px solid
                var(--border);

            border-radius: 11px;

            outline: none;

            background:
                var(--input-bg);

            color:
                var(--text);

            font-family: inherit;

            font-size: 13px;

            box-shadow:
                var(--input-shadow);

            transition:
                border-color .25s ease,
                background .25s ease,
                box-shadow .25s ease,
                transform .2s ease;
        }


        .field input::placeholder {

            color:
                var(--muted);

            opacity: .8;
        }


        .field input:hover {

            border-color:
                rgba(201, 169, 97, .35);
        }


        .field input:focus {

            background:
                var(--card-bg);

            border-color:
                var(--gold);

            box-shadow:
                0 0 0 4px
                rgba(201, 169, 97, .10),

                0 8px 22px
                rgba(15, 23, 42, .06);

            transform:
                translateY(-1px);
        }


        html[data-theme="dark"]
        .field input:focus {

            box-shadow:
                0 0 0 4px
                rgba(211,181,107,.08),

                0 8px 24px
                rgba(0,0,0,.20);
        }


        .input-wrapper:focus-within
        .input-icon {

            color:
                var(--gold);

            transform:
                translateY(-50%)
                scale(1.08);
        }


        /* =========================================================
           PASSWORD BUTTON
        ========================================================= */

        .password-toggle {

            position: absolute;

            top: 50%;

            right: 14px;

            transform:
                translateY(-50%);

            width: 30px;

            height: 30px;

            display: flex;

            align-items: center;

            justify-content: center;

            border: none;

            background:
                transparent;

            color:
                var(--muted);

            cursor: pointer;

            font-size: 13px;

            padding: 0;

            box-shadow: none;

            border-radius: 7px;

            transition:
                color .2s ease,
                background .2s ease;
        }


        .password-toggle:hover {

            color:
                var(--gold);

            background:
                var(--gold-soft);

            box-shadow: none;

            transform:
                translateY(-50%);
        }


        .password-field {

            padding-right:
                45px !important;
        }


        /* =========================================================
           ERRORS
        ========================================================= */

        .field input.is-invalid {

            border-color:
                rgba(232, 93, 93, .75);

            background:
                rgba(232, 93, 93, .035);
        }


        .field input.is-invalid:focus {

            border-color:
                var(--danger);

            box-shadow:
                0 0 0 4px
                rgba(232, 93, 93, .09);
        }


        .field-error {

            display: flex;

            align-items: flex-start;

            gap: 7px;

            margin-top: 8px;

            color:
                var(--danger);

            font-size: 11.5px;

            line-height: 1.6;

            animation:
                errorEnter .3s ease both;
        }


        .field-error svg {

            width: 15px;

            height: 15px;

            flex-shrink: 0;

            margin-top: 1px;
        }


        @keyframes errorEnter {

            from {

                opacity: 0;

                transform:
                    translateY(-4px);
            }

            to {

                opacity: 1;

                transform:
                    translateY(0);
            }
        }


        /* =========================================================
           SUBMIT BUTTON
        ========================================================= */

        .login-button {

            position: relative;

            width: 100%;

            height: 53px;

            margin-top: 7px;

            overflow: hidden;

            border: none;

            border-radius: 11px;

            color:
                #17202c;

            background:
                linear-gradient(
                    135deg,
                    var(--gold-light),
                    var(--gold)
                );

            font-family:
                inherit;

            font-size: 14px;

            font-weight: 800;

            cursor: pointer;

            box-shadow:
                0 10px 25px
                rgba(201, 169, 97, .20);

            transition:
                transform .2s ease,
                box-shadow .25s ease,
                filter .25s ease;
        }


        .login-button::before {

            content: "";

            position: absolute;

            top: 0;

            bottom: 0;

            left: -100px;

            width: 70px;

            background:
                linear-gradient(
                    90deg,
                    transparent,
                    rgba(255,255,255,.38),
                    transparent
                );

            transform:
                skewX(-20deg);

            transition:
                left .55s ease;
        }


        .login-button:hover {

            transform:
                translateY(-2px);

            box-shadow:
                0 14px 32px
                rgba(201, 169, 97, .28);

            filter:
                brightness(1.03);
        }


        .login-button:hover::before {

            left:
                110%;
        }


        .login-button:active {

            transform:
                translateY(0)
                scale(.99);
        }


        .login-button i {

            margin-right: 7px;

            transition:
                transform .25s ease;
        }


        .login-button:hover i {

            transform:
                translateX(-3px);
        }


        /* =========================================================
           FOOTER
        ========================================================= */

        .login-note {

            margin-top: 22px;

            text-align: center;

            color:
                var(--muted);

            font-size: 10.5px;

            line-height: 1.8;
        }


        .login-note span {

            color:
                var(--gold-dark);

            font-weight: 700;
        }


        /* =========================================================
           TOP DECORATION
        ========================================================= */

        .corner-decoration {

            position: absolute;

            top: 0;

            right: 0;

            width: 120px;

            height: 120px;

            pointer-events: none;

            opacity: .55;
        }


        .corner-decoration::before {

            content: "";

            position: absolute;

            top: -55px;

            right: -55px;

            width: 120px;

            height: 120px;

            border-radius: 50%;

            border:
                1px solid
                rgba(201, 169, 97, .18);
        }


        /* =========================================================
           RESPONSIVE
        ========================================================= */

        @media (max-width: 900px) {

            body {

                padding: 20px;
            }


            .theme-toggle {

                top: 18px;

                right: 18px;
            }


            .login-shell {

                grid-template-columns: 1fr;

                max-width: 560px;

                min-height: auto;
            }


            .brand-panel {

                min-height: 280px;

                padding: 40px;
            }


            .brand-description {

                max-width: 100%;
            }


            .brand-footer {

                display: none;
            }


            .login-panel {

                padding:
                    45px 40px;
            }
        }


        @media (max-width: 560px) {

            body {

                padding: 12px;
            }


            .theme-toggle {

                top: 12px;

                right: 12px;

                width: 40px;

                height: 40px;
            }


            .login-shell {

                border-radius: 18px;

                margin-top: 35px;
            }


            .brand-panel {

                min-height: 245px;

                padding:
                    32px 28px;
            }


            .brand-mark {

                width: 54px;

                height: 54px;

                margin-bottom: 18px;

                font-size: 25px;
            }


            .brand-title {

                font-size: 27px;
            }


            .brand-heading {

                font-size: 19px;
            }


            .brand-description {

                font-size: 11.5px;
            }


            .login-panel {

                padding:
                    35px 25px;
            }


            .login-heading h1 {

                font-size: 24px;
            }
        }


        /* =========================================================
           REDUCE MOTION
        ========================================================= */

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
            }
        }

    </style>

</head>


<body>


    <!-- =========================================================
         THEME TOGGLE
    ========================================================== -->

    <button
        type="button"
        class="theme-toggle"
        id="themeToggle"
        aria-label="Toggle theme"
        title="Toggle theme"
    >

        <i class="fas fa-sun sun-icon"></i>

        <i class="fas fa-moon moon-icon"></i>

    </button>


    <!-- =========================================================
         BACKGROUND DECORATION
    ========================================================== -->

    <div class="background-orb orb-one"></div>

    <div class="background-orb orb-two"></div>


    <!-- =========================================================
         LOGIN SHELL
    ========================================================== -->

    <div class="login-shell">


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
                    EMPLOYEE
                </h2>


                <div class="brand-line"></div>


                <h3 class="brand-heading">
                    Management Workspace
                </h3>


                <p class="brand-description">
                    مساحة عمل مخصصة لإدارة عمليات
                    بطريقة بسيطة،
                    منظمة وآمنة.
                </p>


            </div>


            <div class="brand-footer">
                ELITE CLUB • EMPLOYEE PORTAL
            </div>


        </section>


        <!-- =====================================================
             LOGIN PANEL
        ====================================================== -->

        <section class="login-panel">


            <div class="corner-decoration"></div>


            <div class="login-content">


                <div class="login-heading">


                    <h1>
                        Sign in to your account
                    </h1>


                    <p>
                        Enter your credentials to continue.
                    </p>


                </div>


                <!-- =================================================
                     ORIGINAL FORM — LOGIC UNCHANGED
                ================================================== -->

                <form
                    method="POST"
                    action="/employee/login"
                >

                    @csrf


                    <!-- EMAIL -->

                    <div class="field">


                        <label>

                            <i class="fas fa-envelope"></i>

                            Email Address

                        </label>


                        <div class="input-wrapper">


                            <i
                                class="fas fa-envelope input-icon">
                            </i>


                            <input
                                type="email"
                                name="email"
                                placeholder="employee@example.com"
                                value="{{ old('email') }}"
                                class="{{ $errors->has('email') ? 'is-invalid' : '' }}"
                            >


                        </div>


                        @error('email')

                            <div class="field-error">


                                <svg
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    viewBox="0 0 24 24"
                                >

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                    </path>

                                </svg>


                                {{ $message }}


                            </div>

                        @enderror


                    </div>


                    <!-- PASSWORD -->

                    <div class="field">


                        <label>

                            <i class="fas fa-lock"></i>

                            Password

                        </label>


                        <div class="input-wrapper">


                            <i
                                class="fas fa-lock input-icon">
                            </i>


                            <input
                                type="password"
                                name="password"
                                id="password"
                                placeholder="••••••••"
                                class="{{ $errors->has('password') ? 'is-invalid' : '' }} password-field"
                            >


                            <button
                                type="button"
                                class="password-toggle"
                                onclick="togglePassword()"
                                aria-label="Show password"
                            >

                                <i
                                    class="fas fa-eye"
                                    id="passwordIcon">
                                </i>

                            </button>


                        </div>


                        @error('password')

                            <div class="field-error">


                                <svg
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    viewBox="0 0 24 24"
                                >

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                    </path>

                                </svg>


                                {{ $message }}


                            </div>

                        @enderror


                    </div>


                    <!-- SUBMIT -->

                    <button
                        type="submit"
                        class="login-button"
                    >

                        <i
                            class="fas fa-arrow-right-to-bracket">
                        </i>

                        Login

                    </button>


                </form>


                <div class="login-note">

                    Secure access to

                    <span>
                        Elite Club
                    </span>

                    employee workspace

                </div>


            </div>


        </section>


    </div>


    <!-- =========================================================
         THEME + PASSWORD UI
    ========================================================== -->

    <script>


        /* =====================================================
           THEME
           SAME KEY USED BY DASHBOARD / ADMIN LOGIN
        ====================================================== */

        (function () {


            const STORAGE_KEY =
                'elite-theme';


            const themeToggle =
                document.getElementById(
                    'themeToggle'
                );


            if (!themeToggle) {
                return;
            }


            themeToggle.addEventListener(
                'click',
                function () {


                    const html =
                        document.documentElement;


                    const currentTheme =
                        html.getAttribute(
                            'data-theme'
                        );


                    const newTheme =
                        currentTheme === 'dark'
                            ? 'light'
                            : 'dark';


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


        /* =====================================================
           PASSWORD VISIBILITY
           ORIGINAL LOGIC
        ====================================================== */

        function togglePassword() {


            const password =
                document.getElementById(
                    'password'
                );


            const icon =
                document.getElementById(
                    'passwordIcon'
                );


            if (password.type === 'password') {


                password.type =
                    'text';


                icon.classList.remove(
                    'fa-eye'
                );


                icon.classList.add(
                    'fa-eye-slash'
                );


            } else {


                password.type =
                    'password';


                icon.classList.remove(
                    'fa-eye-slash'
                );


                icon.classList.add(
                    'fa-eye'
                );


            }

        }


    </script>


</body>

</html>