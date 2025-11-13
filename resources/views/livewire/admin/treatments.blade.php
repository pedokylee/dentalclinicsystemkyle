<div class="min-h-screen bg-gradient-to-br from-gray-50 via-blue-50 to-gray-100 pt-20">

    <div class="mb-4 sm:mb-6">
        <livewire:admin.navbar />
    </div>

    <div class="max-w-7xl mx-auto p-6 space-y-6">

        {{-- Header Stats --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-white rounded-2xl shadow p-4">
                <p class="text-sm text-gray-600 mb-1">Total Treatments</p>
                <p class="text-gray-900 font-semibold">{{ $treatments->count() }}</p>
            </div>
            <div class="bg-white rounded-2xl shadow p-4">
                <p class="text-sm text-gray-600 mb-1">Completed</p>
                <p class="text-gray-900 font-semibold">{{ $completedCount }}</p>
                <p class="text-xs text-gray-500">{{ $inProgressCount }} in progress</p>
            </div>
            <div class="bg-white rounded-2xl shadow p-4">
                <p class="text-sm text-gray-600 mb-1">Total Revenue</p>
                <p class="text-gray-900 font-semibold">₱{{ number_format($totalRevenue, 2) }}</p>
            </div>
        </div>

        {{-- Search --}}
        <div class="mt-6">
            <input type="text" wire:model.live.debounce.300ms="searchQuery" placeholder="Search by patient or procedure..."
                class="w-full border rounded-xl px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
        </div>

        {{-- Filters --}}
        <div class="mt-4 flex items-center space-x-4">
            {{-- Date Filter --}}
            <div>
                <label class="text-sm font-semibold text-gray-700">Filter by Date</label>
                <input type="date" wire:model.live="filterDate"
                    class="border rounded-xl px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            {{-- Status Filter --}}
            <div>
                <label class="text-sm font-semibold text-gray-700">Filter by Status</label>
                <select wire:model.live="filterStatus"
                    class="border rounded-xl px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="">All</option>
                    <option value="scheduled">Scheduled</option>
                    <option value="in-progress">In-progress</option>
                    <option value="completed">Completed</option>
                    <option value="cancelled">Cancelled</option>
                </select>
            </div>

            {{-- Clear filters --}}
            <button wire:click="clearFilters"
                class="px-3 py-2 bg-gray-200 text-gray-700 rounded-lg text-sm hover:bg-gray-300 transition">
                Clear
            </button>
        </div>

        {{-- Treatments Table --}}
        <div class="border rounded-lg overflow-x-auto mt-4 bg-white">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Patient</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Procedure</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Dentist</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Cost</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($treatments as $treatment)
                        <tr>
                            <td class="px-4 py-2 text-gray-600">{{ \Carbon\Carbon::parse($treatment->date)->format('Y-m-d') }}</td>
                            <td class="px-4 py-2">{{ $treatment->patient->user->name ?? 'N/A' }}</td>
                            <td class="px-4 py-2">{{ $treatment->procedure }}</td>
                            <td class="px-4 py-2">{{ $treatment->dentist->name ?? 'N/A' }}</td>
                            <td class="px-4 py-2">₱{{ number_format($treatment->cost, 2) }}</td>
                            <td class="px-4 py-2">
                                <span class="inline-block px-2 py-1 rounded-full text-xs
                                    @if($treatment->status === 'completed') bg-green-100 text-green-700
                                    @elseif($treatment->status === 'in-progress') bg-yellow-100 text-yellow-700
                                    @elseif($treatment->status === 'scheduled') bg-gray-100 text-gray-700
                                    @elseif($treatment->status === 'cancelled') bg-red-300 text-gray-700
                                    @endif">
                                    {{ ucfirst($treatment->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-2">
                                <select wire:change="updateStatus({{ $treatment->id }}, $event.target.value)"
                                    class="border rounded px-2 py-1 text-sm">
                                    <option value="scheduled" @selected($treatment->status === 'scheduled')>Scheduled</option>
                                    <option value="in-progress" @selected($treatment->status === 'in-progress')>On-going</option>
                                    <option value="completed" @selected($treatment->status === 'completed')>Completed</option>
                                    <option value="cancelled" @selected($treatment->status === 'cancelled')>Cancelled</option>
                                </select>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-6 text-center text-gray-400">No treatments found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

    {{-- Treatment Details Modal --}}
    @if($selectedTreatment)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl p-8 max-h-[90vh] overflow-y-auto">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold text-gray-800">Treatment Details</h2>
                    <button wire:click="closeModal" class="text-gray-500 hover:text-gray-800 transition">✕</button>
                </div>
                <div class="space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-600">Date</p>
                            <p class="text-gray-900">{{ \Carbon\Carbon::parse($selectedTreatment->date)->format('Y-m-d') }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Status</p>
                            <span class="inline-block px-2 py-1 rounded-full text-xs
                                @if($selectedTreatment->status === 'completed') bg-green-100 text-green-700
                                @elseif($selectedTreatment->status === 'in-progress') bg-yellow-100 text-yellow-700
                                @elseif($selectedTreatment->status === 'scheduled') bg-gray-100 text-gray-700
                                @endif">
                                {{ ucfirst($selectedTreatment->status) }}
                            </span>
                        </div>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Patient</p>
                        <p class="text-gray-900">{{ $selectedTreatment->patient->user->name ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Procedure</p>
                        <p class="text-gray-900">{{ $selectedTreatment->procedure }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Dentist</p>
                        <p class="text-gray-900">{{ $selectedTreatment->dentist->name ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Cost</p>
                        <p class="text-gray-900">₱{{ number_format($selectedTreatment->cost, 2) }}</p>
                    </div>
                    <div class="border-t pt-4">
                        <p class="text-sm text-gray-600 mb-2">Notes</p>
                        <p class="text-sm text-gray-900 bg-gray-50 p-3 rounded-lg">{{ $selectedTreatment->notes }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endif

</div>