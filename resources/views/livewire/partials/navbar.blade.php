<nav class="bg-gradient-to-r from-blue-600 to-blue-400 shadow-lg" x-data="{ mobileMenuOpen: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            <!-- Logo -->
            <div class="flex-shrink-0">
                <a href="/" class="flex items-center group">
                    <div class="flex items-center space-x-2 sm:space-x-3">
                        <svg class="w-8 h-8 sm:w-10 sm:h-10 transition-transform duration-300 group-hover:scale-110" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M30 25C25 25 20 28 18 35C16 42 15 50 15 58C15 66 15 74 17 80C19 86 23 90 30 92C35 94 40 92 42 88C43 85 44 82 44 78C44 70 44 60 44 52C44 45 42 38 38 32C36 28 33 25 30 25Z" fill="#A3D977" stroke="#A3D977" stroke-width="2"/>
                            <path d="M70 25C75 25 80 28 82 35C84 42 85 50 85 58C85 66 85 74 83 80C81 86 77 90 70 92C65 94 60 92 58 88C57 85 56 82 56 78C56 70 56 60 56 52C56 45 58 38 62 32C64 28 67 25 70 25Z" fill="#3B9FD8" stroke="#3B9FD8" stroke-width="2"/>
                            <path d="M44 52C44 45 46 38 50 32C54 38 56 45 56 52C56 60 56 70 56 78C56 82 55 85 54 88C53 90 51 92 50 92C49 92 47 90 46 88C45 85 44 82 44 78C44 70 44 60 44 52Z" fill="white"/>
                            <ellipse cx="42" cy="60" rx="3" ry="8" fill="#E8F5E9" opacity="0.5"/>
                            <ellipse cx="58" cy="60" rx="3" ry="8" fill="#E3F2FD" opacity="0.5"/>
                        </svg>
                        <div class="text-white">
                            <h1 class="text-xl sm:text-2xl font-bold leading-tight">iTeeth</h1>
                            <p class="text-[10px] sm:text-xs tracking-widest font-medium">DENTAL CLINIC</p>
                        </div>
                    </div>
                </a>
            </div>


            <!-- Desktop Navigation -->
            <div class="hidden md:flex md:items-center md:space-x-2">
                <a wire:click.prevent="toAbout" 
                   class="px-4 py-2 text-white hover:bg-white hover:text-blue-500  hover:bg-opacity-20 rounded-lg transition-all duration-300 font-medium cursor-pointer hover:shadow-md">
                    About
                </a>
                <a wire:click.prevent="toServices" 
                   class="px-4 py-2 text-white hover:bg-white hover:text-blue-500 hover:bg-opacity-20 rounded-lg transition-all duration-300 font-medium cursor-pointer hover:shadow-md">
                    Services
                </a>
                <a wire:click.prevent="toDentist" 
                   class="px-4 py-2 text-white hover:bg-white hover:text-blue-500 hover:bg-opacity-20 rounded-lg transition-all duration-300 font-medium cursor-pointer hover:shadow-md">
                    Clients
                </a>
                <a wire:click.prevent="toLocations" 
                   class="px-4 py-2 text-white hover:bg-white hover:text-blue-500 hover:bg-opacity-20 rounded-lg transition-all duration-300 font-medium cursor-pointer hover:shadow-md">
                    Locations
                </a>
                <a wire:click.prevent="toAppointment" 
                   class="x-4 py-2 text-white hover:bg-white hover:text-blue-500 hover:bg-opacity-20 rounded-lg transition-all duration-300 font-medium cursor-pointer hover:shadow-md">
                    Appointment
                </a>
            </div>

            <!-- Mobile menu button -->
            <div class="lg:hidden">
                <button 
                    wire:click="$toggle('mobileMenuOpen')"
                    type="button" 
                    class="text-white hover:bg-white hover:bg-opacity-20 p-2 rounded-lg transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-white focus:ring-opacity-50"
                    aria-label="Toggle menu"
                >
                    @if($mobileMenuOpen)
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    @else
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    @endif
                </button>
            </div>
        </div>

        <!-- Mobile Navigation Menu -->
        @if($mobileMenuOpen)
            <div 
                class="lg:hidden border-t border-white border-opacity-20"
                x-data
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 -translate-y-2"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 -translate-y-2"
            >
                <div class="px-2 pt-3 pb-4 space-y-1">
                    <a wire:click.prevent="toAbout" 
                       class="block px-4 py-3 text-white hover:bg-white hover:bg-opacity-20 rounded-lg transition-all duration-300 font-medium cursor-pointer active:bg-white active:bg-opacity-30">
                        <span class="flex items-center justify-between">
                            About
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </span>
                    </a>
                    <a wire:click.prevent="toServices" 
                       class="block px-4 py-3 text-white hover:bg-white hover:bg-opacity-20 rounded-lg transition-all duration-300 font-medium cursor-pointer active:bg-white active:bg-opacity-30">
                        <span class="flex items-center justify-between">
                            Services
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </span>
                    </a>
                    <a wire:click.prevent="toDentist" 
                       class="block px-4 py-3 text-white hover:bg-white hover:bg-opacity-20 rounded-lg transition-all duration-300 font-medium cursor-pointer active:bg-white active:bg-opacity-30">
                        <span class="flex items-center justify-between">
                            Clients
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </span>
                    </a>
                    <a wire:click.prevent="toLocations" 
                       class="block px-4 py-3 text-white hover:bg-white hover:bg-opacity-20 rounded-lg transition-all duration-300 font-medium cursor-pointer active:bg-white active:bg-opacity-30">
                        <span class="flex items-center justify-between">
                            Locations
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </span>
                    </a>
                    <a wire:click.prevent="toAppointment" 
                       class="block px-4 py-3 mt-2 bg-white text-blue-600 hover:bg-blue-50 rounded-lg transition-all duration-300 font-semibold shadow-lg text-center cursor-pointer active:scale-95">
                        Book Appointment
                    </a>
                </div>
            </div>
        @endif
    </div>
</nav>