<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? config('app.name') }}</title>
    @include('blocks.meta')
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body>
    @include('blocks.nav')

    <main class="container d-flex justify-content-center">
        <div class="content border p-3">
            @yield('content')
        </div>
    </main>

    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>