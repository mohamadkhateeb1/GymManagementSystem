@extends('Employee.layouts.app')

@section('title', 'تعديل التمرين | Elite Club')

@section('styles')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;800&display=swap" rel="stylesheet">

    <style>
        .edit-container {
            font-family: 'Tajawal', 'Cairo', sans-serif;
            padding: 22px;
            color: var(--text);
            direction: rtl;
            max-width: 900px;
            margin: 0 auto;
        }

        .edit-page-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 24px;
            padding-bottom: 20px;
            border-bottom: 1px solid var(--border);
        }

        .edit-title-area {
            min-width: 0;
        }

        .edit-title-row {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 8px;
        }

        .edit-title-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            color: var(--gold);
            background: linear-gradient(135deg,
                    rgba(201, 169, 97, 0.18),
                    rgba(201, 169, 97, 0.05));
            border: 1px solid var(--border-soft);
            box-shadow: 0 0 22px rgba(201, 169, 97, 0.06);
            font-size: 18px;
        }

        .edit-title {
            margin: 0;
            color: var(--text);
            font-size: 22px;
            font-weight: 800;
            line-height: 1.4;
        }

        .edit-title span {
            color: var(--gold);
        }

        .edit-subtitle {
            margin: 0;
            color: var(--muted);
            font-size: 13px;
            padding-right: 56px;
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: 42px;
            padding: 0 15px;
            color: var(--text-soft);
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 10px;
            font-family: 'Tajawal', 'Cairo', sans-serif;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
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
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
        }

        .edit-card-header {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 17px 20px;
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

        .form-row {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
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
            min-height: 43px;
            padding: 9px 11px;
            box-sizing: border-box;
            background: var(--surface-2);
            border: 1px solid var(--border);
            border-radius: 9px;
            color: var(--text);
            font-family: 'Tajawal', 'Cairo', sans-serif;
            font-size: 12px;
            outline: none;
            transition: all .2s ease;
        }

        .field-input::placeholder {
            color: var(--muted);
        }

        .field-input:focus {
            background: var(--surface-3);
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(201, 169, 97, .07);
        }

        textarea.field-input {
            min-height: 120px;
            resize: vertical;
            line-height: 1.8;
        }

        select.field-input {
            cursor: pointer;
        }

        input[type="file"].field-input {
            padding: 8px;
            cursor: pointer;
        }

        input[type="file"]::file-selector-button {
            margin-left: 8px;
            padding: 6px 10px;
            border: 0;
            border-radius: 6px;
            background: rgba(201, 169, 97, .10);
            color: var(--gold);
            font-family: 'Tajawal', 'Cairo', sans-serif;
            font-size: 11px;
            font-weight: 700;
            cursor: pointer;
        }

        .current-image {
            margin-top: 12px;
            padding: 10px 12px;
            border-radius: 9px;
            background: rgba(201, 169, 97, .06);
            border: 1px solid rgba(201, 169, 97, .14);
            color: var(--muted);
            font-size: 11px;
            line-height: 1.7;
        }

        .current-image strong {
            color: var(--gold-light);
        }

        .current-image img {
            display: block;
            width: 130px;
            height: 90px;
            object-fit: cover;
            border-radius: 8px;
            margin-top: 9px;
            border: 1px solid var(--border);
        }

        .form-actions {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin-top: 8px;
            padding-top: 18px;
            border-top: 1px solid var(--border);
        }

        .btn-save,
        .btn-cancel {
            min-height: 44px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            border-radius: 9px;
            font-family: 'Tajawal', 'Cairo', sans-serif;
            font-size: 12px;
            font-weight: 800;
            text-decoration: none;
            cursor: pointer;
            transition: all .2s ease;
        }

        .btn-save {
            border: 1px solid rgba(201, 169, 97, .4);
            color: #171a20;
            background: linear-gradient(135deg,
                    var(--gold-light),
                    var(--gold));
        }

        .btn-save:hover {
            transform: translateY(-2px);
            box-shadow: 0 7px 20px rgba(201, 169, 97, .15);
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

        .ex-alert {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 14px 16px;
            margin-bottom: 18px;
            border-radius: 12px;
            font-size: 13px;
            line-height: 1.7;
        }

        .ex-alert-icon {
            width: 32px;
            height: 32px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .ex-alert-danger {
            background: rgba(232, 93, 93, .10);
            border: 1px solid rgba(232, 93, 93, .22);
            color: var(--text);
        }

        .ex-alert-danger .ex-alert-icon {
            color: var(--danger);
            background: rgba(232, 93, 93, .12);
        }

        .ex-alert ul {
            margin: 0;
            padding-right: 18px;
        }

        @media (max-width: 700px) {
            .edit-container {
                padding: 15px;
            }

            .edit-page-top {
                align-items: flex-start;
                flex-direction: column;
            }

            .back-btn {
                width: 100%;
            }

            .edit-title {
                font-size: 19px;
            }

            .edit-subtitle {
                padding-right: 0;
            }

            .form-row {
                grid-template-columns: 1fr;
                gap: 0;
            }
        }

        @media (max-width: 480px) {
            .edit-title-row {
                align-items: flex-start;
            }

            .edit-title-icon {
                width: 40px;
                height: 40px;
            }

            .edit-card-body {
                padding: 16px;
            }

            .form-actions {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endsection

@section('content')

    <div class="dashboard-wrapper edit-container">

        @if ($errors->any())
            <div class="ex-alert ex-alert-danger">
                <div class="ex-alert-icon">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>

                <div>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <div class="edit-page-top">

            <div class="edit-title-area">

                <div class="edit-title-row">

                    <div class="edit-title-icon">
                        <i class="fas fa-edit"></i>
                    </div>

                    <h2 class="edit-title">
                        تعديل التمرين:
                        <span>{{ $exercise->name }}</span>
                    </h2>

                </div>

                <p class="edit-subtitle">
                    تعديل بيانات وإعدادات التمرين
                </p>

            </div>

            <a href="{{ route('employee.training.exercises.index', $exercise->training_plan_id) }}"
                class="back-btn">

                <i class="fas fa-arrow-right"></i>

                العودة للتمارين

            </a>

        </div>

        <div class="edit-card">

            <div class="edit-card-header">

                <i class="fas fa-dumbbell"></i>

                بيانات التمرين

            </div>

            <div class="edit-card-body">

                <form action="{{ route('employee.training.exercises.update', $exercise->id) }}" method="POST"
                    enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    <div class="field-group">

                        <label class="field-label">
                            <i class="fas fa-dumbbell"></i>
                            اسم التمرين
                        </label>

                        <input type="text"
                            name="name"
                            class="field-input"
                            value="{{ old('name', $exercise->name) }}"
                            required>

                    </div>

                    <div class="form-row">

                        <div class="field-group">

                            <label class="field-label">
                                <i class="fas fa-redo"></i>
                                عدد الجولات (Sets)
                            </label>

                            <input type="number"
                                name="sets"
                                min="1"
                                class="field-input"
                                value="{{ old('sets', $exercise->sets) }}"
                                required>

                        </div>

                        <div class="field-group">

                            <label class="field-label">
                                <i class="fas fa-sync-alt"></i>
                                عدد التكرارات (Reps)
                            </label>

                            <input type="number"
                                name="reps"
                                min="1"
                                class="field-input"
                                value="{{ old('reps', $exercise->reps) }}"
                                required>

                        </div>

                    </div>

                    <div class="form-row">

                        <div class="field-group">

                            <label class="field-label">
                                <i class="fas fa-hourglass-half"></i>
                                مدة الراحة بين الجولات
                            </label>

                            <input type="text"
                                name="rest_time"
                                class="field-input"
                                value="{{ old('rest_time', $exercise->rest_time) }}"
                                placeholder="مثال: 90 ثانية">

                        </div>

                        <div class="field-group">

                            <label class="field-label">
                                <i class="fas fa-sort-numeric-down"></i>
                                ترتيب التمرين داخل اليوم
                            </label>

                            <input type="number"
                                name="order"
                                min="0"
                                class="field-input"
                                value="{{ old('order', $exercise->order ?? 0) }}">

                        </div>

                    </div>

                    <div class="field-group">

                        <label class="field-label">
                            <i class="fas fa-calendar-day"></i>
                            يوم التمرين في الأسبوع
                        </label>

                        <select name="day_of_week" class="field-input">

                            <option value="">
                                -- غير محدد (تمرين حر) --
                            </option>

                            @foreach (\App\Models\Plan::DAYS as $num => $dayName)

                                <option value="{{ $num }}"
                                    {{ old('day_of_week', $exercise->day_of_week) == $num ? 'selected' : '' }}>

                                    {{ $dayName }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="field-group">

                        <label class="field-label">
                            <i class="fas fa-align-right"></i>
                            شرح طريقة أداء التمرين والملاحظات
                        </label>

                        <textarea name="instructions"
                            class="field-input"
                            rows="5"
                            placeholder="اكتب تعليمات التمرين والتركيز العضلي...">{{ old('instructions', $exercise->instructions) }}</textarea>

                    </div>

                    <div class="field-group">

                        <label class="field-label">
                            <i class="fas fa-image"></i>
                            تغيير صورة التمرين

                            <span style="color: var(--muted); font-size: 10px;">
                                (اختياري)
                            </span>
                        </label>

                        <input type="file"
                            name="image"
                            class="field-input"
                            accept="image/*">

                        @if ($exercise->image_path)

                            <div class="current-image">

                                <strong>
                                    الصورة الحالية:
                                </strong>

                                ارفع صورة جديدة فقط إذا أردت استبدال الصورة الحالية.

                                <img src="{{ asset('storage/' . $exercise->image_path) }}"
                                    alt="{{ $exercise->name }}">

                            </div>

                        @else

                            <div class="current-image">
                                لا توجد صورة حالية لهذا التمرين.
                            </div>

                        @endif

                    </div>

                    <div class="field-group">

                        <label class="field-label">
                            <i class="fas fa-video"></i>
                            رابط فيديو التمرين

                            <span style="color: var(--muted); font-size: 10px;">
                                (اختياري)
                            </span>
                        </label>

                        <input type="url"
                            name="video_url"
                            class="field-input"
                            value="{{ old('video_url', $exercise->video_url) }}"
                            placeholder="https://youtube.com/...">

                    </div>

                    <div class="form-actions">

                        <button type="submit" class="btn-save">

                            <i class="fas fa-save"></i>

                            حفظ تعديلات التمرين

                        </button>

                        <a href="{{ route('employee.training.exercises.index', $exercise->training_plan_id) }}"
                            class="btn-cancel">

                            <i class="fas fa-times"></i>

                            إلغاء

                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

@endsection