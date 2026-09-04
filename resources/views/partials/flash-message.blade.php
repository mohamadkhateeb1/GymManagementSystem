{{-- 🔔 حاوية الإشعارات — Partial بسيط (يُستدعى بـ @include، مش Component) --}}
<style>
    .toast-stack {
        position: fixed;
        top: 24px;
        left: 24px;
        z-index: 99999;
        display: flex;
        flex-direction: column;
        gap: 12px;
        max-width: 380px;
        width: calc(100% - 48px);
        pointer-events: none;
    }

    .toast {
        position: relative;
        pointer-events: auto;
        background: var(--surface, #13161d);
        border: 1px solid var(--border, rgba(201, 169, 97, 0.16));
        border-radius: 14px;
        padding: 16px 44px 16px 18px;
        font-family: 'Tajawal', sans-serif;
        font-size: 13.5px;
        color: var(--text, #e8eaf6);
        display: flex;
        align-items: flex-start;
        gap: 12px;
        overflow: hidden;
        box-shadow: 0 14px 34px rgba(0, 0, 0, 0.45);
        animation: toastIn 0.4s cubic-bezier(.2, .8, .3, 1) both;
    }

    @keyframes toastIn {
        from {
            opacity: 0;
            transform: translateX(-24px) scale(0.96);
        }

        to {
            opacity: 1;
            transform: translateX(0) scale(1);
        }
    }

    .toast.hide {
        animation: toastOut 0.35s ease-in forwards;
    }

    @keyframes toastOut {
        to {
            opacity: 0;
            transform: translateX(-16px) scale(0.96);
        }
    }

    .toast-success {
        border-color: rgba(90, 156, 122, 0.3);
        box-shadow: 0 14px 34px rgba(90, 156, 122, 0.1), 0 14px 34px rgba(0, 0, 0, 0.35);
    }

    .toast-success .toast-icon {
        color: #5a9c7a;
        background: rgba(90, 156, 122, 0.12);
    }

    .toast-success .toast-progress {
        background: #5a9c7a;
    }

    .toast-error {
        border-color: rgba(197, 90, 90, 0.3);
        box-shadow: 0 14px 34px rgba(197, 90, 90, 0.1), 0 14px 34px rgba(0, 0, 0, 0.35);
    }

    .toast-error .toast-icon {
        color: #c55a5a;
        background: rgba(197, 90, 90, 0.12);
    }

    .toast-error .toast-progress {
        background: #c55a5a;
    }

    .toast-icon {
        width: 32px;
        height: 32px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .toast-body {
        flex: 1;
        line-height: 1.6;
        padding-top: 4px;
    }

    .toast-body ul {
        margin: 0;
        padding-inline-start: 18px;
    }

    .toast-close {
        position: absolute;
        top: 10px;
        left: 10px;
        width: 22px;
        height: 22px;
        border: none;
        background: transparent;
        color: var(--text-soft, #9ca3af);
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 6px;
        transition: background 0.2s ease, color 0.2s ease;
        font-size: 12px;
    }

    .toast-close:hover {
        background: rgba(255, 255, 255, 0.08);
        color: var(--text, #e8eaf6);
    }

    .toast-progress {
        position: absolute;
        bottom: 0;
        right: 0;
        left: 0;
        height: 3px;
        width: 100%;
        transform-origin: right;
        animation: toastProgress 4s linear forwards;
    }

    @keyframes toastProgress {
        from {
            transform: scaleX(1);
        }

        to {
            transform: scaleX(0);
        }
    }
</style>

<div class="toast-stack" id="toastStack">

    {{-- 🛡️ استخدام session('success') مباشرة بدل session()->has() — نفس النتيجة، أبسط وأصرح --}}
    @if (session('success'))
        <div class="toast toast-success">
            <span class="toast-icon">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                </svg>
            </span>
            <div class="toast-body">{{ session('success') }}</div>
            <button type="button" class="toast-close" onclick="this.closest('.toast').remove()">
                <i class="fas fa-times"></i>
            </button>
            <div class="toast-progress"></div>
        </div>
    @endif

    @if (session('error'))
        <div class="toast toast-error">
            <span class="toast-icon">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </span>
            <div class="toast-body">{{ session('error') }}</div>
            <button type="button" class="toast-close" onclick="this.closest('.toast').remove()">
                <i class="fas fa-times"></i>
            </button>
            <div class="toast-progress"></div>
        </div>
    @endif

    @if ($errors->any())
        <div class="toast toast-error">
            <span class="toast-icon">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </span>
            <div class="toast-body">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            <button type="button" class="toast-close" onclick="this.closest('.toast').remove()">
                <i class="fas fa-times"></i>
            </button>
            <div class="toast-progress"></div>
        </div>
    @endif

</div>

{{-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('#toastStack .toast').forEach((toast) => {
            setTimeout(() => {
                toast.classList.add('hide');
                setTimeout(() => toast.remove(), 400);
            }, 4000);
        });
    });
</script> --}}
