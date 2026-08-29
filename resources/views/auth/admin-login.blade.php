<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Login | Elite Club</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* =========================================================
           ELITE CLUB LOGIN
           LIGHT / DARK THEME
        ========================================================= */

        :root {

            --navy: #111c2d;
            --navy-light: #17253a;

            --gold: #c99a35;
            --gold-dark: #b5821e;

            --page-bg: #f4f6f8;
            --card-bg: #ffffff;
            --panel-bg: #ffffff;

            --text: #172033;
            --heading: #111827;
            --muted: #7b8492;

            --border: #e0e5eb;
            --input-bg: #f8fafc;

            --brand-bg-1: #101a29;
            --brand-bg-2: #162438;

            --brand-text: #ffffff;
            --brand-muted: #aeb8c6;

            --error-bg: #fff7f7;
            --error-border: #f0cccc;
            --error-text: #a63d3d;

            --button-bg: #111c2d;
            --button-hover: #18263a;

            --shadow:
                0 25px 65px rgba(20, 30, 45, .12);

            --theme-icon-bg: rgba(255, 255, 255, .85);
        }


        /* =========================================================
           DARK MODE
        ========================================================= */

        html[data-theme="dark"] {

            --page-bg: #0b0d10;
            --card-bg: #14171a;
            --panel-bg: #14171a;

            --text: #e7ebf0;
            --heading: #f5f7fa;
            --muted: #929ba8;

            --border: rgba(255, 255, 255, .07);
            --input-bg: #0d0f11;

            --brand-bg-1: #080a0c;
            --brand-bg-2: #111519;

            --brand-text: #ffffff;
            --brand-muted: #9ba5b1;

            --error-bg: rgba(255, 62, 62, .07);
            --error-border: rgba(255, 62, 62, .22);
            --error-text: #ff7777;

            --button-bg: #00d2ff;
            --button-hover: #1bd9ff;

            --shadow:
                0 30px 80px rgba(0, 0, 0, .45);

            --theme-icon-bg: rgba(20, 23, 26, .92);
        }


        /* =========================================================
           RESET
        ========================================================= */

        * {
            box-sizing: border-box;
        }


        html,
        body {
            margin: 0;
            width: 100%;
            min-height: 100%;
        }


        html {
            color-scheme: light;
        }


        html[data-theme="dark"] {
            color-scheme: dark;
        }


        body {

            min-height: 100vh;

            font-family: "DM Sans", sans-serif;

            background: var(--page-bg);

            color: var(--text);

            overflow: hidden;

            transition:
                background .25s ease,
                color .25s ease;
        }


        button,
        input {
            font: inherit;
        }


        /* =========================================================
           PAGE
        ========================================================= */

        .login-page {

            position: relative;

            min-height: 100vh;
            height: 100vh;

            display: flex;
            align-items: center;
            justify-content: center;

            padding: 25px;

            background:
                radial-gradient(circle at 12% 12%,
                    rgba(201, 154, 53, .09),
                    transparent 28%),
                radial-gradient(circle at 90% 90%,
                    rgba(0, 210, 255, .035),
                    transparent 30%),
                var(--page-bg);

            transition:
                background .25s ease;
        }


        html[data-theme="dark"] .login-page {

            background:
                radial-gradient(circle at 12% 12%,
                    rgba(0, 210, 255, .055),
                    transparent 28%),
                radial-gradient(circle at 90% 90%,
                    rgba(201, 154, 53, .035),
                    transparent 30%),
                #0b0d10;
        }


        /* =========================================================
           THEME BUTTON
        ========================================================= */

        .theme-toggle {

            position: fixed;

            top: 24px;
            right: 24px;

            z-index: 50;

            width: 42px;
            height: 42px;

            display: grid;
            place-items: center;

            border: 1px solid var(--border);
            border-radius: 11px;

            color: var(--text);

            background: var(--theme-icon-bg);

            box-shadow:
                0 8px 25px rgba(20, 30, 45, .08);

            cursor: pointer;

            transition:
                .2s ease;

            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }


        .theme-toggle:hover {

            transform: translateY(-2px);

            border-color:
                rgba(201, 154, 53, .45);

            color: var(--gold);

            box-shadow:
                0 10px 28px rgba(20, 30, 45, .12);
        }


        html[data-theme="dark"] .theme-toggle {

            border-color:
                rgba(255, 255, 255, .07);

            color: #cbd3dc;

            background:
                rgba(20, 23, 26, .9);

            box-shadow:
                0 10px 30px rgba(0, 0, 0, .25);
        }


        html[data-theme="dark"] .theme-toggle:hover {

            color: #00d2ff;

            border-color:
                rgba(0, 210, 255, .35);

            box-shadow:
                0 0 20px rgba(0, 210, 255, .08);
        }


        .theme-toggle svg {

            width: 19px;
            height: 19px;
        }


        .sun-icon {
            display: none;
        }


        .moon-icon {
            display: block;
        }


        html[data-theme="dark"] .sun-icon {
            display: block;
        }


        html[data-theme="dark"] .moon-icon {
            display: none;
        }


        /* =========================================================
           CARD
        ========================================================= */

        .login-card {

            width: min(100%, 900px);

            min-height: 500px;

            display: grid;

            grid-template-columns: 42% 58%;

            overflow: hidden;

            border:
                1px solid var(--border);

            border-radius: 20px;

            background: var(--card-bg);

            box-shadow: var(--shadow);

            transition:
                background .25s ease,
                border-color .25s ease,
                box-shadow .25s ease;
        }


        /* =========================================================
           LEFT BRAND PANEL
        ========================================================= */

        .brand-panel {

            position: relative;

            display: flex;
            flex-direction: column;
            align-items: flex-start;
            justify-content: center;

            padding: 50px;

            color: var(--brand-text);

            background:
                radial-gradient(circle at 20% 10%,
                    rgba(201, 154, 53, .14),
                    transparent 35%),
                linear-gradient(145deg,
                    var(--brand-bg-1) 0%,
                    var(--brand-bg-2) 100%);

            overflow: hidden;
        }


        html[data-theme="dark"] .brand-panel {

            background:
                radial-gradient(circle at 20% 10%,
                    rgba(0, 210, 255, .08),
                    transparent 35%),
                radial-gradient(circle at 80% 90%,
                    rgba(201, 154, 53, .07),
                    transparent 35%),
                linear-gradient(145deg,
                    #080a0c 0%,
                    #111519 100%);
        }


        .brand-panel::before {

            content: "";

            position: absolute;

            width: 330px;
            height: 330px;

            left: -210px;
            top: -210px;

            border:
                1px solid rgba(201, 154, 53, .10);

            border-radius: 50%;
        }


        .brand-panel::after {

            content: "";

            position: absolute;

            width: 260px;
            height: 260px;

            right: -130px;
            bottom: -130px;

            border:
                1px solid rgba(201, 154, 53, .15);

            border-radius: 50%;
        }


        html[data-theme="dark"] .brand-panel::after {

            border-color:
                rgba(0, 210, 255, .10);
        }


        /* =========================================================
           BRAND MARK
        ========================================================= */

        .brand-mark {

            width: 58px;
            height: 58px;

            display: grid;
            place-items: center;

            border:
                1px solid rgba(201, 154, 53, .75);

            border-radius: 15px;

            color: var(--gold);

            font-family: Georgia, serif;

            font-size: 30px;
            font-weight: 400;

            margin-bottom: 22px;

            background:
                rgba(255, 255, 255, .025);

            box-shadow:
                0 0 25px rgba(201, 154, 53, .06);
        }


        html[data-theme="dark"] .brand-mark {

            border-color:
                rgba(0, 210, 255, .55);

            color: #00d2ff;

            box-shadow:
                0 0 25px rgba(0, 210, 255, .08);
        }


        /* =========================================================
           BRAND TITLE
        ========================================================= */

        .brand-title {

            margin: 0;

            color: #ffffff;

            font-family: Georgia, serif;

            font-size: 29px;
            font-weight: 600;

            letter-spacing: .10em;
        }


        .brand-sub {

            margin-top: 7px;

            color: var(--gold);

            font-size: 11px;
            font-weight: 600;

            letter-spacing: .32em;
        }


        html[data-theme="dark"] .brand-sub {

            color: #00d2ff;
        }


        .brand-line {

            width: 42px;
            height: 2px;

            margin: 27px 0 20px;

            background: var(--gold);

            box-shadow:
                0 0 10px rgba(201, 154, 53, .25);
        }


        html[data-theme="dark"] .brand-line {

            background: #00d2ff;

            box-shadow:
                0 0 10px rgba(0, 210, 255, .35);
        }


        .brand-heading {

            margin: 0;

            color: #ffffff;

            font-size: 20px;
            font-weight: 600;
        }


        .brand-description {

            max-width: 250px;

            margin: 10px 0 0;

            color: var(--brand-muted);

            font-size: 13px;
            line-height: 1.7;
        }


        /* =========================================================
           RIGHT FORM PANEL
        ========================================================= */

        .form-panel {

            display: flex;
            align-items: center;

            padding: 55px;

            background: var(--panel-bg);

            transition:
                background .25s ease;
        }


        .login-content {

            width: 100%;
            max-width: 440px;

            margin: auto;
        }


        /* =========================================================
           LOGIN HEADER
        ========================================================= */

        .login-header {

            margin-bottom: 30px;
        }


        .login-header-title {

            margin: 0;

            color: var(--heading);

            font-size: 25px;
            font-weight: 700;

            letter-spacing: -.025em;
        }


        .login-header-text {

            margin: 7px 0 0;

            color: var(--muted);

            font-size: 14px;
        }


        /* =========================================================
           ERRORS
        ========================================================= */

        .login-error {

            margin-bottom: 18px;

            padding: 11px 13px;

            border:
                1px solid var(--error-border);

            border-radius: 9px;

            color: var(--error-text);

            background: var(--error-bg);

            font-size: 13px;
        }


        .login-error ul {

            margin: 0;

            padding-left: 18px;
        }


        /* =========================================================
           FIELDS
        ========================================================= */

        .field {

            margin-bottom: 18px;
        }


        .field-label {

            display: block;

            margin-bottom: 8px;

            color: var(--text);

            font-size: 13px;
            font-weight: 600;
        }


        .input-wrap {

            position: relative;

            display: flex;
            align-items: center;
        }


        .input-icon {

            position: absolute;

            left: 15px;

            width: 18px;
            height: 18px;

            color: #8994a4;

            pointer-events: none;

            transition:
                color .2s ease;
        }


        html[data-theme="dark"] .input-icon {
            color: #69737f;
        }


        .input-wrap input {

            width: 100%;
            height: 48px;

            padding:
                0 46px 0 44px;

            border:
                1px solid var(--border);

            border-radius: 9px;

            outline: none;

            color: var(--text);

            background: var(--input-bg);

            transition:
                .2s ease;
        }


        .input-wrap input::placeholder {

            color:
                #a0a8b4;
        }


        html[data-theme="dark"] .input-wrap input::placeholder {

            color:
                #626b76;
        }


        .input-wrap input:focus {

            border-color:
                rgba(201, 154, 53, .75);

            background:
                var(--card-bg);

            box-shadow:
                0 0 0 3px rgba(201, 154, 53, .09);
        }


        html[data-theme="dark"] .input-wrap input:focus {

            border-color:
                rgba(0, 210, 255, .55);

            box-shadow:
                0 0 0 3px rgba(0, 210, 255, .07),
                0 0 18px rgba(0, 210, 255, .035);
        }


        .input-wrap input.is-invalid {

            border-color:
                #df7777;
        }


        /* =========================================================
           PASSWORD TOGGLE
        ========================================================= */

        .password-toggle {

            position: absolute;

            right: 7px;

            width: 36px;
            height: 36px;

            display: grid;
            place-items: center;

            border: 0;

            color: #8b95a4;

            background: transparent;

            cursor: pointer;

            border-radius: 8px;

            transition:
                .2s ease;
        }


        .password-toggle:hover {

            color: var(--gold);

            background:
                rgba(201, 154, 53, .07);
        }


        html[data-theme="dark"] .password-toggle:hover {

            color: #00d2ff;

            background:
                rgba(0, 210, 255, .06);
        }


        .password-toggle svg {

            width: 19px;
            height: 19px;
        }


        /* =========================================================
           FIELD ERROR
        ========================================================= */

        .field-error {

            display: flex;
            align-items: center;
            gap: 6px;

            margin-top: 7px;

            color: var(--error-text);

            font-size: 12px;
        }


        .field-error svg {

            width: 14px;
            height: 14px;

            flex-shrink: 0;
        }


        /* =========================================================
           OPTIONS
        ========================================================= */

        .form-options {

            display: flex;
            align-items: center;
            justify-content: space-between;

            margin-top: 5px;
        }


        .remember {

            display: flex;
            align-items: center;
            gap: 8px;

            color: var(--muted);

            font-size: 13px;

            cursor: pointer;
        }


        .remember input {

            appearance: none;

            width: 17px;
            height: 17px;

            margin: 0;

            border:
                1px solid #cbd1d9;

            border-radius: 4px;

            background:
                var(--card-bg);

            cursor: pointer;

            transition:
                .2s ease;
        }


        html[data-theme="dark"] .remember input {

            border-color:
                rgba(255, 255, 255, .12);
        }


        .remember input:checked {

            border-color:
                var(--gold);

            background:
                var(--gold);
        }


        html[data-theme="dark"] .remember input:checked {

            border-color:
                #00d2ff;

            background:
                #00d2ff;
        }


        .remember input:checked::after {

            content: "";

            position: relative;

            display: block;

            width: 5px;
            height: 9px;

            margin: 2px auto 0;

            border:
                solid #ffffff;

            border-width:
                0 2px 2px 0;

            transform:
                rotate(45deg);
        }


        .forgot-password {

            color: var(--gold-dark);

            font-size: 13px;
            font-weight: 600;

            text-decoration: none;

            transition:
                .2s ease;
        }


        .forgot-password:hover {

            color:
                #946c17;
        }


        html[data-theme="dark"] .forgot-password {

            color:
                #00d2ff;
        }


        html[data-theme="dark"] .forgot-password:hover {

            color:
                #49dcff;
        }


        /* =========================================================
           SIGN IN BUTTON
        ========================================================= */

        .login-button {

            width: 100%;
            height: 48px;

            margin-top: 22px;

            display: flex;
            align-items: center;
            justify-content: center;

            gap: 9px;

            border: 0;

            border-radius: 9px;

            color: #ffffff;

            background:
                var(--button-bg);

            box-shadow:
                0 9px 20px rgba(16, 25, 39, .14);

            font-size: 14px;
            font-weight: 700;

            cursor: pointer;

            transition:
                .2s ease;
        }


        .login-button:hover {

            transform:
                translateY(-1px);

            background:
                var(--button-hover);

            box-shadow:
                0 12px 24px rgba(16, 25, 39, .18);
        }


        html[data-theme="dark"] .login-button {

            color: #071015;

            background:
                #00d2ff;

            box-shadow:
                0 0 22px rgba(0, 210, 255, .10),
                0 10px 25px rgba(0, 0, 0, .22);
        }


        html[data-theme="dark"] .login-button:hover {

            color: #071015;

            background:
                #1bd9ff;

            box-shadow:
                0 0 28px rgba(0, 210, 255, .16),
                0 12px 28px rgba(0, 0, 0, .28);
        }


        .login-button svg {

            width: 18px;
            height: 18px;
        }


        /* =========================================================
           LAPTOP
        ========================================================= */

        @media (max-width: 1000px) {

            .login-card {

                width:
                    min(100%, 850px);
            }


            .brand-panel {

                padding: 40px;
            }


            .form-panel {

                padding: 42px;
            }
        }


        /* =========================================================
           SMALL LAPTOP
        ========================================================= */

        @media (max-height: 750px) and (min-width: 701px) {

            .login-page {

                padding: 18px;
            }


            .login-card {

                min-height: 450px;
            }


            .brand-panel {

                padding: 35px;
            }


            .brand-mark {

                width: 52px;
                height: 52px;

                margin-bottom: 17px;

                font-size: 27px;
            }


            .brand-title {

                font-size: 25px;
            }


            .brand-line {

                margin: 20px 0 15px;
            }


            .form-panel {

                padding:
                    35px 42px;
            }


            .login-header {

                margin-bottom: 22px;
            }


            .field {

                margin-bottom: 14px;
            }


            .input-wrap input {

                height: 45px;
            }


            .login-button {

                height: 45px;

                margin-top: 17px;
            }
        }


        /* =========================================================
           MOBILE
        ========================================================= */

        @media (max-width: 700px) {

            body {

                overflow-y: auto;
            }


            .login-page {

                height: auto;

                min-height: 100vh;

                padding: 15px;
            }


            .theme-toggle {

                top: 14px;
                right: 14px;

                width: 40px;
                height: 40px;
            }


            .login-card {

                width: 100%;

                min-height: auto;

                grid-template-columns: 1fr;

                border-radius: 16px;

                margin-top: 35px;
            }


            .brand-panel {

                padding:
                    30px 25px;
            }


            .brand-description,
            .brand-heading,
            .brand-line {

                display: none;
            }


            .brand-mark {

                width: 50px;
                height: 50px;

                margin-bottom: 15px;
            }


            .brand-title {

                font-size: 24px;
            }


            .form-panel {

                padding:
                    30px 23px;
            }


            .login-header-title {

                font-size: 23px;
            }
        }


        /* =========================================================
           REDUCE MOTION
        ========================================================= */

        @media (prefers-reduced-motion: reduce) {

            *,
            *::before,
            *::after {

                transition: none !important;
                animation: none !important;
            }
        }
    </style>

    <!--
        Apply saved theme BEFORE page paint.
        This prevents the page from flashing light mode
        before switching to dark mode.
    -->

    <script>
        (function() {

            const savedTheme =
                localStorage.getItem('elite-theme');

            if (savedTheme === 'dark') {

                document.documentElement
                    .setAttribute('data-theme', 'dark');

            } else {

                document.documentElement
                    .setAttribute('data-theme', 'light');
            }

        })();
    </script>

</head>


<body>


    <main class="login-page">


        <!-- =========================================================
         THEME TOGGLE
    ========================================================== -->

        <button type="button" class="theme-toggle" id="themeToggle" aria-label="Toggle theme">

            <!-- SUN -->

            <svg class="sun-icon" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24">

                <circle cx="12" cy="12" r="4" />

                <path stroke-linecap="round" d="M12 2v2" />

                <path stroke-linecap="round" d="M12 20v2" />

                <path stroke-linecap="round" d="m4.93 4.93 1.41 1.41" />

                <path stroke-linecap="round" d="m17.66 17.66 1.41 1.41" />

                <path stroke-linecap="round" d="M2 12h2" />

                <path stroke-linecap="round" d="M20 12h2" />

                <path stroke-linecap="round" d="m6.34 17.66-1.41 1.41" />

                <path stroke-linecap="round" d="m19.07 4.93-1.41 1.41" />

            </svg>


            <!-- MOON -->

            <svg class="moon-icon" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24">

                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M20.5 14.2A8.5 8.5 0 0 1 9.8 3.5 8.5 8.5 0 1 0 20.5 14.2Z" />

            </svg>

        </button>


        <!-- =========================================================
         LOGIN CARD
    ========================================================== -->

        <div class="login-card">


            <!-- =====================================================
             LEFT BRAND PANEL
        ====================================================== -->

            <section class="brand-panel">


                <div class="brand-mark">
                    E
                </div>


                <h1 class="brand-title">
                    ELITE CLUB
                </h1>


                <div class="brand-sub">
                    ADMIN PANEL
                </div>


                <div class="brand-line"></div>


                <h2 class="brand-heading">
                    Management System
                </h2>


                <p class="brand-description">
                    A simple and secure workspace to manage
                    Elite Club operations.
                </p>


            </section>


            <!-- =====================================================
             RIGHT LOGIN
        ====================================================== -->

            <section class="form-panel">


                <div class="login-content">


                    <!-- LOGIN HEADER -->

                    <div class="login-header">


                        <h2 class="login-header-title">
                            Sign in to your account
                        </h2>


                        <p class="login-header-text">
                            Enter your credentials to continue.
                        </p>


                    </div>


                    <!-- =================================================
                     VALIDATION ERRORS
                ================================================== -->

                    @if ($errors->any())

                        <div class="login-error">

                            <ul>

                                @foreach ($errors->all() as $error)
                                    <li>
                                        {{ $error }}
                                    </li>
                                @endforeach

                            </ul>

                        </div>

                    @endif


                    <!-- =================================================
                     LOGIN FORM
                ================================================== -->

                    <form method="POST" action="{{ url('/admin/login') }}">

                        @csrf


                        <!-- EMAIL -->

                        <div class="field">


                            <label class="field-label" for="email">
                                Email Address
                            </label>


                            <div class="input-wrap">


                                <svg class="input-icon" fill="none" stroke="currentColor" stroke-width="1.7"
                                    viewBox="0 0 24 24">

                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3 7.5A2.5 2.5 0 0 1 5.5 5h13A2.5 2.5 0 0 1 21 7.5v9a2.5 2.5 0 0 1-2.5 2.5h-13A2.5 2.5 0 0 1 3 16.5z" />

                                    <path stroke-linecap="round" stroke-linejoin="round" d="m3.5 7 8.5 6 8.5-6" />

                                </svg>


                                <input type="email" id="email" name="email" value="{{ old('email') }}"
                                    placeholder="Enter your email" autocomplete="email"
                                    class="{{ $errors->has('email') ? 'is-invalid' : '' }}" required>


                            </div>


                            @error('email')
                                <div class="field-error">


                                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">

                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01" />

                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M3.34 16.5 10.268 4.5a2 2 0 0 1 3.464 0l6.928 12A2 2 0 0 1 18.928 19H5.072a2 2 0 0 1-1.732-2.5Z" />

                                    </svg>


                                    {{ $message }}


                                </div>
                            @enderror


                        </div>


                        <!-- PASSWORD -->

                        <div class="field">


                            <label class="field-label" for="password">
                                Password
                            </label>


                            <div class="input-wrap">


                                <svg class="input-icon" fill="none" stroke="currentColor" stroke-width="1.7"
                                    viewBox="0 0 24 24">

                                    <rect x="5" y="10" width="14" height="10" rx="2" />

                                    <path stroke-linecap="round" d="M8 10V7a4 4 0 0 1 8 0v3" />

                                    <circle cx="12" cy="15" r="1.2" />

                                </svg>


                                <input type="password" id="password" name="password"
                                    placeholder="Enter your password" autocomplete="current-password"
                                    class="{{ $errors->has('password') ? 'is-invalid' : '' }}" required>


                                <button type="button" class="password-toggle" id="togglePassword"
                                    aria-label="Show password">

                                    <svg id="eyeIcon" fill="none" stroke="currentColor" stroke-width="1.7"
                                        viewBox="0 0 24 24">

                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.25 12s3.5-6.75 9.75-6.75S21.75 12 21.75 12 18.25 18.75 12 18.75 2.25 12 2.25 12Z" />

                                        <circle cx="12" cy="12" r="3" />

                                    </svg>

                                </button>


                            </div>


                            @error('password')
                                <div class="field-error">


                                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">

                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01" />

                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M3.34 16.5 10.268 4.5a2 2 0 0 1 3.464 0l6.928 12A2 2 0 0 1 18.928 19H5.072a2 2 0 0 1-1.732-2.5Z" />

                                    </svg>


                                    {{ $message }}


                                </div>
                            @enderror


                        </div>


                        <!-- OPTIONS -->

                        <div class="form-options">


                            <label class="remember">


                                <input type="checkbox" name="remember" value="1"
                                    {{ old('remember') ? 'checked' : '' }}>


                                <span>
                                    Remember me
                                </span>


                            </label>


                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="forgot-password">
                                    Forgot password?
                                </a>
                            @endif


                        </div>


                        <!-- SIGN IN -->

                        <button type="submit" class="login-button">


                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">

                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M13 5h6a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1h-6" />

                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 12h11" />

                                <path stroke-linecap="round" stroke-linejoin="round" d="m11 8 4 4-4 4" />

                            </svg>


                            <span>
                                Sign In
                            </span>


                        </button>


                    </form>


                </div>


            </section>


        </div>


    </main>


    <script>
        document.addEventListener('DOMContentLoaded', function() {


            /* =========================================================
               THEME
            ========================================================== */

            const themeToggle =
                document.getElementById('themeToggle');


            const html =
                document.documentElement;


            if (themeToggle) {

                themeToggle.addEventListener(
                    'click',
                    function() {

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
                            'elite-theme',
                            newTheme
                        );

                    }
                );

            }


            /* =========================================================
               PASSWORD
            ========================================================== */

            const password =
                document.getElementById('password');


            const toggle =
                document.getElementById('togglePassword');


            const eyeIcon =
                document.getElementById('eyeIcon');


            if (!toggle || !password) {
                return;
            }


            toggle.addEventListener(
                'click',
                function() {


                    const isPassword =
                        password.type === 'password';


                    password.type =
                        isPassword ?
                        'text' :
                        'password';


                    if (isPassword) {


                        eyeIcon.innerHTML = `

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M3 3l18 18"
                    />

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M10.58 10.58A2 2 0 0 0 13.42 13.42"
                    />

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M9.88 5.09A10.94 10.94 0 0 1 12 4.75c6.25 0 9.75 7.25 9.75 7.25a17.65 17.65 0 0 1-3.06 4.24"
                    />

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M6.61 6.61C3.92 8.46 2.25 12 2.25 12s3.5 7.25 9.75 7.25c1.73 0 3.31-.5 4.69-1.3"
                    />

                `;


                        toggle.setAttribute(
                            'aria-label',
                            'Hide password'
                        );


                    } else {


                        eyeIcon.innerHTML = `

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M2.25 12s3.5-6.75 9.75-6.75S21.75 12 21.75 12 18.25 18.75 12 18.75 2.25 12 2.25 12Z"
                    />

                    <circle
                        cx="12"
                        cy="12"
                        r="3"
                    />

                `;


                        toggle.setAttribute(
                            'aria-label',
                            'Show password'
                        );

                    }


                }
            );


        });
    </script>


</body>

</html>
