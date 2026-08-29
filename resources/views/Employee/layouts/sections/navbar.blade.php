<style>

    .navbar {
        width: 100%;
        min-height: 78px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        padding: 12px 24px;
        background: var(--surface);
        border-bottom: 1px solid var(--border);
        box-shadow: var(--shadow-sm);
        position: sticky;
        top: 0;
        z-index: 90;
        transition: background .25s ease, border-color .25s ease, box-shadow .25s ease;
    }
    .navbar-right {
        display: flex;
        align-items: center;
        gap: 12px;
        min-width: 0;
    }

    .navbar-welcome {
        color: var(--text-soft);
        font-size: 13px;
        font-weight: 700;
    }

    /* =========================================================
       LEFT — USER ACTIONS
       ========================================================= */

    .navbar-left {
        display: flex;
        align-items: center;
        gap: 10px;
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
        color: var(--text-soft);
        cursor: pointer;
        font-size: 14px;
        transition: background .2s ease, border-color .2s ease, color .2s ease, transform .2s ease;
    }

    .navbar-theme-toggle:hover {
        color: var(--gold);
        border-color: color-mix(in srgb, var(--gold) 35%, var(--border));
        background: color-mix(in srgb, var(--gold) 6%, var(--surface-2));
        transform: translateY(-1px);
    }

    .navbar-theme-toggle:active {
        transform: scale(0.9);
    }

    .navbar-theme-toggle i {
        transition: transform .35s cubic-bezier(.34, 1.56, .64, 1);
    }

    .navbar-theme-toggle:hover i {
        transform: rotate(-15deg);
    }

    .navbar-theme-toggle .sun-icon {
        display: none;
    }

    html[data-theme="dark"]
    .navbar-theme-toggle .moon-icon {
        display: none;
    }

    html[data-theme="dark"]
    .navbar-theme-toggle .sun-icon {
        display: inline-block;
    }

    /* =========================================================
       USER INFO
       ========================================================= */

    .navbar-user {
        min-height: 50px;
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 5px 7px 5px 12px;
        background: var(--surface-2);
        border: 1px solid var(--border);
        border-radius: 12px;
        transition: background .25s ease, border-color .25s ease, transform .2s ease, box-shadow .2s ease;
    }

    .navbar-user:hover {
        transform: translateY(-1px);
        box-shadow: var(--shadow-sm);
        border-color: color-mix(in srgb, var(--gold) 25%, var(--border));
    }

    .navbar-user:hover .navbar-user-avatar {
        transform: scale(1.08) rotate(-3deg);
    }

    .navbar-user-text {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        gap: 2px;
    }

    .navbar-user-name {
        color: var(--text);
        font-size: 10.5px;
        font-weight: 850;
        white-space: nowrap;
    }

    .navbar-user-role {
        color: var(--muted);
        font-size: 8px;
        font-weight: 500;
        white-space: nowrap;
    }

    .navbar-user-avatar {
        width: 38px;
        height: 38px;
        flex: 0 0 38px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        background: linear-gradient(135deg, var(--gold-light), var(--gold-dark));
        color: #fff;
        font-size: 13px;
        box-shadow: 0 6px 15px rgba(184, 146, 62, .18);
        transition: transform .25s cubic-bezier(.34, 1.56, .64, 1);
    }

    /* =========================================================
       DARK MODE
       ========================================================= */

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

    /* =========================================================
       MOBILE
       ========================================================= */

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
            width: 35px;
            height: 35px;
            flex-basis: 35px;
        }

        .navbar-theme-toggle {
            width: 39px;
            height: 39px;
            flex-basis: 39px;
        }
    }

    @media (max-width: 650px) {
        .navbar {
            gap: 8px;
            padding: 9px 12px;
        }

    }

    @media (max-width: 480px) {
        .navbar-right {
            gap: 7px;
        }

    }

</style>

<nav class="navbar"> 
    {{-- =====================================================
         RIGHT — WELCOME (بدل عنوان الصفحة والتاريخ، انتقلوا للسايدبار)
    ====================================================== --}}

    <div class="navbar-right">
        <span class="navbar-welcome">مرحباً بك في Elite Club</span>
    </div>

    {{-- =====================================================
         LEFT — USER + THEME
    ====================================================== --}}

    <div class="navbar-left"> 
        {{-- الوضع الليلي / النهاري --}}

        <button
            type="button"
            class="navbar-theme-toggle"
            onclick="toggleEliteTheme()"
            aria-label="تغيير الوضع">

            <i class="fas fa-moon moon-icon"></i>

            <i class="fas fa-sun sun-icon"></i>

        </button> 
        {{-- الموظف --}}

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