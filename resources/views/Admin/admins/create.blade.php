<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إضافة مشرف جديد</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Syne:wght@600;700;800&family=DM+Sans:wght@300;400;500;600&display=swap"
        rel="stylesheet">

    <style>
        /* ---- الإعدادات الأساسية (Reset) ---- */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --bg: #0d0f14;
            --card: #181c27;
            --border: #252a38;
            --accent: #6c63ff;
            --accent2: #00d4aa;
            --text: #e8eaf6;
            --muted: #6b7280;
            --danger: #f87171;
        }

        body {
            background: var(--bg);
            font-family: 'DM Sans', sans-serif;
            color: var(--text);
            min-height: 100vh;
        }

        .create-wrapper {
            max-width: 720px;
            margin: 2.5rem auto;
            padding: 0 1.25rem 4rem;
            animation: fadeUp .35s ease both;
        }

        /* ---- BREADCRUMB ---- */
        .breadcrumb-row {
            display: flex;
            align-items: center;
            gap: .5rem;
            font-size: .78rem;
            color: var(--muted);
            margin-bottom: 1.75rem;
        }

        .breadcrumb-row a {
            color: var(--muted);
            text-decoration: none;
            transition: color .15s;
        }

        .breadcrumb-row a:hover {
            color: var(--text);
        }

        .breadcrumb-row span {
            color: var(--accent2);
            font-weight: 600;
        }

        .breadcrumb-row svg {
            width: 13px;
            height: 13px;
        }

        /* ---- CARD ---- */
        .create-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 1.25rem;
            overflow: hidden;
            box-shadow: 0 8px 40px rgba(0, 0, 0, .3);
        }

        /* ---- HEADER ---- */
        .create-card-header {
            padding: 1.5rem 1.75rem;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            gap: 1rem;
            position: relative;
            overflow: hidden;
        }

        .create-card-header::after {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 3px;
            background: linear-gradient(180deg, var(--accent2), #34d399);
            border-radius: 0 2px 2px 0;
        }

        .header-icon {
            width: 40px;
            height: 40px;
            border-radius: .75rem;
            background: rgba(0, 212, 170, .12);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--accent2);
            flex-shrink: 0;
        }

        .header-icon svg {
            width: 20px;
            height: 20px;
        }

        .header-text h3 {
            font-family: 'Syne', sans-serif;
            font-size: 1.05rem;
            font-weight: 700;
            color: var(--text);
            line-height: 1.2;
        }

        .header-text p {
            font-size: .78rem;
            color: var(--muted);
            margin-top: .15rem;
        }

        /* ---- BODY ---- */
        .create-card-body {
            padding: 1.75rem;
        }

        /* ---- FOOTER ---- */
        .create-card-footer {
            padding: 1.25rem 1.75rem;
            border-top: 1px solid var(--border);
            display: flex;
            align-items: center;
            gap: .75rem;
            flex-wrap: wrap;
        }

        .btn-submit {
            display: inline-flex;
            align-items: center;
            gap: .45rem;
            padding: .6rem 1.5rem;
            border-radius: .7rem;
            font-family: 'DM Sans', sans-serif;
            font-size: .875rem;
            font-weight: 600;
            color: #fff;
            background: linear-gradient(135deg, var(--accent2), #34d399);
            border: none;
            cursor: pointer;
            transition: opacity .2s, transform .2s, box-shadow .2s;
            box-shadow: 0 4px 18px rgba(0, 212, 170, .3);
        }

        .btn-submit:hover {
            opacity: .9;
            transform: translateY(-1px);
            box-shadow: 0 6px 24px rgba(0, 212, 170, .4);
        }

        .btn-submit svg {
            width: 16px;
            height: 16px;
        }

        .btn-cancel {
            display: inline-flex;
            align-items: center;
            gap: .45rem;
            padding: .6rem 1.25rem;
            border-radius: .7rem;
            font-family: 'DM Sans', sans-serif;
            font-size: .875rem;
            font-weight: 500;
            color: var(--muted);
            background: transparent;
            border: 1px solid var(--border);
            text-decoration: none;
            transition: color .2s, border-color .2s, background .2s;
        }

        .btn-cancel:hover {
            color: var(--text);
            border-color: #3d4460;
            background: rgba(255, 255, 255, .04);
        }

        .btn-cancel svg {
            width: 15px;
            height: 15px;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(14px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>

    <div class="create-wrapper">

        {{-- Breadcrumb --}}
        <div class="breadcrumb-row">
            <a href="{{ route('admins.index') }}">Admins</a>
            <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
            </svg>
            <span>Create Admin</span>
        </div>

        <div class="create-card">

            {{-- Header --}}
            <div class="create-card-header">
                <div class="header-icon">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                    </svg>
                </div>
                <div class="header-text">
                    <h3>Create Admin</h3>
                    <p>إضافة مشرف جديد — جميع الحقول مطلوبة</p>
                </div>
            </div>

            {{-- Form --}}
            <form action="{{ route('admins.store') }}" method="POST">
                @csrf

                <div class="create-card-body">
                    @include('Admin.admins._form')
                </div>

                <div class="create-card-footer">
                    <button type="submit" class="btn-submit">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        Create Admin
                    </button>
                    <a href="{{ route('admins.index') }}" class="btn-cancel">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Cancel
                    </a>
                </div>
            </form>

        </div>
    </div>

</body>

</html>
