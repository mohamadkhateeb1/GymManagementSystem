@extends('Admin.layouts.app')

@section('title', 'إضافة لاعب جديد | Elite Club')

@section('styles')
    <style>
        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }

        .page-header-left {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .page-accent {
            width: 5px;
            height: 46px;
            border-radius: 6px;
            background: linear-gradient(180deg, var(--accent), #8a6d2f);
            box-shadow: 0 0 18px rgba(201, 169, 97, 0.5);
        }

        .page-title {
            font-size: 24px;
            font-weight: 800;
            color: #fff;
            line-height: 1.2;
        }

        .page-sub {
            margin-top: 5px;
            font-size: 13px;
            color: var(--text-muted, #8b8b8b);
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 18px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 14px;
            text-decoration: none;
            color: var(--text-muted, #8b8b8b);
            border: 1px solid rgba(201, 169, 97, 0.2);
            background: rgba(16, 19, 28, 0.6);
            transition: all 0.3s ease;
        }

        .btn-back:hover {
            color: var(--accent);
            border-color: rgba(201, 169, 97, 0.45);
            transform: translateX(3px);
        }

        .form-card {
            position: relative;
            background: rgba(16, 19, 28, 0.65);
            backdrop-filter: blur(14px);
            border: 1px solid rgba(201, 169, 97, 0.18);
            border-radius: 20px;
            padding: 40px;
            box-shadow:
                0 20px 50px rgba(0, 0, 0, 0.45),
                inset 0 1px 0 rgba(255, 255, 255, 0.04);
            overflow: hidden;
            animation: cardIn 0.5s ease both;
        }

        .form-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(201, 169, 97, 0.6), transparent);
        }

        @keyframes cardIn {
            from {
                opacity: 0;
                transform: translateY(12px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 640px) {
            .form-card {
                padding: 24px;
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

        <a href="{{ route('players.index') }}" class="btn-back">
            <i class="fas fa-arrow-right"></i> رجوع للقائمة
        </a>
    </div>

    <form action="{{ route('players.store') }}" method="POST" class="form-card">
        @csrf
        @include('Admin.Players._form')
    </form>
@endsection
