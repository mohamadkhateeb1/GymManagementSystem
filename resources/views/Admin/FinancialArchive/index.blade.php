@extends('Admin.layouts.app')

@section('title', 'أرشيف الإدارة المالية | Elite Club')

@section('styles')
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800&display=swap" rel="stylesheet">
    <style>
        .archive-wrapper {
            font-family: 'Tajawal', sans-serif;
        }

        .panel {
            background: var(--surface, #13161d);
            border: 1px solid var(--border, #252a38);
            border-radius: 16px;
            margin-bottom: 24px;
            overflow: hidden;
        }

        .panel-head {
            padding: 18px 24px;
            border-bottom: 1px solid var(--border, #252a38);
            background: rgba(255, 255, 255, 0.02);
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .panel-head h3 {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 16px;
            font-weight: 700;
            color: var(--text, #e8eaf6);
            margin: 0;
        }

        .panel-head h3::before {
            content: '';
            width: 4px;
            height: 18px;
            border-radius: 4px;
            background: #c9a961;
        }

        .type-filter {
            display: flex;
            gap: 8px;
        }

        .type-filter a {
            padding: 7px 14px;
            border-radius: 8px;
            font-size: 12.5px;
            font-weight: 700;
            text-decoration: none;
            color: var(--text-muted, #9ca3af);
            border: 1px solid var(--border, #252a38);
            transition: 0.2s ease;
        }

        .type-filter a.active,
        .type-filter a:hover {
            border-color: #c9a961;
            color: #c9a961;
        }

        .members-table {
            width: 100%;
            border-collapse: collapse;
            text-align: right;
        }

        .members-table th {
            font-size: 12px;
            color: var(--text-muted, #9ca3af);
            padding: 14px 24px;
            border-bottom: 1px solid var(--border, #252a38);
            font-weight: 600;
        }

        .members-table td {
            padding: 15px 24px;
            font-size: 14px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.04);
            color: var(--text, #e8eaf6);
        }

        .members-table tbody tr:hover {
            background: rgba(255, 255, 255, 0.02);
        }

        .type-chip {
            display: inline-flex;
            align-items: center;
            padding: 5px 11px;
            border-radius: 6px;
            font-size: 11.5px;
            font-weight: 700;
        }

        .type-chip.membership {
            background: rgba(108, 99, 255, 0.12);
            color: #6c63ff;
        }

        .type-chip.payment {
            background: rgba(90, 156, 122, 0.12);
            color: #5a9c7a;
        }

        .action-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: transparent;
            border: 1px solid var(--accent, #6c63ff);
            color: var(--accent, #6c63ff);
            padding: 7px 14px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 12px;
            font-weight: 600;
            font-family: 'Tajawal', sans-serif;
            transition: 0.2s ease;
        }

        .action-btn:hover {
            background: var(--accent, #6c63ff);
            color: #fff;
        }

        .empty-row td {
            text-align: center;
            padding: 40px;
            color: var(--text-muted, #9ca3af);
        }

        /* ===== Modal تفاصيل السجل المؤرشف ===== */
        .modal {
            display: none;
            position: fixed;
            z-index: 9999;
            inset: 0;
            background: rgba(0, 0, 0, 0.75);
            backdrop-filter: blur(4px);
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .modal.open {
            display: flex;
        }

        .modal-content {
            background: var(--surface, #13161d);
            border: 1px solid var(--border, #252a38);
            width: 100%;
            max-width: 460px;
            max-height: 85vh;
            border-radius: 18px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.5);
        }

        .archive-modal-header {
            padding: 22px 24px 18px;
            background: linear-gradient(160deg, rgba(201, 169, 97, 0.08), transparent);
            border-bottom: 1px solid var(--border, #252a38);
            position: relative;
        }

        .archive-modal-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: rgba(201, 169, 97, 0.12);
            border: 1px solid rgba(201, 169, 97, 0.25);
            color: #c9a961;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 17px;
            margin-bottom: 12px;
        }

        #detailsTitle {
            margin: 0;
            color: var(--text, #e8eaf6);
            font-size: 15px;
            font-weight: 700;
            line-height: 1.4;
        }

        .close-modal {
            position: absolute;
            top: 18px;
            left: 20px;
            color: var(--text-muted, #9ca3af);
            cursor: pointer;
            font-size: 20px;
            font-weight: bold;
            line-height: 1;
            background: none;
            border: none;
        }

        .close-modal:hover {
            color: var(--text, #e8eaf6);
        }

        .modal-body {
            padding: 8px 0;
            overflow-y: auto;
        }

        .payload-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 11px 24px;
            font-size: 13.5px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.03);
        }

        .payload-row .label {
            color: var(--text-muted, #9ca3af);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .payload-row .label i {
            width: 16px;
            font-size: 12px;
            color: #c9a961;
            opacity: 0.8;
        }

        .payload-row .value {
            color: var(--text, #e8eaf6);
            font-weight: 600;
            text-align: left;
            direction: ltr;
        }

        .payload-row .value.highlight {
            color: #5a9c7a;
            font-weight: 800;
            font-size: 15px;
        }

        .payload-row .value.status-active {
            color: #5a9c7a;
        }

        .payload-row .value.status-inactive {
            color: #c55a5a;
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
    <div class="archive-wrapper">
        <div class="panel">
            <div class="panel-head">
                <h3><i class="fas fa-box-archive"></i> أرشيف الإدارة المالية</h3>
                <div class="type-filter">
                    <a href="{{ route('admin.financial-archive.index') }}" class="{{ !$type ? 'active' : '' }}">الكل</a>
                    <a href="{{ route('admin.financial-archive.index', ['type' => 'membership']) }}"
                        class="{{ $type === 'membership' ? 'active' : '' }}">الاشتراكات</a>
                    <a href="{{ route('admin.financial-archive.index', ['type' => 'payment']) }}"
                        class="{{ $type === 'payment' ? 'active' : '' }}">الدفعات</a>
                </div>
            </div>

            <table class="members-table">
                <thead>
                    <tr>
                        <th>اسم صاحب السجل</th>
                        <th>النوع</th>
                        <th>رفعه</th>
                        <th>التاريخ</th>
                        <th style="text-align: center;">الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($archives as $archive)
                        <tr>
                            <td style="font-weight: 500;">{{ $archive->player_name ?? '—' }}</td>
                            <td>
                                @php
                                    $typeLabels = ['membership' => 'اشتراك', 'payment' => 'تقرير مالي'];
                                @endphp
                                <span class="type-chip {{ $archive->archivable_type }}">
                                    {{ $typeLabels[$archive->archivable_type] ?? $archive->archivable_type }}
                                </span>
                            </td>
                            <td>{{ $archive->admin->name ?? '—' }}</td>
                            <td dir="ltr">{{ $archive->archived_at->format('Y-m-d H:i') }}</td>
                            <td style="text-align: center;">
                                <button type="button" class="action-btn"
                                    onclick='openDetailsModal(@json($archive))'>
                                    <i class="fas fa-eye"></i> عرض
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr class="empty-row">
                            <td colspan="5">
                                <i class="fas fa-box-archive"
                                    style="font-size: 30px; color: #c9a961; margin-bottom: 10px; display: block;"></i>
                                لا توجد سجلات مؤرشفة بعد.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- ===== Modal عرض تفاصيل السجل المؤرشف (Snapshot كامل، بعرض عربي منسّق) ===== --}}
    <div id="detailsModal" class="modal">
        <div class="modal-content">
            <div class="archive-modal-header">
                <button type="button" class="close-modal" onclick="closeModal()">&times;</button>
                <div class="archive-modal-icon"><i class="fas fa-box-archive"></i></div>
                <h4 id="detailsTitle"></h4>
            </div>
            <div class="modal-body" id="detailsBody"></div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // 🏷️ ترجمة أسماء الأعمدة التقنية إلى عناوين عربية مفهومة للأدمن
        const FIELD_LABELS = {
            name: {label: 'الاسم', icon: 'fa-tag'},
            plan_name: {label: 'اسم الباقة', icon: 'fa-tag'},
            duration_days: {label: 'المدة', icon: 'fa-clock', suffix: ' يوم'},
            price: {label: 'السعر', icon: 'fa-sack-dollar', highlight: true},
            price_paid: {label: 'المبلغ المدفوع', icon: 'fa-sack-dollar', highlight: true},
            freeze_days_allowed: {label: 'أيام التجميد المسموحة', icon: 'fa-snowflake', suffix: ' يوم'},
            is_active: {label: 'الحالة', icon: 'fa-toggle-on', boolLabels: ['معطّلة', 'فعّالة']},
            status: {label: 'حالة الاشتراك', icon: 'fa-circle-check', statusColor: true},
            start_date: {label: 'تاريخ البدء', icon: 'fa-calendar-day', isDate: true},
            end_date: {label: 'تاريخ الانتهاء', icon: 'fa-calendar-check', isDate: true},
            amount: {label: 'المبلغ', icon: 'fa-sack-dollar', highlight: true},
            type: {label: 'نوع العملية', icon: 'fa-rotate', paymentType: true},
            paid_at: {label: 'تاريخ الدفع', icon: 'fa-calendar-day', isDate: true},
        };

        // 🚫 حقول تقنية بحتة لا تفيد الأدمن بالعرض، تُستبعد من نافذة التفاصيل
        const HIDDEN_FIELDS = [
            'id', 'player_id', 'plan_type_id', 'coach_id', 'membership_id',
            'deleted_at', 'created_at', 'updated_at',
        ];

        function formatDate(value) {
            // "2026-08-25T21:00:00.000000Z" → "2026-08-25"
            return String(value).split('T')[0];
        }

        function openDetailsModal(archive) {
            document.getElementById('detailsTitle').textContent = archive.title;

            const body = document.getElementById('detailsBody');
            body.innerHTML = '';

            Object.entries(archive.payload).forEach(([key, value]) => {
                if (HIDDEN_FIELDS.includes(key) || value === null || typeof value === 'object') {
                    return;
                }

                const meta = FIELD_LABELS[key] || {label: key, icon: 'fa-circle-dot'};

                let displayValue = value;
                let valueClass = '';

                if (meta.isDate) {
                    displayValue = formatDate(value);
                } else if (meta.boolLabels) {
                    // is_active: 1/0 أو true/false
                    const isTrue = value == 1 || value === true;
                    displayValue = meta.boolLabels[isTrue ? 1 : 0];
                    valueClass = isTrue ? 'status-active' : 'status-inactive';
                } else if (meta.statusColor && key === 'status') {
                    const isActiveStatus = value === 'active';
                    displayValue = isActiveStatus ? 'فعّال' : (value === 'expired' ? 'منتهي/مجمّد' : value);
                    valueClass = isActiveStatus ? 'status-active' : 'status-inactive';
                } else if (meta.paymentType) {
                    displayValue = value === 'new' ? 'اشتراك جديد' : 'تجديد';
                } else if (meta.suffix) {
                    displayValue = value + meta.suffix;
                } else if (meta.highlight) {
                    displayValue = Number(value).toFixed(2);
                }

                if (meta.highlight) {
                    valueClass = (valueClass + ' highlight').trim();
                }

                const row = document.createElement('div');
                row.className = 'payload-row';
                row.innerHTML = `
                    <span class="label"><i class="fas ${meta.icon}"></i> ${meta.label}</span>
                    <span class="value ${valueClass}">${displayValue}</span>
                `;
                body.appendChild(row);
            });

            document.getElementById('detailsModal').classList.add('open');
        }

        function closeModal() {
            document.getElementById('detailsModal').classList.remove('open');
        }

        window.onclick = function(event) {
            if (event.target.classList.contains('modal')) {
                event.target.classList.remove('open');
            }
        }
    </script>
@endsection