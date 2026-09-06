<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>التحقق بخطوتين | Elite Club</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        :root {
            --gold: #c99a35;
            --gold-dark: #b5821e;
            --page-bg: #f4f6f8;
            --card-bg: #ffffff;
            --text: #172033;
            --heading: #111827;
            --muted: #7b8492;
            --border: #e0e5eb;
            --input-bg: #f8fafc;
            --error-bg: #fff7f7;
            --error-border: #f0cccc;
            --error-text: #a63d3d;
            --shadow: 0 25px 65px rgba(20, 30, 45, .12);
        }

        html[data-theme="dark"] {
            --page-bg: #0b0d10;
            --card-bg: #14171a;
            --text: #e7ebf0;
            --heading: #f5f7fa;
            --muted: #929ba8;
            --border: rgba(255, 255, 255, .07);
            --input-bg: #0d0f11;
            --error-bg: rgba(255, 62, 62, .07);
            --error-border: rgba(255, 62, 62, .22);
            --error-text: #ff8080;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background: var(--page-bg);
            color: var(--text);
            font-family: 'Tajawal', sans-serif;
            transition: background .25s ease, color .25s ease;
        }

        .challenge-card {
            width: 100%;
            max-width: 420px;
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 38px 34px;
            box-shadow: var(--shadow);
            text-align: center;
        }

        .challenge-icon {
            width: 64px;
            height: 64px;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 18px;
            background: linear-gradient(135deg, #dec582, var(--gold-dark));
            color: #fff;
            font-size: 26px;
            box-shadow: 0 10px 25px rgba(184, 146, 62, .25);
        }

        .challenge-title {
            color: var(--heading);
            font-size: 21px;
            font-weight: 800;
            margin-bottom: 8px;
        }

        .challenge-sub {
            color: var(--muted);
            font-size: 13.5px;
            font-weight: 500;
            line-height: 1.8;
            margin-bottom: 26px;
        }

        .field-label {
            display: block;
            text-align: right;
            margin-bottom: 8px;
            color: var(--text);
            font-size: 13px;
            font-weight: 700;
        }

        .code-input {
            width: 100%;
            height: 56px;
            border-radius: 12px;
            border: 1px solid var(--border);
            background: var(--input-bg);
            color: var(--heading);
            font-size: 24px;
            font-weight: 800;
            text-align: center;
            letter-spacing: 10px;
            outline: none;
            transition: border-color .2s ease, box-shadow .2s ease;
        }

        .code-input:focus {
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(201, 154, 53, .12);
        }

        .error-box {
            margin-top: 12px;
            padding: 10px 14px;
            border-radius: 10px;
            background: var(--error-bg);
            border: 1px solid var(--error-border);
            color: var(--error-text);
            font-size: 12.5px;
            font-weight: 600;
            text-align: right;
        }

        .submit-btn {
            width: 100%;
            height: 50px;
            margin-top: 22px;
            border: 0;
            border-radius: 12px;
            background: linear-gradient(135deg, #dec582, var(--gold-dark));
            color: #fff;
            font-family: inherit;
            font-size: 15px;
            font-weight: 800;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: transform .2s ease, box-shadow .2s ease;
        }

        .submit-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 25px rgba(184, 146, 62, .28);
        }

        .toggle-mode {
            display: block;
            margin-top: 18px;
            color: var(--gold-dark);
            font-size: 12.5px;
            font-weight: 700;
            text-decoration: none;
            cursor: pointer;
            background: none;
            border: none;
            width: 100%;
        }

        .toggle-mode:hover { text-decoration: underline; }

        .recovery-field { display: none; }
        .recovery-field.active { display: block; }
        .code-field.hidden { display: none; }
    </style>
</head>

<body>

    <div class="challenge-card">

        <div class="challenge-icon"><i class="fas fa-shield-halved"></i></div>

        <div class="challenge-title">التحقق بخطوتين</div>
        <div class="challenge-sub" id="subText">
            أدخل الرمز المكوّن من 6 أرقام الظاهر بتطبيق المصادقة على جوالك.
        </div>

        <form method="POST" action="{{ route('two-factor.login') }}">
            @csrf

            <div class="code-field" id="codeField">
                <label class="field-label">رمز المصادقة</label>
                <input type="text" name="code" inputmode="numeric" autocomplete="one-time-code"
                    maxlength="6" placeholder="000000" class="code-input" autofocus>
            </div>

            <div class="recovery-field" id="recoveryField">
                <label class="field-label">رمز الاسترداد</label>
                <input type="text" name="recovery_code" autocomplete="one-time-code"
                    placeholder="xxxxx-xxxxx" class="code-input" style="letter-spacing:2px; font-size:16px;">
            </div>

            @error('code')
                <div class="error-box">{{ $message }}</div>
            @enderror
            @error('recovery_code')
                <div class="error-box">{{ $message }}</div>
            @enderror

            <button type="submit" class="submit-btn">
                <i class="fas fa-arrow-left"></i>
                تأكيد والمتابعة
            </button>

            <button type="button" class="toggle-mode" onclick="toggleRecoveryMode()">
                <span id="toggleText">فقدت جهازك؟ استخدم رمز استرداد بدلاً من ذلك</span>
            </button>

        </form>

    </div>

    <script>
        (function () {
            const saved = localStorage.getItem('elite-theme');
            document.documentElement.setAttribute('data-theme', saved === 'dark' ? 'dark' : 'light');
        })();

        let usingRecovery = false;

        function toggleRecoveryMode() {
            usingRecovery = !usingRecovery;

            const codeField = document.getElementById('codeField');
            const recoveryField = document.getElementById('recoveryField');
            const toggleText = document.getElementById('toggleText');
            const subText = document.getElementById('subText');

            if (usingRecovery) {
                codeField.classList.add('hidden');
                recoveryField.classList.add('active');
                toggleText.textContent = 'العودة لاستخدام رمز تطبيق المصادقة';
                subText.textContent = 'أدخل أحد أكواد الاسترداد اللي احتفظت فيها وقت تفعيل المصادقة الثنائية.';
                document.querySelector('input[name="code"]').removeAttribute('required');
                document.querySelector('input[name="recovery_code"]').setAttribute('required', 'required');
            } else {
                codeField.classList.remove('hidden');
                recoveryField.classList.remove('active');
                toggleText.textContent = 'فقدت جهازك؟ استخدم رمز استرداد بدلاً من ذلك';
                subText.textContent = 'أدخل الرمز المكوّن من 6 أرقام الظاهر بتطبيق المصادقة على جوالك.';
                document.querySelector('input[name="recovery_code"]').removeAttribute('required');
                document.querySelector('input[name="code"]').setAttribute('required', 'required');
            }
        }
    </script>

</body>

</html>