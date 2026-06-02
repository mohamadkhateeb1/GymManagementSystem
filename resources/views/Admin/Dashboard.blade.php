<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>Club Elite | لوحة تحكم المدير</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700&family=Cormorant+Garamond:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --bg: #0a0d14;
            --bg-elevated: #0f131c;
            --card: #121722;
            --card-hover: #171d2b;
            --border: rgba(201, 169, 97, 0.12);
            --border-strong: rgba(201, 169, 97, 0.25);
            --gold: #c9a961;
            --gold-light: #e5c77a;
            --text: #e8e6e1;
            --text-dim: #8a8f9c;
            --text-muted: #555a66;
            --success: #5a9c7a;
            --danger: #c55a5a;
            --warning: #c9a050;
            --info: #6b8bb5;
        }

        body {
            background: var(--bg);
            color: var(--text);
            font-family: 'Tajawal', sans-serif;
            min-height: 100vh;
            overflow-x: hidden;
        }

        .sidebar {
            position: fixed;
            top: 0;
            right: 0;
            width: 270px;
            height: 100vh;
            background: var(--bg-elevated);
            border-left: 1px solid var(--border);
            padding: 30px 22px;
            display: flex;
            flex-direction: column;
            z-index: 100;
        }

        .brand-logo {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 24px;
            padding-bottom: 28px;
            border-bottom: 1px solid var(--border);
        }

        .brand-mark {
            width: 44px;
            height: 44px;
            border: 1px solid var(--gold);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .brand-text h2 {
            font-family: 'Cormorant Garamond', serif;
            font-size: 22px;
            color: var(--gold-light);
        }

        .brand-text span {
            font-size: 10px;
            color: var(--text-muted);
            text-transform: uppercase;
        }

        .nav-section {
            margin-bottom: 22px;
        }

        .nav-label {
            font-size: 10px;
            color: var(--text-muted);
            padding: 0 12px;
            margin-bottom: 10px;
            font-weight: 500;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 11px 14px;
            border-radius: 6px;
            color: var(--text-dim);
            text-decoration: none;
            font-size: 13.5px;
            margin-bottom: 2px;
            transition: 0.3s;
        }

        .nav-item:hover,
        .nav-item.active {
            color: var(--gold-light);
            background: rgba(201, 169, 97, 0.08);
        }

        .sidebar-logout {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 11px 14px;
            width: 100%;
            background: transparent;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            color: rgba(197, 90, 90, 0.8);
            font-family: inherit;
            font-size: 13.5px;
            transition: 0.3s;
        }

        .sidebar-logout:hover {
            background: rgba(197, 90, 90, 0.1);
            color: var(--danger);
        }

        .main {
            margin-right: 270px;
        }

        .topbar {
            padding: 22px 40px;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 30px;
            border-bottom: 1px solid var(--border);
            background: rgba(15, 19, 28, 0.6);
        }

        .content {
            padding: 35px 40px;
        }

        .kpi-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
            margin-bottom: 30px;
        }

        .kpi-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 24px;
            transition: 0.3s;
        }

        .kpi-card:hover {
            transform: translateY(-3px);
            border-color: var(--gold-dim);
        }

        .kpi-head {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .kpi-icon {
            color: var(--gold);
            font-size: 20px;
        }

        .kpi-value {
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 6px;
        }

        .kpi-label {
            font-size: 12px;
            color: var(--text-dim);
        }

        .panel {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 8px;
            margin-bottom: 24px;
        }

        .panel-head {
            padding: 20px 24px;
            border-bottom: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .panel-head h3 {
            font-size: 16px;
            font-weight: 500;
        }

        .panel-body {
            padding: 0;
        }

        .members-table {
            width: 100%;
            border-collapse: collapse;
            text-align: right;
        }

        .members-table th {
            font-size: 11px;
            color: var(--text-muted);
            padding: 16px 24px;
            border-bottom: 1px solid var(--border);
            background: rgba(255, 255, 255, 0.02);
            font-weight: 500;
        }

        .members-table td {
            padding: 16px 24px;
            font-size: 13.5px;
            border-bottom: 1px solid var(--border);
            color: var(--text);
        }

        .members-table tr:hover td {
            background: rgba(201, 169, 97, 0.02);
        }

        .members-table tr:last-child td {
            border-bottom: none;
        }

        .status-chip {
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 11.5px;
            display: inline-block;
        }

        .status-chip.active {
            background: rgba(90, 156, 122, 0.1);
            color: var(--success);
        }

        .status-chip.expired {
            background: rgba(197, 90, 90, 0.1);
            color: var(--danger);
        }

        .status-chip.warning {
            background: rgba(201, 160, 80, 0.1);
            color: var(--warning);
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--gold), var(--gold-light));
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--bg);
            font-weight: bold;
            font-size: 14px;
        }

        .action-btn {
            background: transparent;
            border: 1px solid var(--gold);
            color: var(--gold);
            padding: 6px 14px;
            border-radius: 4px;
            cursor: pointer;
            font-family: inherit;
            font-size: 12px;
            transition: 0.3s;
        }

        .action-btn:hover {
            background: var(--gold);
            color: var(--bg);
        }
    </style>
</head>

<body>

    @include('Admin.sections.sidebar')

    <main class="main">

        @include('Admin.sections.navbar')

        <div class="content">
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
                                    <td>{{ $player->subscription->plan_name }}</td>
                                    <td>{{ $player->subscription->ends_at->format('Y-m-d') }}</td>
                                    <td>
                                        @if ($player->subscription->isExpired())
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
                                    <td colspan="5"
                                        style="text-align: center; color: var(--text-muted); padding: 40px;">
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
                            @forelse($employees  as $trainer)
                                <tr>
                                    <td>
                                        <div style="display: flex; align-items: center; gap: 12px;">
                                            <div class="user-avatar"
                                                style="width: 32px; height: 32px; font-size: 12px; background: rgba(201, 169, 97, 0.15); color: var(--gold); border: 1px solid var(--border-strong);">
                                                {{ substr($trainer->name, 0, 1) }}
                                            </div>
                                            <span style="font-weight: 500;">{{ $trainer->name }}</span>
                                        </div>
                                    </td>
                                    <td style="color: var(--text-dim);">{{ $trainer->specialization ?? 'لياقة بدنية' }}
                                    </td>
                                    <td>{{ $trainer->active_trainees_count ?? 0 }} متدرب</td>
                                    <td>
                                        <i class="fas fa-star"
                                            style="color: var(--gold); font-size: 11px; margin-left: 3px;"></i>
                                        <span style="font-weight: 500;">{{ $trainer->rating ?? '4.8' }}</span>
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
                                            style="border-color: var(--border-strong); color: var(--text-dim);">الملف
                                            الشخصي</button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6"
                                        style="text-align: center; color: var(--text-muted); padding: 40px;">
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
    </main>
</body>

</html>
