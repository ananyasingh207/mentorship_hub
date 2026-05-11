<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Startup Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-sm font-medium text-gray-500 uppercase tracking-wide">Total Requests</div>
                        <div class="mt-2 text-3xl font-bold text-gray-900">{{ $totalRequests }}</div>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-sm font-medium text-gray-500 uppercase tracking-wide">Accepted Mentors</div>
                        <div class="mt-2 text-3xl font-bold text-green-600">{{ $acceptedMentors }}</div>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-sm font-medium text-gray-500 uppercase tracking-wide">Upcoming Bookings</div>
                        <div class="mt-2 text-3xl font-bold text-blue-600">{{ $upcomingBookings }}</div>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-sm font-medium text-gray-500 uppercase tracking-wide">Completed Sessions</div>
                        <div class="mt-2 text-3xl font-bold text-indigo-600">{{ $completedSessions }}</div>
                    </div>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Links</h3>
                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('mentors.index') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 transition">
                            Browse Mentors
                        </a>
                        <a href="{{ route('startup.requests.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-50 transition">
                            My Requests
                        </a>
                        <a href="{{ route('startup.bookings.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-50 transition">
                            My Bookings
                        </a>
                        <a href="{{ route('messages.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-50 transition">
                            Messages
                        </a>
                    </div>
                </div>
            </div>

            <!-- Recommended Mentors -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Recommended Mentors</h3>

                    @if($recommendedMentors->isEmpty())
                        <p class="text-gray-500">No mentor recommendations available yet. Complete your startup profile to get matched!</p>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            @foreach($recommendedMentors as $mentor)
                                <div class="border rounded-lg p-4 hover:shadow-md transition-shadow">
                                    <div class="flex justify-between items-start mb-3">
                                        <div>
                                            <h4 class="font-bold text-gray-900">{{ $mentor->user->name }}</h4>
                                            <p class="text-sm text-gray-500">{{ $mentor->expertise }}</p>
                                        </div>
                                        <span class="px-2 py-1 bg-green-100 text-green-800 text-xs font-bold rounded-full">
                                            {{ $mentor->match_score }}% Match
                                        </span>
                                    </div>
                                    <p class="text-sm text-gray-600 mb-3">{{ $mentor->experience }} years experience</p>
                                    
                                    <!-- Match Progress Bar -->
                                    <div class="w-full bg-gray-200 rounded-full h-2 mb-3">
                                        <div class="bg-green-500 h-2 rounded-full" style="width: {{ $mentor->match_score }}%"></div>
                                    </div>

                                    <a href="{{ route('mentors.show', $mentor->id) }}" class="text-sm text-indigo-600 hover:underline font-medium">
                                        View Profile &rarr;
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
