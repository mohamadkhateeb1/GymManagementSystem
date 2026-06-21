<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'لوحة الموظف')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --accent: #c9a961;
            --gold: #c9a961;
            --gold-soft: rgba(201, 169, 97, 0.12);
            --gold-line: rgba(201, 169, 97, 0.15);
            --bg-dark: #0a0d14;
            --surface: #121722;
            --surface-2: #1a2031;
            --text: #e8e6e1;
            --muted: #8a8f9c;
            --danger: #c55a5a;
        }

        * {
            box-sizing: border-box;
        }

        body {
            background:
                radial-gradient(1100px 560px at 100% -8%, rgba(201, 169, 97, 0.06), transparent 60%),
                var(--bg-dark);
            color: var(--text);
            font-family: 'Tajawal', sans-serif;
            margin: 0;
            min-height: 100vh;
        }

        ::-webkit-scrollbar {
            width: 10px;
            height: 10px;
        }

        ::-webkit-scrollbar-track {
            background: var(--bg-dark);
        }

        ::-webkit-scrollbar-thumb {
            background: #2a3142;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--gold);
        }

        .sidebar {
            width: 260px;
            height: 100vh;
            background: var(--surface);
            position: fixed;
            top: 0;
            right: 0;
            border-left: 1px solid var(--gold-line);
            box-shadow: -4px 0 28px rgba(0, 0, 0, 0.28);
            z-index: 20;
        }

        .main-content {
            margin-right: 260px;
            min-height: 100vh;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 220px;
            }

            .main-content {
                margin-right: 220px;
            }
        }
    </style>
    @yield('styles')
    @stack('styles')
</head>

<body>

    @include('Employee.layouts.sections.sidebar')

    <div class="main-content">
        @include('Employee.layouts.sections.navbar')
        <div style="padding: 0 30px 30px 30px;">
            @yield('content')
        </div>
    </div>
@yield('scripts')
    @stack('scripts')
</body>

</html>
