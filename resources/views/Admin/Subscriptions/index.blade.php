@extends('Admin.layouts.app')

@section('title', 'إدارة الاشتراكات | Elite Club')

@section('content')
    <div class="dashboard-wrapper">
        <div class="panel">
            <div class="panel-head">
                <h3>سجل اشتراكات اللاعبين</h3>
            </div>

            <table class="members-table">
                <thead>
                    <tr>
                        <th>اللاعب</th>
                        <th>نوع الخطة</th>
                        <th>تاريخ البدء</th>
                        <th>تاريخ الانتهاء</th>
                        <th>الحالة</th>
                        <th>إجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($memberships as $membership)
                        <tr>
                            <td>{{ $membership->player->name ?? 'غير معروف' }}</td>
                            <td>{{ $membership->plan_name }}</td>
                            <td dir="ltr">{{ $membership->start_date }}</td>
                            <td dir="ltr">{{ $membership->end_date }}</td>
                            <td>
                                <span class="status-chip {{ $membership->isExpired() ? 'expired' : 'active' }}">
                                    {{ $membership->isExpired() ? 'منتهي' : 'فعال' }}
                                </span>
                            </td>
                            <td>
                                <form action="{{ route('subscriptions.renew', $membership->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="action-btn">تجديد</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 40px; color: #8a8f9c;">
                                لا توجد اشتراكات مسجلة حالياً
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div style="padding: 20px;">
                {{ $memberships->links() }}
            </div>
        </div>
    </div>
@endsection
