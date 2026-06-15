<style>
    .navbar {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        gap: 14px;
        background: rgba(18, 23, 34, 0.85);
        backdrop-filter: blur(8px);
        padding: 14px 30px;
        border-bottom: 1px solid var(--gold-line);
        margin-bottom: 22px;
        position: sticky;
        top: 0;
        z-index: 10;
    }

    .navbar .user-info {
        display: flex;
        align-items: center;
        gap: 11px;
        padding: 6px 14px 6px 6px;
        background: var(--surface-2);
        border: 1px solid rgba(255, 255, 255, 0.05);
        border-radius: 999px;
    }

    .navbar .user-name {
        color: var(--text);
        font-weight: 600;
        font-size: 14.5px;
    }

    .navbar .user-avatar {
        width: 34px;
        height: 34px;
        display: grid;
        place-items: center;
        border-radius: 50%;
        font-size: 14px;
        color: #0a0d14;
        background: linear-gradient(135deg, #e7cd8e, #c9a961);
    }
</style>

<nav class="navbar">
    <div class="user-info">
        <span class="user-name">{{ auth()->guard('employee')->user()->name }}</span>
        <span class="user-avatar"><i class="fas fa-user"></i></span>
    </div>
</nav>
