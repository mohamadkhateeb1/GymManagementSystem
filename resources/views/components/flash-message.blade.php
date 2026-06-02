<style>
    .flash-alert {
        padding: 16px 20px;
        margin-bottom: 24px;
        border-radius: 12px;
        font-family: 'DM Sans', sans-serif;
        font-size: 14px;
        display: flex;
        align-items: flex-start;
        gap: 12px;
        transition: opacity 0.5s ease-out, transform 0.5s ease-out;
        opacity: 1;
        transform: translateY(0);
    }

    .flash-alert.hide {
        opacity: 0;
        transform: translateY(-10px);
        pointer-events: none;
    }

    .flash-success {
        background: #181c27;
        border: 1px solid rgba(0, 212, 170, 0.28);
        color: #e8eaf6;
        box-shadow: 0 4px 18px rgba(0, 212, 170, 0.1);
    }

    .flash-success .icon {
        color: #00d4aa;
        display: flex;
        align-items: center;
        height: 20px;
    }

    .flash-error {
        background: #181c27;
        border: 1px solid rgba(248, 113, 113, 0.28);
        color: #e8eaf6;
        box-shadow: 0 4px 18px rgba(248, 113, 113, 0.1);
    }

    .flash-error .icon {
        color: #f87171;
        display: flex;
        align-items: center;
        height: 20px;
    }
</style>

@if (session()->has('success'))
    <div class="flash-alert flash-success">
        <span class="icon">
            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
            </svg>
        </span>
        <div>{{ session('success') }}</div>
    </div>
@endif

@if (session()->has('error'))
    <div class="flash-alert flash-error">
        <span class="icon">
            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </span>
        <div>{{ session('error') }}</div>
    </div>
@endif

@if ($errors->any())
    <div class="flash-alert flash-error">
        <span class="icon">
            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
        </span>
        <ul style="margin: 0; padding-inline-start: 20px;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const flashMessages = document.querySelectorAll('.flash-alert');

        if (flashMessages.length > 0) {
            setTimeout(() => {
                flashMessages.forEach(msg => {
                    msg.classList.add('hide');

                    setTimeout(() => {
                        msg.style.display = 'none';
                    }, 500);
                });
            }, 3000);
        }
    });
</script>
