@extends('Employee.layouts.app')

@section('title', 'تعديل الوجبة | Elite Club')

@section('styles')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;800&display=swap" rel="stylesheet">

    <style>
        .diet-edit-container {
            width: 100%;
            max-width: 900px;
            margin: 0 auto;
            padding: 22px;
            color: var(--text);
            font-family: "Cairo", "Tajawal", Arial, sans-serif;
            direction: rtl;
            box-sizing: border-box;
        }

        .diet-edit-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            margin-bottom: 22px;
            padding-bottom: 18px;
            border-bottom: 1px solid var(--border);
        }

        .diet-edit-title {
            min-width: 0;
        }

        .diet-edit-title h2 {
            margin: 0 0 7px;
            color: var(--text);
            font-size: 23px;
            font-weight: 850;
            line-height: 1.5;
        }

        .diet-edit-title h2 i {
            color: var(--gold);
            margin-left: 8px;
        }

        .diet-edit-title p {
            margin: 0;
            color: var(--text-soft);
            font-size: 12px;
            line-height: 1.7;
        }

        .back-btn {
            min-height: 43px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 8px 15px;
            color: var(--text-soft);
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 10px;
            text-decoration: none;
            font-size: 12px;
            font-weight: 800;
            white-space: nowrap;
            transition: all .2s ease;
        }

        .back-btn i {
            color: var(--gold);
        }

        .back-btn:hover {
            color: var(--text);
            background: var(--surface-hover);
            border-color: var(--border-soft);
            transform: translateX(3px);
        }

        .edit-card {
            overflow: hidden;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 17px;
            box-shadow: var(--shadow-sm);
        }

        .edit-card-header {
            display: flex;
            align-items: center;
            gap: 9px;
            min-height: 62px;
            padding: 0 20px;
            background: var(--surface-2);
            border-bottom: 1px solid var(--border);
            color: var(--text);
            font-size: 14px;
            font-weight: 800;
        }

        .edit-card-header i {
            color: var(--gold);
        }

        .edit-card-body {
            padding: 22px;
        }

        .field-group {
            margin-bottom: 16px;
        }

        .field-label {
            display: flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 7px;
            color: var(--text);
            font-size: 12px;
            font-weight: 700;
        }

        .field-label i {
            color: var(--gold);
            font-size: 10px;
        }

        .field-input {
            width: 100%;
            min-height: 44px;
            padding: 9px 12px;
            color: var(--text) !important;
            background: var(--surface-2) !important;
            border: 1px solid var(--border) !important;
            border-radius: 9px;
            outline: none;
            box-sizing: border-box;
            font-family: "Cairo", "Tajawal", Arial, sans-serif;
            font-size: 13px;
            transition: all .2s ease;
        }

        .field-input::placeholder {
            color: var(--text-soft);
        }

        .field-input:focus {
            background: var(--surface) !important;
            border-color: color-mix(in srgb, var(--gold) 55%, var(--border)) !important;
            box-shadow: 0 0 0 3px color-mix(in srgb, var(--gold) 9%, transparent);
        }

        textarea.field-input {
            min-height: 130px;
            resize: vertical;
            line-height: 1.8;
        }

        select.field-input {
            cursor: pointer;
        }

        .field-row {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 11px;
        }

        .current-image {
            margin-top: 9px;
            padding: 11px;
            background: var(--surface-2);
            border: 1px solid var(--border);
            border-radius: 10px;
        }

        .current-image-title {
            display: block;
            margin-bottom: 9px;
            color: var(--text-soft);
            font-size: 11px;
            font-weight: 700;
        }

        .current-image img {
            width: 150px;
            height: 105px;
            display: block;
            object-fit: cover;
            border-radius: 9px;
            border: 1px solid var(--border);
        }

        .no-image {
            color: var(--muted);
            font-size: 11px;
        }

        .form-actions {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin-top: 22px;
            padding-top: 18px;
            border-top: 1px solid var(--border);
        }

        .btn-save,
        .btn-cancel {
            min-height: 46px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            border-radius: 10px;
            font-family: "Cairo", "Tajawal", Arial, sans-serif;
            font-size: 13px;
            font-weight: 800;
            text-decoration: none;
            cursor: pointer;
            transition: all .2s ease;
        }

        .btn-save {
            color: #171717;
            background: linear-gradient(135deg, var(--gold-light), var(--gold-dark));
            border: 1px solid color-mix(in srgb, var(--gold) 45%, var(--border));
            box-shadow: 0 7px 18px rgba(184, 146, 62, .14);
        }

        .btn-save:hover {
            transform: translateY(-2px);
            box-shadow: 0 11px 25px rgba(184, 146, 62, .22);
        }

        .btn-cancel {
            color: var(--text-soft);
            background: var(--surface-2);
            border: 1px solid var(--border);
        }

        .btn-cancel:hover {
            color: var(--text);
            background: var(--surface-hover);
            border-color: var(--border-soft);
        }

        /* أخطاء التحقق تحت الحقول */
        .field-error {
            display: flex;
            align-items: flex-start;
            gap: 5px;
            margin-top: 6px;
            color: var(--danger, #e87575);
            font-size: 11px;
            font-weight: 700;
            line-height: 1.7;
        }

        .field-error i {
            margin-top: 4px;
            font-size: 10px;
            flex-shrink: 0;
        }

        .field-input.field-invalid {
            border-color: var(--danger, #e87575) !important;
            box-shadow: 0 0 0 3px rgba(232, 117, 117, .07);
        }

        .current-image.field-invalid {
            border-color: var(--danger, #e87575);
        }

        @media (max-width: 700px) {
            .diet-edit-container {
                padding: 15px;
            }

            .diet-edit-top {
                align-items: flex-start;
                flex-direction: column;
            }

            .back-btn {
                width: 100%;
            }

            .diet-edit-title h2 {
                font-size: 20px;
            }

            .edit-card-body {
                padding: 16px;
            }

            .field-row {
                grid-template-columns: 1fr;
                gap: 0;
            }
        }

        @media (max-width: 480px) {
            .diet-edit-title h2 {
                font-size: 18px;
            }

            .edit-card-header {
                min-height: 55px;
                padding: 0 15px;
            }

            .edit-card-body {
                padding: 13px;
            }

            .form-actions {
                grid-template-columns: 1fr;
            }

            .current-image img {
                width: 120px;
                height: 90px;
            }
        }
    </style>
@endsection

@section('content')

    <div class="dashboard-wrapper diet-edit-container">

        <div class="diet-edit-top">

            <div class="diet-edit-title">

                <h2>
                    <i class="fas fa-edit"></i>
                    تعديل الوجبة
                </h2>

                <p>
                    تعديل بيانات الوجبة الغذائية الموجودة في بنك الوجبات
                </p>

            </div>

            <a href="{{ route('employee.diet.bank') }}" class="back-btn">

                <i class="fas fa-arrow-right"></i>

                العودة لبنك الوجبات

            </a>

        </div>

        <div class="edit-card">

            <div class="edit-card-header">

                <i class="fas fa-apple-alt"></i>

                بيانات الوجبة الغذائية

            </div>

            <div class="edit-card-body">

                <form action="{{ route('employee.diet.bank.update', $dietPlan->id) }}" method="POST"
                    enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    {{-- اسم الوجبة --}}
                    <div class="field-group">

                        <label class="field-label">
                            <i class="fas fa-utensils"></i>
                            اسم الوجبة
                        </label>

                        <input type="text" name="meal_name"
                            class="field-input @error('meal_name') field-invalid @enderror"
                            value="{{ old('meal_name', $dietPlan->meal_name) }}" placeholder="مثال: صدر دجاج مع أرز">

                        @error('meal_name')
                            <div class="field-error">
                                <i class="fas fa-exclamation-circle"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror

                    </div>

                    {{-- المستوى --}}
                    <div class="field-group">

                        <label class="field-label">
                            <i class="fas fa-layer-group"></i>
                            المستوى المستهدف للوجبة
                        </label>

                        <select name="level" class="field-input @error('level') field-invalid @enderror">

                            <option value="">
                                -- اختر المستوى --
                            </option>

                            <option value="beginner" {{ old('level', $dietPlan->level) == 'beginner' ? 'selected' : '' }}>
                                Beginner (مبتدئ)
                            </option>

                            <option value="intermediate"
                                {{ old('level', $dietPlan->level) == 'intermediate' ? 'selected' : '' }}>
                                Intermediate (متوسط)
                            </option>

                            <option value="advanced" {{ old('level', $dietPlan->level) == 'advanced' ? 'selected' : '' }}>
                                Advanced (متقدم)
                            </option>

                        </select>

                        @error('level')
                            <div class="field-error">
                                <i class="fas fa-exclamation-circle"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror

                    </div>

                    {{-- السعرات --}}
                    <div class="field-group">

                        <label class="field-label">
                            <i class="fas fa-fire"></i>
                            عدد السعرات الحرارية
                        </label>

                        <input type="number" name="calories" class="field-input @error('calories') field-invalid @enderror"
                            value="{{ old('calories', $dietPlan->calories) }}" placeholder="مثال: 520">

                        @error('calories')
                            <div class="field-error">
                                <i class="fas fa-exclamation-circle"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror

                    </div>

                    {{-- الماكروز --}}
                    <div class="field-row">

                        {{-- بروتين --}}
                        <div class="field-group">

                            <label class="field-label">
                                <i class="fas fa-drumstick-bite"></i>
                                بروتين (غ)
                            </label>

                            <input type="number" step="0.1" min="0" name="protein"
                                class="field-input @error('protein') field-invalid @enderror"
                                value="{{ old('protein', $dietPlan->protein) }}" placeholder="مثال: 35">

                            @error('protein')
                                <div class="field-error">
                                    <i class="fas fa-exclamation-circle"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror

                        </div>

                        {{-- كربوهيدرات --}}
                        <div class="field-group">

                            <label class="field-label">
                                <i class="fas fa-bread-slice"></i>
                                كربوهيدرات (غ)
                            </label>

                            <input type="number" step="0.1" min="0" name="carbs"
                                class="field-input @error('carbs') field-invalid @enderror"
                                value="{{ old('carbs', $dietPlan->carbs) }}" placeholder="مثال: 40">

                            @error('carbs')
                                <div class="field-error">
                                    <i class="fas fa-exclamation-circle"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror

                        </div>

                        {{-- دهون --}}
                        <div class="field-group">

                            <label class="field-label">
                                <i class="fas fa-oil-can"></i>
                                دهون (غ)
                            </label>

                            <input type="number" step="0.1" min="0" name="fats"
                                class="field-input @error('fats') field-invalid @enderror"
                                value="{{ old('fats', $dietPlan->fats) }}" placeholder="مثال: 12">

                            @error('fats')
                                <div class="field-error">
                                    <i class="fas fa-exclamation-circle"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror

                        </div>

                    </div>

                    {{-- الصورة --}}
                    <div class="field-group">

                        <label class="field-label">
                            <i class="fas fa-image"></i>
                            تغيير صورة الوجبة
                        </label>

                        <input type="file" name="image" class="field-input @error('image') field-invalid @enderror"
                            accept="image/*">

                        @error('image')
                            <div class="field-error">
                                <i class="fas fa-exclamation-circle"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror

                        @if (!empty($dietPlan->image_path))
                            <div class="current-image">

                                <span class="current-image-title">
                                    الصورة الحالية:
                                </span>

                                <img src="{{ asset('storage/' . $dietPlan->image_path) }}"
                                    alt="{{ $dietPlan->meal_name }}">

                            </div>
                        @else
                            <div class="current-image">

                                <span class="no-image">
                                    لا توجد صورة حالية لهذه الوجبة.
                                </span>

                            </div>
                        @endif

                    </div>

                    {{-- التفاصيل --}}
                    <div class="field-group">

                        <label class="field-label">
                            <i class="fas fa-align-right"></i>
                            المكونات والتفاصيل
                        </label>

                        <textarea name="plan_details" class="field-input @error('plan_details') field-invalid @enderror" rows="5"
                            placeholder="اكتب المكونات بالتفصيل هنا...">{{ old('plan_details', $dietPlan->plan_details) }}</textarea>

                        @error('plan_details')
                            <div class="field-error">
                                <i class="fas fa-exclamation-circle"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror

                    </div>

                    <div class="form-actions">

                        <button type="submit" class="btn-save">

                            <i class="fas fa-save"></i>

                            حفظ التعديلات

                        </button>

                        <a href="{{ route('employee.diet.bank') }}" class="btn-cancel">

                            <i class="fas fa-times"></i>

                            إلغاء

                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>
@endsection
