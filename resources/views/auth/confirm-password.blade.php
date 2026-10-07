@extends('Admin.layouts.app')

@section('title', 'تأكيد كلمة المرور - Elite Club')

@section('page-title', 'تأكيد كلمة المرور')

@section('page-description', 'يرجى تأكيد كلمة المرور للمتابعة إلى المنطقة الآمنة')

@section('styles')

<style>
    .password-confirm-page {
        width: 100%;
        max-width: 560px;
        margin: 45px auto;
    }

    .password-confirm-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 18px;
        box-shadow: var(--shadow-sm);
        overflow: hidden;
    }

    .password-confirm-header {
        position: relative;
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 22px 24px;
        border-bottom: 1px solid var(--border-soft);
    }

    .password-confirm-header::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 100%;
        height: 3px;
        background:
            linear-gradient(
                90deg,
                var(--gold-dark),
                var(--gold-light),
                var(--gold-dark)
            );
    }

    .password-confirm-icon {
        width: 46px;
        height: 46px;

        display: flex;
        align-items: center;
        justify-content: center;

        flex-shrink: 0;

        border-radius: 12px;

        color: var(--gold-dark);

        background: var(--warning-bg);

        font-size: 17px;
    }

    html[data-theme="dark"] .password-confirm-icon {
        color: var(--gold-light);
    }

    .password-confirm-title {
        min-width: 0;
    }

    .password-confirm-title h2 {
        margin: 0;

        color: var(--text);

        font-size: 17px;
        font-weight: 900;
    }

    .password-confirm-title p {
        margin: 4px 0 0;

        color: var(--muted);

        font-size: 10.5px;
        font-weight: 500;
    }

    .password-confirm-body {
        padding: 25px 24px;
    }

    .password-confirm-notice {
        display: flex;
        align-items: flex-start;
        gap: 11px;

        margin-bottom: 22px;
        padding: 13px 14px;

        border-radius: 11px;

        background: var(--surface-2);

        border: 1px solid var(--border-soft);
    }

    .password-confirm-notice i {
        margin-top: 2px;

        color: var(--gold-dark);

        font-size: 12px;
    }

    html[data-theme="dark"] .password-confirm-notice i {
        color: var(--gold-light);
    }

    .password-confirm-notice p {
        margin: 0;

        color: var(--text-soft);

        font-size: 10.5px;
        font-weight: 500;

        line-height: 1.8;
    }

    .password-form-group {
        margin-bottom: 18px;
    }

    .password-form-label {
        display: block;

        margin-bottom: 7px;

        color: var(--text-soft);

        font-size: 11.5px;
        font-weight: 800;
    }

    .password-input-wrapper {
        position: relative;
    }

    .password-input-icon {
        position: absolute;

        top: 50%;
        right: 14px;

        transform: translateY(-50%);

        color: var(--muted);

        font-size: 12px;

        pointer-events: none;
    }

    .password-input {
        width: 100%;

        min-height: 46px;

        padding:
            10px
            40px
            10px
            13px;

        color: var(--text);

        background: var(--input-bg);

        border: 1px solid var(--input-border);

        border-radius: 10px;

        outline: none;

        font-size: 12px;
        font-weight: 500;

        transition:
            border-color .2s ease,
            box-shadow .2s ease,
            background .2s ease;
    }

    .password-input:focus {
        border-color: var(--gold);

        box-shadow:
            0 0 0 3px rgba(184, 148, 69, .10);
    }

    .password-input.is-invalid {
        border-color: var(--danger);
    }

    .password-input::placeholder {
        color: var(--muted-light);
    }

    .password-error {
        display: block;

        margin-top: 6px;

        color: var(--danger);

        font-size: 10px;
        font-weight: 600;
    }

    .password-confirm-button {
        width: 100%;

        min-height: 46px;

        display: flex;
        align-items: center;
        justify-content: center;

        gap: 8px;

        margin-top: 22px;

        border: 0;
        border-radius: 10px;

        color: #fff;

        background:
            linear-gradient(
                135deg,
                var(--gold-light),
                var(--gold-dark)
            );

        box-shadow:
            0 5px 15px rgba(184, 148, 69, .14);

        font-size: 12px;
        font-weight: 800;

        cursor: pointer;

        transition:
            transform .2s ease,
            box-shadow .2s ease;
    }

    .password-confirm-button:hover {
        transform: translateY(-1px);

        box-shadow:
            0 8px 20px rgba(184, 148, 69, .20);
    }

    @media (max-width: 768px) {
        .password-confirm-page {
            margin: 25px auto;
        }

        .password-confirm-body {
            padding: 21px 18px;
        }

        .password-confirm-header {
            padding: 19px 18px;
        }
    }
</style>

@endsection


@section('content')

<div class="password-confirm-page">

    <div class="password-confirm-card">

        <div class="password-confirm-header">

            <div class="password-confirm-icon">
                <i class="fas fa-shield-halved"></i>
            </div>

            <div class="password-confirm-title">

                <h2>
                    تأكيد كلمة المرور
                </h2>

                <p>
                    تحقق من هويتك للمتابعة
                </p>

            </div>

        </div>


        <div class="password-confirm-body">

            <div class="password-confirm-notice">

                <i class="fas fa-circle-info"></i>

                <p>
                    هذه منطقة آمنة من النظام.
                    يرجى تأكيد كلمة المرور الحالية قبل المتابعة.
                </p>

            </div>


            <form
                method="POST"
                action="{{ route('password.confirm') }}"
            >

                @csrf


                <div class="password-form-group">

                    <label
                        for="password"
                        class="password-form-label"
                    >
                        كلمة المرور الحالية
                    </label>


                    <div class="password-input-wrapper">

                        <i class="fas fa-lock password-input-icon"></i>

                        <input
                            id="password"
                            class="password-input @error('password') is-invalid @enderror"
                            type="password"
                            name="password"
                            required
                            autocomplete="current-password"
                            placeholder="أدخل كلمة المرور الحالية"
                        >

                    </div>


                    @error('password')

                        <span class="password-error">
                            {{ $message }}
                        </span>

                    @enderror

                </div>


                <button
                    type="submit"
                    class="password-confirm-button"
                >

                    <i class="fas fa-check-circle"></i>

                    تأكيد كلمة المرور

                </button>

            </form>

        </div>

    </div>

</div>

@endsection