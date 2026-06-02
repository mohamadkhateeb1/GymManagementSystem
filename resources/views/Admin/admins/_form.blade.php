{{-- <x-flash-message /> --}}

<style>
    /* ---- FIELD GROUPS ---- */
    .field-group {
        margin-bottom: 1.25rem;
    }

    .field-group label {
        display: flex;
        align-items: center;
        gap: .4rem;
        font-size: .72rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .07em;
        color: #6b7280;
        margin-bottom: .5rem;
    }

    .field-group label svg {
        width: 13px;
        height: 13px;
        color: #6c63ff;
    }

    .field-wrap {
        position: relative;
    }

    .field-wrap .field-icon {
        position: absolute;
        left: .85rem;
        top: 50%;
        transform: translateY(-50%);
        width: 16px;
        height: 16px;
        color: #3d4460;
        pointer-events: none;
    }

    .field-wrap input {
        width: 100%;
        padding: .65rem 1rem .65rem 2.5rem;
        background: #1e2233;
        border: 1px solid #252a38;
        border-radius: .65rem;
        color: #e8eaf6;
        font-family: 'DM Sans', 'Outfit', sans-serif;
        font-size: .875rem;
        transition: border-color .2s, box-shadow .2s;
        outline: none;
    }

    .field-wrap input:focus {
        border-color: #6c63ff;
        box-shadow: 0 0 0 3px rgba(108, 99, 255, .15);
    }

    .field-wrap input::placeholder {
        color: #3d4255;
    }

    .field-wrap input.is-invalid {
        border-color: #f87171;
        box-shadow: 0 0 0 3px rgba(248, 113, 113, .12);
    }

    /* password hint */
    .field-hint {
        font-size: .72rem;
        color: #4b5368;
        margin-top: .35rem;
        display: flex;
        align-items: center;
        gap: .3rem;
    }

    .field-hint svg {
        width: 12px;
        height: 12px;
    }

    /* ---- ROLES BOX ---- */
    .roles-box {
        background: #1e2233;
        border: 1px solid #252a38;
        border-radius: .75rem;
        padding: .5rem .25rem;
        max-height: 210px;
        overflow-y: auto;
        scrollbar-width: thin;
        scrollbar-color: #2e3348 transparent;
    }

    .roles-box:focus-within {
        border-color: #6c63ff;
        box-shadow: 0 0 0 3px rgba(108, 99, 255, .12);
    }

    .role-item {
        display: flex;
        align-items: center;
        gap: .7rem;
        padding: .55rem .9rem;
        border-radius: .5rem;
        cursor: pointer;
        transition: background .15s;
    }

    .role-item:hover {
        background: rgba(108, 99, 255, .08);
    }

    .role-item input[type="checkbox"] {
        width: 16px;
        height: 16px;
        accent-color: #6c63ff;
        cursor: pointer;
        flex-shrink: 0;
    }

    .role-item label {
        font-size: .84rem;
        font-weight: 500;
        color: #c5c8e0;
        cursor: pointer;
        margin: 0;
        text-transform: none;
        letter-spacing: 0;
    }

    .field-error {
        font-size: .73rem;
        color: #f87171;
        margin-top: .4rem;
        display: flex;
        align-items: center;
        gap: .3rem;
    }

    .field-error svg {
        width: 12px;
        height: 12px;
        flex-shrink: 0;
    }

    /* ---- 2-col grid ---- */
    .fields-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0 1.25rem;
    }

    @media (max-width: 560px) {
        .fields-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

{{-- Name + Email --}}
<div class="fields-grid">
    <div class="field-group">
        <label>
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0" />
            </svg>
            Name
        </label>
        <div class="field-wrap">
            <svg class="field-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0" />
            </svg>
            <input type="text" id="name" name="name" placeholder="Enter name"
                value="{{ old('name', $admin->name) }}" class="{{ $errors->has('name') ? 'is-invalid' : '' }}">
        </div>
        @error('name')
            <span class="field-error">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m0 3.75h.008v.008H12v-.008z" />
                </svg>
                {{ $message }}
            </span>
        @enderror
    </div>

    <div class="field-group">
        <label>
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
            </svg>
            Email
        </label>
        <div class="field-wrap">
            <svg class="field-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
            </svg>
            @php $defaultEmail = old('email', $admin->exists ? $admin->email : 'admin@gmail.com'); @endphp
            <input type="email" id="email" name="email" placeholder="Enter email" value="{{ $defaultEmail }}"
                class="{{ $errors->has('email') ? 'is-invalid' : '' }}">
        </div>
        @error('email')
            <span class="field-error">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m0 3.75h.008v.008H12v-.008z" />
                </svg>
                {{ $message }}
            </span>
        @enderror
    </div>
</div>

{{-- Password --}}
<div class="field-group">
    <label>
        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
        </svg>
        Password
    </label>
    <div class="field-wrap">
        <svg class="field-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
        </svg>
        @php $defaultPassword = old('password', $admin->exists ? '' : '123456789'); @endphp
        <input type="password" id="password" name="password"
            placeholder="{{ $admin->exists ? 'Leave blank to keep current password' : 'Enter password' }}"
            value="{{ $defaultPassword }}" class="{{ $errors->has('password') ? 'is-invalid' : '' }}">
    </div>
    @if ($admin->exists)
        <p class="field-hint">
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
            </svg>
            اتركه فارغاً إذا ما تريد تغيير كلمة المرور
        </p>
    @endif
    @error('password')
        <span class="field-error">
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m0 3.75h.008v.008H12v-.008z" />
            </svg>
            {{ $message }}
        </span>
    @enderror
</div>

{{-- Roles --}}
@php $selectedRoles = old('roles', $admin_roles ?? []); @endphp
<div class="field-group">
    <label>
        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        Roles
    </label>
    <div class="roles-box">
        @foreach ($roles as $role)
            <div class="role-item">
                <input type="checkbox" id="role_{{ $role->id }}" name="roles[]" value="{{ $role->id }}"
                    @checked(in_array($role->id, $selectedRoles))>
                <label for="role_{{ $role->id }}">{{ $role->name }}</label>
            </div>
        @endforeach
    </div>
    @error('roles')
        <span class="field-error">
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m0 3.75h.008v.008H12v-.008z" />
            </svg>
            {{ $message }}
        </span>
    @enderror
</div>
