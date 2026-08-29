{{-- حقول إضافة / تعديل اللاعب --}}

{{-- ===== البيانات الشخصية ===== --}}
<div class="form-section">
    <div class="section-head">
        <i class="fas fa-user"></i>
        <span>البيانات الشخصية</span>
    </div>

    <div class="luxury-form-grid">
        <div class="form-group">
            <label class="form-label">الاسم الكامل</label>
            <div class="input-wrap">
                <i class="fas fa-id-card"></i>
                <input type="text" name="name" class="form-input" value="{{ old('name', $player->name ?? '') }}"
                    placeholder="مثال: أحمد العلي">
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">البريد الإلكتروني</label>
            <div class="input-wrap">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" class="form-input" dir="ltr"
                    value="{{ old('email', $player->email ?? '') }}" placeholder="name@example.com">
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">رقم الهاتف</label>
            <div class="input-wrap">
                <i class="fas fa-phone"></i>
                <input type="text" name="phone" class="form-input" dir="ltr"
                    value="{{ old('phone', $player->phone ?? '') }}" placeholder="05xxxxxxxx">
            </div>
        </div>

        @if (!isset($player))
            <div class="form-group">
                <label class="form-label">كلمة المرور</label>
                <div class="input-wrap">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" class="form-input" dir="ltr" placeholder="••••••••">
                </div>
            </div>
        @endif

        <div class="form-group">
            <label class="form-label">تاريخ الميلاد</label>
            <div class="input-wrap">
                <i class="fas fa-calendar-days"></i>
                <input type="date" name="date_of_birth" class="form-input"
                    value="{{ old('date_of_birth', $player->date_of_birth ?? '') }}">
            </div>
        </div>
    </div>
</div>

{{-- ===== تفاصيل الاشتراك ===== --}}
<div class="form-section">
    <div class="section-head">
        <i class="fas fa-credit-card"></i>
        <span>تفاصيل الاشتراك</span>
    </div>
    <div class="luxury-form-grid">
        <div class="form-group" style="grid-column: span 2;">
            <label class="form-label">نوع الخطة</label>
            <div class="input-wrap">
                <i class="fas fa-clock"></i>
                <select name="plan_type_id" class="form-input">
                    <option value="">-- اختر الباقة --</option>
                    @forelse ($planTypes as $planType)
                        <option value="{{ $planType->id }}"
                            {{ old('plan_type_id', $player->subscription->plan_type_id ?? '') == $planType->id ? 'selected' : '' }}>
                            {{ $planType->name }} — {{ $planType->duration_days }} يوم —
                            {{ number_format($planType->price, 2) }}
                        </option>
                    @empty
                        <option value="" disabled>لا توجد باقات مفعّلة، أضف باقة أولاً من "الباقات والأسعار"
                        </option>
                    @endforelse
                </select>
            </div>
        </div>
    </div>
</div>

