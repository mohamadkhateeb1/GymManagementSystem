<style>
    @import url('https://fonts.googleapis.com/css2?family=Syne:wght@600;700;800&family=DM+Sans:wght@300;400;500;600&display=swap');

    :root {
        --bg: #0d0f14;
        --card: #181c27;
        --border: #252a38;
        --accent: #6c63ff;
        --accent2: #00d4aa;
        --text: #e8eaf6;
        --muted: #6b7280;
        --input-bg: #1e2233;
        --danger: #f87171;
    }

    body {
        background: var(--bg);
        font-family: 'DM Sans', sans-serif;
        color: var(--text);
    }

    /* ---- WRAPPER ---- */
    .edit-wrapper {
        max-width: 720px;
        margin: 2.5rem auto;
        padding: 0 1.25rem 4rem;
    }

    /* ---- BREADCRUMB ---- */
    .breadcrumb-row {
        display: flex;
        align-items: center;
        gap: .5rem;
        font-size: .78rem;
        color: var(--muted);
        margin-bottom: 1.75rem;
    }

    .breadcrumb-row a {
        color: var(--muted);
        text-decoration: none;
        transition: color .15s;
    }

    .breadcrumb-row a:hover {
        color: var(--text);
    }

    .breadcrumb-row span {
        color: var(--accent);
        font-weight: 600;
    }

    .breadcrumb-row svg {
        width: 13px;
        height: 13px;
        flex-shrink: 0;
    }

    /* ---- CARD ---- */
    .edit-card {
        background: var(--card);
        border: 1px solid var(--border);
        border-radius: 1.25rem;
        overflow: hidden;
        box-shadow: 0 8px 40px rgba(0, 0, 0, .3);
    }

    /* ---- CARD HEADER ---- */
    .edit-card-header {
        padding: 1.5rem 1.75rem;
        border-bottom: 1px solid var(--border);
        display: flex;
        align-items: center;
        gap: 1rem;
        position: relative;
        overflow: hidden;
    }

    .edit-card-header::after {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 3px;
        background: linear-gradient(180deg, var(--accent), var(--accent2));
        border-radius: 0 2px 2px 0;
    }

    .header-icon {
        width: 40px;
        height: 40px;
        border-radius: .75rem;
        background: rgba(108, 99, 255, .15);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--accent);
        flex-shrink: 0;
    }

    .header-icon svg {
        width: 20px;
        height: 20px;
    }

    .header-text h3 {
        font-family: 'Syne', sans-serif;
        font-size: 1.05rem;
        font-weight: 700;
        color: var(--text);
        line-height: 1.2;
    }

    .header-text p {
        font-size: .78rem;
        color: var(--muted);
        margin-top: .15rem;
    }

    /* ---- CARD BODY ---- */
    .edit-card-body {
        padding: 1.75rem;
    }

    /* ---- FORM FIELDS (override AdminLTE / Bootstrap) ---- */
    .edit-card-body .form-group label,
    .edit-card-body label {
        font-size: .78rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .07em;
        color: var(--muted);
        margin-bottom: .5rem;
        display: block;
    }

    .edit-card-body .form-control,
    .edit-card-body input:not([type=submit]):not([type=checkbox]):not([type=radio]),
    .edit-card-body select,
    .edit-card-body textarea {
        background: var(--input-bg) !important;
        border: 1px solid var(--border) !important;
        border-radius: .65rem !important;
        color: var(--text) !important;
        font-family: 'DM Sans', sans-serif !important;
        font-size: .875rem !important;
        padding: .65rem 1rem !important;
        width: 100%;
        transition: border-color .2s, box-shadow .2s !important;
        box-shadow: none !important;
    }

    .edit-card-body .form-control:focus,
    .edit-card-body input:focus,
    .edit-card-body select:focus,
    .edit-card-body textarea:focus {
        border-color: var(--accent) !important;
        box-shadow: 0 0 0 3px rgba(108, 99, 255, .15) !important;
        outline: none !important;
    }

    .edit-card-body .form-control::placeholder,
    .edit-card-body input::placeholder {
        color: #3d4255 !important;
    }

    .edit-card-body select option {
        background: var(--card);
        color: var(--text);
    }

    .edit-card-body .invalid-feedback,
    .edit-card-body .text-danger {
        font-size: .76rem;
        color: var(--danger) !important;
        margin-top: .3rem;
        display: block;
    }

    .edit-card-body .is-invalid,
    .edit-card-body .form-control.is-invalid {
        border-color: var(--danger) !important;
        box-shadow: 0 0 0 3px rgba(248, 113, 113, .12) !important;
    }

    .edit-card-body .form-group {
        margin-bottom: 1.25rem;
    }

    /* ---- CARD FOOTER ---- */
    .edit-card-footer {
        padding: 1.25rem 1.75rem;
        border-top: 1px solid var(--border);
        display: flex;
        align-items: center;
        gap: .75rem;
        flex-wrap: wrap;
    }

    .btn-update {
        display: inline-flex;
        align-items: center;
        gap: .45rem;
        padding: .6rem 1.5rem;
        border-radius: .7rem;
        font-family: 'DM Sans', sans-serif;
        font-size: .875rem;
        font-weight: 600;
        color: #fff;
        background: linear-gradient(135deg, var(--accent), #818cf8);
        border: none;
        cursor: pointer;
        transition: opacity .2s, transform .2s, box-shadow .2s;
        box-shadow: 0 4px 18px rgba(108, 99, 255, .35);
    }

    .btn-update:hover {
        opacity: .9;
        transform: translateY(-1px);
        box-shadow: 0 6px 24px rgba(108, 99, 255, .45);
    }

    .btn-update svg {
        width: 16px;
        height: 16px;
    }

    .btn-cancel {
        display: inline-flex;
        align-items: center;
        gap: .45rem;
        padding: .6rem 1.25rem;
        border-radius: .7rem;
        font-family: 'DM Sans', sans-serif;
        font-size: .875rem;
        font-weight: 500;
        color: var(--muted);
        background: transparent;
        border: 1px solid var(--border);
        text-decoration: none;
        transition: color .2s, border-color .2s, background .2s;
    }

    .btn-cancel:hover {
        color: var(--text);
        border-color: #3d4460;
        background: rgba(255, 255, 255, .04);
    }

    .btn-cancel svg {
        width: 15px;
        height: 15px;
    }

    /* ---- FADE IN ---- */
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

    .edit-wrapper {
        animation: fadeUp .35s ease both;
    }
</style>

<div class="edit-wrapper">

    {{-- Breadcrumb --}}
    <div class="breadcrumb-row">
        <a href="{{ route('admins.index') }}">Admins</a>
        <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
        </svg>
        <span>Edit Admin</span>
    </div>

    {{-- Card --}}
    <div class="edit-card">

        {{-- Header --}}
        <div class="edit-card-header">
            <div class="header-icon">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 7.125L18 8.625" />
                </svg>
            </div>
            <div class="header-text">
                <h3>Edit Admin</h3>
                <p>تعديل بيانات المشرف — جميع الحقول مطلوبة</p>
            </div>
        </div>

        {{-- Form --}}
        <form action="{{ route('admins.update', $admin->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="edit-card-body">
                @include('Admin.admins._form')
            </div>

            <div class="edit-card-footer">
                <button type="submit" class="btn-update">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Update
                </button>
                <a href="{{ route('admins.index') }}" class="btn-cancel">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    Cancel
                </a>
            </div>
        </form>

    </div>
</div>
