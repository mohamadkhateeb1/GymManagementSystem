@extends('Employee.layouts.app')

@section('content')
<div class="dashboard-wrapper">
    {{-- نموذج إضافة خطة جديدة --}}
    <div class="panel">
        <div class="panel-head"><h3>إضافة خطة تدريبية لـ: {{ $player->name }}</h3></div>
        <div style="padding: 20px;">
            <form action="{{ route('employee.training.store', $player->id) }}" method="POST">
                @csrf
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 15px;">
                    <div>
                        <label class="field-label">تاريخ البدء</label>
                        <input type="date" name="start_date" class="field-input" required>
                    </div>
                    <div>
                        <label class="field-label">تاريخ الانتهاء</label>
                        <input type="date" name="end_date" class="field-input" required>
                    </div>
                </div>
                <div style="margin-bottom: 15px;">
                    <label class="field-label">تفاصيل الخطة (التمارين والمجموعات)</label>
                    <textarea name="plan_details" class="field-input" rows="5" required></textarea>
                </div>
                <button type="submit" class="action-btn btn-solid">حفظ الخطة</button>
            </form>
        </div>
    </div>

    {{-- جدول الخطط التدريبية السابقة --}}
    <div class="panel">
        <div class="panel-head"><h3>السجل التدريبي السابق</h3></div>
        <table class="members-table">
            <thead>
                <tr>
                    <th>التفاصيل</th>
                    <th>من</th>
                    <th>إلى</th>
                </tr>
            </thead>
            <tbody>
                @forelse($plans as $plan)
                <tr>
                    <td>{{ $plan->plan_details }}</td>
                    <td>{{ $plan->start_date }}</td>
                    <td>{{ $plan->end_date }}</td>
                </tr>
                @empty
                <tr><td colspan="3" style="text-align:center;">لا توجد خطط سابقة لهذا اللاعب</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection