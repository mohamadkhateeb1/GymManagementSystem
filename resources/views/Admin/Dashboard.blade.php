@extends('Admin.layouts.app')

@section('title', 'لوحة تحكم المدير | Elite Club')

@section('styles')
    <link
        href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700&family=Cormorant+Garamond:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
        .dashboard-wrapper {
            font-family: 'Tajawal', sans-serif;
        }

        /* الإحصائيات (KPIs) */
        .kpi-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 18px;
            margin-bottom: 30px;
        }

        .kpi-card {
            background: #121722;
            border: 1px solid rgba(201, 169, 97, 0.12);
            border-radius: 12px;
            padding: 24px;
            transition: all 0.3s ease;
        }

        .kpi-card:hover {
            transform: translateY(-3px);
            border-color: #c9a961;
            box-shadow: 0 8px 24px rgba(201, 169, 97, 0.08);
        }

        .kpi-head {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .kpi-icon {
            color: #c9a961;
            font-size: 20px;
            background: rgba(201, 169, 97, 0.08);
            width: 44px;
            height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
        }

        .kpi-value {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 6px;
            color: #e8e6e1;
        }

        .kpi-label {
            font-size: 13px;
            color: #8a8f9c;
            font-weight: 500;
        }

        /* الألواح (Panels) */
        .panel {
            background: #121722;
            border: 1px solid rgba(201, 169, 97, 0.12);
            border-radius: 12px;
            margin-bottom: 24px;
            overflow: hidden;
        }

        .panel-head {
            padding: 20px 24px;
            border-bottom: 1px solid rgba(201, 169, 97, 0.12);
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: rgba(255, 255, 255, 0.02);
        }

        .panel-head h3 {
            font-size: 18px;
            font-weight: 700;
            color: #e8e6e1;
            margin: 0;
        }

        /* الجداول (Tables) */
        .members-table {
            width: 100%;
            border-collapse: collapse;
            text-align: right;
        }

        .members-table th {
            font-size: 12px;
            color: #8a8f9c;
            padding: 16px 24px;
            border-bottom: 1px solid rgba(201, 169, 97, 0.12);
            background: rgba(255, 255, 255, 0.01);
            font-weight: 600;
        }

        .members-table td {
            padding: 16px 24px;
            font-size: 14px;
            border-bottom: 1px solid rgba(201, 169, 97, 0.06);
            color: #e8e6e1;
            vertical-align: middle;
        }

        .members-table tr:hover td {
            background: rgba(201, 169, 97, 0.03);
        }

        .members-table tr:last-child td {
            border-bottom: none;
        }

        /* الحالات (Status Chips) */
        .status-chip {
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
        }

        .status-chip.active {
            background: rgba(90, 156, 122, 0.15);
            color: #5a9c7a;
            border: 1px solid rgba(90, 156, 122, 0.3);
        }

        .status-chip.expired {
            background: rgba(197, 90, 90, 0.15);
            color: #c55a5a;
            border: 1px solid rgba(197, 90, 90, 0.3);
        }

        .status-chip.warning {
            background: rgba(201, 160, 80, 0.15);
            color: #c9a050;
            border: 1px solid rgba(201, 160, 80, 0.3);
        }

        /* الأزرار وصور المستخدمين */
        .user-profile {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, #c9a961, #e5c77a);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #0a0d14;
            font-weight: bold;
            font-size: 14px;
        }

        .action-btn {
            background: transparent;
            border: 1px solid #c9a961;
            color: #c9a961;
            padding: 6px 14px;
            border-radius: 6px;
            cursor: pointer;
            font-family: inherit;
            font-size: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .action-btn:hover {
            background: #c9a961;
            color: #0a0d14;
            transform: translateY(-1px);
        }
    </style>
@endsection

@section('content')
    <div class="dashboard-wrapper">

        <!-- قسم الإحصائيات العلوية -->
        <div class="kpi-grid">
            <div class="kpi-card">
                <div class="kpi-head">
                    <div class="kpi-icon"><i class="fas fa-user-tie"></i></div>
                </div>
                <div class="kpi-value">{{ $employeesCount ?? 0 }}</div>
                <div class="kpi-label">إجمالي الموظفين</div>
            </div>

            <div class="kpi-card">
                <div class="kpi-head">
                    <div class="kpi-icon"><i class="fas fa-users"></i></div>
                </div>
                <div class="kpi-value">{{ $playersCount ?? 0 }}</div>
                <div class="kpi-label">اللاعبين النشطين</div>
            </div>

            <div class="kpi-card">
                <div class="kpi-head">
                    <div class="kpi-icon"><i class="fas fa-wallet"></i></div>
                </div>
                <div class="kpi-value">{{ number_format($monthlyRevenue ?? 0) }} <small>ر.س</small></div>
                <div class="kpi-label">متابعة الدخل الشهري</div>
            </div>

            <div class="kpi-card">
                <div class="kpi-head">
                    <div class="kpi-icon"><i class="fas fa-exclamation-triangle"></i></div>
                </div>
                <div class="kpi-value">{{ $expiredSubscriptionsCount ?? 0 }}</div>
                <div class="kpi-label">اشتراكات منتهية تحتاج تجديد</div>
            </div>
        </div>

        <!-- جدول أحدث اللاعبين -->
        <div class="panel">
            <div class="panel-head">
                <h3>أحدث اللاعبين والاشتراكات</h3>
            </div>
            <div class="panel-body">
                <table class="members-table">
                    <thead>
                        <tr>
                            <th>اسم اللاعب</th>
                            <th>نوع الاشتراك</th>
                            <th>تاريخ الانتهاء</th>
                            <th>الحالة</th>
                            <th>إجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentPlayers ?? [] as $player)
                            <tr>
                                <td style="font-weight: 500;">{{ $player->name }}</td>
                                <td>{{ $player->subscription->plan_name ?? 'غير محدد' }}</td>
                                <td>{{ optional($player->subscription->ends_at)->format('Y-m-d') ?? 'غير محدد' }}</td>
                                <td>
                                    @if ($player->subscription && $player->subscription->isExpired())
                                        <span class="status-chip expired">منتهي</span>
                                    @else
                                        <span class="status-chip active">فعال</span>
                                    @endif
                                </td>
                                <td>
                                    <button class="action-btn">تجديد</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" style="text-align: center; color: #8a8f9c; padding: 40px;">
                                    <i class="fas fa-folder-open"
                                        style="font-size: 24px; margin-bottom: 10px; display: block; opacity: 0.5;"></i>
                                    لا يوجد لاعبين حاليا
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- جدول طاقم المدربين -->
        <div class="panel">
            <div class="panel-head">
                <h3>طاقم المدربين</h3>
            </div>
            <div class="panel-body">
                <table class="members-table">
                    <thead>
                        <tr>
                            <th>المدرب</th>
                            <th>التخصص</th>
                            <th>المتدربين النشطين</th>
                            <th>التقييم</th>
                            <th>الحالة</th>
                            <th>إجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($employees ?? [] as $trainer)
                            <tr>
                                <td>
                                    <div class="user-profile">
                                        <div class="user-avatar"
                                            style="width: 32px; height: 32px; font-size: 12px; background: rgba(201, 169, 97, 0.15); color: #c9a961; border: 1px solid rgba(201, 169, 97, 0.25);">
                                            {{ mb_substr($trainer->name, 0, 1) }}
                                        </div>
                                        <span style="font-weight: 500;">{{ $trainer->name }}</span>
                                    </div>
                                </td>
                                <td style="color: #8a8f9c;">{{ $trainer->specialization ?? 'لياقة بدنية' }}</td>
                                <td>{{ $trainer->active_trainees_count ?? 0 }} متدرب</td>
                                <td>
                                    <span style="font-weight: 500;">{{ $trainer->rating ?? '4.8' }}</span>
                                    <i class="fas fa-star" style="color: #c9a961; font-size: 11px; margin-right: 3px;"></i>
                                </td>
                                <td>
                                    @if (($trainer->status ?? 'active') == 'active')
                                        <span class="status-chip active">متاح</span>
                                    @else
                                        <span class="status-chip warning">إجازة</span>
                                    @endif
                                </td>
                                <td>
                                    <button class="action-btn"
                                        style="border-color: rgba(201, 169, 97, 0.25); color: #8a8f9c;">الملف
                                        الشخصي</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" style="text-align: center; color: #8a8f9c; padding: 40px;">
                                    <i class="fas fa-user-tie"
                                        style="font-size: 24px; margin-bottom: 10px; display: block; opacity: 0.5;"></i>
                                    لا يوجد مدربين حاليا
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
