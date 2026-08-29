<div class="role-form">

    {{-- اسم الدور --}}
    <div class="role-field">
        <label for="name" class="role-label">
            <i class="fas fa-shield-halved"></i>
            اسم الدور
        </label>

        <div class="role-input-wrap">
            <i class="fas fa-user-shield"></i>

            <input
                type="text"
                name="name"
                id="name"
                class="role-input"
                value="{{ old('name', $role->name ?? '') }}"
                placeholder="مثال: مدير، محرر، مشرف..."
                required
            >
        </div>

        @if ($errors->has('name'))
            <div class="role-error">
                <i class="fas fa-circle-exclamation"></i>
                {{ $errors->first('name') }}
            </div>
        @endif
    </div>


    {{-- الصلاحيات --}}
    <div class="abilities-section">

        <div class="abilities-header">
            <div class="abilities-title">
                <div class="abilities-icon">
                    <i class="fas fa-key"></i>
                </div>

                <div>
                    <h3>صلاحيات الدور</h3>
                    <span>حدد مستوى الوصول لكل صلاحية</span>
                </div>
            </div>
        </div>


        <div class="abilities-table-wrapper">

            <table class="abilities-table">

                <thead>
                    <tr>
                        <th class="ability-name-head">
                            الصلاحية
                        </th>

                        <th class="permission-head allow-head">
                            <div class="permission-title">
                                <span class="permission-dot"></span>
                                Allow
                            </div>

                            <button
                                type="button"
                                class="btn-select-all"
                                data-value="allow">
                                تحديد الكل
                            </button>
                        </th>

                        <th class="permission-head deny-head">
                            <div class="permission-title">
                                <span class="permission-dot"></span>
                                Deny
                            </div>

                            <button
                                type="button"
                                class="btn-select-all"
                                data-value="deny">
                                تحديد الكل
                            </button>
                        </th>

                        <th class="permission-head inherit-head">
                            <div class="permission-title">
                                <span class="permission-dot"></span>
                                Inherit
                            </div>

                            <button
                                type="button"
                                class="btn-select-all"
                                data-value="inherit">
                                تحديد الكل
                            </button>
                        </th>
                    </tr>
                </thead>


                <tbody>

                    @foreach (config('abilities') as $ability_code => $ability_name)

                        <tr>

                            <td class="ability-name">
                                <div class="ability-content">
                                    <div class="ability-icon">
                                        <i class="fas fa-lock"></i>
                                    </div>

                                    <div>
                                        <strong>{{ $ability_name }}</strong>
                                        <small>{{ $ability_code }}</small>
                                    </div>
                                </div>
                            </td>


                            <td class="permission-cell allow-cell">

                                <label class="radio-option">

                                    <input
                                        type="radio"
                                        name="ability[{{ $ability_code }}]"
                                        value="allow"
                                        @checked(($role_abilities[$ability_code] ?? '') == 'allow')
                                    >

                                    <span class="custom-radio allow-radio"></span>

                                </label>

                            </td>


                            <td class="permission-cell deny-cell">

                                <label class="radio-option">

                                    <input
                                        type="radio"
                                        name="ability[{{ $ability_code }}]"
                                        value="deny"
                                        @checked(($role_abilities[$ability_code] ?? '') == 'deny')
                                    >

                                    <span class="custom-radio deny-radio"></span>

                                </label>

                            </td>


                            <td class="permission-cell inherit-cell">

                                <label class="radio-option">

                                    <input
                                        type="radio"
                                        name="ability[{{ $ability_code }}]"
                                        value="inherit"
                                        @checked(($role_abilities[$ability_code] ?? '') == 'inherit')
                                    >

                                    <span class="custom-radio inherit-radio"></span>

                                </label>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>


        @if ($errors->has('ability'))

            <div class="role-error ability-error">
                <i class="fas fa-circle-exclamation"></i>
                {{ $errors->first('ability') }}
            </div>

        @endif

    </div>


    {{-- الأزرار --}}
    <div class="role-form-actions">

        <a
            href="{{ route('admin.roles') }}"
            class="role-btn role-btn-cancel"
        >
            <i class="fas fa-xmark"></i>
            إلغاء
        </a>

        <button
            type="submit"
            class="role-btn role-btn-save"
        >
            <i class="fas fa-floppy-disk"></i>

            {{ isset($role) ? 'حفظ التعديلات' : 'إنشاء الدور' }}
        </button>

    </div>

</div>


<script>
document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.btn-select-all').forEach(function (button) {

        button.addEventListener('click', function () {

            const targetValue = this.dataset.value;

            document.querySelectorAll(
                '.abilities-table input[type="radio"][value="' + targetValue + '"]'
            ).forEach(function (radio) {

                radio.checked = true;

                const row = radio.closest('tr');

                if (row) {
                    row.classList.add('permission-selected');

                    setTimeout(function () {
                        row.classList.remove('permission-selected');
                    }, 500);
                }

            });

        });

    });

});
</script>