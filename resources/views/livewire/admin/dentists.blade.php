<div class="min-h-screen bg-gradient-to-br from-gray-50 via-blue-50 to-gray-100 pt-20">
    <!-- Navbar -->
    <div class="mb-4 sm:mb-6">
        <livewire:admin.navbar />
    </div>

    <!-- Dashboard content -->
    <div class="max-w-7xl mx-auto p-6 space-y-6 rounded-3xl mt-5 shadow-xl border border-gray-200/50">

        <!-- Success Message with animation -->
        @if (session()->has('message'))
            <div class="bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 text-green-800 px-6 py-4 rounded-xl shadow-sm animate-slide-in-top" role="alert">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span class="font-medium">{{ session('message') }}</span>
                </div>
            </div>
        @endif

        <!-- Header with enhanced styling -->
        <div class="flex justify-between items-center pb-4 border-b border-gray-200">
            <div>
                <h2 class="text-gray-900 text-2xl font-bold bg-gradient-to-r from-blue-600 to-cyan-600 bg-clip-text text-transparent">
                    Dentists Management
                </h2>
                <p class="text-sm text-gray-600 mt-1">Manage dental practitioners and their information</p>
            </div>
            <button wire:click="openAddModal"
                class="group bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-700 hover:to-cyan-700 text-white px-6 py-3 rounded-xl flex items-center space-x-2 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 group-hover:rotate-90 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                <span class="font-semibold">Add Dentist</span>
            </button>
        </div>

        <!-- Enhanced Search -->
        <div class="relative group">
            <input type="text" wire:model.live="search" placeholder="Search dentists by name or specialization..."
                class="pl-12 pr-4 py-3 border-2 border-gray-200 rounded-xl w-full focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 bg-white/50 hover:bg-white" />
            <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400 w-5 h-5 group-focus-within:text-blue-600 transition-colors"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-4.35-4.35M9 17a8 8 0 100-16 8 8 0 000 16z" />
            </svg>
        </div>

        <!-- Enhanced Dentist Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @forelse($dentists as $dentist)
                <div class="group p-6 rounded-2xl border-2 border-gray-100 bg-gradient-to-br from-white to-gray-50 shadow-md hover:shadow-2xl hover:border-blue-200 transition-all duration-300 transform hover:-translate-y-1">
                    <div class="flex justify-between items-start mb-4">
                        <div class="flex items-center space-x-3">
                            <div class="relative">
                                <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-full flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                                    <span class="text-white font-bold text-lg">
                                        {{ collect(explode(' ', $dentist->user?->name ?? $dentist->name))->map(fn($n) => strtoupper($n[0]))->join('') }}
                                    </span>
                                </div>
                                {{-- <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-500 rounded-full border-2 border-white"></div> --}}
                            </div>
                            <div>
                                <h3 class="text-gray-900 font-bold text-lg group-hover:text-blue-600 transition-colors">
                                    {{ $dentist->user?->name ?? $dentist->name }}
                                </h3>
                                <p class="text-sm text-gray-600 font-medium">{{ $dentist->specialization ?? 'General Dentistry' }}</p>
                            </div>
                        </div>
                        <span class="px-3 py-1.5 text-xs font-semibold rounded-full shadow-sm
                            @if($dentist->status === 'active') bg-gradient-to-r from-green-100 to-emerald-100 text-green-700 ring-1 ring-green-200
                            @elseif($dentist->status === 'on-leave') bg-gradient-to-r from-yellow-100 to-orange-100 text-yellow-700 ring-1 ring-yellow-200
                            @else bg-gray-100 text-gray-600 ring-1 ring-gray-200 @endif">
                            {{ ucfirst($dentist->status) }}
                        </span>
                    </div>

                    <p class="text-sm text-gray-600 mb-4 line-clamp-2">{{ $dentist->bio ?? 'No biography available' }}</p>

                    <div class="space-y-2 text-sm border-t border-gray-200 pt-3">
                        <div class="flex items-center text-gray-700">
                            <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <span class="truncate">{{ $dentist->user?->email ?? $dentist->email ?? 'N/A' }}</span>
                        </div>
                        <div class="flex items-center text-gray-700">
                            <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            <span>{{ $dentist->phone ?? 'N/A' }}</span>
                        </div>
                        <div class="flex items-center text-gray-700">
                            <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <span>{{ $dentist->license_number ?? 'N/A' }} • {{ $dentist->years_of_experience ?? 0 }} yrs exp</span>
                        </div>
                    </div>

                    @php
                        $availability = is_array($dentist->availability) ? $dentist->availability : json_decode($dentist->availability ?? '[]', true);
                    @endphp

                    @if(!empty($availability))
                        <div class="border-t border-gray-200 pt-3 mt-3">
                            <p class="text-xs font-semibold text-gray-600 mb-2 uppercase tracking-wide">Availability:</p>
                            <div class="flex flex-wrap gap-2">
                                @foreach($availability as $day)
                                    <span class="px-3 py-1 text-xs font-medium bg-gradient-to-r from-blue-50 to-cyan-50 text-blue-700 border border-blue-200 rounded-lg">
                                        {{ substr($day, 0, 3) }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="flex space-x-3 mt-5 pt-4 border-t border-gray-200">
                        <button wire:click="openEditModal({{ $dentist->id }})"
                            class="flex-1 text-sm font-semibold border-2 border-blue-200 text-blue-700 py-2.5 rounded-xl hover:bg-blue-50 hover:border-blue-300 transition-all duration-300 transform hover:scale-105">
                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Edit
                        </button>
                        <button wire:click="openDeleteModal({{ $dentist->id }})"
                            class="flex-1 text-sm font-semibold border-2 border-red-200 text-red-700 py-2.5 rounded-xl hover:bg-red-50 hover:border-red-300 transition-all duration-300 transform hover:scale-105">
                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            Delete
                        </button>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-16">
                    <svg class="w-20 h-20 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                    </svg>
                    <p class="text-gray-500 text-lg font-medium">No dentists found</p>
                    <p class="text-gray-400 text-sm mt-2">Try adjusting your search or add a new dentist</p>
                </div>
            @endforelse
        </div>

        <!-- Add/Edit Modal -->
        @if($isAddModalOpen || $isEditModalOpen)
            <div class="fixed inset-0 flex items-center justify-center z-50 p-4 animate-fade-in overflow-y-auto">
                <div class="bg-black/60 backdrop-blur-sm fixed inset-0" wire:click="closeModal"></div>

                <div class="bg-white rounded-2xl shadow-2xl p-6 w-full max-w-3xl my-8 z-10 animate-slide-in-bottom border border-gray-200 relative">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">
                        {{ $isAddModalOpen ? 'Add New Dentist' : 'Edit Dentist Information' }}
                    </h2>

                    <div class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Full Name</label>
                                <input type="text" wire:model="name"
                                    class="block w-full border-2 border-gray-200 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 px-3 py-2 text-sm transition-all"
                                    placeholder="Dr. John Doe">
                                @error('name') <span class="text-red-500 text-xs mt-0.5 block">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Specialization</label>
                                <input type="text" wire:model="specialization"
                                    class="block w-full border-2 border-gray-200 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 px-3 py-2 text-sm transition-all"
                                    placeholder="General Dentistry">
                                @error('specialization') <span class="text-red-500 text-xs mt-0.5 block">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
                                <input type="email" wire:model="email"
                                    class="block w-full border-2 border-gray-200 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 px-3 py-2 text-sm transition-all"
                                    placeholder="doctor@iteeth.com">
                                @error('email') <span class="text-red-500 text-xs mt-0.5 block">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Phone</label>
                                <input type="text" wire:model="phone"
                                    class="block w-full border-2 border-gray-200 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 px-3 py-2 text-sm transition-all"
                                    placeholder="(555) 000-0000">
                                @error('phone') <span class="text-red-500 text-xs mt-0.5 block">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">License Number</label>
                                <input type="text" wire:model="license_number"
                                    class="block w-full border-2 border-gray-200 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 px-3 py-2 text-sm transition-all"
                                    placeholder="DDS-00000">
                                @error('license_number') <span class="text-red-500 text-xs mt-0.5 block">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Years of Experience</label>
                                <input type="number" wire:model="years_of_experience"
                                    class="block w-full border-2 border-gray-200 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 px-3 py-2 text-sm transition-all"
                                    placeholder="5">
                                @error('years_of_experience') <span class="text-red-500 text-xs mt-0.5 block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Biography</label>
                            <textarea wire:model="bio" rows="2"
                                class="block w-full border-2 border-gray-200 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 px-3 py-2 text-sm transition-all"
                                placeholder="Brief professional background..."></textarea>
                            @error('bio') <span class="text-red-500 text-xs mt-0.5 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Availability</label>
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-2">
                                @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'] as $day)
                                    <label class="flex items-center space-x-2 cursor-pointer group">
                                        <input type="checkbox" value="{{ $day }}" wire:model="availability" 
                                            class="rounded border-gray-300 text-blue-600 focus:ring-blue-500 cursor-pointer transition-all">
                                        <span class="text-sm font-medium text-gray-700 group-hover:text-blue-600 transition-colors">{{ $day }}</span>
                                    </label>
                                @endforeach
                            </div>
                            @error('availability') <span class="text-red-500 text-xs mt-0.5 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Status</label>
                            <select wire:model="status"
                                class="block w-full border-2 border-gray-200 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 px-3 py-2 text-sm transition-all">
                                <option value="active">Active</option>
                                <option value="on-leave">On Leave</option>
                                <option value="inactive">Inactive</option>
                            </select>
                            @error('status') <span class="text-red-500 text-xs mt-0.5 block">{{ $message }}</span> @enderror
                        </div>

                        <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200">
                            <button type="button" wire:click="closeModal"
                                class="px-5 py-2 rounded-lg border-2 border-gray-300 hover:bg-gray-50 font-semibold text-gray-700 text-sm transition-all duration-300 transform hover:scale-105">
                                Cancel
                            </button>

                            <button type="button" wire:click="{{ $isAddModalOpen ? 'saveDentist' : 'updateDentist' }}"
                                class="px-5 py-2 rounded-lg bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-700 hover:to-cyan-700 text-white font-semibold text-sm shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                                {{ $isAddModalOpen ? 'Add Dentist' : 'Save Changes' }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Delete Confirmation Modal -->
        @if($isDeleteModalOpen && $dentistToDelete)
            <div class="fixed inset-0 flex items-center justify-center z-50 p-4 animate-fade-in">
                <div class="bg-black/60 backdrop-blur-sm fixed inset-0" wire:click="closeDeleteModal"></div>

                <div class="bg-white rounded-2xl shadow-2xl p-6 w-full max-w-md z-10 animate-scale-in border border-gray-200 relative">
                    <div class="text-center">
                        <div class="mx-auto flex items-center justify-center h-14 w-14 rounded-full bg-red-100 mb-3">
                            <svg class="h-7 w-7 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Delete Dentist</h3>
                        <p class="text-sm text-gray-600 mb-1">Are you sure you want to delete</p>
                        <p class="text-base font-bold text-gray-900 mb-2">{{ $dentistToDelete->name }}?</p>
                        <p class="text-xs text-gray-500 mb-4">This action cannot be undone.</p>
                    </div>

                    <div class="flex space-x-3">
                        <button type="button" wire:click="closeDeleteModal"
                            class="flex-1 px-4 py-2 rounded-lg border-2 border-gray-300 hover:bg-gray-50 font-semibold text-gray-700 text-sm transition-all duration-300 transform hover:scale-105">
                            Cancel
                        </button>
                        <button type="button" wire:click="deleteDentist"
                            class="flex-1 px-4 py-2 rounded-lg bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-semibold text-sm shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                            Delete
                        </button>
                    </div>
                </div>
            </div>
        @endif

    </div>
</div>