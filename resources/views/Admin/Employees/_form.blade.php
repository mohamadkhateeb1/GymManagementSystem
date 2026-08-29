<style>
<style>
/* =========================================================
   ELITE CLUB — EMPLOYEE FORM
   Shared by Create / Edit
   ========================================================= */

.employee-form-wrapper {
    width: 100%;
    max-width: 1180px;
    margin: 0 auto;
    direction: rtl;
}


/* =========================================================
   FORM GRID
   ========================================================= */

.employee-form-wrapper .fields-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 20px;
    margin-bottom: 20px;
}


/* =========================================================
   FIELD
   ========================================================= */

.employee-form-wrapper .field-group {
    min-width: 0;
}

.employee-form-wrapper .field-group > label {
    display: flex;
    align-items: center;
    gap: 7px;

    margin-bottom: 8px;

    color: var(--text);

    font-size: 12px;
    font-weight: 700;

    line-height: 1.5;
}

.employee-form-wrapper .field-group > label svg {
    width: 15px;
    height: 15px;

    flex: 0 0 15px;

    color: var(--gold);
}


/* =========================================================
   FIELD WRAPPER
   ========================================================= */

.employee-form-wrapper .field-wrap {
    position: relative;
    width: 100%;
}

.employee-form-wrapper .field-icon {
    position: absolute;

    top: 50%;
    right: 14px;

    width: 17px;
    height: 17px;

    transform: translateY(-50%);

    color: var(--muted);

    pointer-events: none;

    transition: color .2s ease;
}


/* =========================================================
   INPUT
   ========================================================= */

.employee-form-wrapper .field-wrap input,
.employee-form-wrapper .field-group input:not(.field-wrap input) {
    width: 100%;
    min-height: 46px;

    padding: 10px 43px 10px 14px;

    border: 1px solid var(--input-border);
    border-radius: 10px;

    outline: none;

    background: var(--input-bg);
    color: var(--text);

    font-family: 'Tajawal', sans-serif;
    font-size: 12px;
    font-weight: 500;

    transition:
        border-color .2s ease,
        box-shadow .2s ease,
        background .2s ease;
}

.employee-form-wrapper .field-wrap input::placeholder {
    color: var(--muted-light);
}

.employee-form-wrapper .field-wrap:focus-within .field-icon {
    color: var(--gold);
}

.employee-form-wrapper .field-wrap:focus-within input {
    border-color: rgba(184, 146, 62, .55);

    box-shadow:
        0 0 0 3px rgba(184, 146, 62, .08);
}


/* =========================================================
   INVALID
   ========================================================= */

.employee-form-wrapper .field-wrap input.is-invalid {
    border-color: var(--danger);
    box-shadow:
        0 0 0 3px rgba(196, 93, 93, .07);
}


/* =========================================================
   ERROR
   ========================================================= */

.employee-form-wrapper .field-error {
    display: flex;
    align-items: center;
    gap: 5px;

    margin-top: 7px;

    color: var(--danger);

    font-size: 10.5px;
    font-weight: 600;
    line-height: 1.5;
}

.employee-form-wrapper .field-error svg {
    width: 14px;
    height: 14px;

    flex: 0 0 14px;
}


/* =========================================================
   ROLES
   ========================================================= */

.employee-form-wrapper .field-group:has(.roles-box) {
    margin-top: 2px;
    margin-bottom: 20px;
}

.employee-form-wrapper .roles-box {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));

    gap: 10px;

    padding: 14px;

    border: 1px solid var(--border);
    border-radius: 12px;

    background: var(--surface-2);

    transition:
        background .25s ease,
        border-color .25s ease;
}


/* =========================================================
   ROLE ITEM
   ========================================================= */

.employee-form-wrapper .role-item {
    position: relative;

    min-width: 0;
}

.employee-form-wrapper .role-item input {
    position: absolute;

    opacity: 0;
    pointer-events: none;
}

.employee-form-wrapper .role-item label {
    min-height: 42px;

    display: flex;
    align-items: center;
    justify-content: center;

    padding: 8px 12px;

    border: 1px solid var(--border);
    border-radius: 9px;

    background: var(--surface);
    color: var(--text-soft);

    font-family: 'Tajawal', sans-serif;
    font-size: 11px;
    font-weight: 600;

    text-align: center;

    cursor: pointer;

    transition:
        background .2s ease,
        border-color .2s ease,
        color .2s ease,
        transform .2s ease,
        box-shadow .2s ease;
}

.employee-form-wrapper .role-item label:hover {
    border-color: rgba(184, 146, 62, .35);

    color: var(--gold-dark);

    background: var(--surface-hover);

    transform: translateY(-1px);
}


/* =========================================================
   SELECTED ROLE
   ========================================================= */

.employee-form-wrapper .role-item input:checked + label {
    border-color: rgba(184, 146, 62, .45);

    background: var(--sidebar-active);

    color: var(--gold-dark);

    box-shadow:
        0 4px 12px rgba(184, 146, 62, .08);
}

