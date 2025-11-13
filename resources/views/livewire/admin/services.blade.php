<div class="min-h-screen bg-gradient-to-br from-gray-50 via-blue-50 to-gray-100 pt-20">

    <!-- Navbar -->
    <div class="mb-4 sm:mb-6">
        <livewire:admin.navbar />
    </div>

    <div class="max-w-7xl mx-auto p-6 space-y-6 rounded-3xl mt-5 shadow-xl border border-gray-200/50">

        <!-- Header -->
        <div class="flex justify-between items-center pb-4 border-b border-gray-200">
            <div>
                <h2
                    class="text-gray-900 text-2xl font-bold bg-gradient-to-r from-blue-600 to-cyan-600 bg-clip-text text-transparent">
                    Services Management
                </h2>
                <p class="text-sm text-gray-600 mt-1">Manage dental services and pricing</p>
            </div>
            <button wire:click="openAddModal"
                class="group bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-700 hover:to-cyan-700 text-white px-6 py-3 rounded-xl flex items-center space-x-2 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5 group-hover:rotate-90 transition-transform duration-300" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                <span class="font-semibold">Add Service</span>
            </button>
        </div>

        <!-- Search -->
        <div class="relative group mt-4">
            <input type="text" wire:model="searchQuery" placeholder="Search services by name or category..."
                class="pl-12 pr-4 py-3 border-2 border-gray-200 rounded-xl w-full focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 bg-white/50 hover:bg-white" />
            <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400 w-5 h-5 group-focus-within:text-blue-600 transition-colors"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-4.35-4.35M9 17a8 8 0 100-16 8 8 0 000 16z" />
            </svg>
        </div>

        <!-- Services Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-4">
            @foreach ($services as $service)
                <div
                    class="group p-6 rounded-2xl border-2 border-gray-100 bg-gradient-to-br from-white to-gray-50 shadow-md hover:shadow-2xl hover:border-blue-200 transition-all duration-300 transform hover:-translate-y-1">
                    <div class="flex justify-between items-start mb-4">
                        <div class="flex-1">
                            <h3 class="text-gray-900 font-bold text-lg group-hover:text-blue-600 transition-colors">
                                {{ $service['name'] }}</h3>
                            <span
                                class="inline-block mt-1 px-2 py-1 bg-gray-100 text-gray-700 rounded-full text-xs">{{ $service['category'] }}</span>
                        </div>

                        <div class="flex space-x-2">
                            <button wire:click="openEditModal({{ $service['id'] }})"
                                class="text-blue-600 hover:text-blue-800 font-medium text-sm transition-colors">Edit</button>
                            <button wire:click="deleteService({{ $service['id'] }})"
                                class="text-red-600 hover:text-red-800 font-medium text-sm transition-colors">Delete</button>
                        </div>
                    </div>

                    <p class="text-sm text-gray-600 mb-4 line-clamp-2">{{ $service['description'] }}</p>

                    <div class="flex justify-between items-center pt-3 border-t mt-3">
                        <div class="flex items-center space-x-4">
                            {{-- <div>
                                <p class="text-xs text-gray-500">Duration</p>
                                <p class="text-sm text-gray-900">{{ $service['duration'] }} min</p>
                            </div> --}}
                            <div class="w-px h-8 bg-gray-200"></div>
                            <div>
                                <p class="text-xs text-gray-500">Price</p>
                                <p class="text-sm text-gray-900">₱{{ $service['price'] }}</p>
                            </div>
                        </div>

                        <span
                            class="px-2 py-1 rounded-full text-xs {{ $service['is_active'] ? 'bg-green-100 text-green-700 ring-1 ring-green-200' : 'bg-gray-100 text-gray-600 ring-1 ring-gray-200' }}">
                            {{ $service['is_active'] ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Add/Edit Modal -->
        @if ($isAddModalOpen || $selectedService)
            <div class="fixed inset-0 flex items-center justify-center z-50 p-4 animate-fade-in overflow-y-auto">
                <div class="bg-black/60 backdrop-blur-sm fixed inset-0" wire:click="$set('isAddModalOpen', false)">
                </div>

                <div
                    class="bg-white rounded-2xl shadow-2xl p-6 w-full max-w-3xl my-8 z-10 animate-slide-in-bottom border border-gray-200 relative">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">
                        {{ $selectedService ? 'Edit Service' : 'Add New Service' }}</h3>

                    <div class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Service Name</label>
                                <input type="text" wire:model="name"
                                    class="block w-full border-2 border-gray-200 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 px-3 py-2 text-sm transition-all">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Category</label>
                                <input type="text" wire:model="category"
                                    class="block w-full border-2 border-gray-200 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 px-3 py-2 text-sm transition-all">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Description</label>
                            <textarea wire:model="description" rows="3"
                                class="block w-full border-2 border-gray-200 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 px-3 py-2 text-sm transition-all"></textarea>
                        </div>

                        {{-- <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Duration (minutes)</label>
                                <input type="number" wire:model="duration"
                                    class="block w-full border-2 border-gray-200 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 px-3 py-2 text-sm transition-all">
                            </div> --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Price ($)</label>
                            <input type="number" wire:model="price"
                                class="block w-full border-2 border-gray-200 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 px-3 py-2 text-sm transition-all">
                        </div>
                    </div>

                    <div class="flex items-center space-x-2 mt-2">
                        <input type="checkbox" wire:model="isActive" id="isActive" class="accent-blue-600">
                        <label for="isActive" class="text-sm text-gray-700 font-medium">Active</label>
                    </div>

                    <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200">
                        <button wire:click="cancelEdit"
                            class="px-5 py-2 rounded-lg border-2 border-gray-300 hover:bg-gray-50 font-semibold text-gray-700 text-sm transition-all duration-300 transform hover:scale-105">
                            Cancel
                        </button>

                        <button wire:click="saveService"
                            class="px-5 py-2 rounded-lg bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-700 hover:to-cyan-700 text-white font-semibold text-sm shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">{{ $selectedService ? 'Save Changes' : 'Add Service' }}</button>
                    </div>
                </div>
            </div>
    </div>
    @endif

</div>
</div>
