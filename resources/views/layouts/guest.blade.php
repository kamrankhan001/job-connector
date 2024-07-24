<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Job Connect</title>
        <link rel="shortcut icon" href="{{ asset('assets/logo.png') }}" type="image/x-icon">
        <link rel="stylesheet" href="{{ asset('assets/css/jquery-ui.css') }}">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <x-navbar />
        <div class="max-w-screen-xl mx-auto p-4">
            {{ $slot }}
        </div>
        <script src="{{ asset('assets/js/jquery.js') }}"></script>
        <script src="{{ asset('assets/js/jquery-ui.js') }}"></script>
        @if (!empty($script))
            {!! $script !!}
        @endif
    </body>
</html>
