<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
    @livewireScripts

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="bg-white-50 dark:bg-white-800 m-10">

    @include('layouts.navigation.nav')

    <div id="main-content" class="relative w-full h-full bg-white-50 dark:bg-white-900" style="padding-top: 3.5rem">
        {{ $slot }}
    </div>


    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

</body>

</html>
