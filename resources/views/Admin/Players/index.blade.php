@extends('Admin.layouts.app')

@section('title', 'إدارة اللاعبين | Elite Club')

@section('styles')
<style>
/* ELITE CLUB — PLAYERS INDEX (نسخة مختصرة تعتمد متغيّرات الثيم الموحّدة) */

.header, .filter-bar, .card {
    background: var(--surface); border: 1px solid var(--border);
    border-radius: 16px; box-shadow: var(--shadow-sm);
}
.header, .filter-bar { padding: 18px 20px; margin-bottom: 18px; }
.header { display: flex; align-items: center; justify-content: space-between; gap: 20px; }
.header-left { display: flex; align-items: center; gap: 12px; }
.header-accent { width: 4px; height: 42px; border-radius: 10px; background: linear-gradient(to bottom, var(--gold-light), var(--gold-dark)); }
.header-title { margin-bottom: 5px; color: var(--text); font-size: 21px; font-weight: 850; }

.count-badge {
    display: inline-flex; align-items: center; gap: 6px; padding: 5px 10px;
    color: var(--gold-dark); background: var(--sidebar-active);
    border: 1px solid rgba(184,146,62,.20); border-radius: 20px; font-size: 12px; font-weight: 750;
}
html[data-theme="dark"] .count-badge { color: var(--gold-light); }

