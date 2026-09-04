@extends('Admin.layouts.app')

@section('title', 'تعديل لاعب | Elite Club')

@section('styles')
    <style>
        /* نفس أنماط create.blade.php + أفاتار اللاعب بالهيدر */

        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            flex-wrap: wrap;
            margin-bottom: 20px;
            padding: 18px 20px;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 16px;
            box-shadow: var(--shadow-sm);
        }

        .page-header-left {
            display: flex;
            align-items: center;
            gap: 13px;
        }

        .page-accent {
            width: 4px;
            height: 42px;
            border-radius: 10px;
            background: linear-gradient(to bottom, var(--gold-light), var(--gold-dark));
        }

        .page-avatar {
            width: 46px;
            height: 46px;
            border-radius: 13px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 19px;
            color: #1a1305;
            background: linear-gradient(135deg, var(--gold-light), var(--gold));
            box-shadow: 0 4px 14px rgba(184, 146, 62, .30);
        }

        .page-title {
            color: var(--text);
            font-size: 21px;
            font-weight: 850;
        }

        .page-title span {
            color: var(--gold-dark);
        }

        .page-sub {
            margin-top: 3px;
            color: var(--text-soft);
            font-size: 13px;
            font-weight: 500;
        }

        .btn-back {
            height: 42px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 0 17px;
            color: var(--text-soft);
            background: var(--surface-2);
            border: 1px solid var(--border);
            border-radius: 10px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 750;
            transition: .2s ease;
        }

        .btn-back:hover {
            color: var(--gold-dark);
            background: var(--surface-hover);
            transform: translateX(2px);
        }

        @media (max-width: 650px) {
            .page-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .page-header-left,
            .btn-back {
                width: 100%;
            }
        }
    </style>
@endsection

@section('content')
    <div class="page-header">
        <div class="page-header-left">
            <div class="page-accent"></div>
            <div class="page-avatar">{{ mb_strtoupper(mb_substr($player->name, 0, 1)) }}</div>
            <div>
                <div class="page-title">تعديل بيانات: <span>{{ $player->name }}</span></div>
                <div class="page-sub">قم بتحديث معلومات اللاعب ثم احفظ التغييرات</div>
            </div>
        </div>
        <a href="{{ route('players.index') }}" class="btn-back"><i class="fas fa-arrow-right"></i> رجوع للقائمة</a>
    </div>

    <form action="{{ route('players.update', $player->id) }}" method="POST" class="form-card">
        @csrf
        @method('PUT')
        @include('Admin.Players._form', ['player' => $player])
    </form>
@endsection
