<!DOCTYPE html>
<html>
<head>
    <title>User Login</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
<div class="container">
    <h1>Login</h1>

    <!-- Login Form -->
    <form method="POST" action="{{ url('login') }}">
        @csrf
        <input type="email" name="email" placeholder="Email" required>

        <input type="password" name="password" placeholder="Password" required>

        <button type="submit">Login</button>
    </form>

    <!-- Display login error if exists -->
    @if ($errors->any())
        <div style="color:red;">
            {{ $errors->first() }}
        </div>
    @endif

    @if(session('success'))
        <div style="color:green;">
            {{ session('success') }}
        </div>
    @endif


    <p>Don't have an account? <a href="{{ url('register') }}">Register here</a></p>

</div>

</body>
</html>
