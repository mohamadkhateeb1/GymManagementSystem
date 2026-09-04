{{-- حقول إضافة / تعديل اللاعب — نسخة مختصرة تعتمد Bootstrap للتخطيط ومتغيّرات الثيم للألوان --}}

<div class="form-section">
    <div class="section-head"><i class="fas fa-user"></i> <span>البيانات الشخصية</span></div>
    <div class="row g-3">
        <div class="col-12 col-md-6">
            <label class="form-label">الاسم الكامل</label>
            <div class="input-wrap">
                <i class="fas fa-id-card"></i>
                <input type="text" name="name" class="form-input" value="{{ old('name', $player->name ?? '') }}"
                    placeholder="مثال: أحمد العلي">
            </div>
        </div>
        <div class="col-12 col-md-6">
            <label class="form-label">البريد الإلكتروني</label>
            <div class="input-wrap">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" class="form-input" dir="ltr"
                    value="{{ old('email', $player->email ?? '') }}" placeholder="name@example.com">
            </div>
        </div>
        <div class="col-12 col-md-6">
            <label class="form-label">رقم الهاتف</label>
            <div class="input-wrap">
                <i class="fas fa-phone"></i>
                <input type="text" name="phone" class="form-input" dir="ltr"
                    value="{{ old('phone', $player->phone ?? '') }}" placeholder="05xxxxxxxx">
            </div>
        </div>
        @if (!isset($player))
            <div class="col-12 col-md-6">
                <label class="form-label">كلمة المرور</label>
                <div class="input-wrap">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" class="form-input" dir="ltr" placeholder="••••••••">
                </div>
            </div>
        @endif
        <div class="col-12 col-md-6">
            <label class="form-label">تاريخ الميلاد</label>
            <div class="input-wrap">
                <i class="fas fa-calendar-days"></i>
                <input type="date" name="date_of_birth" class="form-input"
                    value="{{ old('date_of_birth', $player->date_of_birth ?? '') }}">
            </div>
        </div>
    </div>
</div>

<div class="form-section">
    <div class="section-head"><i class="fas fa-credit-card"></i> <span>تفاصيل الاشتراك</span></div>
    <div class="row g-3">
        <div class="col-12">
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

<div class="form-section">
    <div class="section-head"><i class="fas fa-gear"></i> <span>الإعدادات التقنية والمدرب</span></div>
    <div class="row g-3">
        <div class="col-12 col-md-4">
            <label class="form-label">المدرب المسؤول</label>
            <div class="input-wrap">
                <i class="fas fa-user-tie"></i>
                <select name="coach_id" class="form-input">
                    <option value="">-- اختر المدرب المسؤول --</option>
                    @foreach ($coaches as $coach)
                        <option value="{{ $coach->id }}"
                            {{ isset($player) && $player->coach_id == $coach->id ? 'selected' : '' }}>
                            {{ $coach->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-6 col-md-4">
            <label class="form-label">الطول (cm)</label>
            <div class="input-wrap">
                <i class="fas fa-up-down"></i>
                <input type="number" step="0.01" name="height" class="form-input"
                    value="{{ old('height', $player->height ?? '') }}" placeholder="0.00">
                <span class="input-unit">cm</span>
            </div>
        </div>
        <div class="col-6 col-md-4">
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
    <a href="{{ route('players.index') }}" class="btn-cancel"><i class="fas fa-xmark"></i> إلغاء</a>
</div>

<style>
    /* ELITE CLUB — PLAYER FORM (نسخة مختصرة تعتمد متغيّرات الثيم الموحّدة) */

    .form-card {
        width: 100%;
        padding: 26px;
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 18px;
        box-shadow: var(--shadow-sm);
    }

    .form-section {
        margin-bottom: 24px;
        padding: 24px;
        background: var(--surface);
        border: 1px solid var(--border-soft);
        border-radius: 15px;
        transition: .25s ease;
    }

    .form-section:hover {
        border-color: var(--gold-light);
        box-shadow: var(--shadow-sm);
    }

    .section-head {
        display: flex;
        align-items: center;
        gap: 11px;
        margin-bottom: 22px;
        padding-bottom: 15px;
        color: var(--text);
        font-size: 15.5px;
        font-weight: 800;
        border-bottom: 1px solid var(--border-soft);
    }

    .section-head i {
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        color: var(--gold-dark);
        background: var(--sidebar-active);
        font-size: 14px;
    }

    .form-label {
        display: block;
        margin-bottom: 8px;
        color: var(--text);
        font-size: 13.5px;
        font-weight: 700;
    }

    .input-wrap {
        position: relative;
        width: 100%;
    }

    .input-wrap>i {
        position: absolute;
        top: 50%;
        right: 15px;
        transform: translateY(-50%);
        color: var(--gold-dark);
        font-size: 14px;
        pointer-events: none;
        z-index: 2;
    }

    .form-input {
        width: 100%;
        height: 48px;
        padding: 0 45px 0 15px;
        color: var(--text);
        background: var(--surface-2);
        border: 1px solid var(--border);
        border-radius: 10px;
        outline: none;
        font-family: inherit;
        font-size: 14px;
        font-weight: 600;
        transition: .2s ease;
    }

    .form-input:hover {
        border-color: var(--gold-light);
    }

    .form-input:focus {
        background: var(--surface);
        border-color: var(--gold-dark);
        box-shadow: 0 0 0 3px rgba(184, 146, 62, .11);
    }

    input[type="number"].form-input {
        padding-left: 48px;
    }

    select.form-input {
        cursor: pointer;
    }

    select.form-input option {
        color: var(--text);
        background: var(--surface);
    }

    .input-unit {
        position: absolute;
        top: 50%;
        left: 14px;
        transform: translateY(-50%);
        color: var(--text-soft);
        font-size: 11.5px;
        font-weight: 800;
        pointer-events: none;
    }

    .form-actions {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-top: 8px;
        padding-top: 22px;
        border-top: 1px solid var(--border-soft);
        flex-wrap: wrap;
    }

    .btn-gold,
    .btn-cancel {
        height: 46px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 9px;
        padding: 0 25px;
        border-radius: 10px;
        font-family: inherit;
        font-size: 14px;
        font-weight: 800;
        cursor: pointer;
        transition: .2s ease;
        text-decoration: none;
    }

    .btn-gold {
        border: 0;
        color: #fff;
        background: linear-gradient(135deg, var(--gold-light), var(--gold-dark));
        box-shadow: 0 6px 15px rgba(185, 130, 32, .20);
    }

    .btn-gold:hover {
        transform: translateY(-1px);
        box-shadow: 0 9px 20px rgba(185, 130, 32, .28);
    }

    .btn-cancel {
        color: var(--text-soft);
        background: var(--surface-2);
        border: 1px solid var(--border);
    }

    .btn-cancel:hover {
        color: var(--danger);
        background: var(--danger-bg);
        border-color: var(--danger);
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
    }
</style>
