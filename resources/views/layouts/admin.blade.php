<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iTeeth - Admin Dashboard</title>
    <link rel="icon" href="{{ asset('icons/tooth.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    
    <style>
        @keyframes fade-in {
            from { opacity: 0; }
            to { opacity: 1; }
        }

         @keyframes fade-out {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slide-in-top {
            from { transform: translateY(-20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        @keyframes slide-in-bottom {
            from { transform: translateY(20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        @keyframes scale-in {
            from { transform: scale(0.95); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }

        .animate-fade-in {
            animation: fade-in 0.3s ease-out;
        }

        .animate-slide-in-top {
            animation: slide-in-top 0.4s ease-out;
        }

        .animate-slide-in-bottom {
            animation: slide-in-bottom 0.3s ease-out;
        }

        .animate-scale-in {
            animation: scale-in 0.3s ease-out;
        }

        /* Prevent layout shift from scrollbar */
        html {
            overflow-y: scroll;
        }

        /* Smooth scrolling */
        html {
            scroll-behavior: smooth;
        }

        /* Better text rendering */
        body {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
    </style>
</head>
<body class="antialiased bg-gray-50">

    <livewire:admin.header />
    
    <main class="min-h-screen">
        {{ $slot }}
    </main>

    @livewireScripts
</body>
</html>