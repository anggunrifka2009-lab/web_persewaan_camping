<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Persewaan Alat Camping</title>
</head>
<body>

<nav>

    <strong>Persewaan Alat Camping</strong>

    <div>
        @auth
            <span>Halo, {{ Auth::user()->nama }}</span>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit">Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}">Register</a>
        @endauth
    </div>

</nav>

<div class="container">

    <h1>Sistem Informasi Persewaan Alat Camping</h1>

    <p>Temukan dan sewa berbagai alat camping dengan mudah.</p>

    @guest
        <a href="{{ route('login') }}">Login</a>
        <a href="{{ route('register') }}">Daftar</a>
    @endguest

</div>

</body>
</html>