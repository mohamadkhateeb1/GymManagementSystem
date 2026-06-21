@extends('Employee.layouts.app')

@section('title', 'بنك الخطط التدريبية | Elite Club')

@section('styles')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;800&display=swap" rel="stylesheet">
    <style>
        .bank-container {
            --gold: #c9a961;
            --gold-soft: rgba(201, 169, 97, 0.12);
            --gold-line: rgba(201, 169, 97, 0.16);
            --surface: #1c1f27;
            --surface-2: #232733;
            --text: #f2f3f5;
            --muted: #8a8f9c;
            font-family: 'Tajawal', sans-serif;
            padding: 20px;
        }

        .btn-green {
            background: rgba(90, 156, 122, 0.1);
            color: #5a9c7a;
            border: 1px solid rgba(90, 156, 122, 0.3);
            padding: 10px 16px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
        }

        .btn-delete {
            background: rgba(197, 90, 90, 0.1);
            color: #c55a5a;
            border: 1px solid rgba(197, 90, 90, 0.2);
            padding: 5px 10px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 12px;
            transition: all 0.2s;
        }

        .btn-delete:hover {
            background: #c55a5a;
            color: #fff;
        }

        .members-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        .members-table th {
            padding: 15px;
            text-align: right;
            color: var(--muted);
            border-bottom: 1px solid var(--gold-soft);
            background: rgba(255, 255, 255, 0.01);
        }

        .members-table td {
            padding: 15px;
            border-bottom: 1px solid rgba(201, 169, 97, 0.06);
            color: var(--text);
            vertical-align: middle;
        }

        /* شارات تصفية المستويات داخل الجدول */
        .level-chip {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 700;
            text-transform: capitalize;
            background: rgba(201, 169, 97, 0.15);
            color: var(--gold);
            border: 1px solid rgba(201, 169, 97, 0.25);
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 9999;
            inset: 0;
            background: rgba(0, 0, 0, 0.75);
            backdrop-filter: blur(4px);
            align-items: center;
            justify-content: center;
        }

        .modal.open {
            display: flex;
        }

        .modal-content {
            background: var(--surface);
            border: 1px solid var(--gold-line);
            width: 100%;
            max-width: 550px;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            animation: modalFade 0.25s ease;
        }

        @keyframes modalFade {
            from {
                transform: translateY(-15px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .modal-header {
            padding: 16px 20px;
            border-bottom: 1px solid var(--gold-soft);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header h4 {
            margin: 0;
            color: var(--text);
            font-size: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .close-modal {
            color: var(--muted);
            cursor: pointer;
            font-size: 24px;
            font-weight: bold;
            line-height: 1;
        }
        
        .close-modal:hover {
            color: #fff;
        }

        .modal-body {
            padding: 20px;
        }

        .field-group {
            margin-bottom: 16px;
        }

        .field-label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            color: var(--text);
            font-weight: 600;
        }

        .field-input {
            width: 100%;
            padding: 12px;
            background: var(--surface-2);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 8px;
            color: var(--text);
            font-family: 'Tajawal', sans-serif;
            outline: none;
            box-sizing: border-box;
        }
        
        .field-input:focus {
            border-color: var(--gold);
        }

        .btn-submit {
            width: 100%;
            padding: 12px;
            font-weight: 700;
            border-radius: 8px;
            color: #1c1f27;
            background: linear-gradient(135deg, #e7cd8e, #c9a961);
            border: none;
            cursor: pointer;
            font-family: 'Tajawal', sans-serif;
        }
    </style>
@endsection

@section('content')
    <div class="dashboard-wrapper bank-container">
        <!-- هيدر القسم -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h2 style="color: #fff; margin: 0;"><i class="fas fa-dumbbell" style="color: var(--gold); margin-left: 8px;"></i>
                بنك الخطط التدريبية العامة</h2>
            <button class="btn-green" onclick="openAddModal()"><i class="fas fa-plus"></i> إضافة خطة جديدة للبنك</button>
        </div>

        <!-- جدول الخطط المتاحة بالبنك -->
        <div class="panel"
            style="background: var(--surface); border: 1px solid var(--gold-line); border-radius: 14px; overflow: hidden;">
            <table class="members-table">
                <thead>
                    <tr>
                        <th>تفاصيل الخطة التدريبية</th>
                        <th style="width: 15%; text-align: center;">المستوى المستهدف</th>
                        <th style="width: 15%; text-align: center;">تاريخ الإنشاء</th>
                        <th style="width: 10%; text-align: center;">إجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($trainingPlans as $plan)
                        <tr>
                            <td style="font-weight: 500; line-height: 1.6;">{{ $plan->plan_details }}</td>
                            <td style="text-align: center;">
                                <span class="level-chip">{{ $plan->level ?? 'لم يحدد' }}</span>
                            </td>
                            <td style="text-align: center; color: var(--muted);">{{ $plan->created_at->format('Y-m-d') }}</td>
                            <td style="text-align: center;">
                                <form action="{{ route('employee.training.bank.destroy', $plan->id) }}" method="POST"
                                    onsubmit="return confirm('هل أنت متأكد من حذف هذه الخطة من البنك؟')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete"><i class="fas fa-trash"></i> حذف</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" style="text-align: center; padding: 30px; color: var(--muted);">البنك فارغ
                                حالياً، ابدأ بإضافة خطتك التدريبية الأولى وتخصيص مستواها.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- ===== Modal إضافة خطة تمارين للبنك وتحديد المستوى تلقائياً ===== --}}
        <div id="addPlanModal" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h4><i class="fas fa-dumbbell" style="color: var(--gold);"></i> إضافة خطة تمارين عامة للبنك</h4>
                    <span class="close-modal" onclick="closeAddModal()">&times;</span>
                </div>
                <form action="{{ route('employee.training.bank.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <!-- حقل تحديد المستوى المستهدف الجديد -->
                        <div class="field-group" style="padding: 0 0 16px 0;">
                            <label class="field-label">المستوى المستهدف لهذه الخطة</label>
                            <select name="level" class="field-input" required>
                                <option value="">-- اختر المستوى لتخصيص الخطة له تلقائياً --</option>
                                <option value="beginner">Beginner (مبتدئ)</option>
                                <option value="intermediate">Intermediate (متوسط)</option>
                                <option value="advanced">Advanced (متقدم)</option>
                            </select>
                        </div>

                        <div class="field-group" style="padding: 0 0 16px 0;">
                            <label class="field-label">اكتب تفاصيل جدول التمارين والملاحظات</label>
                            <textarea name="plan_details" class="field-input" rows="7"
                                placeholder="مثال: يوم 1: صدر وتراي، يوم 2: ظهر وباي... اكتب تفاصيل المجموعات هنا..." required></textarea>
                        </div>
                        <button type="submit" class="btn-submit">حفظ وتعميم الخطة بالبنك</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function openAddModal() {
            document.getElementById('addPlanModal').classList.add('open');
        }

        function closeAddModal() {
            document.getElementById('addPlanModal').classList.remove('open');
        }
        window.onclick = function(event) {
            if (event.target == document.getElementById('addPlanModal')) closeAddModal();
        }
    </script>
@endsection