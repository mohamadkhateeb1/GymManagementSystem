<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>قسم المسؤولين</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Syne:wght@600;700;800&family=DM+Sans:wght@400;500;600&family=JetBrains+Mono:wght@400;500&display=swap"
        rel="stylesheet">
    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: #0d0f14;
            min-height: 100vh;
            padding: 40px 32px;
            color: #e8eaf6;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
        }

        .mb-2 {
            margin-bottom: 24px;
        }

        .col {
            flex: 1;
        }

        .col-12 {
            width: 100%;
        }

        .text-right {
            text-align: right;
        }

        .p-0 {
            padding: 0;
        }

        .text-center {
            text-align: center;
        }

        .text-muted {
            color: #4b5368;
        }

        .text-nowrap {
            white-space: nowrap;
        }

        /* Back button */
        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 9px 16px;
            background: transparent;
            color: #6b7280;
            border: 1px solid #252a38;
            border-radius: 10px;
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            transition: color .15s, border-color .15s, background .15s;
        }

        .btn-back:hover {
            color: #e8eaf6;
            border-color: #3d4460;
            background: rgba(255, 255, 255, 0.04);
        }

        .btn-back svg {
            width: 15px;
            height: 15px;
        }

        /* Top buttons */
        .btn-top {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 10px 22px;
            border-radius: 10px;
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: opacity .15s, transform .15s, box-shadow .15s;
        }

        .btn-primary-top {
            background: linear-gradient(135deg, #00d4aa, #34d399);
            color: #fff;
            box-shadow: 0 4px 18px rgba(0, 212, 170, 0.28);
        }

        .btn-primary-top:hover {
            opacity: .9;
            transform: translateY(-1px);
            box-shadow: 0 6px 24px rgba(0, 212, 170, 0.38);
        }

        .btn-danger-top {
            background: rgba(248, 113, 113, 0.1);
            color: #f87171;
            border: 1px solid rgba(248, 113, 113, 0.25);
        }

        .btn-danger-top:hover {
            background: rgba(248, 113, 113, 0.18);
            border-color: rgba(248, 113, 113, 0.4);
            transform: translateY(-1px);
        }

        /* Card */
        .card {
            background: #181c27;
            border-radius: 16px;
            box-shadow: 0 8px 40px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            border: 1px solid #252a38;
        }

        .card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 18px 28px;
            border-bottom: 1px solid #252a38;
            background: rgba(255, 255, 255, 0.02);
        }

        h3.card-title {
            font-family: 'Syne', sans-serif;
            font-size: 15px;
            font-weight: 700;
            color: #e8eaf6;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        h3.card-title::before {
            content: '';
            display: inline-block;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #6c63ff;
            box-shadow: 0 0 8px rgba(108, 99, 255, 0.6);
        }

        .card-tools {
            display: flex;
            align-items: center;
        }

        .input-group {
            display: flex;
            align-items: center;
        }

        .card-body {
            overflow-x: auto;
        }

        .table-responsive {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead tr {
            background: rgba(255, 255, 255, 0.02);
            border-bottom: 1px solid #252a38;
        }

        th {
            padding: 13px 28px;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: .1em;
            text-transform: uppercase;
            color: #6b7280;
            text-align: left;
            white-space: nowrap;
        }

        tbody tr {
            border-bottom: 1px solid #1e2233;
            transition: background .12s;
        }

        tbody tr:last-child {
            border-bottom: none;
        }

        .table-hover tbody tr:hover {
            background: #1e2233;
        }

        td {
            padding: 15px 28px;
            font-size: 14px;
            color: #e8eaf6;
            vertical-align: middle;
            white-space: nowrap;
        }

        td:first-child {
            font-family: 'JetBrains Mono', monospace;
            font-size: 12px;
            color: #3d4460;
            font-weight: 500;
        }

        td:nth-child(2) {
            font-weight: 600;
        }

        td:nth-child(3) {
            color: #6b7280;
            font-size: 13px;
        }

        /* Inline buttons (Table) */
        .btn {
            display: inline-flex;
            align-items: center;
            padding: 7px 16px;
            border-radius: 8px;
            font-family: 'DM Sans', sans-serif;
            font-size: 13px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            text-decoration: none;
            transition: transform .13s, background .13s, border-color .13s;
        }

        .btn-primary {
            background: rgba(108, 99, 255, 0.12);
            color: #a78bfa;
            border: 1px solid rgba(108, 99, 255, 0.22);
        }

        .btn-primary:hover {
            background: rgba(108, 99, 255, 0.2);
            border-color: rgba(108, 99, 255, 0.4);
            transform: translateY(-1px);
        }

        .btn-danger {
            background: rgba(248, 113, 113, 0.08);
            color: #f87171;
            border: 1px solid rgba(248, 113, 113, 0.18);
        }

        .btn-danger:hover {
            background: rgba(248, 113, 113, 0.15);
            border-color: rgba(248, 113, 113, 0.35);
            transform: translateY(-1px);
        }

        form {
            margin: 0;
        }
    </style>
</head>

<body>

    <x-flash-message />

    <div class="row mb-2">
        <div class="col text-right" style="display:flex; align-items:center; justify-content:flex-end; gap:10px;">
            <a href="{{ route('admin.dashboard') }}" class="btn-back">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
                </svg>
                Dashboard
            </a>

            @can('admin.delete')
                <form action="{{ route('admins.destroy_all') }}" method="POST"
                    onsubmit="return confirm('هل أنت متأكد من حذف جميع المسؤولين؟ (لن يتم حذف السوبر أدمن)')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-top btn-danger-top">Delete All</button>
                </form>
            @endcan

            @can('admin.create')
                <a href="{{ route('admins.create') }}" class="btn-top btn-primary-top">Create Admin</a>
            @endcan
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Admins Table</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;"></div>
                    </div>
                </div>

                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Roles</th>
                                <th colspan="2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($admins as $admin)
                                <tr>
                                    @if ($admin->super_admin)
                                        @continue
                                    @endif
                                    <td>{{ $admin->id }}</td>
                                    <td>{{ $admin->name }}</td>
                                    <td>{{ $admin->roles->pluck('name')->join(', ') }}</td>
                                    @can('admin.edit')
                                        <td>
                                            <a href="{{ route('admins.edit', $admin->id) }}"
                                                class="btn btn-primary">Edit</a>
                                        </td>
                                    @endcan
                                    <td>
                                        @can('admin.delete')
                                            <form action="{{ route('admins.destroy', $admin->id) }}" method="POST"
                                                onsubmit="return confirm('Delete this admin?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">No admins found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

</body>

</html>