.btn-header {
    height: 42px; display: inline-flex; align-items: center; justify-content: center; gap: 7px;
    padding: 0 16px; border-radius: 9px; font-size: 13px; font-weight: 800;
    text-decoration: none; cursor: pointer; transition: all .2s ease; border: 1px solid transparent;
}
.btn-add { color: #fff; background: linear-gradient(135deg, var(--gold-light), var(--gold-dark)); box-shadow: 0 5px 13px rgba(181,128,31,.18); }
.btn-add:hover { transform: translateY(-1px); box-shadow: 0 8px 17px rgba(181,128,31,.25); }
.btn-danger { color: var(--danger); background: var(--danger-bg); border-color: rgba(196,93,93,.22); }
.btn-danger:hover { color: #fff; background: var(--danger); border-color: var(--danger); }

/* شريط الفلترة — Bootstrap row/col للاستجابة بلا Media Queries يدوية */
.field-label { display: block; margin-bottom: 7px; color: var(--text); font-size: 13px; font-weight: 700; }
.field-input {
    width: 100%; height: 43px; padding: 0 13px; border-radius: 9px; border: 1px solid var(--border);
    background: var(--surface-2); color: var(--text); font-family: inherit; font-size: 13px; font-weight: 600;
}
.field-input:focus { outline: none; border-color: var(--gold-dark); box-shadow: 0 0 0 3px rgba(181,128,31,.10); }
.btn-filter-apply, .btn-filter-reset {
    height: 43px; display: inline-flex; align-items: center; justify-content: center; gap: 6px;
    border-radius: 9px; font-size: 13px; font-weight: 700; cursor: pointer; text-decoration: none; width: 100%;
}
.btn-filter-apply { border: 1px solid var(--gold-dark); background: linear-gradient(135deg, var(--gold-light), var(--gold-dark)); color: #fff; }
.btn-filter-reset { border: 1px solid var(--border); background: var(--surface-2); color: var(--text-soft); }
.btn-filter-reset:hover { color: var(--gold-dark); background: var(--surface-hover); }

.card { padding: 8px; overflow-x: auto; }
.players-table { width: 100%; min-width: 700px; border-collapse: separate; border-spacing: 0; color: var(--text); font-size: 13px; }
.players-table thead th {
    height: 48px; padding: 0 15px; color: var(--text); background: var(--surface-2);
    border-bottom: 1px solid var(--border); font-size: 12px; font-weight: 800; text-align: right;
}
.players-table tbody td { height: 64px; padding: 9px 15px; border-bottom: 1px solid var(--border-soft); vertical-align: middle; font-weight: 600; }
.players-table tbody tr:last-child td { border-bottom: 0; }
.players-table tbody tr:hover { background: var(--surface-hover); }

.player-cell { display: flex; align-items: center; gap: 10px; font-weight: 800; color: var(--text); }
.avatar {
    width: 36px; height: 36px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;
    color: var(--gold-dark); background: linear-gradient(135deg, var(--gold-light), var(--gold));
    border: 1px solid var(--gold-dark); border-radius: 10px; font-size: 13px; font-weight: 900; opacity: .95;
}

.status-chip { display: inline-flex; align-items: center; justify-content: center; min-width: 76px; padding: 6px 11px; border-radius: 20px; font-size: 11px; font-weight: 800; color: #fff; }
.status-chip.active { background: var(--success); }
.status-chip.expired { background: var(--danger); }
.status-chip.none { background: var(--muted); }

.action-group { display: flex; gap: 6px; flex-wrap: wrap; }
.action-group form { margin: 0; }
.btn-action { min-width: 58px; height: 31px; display: inline-flex; align-items: center; justify-content: center; padding: 0 10px; border-radius: 7px; font-size: 11px; font-weight: 800; text-decoration: none; border: 1px solid transparent; cursor: pointer; transition: .18s ease; }
.btn-show { color: var(--text-soft); background: var(--surface-3); }
.btn-show:hover { color: var(--text); background: var(--surface-hover); }
.btn-edit { color: var(--gold-dark); background: var(--sidebar-active); }
.btn-edit:hover { color: #fff; background: var(--gold-dark); }
.btn-freeze { color: var(--warning, var(--gold-dark)); background: rgba(184,146,62,.10); }
.btn-freeze:hover { color: #fff; background: var(--gold-dark); }
.btn-unfreeze { color: var(--success); background: var(--success-bg); }
.btn-unfreeze:hover { color: #fff; background: var(--success); }
.btn-delete { color: var(--danger); background: var(--danger-bg); }
.btn-delete:hover { color: #fff; background: var(--danger); }

.empty-row td { height: 160px !important; color: var(--text-soft) !important; text-align: center !important; font-weight: 700 !important; font-size: 14px; }
</style>
@endsection

@section('content')
<div class="header flex-wrap">
    <div class="header-left">
        <div class="header-accent"></div>
        <div>
            <div class="header-title">سجل اللاعبين</div>
            <span class="count-badge"><i class="fas fa-users"></i> {{ $players->count() }} لاعب</span>
        </div>
    </div>
    <div class="d-flex gap-2 flex-wrap">
        <form action="{{ route('players.destroyAll') }}" method="POST"
            onsubmit="return confirm('⚠️ سيتم حذف جميع اللاعبين نهائياً من النظام، بما في ذلك كل اشتراكاتهم وفواتيرهم وخططهم التدريبية والغذائية وسجلاتهم بالكامل. لا يمكن التراجع عن هذا الإجراء إطلاقاً. هل أنت متأكد فعلاً؟');">
            @csrf @method('DELETE')
            <button type="submit" class="btn-header btn-danger"><i class="fas fa-trash-alt"></i> حذف الكل</button>
        </form>
        <a href="{{ route('players.create') }}" class="btn-header btn-add"><i class="fas fa-plus"></i> إضافة لاعب</a>
    </div>
</div>

<div class="filter-bar">
    <form action="{{ route('players.index') }}" method="GET" class="row g-3 align-items-end">
        <div class="col-12 col-md-4">
            <label class="field-label">بحث بالاسم أو البريد</label>
            <input type="text" name="search" class="field-input" value="{{ request('search') }}" placeholder="ابحث عن لاعب...">
        </div>
        <div class="col-6 col-md-3">
            <label class="field-label">المدرب</label>
            <select name="coach_id" class="field-input">
                <option value="">كل المدربين</option>
                @foreach ($coaches as $coach)
                    <option value="{{ $coach->id }}" {{ request('coach_id') == $coach->id ? 'selected' : '' }}>{{ $coach->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-6 col-md-3">
            <label class="field-label">حالة الاشتراك</label>
            <select name="subscription_status" class="field-input">
                <option value="">كل الحالات</option>
                <option value="active" {{ request('subscription_status') == 'active' ? 'selected' : '' }}>فعّال</option>
                <option value="expired" {{ request('subscription_status') == 'expired' ? 'selected' : '' }}>منتهي/مجمد</option>
                <option value="none" {{ request('subscription_status') == 'none' ? 'selected' : '' }}>بلا اشتراك</option>
            </select>
        </div>
        <div class="col-12 col-md-2 d-flex gap-2">
            <button type="submit" class="btn-filter-apply"><i class="fas fa-filter"></i> تطبيق</button>
            <a href="{{ route('players.index') }}" class="btn-filter-reset">إلغاء</a>
        </div>
    </form>
</div>

<div class="card">
    <table class="players-table">
        <thead>
            <tr><th>الاسم</th><th>الخطة</th><th>الحالة</th><th>الإجراءات</th></tr>
        </thead>
        <tbody>
            @forelse($players as $player)
                <tr>
                    <td>
                        <div class="player-cell">
                            <div class="avatar">{{ mb_strtoupper(mb_substr($player->name, 0, 1)) }}</div>
                            <span>{{ $player->name }}</span>
                        </div>
                    </td>
                    <td>{{ $player->subscription->plan_name ?? 'غير مشترك' }}</td>
                    <td>
                        @if ($player->subscription)
                            <span class="status-chip {{ $player->hasActiveSubscription() ? 'active' : 'expired' }}">
                                {{ $player->hasActiveSubscription() ? 'فعال' : 'منتهي/مجمد' }}
                            </span>
                        @else
                            <span class="status-chip none">لا يوجد</span>
                        @endif
                    </td>
                    <td>
                        <div class="action-group">
                            <a href="{{ route('players.show', $player->id) }}" class="btn-action btn-show">عرض</a>
                            <a href="{{ route('players.edit', $player->id) }}" class="btn-action btn-edit">تعديل</a>
                            @if ($player->subscription)
                                <form action="{{ route('players.toggle-subscription', $player->id) }}" method="POST"
                                    onsubmit="return confirm('{{ $player->subscription->status === 'active' ? 'سيتم تجميد اشتراك هذا اللاعب: لن يستطيع مدربه إضافة أو توزيع أي خطط أو تقييمات له حتى تُعاد تفعيل اشتراكه. متابعة؟' : 'سيتم إعادة تفعيل اشتراك هذا اللاعب. متابعة؟' }}');">
                                    @csrf
                                    <button type="submit" class="btn-action {{ $player->subscription->status === 'active' ? 'btn-freeze' : 'btn-unfreeze' }}">
                                        {{ $player->subscription->status === 'active' ? 'إلغاء التفعيل' : 'تفعيل' }}
                                    </button>
                                </form>
                            @endif
                            <form action="{{ route('players.destroy', $player->id) }}" method="POST"
                                onsubmit="return confirm('⚠️ سيتم حذف هذا اللاعب نهائياً من النظام بالكامل، بما في ذلك جميع اشتراكاته وفواتيره وخططه التدريبية والغذائية وسجلاته. لا يمكن التراجع عن هذا الإجراء إطلاقاً.\n\nإذا كنت تريد فقط إيقاف اشتراكه مؤقتاً، استخدم زر «إلغاء التفعيل» بجانب اسمه بدلاً من الحذف.\n\nهل أنت متأكد من الحذف النهائي؟');">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-action btn-delete">حذف</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr class="empty-row">
                    <td colspan="4">
                        @if (request()->hasAny(['search', 'coach_id', 'subscription_status']))
                            لا توجد نتائج مطابقة لبحثك
                        @else
                            لا يوجد لاعبون مسجّلون
                        @endif
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection