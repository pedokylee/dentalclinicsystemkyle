<div class="min-h-screen bg-gray-100 pt-20"> <!-- padding-top to match header -->

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
                class="flex items-center space-x-2 px-3 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition">
                <i class="bi bi-plus-lg"></i>
                <span>Add Patient</span>
            </button>
        </div>

        {{-- Search bar --}}
        <div class="relative w-full">
            <!-- Search icon -->
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
                                        {{ collect(explode(' ', $patient->name))->map(fn($n) => $n[0])->join('') }}
                                    </span>
                                </div>
                                <span class="text-gray-900">{{ $patient->name }}</span>
                            </td>
                            <td class="px-4 py-2 space-y-1">
                                <div class="flex items-center space-x-2 text-sm">
                                    <i class="bi bi-telephone text-gray-400 w-3 h-3"></i>
                                    <span class="text-gray-600">{{ $patient->phone ?? '-' }}</span>
                                </div>
                                <div class="flex items-center space-x-2 text-sm">
                                    <i class="bi bi-envelope text-gray-400 w-3 h-3"></i>
                                    <span class="text-gray-600">{{ $patient->email ?? '-' }}</span>
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
                                    class="px-2 py-1 rounded-full text-xs font-semibold
                                             {{ $patient->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-gray-200 text-gray-700' }}">
                                    {{ $patient->status }}
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

        @if($isAddModalOpen)
    <div class="fixed inset-0 flex items-center justify-center z-50">
        <div class="bg-white border border-gray-200 rounded-2xl shadow-2xl p-6 w-full max-w-lg mx-4 text-center animate-fade-in">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">Add New Patient</h3>

            <div class="space-y-3 text-left">
                <input wire:model.defer="name" type="text" placeholder="Full Name"
                    class="w-full border rounded px-3 py-2" />
                <input wire:model.defer="gender" type="text" placeholder="Gender"
                    class="w-full border rounded px-3 py-2" />
                <input wire:model.defer="phone" type="text" placeholder="Phone"
                    class="w-full border rounded px-3 py-2" />
                <input wire:model.defer="email" type="email" placeholder="Email"
                    class="w-full border rounded px-3 py-2" />
                <input wire:model.defer="address" type="text" placeholder="Address"
                    class="w-full border rounded px-3 py-2" />
            </div>

            <div class="flex justify-center space-x-4 pt-4">
                <button wire:click="closeAddForm"
                    class="bg-gray-100 hover:bg-gray-200 text-gray-800 px-5 py-2 rounded-lg font-medium transition">
                    Cancel
                </button>
                <button wire:click="addPatient"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg font-medium transition">
                    Add Patient
                </button>
            </div>
        </div>
    </div>
@endif


        {{-- Patient Details Modal --}}
        @if($selectedPatient)
            <div class="fixed inset-0 z-50 flex items-center justify-center backdrop-blur-sm">
                <div class="bg-white rounded-lg p-6 w-full max-w-lg">
                    <h3 class="text-lg font-semibold mb-4">Patient Details</h3>
                    <div class="flex items-center space-x-4 mb-4">
                        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center">
                            <span class="text-xl text-blue-600">
                                {{ collect(explode(' ', $selectedPatient->name))->map(fn($n) => $n[0])->join('') }}
                            </span>
                        </div>
                        <div>
                            <h3 class="text-gray-900">{{ $selectedPatient->name }}</h3>
                            <p class="text-sm text-gray-500">{{ $selectedPatient->gender ?? '-' }}</p>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Phone:</span>
                            <span class="text-gray-900">{{ $selectedPatient->phone ?? '-' }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Email:</span>
                            <span class="text-gray-900">{{ $selectedPatient->email ?? '-' }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Last Visit:</span>
                            <span class="text-gray-900">
                                {{ $selectedPatient->last_visit ? $selectedPatient->last_visit->format('Y-m-d') : '-' }}
                            </span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Next Appointment:</span>
                            <span class="text-gray-900">
                                {{ $selectedPatient->next_appointment ? $selectedPatient->next_appointment->format('Y-m-d') : 'Not scheduled' }}
                            </span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Status:</span>
                            <span
                                class="px-2 py-1 rounded-full text-xs font-semibold
                                         {{ $selectedPatient->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-gray-200 text-gray-700' }}">
                                {{ $selectedPatient->status }}
                            </span>
                        </div>
                    </div>

                    <div class="flex justify-end pt-4">
                        <button wire:click="closeModal" class="px-3 py-1 border rounded">Close</button>
                    </div>
                </div>
            </div>
        @endif

    </div>
</div>
