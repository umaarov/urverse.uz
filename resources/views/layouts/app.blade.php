{{-- resources\views\layouts\app.blade.php --}}
<!DOCTYPE html>
<html>

<head>
    <title>IT Blog</title>
    <link rel="stylesheet" href="{{ mix('css/articles.css') }}">
</head>

<body>
    <div class="container">
        @yield('content')
    </div>
    @yield('scripts')
    <script src="{{ mix('js/app.js') }}"></script>
</body>

</html>
