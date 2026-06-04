<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إضافة موظف جديد</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Cairo', sans-serif;
            color: #e8eaf6;
            min-height: 100vh;
            padding: 48px 24px;
            background:
                radial-gradient(110% 80% at 100% 0%, rgba(0, 212, 170, 0.10), transparent 55%),
                radial-gradient(90% 70% at 0% 100%, rgba(108, 99, 255, 0.08), transparent 55%),
                #0d0f14;
        }

        .wrapper {
            max-width: 800px;
            margin: 0 auto;
        }

        /* ===== الهيدر ===== */
        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 30px;
            flex-wrap: wrap;
            gap: 16px;
            animation: fadeUp 0.5s ease both;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .header-accent {
            width: 5px;
            height: 48px;
            border-radius: 6px;
            background: linear-gradient(180deg, #34d399, #00a37f);
            box-shadow: 0 0 18px rgba(0, 212, 170, 0.5);
        }

        .header-title {
            font-size: 26px;
            font-weight: 900;
            color: #e8eaf6;
            line-height: 1.15;
        }

        .header-sub {
            font-size: 13px;
            color: #6b7280;
            margin-top: 4px;
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 10px 16px;
            background: transparent;
            color: #9ca3af;
            border: 1px solid #252a38;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            transition: all .2s ease;
        }

        .btn-back:hover {
            color: #34d399;
            border-color: rgba(0, 212, 170, 0.4);
            background: rgba(0, 212, 170, 0.06);
        }

        .btn-back svg {
            width: 16px;
            height: 16px;
        }

        /* ===== الكارد ===== */
        .card {
            position: relative;
            background: #181c27;
            border-radius: 20px;
            border: 1px solid #252a38;
            padding: 34px;
            box-shadow: 0 18px 50px rgba(0, 0, 0, 0.45), inset 0 1px 0 rgba(255, 255, 255, 0.03);
            overflow: hidden;
            animation: fadeUp 0.5s ease 0.1s both;
        }

        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(0, 212, 170, 0.6), transparent);
        }

        /* ===== زر الحفظ ===== */
        .btn-submit {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            width: 100%;
            padding: 14px;
            margin-top: 26px;
            background: linear-gradient(135deg, #00d4aa, #34d399);
            color: #062b22;
            border: none;
            border-radius: 11px;
            font-size: 15px;
            font-weight: 800;
            font-family: 'Cairo', sans-serif;
            cursor: pointer;
            box-shadow: 0 6px 18px rgba(0, 212, 170, 0.3);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 28px rgba(0, 212, 170, 0.45);
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

        @media (max-width: 640px) {
            body {
                padding: 28px 16px;
            }

            .card {
                padding: 24px;
            }
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <x-flash-message />

        <div class="header">
            <div class="header-left">
                <div class="header-accent"></div>
                <div>
                    <div class="header-title">إضافة موظف جديد</div>
                    <div class="header-sub">أدخل بيانات الموظف لإضافته إلى النظام</div>
                </div>
            </div>

            <a href="{{ route('employees.index') }}" class="btn-back">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
                </svg>
                العودة للقائمة
            </a>
        </div>

        <div class="card">
            <form action="{{ route('employees.store') }}" method="POST">
                @csrf
                @include('Admin.Employees._form')
                <button type="submit" class="btn-submit">
                    <i class="fas fa-circle-plus"></i> حفظ بيانات الموظف
                </button>
            </form>
        </div>
    </div>
</body>

</html>
