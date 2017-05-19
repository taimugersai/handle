<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Laravel'))</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    @yield('header')
    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    <div id="app">
        @include('layouts._header')
        <div class="container">
            @include('flash::message')
        </div>
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="/js/app.js"></script>
    @yield('footer')
    <script>
        $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
    </script>
</body>
</html>
