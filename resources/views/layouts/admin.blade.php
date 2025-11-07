<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dental Clinic System</title>
    <link rel="icon" href="{{ asset('icons/tooth.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="antialiased">

    <main class="p-6">
        {{ $slot }}
    </main>

    @livewireScripts
    {{-- @stack('scripts') --}}
</body>
</html>
 {{-- <livewire:page-controller /> --}}