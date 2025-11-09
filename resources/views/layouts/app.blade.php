<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>iTeeth</title>
    <link rel="icon" href="{{ asset('icons/tooth.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="antialiased">

    <livewire:partials.navbar />

    <main class="p-6">
        {{ $slot }}
    </main>

    <livewire:partials.footer />
    
    @livewireScripts
</body>
</html>
