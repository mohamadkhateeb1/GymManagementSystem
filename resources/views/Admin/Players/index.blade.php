@extends('Admin.layouts.app')

@section('title', 'إدارة اللاعبين | Elite Club')

@section('styles')
    <style>
        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 30px;
        }

        .header-title {
            font-size: 26px;
            font-weight: 800;
            color: #fff;
        }

        .card {
            background: #121722;
            border: 1px solid rgba(201, 169, 97, 0.12);
            border-radius: 12px;
            overflow: hidden;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th {
            padding: 16px;
            font-size: 12px;
            color: #8a8f9c;
            text-align: right;
            border-bottom: 1px solid rgba(201, 169, 97, 0.12);
        }

        .table td {
            padding: 16px;
            border-bottom: 1px solid rgba(201, 169, 97, 0.06);
            color: #e8e6e1;
        }

        .btn-small {
            padding: 6px 12px;
            font-size: 11px;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
        }

        .btn-edit {
            background: rgba(201, 169, 97, 0.1);
            color: #c9a961;
            border: 1px solid rgba(201, 169, 97, 0.3);
        }
    </style>
@endsection

@section('content')
    <div class="header">
        <div class="header-title">اللاعبون</div>
        <a href="{{ route('players.create') }}" class="btn-small btn-edit">إضافة لاعب جديد</a>
    </div>

    <div class="card">
        <table class="table">
            <thead>
                <tr>
                    <th>الاسم</th>
                    <th>رقم الهاتف</th>
                    <th>حالة الاشتراك</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse($players as $player)
                    <tr>
                        <td>{{ $player->name }}</td>
                        <td>{{ $player->phone }}</td>
                        <td>
                            <span class="status-chip {{ $player->is_active ? 'active' : 'expired' }}">
                                {{ $player->is_active ? 'نشط' : 'منتهي' }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('players.edit', $player->id) }}" class="btn-small btn-edit">تعديل</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="text-align:center; padding:40px;">لا يوجد لاعبين حالياً</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
