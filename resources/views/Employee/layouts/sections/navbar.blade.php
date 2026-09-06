<style>
    .navbar {
        width: 100%;
        min-height: 78px;
        display: flex;
        direction: rtl;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        padding: 12px 24px;
        background: var(--surface);
        border-bottom: 1px solid var(--border);
        box-shadow: var(--shadow-sm);
        position: sticky;
        top: 0;
        z-index: 80;
        transition:
            background .25s ease,
            border-color .25s ease,
            box-shadow .25s ease,
            padding .2s ease;
    }

    .navbar-right {
        display: flex;
        align-items: center;
        gap: 13px;
        min-width: 0;
    }

    .navbar-title-icon {
        width: 46px;
        height: 46px;
        flex: 0 0 46px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 13px;
        background:
            linear-gradient(135deg,
                var(--gold-light),
                var(--gold-dark));
        color: #fff;
        font-size: 18px;
        box-shadow:
            0 7px 18px rgba(184, 146, 62, .20);
    }

    .navbar-title-text {
        min-width: 0;
    }

    .navbar-title {
        color: var(--text);
        font-size: 19px;
        font-weight: 850;
        line-height: 1.3;
        letter-spacing: -.2px;
        white-space: nowrap;
    }

    .navbar-subtitle {
        margin-top: 3px;
        color: var(--text-soft);
        font-size: 12.5px;
        font-weight: 600;
        line-height: 1.5;
        white-space: nowrap;
    }

    .navbar-left {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-shrink: 0;
    }

    .navbar-theme-toggle {
        width: 43px;
        height: 43px;
        flex: 0 0 43px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 11px;
        border: 1px solid var(--border);
        background: var(--surface-2);
        color: var(--text);
        cursor: pointer;
        font-size: 16px;
        transition:
            background .2s ease,
            border-color .2s ease,
            color .2s ease,
            transform .2s ease;
    }

    .navbar-theme-toggle:hover {
        color: var(--gold);
        border-color:
            color-mix(in srgb,
                var(--gold) 35%,
                var(--border));
        background:
            color-mix(in srgb,
                var(--gold) 6%,
                var(--surface-2));
        transform: translateY(-1px);
    }

    .navbar-theme-toggle:active {
        transform: scale(.9);
    }

    .navbar-theme-toggle i {
        transition:
            transform .35s cubic-bezier(.34, 1.56, .64, 1);
    }

    .navbar-theme-toggle:hover i {
        transform: rotate(-15deg);
    }

    .navbar-theme-toggle .sun-icon {
        display: none;
    }

    html[data-theme="dark"] .navbar-theme-toggle .moon-icon {
        display: none;
    }

    html[data-theme="dark"] .navbar-theme-toggle .sun-icon {
        display: inline-block;
    }

    .navbar-user {
        min-height: 54px;
        display: flex;
        align-items: center;
        gap: 11px;
        padding: 5px 8px 5px 14px;
        background: var(--surface-2);
        border: 1px solid var(--border);
        border-radius: 12px;
        transition:
            background .25s ease,
            border-color .25s ease,
            transform .2s ease,
            box-shadow .2s ease;
    }

    .navbar-user:hover {
        transform: translateY(-1px);
        box-shadow: var(--shadow-sm);
        border-color:
            color-mix(in srgb,
                var(--gold) 25%,
                var(--border));
    }

    .navbar-user:hover .navbar-user-avatar {
        transform:
            scale(1.08) rotate(-3deg);
    }

    .navbar-user-text {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        gap: 3px;
    }

    .navbar-user-name {
        color: var(--text);
        font-size: 14px;
        font-weight: 850;
        white-space: nowrap;
    }

    .navbar-user-role {
        color: var(--text-soft);
        font-size: 11.5px;
        font-weight: 600;
        white-space: nowrap;
    }

    .navbar-user-avatar {
        width: 40px;
        height: 40px;
        flex: 0 0 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        background:
            linear-gradient(135deg,
                var(--gold-light),
                var(--gold-dark));
        color: #fff;
        font-size: 15px;
        box-shadow:
            0 6px 15px rgba(184, 146, 62, .18);
        transition:
            transform .25s cubic-bezier(.34, 1.56, .64, 1);
    }

    html[data-theme="dark"] .navbar {
        background: var(--surface);
        border-color: var(--border);
        box-shadow: var(--shadow-sm);
    }

    html[data-theme="dark"] .navbar-user,
    html[data-theme="dark"] .navbar-theme-toggle {
        background: var(--surface-2);
        border-color: var(--border);
    }

    body.dark .navbar,
    body[data-theme="dark"] .navbar {
        background: var(--surface);
        border-color: var(--border);
    }

    body.dark .navbar-user,
    body.dark .navbar-theme-toggle,
    body[data-theme="dark"] .navbar-user,
    body[data-theme="dark"] .navbar-theme-toggle {
        background: var(--surface-2);
        border-color: var(--border);
    }

    @media (max-width: 900px) {

        .navbar {
            min-height: 70px;
            padding: 10px 16px;
            margin-bottom: 18px;
        }

        .navbar-user-text {
            display: none;
        }

        .navbar-user {
            padding: 4px;
        }

        .navbar-user-avatar {
            width: 36px;
            height: 36px;
            flex-basis: 36px;
        }

        .navbar-theme-toggle {
            width: 40px;
            height: 40px;
            flex-basis: 40px;
        }

        .navbar-title-icon {
            width: 40px;
            height: 40px;
            flex-basis: 40px;
            font-size: 16px;
        }

        .navbar-title {
            font-size: 16px;
        }

        .navbar-subtitle {
            display: none;
        }
    }

    @media (max-width: 768px) {

        .navbar {
            padding-right: 70px;
            padding-left: 12px;
            gap: 8px;
        }

        .navbar-right {
            min-width: 0;
            flex: 1;
            gap: 9px;
        }

        .navbar-left {
            gap: 7px;
        }
    }

    @media (max-width: 650px) {

        .navbar {
            padding-right: 66px;
            padding-left: 10px;
        }

        .navbar-title-icon {
            width: 38px;
            height: 38px;
            flex-basis: 38px;
            font-size: 15px;
        }

        .navbar-title {
            font-size: 15px;
        }

        .navbar-left {
            gap: 6px;
        }

        .navbar-theme-toggle {
            width: 38px;
            height: 38px;
            flex-basis: 38px;
            font-size: 14px;
        }

        .navbar-user-avatar {
            width: 34px;
            height: 34px;
            flex-basis: 34px;
        }
    }

    @media (max-width: 480px) {

        .navbar {
            min-height: 64px;
            padding-right: 62px;
            padding-left: 8px;
            margin-bottom: 14px;
        }

        .navbar-right {
            gap: 7px;
        }

        .navbar-title-icon {
            width: 35px;
            height: 35px;
            flex-basis: 35px;
            font-size: 13px;
            border-radius: 9px;
        }

        .navbar-title {
            font-size: 14px;
        }

        .navbar-theme-toggle {
            width: 36px;
            height: 36px;
            flex-basis: 36px;
        }

        .navbar-user-avatar {
            width: 32px;
            height: 32px;
            flex-basis: 32px;
        }
    }

    @media (max-width: 360px) {

        .navbar {
            padding-right: 58px;
        }

        .navbar-title {
            font-size: 13px;
        }

        .navbar-title-icon {
            width: 33px;
            height: 33px;
            flex-basis: 33px;
        }

        .navbar-theme-toggle {
            width: 34px;
            height: 34px;
            flex-basis: 34px;
        }

        .navbar-user-avatar {
            width: 30px;
            height: 30px;
            flex-basis: 30px;
        }
    }
</style>

<nav class="navbar">

    <div class="navbar-right">

        <div class="navbar-title-icon">

            <i class="fas fa-gauge"></i>

        </div>

        <div class="navbar-title-text">

            <div class="navbar-title">
                لوحة التحكم
            </div>

            <div class="navbar-subtitle">
                متابعة وإدارة أعمالك بالنادي أولاً بأول
            </div>

        </div>

    </div>

    <div class="navbar-left">

        <button type="button" class="navbar-theme-toggle" onclick="toggleEliteTheme()" aria-label="تغيير الوضع">

            <i class="fas fa-moon moon-icon"></i>

            <i class="fas fa-sun sun-icon"></i>

        </button>

        <div class="navbar-user">

            <div class="navbar-user-text">

                <span class="navbar-user-name">
                    {{ auth()->guard('employee')->user()->name }}
                </span>

                <span class="navbar-user-role">
                    موظف / مدرب
                </span>

            </div>

            <div class="navbar-user-avatar">

                <i class="fas fa-user"></i>

            </div>

        </div>

    </div>

</nav>
