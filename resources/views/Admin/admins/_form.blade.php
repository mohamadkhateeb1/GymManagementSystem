{{-- =========================================================
    ADMIN FORM
========================================================= --}}

<div class="admin-form">

    {{-- ==================== البيانات الأساسية ==================== --}}
    <div class="form-section">

        <div class="section-title">
            <div class="section-title-icon">
                <i class="fas fa-user"></i>
            </div>
            <div>
                <h3>البيانات الأساسية</h3>
                <span>معلومات حساب المسؤول</span>
            </div>
        </div>

        <div class="fields-grid">

            {{-- Name --}}
            <div class="field-group">

                <label for="name">
                    <i class="fas fa-user"></i>
                    الاسم
                </label>

                <div class="field-wrap">
                    <i class="fas fa-user field-icon"></i>

                    <input type="text" id="name" name="name" placeholder="أدخل اسم المسؤول"
                        value="{{ old('name', $admin->name ?? '') }}"
                        class="{{ $errors->has('name') ? 'is-invalid' : '' }}" required>
                </div>

                @error('name')
                    <span class="field-error">
                        <i class="fas fa-circle-exclamation"></i>
                        {{ $message }}
                    </span>
                @enderror

            </div>


            {{-- Email --}}
            <div class="field-group">

                <label for="email">
                    <i class="fas fa-envelope"></i>
                    البريد الإلكتروني
                </label>

                <div class="field-wrap">
                    <i class="fas fa-envelope field-icon"></i>

                    @php
                        $defaultEmail = old(
                            'email',
                            isset($admin) && $admin->exists ? $admin->email : 'admin@gmail.com',
                        );
                    @endphp

                    <input type="email" id="email" name="email" dir="ltr" placeholder="admin@example.com"
                        value="{{ $defaultEmail }}" class="{{ $errors->has('email') ? 'is-invalid' : '' }}" required>
                </div>

                @error('email')
                    <span class="field-error">
                        <i class="fas fa-circle-exclamation"></i>
                        {{ $message }}
                    </span>
                @enderror

            </div>

        </div>

    </div>


    {{-- ==================== كلمة المرور ==================== --}}
    <div class="form-section">

        <div class="section-title">
            <div class="section-title-icon">
                <i class="fas fa-lock"></i>
            </div>

            <div>
                <h3>أمان الحساب</h3>
                <span>إعداد كلمة مرور المسؤول</span>
            </div>
        </div>


        <div class="field-group">

            <label for="password">
                <i class="fas fa-key"></i>
                كلمة المرور
            </label>

            <div class="field-wrap">
                <i class="fas fa-lock field-icon"></i>

                @php
                    $defaultPassword = old('password', isset($admin) && $admin->exists ? '' : '123456789');
                @endphp

                <input type="password" id="password" name="password" dir="ltr"
                    placeholder="{{ isset($admin) && $admin->exists ? 'اتركها فارغة للإبقاء على كلمة المرور الحالية' : 'أدخل كلمة المرور' }}"
                    value="{{ $defaultPassword }}" class="{{ $errors->has('password') ? 'is-invalid' : '' }}"
                    {{ isset($admin) && $admin->exists ? '' : 'required' }}>

                <button type="button" class="password-toggle" onclick="toggleAdminPassword()" tabindex="-1">
                    <i class="fas fa-eye" id="passwordEye"></i>
                </button>

            </div>

            @if (isset($admin) && $admin->exists)
                <div class="field-hint">
                    <i class="fas fa-circle-info"></i>
                    اترك الحقل فارغاً إذا كنت لا تريد تغيير كلمة المرور الحالية.
                </div>
            @else
                <div class="field-hint">
                    <i class="fas fa-shield-halved"></i>
                    استخدم كلمة مرور قوية لحماية حساب المسؤول.
                </div>
            @endif

            @error('password')
                <span class="field-error">
                    <i class="fas fa-circle-exclamation"></i>
                    {{ $message }}
                </span>
            @enderror

        </div>

    </div>


    {{-- ==================== الصلاحيات / الأدوار ==================== --}}
    <div class="form-section">

        <div class="section-title">

            <div class="section-title-icon">
                <i class="fas fa-shield-halved"></i>
            </div>

            <div>
                <h3>أدوار المسؤول</h3>
                <span>حدد الأدوار والصلاحيات الخاصة بهذا الحساب</span>
            </div>

        </div>


        @php
            $selectedRoles = old('roles', $admin_roles ?? []);
        @endphp


        <div class="roles-container">

            @forelse ($roles as $role)
                <label class="role-option" for="role_{{ $role->id }}">

                    <input type="checkbox" id="role_{{ $role->id }}" name="roles[]" value="{{ $role->id }}"
                        @checked(in_array($role->id, $selectedRoles))>

                    <span class="custom-checkbox">
                        <i class="fas fa-check"></i>
                    </span>

                    <span class="role-option-content">

                        <span class="role-option-name">
                            <i class="fas fa-shield-halved"></i>
                            {{ $role->name }}
                        </span>

                        <span class="role-option-status">
                            صلاحيات الدور
                        </span>

                    </span>

                </label>

            @empty

                <div class="roles-empty">
                    <i class="fas fa-shield-halved"></i>

                    <div>
                        <strong>لا توجد أدوار متاحة</strong>
                        <span>قم بإنشاء دور أولاً من قسم الأدوار والصلاحيات.</span>
                    </div>
                </div>
            @endforelse

        </div>


        @error('roles')
            <span class="field-error roles-error">
                <i class="fas fa-circle-exclamation"></i>
                {{ $message }}
            </span>
        @enderror

    </div>

</div>


<script>
    function toggleAdminPassword() {

        const input = document.getElementById('password');
        const icon = document.getElementById('passwordEye');

        if (!input) return;

        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
</script>
