<nav class="fixed top-0 left-0 w-full bg-gradient-to-r from-blue-600 to-green-400 shadow-lg">
    <div class="px-2 sm:px-4 lg:px-6">
        <div class="flex justify-between items-center h-20">

            <!-- Logo -->
            <a class="flex items-center space-x-2">
                <svg class="w-8 h-8 sm:w-10 sm:h-10 transition-transform duration-300 group-hover:scale-110"
                    viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M30 25C25 25 20 28 18 35C16 42 15 50 15 58C15 66 15 74 17 80C19 86 23 90 30 92C35 94 40 92 42 88C43 85 44 82 44 78C44 70 44 60 44 52C44 45 42 38 38 32C36 28 33 25 30 25Z"
                        fill="#A3D977" stroke="#A3D977" stroke-width="2" />
                    <path
                        d="M70 25C75 25 80 28 82 35C84 42 85 50 85 58C85 66 85 74 83 80C81 86 77 90 70 92C65 94 60 92 58 88C57 85 56 82 56 78C56 70 56 60 56 52C56 45 58 38 62 32C64 28 67 25 70 25Z"
                        fill="#3B9FD8" stroke="#3B9FD8" stroke-width="2" />
                    <path
                        d="M44 52C44 45 46 38 50 32C54 38 56 45 56 52C56 60 56 70 56 78C56 82 55 85 54 88C53 90 51 92 50 92C49 92 47 90 46 88C45 85 44 82 44 78C44 70 44 60 44 52Z"
                        fill="white" />
                    <ellipse cx="42" cy="60" rx="3" ry="8" fill="#E8F5E9"
                        opacity="0.5" />
                    <ellipse cx="58" cy="60" rx="3" ry="8" fill="#E3F2FD"
                        opacity="0.5" />
                </svg>
                <div class="text-white">
                    <span class="text-2xl font-bold">iTeeth</span>
                    <p class="text-xs tracking-wider">DENTAL CLINIC ADMIN</p>
                </div>
            </a>

            <!-- Profile + Dropdown -->
            <div class="relative" wire:click.away="closeForm">
                <button wire:click="toggleForm" class="flex items-center space-x-2 focus:outline-none">
                    <span class="text-white font-semibold">{{ Auth::user()->name }}</span>
                    <img src="{{ Auth::user()->profile_photo_url ?? 'https://cdn-icons-png.flaticon.com/512/3135/3135715.png' }}"
                        alt="Profile" class="w-10 h-10 rounded-full border-2 border-white object-cover">
                </button>

                <!-- Dropdown menu -->
                @if($showForm)
                    <div class="absolute right-0 mt-3 w-48 bg-white rounded-lg shadow-lg overflow-hidden z-50 animate-fade-in">
                        <a href="{{ route('admin.settings') }}"
                            class="block px-4 py-2 text-gray-700 hover:bg-gray-100 transition">Settings</a>
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
