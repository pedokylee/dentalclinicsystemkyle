<nav class="bg-gradient-to-r from-blue-600 to-blue-400 shadow-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            <!-- Logo -->
            <div class="flex-shrink-0">
                <a href="/" class="flex items-center">
                    <div class="flex items-center space-x-2">
                        <svg class="w-10 h-10 text-white" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z" fill="currentColor"/>
                            <path d="M12 6c-3.31 0-6 2.69-6 6s2.69 6 6 6 6-2.69 6-6-2.69-6-6-6zm0 10c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4z" fill="currentColor"/>
                        </svg>
                        <div class="text-white">
                            <span class="text-2xl font-bold">iTeeth</span>
                            <p class="text-xs tracking-wider">DENTAL CLINIC</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex md:items-center md:space-x-1">
                <a wire:click.prevent="toAbout" 
                   class="px-4 py-2 text-white hover:bg-white hover:bg-opacity-20 hover:text-blue-600 rounded-md transition duration-300 font-medium cursor-pointer">
                    About
                </a>
                <a wire:click.prevent="toServices" 
                   class="px-4 py-2 text-white hover:bg-white hover:bg-opacity-20 hover:text-blue-600 rounded-md transition duration-300 font-medium cursor-pointer">
                    Services
                </a>
                <a wire:click.prevent="toDentist" 
                   class="px-4 py-2 text-white hover:bg-white hover:bg-opacity-20 hover:text-blue-600 rounded-md transition duration-300 font-medium cursor-pointer">
                    Clients
                </a>
                <a wire:click.prevent="toLocations" 
                   class="px-4 py-2 text-white hover:bg-white hover:bg-opacity-20 hover:text-blue-600 rounded-md transition duration-300 font-medium cursor-pointer">
                    Locations
                </a>
                <a wire:click.prevent="toAppointment" 
                   class="ml-2 px-6 py-2 bg-white text-blue-600 hover:bg-blue-50 rounded-md transition duration-300 font-semibold shadow-md cursor-pointer">
                    Appointment
                </a>
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden">
                <button 
                    wire:click="toggleMobileMenu"
                    type="button" 
                    class="text-white hover:bg-white hover:bg-opacity-20 p-2 rounded-md transition duration-300"
                    aria-label="Toggle menu"
                >
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path 
                            x-show="!mobileMenuOpen" 
                            stroke-linecap="round" 
                            stroke-linejoin="round" 
                            stroke-width="2" 
                            d="M4 6h16M4 12h16M4 18h16"
                        />
                        <path 
                            x-show="mobileMenuOpen" 
                            stroke-linecap="round" 
                            stroke-linejoin="round" 
                            stroke-width="2" 
                            d="M6 18L18 6M6 6l12 12"
                        />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</nav>
