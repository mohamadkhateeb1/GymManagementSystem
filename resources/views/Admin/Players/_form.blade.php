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
                    placeholder="مثال: أحمد العلي" >
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">البريد الإلكتروني</label>
            <div class="input-wrap">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" class="form-input" dir="ltr"
                    value="{{ old('email', $player->email ?? '') }}" placeholder="name@example.com" >
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">رقم الهاتف</label>
            <div class="input-wrap">
                <i class="fas fa-phone"></i>
                <input type="text" name="phone" class="form-input" dir="ltr"
                    value="{{ old('phone', $player->phone ?? '') }}" placeholder="05xxxxxxxx"   >
            </div>
        </div>

        @if (!isset($player))
            <div class="form-group">
                <label class="form-label">كلمة المرور</label>
                <div class="input-wrap">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" class="form-input" dir="ltr" placeholder="••••••••"
                        >
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
                <select name="plan_name" class="form-input" >
                    <option value="">-- اختر نوع الاشتراك --</option>
                    <option value="اشتراك شهري"
                        {{ old('plan_name', $player->subscription->plan_name ?? '') == 'اشتراك شهري' ? 'selected' : '' }}>
                        اشتراك شهري</option>
                    <option value="اشتراك ربع سنوي"
                        {{ old('plan_name', $player->subscription->plan_name ?? '') == 'اشتراك ربع سنوي' ? 'selected' : '' }}>
                        اشتراك ربع سنوي</option>
                    <option value="اشتراك سنوي"
                        {{ old('plan_name', $player->subscription->plan_name ?? '') == 'اشتراك سنوي' ? 'selected' : '' }}>
                        اشتراك سنوي</option>
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
                <select name="coach_id" class="form-input" >
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
    .form-section {
        margin-bottom: 32px;
        animation: fadeUp 0.5s ease both;
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
    }

    .section-head i {
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 9px;
        font-size: 13px;
        color: #c9a961;
        background: rgba(201, 169, 97, 0.1);
        border: 1px solid rgba(201, 169, 97, 0.25);
    }

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
        color: #c9a961;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        margin-bottom: 8px;
        font-weight: 700;
    }

    .input-wrap {
        position: relative;
        display: flex;
        align-items: center;
    }

    .input-wrap>i {
        position: absolute;
        right: 14px;
        color: rgba(201, 169, 97, 0.6);
        font-size: 13px;
        pointer-events: none;
    }

    .form-input {
        width: 100%;
        padding: 13px 42px 13px 15px;
        border-radius: 10px;
        border: 1px solid rgba(201, 169, 97, 0.2);
        background: rgba(16, 19, 28, 0.8);
        color: #fff;
        font-size: 14px;
    }

    .input-unit {
        position: absolute;
        left: 14px;
        font-size: 12px;
        font-weight: 700;
        color: #c9a961;
        opacity: 0.7;
        pointer-events: none;
    }

    .form-actions {
        display: flex;
        gap: 18px;
        align-items: center;
        border-top: 1px solid rgba(201, 169, 97, 0.15);
        padding-top: 24px;
    }

    .btn-gold {
        display: inline-flex;
        align-items: center;
        gap: 9px;
        background: linear-gradient(135deg, #c9a961, #d9bd7c);
        color: #1a1305;
        padding: 13px 32px;
        border-radius: 10px;
        border: none;
        font-weight: 800;
        cursor: pointer;
        transition: 0.3s;
    }

    .btn-cancel {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        color: #8b8b8b;
        text-decoration: none;
        padding: 11px 18px;
        border-radius: 10px;
        transition: 0.3s;
    }

    .btn-cancel:hover {
        color: #fff;
        background: rgba(255, 255, 255, 0.04);
    }

    @media (max-width: 640px) {
        .luxury-form-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
