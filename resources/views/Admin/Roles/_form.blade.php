<style>
    :root {
        --bg: #0d0f14;
        --surface: #13161d;
        --surface-2: #1a1e28;
        --border: #252a38;
        --accent: #5b6af0;
        --accent-glow: rgba(91, 106, 240, 0.15);
        --allow: #22c55e;
        --deny: #ef4444;
        --inherit: #94a3b8;
        --text: #e2e8f0;
        --text-muted: #64748b;
        --radius: 12px;
    }

    /* ── Card Body ───────────────────────── */
    .card-body {
        padding: 28px;
    }

    /* ── Name Input ──────────────────────── */
    .form-label {
        display: block;
        font-size: 12px;
        font-weight: 600;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 0.07em;
        margin-bottom: 8px;
    }

    .form-control {
        width: 100%;
        background: var(--surface-2);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        padding: 12px 16px;
        font-family: 'DM Sans', sans-serif;
        font-size: 15px;
        color: var(--text);
        outline: none;
        transition: border-color 0.2s, box-shadow 0.2s;
    }

    .form-control:focus {
        border-color: var(--accent);
        box-shadow: 0 0 0 3px var(--accent-glow);
    }

    .text-danger {
        font-size: 12px;
        color: var(--deny);
        margin-top: 6px;
    }

    /* ── Fieldset ────────────────────────── */
    fieldset {
        border: 1px solid var(--border);
        border-radius: var(--radius);
        overflow: hidden;
        padding: 0;
        margin-top: 24px;
    }

    legend {
        font-family: 'Syne', sans-serif;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: var(--text-muted);
        padding: 13px 20px;
        width: 100%;
        background: var(--surface-2);
        border-bottom: 1px solid var(--border);
        float: none;
        margin: 0;
    }

    /* ── Table ───────────────────────────── */
    .table {
        width: 100%;
        border-collapse: collapse;
        margin: 0;
    }

    .table thead th {
        padding: 12px 16px;
        font-size: 11px;
        font-weight: 600;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        color: var(--text-muted);
        background: var(--surface);
        border-bottom: 1px solid var(--border);
        text-align: left;
    }

    .table thead th.text-center {
        text-align: center;
    }

    /* عنوان كل عمود بلونه */
    .table thead th:nth-child(2) {
        color: var(--allow);
    }

    .table thead th:nth-child(3) {
        color: var(--deny);
    }

    .table thead th:nth-child(4) {
        color: var(--inherit);
    }

    /* ── Select All Buttons ──────────────── */
    .btn-select-all {
        display: inline-block;
        margin-top: 6px;
        background: transparent;
        border: 1px solid currentColor;
        color: inherit;
        font-size: 9px;
        font-weight: 700;
        padding: 3px 8px;
        border-radius: 4px;
        cursor: pointer;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        transition: background 0.2s, color 0.2s;
    }

    .table thead th:nth-child(2) .btn-select-all:hover {
        background: var(--allow);
        color: #fff;
    }

    .table thead th:nth-child(3) .btn-select-all:hover {
        background: var(--deny);
        color: #fff;
    }

    .table thead th:nth-child(4) .btn-select-all:hover {
        background: var(--inherit);
        color: #fff;
    }

    .table tbody tr {
        border-bottom: 1px solid var(--border);
        transition: background 0.15s;
    }

    .table tbody tr:last-child {
        border-bottom: none;
    }

    .table tbody tr:hover {
        background: var(--surface-2);
    }

    .table tbody td {
        padding: 13px 16px;
        font-size: 14px;
        color: var(--text);
        vertical-align: middle;
    }

    .table tbody td.text-center {
        text-align: center;
    }

    /* ── Custom Radio ────────────────────── */
    input[type="radio"] {
        appearance: none;
        -webkit-appearance: none;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        border: 2px solid var(--border);
        background: var(--surface);
        cursor: pointer;
        transition: all 0.2s;
        position: relative;
        display: inline-block;
        vertical-align: middle;
    }

    input[type="radio"]::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) scale(0);
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: white;
        transition: transform 0.15s;
    }

    input[type="radio"]:checked::after {
        transform: translate(-50%, -50%) scale(1);
    }

    /* Allow = أخضر */
    .table td:nth-child(2) input[type="radio"]:checked {
        border-color: var(--allow);
        background: var(--allow);
        box-shadow: 0 0 8px rgba(34, 197, 94, 0.4);
    }

    /* Deny = أحمر */
    .table td:nth-child(3) input[type="radio"]:checked {
        border-color: var(--deny);
        background: var(--deny);
        box-shadow: 0 0 8px rgba(239, 68, 68, 0.4);
    }

    /* Inherit = رمادي */
    .table td:nth-child(4) input[type="radio"]:checked {
        border-color: var(--inherit);
        background: var(--inherit);
        box-shadow: 0 0 8px rgba(148, 163, 184, 0.3);
    }

    /* ── Submit Button ───────────────────── */
    .btn.btn-primary {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin: 20px 16px 24px;
        padding: 12px 28px;
        border-radius: var(--radius);
        border: none;
        background: var(--accent);
        color: #fff;
        font-family: 'Syne', sans-serif;
        font-size: 14px;
        font-weight: 700;
        letter-spacing: 0.03em;
        cursor: pointer;
        transition: all 0.2s;
        box-shadow: 0 4px 16px rgba(91, 106, 240, 0.3);
    }

    .btn.btn-primary:hover {
        background: #6b7af5;
        box-shadow: 0 4px 24px rgba(91, 106, 240, 0.5);
        transform: translateY(-1px);
    }

    .btn.btn-primary:active {
        transform: translateY(0);
    }
