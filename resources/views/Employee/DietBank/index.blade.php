@extends('Employee.layouts.app')

@section('title', 'بنك الوجبات الغذائية | Elite Club')

@section('styles')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;800&display=swap" rel="stylesheet">
    <style>
        .diet-bank-container {
            --gold: #c9a961;
            --gold-soft: rgba(201, 169, 97, 0.12);
            --gold-line: rgba(201, 169, 97, 0.16);
            --surface: #1c1f27;
            --surface-2: #232733;
            --text: #f2f3f5;
            --muted: #8a8f9c;
            --green: #4ade80;
            --green-soft: rgba(74, 222, 128, 0.12);
            font-family: 'Tajawal', sans-serif;
            padding: 20px;
        }

        .btn-green {
            background: var(--green-soft);
            color: var(--green);
            border: 1px solid rgba(74, 222, 128, 0.3);
            padding: 10px 16px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
        }

        /* شبكة الكاردات المطابقة للصورة المرفوعة */
        .diet-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .diet-card {
            background: var(--surface);
            border: 1px solid var(--gold-line);
            border-radius: 16px;
            overflow: hidden;
            position: relative;
            display: flex;
            flex-direction: column;
            transition: transform 0.2s;
        }

        .diet-card:hover {
            transform: translateY(-4px);
        }

        .diet-card-image {
            height: 180px;
            width: 100%;
            object-fit: cover;
            border-bottom: 1px solid var(--gold-line);
        }

        .diet-card-image-placeholder {
            height: 180px;
            background: linear-gradient(45deg, #13151a, #232733);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--green);
            font-size: 40px;
            border-bottom: 1px solid var(--gold-line);
        }

        .diet-card-body {
            padding: 16px;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .diet-card-title {
            font-size: 17px;
            font-weight: 700;
            color: var(--text);
            margin: 4px 0 8px 0;
            text-align: center;
        }

        .diet-card-desc {
            font-size: 13px;
            color: var(--muted);
            line-height: 1.5;
            margin: 0 0 12px 0;
            flex: 1;
            text-align: center;
        }

        .diet-card-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px solid rgba(255, 255, 255, 0.04);
            padding-top: 12px;
        }

        .calories-badge {
            color: #fff;
            background: rgba(234, 179, 8, 0.8);
            padding: 5px 12px;
            border-radius: 6px;
            font-weight: 700;
            font-size: 13px;
            margin: 0 auto;
        }

        .level-badge {
            position: absolute;
            top: 10px;
            left: 10px;
            background: rgba(201, 169, 97, 0.9);
            color: #1c1f27;
            padding: 4px 10px;
            border-radius: 6px;
            font-weight: 700;
            font-size: 11px;
            text-transform: capitalize;
            z-index: 5;
        }

        .btn-delete {
            background: none;
            border: none;
            color: #f87171;
            cursor: pointer;
            font-size: 13px;
            font-weight: 600;
            position: absolute;
            top: 10px;
            right: 10px;
            background: rgba(0, 0, 0, 0.6);
            padding: 5px 8px;
            border-radius: 6px;
            z-index: 10;
        }

        .btn-delete:hover {
            background: #f87171;
            color: #fff;
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
            max-width: 500px;
            border-radius: 16px;
            overflow: hidden;
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

        .modal-body {
            padding: 20px;
        }

        .field-group {
            margin-bottom: 16px;
        }

        .field-label {
            display: block;
            margin-bottom: 6px;
            font-size: 13px;
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

        .btn-submit {
            width: 100%;
            padding: 12px;
            font-weight: 700;
            border-radius: 8px;
            color: #1c1f27;
            background: linear-gradient(135deg, #a3e635, #4ade80);
            border: none;
            cursor: pointer;
            font-family: 'Tajawal', sans-serif;
        }
    </style>
@endsection

@section('content')
    <div class="dashboard-wrapper diet-bank-container">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
            <h2 style="color: #fff; margin: 0;"><i class="fas fa-apple-alt" style="color: var(--green); margin-left: 8px;"></i>
                بنك الوجبات والخطط الغذائية</h2>
            <button class="btn-green" onclick="openDietModal()"><i class="fas fa-plus"></i> إضافة وجبة جديدة للبنك</button>
        </div>

        <div class="diet-grid">
            @forelse($dietPlans as $diet)
                <div class="diet-card">
                    <span class="level-badge">{{ $diet->level }}</span>

                    <form action="{{ route('employee.diet.bank.destroy', $diet->id) }}" method="POST"
                        onsubmit="return confirm('هل تريد حذف هذه الوجبة من البنك؟')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete"><i class="fas fa-trash-alt"></i></button>
                    </form>

                    @if (!empty($diet->image_path))
                        <img src="{{ asset($diet->image_path) }}" class="diet-card-image" alt="Meal Image">
                    @else
                        <div class="diet-card-image-placeholder">
                            <i class="fas fa-utensils"></i>
                        </div>
                    @endif

                    <div class="diet-card-body">
                        <h4 class="diet-card-title">{{ $diet->meal_name }}</h4>
                        <p class="diet-card-desc">{{ $diet->plan_details }}</p>

                        <div class="diet-card-footer">
                            <span class="calories-badge">سعرة {{ $diet->calories }}</span>
                        </div>
                    </div>
                </div>
            @empty
                <div style="grid-column: 1/-1; text-align: center; padding: 40px; color: var(--muted);">البنك فارغ من
                    الوجبات حالياً لهذا المستوى.</div>
            @endforelse
        </div>

        {{-- ===== الـ Modal المنبثق لإضافة وجبة للمستويات وتحديد مستواها ===== --}}
        <div id="addDietModal" class="modal">
            <div class="modal-content" style="border-color: rgba(74, 222, 128, 0.3);">
                <div class="modal-header" style="border-bottom-color: var(--green-soft);">
                    <h4><i class="fas fa-apple-alt" style="color: var(--green);"></i> إضافة وجبة غذائية للبنك</h4>
                    <span class="close-modal" onclick="closeDietModal()">&times;</span>
                </div>
                <form action="{{ route('employee.diet.bank.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="field-group">
                            <label class="field-label">اسم الوجبة</label>
                            <input type="text" name="meal_name" class="field-input" placeholder="مثال: صدر دجاج مع أرز"
                                required>
                        </div>
                        <div class="field-group">
                            <label class="field-label">المستوى المستهدف للوجبة</label>
                            <select name="level" class="field-input" required>
                                <option value="">-- اختر المستوى لتخصيص الوجبة له تلقائياً --</option>
                                <option value="beginner">Beginner (مبتدئ)</option>
                                <option value="intermediate">Intermediate (متوسط)</option>
                                <option value="advanced">Advanced (متقدم)</option>
                            </select>
                        </div>
                        <div class="field-group">
                            <label class="field-label">عدد السعرات الحرارية (Calories)</label>
                            <input type="number" name="calories" class="field-input" placeholder="مثال: 520" required>
                        </div>
                        <div class="field-group">
                            <label class="field-label">صورة الوجبة</label>
                            <input type="file" name="image" class="field-input" accept="image/*">
                        </div>
                        <div class="field-group">
                            <label class="field-label">المكونات والتفاصيل</label>
                            <textarea name="plan_details" class="field-input" rows="4" placeholder="اكتب المكونات بالتفصيل هنا..." required></textarea>
                        </div>
                        <button type="submit" class="btn-submit">حفظ وتعميم الوجبة</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function openDietModal() {
            document.getElementById('addDietModal').classList.add('open');
        }

        function closeDietModal() {
            document.getElementById('addDietModal').classList.remove('open');
        }
        window.onclick = function(event) {
            if (event.target == document.getElementById('addDietModal')) closeDietModal();
        }
    </script>
@endsection
