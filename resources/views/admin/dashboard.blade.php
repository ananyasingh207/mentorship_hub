<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- User Stats -->
            <h3 class="text-lg font-semibold text-gray-900 mb-4">User Overview</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-sm font-medium text-gray-500 uppercase tracking-wide">Total Users</div>
                        <div class="mt-2 text-3xl font-bold text-gray-900">{{ $totalUsers }}</div>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-sm font-medium text-gray-500 uppercase tracking-wide">Total Startups</div>
                        <div class="mt-2 text-3xl font-bold text-blue-600">{{ $totalStartups }}</div>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-sm font-medium text-gray-500 uppercase tracking-wide">Total Mentors</div>
                        <div class="mt-2 text-3xl font-bold text-indigo-600">{{ $totalMentors }}</div>
                    </div>
                </div>
            </div>

            <!-- Mentor Stats -->
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Mentor Status</h3>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-sm font-medium text-gray-500 uppercase tracking-wide">Approved Mentors</div>
                        <div class="mt-2 text-3xl font-bold text-green-600">{{ $approvedMentors }}</div>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-sm font-medium text-gray-500 uppercase tracking-wide">Pending Mentors</div>
                        <div class="mt-2 text-3xl font-bold text-yellow-600">{{ $pendingMentors }}</div>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-sm font-medium text-gray-500 uppercase tracking-wide">Rejected Mentors</div>
                        <div class="mt-2 text-3xl font-bold text-red-600">{{ $rejectedMentors }}</div>
                    </div>
                </div>
            </div>

            <!-- Booking Stats -->
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Booking Overview</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-sm font-medium text-gray-500 uppercase tracking-wide">Total Bookings</div>
                        <div class="mt-2 text-3xl font-bold text-gray-900">{{ $totalBookings }}</div>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-sm font-medium text-gray-500 uppercase tracking-wide">Completed Sessions</div>
                        <div class="mt-2 text-3xl font-bold text-green-600">{{ $completedSessions }}</div>
                    </div>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Links</h3>
                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('admin.mentors.index') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 transition">
                            Manage Mentors
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
