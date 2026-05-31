<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إنشاء دور جديد</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Syne:wght@600;700;800&family=DM+Sans:wght@300;400;500&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --bg: #0d0f14;
            --surface: #13161d;
            --surface-2: #1a1e28;
            --border: #252a38;
            --accent: #5b6af0;
            --accent-glow: rgba(91, 106, 240, 0.15);
            --deny: #ef4444;
            --text: #e2e8f0;
            --text-muted: #64748b;
            --radius: 12px;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            padding: 40px 20px;
        }

        .wrapper {
            max-width: 820px;
            margin: 0 auto;
        }

        /* Header */
        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 32px;
        }

        .header-title {
            font-family: 'Syne', sans-serif;
            font-size: 24px;
            font-weight: 800;
            color: var(--text);
            line-height: 1.2;
        }

        .header-sub {
            font-size: 13px;
            color: var(--text-muted);
            margin-top: 3px;
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 9px 18px;
            border-radius: var(--radius);
            border: 1px solid var(--border);
            background: var(--surface);
            color: var(--text-muted);
            font-size: 13px;
            text-decoration: none;
            transition: all 0.2s;
        }

        .btn-back:hover {
            border-color: var(--accent);
            color: var(--text);
        }

        /* Alert */
        .alert {
            border-radius: var(--radius);
            padding: 14px 18px;
            margin-bottom: 20px;
            font-size: 13.5px;
        }

        .alert-danger {
            background: rgba(239, 68, 68, 0.08);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #fca5a5;
        }

        .alert ul {
            padding-right: 18px;
            list-style: disc;
        }

        /* Card */
        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 16px;
            overflow: hidden;
        }

        .card-top {
            padding: 18px 28px;
            border-bottom: 1px solid var(--border);
            background: var(--surface-2);
        }

        .card-top-title {
            font-family: 'Syne', sans-serif;
            font-size: 13px;
            font-weight: 700;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }
    </style>
</head>

<body>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="wrapper">

        <div class="header">
            <div>
                <div class="header-title">إنشاء دور جديد</div>
                <div class="header-sub">Create New Role</div>
            </div>
            <a href="{{ route('admin.roles') }}" class="btn-back">← رجوع</a>
        </div>

        <div class="card">
            <div class="card-top">
                <span class="card-top-title">بيانات الدور</span>
            </div>

            <form action="{{ route('admin.roles.store') }}" method="POST">
                @csrf
                @include('Admin.Roles._form')
            </form>
        </div>

    </div>

</body>

</html>
