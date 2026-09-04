@extends('Admin.layouts.app')

@section('title', 'إدارة الباقات والأسعار | Elite Club')

@section('styles')
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800&display=swap" rel="stylesheet">
    <style>
        .plans-wrapper {
            font-family: 'Tajawal', sans-serif;
        }

        .panel {
            background: var(--surface, #ffffff);
            border: 1px solid var(--border, #e4e8ef);
            border-radius: 16px;
            margin-bottom: 24px;
            overflow: hidden;
            box-shadow: 0 7px 24px rgba(25, 35, 50, 0.05);
        }

        .panel-head {
            padding: 18px 24px;
            border-bottom: 1px solid var(--border, #e4e8ef);
            background: var(--surface-2, #fafbfc);
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
        }

        .panel-head h3 {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 17px;
            font-weight: 800;
            color: var(--text, #202631);
            margin: 0;
        }

        .panel-head h3::before {
            content: '';
            width: 4px;
            height: 18px;
            border-radius: 4px;
            background: var(--gold, #c9a961);
        }

        .btn-solid {
            background: var(--gold, #c9a961);
            color: #ffffff;
            border: none;
            padding: 10px 18px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 13.5px;
            font-weight: 700;
            font-family: 'Tajawal', sans-serif;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: 0.2s ease;
        }

        .btn-solid:hover {
            filter: brightness(1.08);
        }

        .members-table {
            width: 100%;
            border-collapse: collapse;
            text-align: right;
        }

        .members-table th {
            font-size: 12.5px;
            color: var(--text, #202631);
            padding: 14px 24px;
            border-bottom: 1px solid var(--border, #e4e8ef);
            font-weight: 800;
        }

        .members-table td {
            padding: 15px 24px;
            font-size: 14px;
            border-bottom: 1px solid var(--border-soft, #edf0f4);
            color: var(--text, #202631);
        }

        .members-table tbody tr:hover {
            background: var(--surface-hover, #fffdf8);
        }

        .price-tag {
            font-weight: 800;
            color: var(--gold-dark, #8a6d2f);
            font-size: 15.5px;
        }

        .status-chip {
            display: inline-flex;
            align-items: center;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 800;
            white-space: nowrap;
        }

        /* 🆕 خلفية صلبة + نص أبيض — نفس منطق باقي شارات الحالة بالمشروع */
        .status-chip.active {
            background: #17a06b;
            color: #ffffff;
        }

        .status-chip.inactive {
            background: #d94b4b;
            color: #ffffff;
        }

        .action-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: transparent;
            border: 1px solid var(--gold, #c9a961);
            color: var(--gold-dark, #8a6d2f);
            padding: 7px 14px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 12.5px;
            font-weight: 700;
            text-decoration: none;
            font-family: 'Tajawal', sans-serif;
            transition: 0.2s ease;
        }

        .action-btn:hover {
            background: var(--gold, #c9a961);
            color: #ffffff;
        }

        .btn-toggle-on {
            border-color: #d94b4b;
            color: #d94b4b;
        }

        .btn-toggle-on:hover {
            background: #d94b4b;
            color: #ffffff;
        }

        .btn-toggle-off {
            border-color: #17a06b;
            color: #17a06b;
        }

        .btn-toggle-off:hover {
            background: #17a06b;
            color: #ffffff;
        }

        .empty-row td {
            text-align: center;
            padding: 40px;
            color: var(--text-soft, #4b5563);
            font-weight: 600;
        }

        .usage-count {
            font-size: 12px;
            color: var(--text-soft, #4b5563);
            font-weight: 500;
        }

        /* ===== Modal ===== */
        .modal {
            display: none;
            position: fixed;
            z-index: 9999;
            inset: 0;
            background: rgba(15, 20, 30, 0.55);
            backdrop-filter: blur(4px);
            align-items: center;
            justify-content: center;
        }

        .modal.open {
            display: flex;
        }

        .modal-content {
            background: var(--surface, #ffffff);
            border: 1px solid var(--border, #e4e8ef);
            width: 100%;
            max-width: 480px;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 25px 60px rgba(20, 25, 35, 0.25);
        }

        .modal-header {
            padding: 18px 22px;
            border-bottom: 1px solid var(--border, #e4e8ef);
            background: var(--surface-2, #fafbfc);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header h4 {
            margin: 0;
            color: var(--text, #202631);
            font-size: 17px;
            font-weight: 800;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .close-modal {
            color: var(--text-soft, #4b5563);
            cursor: pointer;
            font-size: 22px;
            font-weight: bold;
            line-height: 1;
            background: none;
            border: none;
        }

        .close-modal:hover {
            color: #d94b4b;
        }

        .modal-body {
            padding: 22px;
        }

        .field-group {
            margin-bottom: 16px;
        }

        .field-label {
            display: block;
            margin-bottom: 6px;
            font-size: 13.5px;
            color: var(--text, #202631);
            font-weight: 700;
        }

        .field-hint {
            display: block;
            margin-top: 5px;
            font-size: 12px;
            color: var(--text-soft, #4b5563);
        }

        .field-input {
            width: 100%;
            padding: 11px 14px;
            background: var(--surface-2, #fafbfc);
            border: 1px solid var(--border, #e4e8ef);
            border-radius: 8px;
            color: var(--text, #202631);
            font-family: 'Tajawal', sans-serif;
            font-size: 13.5px;
            outline: none;
            box-sizing: border-box;
            transition: 0.2s ease;
        }

        .field-input:focus {
            border-color: var(--gold, #c9a961);
            background: var(--surface, #ffffff);
        }

        .field-row {
            display: flex;
            gap: 12px;
        }

        .field-row .field-group {
            flex: 1;
        }

        .btn-submit {
            width: 100%;
            padding: 12px;
            font-weight: 700;
            border-radius: 8px;
            color: #ffffff;
            background: var(--gold, #c9a961);
            border: none;
            cursor: pointer;
            font-family: 'Tajawal', sans-serif;
            font-size: 14.5px;
            margin-top: 6px;
            transition: 0.2s ease;
        }

        .btn-submit:hover {
            filter: brightness(1.08);
        }

        @media (max-width: 640px) {
            .panel {
                overflow-x: auto;
            }

            .members-table {
                min-width: 620px;
            }
        }
    </style>
@endsection

@section('content')
    <div class="plans-wrapper">
        <div class="panel">
            <div class="panel-head">
                <h3><i class="fas fa-tags"></i> إدارة الباقات والأسعار</h3>
                <button class="btn-solid" onclick="openAddModal()">
                    <i class="fas fa-plus"></i> إضافة باقة جديدة
                </button>
            </div>

            <table class="members-table">
                <thead>
                    <tr>
                        <th>اسم الباقة</th>
                        <th>المدة (يوم)</th>
                        <th>السعر</th>
                        <th>أيام التجميد المسموحة</th>
                        <th>الحالة</th>
                        <th style="text-align: center;">إجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($planTypes as $plan)
                        <tr>
                            <td style="font-weight: 700;">
                                {{ $plan->name }}
                                <div class="usage-count">مستخدَمة في {{ $plan->memberships_count }} اشتراك</div>
                            </td>
                            <td>{{ $plan->duration_days }}</td>
                            <td><span class="price-tag">{{ number_format($plan->price, 2) }}</span></td>
                            <td>{{ $plan->freeze_days_allowed }} يوم</td>
                            <td>
                                <span class="status-chip {{ $plan->is_active ? 'active' : 'inactive' }}">
                                    {{ $plan->is_active ? 'فعّالة' : 'معطّلة' }}
                                </span>
                            </td>
                            <td style="text-align: center;">
                                <div style="display: flex; gap: 6px; justify-content: center; flex-wrap: nowrap;">
                                    <button type="button" class="action-btn"
                                        onclick='openEditModal(@json($plan))'>
                                        <i class="fas fa-pen"></i> تعديل
                                    </button>

                                    <form action="{{ route('admin.plan-types.toggle', $plan->id) }}" method="POST"
                                        style="display: inline;"
                                        onsubmit="return confirm('{{ $plan->is_active ? 'سيتم إخفاء هذه الباقة عن قائمة الاشتراكات الجديدة، مع بقاء الاشتراكات الحالية عليها كما هي. متابعة؟' : 'سيتم إعادة تفعيل هذه الباقة لتظهر عند إنشاء اشتراك جديد. متابعة؟' }}')">
                                        @csrf
                                        <button type="submit"
                                            class="action-btn {{ $plan->is_active ? 'btn-toggle-on' : 'btn-toggle-off' }}">
                                            @if ($plan->is_active)
                                                <i class="fas fa-ban"></i> تعطيل
                                            @else
                                                <i class="fas fa-check"></i> تفعيل
                                            @endif
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr class="empty-row">
                            <td colspan="6">
                                <i class="fas fa-tags"
                                    style="font-size: 30px; color: var(--gold, #c9a961); margin-bottom: 10px; display: block;"></i>
                                لا توجد باقات بعد. ابدأ بإضافة أول باقة (مثلاً: اشتراك شهري).
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- ===== Modal إضافة باقة جديدة ===== --}}
    <div id="addPlanModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h4><i class="fas fa-plus-circle"></i> إضافة باقة جديدة</h4>
                <button type="button" class="close-modal" onclick="closeModal('addPlanModal')">&times;</button>
            </div>
            <form action="{{ route('admin.plan-types.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="field-group">
                        <label class="field-label">اسم الباقة</label>
                        <input type="text" name="name" class="field-input" placeholder="مثال: اشتراك شهري" required>
                    </div>

                    <div class="field-row">
                        <div class="field-group">
                            <label class="field-label">المدة (بالأيام)</label>
                            <input type="number" name="duration_days" class="field-input" placeholder="30" min="1"
                                required>
                            <span class="field-hint">مثال: شهري = 30، سنوي = 365</span>
                        </div>
                        <div class="field-group">
                            <label class="field-label">السعر</label>
                            <input type="number" name="price" class="field-input" placeholder="0.00" step="0.01"
                                min="0" required>
                        </div>
                    </div>

                    <div class="field-group">
                        <label class="field-label">أيام التجميد المسموحة (اختياري)</label>
                        <input type="number" name="freeze_days_allowed" class="field-input" placeholder="0" min="0"
                            value="0">
                        <span class="field-hint">عدد الأيام التي يمكن للاعب تجميد اشتراكه فيها (سفر، إصابة...)</span>
                    </div>

                    <button type="submit" class="btn-submit">حفظ الباقة</button>
                </div>
            </form>
        </div>
    </div>

    {{-- ===== Modal تعديل باقة موجودة ===== --}}
    <div id="editPlanModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h4><i class="fas fa-pen"></i> تعديل الباقة</h4>
                <button type="button" class="close-modal" onclick="closeModal('editPlanModal')">&times;</button>
            </div>
            <form id="editPlanForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="field-group">
                        <label class="field-label">اسم الباقة</label>
                        <input type="text" name="name" id="edit_name" class="field-input" required>
                    </div>

                    <div class="field-row">
                        <div class="field-group">
                            <label class="field-label">المدة (بالأيام)</label>
                            <input type="number" name="duration_days" id="edit_duration_days" class="field-input"
                                min="1" required>
                        </div>
                        <div class="field-group">
                            <label class="field-label">السعر</label>
                            <input type="number" name="price" id="edit_price" class="field-input" step="0.01"
                                min="0" required>
                        </div>
                    </div>

                    <div class="field-group">
                        <label class="field-label">أيام التجميد المسموحة</label>
                        <input type="number" name="freeze_days_allowed" id="edit_freeze_days_allowed"
                            class="field-input" min="0">
                        <span class="field-hint">تعديل السعر لا يؤثر على الاشتراكات القديمة المدفوعة بالسعر السابق.</span>
                    </div>

                    <button type="submit" class="btn-submit">حفظ التعديلات</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function openAddModal() {
            document.getElementById('addPlanModal').classList.add('open');
        }

        function closeModal(id) {
            document.getElementById(id).classList.remove('open');
        }

        function openEditModal(plan) {
            document.getElementById('edit_name').value = plan.name;
            document.getElementById('edit_duration_days').value = plan.duration_days;
            document.getElementById('edit_price').value = plan.price;
            document.getElementById('edit_freeze_days_allowed').value = plan.freeze_days_allowed;

            document.getElementById('editPlanForm').action = '{{ url('admin/plan-types') }}/' + plan.id;

            document.getElementById('editPlanModal').classList.add('open');
        }

        window.onclick = function(event) {
            if (event.target.classList.contains('modal')) {
                event.target.classList.remove('open');
            }
        }
    </script>
@endsection