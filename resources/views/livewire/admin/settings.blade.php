<div class="min-h-screen bg-gray-100 pt-20">
    <!-- Header (Livewire Header Component) -->
    <livewire:admin.header />

    <div class="max-w-7xl mx-auto p-6">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Settings</h1>
            <a href="{{ route('admin.dashboard') }}" 
               class="bg-gray-200 text-gray-800 px-4 py-2 rounded-lg hover:bg-gray-300 hover:text-gray-900 transition-colors duration-200">
                ← Back to Dashboard
            </a>
        </div>

        <!-- Example: Change Password Section -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-lg font-semibold mb-4">Profile Settings</h2>

            <form wire:submit.prevent="updateProfile" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" wire:model.defer="name" 
                           class="w-full border rounded-lg px-3 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" wire:model.defer="email" 
                           class="w-full border rounded-lg px-3 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-200">
                    Update Profile
                </button>
            </form>
        </div>
    </div>
</div>
