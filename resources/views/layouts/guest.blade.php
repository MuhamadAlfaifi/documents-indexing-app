<!DOCTYPE html>
<html lang="ar" dir="rtl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="preload" href="{{ asset('fonts/sf-arabic.ttf') }}" as="font" type="font/truetype" crossorigin="anonymous" />
        <style>
          @font-face {
            font-family: "sf-arabic";
            src: url("{{ asset('fonts/sf-arabic.ttf') }}");
            font-display: block;
          }
        </style>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <div class="font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div>
    </body>
</html>
