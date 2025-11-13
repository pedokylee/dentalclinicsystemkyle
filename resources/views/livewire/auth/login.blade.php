<div
    class="relative w-full min-h-screen bg-gradient-to-br from-blue-500 to-green-400 flex items-center justify-center px-4 py-12">

    <div class="w-full max-w-md bg-white rounded-2xl shadow-2xl p-8 md:p-10 relative">

        <!-- Go Back Button -->
        <button wire:click="toPublicPage"
            class="absolute top-4 left-4 bg-blue-50 text-blue-600 border border-blue-100 hover:bg-blue-100
             font-medium px-4 py-2 rounded-lg shadow-md transition duration-200 ease-in-out">
            ← Back to Site
        </button>

        <!-- Logo & Title -->
        <div class="flex flex-col items-center mb-8 mt-10">
            <div class="flex items-center space-x-2">
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
                <div>
                    <h1 class="text-2xl font-bold text-blue-700">iTeeth Admin</h1>
                    <p class="text-xs text-gray-500 tracking-wider text-center">DENTAL MANAGEMENT PORTAL</p>
                </div>
            </div>
        </div>

        <!-- Login Form -->
        <h2 class="text-center text-xl font-semibold text-gray-800 mb-6">Administrator Login</h2>

        @if (session()->has('error'))
            <div class="bg-red-50 text-red-600 px-4 py-2 mb-4 rounded-md text-sm border border-red-200">
                {{ session('error') }}
            </div>
        @endif

        <form wire:submit.prevent="login" class="space-y-5">
            <!-- Email -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                <input type="email" wire:model.live="email" required
                    class="w-full border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 rounded-md px-4 py-2 text-gray-700 placeholder-gray-400 transition"
                    placeholder="admin@example.com">
                @error('email')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" wire:model.live="password" required
                    class="w-full border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 rounded-md px-4 py-2 text-gray-700 placeholder-gray-400 transition"
                    placeholder="Enter your password">
                @error('password')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <!-- Login Button -->
            <div class="pt-2">
                <button type="submit"
                    class="bg-gradient-to-r from-blue-600 to-green-400 w-full py-3 bg-blue-600 hover:from-blue-700 hover:to-green-700 text-white font-semibold rounded-md shadow-md transition duration-200">
                    Login
                </button>
            </div>
        </form>

        <!-- Footer -->
        <div class="text-center mt-10 text-gray-400 text-sm">
            © <span id="year"></span> iTeeth Dental Clinic • Admin Panel
        </div>
    </div>
</div>

<script>
    document.getElementById('year').textContent = new Date().getFullYear();
</script>
