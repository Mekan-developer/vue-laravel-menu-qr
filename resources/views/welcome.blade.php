<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>vue-menu</title>
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/app.css'])
        {{-- <script>window.locales = Object.keys(@json(LaravelLocalization::getSupportedLocales()));</script> --}}
    </head>
    <body >
        <div id="app">
            
            <main-component></main-component>
        </div>
    </body>
</html>
