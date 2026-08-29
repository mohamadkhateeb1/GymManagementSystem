<div class="elite-nav-actions">


    {{-- =====================================================
         THEME TOGGLE
    ====================================================== --}}

    <button
        type="button"
        class="elite-theme-toggle"
        id="themeToggle"
        aria-label="تغيير الوضع"
        title="الوضع الليلي">

        <i
            class="fas fa-moon"
            id="themeIcon">
        </i>

    </button>


    {{-- =====================================================
         NOTIFICATIONS
    ====================================================== --}}

    <button
        type="button"
        class="elite-nav-icon"
        aria-label="الإشعارات"
        title="الإشعارات">

        <i class="fas fa-bell"></i>

        <span class="elite-notification-badge">
            5
        </span>

    </button>


    {{-- =====================================================
         DIVIDER
    ====================================================== --}}

    <div class="elite-nav-divider"></div>


    {{-- =====================================================
         PROFILE
    ====================================================== --}}

    <button
        type="button"
        class="elite-profile">

        <span class="elite-profile-avatar">
            A
        </span>


        <span class="elite-profile-info">

            <strong>
                Admin
            </strong>

            <small>
                مدير النظام
            </small>

        </span>


        <i class="fas fa-chevron-down elite-profile-arrow"></i>

    </button>

</div>


<style>

    /* =====================================================
       NAVBAR
    ====================================================== */

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
    ====================================================== */

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

        font-size: 22px;

        font-weight: 900;

        line-height: 1.2;

        letter-spacing: -.3px;
    }


    .nav-page-title p {

        margin: 5px 0 0;

        color: var(--muted);

        font-size: 10.5px;

        font-weight: 400;

        line-height: 1.5;
    }


    .nav-title-line {

        display: block;

        width: 42px;

        height: 3px;

        margin-top: 7px;

        border-radius: 99px;

        background:
            linear-gradient(
                90deg,
                var(--gold-dark),
                var(--gold-light)
            );
    }


    /* =====================================================
       RIGHT ACTIONS
    ====================================================== */

    .nav-right {

        display: flex;

        align-items: center;

        flex-shrink: 0;
    }


    .elite-nav-actions {

        display: flex;

        align-items: center;

        gap: 9px;

        direction: ltr;
    }


    /* =====================================================
       THEME BUTTON
    ====================================================== */

    .elite-theme-toggle {

        width: 39px;

        height: 39px;

        display: flex;

        align-items: center;

        justify-content: center;

        border: 1px solid var(--border);

        border-radius: 11px;

        background: var(--surface-2);

        color: var(--muted);

        cursor: pointer;

        font-size: 13px;

        transition: all .2s ease;
    }


    .elite-theme-toggle:hover {

        color: var(--gold-dark);

        background: var(--surface-hover);

        border-color:
            rgba(184, 146, 62, .35);

        transform: translateY(-1px);
    }


    html[data-theme="dark"]
    .elite-theme-toggle:hover {

        color: var(--gold-light);
    }


    /* =====================================================
       NOTIFICATIONS
    ====================================================== */

    .elite-nav-icon {

        position: relative;

        width: 39px;

        height: 39px;

        display: flex;

        align-items: center;

        justify-content: center;

        border: 1px solid var(--border);

        border-radius: 11px;

        background: var(--surface-2);

        color: var(--muted);

        cursor: pointer;

        transition: all .2s ease;
    }


    .elite-nav-icon:hover {

        color: var(--gold-dark);

        background: var(--surface-hover);

        border-color:
            rgba(184, 146, 62, .35);

        transform: translateY(-1px);
    }


    .elite-notification-badge {

        position: absolute;

        top: -5px;

        right: -5px;

        min-width: 17px;

        height: 17px;

        padding: 0 4px;

        display: flex;

        align-items: center;

        justify-content: center;

        border-radius: 99px;

        background: var(--gold);

        color: #fff;

        font-size: 8px;

        font-weight: 800;

        border: 2px solid var(--surface);
    }


    /* =====================================================
       DIVIDER
    ====================================================== */

    .elite-nav-divider {

        width: 1px;

        height: 27px;

        margin: 0 3px;

        background: var(--border);
    }


    /* =====================================================
       PROFILE
    ====================================================== */

    .elite-profile {

        display: flex;

        align-items: center;

        gap: 8px;

        padding: 3px 6px 3px 3px;

        border: 1px solid transparent;

        border-radius: 11px;

        background: transparent;

        color: var(--text);

        cursor: pointer;

        transition: all .2s ease;
    }


    .elite-profile:hover {

        background: var(--surface-hover);

        border-color:
            rgba(184, 146, 62, .20);
    }


    /* =====================================================
       AVATAR
    ====================================================== */

    .elite-profile-avatar {

        width: 35px;

        height: 35px;

        display: flex;

        align-items: center;

        justify-content: center;

        border-radius: 50%;

        color: #fff;

        font-size: 12px;

        font-weight: 800;

        background:
            linear-gradient(
                135deg,
                #dcc27d,
                #ad8636
            );

        box-shadow:
            0 4px 12px
            rgba(184, 146, 62, .16);
    }


    /* =====================================================
       PROFILE INFO
    ====================================================== */

    .elite-profile-info {

        display: flex;

        flex-direction: column;

        align-items: flex-start;

        line-height: 1.15;
    }


    .elite-profile-info strong {

        color: var(--text);

        font-size: 11px;

        font-weight: 800;
    }


    .elite-profile-info small {

        margin-top: 3px;

        color: var(--muted);

        font-size: 8px;
    }


    .elite-profile-arrow {

        margin-right: 3px;

        color: var(--muted);

        font-size: 8px;
    }


    /* =====================================================
       MOBILE
    ====================================================== */

    @media (max-width: 768px) {

        .top-navbar {

            min-height: 68px;

            padding: 8px 15px;

            gap: 10px;
        }


        .nav-page-title h1 {

            font-size: 18px;
        }


        .nav-page-title p {

            display: none;
        }


        .nav-title-line {

            width: 32px;

            height: 2px;

            margin-top: 5px;
        }


        .elite-profile-info,
        .elite-profile-arrow,
        .elite-nav-divider {

            display: none;
        }


        .elite-theme-toggle,
        .elite-nav-icon {

            width: 36px;

            height: 36px;

            border-radius: 10px;
        }


        .elite-profile {

            padding: 1px;
        }


        .elite-profile-avatar {

            width: 33px;

            height: 33px;
        }
    }


    @media (max-width: 430px) {

        .top-navbar {

            padding-left: 12px;

            padding-right: 12px;
        }

        .nav-page-title h1 {

            font-size: 16px;
        }

        .elite-nav-actions {

            gap: 5px;
        }
    }

</style>