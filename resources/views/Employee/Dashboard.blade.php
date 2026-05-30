<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Employee Dashboard</h1>
    {{-- زر تسجيل خروج --}}
    <form method="POST" action="/employee/logout">
        @csrf
        <button type="submit">Logout</button>
    </form>
    {{-- زر 2fa --}}
   <a href="{{ route('employee.2fa') }}">Two Factor Authentication</a>
</body>
</html>