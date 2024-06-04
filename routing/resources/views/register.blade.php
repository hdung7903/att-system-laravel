<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
</head>
<body>
    <div>
        <form method="post" action="{{ route('register') }}">
            @csrf
            <div>
                <label for="email">Email</label>
                <input type='email' id="email" name="email" required>
            </div>
            <div>
                <label for="name">Name</label>
                <input type="name" id="name" name="name" required>
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Register</button>
        </form>
    </div>
</body>
</html>