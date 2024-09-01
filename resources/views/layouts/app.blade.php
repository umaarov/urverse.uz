<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Blog') }}</title>
</head>

<body>
    <header>
        <nav>
            <a href="{{ url('/') }}">Home</a>
            @auth
                <a href="{{ url('/admin') }}">Admin Panel</a>
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            @endauth
        </nav>
    </header>

    <main>
        @yield('content')
    </main>
</body>

</html>
