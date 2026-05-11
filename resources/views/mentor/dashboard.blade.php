<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mentor Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Profile Status Banner -->
            @if(auth()->user()->mentorProfile)
                @if(auth()->user()->mentorProfile->status === 'pending')
                    <div class="mb-6 p-4 text-sm text-yellow-800 rounded-lg bg-yellow-50 border border-yellow-200" role="alert">
                        <span class="font-medium">Notice!</span> Your profile is under admin review.
                    </div>
                @elseif(auth()->user()->mentorProfile->status === 'approved')
                    <div class="mb-6 p-4 text-sm text-green-800 rounded-lg bg-green-50 border border-green-200" role="alert">
                        <span class="font-medium">Success!</span> Your profile has been approved.
                    </div>
                @elseif(auth()->user()->mentorProfile->status === 'rejected')
                    <div class="mb-6 p-4 text-sm text-red-800 rounded-lg bg-red-50 border border-red-200" role="alert">
                        <span class="font-medium">Alert!</span> Your profile has been rejected.
                    </div>
                @endif
            @endif

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-sm font-medium text-gray-500 uppercase tracking-wide">Pending Requests</div>
                        <div class="mt-2 text-3xl font-bold text-yellow-600">{{ $incomingRequests }}</div>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-sm font-medium text-gray-500 uppercase tracking-wide">Total Bookings</div>
                        <div class="mt-2 text-3xl font-bold text-blue-600">{{ $totalBookings }}</div>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-sm font-medium text-gray-500 uppercase tracking-wide">Completed Sessions</div>
                        <div class="mt-2 text-3xl font-bold text-green-600">{{ $completedSessions }}</div>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-sm font-medium text-gray-500 uppercase tracking-wide">Average Rating</div>
                        <div class="mt-2 flex items-baseline">
                            <span class="text-3xl font-bold text-indigo-600">{{ number_format($averageRating, 1) }}</span>
                            <span class="ml-1 text-lg text-gray-400">/ 5</span>
                            <span class="ml-2 text-sm text-gray-500">({{ $reviewCount }} {{ Str::plural('review', $reviewCount) }})</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Links</h3>
                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('mentor.requests.index') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 transition">
                            View Requests
                        </a>
                        <a href="{{ route('mentor.slots.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-50 transition">
                            Manage Slots
                        </a>
                        <a href="{{ route('mentor.bookings.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-50 transition">
                            My Bookings
                        </a>
                        <a href="{{ route('mentor.reviews.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-50 transition">
                            My Reviews
                        </a>
                        <a href="{{ route('messages.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-50 transition">
                            Messages
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
