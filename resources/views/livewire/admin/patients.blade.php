<div class="min-h-screen bg-gradient-to-br from-gray-50 via-blue-50 to-gray-100 pt-20">
    <!-- padding-top to match header -->

    <!-- Navbar -->
    <div class="mb-4 sm:mb-6">
        <livewire:admin.navbar />
    </div>

    <!-- Patients content -->
    <div class="max-w-7xl mx-auto p-6 space-y-6 bg-white rounded-2xl mt-5 shadow-md">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-gray-900 text-xl font-semibold">Patient Management</h2>
                <p class="text-sm text-gray-500">Manage and view all patient records</p>
            </div>

            {{-- Add Patient Button --}}
            <button wire:click="showAddForm"
                class="group bg-gradient-to-r from-blue-600 to-green-600 hover:from-blue-700 hover:to-green-700 text-white px-6 py-3 rounded-xl flex items-center space-x-2 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                <i class="bi bi-plus-lg"></i>
                <span>Add Patient</span>
            </button>
        </div>

        {{-- Search bar --}}
        <div class="relative w-full">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-5 h-5 absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
            </svg>

            <input type="text" placeholder="Search patients by name, email, or phone..."
                wire:model.debounce.300ms="searchQuery"
                class="w-full pl-10 border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        {{-- Patients Table --}}
        <div class="border rounded-lg overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Patient Name</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Contact</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Last Visit</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Next Appointment
                        </th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($patients as $patient)
                        <tr>
                            <td class="px-4 py-2 flex items-center space-x-3">
                                <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                    <span class="text-sm text-blue-600">
                                        {{ collect(explode(' ', $patient->user->name))->map(fn($n) => $n[0])->join('') }}
                                    </span>
                                </div>
                                <span class="text-gray-900">{{ $patient->user->name }}</span>
                            </td>
                            <td class="px-4 py-2 space-y-1">
                                <div class="flex items-center space-x-2 text-sm">
                                    <i class="bi bi-telephone text-gray-400 w-3 h-3"></i>
                                    <span class="text-gray-600">{{ $patient->contact_number ?? '-' }}</span>
                                </div>
                                <div class="flex items-center space-x-2 text-sm">
                                    <i class="bi bi-envelope text-gray-400 w-3 h-3"></i>
                                    <span class="text-gray-600">{{ $patient->user->email ?? '-' }}</span>
                                </div>
                            </td>
                            <td class="px-4 py-2 text-gray-600 text-sm">
                                {{ $patient->last_visit ? $patient->last_visit->format('Y-m-d') : '-' }}
                            </td>
                            <td class="px-4 py-2 text-gray-600 text-sm">
                                {{ $patient->next_appointment ? $patient->next_appointment->format('Y-m-d') : 'Not scheduled' }}
                            </td>
                            <td class="px-4 py-2">
                                <span
                                    class="inline-block px-2 py-1 rounded-full text-xs font-semibold whitespace-nowrap
                                        {{ $patient->status === 'active' ? 'bg-green-100 text-green-700' : ($patient->status === 'inactive' ? 'bg-red-100 text-red-700' : 'bg-yellow-100 text-yellow-700') }}">
                                    {{ ucfirst($patient->status ?? 'N/A') }}
                                </span>
                            </td>
                            <td class="px-4 py-2">
                                <button wire:click="viewPatient({{ $patient->id }})"
                                    class="px-2 py-1 text-xs border rounded hover:bg-gray-100 transition">
                                    View
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-6 text-center text-gray-400">No patients found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Add Patient Modal --}}
        @if($isAddModalOpen)
            <div class="fixed inset-0 flex items-center justify-center bg-black/30 backdrop-blur-sm z-[9999]">
                <div
                    class="bg-white rounded-2xl shadow-2xl w-full max-w-md mx-4 p-5 relative border border-gray-100 animate-fade-in">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4 text-left">Add New Patient</h3>

                    <div class="space-y-3">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                            <input wire:model.defer="name" type="text" placeholder="Enter patient name"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" />
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Gender</label>
                            <input wire:model.defer="gender" type="text" placeholder="Gender"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" />
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                            <input wire:model.defer="phone" type="text" placeholder="(555) 000-0000"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" />
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input wire:model.defer="email" type="email" placeholder="email@example.com"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" />
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                            <input wire:model.defer="address" type="text" placeholder="Street address"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" />
                        </div>
                    </div>

                    <div class="flex justify-end space-x-3 pt-5">
                        <button wire:click="closeAddForm"
                            class="px-4 py-2 rounded-lg border border-gray-300 bg-white hover:bg-gray-100 text-gray-700 font-medium transition">
                            Cancel
                        </button>
                        <button wire:click="addPatient"
                            class="px-4 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white font-medium transition">
                            Add Patient
                        </button>
                    </div>
                </div>
            </div>
        @endif

        {{-- View / Edit / Delete Modal --}}
        @if($isViewModalOpen)
            <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/30 backdrop-blur-sm">
                <div class="bg-white rounded-2xl w-full max-w-md mx-4 p-6 animate-fade-in max-h-[90vh] overflow-y-auto">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-semibold text-gray-800">Patient Details</h3>
                        @if($isEditMode)
                            <span class="text-sm text-gray-500">Editing</span>
                        @endif
                    </div>

                    <div class="flex items-center space-x-4 mb-4">
                        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center">
                            <span class="text-xl text-blue-600">
                                {{ collect(explode(' ', $selectedPatient->user->name))->map(fn($n) => $n[0])->join('') }}
                            </span>
                        </div>
                        <div>
                            @if($isEditMode)
                                <input type="text" wire:model.defer="name" class="border rounded px-2 py-1 w-full" />
                            @else
                                <h3 class="text-gray-900">{{ $selectedPatient->user->name }}</h3>
                                <p class="text-sm text-gray-500">{{ $selectedPatient->gender ?? '-' }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="space-y-2">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Phone:</span>
                            @if($isEditMode)
                                <input type="text" wire:model.defer="phone" class="border rounded px-2 py-1 w-32" />
                            @else
                                <span class="text-gray-900">{{ $selectedPatient->contact_number ?? '-' }}</span>
                            @endif
                        </div>

                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Email:</span>
                            @if($isEditMode)
                                <input type="email" wire:model.defer="email" class="border rounded px-2 py-1 w-48" />
                            @else
                                <span class="text-gray-900">{{ $selectedPatient->user->email ?? '-' }}</span>
                            @endif
                        </div>

                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Address:</span>
                            @if($isEditMode)
                                <input type="text" wire:model.defer="address" class="border rounded px-2 py-1 w-48" />
                            @else
                                <span class="text-gray-900">{{ $selectedPatient->address ?? '-' }}</span>
                            @endif
                        </div>

                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Status:</span>
                            @if($isEditMode)
                                <select wire:model.defer="status" class="border rounded px-2 py-1">
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                    <option value="pending">Pending</option>
                                </select>
                            @else
                                <span
                                    class="inline-block px-2 py-1 rounded-full text-xs font-semibold whitespace-nowrap
                                {{ $selectedPatient->status === 'active' ? 'bg-green-100 text-green-700' : ($selectedPatient->status === 'inactive' ? 'bg-red-100 text-red-700' : 'bg-yellow-100 text-yellow-700') }}">
                                    {{ ucfirst($selectedPatient->status ?? 'N/A') }}
                                </span>
                            @endif
                        </div>

                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Last Visit:</span>
                            <span class="text-gray-900">
                                {{ $selectedPatient->last_visit ? $selectedPatient->last_visit->format('Y-m-d') : '-' }}
                            </span>
                        </div>

                        <div class="flex justify-between text-sm mb-3">
                            <span class="text-gray-600">Next Appointment:</span>
                            <span class="text-gray-900">
                                {{ $selectedPatient->next_appointment ? $selectedPatient->next_appointment->format('Y-m-d') : 'Not scheduled' }}
                            </span>
                        </div>

                        {{-- 🦷 Scheduled Appointments Section --}}
                        <div class="mt-4">
                            <h4 class="text-md font-semibold text-gray-800 mb-2">Scheduled Appointments</h4>

                            @if($selectedPatient->appointments->count())
                                <div class="space-y-2 max-h-56 overflow-y-auto">
                                    @foreach($selectedPatient->appointments as $apt)
                                        <div class="p-3 bg-gray-50 rounded-lg border hover:bg-blue-50 transition">
                                            <div class="flex justify-between items-center">
                                                <div>
                                                    <p class="text-sm font-medium text-gray-900">
                                                        {{ $apt->services->pluck('name')->join(', ') ?: 'No services listed' }}
                                                    </p>
                                                    <p class="text-xs text-gray-500">
                                                        Dentist: {{ $apt->dentist->name ?? 'N/A' }}
                                                    </p>
                                                    <p class="text-xs text-gray-500">
                                                        Date:
                                                        {{ \Carbon\Carbon::parse($apt->appointment_date)->format('M d, Y h:i A') }}
                                                    </p>
                                                </div>
                                                <span class="text-xs px-2 py-1 rounded-full
                                                    @if($apt->status == 'scheduled') bg-gray-100 text-gray-700
                                                    @elseif($apt->status == 'confirmed') bg-green-100 text-green-700
                                                    @elseif($apt->status == 'completed') bg-blue-100 text-blue-700
                                                    @elseif($apt->status == 'cancelled') bg-red-100 text-red-700
                                                    @endif">
                                                    {{ ucfirst($apt->status) }}
                                                </span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-sm text-gray-500 italic">No scheduled appointments.</p>
                            @endif
                        </div>
                    </div>

                    <div class="flex justify-end space-x-2 pt-4">
                        @if($isEditMode)
                            <button wire:click="updatePatient" class="px-4 py-2 bg-blue-600 text-white rounded">Save</button>
                            <button wire:click="$set('isEditMode', false)" class="px-4 py-2 border rounded">Cancel</button>
                        @else
                            <button wire:click="enableEdit" class="px-4 py-2 bg-yellow-400 text-white rounded">Edit</button>
                            <button wire:click="deletePatient({{ $selectedPatient->id }})"
                                class="px-4 py-2 bg-red-600 text-white rounded">Delete</button>
                            <button wire:click="closeModal" class="px-4 py-2 border rounded">Close</button>
                        @endif
                    </div>
                </div>
            </div>
        @endif


    </div>
</div>