@extends('Employee.layouts.app')

@section('title', 'تمارين الخطة | Elite Club')

@section('styles')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;800&display=swap" rel="stylesheet">
    <style>
        .ex-container {
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

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--gold);
            text-decoration: none;
            font-weight: 600;
            margin-bottom: 20px;
            transition: transform 0.2s;
        }

        .back-btn:hover {
            transform: translateX(5px);
        }

        .btn-gold {
            background: linear-gradient(135deg, #e7cd8e, #c9a961);
            color: #1c1f27;
            border: none;
            padding: 10px 18px;
            border-radius: 8px;
            font-weight: 700;
            cursor: pointer;
            font-family: 'Tajawal', sans-serif;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .ex-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .ex-card {
            background: var(--surface);
            border: 1px solid var(--gold-line);
            border-radius: 14px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .ex-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.4);
            border-color: rgba(201, 169, 97, 0.4);
        }

        .ex-img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            background: var(--surface-2);
            border-bottom: 1px solid var(--gold-soft);
        }

        .ex-placeholder {
            width: 100%;
            height: 180px;
            background: var(--surface-2);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gold);
            font-size: 40px;
            border-bottom: 1px solid var(--gold-soft);
        }

        .ex-body {
            padding: 16px;
            flex-grow: 1;
        }

        .badge-info {
            background: rgba(201, 169, 97, 0.12);
            color: var(--gold);
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 700;
            display: inline-block;
            margin-bottom: 10px;
            border: 1px solid rgba(201, 169, 97, 0.2);
        }

        .btn-delete {
            background: rgba(197, 90, 90, 0.1);
            color: #c55a5a;
            border: 1px solid rgba(197, 90, 90, 0.2);
            padding: 8px 12px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 12px;
            font-weight: 600;
            width: 100%;
            transition: all 0.2s;
        }

        .btn-delete:hover {
            background: #c55a5a;
            color: #fff;
        }

        /* Modal Styles */
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
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
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
        }

        .field-group {
            margin-bottom: 14px;
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
            padding: 10px 12px;
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
    </style>
@endsection

@section('content')
@if ($errors->any())
    <div style="background: rgb(58, 28, 28); border: 1px solid #c55a5a; color: #fff; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
        <ul style="margin: 0; padding-right: 20px;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('success'))
    <div style="background: rgba(90, 156, 122, 0.2); border: 1px solid #5a9c7a; color: #fff; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
        {{ session('success') }}
    </div>
@endif
    <div class="dashboard-wrapper ex-container">
        <!-- زر العودة -->
        <a href="{{ route('employee.training.bank') }}" class="back-btn">
            <i class="fas fa-arrow-right"></i> العودة لجدول بنك الخطط
        </a>

        <!-- هيدر الصفحة -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <div>
                <h2 style="color: #fff; margin: 0;"><i class="fas fa-dumbbell"
                        style="color: var(--gold); margin-left: 8px;"></i>
                    تمارين خطة: {{ $trainingPlan->title ?? 'خطة تدريبية' }}</h2>
                <span style="color: var(--muted); font-size: 13px;">المستوى المستهدف:
                    {{ $trainingPlan->level ?? 'عام' }}</span>
            </div>
            <button class="btn-gold" onclick="openAddModal()"><i class="fas fa-plus"></i> إضافة تمرين جديد للخطة</button>
        </div>

        <!-- 🎯 عرض التمارين كـ Cards Grid -->
        <div class="ex-grid">
            @forelse($exercises as $ex)
                <div class="ex-card">
                    @if ($ex->image_path)
                        <img src="{{ asset('storage/' . $ex->image_path) }}" alt="{{ $ex->name }}" class="ex-img">
                    @else
                        <div class="ex-placeholder">
                            <i class="fas fa-running"></i>
                        </div>
                    @endif

                    <div class="ex-body">
                        <h3 style="color: var(--gold); margin: 0 0 10px 0; font-size: 16px;">{{ $ex->name }}</h3>

                        <div style="display: flex; gap: 8px; margin-bottom: 12px;">
                            <span class="badge-info"><i class="fas fa-redo"></i> {{ $ex->sets }} جولات</span>
                            <span class="badge-info"><i class="fas fa-sync-alt"></i> {{ $ex->reps }} تكرارات</span>
                        </div>

                        @if ($ex->instructions)
                            <p
                                style="color: var(--text); font-size: 13px; line-height: 1.6; margin-bottom: 12px; white-space: pre-line;">
                                {{ $ex->instructions }}
                            </p>
                        @endif

                        @if ($ex->video_url)
                            <a href="{{ $ex->video_url }}" target="_blank"
                                style="color: #5a9c7a; font-size: 12px; text-decoration: none; display: inline-flex; align-items: center; gap: 4px; margin-bottom: 12px;">
                                <i class="fas fa-video"></i> مشاهدة فيديو الشرح
                            </a>
                        @endif
                    </div>

                    <div style="padding: 12px 16px; border-top: 1px solid var(--gold-soft);">
                        <form action="{{ route('employee.training.exercises.destroy', $ex->id) }}" method="POST"
                            onsubmit="return confirm('هل أنت متأكد من حذف هذا التمرين؟')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete"><i class="fas fa-trash"></i> حذف التمرين</button>
                        </form>
                    </div>
                </div>
            @empty
                <div
                    style="grid-column: 1 / -1; text-align: center; padding: 50px; background: var(--surface); border: 1px solid var(--gold-line); border-radius: 14px; color: var(--muted);">
                    <i class="fas fa-dumbbell"
                        style="font-size: 40px; color: var(--gold); margin-bottom: 15px; display: block;"></i>
                    لا توجد تمارين مضافة لهذه الخطة حتى الآن، انقر على "إضافة تمرين جديد" للبدء.
                </div>
            @endforelse
        </div>

        <!-- 🎯 Modal إضافة تمرين جديد -->
        <div id="addExModal" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h4><i class="fas fa-plus-circle" style="color: var(--gold);"></i> إضافة تمرين جديد للخطة</h4>
                    <span style="color: var(--muted); cursor: pointer; font-size: 20px;"
                        onclick="closeAddModal()">&times;</span>
                </div>
                <form action="{{ route('employee.training.exercises.store', $trainingPlan->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div style="padding: 20px;">
                        <div class="field-group">
                            <label class="field-label">اسم التمرين</label>
                            <input type="text" name="name" class="field-input"
                                placeholder="مثال: بنش برس مستوي بالبار" >
                        </div>

                        <div style="display: flex; gap: 10px;">
                            <div class="field-group" style="flex: 1;">
                                <label class="field-label">عدد الجولات (Sets)</label>
                                <input type="number" name="sets" value="4" min="1" class="field-input"
                                    >
                            </div>
                            <div class="field-group" style="flex: 1;">
                                <label class="field-label">عدد التكرارات (Reps)</label>
                                <input type="number" name="reps" value="12" min="1" class="field-input"
                                    >
                            </div>
                        </div>

                        <div class="field-group">
                            <label class="field-label">شرح طريقة أداء التمرين والملاحظات</label>
                            <textarea name="instructions" class="field-input" rows="4" placeholder="اكتب تعليمات التمرين والتركيز العضلي..."></textarea>
                        </div>

                        <div class="field-group">
                            <label class="field-label">صورة توضيحية للتمرين (اختياري)</label>
                            <input type="file" name="image" class="field-input" accept="image/*">
                        </div>

                        <div class="field-group">
                            <label class="field-label">رابط فيديو التمرين (اختياري)</label>
                            <input type="url" name="video_url" class="field-input"
                                placeholder="https://youtube.com/...">
                        </div>

                        <button type="submit" class="btn-gold"
                            style="width: 100%; margin-top: 10px; justify-content: center;">حفظ إضافة التمرين</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function openAddModal() {
            document.getElementById('addExModal').classList.add('open');
        }

        function closeAddModal() {
            document.getElementById('addExModal').classList.remove('open');
        }

        window.onclick = function(event) {
            if (event.target == document.getElementById('addExModal')) closeAddModal();
        }
    </script>
@endsection