</style>

<div class="card-body">

    {{-- اسم الدور --}}
    <div class="mb-3">
        <label for="name" class="form-label">اسم الدور</label>
        <input type="text" name="name" id="name" class="form-control"
            value="{{ old('name', $role->name ?? '') }}" placeholder="مثال: Editor, Moderator..." required>
        @if ($errors->has('name'))
            <div class="text-danger mt-1">{{ $errors->first('name') }}</div>
        @endif
    </div>

    {{-- Abilities --}}
    <fieldset>
        <legend>Abilities</legend>
        <table class="table">
            <thead>
                <tr>
                    <th style="vertical-align: top;">Ability</th>
                    <th class="text-center" style="vertical-align: top;">
                        <div>Allow</div>
                        <button type="button" class="btn-select-all" data-value="allow">Select All</button>
                    </th>
                    <th class="text-center" style="vertical-align: top;">
                        <div>Deny</div>
                        <button type="button" class="btn-select-all" data-value="deny">Select All</button>
                    </th>
                    <th class="text-center" style="vertical-align: top;">
                        <div>Inherit</div>
                        <button type="button" class="btn-select-all" data-value="inherit">Select All</button>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach (config('abilities') as $ability_code => $ability_name)
                    <tr>
                        <td>{{ $ability_name }}</td>
                        <td class="text-center">
                            <input type="radio" name="ability[{{ $ability_code }}]" value="allow"
                                @checked(($role_abilities[$ability_code] ?? '') == 'allow')>
                        </td>
                        <td class="text-center">
                            <input type="radio" name="ability[{{ $ability_code }}]" value="deny"
                                @checked(($role_abilities[$ability_code] ?? '') == 'deny')>
                        </td>
                        <td class="text-center">
                            <input type="radio" name="ability[{{ $ability_code }}]" value="inherit"
                                @checked(($role_abilities[$ability_code] ?? '') == 'inherit')>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @if ($errors->has('ability'))
            <div class="text-danger" style="padding: 0 16px 12px;">
                {{ $errors->first('ability') }}
            </div>
        @endif

        <button type="submit" class="btn btn-primary">💾 حفظ</button>
    </fieldset>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const selectAllButtons = document.querySelectorAll('.btn-select-all');

        selectAllButtons.forEach(button => {
            button.addEventListener('click', function() {
                // جلب القيمة المستهدفة (allow, deny, inherit) من الزر
                const targetValue = this.getAttribute('data-value');

                // تحديد جميع أزرار الراديو التي تحمل هذه القيمة وتغيير حالتها إلى checked
                const radios = document.querySelectorAll(
                    `input[type="radio"][value="${targetValue}"]`);
                radios.forEach(radio => {
                    radio.checked = true;
                });
            });
        });
    });
</script>
