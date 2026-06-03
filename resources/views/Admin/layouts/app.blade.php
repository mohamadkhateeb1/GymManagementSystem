<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Elite Club - Admin')</title>

    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* ── التنسيقات الجذرية ── */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --bg: #0d0f14;
            --surface: #13161d;
            --surface-2: #1a1e28;
            --border: #252a38;
            --accent: #6c63ff;
            --text: #e8eaf6;
            --text-muted: #9ca3af;
            --sidebar-width: 270px;
        }

        body {
            font-family: 'Cairo', sans-serif;
            background: var(--bg);
            color: var(--text);
            display: flex;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* ── السايدبار (القائمة الجانبية) ── */
        .sidebar {
            width: var(--sidebar-width);
            background: var(--surface);
            border-left: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            position: fixed;
            right: 0;
            top: 0;
            height: 100vh;
            z-index: 100;
            padding: 20px 16px;
        }

        /* تنسيق الشعار (Brand) */
        .brand {
            margin-bottom: 30px;
            padding: 0 8px;
        }

        .brand-logo {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .brand-mark {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #6c63ff, #818cf8);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            color: #fff;
            box-shadow: 0 4px 15px rgba(108, 99, 255, 0.3);
        }

        .brand-text h2 {
            font-size: 18px;
            font-weight: 900;
            color: #fff;
            letter-spacing: 1px;
            line-height: 1.2;
        }

        .brand-text span {
            font-size: 11px;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* تنسيقات أقسام السايدبار (لتتوافق مع مكون x-side) */
        .nav-section {
            margin-bottom: 24px;
        }

        .nav-label {
            font-size: 11px;
            font-weight: 700;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            margin-bottom: 12px;
            padding: 0 8px;
        }

        /* زر تسجيل الخروج */
        .sidebar-logout {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px;
            background: rgba(248, 113, 113, 0.08);
            color: #f87171;
            border: 1px solid rgba(248, 113, 113, 0.2);
            border-radius: 8px;
            font-family: 'Cairo', sans-serif;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .sidebar-logout:hover {
            background: rgba(248, 113, 113, 0.15);
            border-color: rgba(248, 113, 113, 0.35);
            transform: translateY(-1px);
        }

        /* ── منطقة المحتوى الرئيسية ── */
        .main-wrapper {
            flex: 1;
            margin-right: var(--sidebar-width);
            /* حجز مساحة للسايدبار على اليمين */
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* ── الناف بار العلوي ── */
        .top-navbar {
            height: 70px;
            background: rgba(13, 15, 20, 0.8);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 32px;
            position: sticky;
            top: 0;
            z-index: 90;
        }

        .nav-left {
            font-size: 15px;
            font-weight: 600;
            color: var(--text-muted);
        }

        /* ── مساحة عرض المحتوى ── */
        .content-area {
            padding: 40px 32px;
            flex: 1;
        }

    </style>
            @yield('styles')

</head>

<body>
    @include('Admin.sections.sidebar')
   
    <div class="main-wrapper">

        <header class="top-navbar">
            <div class="nav-left">
                <span>مرحباً بك في لوحة تحكم الإدارة</span>
            </div>
            <div class="nav-right">
            </div>
        </header>

        <main class="content-area">

            <x-flash-message />

            @yield('content')

        </main>

    </div>

    @yield('scripts')

</body>

</html>
