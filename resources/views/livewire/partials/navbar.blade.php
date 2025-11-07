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
                <a href="#about" class="px-4 py-2 text-white hover:bg-white hover:bg-opacity-20 rounded-md transition duration-300 font-medium">
                    About
                </a>
                <a href="#services" class="px-4 py-2 text-white hover:bg-white hover:bg-opacity-20 rounded-md transition duration-300 font-medium">
                    Services
                </a>
                <a href="#clients" class="px-4 py-2 text-white hover:bg-white hover:bg-opacity-20 rounded-md transition duration-300 font-medium">
                    Clients
                </a>
                <a href="#locations" class="px-4 py-2 text-white hover:bg-white hover:bg-opacity-20 rounded-md transition duration-300 font-medium">
                    Locations
                </a>
                <a href="#contact" class="px-4 py-2 text-white hover:bg-white hover:bg-opacity-20 rounded-md transition duration-300 font-medium">
                    Contact Us
                </a>
                <a href="#appointment" class="ml-2 px-6 py-2 bg-white text-blue-600 hover:bg-blue-50 rounded-md transition duration-300 font-semibold shadow-md">
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

        <!-- Mobile Navigation -->
        <div 
            x-show="$wire.mobileMenuOpen"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 transform scale-95"
            x-transition:enter-end="opacity-100 transform scale-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 transform scale-100"
            x-transition:leave-end="opacity-0 transform scale-95"
            class="md:hidden pb-4"
        >
            <div class="flex flex-col space-y-2">
                <a href="#about" class="px-4 py-2 text-white hover:bg-white hover:bg-opacity-20 rounded-md transition duration-300 font-medium">
                    About
                </a>
                <a href="#services" class="px-4 py-2 text-white hover:bg-white hover:bg-opacity-20 rounded-md transition duration-300 font-medium">
                    Services
                </a>
                <a href="#clients" class="px-4 py-2 text-white hover:bg-white hover:bg-opacity-20 rounded-md transition duration-300 font-medium">
                    Clients
                </a>
                <a href="#locations" class="px-4 py-2 text-white hover:bg-white hover:bg-opacity-20 rounded-md transition duration-300 font-medium">
                    Locations
                </a>
                <a href="#contact" class="px-4 py-2 text-white hover:bg-white hover:bg-opacity-20 rounded-md transition duration-300 font-medium">
                    Contact Us
                </a>
                <a href="#appointment" class="mx-4 mt-2 px-6 py-2 bg-white text-blue-600 hover:bg-blue-50 rounded-md transition duration-300 font-semibold shadow-md text-center">
                    Appointment
                </a>
            </div>
        </div>
    </div>
</nav>