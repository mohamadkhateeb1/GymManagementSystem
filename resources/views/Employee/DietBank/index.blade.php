@extends('Employee.layouts.app')

@section('title', 'بنك الوجبات الغذائية | Elite Club')

@section('styles') <link rel="preconnect" href="https://fonts.googleapis.com"> <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;800&display=swap" rel="stylesheet">

<style>
    /* =========================================================
       ELITE CLUB — DIET BANK
       DESIGN ONLY
       ========================================================= */

    .diet-bank-container {
        width: 100%;
        padding: 0;
        color: var(--text);
        font-family: "Cairo", "Tajawal", Arial, sans-serif;
    }

    /* =========================================================
       PAGE HEADER
       ========================================================= */

    .diet-bank-container > div:first-child {
        min-height: 68px;
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
        gap: 18px;
        margin-bottom: 20px !important;
        padding: 4px 2px;
    }

    .diet-bank-container > div:first-child h2 {
        margin: 0 !important;
        color: var(--text) !important;
        font-size: 24px;
        font-weight: 850;
        line-height: 1.4;
        letter-spacing: -.4px;
    }

    .diet-bank-container > div:first-child h2 i {
        color: var(--gold) !important;
        font-size: 20px;
        margin-left: 9px !important;
    }

    /* =========================================================
       ADD BUTTON
       ========================================================= */

    .btn-green {
        min-height: 43px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 9px 15px;
        color: #171717;
        background: linear-gradient(135deg, var(--gold-light), var(--gold-dark));
        border: 1px solid color-mix(in srgb, var(--gold) 45%, var(--border));
        border-radius: 11px;
        box-shadow: 0 7px 18px rgba(184, 146, 62, .14);
        text-decoration: none;
        font-size: 10px;
        font-weight: 800;
        cursor: pointer;
        transition: transform .2s ease, box-shadow .2s ease, filter .2s ease;
    }

    .btn-green:hover {
        color: #171717;
        transform: translateY(-2px);
        box-shadow: 0 11px 25px rgba(184, 146, 62, .22);
        filter: brightness(1.03);
    }

    .btn-green:active {
        transform: scale(.97);
    }

    .btn-green i {
        font-size: 10px;
    }

    /* =========================================================
       DIET GRID
       ========================================================= */

    .diet-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(275px, 1fr));
        gap: 16px;
        margin-top: 0;
    }

    /* =========================================================
       DIET CARD
       ========================================================= */

    .diet-card {
        position: relative;
        min-width: 0;
        display: flex;
        flex-direction: column;
        overflow: hidden;
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 17px;
        box-shadow: var(--shadow-sm);
        transition:
            transform .22s ease,
            border-color .22s ease,
            box-shadow .22s ease,
            background .25s ease;
        opacity: 0;
        animation: dietCardIn .5s cubic-bezier(.2, .7, .2, 1) both;
    }

    .diet-card:nth-child(1) { animation-delay: .04s; }
    .diet-card:nth-child(2) { animation-delay: .08s; }
    .diet-card:nth-child(3) { animation-delay: .12s; }
    .diet-card:nth-child(4) { animation-delay: .16s; }
    .diet-card:nth-child(5) { animation-delay: .20s; }
    .diet-card:nth-child(6) { animation-delay: .24s; }

    @keyframes dietCardIn {
        from {
            opacity: 0;
            transform: translateY(12px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .diet-card:hover {
        transform: translateY(-4px);
        border-color: color-mix(in srgb, var(--gold) 28%, var(--border));
        box-shadow: var(--shadow);
    }

    .diet-card::after {
        content: "";
        position: absolute;
        left: -30px;
        bottom: -40px;
        width: 110px;
        height: 110px;
        border-radius: 50%;
        background: color-mix(in srgb, var(--gold) 6%, transparent);
        pointer-events: none;
    }

    /* =========================================================
       IMAGE
       ========================================================= */

    .diet-card-image {
        width: 100%;
        height: 185px;
        display: block;
        object-fit: cover;
        border-bottom: 1px solid var(--border);
        transition: transform .35s ease, filter .35s ease;
    }

    .diet-card:hover .diet-card-image {
        transform: scale(1.025);
        filter: saturate(1.04);
    }

    .diet-card-image-placeholder {
        height: 185px;
        display: flex;
        align-items: center;
        justify-content: center;
        background:
            radial-gradient(circle at center,
                color-mix(in srgb, var(--gold) 9%, var(--surface-2)),
                var(--surface-2) 55%,
                var(--surface-3));
        color: var(--gold);
        border-bottom: 1px solid var(--border);
        font-size: 34px;
    }

    .diet-card-image-placeholder i {
        opacity: .72;
        transition: transform .25s ease, opacity .25s ease;
    }

    .diet-card:hover .diet-card-image-placeholder i {
        transform: scale(1.1) rotate(-4deg);
        opacity: 1;
    }

    /* =========================================================
       LEVEL BADGE
       ========================================================= */

    .level-badge {
        position: absolute;
        top: 11px;
        left: 11px;
        z-index: 5;
        min-height: 25px;
        display: inline-flex;
        align-items: center;
        padding: 4px 9px;
        color: #171717;
        background: linear-gradient(135deg, var(--gold-light), var(--gold-dark));
        border: 1px solid rgba(255, 255, 255, .14);
        border-radius: 8px;
        box-shadow: 0 5px 14px rgba(0, 0, 0, .16);
        font-size: 8px;
        font-weight: 800;
        text-transform: capitalize;
    }

    /* =========================================================
       DELETE BUTTON
       ========================================================= */

    .btn-delete {
        position: absolute;
        top: 11px;
        right: 11px;
        z-index: 10;
        width: 31px;
        height: 31px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0;
        color: var(--danger);
        background: color-mix(in srgb, var(--surface) 84%, transparent);
        border: 1px solid color-mix(in srgb, var(--danger) 25%, var(--border));
        border-radius: 9px;
        box-shadow: 0 5px 14px rgba(0, 0, 0, .12);
        backdrop-filter: blur(8px);
        cursor: pointer;
        font-size: 10px;
        transition:
            background .18s ease,
            border-color .18s ease,
            color .18s ease,
            transform .18s ease;
    }

    .btn-delete:hover {
        color: #fff;
        background: var(--danger);
        border-color: var(--danger);
        transform: translateY(-1px) scale(1.04);
    }

    .btn-delete:active {
        transform: scale(.92);
    }

    /* =========================================================
       CARD BODY
       ========================================================= */

    .diet-card-body {
        min-height: 205px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 17px;
        background: var(--surface);
    }

    .diet-card-title {
        margin: 2px 0 8px 0;
        color: var(--text);
        font-size: 14px;
        font-weight: 850;
        line-height: 1.6;
        text-align: right;
    }

    .diet-card-desc {
        min-height: 52px;
        margin: 0 0 14px 0;
        color: var(--muted);
        font-size: 9.5px;
        font-weight: 500;
        line-height: 1.9;
        text-align: right;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* =========================================================
       CARD FOOTER
       ========================================================= */

    .diet-card-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 8px;
        flex-wrap: wrap;
        padding-top: 13px;
        border-top: 1px solid var(--border);
    }

    /* =========================================================
       MACROS
       ========================================================= */

    .macros-row {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: flex-start;
        gap: 6px;
        flex-wrap: wrap;
        margin-bottom: 3px;
    }

    .macro-badge {
        min-height: 24px;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 4px 7px;
        border-radius: 7px;
        border: 1px solid transparent;
        font-size: 7.5px;
        font-weight: 750;
        white-space: nowrap;
    }

    .macro-badge i {
        font-size: 8px;
    }

    .macro-badge.protein {
        color: var(--info, #60a5fa);
        background: color-mix(in srgb, var(--info, #60a5fa) 8%, var(--surface-2));
        border-color: color-mix(in srgb, var(--info, #60a5fa) 14%, var(--border));
    }

    .macro-badge.carbs {
        color: #d8a91e;
        background: color-mix(in srgb, #d8a91e 8%, var(--surface-2));
        border-color: color-mix(in srgb, #d8a91e 14%, var(--border));
    }

    .macro-badge.fats {
        color: #e87575;
        background: color-mix(in srgb, #e87575 8%, var(--surface-2));
        border-color: color-mix(in srgb, #e87575 14%, var(--border));
    }

    /* =========================================================
       CALORIES
       ========================================================= */

    .calories-badge {
        min-height: 27px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin: 0;
        padding: 5px 10px;
        color: var(--gold-dark);
        background: color-mix(in srgb, var(--gold) 10%, var(--surface-2));
        border: 1px solid color-mix(in srgb, var(--gold) 20%, var(--border));
        border-radius: 8px;
        font-size: 8px;
        font-weight: 800;
    }

    /* =========================================================
       EMPTY STATE
       ========================================================= */

    .diet-grid > div[style*="grid-column"] {
        min-height: 220px;
        display: flex !important;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 35px !important;
        color: var(--muted) !important;
        background: var(--surface);
        border: 1px dashed var(--border);
        border-radius: 17px;
        font-size: 10px;
    }

    /* =========================================================
       MODAL
       ========================================================= */

    .modal {
        display: none;
        position: fixed;
        z-index: 9999;
        inset: 0;
        align-items: center;
        justify-content: center;
        padding: 20px;
        background: rgba(15, 18, 24, .58);
        backdrop-filter: blur(7px);
        -webkit-backdrop-filter: blur(7px);
        opacity: 0;
        transition: opacity .2s ease;
    }

    .modal.open {
        display: flex;
        opacity: 1;
    }

    .modal-content {
        width: 100%;
        max-width: 520px;
        max-height: calc(100vh - 40px);
        overflow: hidden;
        background: var(--surface) !important;
        border: 1px solid color-mix(in srgb, var(--gold) 25%, var(--border)) !important;
        border-radius: 18px;
        box-shadow: var(--shadow);
        transform: translateY(8px) scale(.98);
        animation: dietModalIn .25s cubic-bezier(.2, .7, .2, 1) forwards;
    }

    @keyframes dietModalIn {
        to {
            transform: translateY(0) scale(1);
        }
    }

    /* =========================================================
       MODAL HEADER
       ========================================================= */

    .modal-header {
        min-height: 66px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        padding: 14px 18px;
        background: var(--surface);
        border-bottom: 1px solid var(--border) !important;
    }

    .modal-header h4 {
        display: flex;
        align-items: center;
        gap: 9px;
        margin: 0;
        color: var(--text);
        font-size: 13px;
        font-weight: 800;
    }

    .modal-header h4 i {
        color: var(--gold) !important;
        font-size: 13px;
    }

    .close-modal {
        width: 31px;
        height: 31px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--muted);
        background: var(--surface-2);
        border: 1px solid var(--border);
        border-radius: 9px;
        cursor: pointer;
        font-size: 20px;
        font-weight: 500;
        line-height: 1;
        transition:
            color .18s ease,
            background .18s ease,
            border-color .18s ease,
            transform .18s ease;
    }

    .close-modal:hover {
        color: var(--danger);
        background: color-mix(in srgb, var(--danger) 7%, var(--surface-2));
        border-color: color-mix(in srgb, var(--danger) 25%, var(--border));
        transform: rotate(4deg);
    }

    /* =========================================================
       MODAL BODY
       ========================================================= */

    .modal-body {
        padding: 19px;
        max-height: 75vh;
        overflow-y: auto;
        background: var(--surface);
        scrollbar-width: thin;
        scrollbar-color: var(--border) transparent;
    }

    /* =========================================================
       FORM FIELDS
       ========================================================= */

    .field-group {
        margin-bottom: 15px;
    }

    .field-label {
        display: block;
        margin-bottom: 6px;
        color: var(--text-soft);
        font-size: 9.5px;
        font-weight: 750;
    }

    .field-input {
        width: 100%;
        min-height: 42px;
        padding: 9px 11px;
        color: var(--text) !important;
        background: var(--surface-2) !important;
        border: 1px solid var(--border) !important;
        border-radius: 10px;
        outline: none;
        box-sizing: border-box;
        font-family: "Cairo", "Tajawal", Arial, sans-serif;
        font-size: 10px;
        transition:
            background .2s ease,
            border-color .2s ease,
            box-shadow .2s ease;
    }

    .field-input::placeholder {
        color: var(--muted);
    }

    .field-input:focus {
        background: var(--surface) !important;
        border-color: color-mix(in srgb, var(--gold) 55%, var(--border)) !important;
        box-shadow: 0 0 0 3px color-mix(in srgb, var(--gold) 9%, transparent);
    }

    textarea.field-input {
        min-height: 105px;
        resize: vertical;
        line-height: 1.8;
    }

    select.field-input {
        cursor: pointer;
    }

    .field-row {
        display: flex;
        gap: 10px;
    }

    .field-row .field-group {
        flex: 1;
        min-width: 0;
    }

    .field-hint {
        display: block;
        margin-top: -8px !important;
        margin-bottom: 15px !important;
        color: var(--muted);
        font-size: 8px;
        font-weight: 500;
        line-height: 1.7;
    }

    /* =========================================================
       FILE INPUT
       ========================================================= */

    .field-input[type="file"] {
        padding: 8px;
        cursor: pointer;
    }

    .field-input[type="file"]::file-selector-button {
        margin-left: 8px;
        padding: 6px 10px;
        color: var(--gold-dark);
        background: color-mix(in srgb, var(--gold) 9%, var(--surface));
        border: 1px solid color-mix(in srgb, var(--gold) 18%, var(--border));
        border-radius: 7px;
        font-family: inherit;
        font-size: 8px;
        font-weight: 700;
        cursor: pointer;
    }

    /* =========================================================
       SUBMIT BUTTON
       ========================================================= */

    .btn-submit {
        width: 100%;
        min-height: 46px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        margin-top: 4px;
        padding: 10px 14px;
        color: #171717;
        background: linear-gradient(135deg, var(--gold-light), var(--gold-dark));
        border: 0;
        border-radius: 11px;
        box-shadow: 0 8px 20px rgba(184, 146, 62, .15);
        cursor: pointer;
        font-family: "Cairo", "Tajawal", Arial, sans-serif;
        font-size: 10px;
        font-weight: 850;
        transition: transform .2s ease, box-shadow .2s ease, filter .2s ease;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 28px rgba(184, 146, 62, .23);
        filter: brightness(1.03);
    }

    .btn-submit:active {
        transform: scale(.98);
    }

    /* =========================================================
       DARK MODE
       يعتمد بالكامل على Global Theme
       ========================================================= */

    html[data-theme="dark"] .diet-card,
    body.dark .diet-card,
    body[data-theme="dark"] .diet-card,
    html[data-theme="dark"] .modal-content,
    body.dark .modal-content,
    body[data-theme="dark"] .modal-content {
        background: var(--surface) !important;
        border-color: var(--border) !important;
    }

    html[data-theme="dark"] .diet-card-body,
    body.dark .diet-card-body,
    body[data-theme="dark"] .diet-card-body,
    html[data-theme="dark"] .modal-header,
    body.dark .modal-header,
    body[data-theme="dark"] .modal-header,
    html[data-theme="dark"] .modal-body,
    body.dark .modal-body,
    body[data-theme="dark"] .modal-body {
        background: var(--surface) !important;
    }

    /* =========================================================
       RESPONSIVE
       ========================================================= */

    @media (max-width: 900px) {

        .diet-bank-container > div:first-child {
            min-height: 62px;
            margin-bottom: 17px !important;
        }

        .diet-bank-container > div:first-child h2 {
            font-size: 20px;
        }

        .diet-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 13px;
        }

        .diet-card-image,
        .diet-card-image-placeholder {
            height: 165px;
        }

        .diet-card-body {
            padding: 15px;
        }
    }

    @media (max-width: 700px) {

        .diet-bank-container > div:first-child {
            align-items: flex-start !important;
            flex-direction: column;
            gap: 12px;
            padding: 2px 0;
        }

        .diet-bank-container > div:first-child h2 {
            font-size: 19px;
        }

        .btn-green {
            width: 100%;
        }

        .diet-grid {
            grid-template-columns: 1fr;
            gap: 13px;
        }

        .diet-card-image,
        .diet-card-image-placeholder {
            height: 190px;
        }

        .diet-card-body {
            min-height: 195px;
        }

        .modal {
            padding: 12px;
        }

        .modal-content {
            max-height: calc(100vh - 24px);
            border-radius: 15px;
        }

        .modal-header {
            min-height: 59px;
            padding: 12px 14px;
        }

        .modal-body {
            padding: 15px;
        }

        .field-row {
            flex-direction: column;
            gap: 0;
        }
    }

    @media (max-width: 480px) {

        .diet-bank-container > div:first-child h2 {
            font-size: 17px;
        }

        .diet-bank-container > div:first-child h2 i {
            font-size: 16px;
        }

        .diet-card-image,
        .diet-card-image-placeholder {
            height: 175px;
        }

        .diet-card-title {
            font-size: 13px;
        }

        .diet-card-desc {
            font-size: 9px;
        }

        .macro-badge {
            font-size: 7px;
        }

        .calories-badge {
            font-size: 7.5px;
        }
    }
</style>

@endsection

@section('content') <div class="dashboard-wrapper diet-bank-container"> <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;"> <h2 style="color: #fff; margin: 0;"><i class="fas fa-apple-alt" style="color: var(--green); margin-left: 8px;"></i>
بنك الوجبات والخطط الغذائية</h2> <button class="btn-green" onclick="openDietModal()"><i class="fas fa-plus"></i> إضافة وجبة جديدة للبنك</button> </div>

    <div class="diet-grid">
        @forelse($dietPlans as $diet)
            <div class="diet-card">
                <span class="level-badge">{{ $diet->level }}</span>

                <form action="{{ route('employee.diet.bank.destroy', $diet->id) }}" method="POST"
                    onsubmit="return confirm('هل تريد حذف هذه الوجبة من البنك؟')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-delete"><i class="fas fa-trash-alt"></i></button>
                </form>

                @if (!empty($diet->image_path))
                    <img src="{{ asset('storage/' . $diet->image_path) }}" class="diet-card-image" alt="Meal Image">
                @else
                    <div class="diet-card-image-placeholder">
                        <i class="fas fa-utensils"></i>
                    </div>
                @endif

                <div class="diet-card-body">
                    <h4 class="diet-card-title">{{ $diet->meal_name }}</h4>
                    <p class="diet-card-desc">{{ $diet->plan_details }}</p>

                    <div class="diet-card-footer">
                        @if ($diet->protein !== null || $diet->carbs !== null || $diet->fats !== null)
                            <div class="macros-row">
                                @if ($diet->protein !== null)
                                    <span class="macro-badge protein"><i class="fas fa-drumstick-bite"></i>
                                        {{ $diet->protein }}غ بروتين</span>
                                @endif
                                @if ($diet->carbs !== null)
                                    <span class="macro-badge carbs"><i class="fas fa-bread-slice"></i>
                                        {{ $diet->carbs }}غ كارب</span>
                                @endif
                                @if ($diet->fats !== null)
                                    <span class="macro-badge fats"><i class="fas fa-oil-can"></i>
                                        {{ $diet->fats }}غ دهون</span>
                                @endif
                            </div>
                        @endif
                        <span class="calories-badge">سعرة {{ $diet->calories }}</span>
                    </div>
                </div>
            </div>
        @empty
            <div style="grid-column: 1/-1; text-align: center; padding: 40px; color: var(--muted);">البنك فارغ من
                الوجبات حالياً لهذا المستوى.</div>
        @endforelse
    </div>

    {{-- ===== الـ Modal المنبثق لإضافة وجبة للمستويات وتحديد مستواها ===== --}}
    <div id="addDietModal" class="modal">
        <div class="modal-content" style="border-color: rgba(74, 222, 128, 0.3);">
            <div class="modal-header" style="border-bottom-color: var(--green-soft);">
                <h4><i class="fas fa-apple-alt" style="color: var(--green);"></i> إضافة وجبة غذائية للبنك</h4>
                <span class="close-modal" onclick="closeDietModal()">&times;</span>
            </div>
            <form action="{{ route('employee.diet.bank.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="field-group">
                        <label class="field-label">اسم الوجبة</label>
                        <input type="text" name="meal_name" class="field-input" placeholder="مثال: صدر دجاج مع أرز"
                            required>
                    </div>
                    <div class="field-group">
                        <label class="field-label">المستوى المستهدف للوجبة</label>
                        <select name="level" class="field-input" required>
                            <option value="">-- اختر المستوى لتخصيص الوجبة له تلقائياً --</option>
                            <option value="beginner">Beginner (مبتدئ)</option>
                            <option value="intermediate">Intermediate (متوسط)</option>
                            <option value="advanced">Advanced (متقدم)</option>
                        </select>
                    </div>
                    <div class="field-group">
                        <label class="field-label">عدد السعرات الحرارية (Calories)</label>
                        <input type="number" name="calories" class="field-input" placeholder="مثال: 520" required>
                    </div>

                    <div class="field-row">
                        <div class="field-group">
                            <label class="field-label">بروتين (غ)</label>
                            <input type="number" step="0.1" min="0" name="protein" class="field-input"
                                placeholder="مثال: 35">
                        </div>
                        <div class="field-group">
                            <label class="field-label">كربوهيدرات (غ)</label>
                            <input type="number" step="0.1" min="0" name="carbs" class="field-input"
                                placeholder="مثال: 40">
                        </div>
                        <div class="field-group">
                            <label class="field-label">دهون (غ)</label>
                            <input type="number" step="0.1" min="0" name="fats" class="field-input"
                                placeholder="مثال: 12">
                        </div>
                    </div>
                    <span class="field-hint" style="display: block; margin-top: -10px; margin-bottom: 16px;">الماكروز
                        اختيارية، وتُعرض بالتطبيق إن تم إدخالها.</span>

                    <div class="field-group">
                        <label class="field-label">صورة الوجبة</label>
                        <input type="file" name="image" class="field-input" accept="image/*">
                    </div>
                    <div class="field-group">
                        <label class="field-label">المكونات والتفاصيل</label>
                        <textarea name="plan_details" class="field-input" rows="4" placeholder="اكتب المكونات بالتفصيل هنا..."
                            required></textarea>
                    </div>
                    <button type="submit" class="btn-submit">حفظ وتعميم الوجبة</button>
                </div>
            </form>
        </div>
    </div>
</div>
 
@endsection

@section('scripts') <script>
function openDietModal() {
document.getElementById('addDietModal').classList.add('open');
}

    function closeDietModal() {
        document.getElementById('addDietModal').classList.remove('open');
    }
    window.onclick = function(event) {
        if (event.target == document.getElementById('addDietModal')) closeDietModal();
    }
</script>

@endsection
