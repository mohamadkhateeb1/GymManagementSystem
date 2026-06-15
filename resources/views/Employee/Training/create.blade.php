@extends('Employee.layouts.app')

@section('title', 'إضافة خطة تدريبية | Elite Club')
@section('styles')
    <style>
        /* تنسيقات الحقول والأزرار */
        .field-group {
            margin-bottom: 20px;
        }

        .field-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #4a5568;
        }

        .field-input {
            width: 100%;
            padding: 10px;
            border: 1px solid #cbd5e0;
            border-radius: 6px;
            font-size: 14px;
        }

        .action-btn {
            background-color: #4a5568;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
        }

        .action-btn:hover {
            background-color: #2d3748;
        }
    </style>
@endsection
@section('content')
    <div class="dashboard-wrapper">
        <div class="panel" style="max-width: 800px; margin: auto;">
            <div class="panel-head">
                <h3><i class="fas fa-plus"></i> إضافة خطة تدريبية لـ: {{ $player->name }}</h3>
            </div>

            <form action="{{ route('employee.training.store', $player->id) }}" method="POST" style="padding: 25px;">
                @csrf

                <div class="field-group" style="margin-bottom: 20px;">
                    <label class="field-label" style="display: block; margin-bottom: 8px;">تفاصيل الخطة</label>
                    <textarea name="plan_details" class="field-input" rows="6" placeholder="أدخل التمارين والملاحظات هنا..." required></textarea>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 25px;">
                    <div>
                        <label class="field-label">تاريخ البدء</label>
                        <input type="date" name="start_date" class="field-input" required>
                    </div>
                    <div>
                        <label class="field-label">تاريخ الانتهاء</label>
                        <input type="date" name="end_date" class="field-input" required>
                    </div>
                </div>

                <button type="submit" class="action-btn btn-solid" style="width: 100%; padding: 12px;">حفظ الخطة
                    التدريبية</button>
            </form>
        </div>
    </div>
@endsection
