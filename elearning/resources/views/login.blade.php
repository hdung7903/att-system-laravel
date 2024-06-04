<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <div>
        <form method="post" action="{{ route('login') }}">
            @csrf
            <div>
                <label for="username">Username</label>
                <input type="username" name="username">
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" name="password">
            </div>
            @if (session()->has('error'))
                <p>{{ session()->get('error') }}</p>
            @endif
            <button type="submit">Login</button>
        </form>
    </div>
</body>

</html>
