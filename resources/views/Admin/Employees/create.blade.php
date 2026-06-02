<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إضافة موظف جديد</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;900&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Cairo', sans-serif; background: #0d0f14; color: #e8eaf6; min-height: 100vh; padding: 48px 24px; }
        .wrapper { max-width: 800px; margin: 0 auto; }
        .header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 32px; flex-wrap: wrap; gap: 16px; }
        .header-title { font-size: 28px; font-weight: 900; color: #e8eaf6; }
        .btn-back {
            display: inline-flex; align-items: center; gap: 6px; padding: 10px 16px;
            background: transparent; color: #9ca3af; border: 1px solid #252a38;
            border-radius: 10px; font-size: 13px; font-weight: 600; text-decoration: none; transition: all .2s;
        }
        .btn-back:hover { color: #e8eaf6; border-color: #3d4460; background: rgba(255, 255, 255, 0.04); }
        .btn-back svg { width: 16px; height: 16px; }
        .card { background: #181c27; border-radius: 18px; border: 1px solid #252a38; padding: 32px; box-shadow: 0 8px 40px rgba(0, 0, 0, 0.3); }
        .btn-submit {
            display: block; width: 100%; padding: 14px; margin-top: 24px;
            background: linear-gradient(135deg, #00d4aa, #34d399); color: #fff;
            border: none; border-radius: 10px; font-size: 15px; font-weight: 700; font-family: 'Cairo', sans-serif;
            cursor: pointer; box-shadow: 0 4px 18px rgba(0, 212, 170, 0.28); transition: opacity 0.2s, transform 0.2s;
        }
        .btn-submit:hover { opacity: .9; transform: translateY(-1px); box-shadow: 0 6px 24px rgba(0, 212, 170, 0.38); }
    </style>
</head>
<body>
    <div class="wrapper">
        <x-flash-message />
        <div class="header">
            <div class="header-title">إضافة موظف جديد</div>
            <a href="{{ route('employees.index') }}" class="btn-back">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" /></svg>
                العودة للقائمة
            </a>
        </div>
        <div class="card">
            <form action="{{ route('employees.store') }}" method="POST">
                @csrf
                @include('Admin.Employees._form')
                <button type="submit" class="btn-submit">حفظ بيانات الموظف</button>
            </form>
        </div>
    </div>
</body>
</html>