{{-- ===== الإعدادات التقنية والمدرب ===== --}}
<div class="form-section">
    <div class="section-head">
        <i class="fas fa-gear"></i>
        <span>الإعدادات التقنية والمدرب</span>
    </div>

    <div class="luxury-form-grid">
        <div class="form-group">
            <label class="form-label">المدرب المسؤول</label>
            <div class="input-wrap">
                <i class="fas fa-user-tie"></i>
                <select name="coach_id" class="form-input">
                    <option value="">-- اختر المدرب المسؤول --</option>
                    @foreach ($coaches as $coach)
                        <option value="{{ $coach->id }}"
                            {{ isset($player) && $player->coach_id == $coach->id ? 'selected' : '' }}>
                            {{ $coach->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">الطول (cm)</label>
            <div class="input-wrap">
                <i class="fas fa-up-down"></i>
                <input type="number" step="0.01" name="height" class="form-input"
                    value="{{ old('height', $player->height ?? '') }}" placeholder="0.00">
                <span class="input-unit">cm</span>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">الوزن (kg)</label>
            <div class="input-wrap">
                <i class="fas fa-weight-scale"></i>
                <input type="number" step="0.01" name="weight" class="form-input"
                    value="{{ old('weight', $player->weight ?? '') }}" placeholder="0.00">
                <span class="input-unit">kg</span>
            </div>
        </div>
    </div>
</div>

<div class="form-actions">
    <button type="submit" class="btn-gold">
        <i class="fas {{ isset($player) ? 'fa-floppy-disk' : 'fa-circle-plus' }}"></i>
        {{ isset($player) ? 'تحديث البيانات' : 'حفظ اللاعب' }}
    </button>
    <a href="{{ route('players.index') }}" class="btn-cancel">
        <i class="fas fa-xmark"></i> إلغاء
    </a>
</div>

<style>
 /* =========================================================
   ELITE CLUB - PLAYER FORM
   Create / Edit
   ========================================================= */

.form-card {
    width: 100%;
    padding: 26px;
    background: #ffffff;
    border: 1px solid #e5e9f0;
    border-radius: 18px;
    box-shadow: 0 8px 28px rgba(20, 30, 50, 0.06);
    direction: rtl;
}

/* =========================
   FORM SECTION
   ========================= */

.form-section {
    position: relative;
    margin-bottom: 24px;
    padding: 24px;
    background: #ffffff;
    border: 1px solid #e7ebf1;
    border-radius: 15px;
    transition: all 0.25s ease;
}

.form-section:hover {
    border-color: rgba(211, 158, 55, 0.30);
    box-shadow: 0 5px 20px rgba(25, 35, 55, 0.045);
}

/* =========================
   SECTION HEAD
   ========================= */

.section-head {
    display: flex;
    align-items: center;
    gap: 11px;

    margin-bottom: 22px;
    padding-bottom: 15px;

    color: #1b1f27;
    font-size: 15px;
    font-weight: 800;

    border-bottom: 1px solid #edf0f4;
}

.section-head i {
    width: 36px;
    height: 36px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 10px;

    color: #b98522;
    background: linear-gradient(
        135deg,
        rgba(215, 165, 65, 0.18),
        rgba(215, 165, 65, 0.07)
    );

    border: 1px solid rgba(211, 158, 55, 0.20);
    font-size: 14px;
}

/* =========================
   GRID
   ========================= */

.luxury-form-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 20px;
}

/* =========================
   FORM GROUP
   ========================= */

.form-group {
    min-width: 0;
}

.form-label {
    display: block;
    margin-bottom: 8px;

    color: #3b4350;
    font-size: 13px;
    font-weight: 700;
}

/* =========================
   INPUT WRAP
   ========================= */

.input-wrap {
    position: relative;
    width: 100%;
}

.input-wrap > i {
    position: absolute;
    top: 50%;
    right: 15px;

    transform: translateY(-50%);

    width: 18px;
    text-align: center;

    color: #a98546;
    font-size: 14px;

    pointer-events: none;
    z-index: 2;
}

/* =========================
   INPUT / SELECT
   ========================= */

.form-input {
    width: 100%;
    height: 48px;

    padding: 0 45px 0 15px;

    color: #202631;
    background: #fbfcfe;

    border: 1px solid #dfe4eb;
    border-radius: 10px;

    outline: none;

    font-family: inherit;
    font-size: 13px;
    font-weight: 600;

    transition:
        border-color 0.2s ease,
        box-shadow 0.2s ease,
        background 0.2s ease;
}

.form-input::placeholder {
    color: #aab1bc;
    font-weight: 500;
}

.form-input:hover {
    border-color: #c9a04e;
}

.form-input:focus {
    background: #ffffff;
    border-color: #c9993e;

    box-shadow:
        0 0 0 3px rgba(201, 153, 62, 0.11),
        0 4px 12px rgba(25, 35, 50, 0.04);
}

/* Date */

input[type="date"].form-input {
    cursor: pointer;
}

/* Number */

input[type="number"].form-input {
    padding-left: 48px;
}

/* Select */

select.form-input {
    appearance: none;
    -webkit-appearance: none;

    cursor: pointer;

    background-image:
        linear-gradient(45deg, transparent 50%, #9ca4b0 50%),
        linear-gradient(135deg, #9ca4b0 50%, transparent 50%);

    background-position:
        calc(100% - 18px) 21px,
        calc(100% - 13px) 21px;

    background-size: 5px 5px;
    background-repeat: no-repeat;
}

select.form-input option {
    color: #202631;
    background: #ffffff;
}

/* =========================
   INPUT UNIT
   ========================= */

.input-unit {
    position: absolute;
    top: 50%;
    left: 14px;

    transform: translateY(-50%);

    color: #a0a7b1;
    font-size: 11px;
    font-weight: 800;

    pointer-events: none;
}

/* =========================
   ACTIONS
   ========================= */

.form-actions {
    display: flex;
    align-items: center;
    justify-content: flex-start;

    gap: 12px;

    margin-top: 8px;
    padding-top: 22px;

    border-top: 1px solid #edf0f4;
}

/* Gold button */

.btn-gold {
    height: 46px;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    gap: 9px;

    padding: 0 25px;

    border: 0;
    border-radius: 10px;

    color: #ffffff;

    background: linear-gradient(
        135deg,
        #d8a63d,
        #b98220
    );

    box-shadow:
        0 6px 15px rgba(185, 130, 32, 0.20);

    font-family: inherit;
    font-size: 13px;
    font-weight: 800;

    cursor: pointer;

    transition:
        transform 0.2s ease,
        box-shadow 0.2s ease,
        filter 0.2s ease;
}

.btn-gold:hover {
    transform: translateY(-1px);

    filter: brightness(1.04);

    box-shadow:
        0 9px 20px rgba(185, 130, 32, 0.28);
}

.btn-gold:active {
    transform: translateY(0);
}

/* Cancel */

.btn-cancel {
    height: 46px;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    gap: 8px;

    padding: 0 22px;

    color: #596273;
    background: #f7f8fa;

    border: 1px solid #dfe3e9;
    border-radius: 10px;

    text-decoration: none;

    font-size: 13px;
    font-weight: 700;

    transition: all 0.2s ease;
}

.btn-cancel:hover {
    color: #c43d3d;
    background: #fff6f6;
    border-color: #efbcbc;
}

/* =========================================================
   DARK MODE
   Supports:
   [data-theme="dark"]
   .dark-mode
   body.dark
   ========================================================= */

[data-theme="dark"] .form-card,
.dark-mode .form-card,
body.dark .form-card {
    background: #121720;
    border-color: #29313d;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.24);
}

[data-theme="dark"] .form-section,
.dark-mode .form-section,
body.dark .form-section {
    background: #171d26;
    border-color: #29313d;
}

[data-theme="dark"] .form-section:hover,
.dark-mode .form-section:hover,
body.dark .form-section:hover {
    border-color: rgba(211, 158, 55, 0.38);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.18);
}

[data-theme="dark"] .section-head,
.dark-mode .section-head,
body.dark .section-head {
    color: #f3f5f8;
    border-bottom-color: #29313d;
}

[data-theme="dark"] .section-head i,
.dark-mode .section-head i,
body.dark .section-head i {
    color: #e1ae48;
    background: rgba(211, 158, 55, 0.10);
    border-color: rgba(211, 158, 55, 0.20);
}

[data-theme="dark"] .form-label,
.dark-mode .form-label,
body.dark .form-label {
    color: #c9ced7;
}

[data-theme="dark"] .form-input,
.dark-mode .form-input,
body.dark .form-input {
    color: #edf0f5;
    background: #11161e;
    border-color: #323b48;
}

[data-theme="dark"] .form-input::placeholder,
.dark-mode .form-input::placeholder,
body.dark .form-input::placeholder {
    color: #697383;
}

[data-theme="dark"] .form-input:hover,
.dark-mode .form-input:hover,
body.dark .form-input:hover {
    border-color: #9b752e;
}

[data-theme="dark"] .form-input:focus,
.dark-mode .form-input:focus,
body.dark .form-input:focus {
    background: #151b24;
    border-color: #c99a3b;

    box-shadow:
        0 0 0 3px rgba(201, 153, 59, 0.10),
        0 5px 15px rgba(0, 0, 0, 0.18);
}

[data-theme="dark"] select.form-input option,
.dark-mode select.form-input option,
body.dark select.form-input option {
    color: #edf0f5;
    background: #171d26;
}

[data-theme="dark"] .input-wrap > i,
.dark-mode .input-wrap > i,
body.dark .input-wrap > i {
    color: #c2953b;
}

[data-theme="dark"] .input-unit,
.dark-mode .input-unit,
body.dark .input-unit {
    color: #747e8e;
}

[data-theme="dark"] .form-actions,
.dark-mode .form-actions,
body.dark .form-actions {
    border-top-color: #29313d;
}

[data-theme="dark"] .btn-cancel,
.dark-mode .btn-cancel,
body.dark .btn-cancel {
    color: #c1c7d0;
    background: #1a2029;
    border-color: #323b48;
}

[data-theme="dark"] .btn-cancel:hover,
.dark-mode .btn-cancel:hover,
body.dark .btn-cancel:hover {
    color: #ff7777;
    background: rgba(190, 50, 50, 0.08);
    border-color: rgba(220, 80, 80, 0.30);
}

/* =========================
   RESPONSIVE
   ========================= */

@media (max-width: 800px) {
    .luxury-form-grid {
        grid-template-columns: 1fr;
    }

    .form-group[style*="grid-column"] {
        grid-column: span 1 !important;
    }
}

@media (max-width: 600px) {
    .form-card {
        padding: 14px;
        border-radius: 14px;
    }

    .form-section {
        padding: 17px;
    }

    .form-actions {
        flex-direction: column;
        align-items: stretch;
    }

    .btn-gold,
    .btn-cancel {
        width: 100%;
    }
}
</style>
