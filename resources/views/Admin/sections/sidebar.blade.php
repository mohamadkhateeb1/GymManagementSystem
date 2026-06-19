<style>
    /* إخفاء شريط التمرير بالكامل مع الحفاظ على ميزة السحب */
    .sidebar-menu {
        flex: 1;
        overflow-y: auto;
        overflow-x: hidden;
        padding-bottom: 10px;
        /* إخفاء السكرول في فايرفوكس */
        scrollbar-width: none;
    }

    /* إخفاء السكرول في كروم وسفاري وإيدج */
    .sidebar-menu::-webkit-scrollbar {
        display: none;
    }
</style>

<aside class="sidebar">
    <div class="brand">
        <div class="brand-logo">
            <div class="brand-mark"><i class="fas fa-crown"></i></div>
            <div class="brand-text">
                <h2>ELITE CLUB</h2>
                <span>Admin Dashboard</span>
            </div>
        </div>
    </div>

    <div class="sidebar-menu">
        <x-side/>
    </div>

    <div class="sidebar-footer"
        style="padding: 15px; border-top: 1px solid var(--border); margin-top: auto; background: var(--surface);">
        <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
            @csrf
            <button type="submit" class="sidebar-logout">
                <i class="fas fa-sign-out-alt"></i> تسجيل الخروج
            </button>
        </form>
    </div>
</aside>
