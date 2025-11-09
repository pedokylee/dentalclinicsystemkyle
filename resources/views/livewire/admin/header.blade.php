<nav class="fixed top-0 left-0 w-full bg-gradient-to-r from-blue-600 to-blue-400 shadow-lg z-50 m-0">
    <div class="px-2 sm:px-4 lg:px-6">
        <div class="flex justify-between items-center h-20">

            <!-- Logo -->
            <a class="flex items-center space-x-2">
                <svg class="w-10 h-10 text-white" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"
                        fill="currentColor" />
                    <path
                        d="M12 6c-3.31 0-6 2.69-6 6s2.69 6 6 6 6-2.69 6-6-2.69-6-6-6zm0 10c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4z"
                        fill="currentColor" />
                </svg>
                <div class="text-white">
                    <span class="text-2xl font-bold">iTeeth</span>
                    <p class="text-xs tracking-wider">DENTAL CLINIC ADMIN</p>
                </div>
            </a>

            <div class="relative" wire:click.away="closeForm">
                <button wire:click="toggleForm" class="flex items-center space-x-2 focus:outline-none">
                    <span class="text-white font-semibold">{{ Auth::user()->name }}</span>
                    <img src="{{ Auth::user()->profile_photo_url ?? 'https://via.placeholder.com/40' }}" alt="Profile"
                        class="w-10 h-10 rounded-full border-2 border-white object-cover">
                </button>

                @if($showForm)
                    <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg overflow-hidden z-50">
                        <a href="{{ route('admin.settings') }}"
                            class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Settings</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full text-left px-4 py-2 text-red-600 font-semibold rounded-lg hover:bg-red-100 hover:text-red-800 transition-colors duration-200">
                                Logout
                            </button>

                        </form>
                    </div>
                @endif
            </div>

        </div>
    </div>
</nav>