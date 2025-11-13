<div class="min-h-screen bg-gradient-to-br from-gray-50 via-blue-50 to-gray-100 pt-20"> <!-- padding-top to match header -->

    <!-- Navbar -->
    <div class="mb-4 sm:mb-6">  
        <livewire:admin.navbar />
    </div>

    <!-- Dashboard content -->
    <div class="max-w-7xl mx-auto p-6 space-y-6 bg-white rounded-2xl mt-5 shadow-md">

        {{-- Stats Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($stats as $stat)
                <div class="bg-white rounded-2xl shadow-md p-6 flex justify-between items-center transition-all duration-300">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">{{ $stat['title'] }}</p>
                        <p class="text-gray-900 text-lg font-semibold">{{ $stat['value'] }}</p>
                        <p class="text-xs text-gray-500 mt-1">{{ $stat['change'] }}</p>
                    </div>
                    <div class="{{ $stat['bgColor'] }} {{ $stat['color'] }} p-3 rounded-lg flex items-center justify-center">
                        @switch($stat['icon'])
                            @case('users')
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                     stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                                </svg>
                                @break

                            @case('calendar')
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                     stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                                </svg>
                                @break

                            @case('dollar-sign')
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                     stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                                @break

                            @case('briefcase')
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                     stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0M12 12.75h.008v.008H12v-.008Z" />
                                </svg>
                                @break

                            @case('user-cog')
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                     stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                </svg>
                                @break
                        @endswitch
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Two-column section: Appointments & Recent Activity --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-6">

    {{-- Today's Appointments --}}
    <div class="bg-white rounded-2xl shadow-md lg:col-span-1">
        <div class="p-6 border-b">
            <h3 class="text-lg font-semibold text-gray-900">Today's Appointments</h3>
        </div>
        <div class="p-6 space-y-4">
            @forelse ($todayAppointments as $appointment)
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                    <div>
                        <p class="font-medium text-gray-900">{{ $appointment['patient'] }}</p>
                        <p class="text-sm text-gray-500">{{ $appointment['time'] }} • {{ $appointment['type'] }}</p>
                    </div>
                    <span class="px-3 py-1 rounded-full text-xs font-semibold 
                        {{ $appointment['status'] === 'scheduled' ? 'bg-blue-100 text-blue-700' : 'bg-gray-200 text-gray-700' }}">
                        {{ ucfirst($appointment['status']) }}
                    </span>
                </div>
            @empty
                <p class="text-gray-500 text-sm">No appointments today.</p>
            @endforelse
        </div>
    </div>

    {{-- Upcoming Appointments --}}
    <div class="bg-white rounded-2xl shadow-md lg:col-span-1">
        <div class="p-6 border-b">
            <h3 class="text-lg font-semibold text-gray-900">Upcoming Appointments</h3>
        </div>
        <div class="p-6 space-y-4">
            @forelse ($upcomingAppointments as $appointment)
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                    <div>
                        <p class="font-medium text-gray-900">{{ $appointment['patient'] }}</p>
                        <p class="text-sm text-gray-500">{{ $appointment['date'] }} • {{ $appointment['time'] }}</p>
                    </div>
                    <span class="px-3 py-1 rounded-full text-xs font-semibold 
                        {{ $appointment['status'] === 'scheduled' ? 'bg-green-100 text-green-700' : 'bg-gray-200 text-gray-700' }}">
                        {{ ucfirst($appointment['status']) }}
                    </span>
                </div>
            @empty
                <p class="text-gray-500 text-sm">No upcoming appointments.</p>
            @endforelse
        </div>
    </div>

    {{-- Recent Activity --}}
    <div class="bg-white rounded-2xl shadow-md lg:col-span-1">
        <div class="p-6 border-b">
            <h3 class="text-lg font-semibold text-gray-900">Recent Activity</h3>
        </div>
        <div class="p-6 space-y-4">
            @foreach ($recentActivity as $activity)
                <div class="flex items-start space-x-3">
                    <div class="w-2 h-2 bg-blue-600 rounded-full mt-2"></div>
                    <div class="flex-1">
                        <p class="text-sm text-gray-900">{{ $activity['action'] }}</p>
                        <p class="text-sm text-gray-600">{{ $activity['patient'] }}</p>
                        <p class="text-xs text-gray-400 mt-1">{{ $activity['time'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

    </div>

</div>