html[data-theme="dark"]
.employee-form-wrapper .role-item input:checked + label {
    color: var(--gold-light);
}


/* =========================================================
   SUBMIT
   ========================================================= */

.employee-form-wrapper .employee-submit {
    width: 100%;
    min-height: 47px;

    display: flex;
    align-items: center;
    justify-content: center;

    gap: 8px;

    margin-top: 6px;

    border: 1px solid var(--gold-dark);
    border-radius: 10px;

    background:
        linear-gradient(
            135deg,
            var(--gold-light),
            var(--gold-dark)
        );

    color: #fff;

    font-family: 'Tajawal', sans-serif;
    font-size: 12px;
    font-weight: 800;

    cursor: pointer;

    box-shadow:
        0 7px 18px rgba(184, 146, 62, .12);

    transition:
        transform .2s ease,
        box-shadow .2s ease,
        filter .2s ease;
}

.employee-form-wrapper .employee-submit:hover {
    transform: translateY(-1px);

    box-shadow:
        0 10px 24px rgba(184, 146, 62, .17);

    filter: brightness(1.03);
}

.employee-form-wrapper .employee-submit:active {
    transform: translateY(0);
}


/* =========================================================
   MOBILE
   ========================================================= */

@media (max-width: 768px) {

    .employee-form-wrapper .fields-grid {
        grid-template-columns: 1fr;
        gap: 16px;
        margin-bottom: 16px;
    }

    .employee-form-wrapper .roles-box {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }
}

@media (max-width: 480px) {

    .employee-form-wrapper .roles-box {
        grid-template-columns: 1fr;
    }

    .employee-form-wrapper .field-wrap input {
        min-height: 44px;
    }
}
</style>
</style>

<div class="fields-grid">
    <div class="field-group">
        <label>
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0" />
            </svg>
            اسم الموظف
        </label>
        <div class="field-wrap">
            <svg class="field-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0" />
            </svg>
            <input type="text" name="name" placeholder="أدخل اسم الموظف"
                value="{{ old('name', $employee->name ?? '') }}"
                class="{{ $errors->has('name') ? 'is-invalid' : '' }}">
        </div>
        @error('name')
            <span class="field-error"><svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m0 3.75h.008v.008H12v-.008z" />
                </svg>{{ $message }}</span>
        @enderror
    </div>

    <div class="field-group">
        <label>
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
            </svg>
            البريد الإلكتروني
        </label>
        <div class="field-wrap">
            <svg class="field-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
            </svg>
            <input type="email" name="email" placeholder="employee@example.com"
                value="{{ old('email', $employee->email ?? '') }}"
                class="{{ $errors->has('email') ? 'is-invalid' : '' }}">
        </div>
        @error('email')
            <span class="field-error"><svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m0 3.75h.008v.008H12v-.008z" />
                </svg>{{ $message }}</span>
        @enderror
    </div>
</div>

<div class="fields-grid">
    <div class="field-group">
        <label>
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
            </svg>
            كلمة المرور
        </label>
        <div class="field-wrap">
            <svg class="field-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
            </svg>
            <input type="password" name="password"
                placeholder="{{ isset($employee) ? 'اتركه فارغاً للحفاظ على كلمة المرور الحالية' : 'أدخل كلمة المرور' }}"
                class="{{ $errors->has('password') ? 'is-invalid' : '' }}">
        </div>
        @error('password')
            <span class="field-error"><svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m0 3.75h.008v.008H12v-.008z" />
                </svg>{{ $message }}</span>
        @enderror
    </div>

    <div class="field-group">
        <label>
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.83-5.83M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" />
            </svg>
            التخصص (اختياري)
        </label>
        <div class="field-wrap">
            <svg class="field-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.83-5.83M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" />
            </svg>
            <input type="text" name="specialization" placeholder="مثال مدرب لياقة أو أخصائي تغذية"
                value="{{ old('specialization', $employee->specialization ?? '') }}"
                class="{{ $errors->has('specialization') ? 'is-invalid' : '' }}">
        </div>
        @error('specialization')
            <span class="field-error"><svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m0 3.75h.008v.008H12v-.008z" />
                </svg>{{ $message }}</span>
        @enderror
    </div>
</div>

<div class="field-group">
    <label>
        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        الدور والصلاحيات
    </label>
    <div class="roles-box">
        @php $selectedRoles = old('roles', isset($employee) ? $employee->roles->pluck('id')->toArray() : []); @endphp
        @foreach ($roles as $role)
            <div class="role-item">
                <input type="checkbox" id="role_{{ $role->id }}" name="roles[]" value="{{ $role->id }}"
                    @checked(in_array($role->id, $selectedRoles))>
                <label for="role_{{ $role->id }}">{{ $role->name }}</label>
            </div>
        @endforeach
    </div>
    @error('roles')
        <span class="field-error"><svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m0 3.75h.008v.008H12v-.008z" />
            </svg>{{ $message }}</span>
    @enderror
</div>
