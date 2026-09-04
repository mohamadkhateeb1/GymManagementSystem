@extends('Admin.layouts.app')

@section('title', 'أرشيف الإدارة المالية | Elite Club')

@section('styles')
    <style>
        /* ELITE CLUB — FINANCIAL ARCHIVE (نسخة مختصرة تعتمد متغيّرات الثيم الموحّدة) */

        .panel {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
        }

        .panel-head {
            padding: 18px 24px;
            border-bottom: 1px solid var(--border);
            background: var(--surface-2);
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
            font-size: 17px;
            font-weight: 800;
            color: var(--text);
            margin: 0;
        }

        .panel-head h3::before {
            content: '';
            width: 4px;
            height: 18px;
            border-radius: 4px;
            background: var(--gold);
        }

        .type-filter {
            display: flex;
            gap: 8px;
        }

        .type-filter a {
            padding: 7px 14px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            color: var(--text-soft);
            border: 1px solid var(--border);
            transition: .2s ease;
        }

        .type-filter a.active,
        .type-filter a:hover {
            border-color: var(--gold);
            color: var(--gold-dark);
            background: var(--sidebar-active);
        }

        .archive-table {
            width: 100%;
            border-collapse: collapse;
            text-align: right;
            font-size: 14px;
        }

        .archive-table th {
            font-size: 13px;
            color: var(--text);
            padding: 14px 24px;
            border-bottom: 1px solid var(--border);
            font-weight: 800;
        }

        .archive-table td {
            padding: 15px 24px;
            border-bottom: 1px solid var(--border-soft);
            color: var(--text);
        }

        .archive-table tbody tr:hover {
            background: var(--surface-hover);
        }

        .type-chip {
            display: inline-flex;
            align-items: center;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 800;
            color: #fff;
        }

        .type-chip.membership {
            background: var(--gold);
        }

        .type-chip.payment {
            background: var(--success);
        }

        .action-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: transparent;
            border: 1px solid var(--gold);
            color: var(--gold-dark);
            padding: 7px 14px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 12.5px;
            font-weight: 700;
            transition: .2s ease;
        }

        .action-btn:hover {
            background: var(--gold);
            color: #fff;
        }

        .empty-row td {
            text-align: center;
            padding: 40px;
            color: var(--text-soft);
            font-weight: 600;
        }

        .table-wrap {
            overflow-x: auto;
        }

        .archive-table {
            min-width: 620px;
        }

        /* ===== Modal تفاصيل السجل المؤرشف ===== */
        .modal {
            display: none;
            position: fixed;
            z-index: 9999;
            inset: 0;
            background: rgba(15, 20, 30, .55);
            backdrop-filter: blur(4px);
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .modal.open {
            display: flex;
        }

        .modal-content {
            background: var(--surface);
            border: 1px solid var(--border);
            width: 100%;
            max-width: 460px;
            max-height: 85vh;
            border-radius: 18px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            box-shadow: 0 25px 60px rgba(20, 25, 35, .25);
        }

        .archive-modal-header {
            padding: 22px 24px 18px;
            background: var(--sidebar-active);
            border-bottom: 1px solid var(--border);
            position: relative;
        }

        .archive-modal-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: rgba(184, 146, 62, .15);
            border: 1px solid rgba(184, 146, 62, .28);
            color: var(--gold-dark);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 17px;
            margin-bottom: 12px;
        }

        #detailsTitle {
            margin: 0;
            color: var(--text);
            font-size: 16px;
            font-weight: 800;
            line-height: 1.4;
        }

        .close-modal {
            position: absolute;
            top: 18px;
            left: 20px;
            color: var(--text-soft);
            cursor: pointer;
            font-size: 20px;
            font-weight: bold;
            background: none;
            border: none;
        }

        .close-modal:hover {
            color: var(--danger);
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
            font-size: 14px;
            border-bottom: 1px solid var(--border-soft);
        }

        .payload-row .label {
            color: var(--text-soft);
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 600;
        }

        .payload-row .label i {
            width: 16px;
            font-size: 12px;
            color: var(--gold-dark);
        }

        .payload-row .value {
            color: var(--text);
            font-weight: 700;
            text-align: left;
            direction: ltr;
        }

        .payload-row .value.highlight {
            color: var(--success);
            font-weight: 800;
            font-size: 15px;
        }

        .payload-row .value.status-active {
            color: var(--success);
        }

        .payload-row .value.status-inactive {
            color: var(--danger);
        }
    </style>
@endsection

@section('content')
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

        <div class="table-wrap">
            <table class="archive-table">
                <thead>
                    <tr>
                        <th>اسم صاحب السجل</th>
                        <th>النوع</th>
                        <th>رفعه</th>
                        <th>التاريخ</th>
                        <th style="text-align:center;">الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($archives as $archive)
                        <tr>
                            <td style="font-weight: 700;">{{ $archive->player_name ?? '—' }}</td>
                            <td>
                                @php $typeLabels = ['membership' => 'اشتراك', 'payment' => 'تقرير مالي']; @endphp
                                <span
                                    class="type-chip {{ $archive->archivable_type }}">{{ $typeLabels[$archive->archivable_type] ?? $archive->archivable_type }}</span>
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
                                    style="font-size:30px; color:var(--gold); margin-bottom:10px; display:block;"></i>
                                لا توجد سجلات مؤرشفة بعد.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Modal عرض تفاصيل السجل المؤرشف --}}
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
            name: {
                label: 'الاسم',
                icon: 'fa-tag'
            },
            plan_name: {
                label: 'اسم الباقة',
                icon: 'fa-tag'
            },
            duration_days: {
                label: 'المدة',
                icon: 'fa-clock',
                suffix: ' يوم'
            },
            price: {
                label: 'السعر',
                icon: 'fa-sack-dollar',
                highlight: true
            },
            price_paid: {
                label: 'المبلغ المدفوع',
                icon: 'fa-sack-dollar',
                highlight: true
            },
            freeze_days_allowed: {
                label: 'أيام التجميد المسموحة',
                icon: 'fa-snowflake',
                suffix: ' يوم'
            },
            is_active: {
                label: 'الحالة',
                icon: 'fa-toggle-on',
                boolLabels: ['معطّلة', 'فعّالة']
            },
            status: {
                label: 'حالة الاشتراك',
                icon: 'fa-circle-check',
                statusColor: true
            },
            start_date: {
                label: 'تاريخ البدء',
                icon: 'fa-calendar-day',
                isDate: true
            },
            end_date: {
                label: 'تاريخ الانتهاء',
                icon: 'fa-calendar-check',
                isDate: true
            },
            amount: {
                label: 'المبلغ',
                icon: 'fa-sack-dollar',
                highlight: true
            },
            type: {
                label: 'نوع العملية',
                icon: 'fa-rotate',
                paymentType: true
            },
            paid_at: {
                label: 'تاريخ الدفع',
                icon: 'fa-calendar-day',
                isDate: true
            },
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

                const meta = FIELD_LABELS[key] || {
                    label: key,
                    icon: 'fa-circle-dot'
                };

                let displayValue = value;
                let valueClass = '';

                if (meta.isDate) {
                    displayValue = formatDate(value);
                } else if (meta.boolLabels) {
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
