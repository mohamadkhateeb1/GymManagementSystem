<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="#" method="POST">
        @csrf
        <label for="date">Date:</label>
        <input type="date" name="date" id="date" required>
        <br>
       <input type="hidden" name="employee_id">
        <br>
        <label for="plan">Plan:</label>
        <textarea name="plan" id="plan" required></textarea>
        <br>
        <br>
       <input type="hidden" name="employee_id">
        <br>
        <label for="plan">Plan:</label>
        <textarea name="plan" id="plan" required></textarea>
        <br>
        <button type="submit">Submit</button>
    </form>
</body>
</html>