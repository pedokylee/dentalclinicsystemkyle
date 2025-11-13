<div class="min-h-screen bg-gradient-to-br from-gray-50 via-blue-50 to-gray-100 pt-20">
    <div class="mb-4 sm:mb-6">
        <livewire:admin.navbar />
    </div>

    <div class="max-w-7xl mx-auto p-6 space-y-6">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- Calendar & Add Appointment --}}
            <div class="lg:col-span-1">
                <div class="bg-white shadow-md rounded-2xl p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-gray-800">Select Date</h3>
                        <button wire:click="openModal"
                            class="group bg-gradient-to-r from-blue-600 to-green-600 hover:from-blue-700 hover:to-green-700 text-white px-6 py-3 rounded-xl flex items-center space-x-2 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                            New
                        </button>
                    </div>

                    <input type="date" wire:model.live="selectedDate"
                        class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">

                    <div class="mt-4 p-3 bg-blue-50 rounded-lg">
                        <p class="text-sm text-blue-900">
                            {{ count($appointments) }} appointment(s) on this date
                        </p>
                    </div>
                </div>
            </div>

            {{-- Appointment List --}}
            <div class="lg:col-span-2">
                <div class="mb-4">
                    <h3 class="text-xl font-semibold text-gray-800">
                        Appointments for {{ \Carbon\Carbon::parse($selectedDate)->toFormattedDateString() }}
                    </h3>
                    <p class="text-sm text-gray-500">View and manage scheduled appointments</p>
                </div>

                @if($appointments->isEmpty())
                    <div class="bg-white rounded-2xl shadow p-8 text-center">
                        <p class="text-gray-500 mb-3">No appointments scheduled for this date</p>
                        <button wire:click="openModal"
                            class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-100 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                            Schedule Appointment
                        </button>
                    </div>
                @else
                    <div class="space-y-3">
                        @foreach($appointments as $apt)
                            <div class="bg-white rounded-xl shadow p-4 hover:shadow-lg transition">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-4">
                                        <div class="text-center bg-blue-50 rounded-lg p-3">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="w-5 h-5 text-blue-600 mb-1 mx-auto" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M12 8v4l3 3m6 1a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <p class="text-sm text-gray-900">
                                                {{ \Carbon\Carbon::parse($apt->appointment_date)->format('h:i A') }}
                                            </p>
                                        </div>

                                        <div>
                                            <div class="flex items-center space-x-2 mb-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.655 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                                </svg>
                                                <span class="text-gray-900 font-medium">
                                                    {{ $apt->patient->user->name ?? 'N/A' }}
                                                </span>
                                            </div>

                                            {{-- Show multiple services --}}
                                            <p class="text-sm text-gray-600">
                                                {{ $apt->services->pluck('name')->join(', ') ?: 'No services selected' }}
                                            </p>

                                            <p class="text-xs text-gray-500 mt-1">
                                                {{ $apt->dentist->name ?? 'N/A' }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="flex items-center space-x-3">
                                        <span
                                            class="px-3 py-1 rounded-full text-xs capitalize
                                            @if($apt->status == 'confirmed') bg-green-100 text-green-700
                                            @elseif($apt->status == 'scheduled') bg-gray-100 text-gray-700
                                            @elseif($apt->status == 'completed') bg-blue-100 text-blue-700
                                            @elseif($apt->status == 'cancelled') bg-red-100 text-red-700
                                            @endif">
                                            {{ $apt->status }}
                                        </span>

                                        <div class="flex space-x-2">
                                            <button wire:click="openModal({{ $apt->id }})"
                                                class="px-3 py-1 border rounded-lg text-sm text-blue-600 hover:bg-blue-50 hover:border-blue-400 transition">
                                                Edit
                                            </button>
                                            <button wire:click="delete({{ $apt->id }})"
                                                class="px-3 py-1 border rounded-lg text-sm text-red-600 hover:bg-red-50 hover:border-red-400 transition">
                                                Delete
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Add/Edit Appointment Modal --}}
    @if($isModalOpen)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-3xl p-8 overflow-y-auto max-h-[90vh]">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold text-gray-800">
                        {{ $isEditMode ? 'Edit Appointment' : 'New Appointment' }}
                    </h2>
                    <button wire:click="closeModal"
                        class="text-gray-500 hover:text-gray-800 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Left side: appointment info --}}
                    <div class="space-y-5">
                        {{-- Patient --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Patient</label>
                            <select wire:model="patient_id"
                                class="w-full border rounded-xl px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                                <option value="">Select patient</option>
                                @foreach($patients as $patient)
                                    <option value="{{ $patient->id }}">{{ $patient->user->name }}</option>
                                @endforeach
                            </select>
                            @error('patient_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- Dentist --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Dentist</label>
                            <select wire:model="dentist_id"
                                class="w-full border rounded-xl px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                                <option value="">Select dentist</option>
                                @foreach($dentists as $dentist)
                                    <option value="{{ $dentist->id }}">{{ $dentist->name }}</option>
                                @endforeach
                            </select>
                            @error('dentist_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- Date --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                            <input type="date" wire:model="date"
                                class="w-full border rounded-xl px-4 py-2 focus:ring-2 focus:ring-blue-500">
                            @error('date') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- Time --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Time</label>
                            <input type="time" wire:model="time"
                                class="w-full border rounded-xl px-4 py-2 focus:ring-2 focus:ring-blue-500">
                            @error('time') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- Notes --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Notes</label>
                            <textarea wire:model="notes" rows="3"
                                class="w-full border rounded-xl px-4 py-2 focus:ring-2 focus:ring-blue-500 resize-none"
                                placeholder="Optional notes about this appointment..."></textarea>
                            @error('notes') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    {{-- Right side: Services --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Select Services</label>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 max-h-[320px] overflow-y-auto pr-1">
                            @foreach($services as $service)
                                <label
                                    class="flex items-start border rounded-xl p-3 cursor-pointer hover:border-blue-500 transition {{ in_array($service->id, $service_ids) ? 'border-blue-500 bg-blue-50' : 'border-gray-200' }}">
                                    <input type="checkbox" value="{{ $service->id }}" wire:model="service_ids"
                                        class="mt-1 mr-3 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                    <div>
                                        <p class="font-medium text-gray-800">{{ $service->name }}</p>
                                        <p class="text-xs text-gray-500 mt-1">{{ $service->description }}</p>
                                        <p class="text-xs text-blue-600 font-semibold mt-1">
                                            ₱{{ number_format($service->price, 2) }}
                                        </p>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                        @error('service_ids') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                {{-- Footer --}}
                <div class="flex justify-end mt-8 space-x-3 border-t pt-4">
                    <button wire:click="closeModal"
                        class="px-4 py-2 rounded-lg border hover:bg-gray-100 transition">
                        Cancel
                    </button>
                    <button wire:click="save"
                        class="px-6 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white font-medium transition">
                        {{ $isEditMode ? 'Update Appointment' : 'Save Appointment' }}
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
