<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <title>{{ $title or 'Welcome' }} | BDE eXia.CESI</title>
</head>
<body>
    @yield('content')

    <script src="{{ asset('js/main.js') }}"></script>
</body>
</html>