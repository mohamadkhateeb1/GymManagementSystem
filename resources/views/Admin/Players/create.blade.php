@extends('Admin.layouts.app')

@section('title', 'إضافة لاعب جديد | Elite Club')

@section('styles')
    <style>
        /* ELITE CLUB — CREATE/EDIT PAGE HEADER (نسخة مختصرة تعتمد متغيّرات الثيم) */

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

        .page-title {
            color: var(--text);
            font-size: 21px;
            font-weight: 850;
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
            <div>
                <div class="page-title">إضافة لاعب جديد</div>
                <div class="page-sub">أدخل بيانات اللاعب لإضافته إلى سجل النادي</div>
            </div>
        </div>
        <a href="{{ route('players.index') }}" class="btn-back"><i class="fas fa-arrow-right"></i> رجوع للقائمة</a>
    </div>

    <form action="{{ route('players.store') }}" method="POST" class="form-card">
        @csrf
        @include('Admin.Players._form')
    </form>
@endsection
