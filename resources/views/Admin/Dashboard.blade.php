<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>admin dashboard</h1>
    {{-- زر تسجيل خروج --}}
    <form method="POST" action="/admin/logout">
        @csrf
        <button type="submit">Logout</button>
    </form>
    {{-- button for two-factor authentication --}}
    <a href="{{ route('admin.2fa') }}" class="btn btn-primary">Two-Factor Authentication</a>
    <a href="{{route('admin.roles')}}">View Roles</a>
    <a href="{{route('admins.index')}}">View Admins</a>
    {{-- <a href="{{route('permissions.index')}}">View Permissions</a> --}}
</body>
</html>