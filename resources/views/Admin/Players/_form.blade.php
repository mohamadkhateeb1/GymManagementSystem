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
                    placeholder="مثال: أحمد العلي" required>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">البريد الإلكتروني</label>
            <div class="input-wrap">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" class="form-input" dir="ltr"
                    value="{{ old('email', $player->email ?? '') }}" placeholder="name@example.com" required>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">رقم الهاتف</label>
            <div class="input-wrap">
                <i class="fas fa-phone"></i>
                <input type="text" name="phone" class="form-input" dir="ltr"
                    value="{{ old('phone', $player->phone ?? '') }}" placeholder="05xxxxxxxx" required>
            </div>
        </div>

        @if (!isset($player))
            <div class="form-group">
                <label class="form-label">كلمة المرور</label>
                <div class="input-wrap">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" class="form-input" dir="ltr" placeholder="••••••••"
                        required>
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

{{-- ===== القياسات البدنية ===== --}}
<div class="form-section">
    <div class="section-head">
        <i class="fas fa-ruler-combined"></i>
        <span>القياسات البدنية</span>
    </div>

    <div class="luxury-form-grid">
        <div class="form-group">
            <label class="form-label">الطول</label>
            <div class="input-wrap">
                <i class="fas fa-up-down"></i>
                <input type="number" step="0.01" name="height" class="form-input"
                    value="{{ old('height', $player->height ?? '') }}" placeholder="0.00">
                <span class="input-unit">cm</span>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">الوزن</label>
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
    /* ===== أقسام الفورم ===== */
    .form-section {
        margin-bottom: 32px;
        animation: fadeUp 0.5s ease both;
    }

    .form-section+.form-section {
        animation-delay: 0.1s;
    }

    .section-head {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 20px;
        padding-bottom: 12px;
        border-bottom: 1px solid rgba(201, 169, 97, 0.15);
        color: #fff;
        font-size: 15px;
        font-weight: 800;
        letter-spacing: 0.3px;
    }

    .section-head i {
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 9px;
        font-size: 13px;
        color: var(--accent);
        background: rgba(201, 169, 97, 0.1);
        border: 1px solid rgba(201, 169, 97, 0.25);
    }

    /* ===== الشبكة ===== */
    .luxury-form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 22px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-label {
        color: var(--accent);
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        margin-bottom: 8px;
        font-weight: 700;
    }

    /* ===== الحقول مع أيقونة ===== */
    .input-wrap {
        position: relative;
        display: flex;
        align-items: center;
    }

    /* الأيقونة على جهة البداية (يمين في RTL) */
    .input-wrap>i {
        position: absolute;
        right: 14px;
        color: rgba(201, 169, 97, 0.6);
        font-size: 13px;
        pointer-events: none;
        transition: color 0.3s ease;
    }

    .form-input {
        width: 100%;
        padding: 13px 42px 13px 15px;
        border-radius: 10px;
        border: 1px solid rgba(201, 169, 97, 0.2);
        background: rgba(16, 19, 28, 0.8);
        color: #fff;
        font-size: 14px;
        transition: border-color 0.3s ease, box-shadow 0.3s ease, background 0.3s ease;
    }

    .form-input::placeholder {
        color: rgba(255, 255, 255, 0.3);
    }

    /* الحقول LTR: أبعد البادينج لليسار والأيقونة تبقى يمين */
    .form-input[dir="ltr"] {
        text-align: left;
    }

    .form-input:focus {
        border-color: var(--accent);
        background: rgba(16, 19, 28, 0.95);
        box-shadow: 0 0 0 3px rgba(201, 169, 97, 0.12), 0 6px 18px rgba(0, 0, 0, 0.3);
        outline: none;
    }

    .input-wrap:focus-within>i {
        color: var(--accent);
    }

    /* وحدة القياس داخل الحقل (cm / kg) */
    .input-unit {
        position: absolute;
        left: 14px;
        font-size: 12px;
        font-weight: 700;
        color: var(--accent);
        opacity: 0.7;
        pointer-events: none;
    }

    .form-input:has(+ .input-unit) {
        padding-left: 44px;
    }

    /* أيقونة منتقي التاريخ بلون فاتح */
    .form-input[type="date"]::-webkit-calendar-picker-indicator {
        filter: invert(0.7) sepia(1) saturate(2) hue-rotate(5deg);
        cursor: pointer;
    }

    /* ===== أزرار الإجراءات ===== */
    .form-actions {
        display: flex;
        gap: 18px;
        align-items: center;
        border-top: 1px solid rgba(201, 169, 97, 0.15);
        padding-top: 24px;
        margin-top: 8px;
    }

    .btn-gold {
        display: inline-flex;
        align-items: center;
        gap: 9px;
        background: linear-gradient(135deg, var(--accent), #d9bd7c);
        color: #1a1305;
        padding: 13px 32px;
        border-radius: 10px;
        border: none;
        font-weight: 800;
        font-size: 14px;
        cursor: pointer;
        box-shadow: 0 6px 18px rgba(201, 169, 97, 0.3);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .btn-gold:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 26px rgba(201, 169, 97, 0.45);
    }

    .btn-cancel {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        color: var(--text-muted, #8b8b8b);
        text-decoration: none;
        font-size: 14px;
        font-weight: 600;
        padding: 11px 18px;
        border-radius: 10px;
        border: 1px solid transparent;
        transition: all 0.3s ease;
    }

    .btn-cancel:hover {
        color: #fff;
        border-color: rgba(255, 255, 255, 0.12);
        background: rgba(255, 255, 255, 0.04);
    }

    /* ===== أنيميشن ===== */
    @keyframes fadeUp {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* ===== تجاوب ===== */
    @media (max-width: 640px) {
        .luxury-form-grid {
            grid-template-columns: 1fr;
        }

        .form-actions {
            flex-direction: column-reverse;
            align-items: stretch;
        }

        .btn-gold {
            justify-content: center;
        }

        .btn-cancel {
            text-align: center;
            justify-content: center;
        }
    }
</style>
