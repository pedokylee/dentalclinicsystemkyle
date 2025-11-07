<div class="relative w-full min-h-screen bg-gradient-to-br from-blue-600 to-blue-400 flex items-center justify-center px-4 py-12">

  <div class="w-full max-w-md bg-white rounded-2xl shadow-2xl p-8 md:p-10 relative">

    <!-- Go Back Button -->
    <button 
      wire:click="toPublicPage"
      class="absolute top-4 left-4 bg-blue-50 text-blue-600 border border-blue-100 hover:bg-blue-100
             font-medium px-4 py-2 rounded-lg shadow-md transition duration-200 ease-in-out">
      ← Back to Site
    </button>

    <!-- Logo & Title -->
    <div class="flex flex-col items-center mb-8 mt-10">
      <div class="flex items-center space-x-2">
        <svg class="w-12 h-12 text-blue-600" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z" fill="currentColor"/>
          <path d="M12 6c-3.31 0-6 2.69-6 6s2.69 6 6 6 6-2.69 6-6-2.69-6-6-6zm0 10c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4z" fill="currentColor"/>
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
        <input 
          type="email" 
          wire:model.live="email"
          required
          class="w-full border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 rounded-md px-4 py-2 text-gray-700 placeholder-gray-400 transition"
          placeholder="admin@example.com">
        @error('email') 
          <span class="text-red-500 text-xs">{{ $message }}</span> 
        @enderror
      </div>

      <!-- Password -->
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
        <input 
          type="password" 
          wire:model.live="password"
          required
          class="w-full border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 rounded-md px-4 py-2 text-gray-700 placeholder-gray-400 transition"
          placeholder="Enter your password">
        @error('password') 
          <span class="text-red-500 text-xs">{{ $message }}</span> 
        @enderror
      </div>

      <!-- Login Button -->
      <div class="pt-2">
        <button 
          type="submit"
          class="w-full py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-md shadow-md transition duration-200">
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
