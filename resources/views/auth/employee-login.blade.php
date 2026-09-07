<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Employee Login | Elite Club</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link
        href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800;900&family=Playfair+Display:wght@600;700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">


    <!-- =========================================================
         APPLY SAVED THEME BEFORE PAGE PAINT
    ========================================================== -->

    <script>
        (function() {

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
           ELITE CLUB — EMPLOYEE LOGIN
           PREMIUM / RESPONSIVE / LIGHT + DARK
        ========================================================== */

        :root {

            --page-bg:
                radial-gradient(circle at 12% 12%,
                    rgba(201, 169, 97, .13),
                    transparent 28%),
                radial-gradient(circle at 88% 88%,
                    rgba(15, 29, 48, .08),
                    transparent 30%),
                #f3f5f7;

            --card-bg: #ffffff;

            --panel-bg:
                linear-gradient(145deg,
                    #0b1625 0%,
                    #13243a 52%,
                    #091321 100%);

            --input-bg: #f8fafc;

            --border: #dfe5eb;

            --text: #17202b;

            --text-soft: #596575;

            --muted: #7d8897;

            --gold: #c9a961;

            --gold-light: #e5cc8c;

            --gold-dark: #a9823d;

            --gold-soft:
                rgba(201, 169, 97, .10);

            --danger: #dc5b5b;

            --shadow:
                0 35px 90px rgba(15, 23, 42, .13);

            --input-shadow:
                0 5px 18px rgba(15, 23, 42, .035);

            --radius: 25px;

            --theme-button-bg:
                rgba(255, 255, 255, .92);

            --theme-button-border:
                rgba(15, 23, 42, .09);

            --theme-button-text:
                #596575;
        }


        /* =========================================================
           DARK MODE
        ========================================================== */

        html[data-theme="dark"] {

            --page-bg:
                radial-gradient(circle at 12% 12%,
                    rgba(201, 169, 97, .075),
                    transparent 28%),
                radial-gradient(circle at 88% 88%,
                    rgba(0, 210, 255, .035),
                    transparent 30%),
                #0b1016;

            --card-bg: #171c23;

            --input-bg: #20262e;

            --border: #303843;

            --text: #f3f5f7;

            --text-soft: #c0c7d0;

            --muted: #858f9c;

            --gold: #d3b56b;

            --gold-light: #e7cc85;

            --gold-dark: #b48c42;

            --gold-soft:
                rgba(211, 181, 107, .10);

            --danger: #ed6b6b;

            --shadow:
                0 40px 100px rgba(0, 0, 0, .48);

            --input-shadow:
                0 8px 24px rgba(0, 0, 0, .14);

            --theme-button-bg:
                rgba(31, 37, 45, .96);

            --theme-button-border:
                rgba(255, 255, 255, .08);

            --theme-button-text:
                #d8dee6;
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

            padding: 42px;

            overflow-x: hidden;

            transition:
                background .3s ease,
                color .3s ease;
        }


        button,
        input {

            font-family: inherit;
        }


        /* =========================================================
           THEME BUTTON
        ========================================================== */

        .theme-toggle {

            position: fixed;

            top: 25px;

            right: 25px;

            z-index: 100;

            width: 46px;

            height: 46px;

            display: flex;

            align-items: center;

            justify-content: center;

            border:
                1px solid var(--theme-button-border);

            border-radius: 13px;

            color:
                var(--theme-button-text);

            background:
                var(--theme-button-bg);

            cursor: pointer;

            box-shadow:
                0 9px 28px rgba(15, 23, 42, .09);

            backdrop-filter:
                blur(14px);

            -webkit-backdrop-filter:
                blur(14px);

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
                rgba(201, 169, 97, .45);

            box-shadow:
                0 12px 32px rgba(15, 23, 42, .13);
        }


        html[data-theme="dark"] .theme-toggle:hover {

            color:
                #00d2ff;

            border-color:
                rgba(0, 210, 255, .35);

            box-shadow:
                0 0 24px rgba(0, 210, 255, .08);
        }


        .theme-toggle i {

            font-size: 16px;

            transition:
                transform .25s ease;
        }
/* =========================================================
   BACK TO WELCOME
========================================================== */

.back-welcome {

    position: fixed;

    top: 25px;

    left: 25px;

    z-index: 100;

    height: 46px;

    padding: 0 15px;

    display: flex;

    align-items: center;

    justify-content: center;

    gap: 8px;

    border:
        1px solid var(--theme-button-border);

    border-radius: 13px;

    color:
        var(--theme-button-text);

    background:
        var(--theme-button-bg);

    text-decoration: none;

    cursor: pointer;

    font-size: 12px;

    font-weight: 700;

    box-shadow:
        0 9px 28px rgba(15, 23, 42, .09);

    backdrop-filter:
        blur(14px);

    -webkit-backdrop-filter:
        blur(14px);

    transition:
        transform .2s ease,
        color .2s ease,
        border-color .2s ease,
        background .3s ease,
        box-shadow .2s ease;
}


.back-welcome:hover {

    transform:
        translateY(-2px);

    color:
        var(--gold);

    border-color:
        rgba(201, 169, 97, .45);

    box-shadow:
        0 12px 32px rgba(15, 23, 42, .13);
}


html[data-theme="dark"] .back-welcome:hover {

    color:
        #00d2ff;

    border-color:
        rgba(0, 210, 255, .35);

    box-shadow:
        0 0 24px rgba(0, 210, 255, .08);
}


.back-welcome i {

    font-size: 13px;
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

            opacity: .19;

            z-index: 0;

            animation:
                orbFloat 9s ease-in-out infinite;
        }


        .orb-one {

            top: -145px;

            left: -115px;

            background:
                var(--gold);
        }


        .orb-two {

            right: -115px;

            bottom: -165px;

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
           MAIN SHELL
        ========================================================== */

        .login-shell {

            position: relative;

            z-index: 2;

            width:
                min(1080px, 100%);

            min-height: 640px;

            display: grid;

            grid-template-columns:
                minmax(350px, .88fr) minmax(450px, 1.12fr);

            background:
                var(--card-bg);

            border:
                1px solid var(--border);

            border-radius:
                var(--radius);

            overflow: hidden;

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
                60px 52px;

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

            width: 360px;

            height: 360px;

            right: -175px;

            bottom: -175px;

            border:
                1px solid rgba(201, 169, 97, .25);

            border-radius: 50%;

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
                brandEnter .8s .15s cubic-bezier(.16, 1, .3, 1) both;
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
           BRAND MARK
        ========================================================== */

        .brand-mark {

            width: 70px;

            height: 70px;

            display: flex;

            align-items: center;

            justify-content: center;

            margin-bottom: 26px;

            border:
                1px solid rgba(201, 169, 97, .55);

            border-radius: 19px;

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

            font-size: 33px;

            transition:
                transform .3s ease,
                box-shadow .3s ease;
        }


        .brand-mark:hover {

            transform:
                translateY(-4px) rotate(-2deg);

            box-shadow:
                0 12px 38px rgba(201, 169, 97, .16);
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

            font-size: 38px;

            letter-spacing: 3px;

            line-height: 1.2;

            margin-bottom: 14px;
        }


        .brand-line {

            width: 58px;

            height: 2px;

            margin-bottom: 30px;

            background:
                linear-gradient(90deg,
                    var(--gold-light),
                    transparent);
        }


        .brand-heading {

            font-size: 25px;

            font-weight: 800;

            line-height: 1.5;

            margin-bottom: 14px;
        }


        .brand-description {

            max-width: 340px;

            color: #b3bfd0;

            font-size: 13.5px;

            font-weight: 500;

            line-height: 2;
        }


        .brand-footer {

            position: absolute;

            right: 52px;

            bottom: 31px;

            color:
                rgba(255, 255, 255, .38);

            font-size: 10px;

            font-weight: 600;

            letter-spacing: 1px;
        }


        /* =========================================================
           LOGIN PANEL
        ========================================================== */

        .login-panel {

            position: relative;

            padding:
                62px 64px 50px;

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
                formEnter .75s .1s cubic-bezier(.16, 1, .3, 1) both;
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


        /* =========================================================
           LOGIN HEADING
        ========================================================== */

        .login-heading {

            margin-bottom: 34px;
        }


        .login-heading h1 {

            font-size: 30px;

            font-weight: 900;

            line-height: 1.4;

            margin-bottom: 8px;

            color:
                var(--text);

            letter-spacing: -.4px;
        }


        .login-heading p {

            color:
                var(--muted);

            font-size: 13.5px;

            font-weight: 500;

            line-height: 1.9;
        }


        .login-heading::after {

            content: "";

            display: block;

            width: 44px;

            height: 3px;

            margin-top: 16px;

            background:
                linear-gradient(90deg,
                    var(--gold),
                    var(--gold-light));

            border-radius: 20px;
        }


        /* =========================================================
           FORM
        ========================================================== */

        .field {

            margin-bottom: 22px;

            animation:
                fieldEnter .55s cubic-bezier(.16, 1, .3, 1) both;
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

            gap: 8px;

            margin-bottom: 9px;

            color:
                var(--text);

            font-size: 13px;

            font-weight: 800;

            line-height: 1.5;
        }


        .field label i {

            color:
                var(--gold);

            font-size: 11px;
        }


        /* =========================================================
           INPUT
        ========================================================== */

        .input-wrapper {

            position: relative;
        }


        .input-icon {

            position: absolute;

            top: 50%;

            left: 16px;

            transform:
                translateY(-50%);

            color:
                #929eac;

            font-size: 15px;

            pointer-events: none;

            transition:
                color .25s ease,
                transform .25s ease;
        }


        html[data-theme="dark"] .input-icon {

            color:
                #7d8794;
        }


        .field input {

            width: 100%;

            height: 56px;

            padding:
                0 18px 0 47px;

            border:
                1px solid var(--border);

            border-radius: 12px;

            outline: none;

            background:
                var(--input-bg);

            color:
                var(--text);

            font-family: inherit;

            font-size: 13.5px;

            font-weight: 500;

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

            opacity: .75;
        }


        .field input:hover {

            border-color:
                rgba(201, 169, 97, .38);
        }


        .field input:focus {

            background:
                var(--card-bg);

            border-color:
                var(--gold);

            box-shadow:
                0 0 0 4px rgba(201, 169, 97, .10),

                0 9px 25px rgba(15, 23, 42, .06);

            transform:
                translateY(-1px);
        }


        html[data-theme="dark"] .field input:focus {

            box-shadow:
                0 0 0 4px rgba(211, 181, 107, .08),

                0 9px 26px rgba(0, 0, 0, .20);
        }


        .input-wrapper:focus-within .input-icon {

            color:
                var(--gold);

            transform:
                translateY(-50%) scale(1.08);
        }


        /* =========================================================
           PASSWORD
        ========================================================== */

        .password-toggle {

            position: absolute;

            top: 50%;

            right: 13px;

            transform:
                translateY(-50%);

            width: 33px;

            height: 33px;

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

            border-radius: 8px;

            transition:
                color .2s ease,
                background .2s ease;
        }


        .password-toggle:hover {

            color:
                var(--gold);

            background:
                var(--gold-soft);

            transform:
                translateY(-50%);
        }


        .password-field {

            padding-right:
                50px !important;
        }


        /* =========================================================
           ERRORS
        ========================================================== */

        .field input.is-invalid {

            border-color:
                rgba(220, 91, 91, .72);

            background:
                rgba(220, 91, 91, .035);
        }


        .field input.is-invalid:focus {

            border-color:
                var(--danger);

            box-shadow:
                0 0 0 4px rgba(220, 91, 91, .09);
        }


        .field-error {

            display: flex;

            align-items: flex-start;

            gap: 7px;

            margin-top: 8px;

            color:
                var(--danger);

            font-size: 11.5px;

            font-weight: 600;

            line-height: 1.7;

            animation:
                errorEnter .3s ease both;
        }


        .field-error svg {

            width: 15px;

            height: 15px;

            flex-shrink: 0;

            margin-top: 2px;
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
           LOGIN BUTTON
        ========================================================== */

        .login-button {

            position: relative;

            width: 100%;

            height: 56px;

            margin-top: 8px;

            overflow: hidden;

            border: none;

            border-radius: 12px;

            color:
                #17202c;

            background:
                linear-gradient(135deg,
                    var(--gold-light),
                    var(--gold));

            font-family:
                inherit;

            font-size: 14px;

            font-weight: 900;

            cursor: pointer;

            box-shadow:
                0 11px 27px rgba(201, 169, 97, .21);

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

            width: 75px;

            background:
                linear-gradient(90deg,
                    transparent,
                    rgba(255, 255, 255, .40),
                    transparent);

            transform:
                skewX(-20deg);

            transition:
                left .55s ease;
        }


        .login-button:hover {

            transform:
                translateY(-2px);

            box-shadow:
                0 15px 34px rgba(201, 169, 97, .29);

            filter:
                brightness(1.04);
        }


        .login-button:hover::before {

            left:
                110%;
        }


        .login-button:active {

            transform:
                translateY(0) scale(.99);
        }


        .login-button i {

            margin-right: 8px;

            transition:
                transform .25s ease;
        }


        .login-button:hover i {

            transform:
                translateX(-3px);
        }


        /* =========================================================
           SECURITY NOTE
        ========================================================== */

        .login-note {

            display: flex;

            align-items: center;

            justify-content: center;

            gap: 4px;

            margin-top: 23px;

            text-align: center;

            color:
                var(--muted);

            font-size: 10.5px;

            font-weight: 500;

            line-height: 1.8;
        }


        .login-note span {

            color:
                var(--gold-dark);

            font-weight: 800;
        }


        .login-note::before {

            content:
                "\f023";

            font-family:
                "Font Awesome 6 Free";

            font-weight:
                900;

            color:
                var(--gold);

            font-size: 9px;

            margin-right: 2px;
        }


        /* =========================================================
           CORNER DECORATION
        ========================================================== */

        .corner-decoration {

            position: absolute;

            top: 0;

            right: 0;

            width: 135px;

            height: 135px;

            pointer-events: none;

            opacity: .60;
        }


        .corner-decoration::before {

            content: "";

            position: absolute;

            top: -62px;

            right: -62px;

            width: 135px;

            height: 135px;

            border-radius: 50%;

            border:
                1px solid rgba(201, 169, 97, .18);
        }


        .corner-decoration::after {

            content: "";

            position: absolute;

            top: 20px;

            right: 20px;

            width: 5px;

            height: 5px;

            border-radius: 50%;

            background:
                var(--gold);

            box-shadow:
                0 0 0 5px rgba(201, 169, 97, .06);
        }


        /* =========================================================
           TABLET
        ========================================================== */

        @media (max-width: 1000px) {

            body {

                padding: 25px;
            }


            .login-shell {

                width: min(900px, 100%);

                grid-template-columns:
                    minmax(300px, .85fr) minmax(390px, 1.15fr);

                min-height: 590px;
            }


            .brand-panel {

                padding:
                    45px 38px;
            }


            .brand-title {

                font-size: 33px;
            }


            .brand-heading {

                font-size: 22px;
            }


            .login-panel {

                padding:
                    45px 42px;
            }


            .login-heading h1 {

                font-size: 27px;
            }
        }


        /* =========================================================
           TABLET / SMALL LAPTOP
        ========================================================== */

        @media (max-width: 820px) {

            body {

                padding: 20px;
            }


            .theme-toggle {

                top: 17px;

                right: 17px;
            }


            .login-shell {

                grid-template-columns: 1fr;

                max-width: 570px;

                min-height: auto;
            }


            .brand-panel {

                min-height: 295px;

                padding:
                    42px 42px;
            }


            .brand-mark {

                width: 62px;

                height: 62px;

                margin-bottom: 20px;

                font-size: 29px;
            }


            .brand-small {

                font-size: 10px;

                letter-spacing: 3.5px;
            }


            .brand-title {

                font-size: 31px;
            }


            .brand-line {

                margin-bottom: 20px;
            }


            .brand-heading {

                font-size: 21px;

                margin-bottom: 8px;
            }


            .brand-description {

                max-width: 430px;

                font-size: 12.5px;

                line-height: 1.9;
            }


            .brand-footer {

                display: none;
            }


            .login-panel {

                padding:
                    45px 42px;
            }


            .login-content {

                max-width: 100%;
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

                top: 12px;

                right: 12px;

                width: 41px;

                height: 41px;

                border-radius: 11px;
            }


            .theme-toggle i {

                font-size: 14px;
            }


            .login-shell {

                width: 100%;

                margin-top: 43px;

                border-radius: 19px;
            }


            .brand-panel {

                min-height: 255px;

                padding:
                    32px 27px;
            }


            .brand-mark {

                width: 55px;

                height: 55px;

                margin-bottom: 17px;

                border-radius: 15px;

                font-size: 26px;
            }


            .brand-small {

                font-size: 9px;

                letter-spacing: 3px;

                margin-bottom: 5px;
            }


            .brand-title {

                font-size: 27px;

                letter-spacing: 2px;

                margin-bottom: 10px;
            }


            .brand-line {

                width: 45px;

                height: 2px;

                margin-bottom: 19px;
            }


            .brand-heading {

                font-size: 18px;

                line-height: 1.45;

                margin-bottom: 7px;
            }


            .brand-description {

                font-size: 11px;

                line-height: 1.85;
            }


            .login-panel {

                padding:
                    32px 23px 28px;
            }


            .login-heading {

                margin-bottom: 27px;
            }


            .login-heading h1 {

                font-size: 23px;

                line-height: 1.45;
            }


            .login-heading p {

                font-size: 11.5px;

                line-height: 1.8;
            }


            .login-heading::after {

                width: 38px;

                height: 2px;

                margin-top: 12px;
            }


            .field {

                margin-bottom: 18px;
            }


            .field label {

                margin-bottom: 7px;

                font-size: 11.5px;
            }


            .field input {

                height: 53px;

                padding:
                    0 16px 0 44px;

                border-radius: 11px;

                font-size: 12px;
            }


            .input-icon {

                left: 14px;

                font-size: 13px;
            }


            .password-toggle {

                right: 11px;

                width: 31px;

                height: 31px;

                font-size: 12px;
            }


            .password-field {

                padding-right:
                    46px !important;
            }


            .field-error {

                font-size: 10.5px;

                margin-top: 7px;
            }


            .field-error svg {

                width: 14px;

                height: 14px;
            }


            .login-button {

                height: 53px;

                margin-top: 5px;

                border-radius: 11px;

                font-size: 12.5px;
            }


            .login-note {

                margin-top: 18px;

                font-size: 9.5px;
            }


            .corner-decoration {

                width: 100px;

                height: 100px;
            }


            .corner-decoration::before {

                width: 100px;

                height: 100px;

                top: -45px;

                right: -45px;
            }


            .corner-decoration::after {

                top: 15px;

                right: 15px;
            }
        }


        /* =========================================================
           VERY SMALL PHONES
        ========================================================== */

        @media (max-width: 380px) {

            body {

                padding:
                    8px;
            }


            .theme-toggle {

                top: 9px;

                right: 9px;

                width: 38px;

                height: 38px;
            }


            .login-shell {

                margin-top: 43px;

                border-radius: 17px;
            }


            .brand-panel {

                min-height: 235px;

                padding:
                    27px 22px;
            }


            .brand-mark {

                width: 50px;

                height: 50px;

                font-size: 23px;

                margin-bottom: 14px;
            }


            .brand-small {

                font-size: 8px;

                letter-spacing: 2.5px;
            }


            .brand-title {

                font-size: 24px;
            }


            .brand-heading {

                font-size: 16px;
            }


            .brand-description {

                font-size: 10px;
            }


            .login-panel {

                padding:
                    28px 18px 23px;
            }


            .login-heading h1 {

                font-size: 21px;
            }


            .login-heading p {

                font-size: 10.5px;
            }


            .field label {

                font-size: 11px;
            }


            .field input {

                height: 51px;

                font-size: 11.5px;
            }


            .login-button {

                height: 51px;

                font-size: 12px;
            }


            .login-note {

                font-size: 9px;
            }
        }


        /* =========================================================
           ACCESSIBILITY
        ========================================================== */

        .theme-toggle:focus-visible,
        .password-toggle:focus-visible,
        .login-button:focus-visible,
        .field input:focus-visible {

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


<a href="{{ url('/') }}" class="back-welcome">
    <i class="fas fa-arrow-left"></i>
    <span>العودة</span>
</a>
    <button type="button" class="theme-toggle" id="themeToggle" aria-label="Toggle theme" title="Toggle theme">

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

    <main class="login-shell">


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
                    النادي بطريقة بسيطة،
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


                <!-- LOGIN HEADING -->

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

                <form method="POST" action="/employee/login">

                    @csrf


                    <!-- =================================================
                         EMAIL
                    ================================================== -->

                    <div class="field">

                        <label>

                            <i class="fas fa-envelope"></i>

                            Email Address

                        </label>


                        <div class="input-wrapper">

                            <i class="fas fa-envelope input-icon">
                            </i>


                            <input type="email" name="email" placeholder="employee@example.com"
                                value="{{ old('email') }}" class="{{ $errors->has('email') ? 'is-invalid' : '' }}"
                                autocomplete="email">

                        </div>


                        @error('email')
                            <div class="field-error">

                                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">

                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                    </path>

                                </svg>


                                <span>
                                    {{ $message }}
                                </span>

                            </div>
                        @enderror

                    </div>


                    <!-- =================================================
                         PASSWORD
                    ================================================== -->

                    <div class="field">

                        <label>

                            <i class="fas fa-lock"></i>

                            Password

                        </label>


                        <div class="input-wrapper">

                            <i class="fas fa-lock input-icon">
                            </i>


                            <input type="password" name="password" id="password" placeholder="••••••••"
                                class="{{ $errors->has('password') ? 'is-invalid' : '' }} password-field"
                                autocomplete="current-password">


                            <button type="button" class="password-toggle" onclick="togglePassword()"
                                aria-label="Show password" title="Show password">

                                <i class="fas fa-eye" id="passwordIcon">
                                </i>

                            </button>

                        </div>


                        @error('password')
                            <div class="field-error">

                                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">

                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                    </path>

                                </svg>


                                <span>
                                    {{ $message }}
                                </span>

                            </div>
                        @enderror

                    </div>


                    <!-- =================================================
                         SUBMIT
                    ================================================== -->

                    <button type="submit" class="login-button">

                        <i class="fas fa-arrow-right-to-bracket">
                        </i>

                        Login

                    </button>


                </form>


                <!-- SECURITY NOTE -->

                <div class="login-note">

                    Secure access to

                    <span>
                        Elite Club
                    </span>

                    employee workspace

                </div>


            </div>

        </section>

    </main>


    <!-- =========================================================
         THEME + PASSWORD UI
    ========================================================== -->

    <script>
        /* =====================================================
               THEME
               SAME KEY USED BY DASHBOARD / ADMIN LOGIN
            ====================================================== */

        (function() {

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
                function() {

                    const html =
                        document.documentElement;


                    const currentTheme =
                        html.getAttribute(
                            'data-theme'
                        );


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


            const button =
                document.querySelector(
                    '.password-toggle'
                );


            if (!password || !icon) {
                return;
            }


            if (password.type === 'password') {

                password.type =
                    'text';


                icon.classList.remove(
                    'fa-eye'
                );


                icon.classList.add(
                    'fa-eye-slash'
                );


                if (button) {

                    button.setAttribute(
                        'aria-label',
                        'Hide password'
                    );

                    button.setAttribute(
                        'title',
                        'Hide password'
                    );

                }

            } else {

                password.type =
                    'password';


                icon.classList.remove(
                    'fa-eye-slash'
                );


                icon.classList.add(
                    'fa-eye'
                );


                if (button) {

                    button.setAttribute(
                        'aria-label',
                        'Show password'
                    );

                    button.setAttribute(
                        'title',
                        'Show password'
                    );

                }

            }

        }
    </script>


</body>

</html>
