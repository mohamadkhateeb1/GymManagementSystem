<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Employee Login</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background: #1a2e1d;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .card {
            background: #ffffff;
            width: 400px;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 24px 60px rgba(0, 0, 0, .4);
        }

        .card-top {
            background: linear-gradient(135deg, #1a2e1d, #2d6135);
            padding: 36px;
            text-align: center;
        }

        .card-top h2 {
            font-size: 24px;
            font-weight: 700;
            color: #fff;
            margin-bottom: 4px;
        }

        .card-top p {
            font-size: 13px;
            color: #8bc98f;
        }

        .card-body {
            padding: 36px;
        }

        .field {
            margin-bottom: 20px;
        }

        .field label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 8px;
        }

        .field input {
            width: 100%;
            padding: 12px 16px;
            border: 1.5px solid #e8eaf0;
            border-radius: 10px;
            font-size: 14px;
            color: #222;
            outline: none;
            background: #f8f9fc;
            transition: border-color .2s, background .2s, box-shadow .2s;
        }

        .field input:focus {
            border-color: #2e7d32;
            background: #fff;
            box-shadow: 0 0 0 4px rgba(46, 125, 50, .08);
        }

        .field input.is-invalid {
            border-color: #f87171;
            background: #fffafa;
        }

        .field input.is-invalid:focus {
            border-color: #f87171;
            box-shadow: 0 0 0 4px rgba(248, 113, 113, 0.15);
        }

        .field-error {
            color: #f87171;
            font-size: 12.5px;
            margin-top: 8px;
            display: flex;
            align-items: center;
            gap: 5px;
            animation: fadeIn 0.3s ease;
        }

        .field-error svg {
            width: 15px;
            height: 15px;
            flex-shrink: 0;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-5px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        button {
            width: 100%;
            padding: 13px;
            background: linear-gradient(135deg, #2e7d32, #1b5e20);
            color: #fff;
            border: none;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            letter-spacing: .5px;
            box-shadow: 0 6px 20px rgba(46, 125, 50, .35);
            transition: opacity .2s, transform .1s;
        }

        button:hover {
            opacity: .92;
        }

        button:active {
            transform: scale(.99);
        }
    </style>
</head>

<body>


    <div class="card">
        <div class="card-top">
            <h2>Employee Login</h2>
            <p>تسجيل دخول الموظفين</p>
        </div>

        <div class="card-body">
            <form method="POST" action="/employee/login">
                @csrf

                <div class="field">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="employee@example.com" value="{{ old('email') }}"
                        class="{{ $errors->has('email') ? 'is-invalid' : '' }}">
                    @error('email')
                        <div class="field-error">
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                </path>
                            </svg>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="field">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="••••••••"
                        class="{{ $errors->has('password') ? 'is-invalid' : '' }}">
                    @error('password')
                        <div class="field-error">
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                </path>
                            </svg>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <button type="submit">Login</button>
            </form>
        </div>
    </div>

</body>

</html>
