<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mentor Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4">
                <a href="{{ route('mentors.index') }}" class="inline-flex items-center text-sm text-gray-600 hover:text-gray-900">
                    &larr; Back to Mentors
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8">
                    <div class="flex items-center justify-between border-b pb-6 mb-6">
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900">{{ $mentor->user->name }}</h1>
                            <p class="text-gray-500 mt-1">Mentor since {{ $mentor->created_at->format('F Y') }}</p>
                        </div>
                        <div class="text-right">
                            <span class="inline-block px-3 py-1 bg-indigo-100 text-indigo-800 font-semibold rounded-full text-sm">
                                {{ ucfirst($mentor->pricing) }}
                            </span>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-2">Expertise</h3>
                            <p class="text-gray-900 text-lg bg-gray-50 p-3 rounded-md">{{ $mentor->expertise }}</p>
                        </div>

                        <div>
                            <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-2">Experience</h3>
                            <p class="text-gray-900 text-lg bg-gray-50 p-3 rounded-md">{{ $mentor->experience }} years</p>
                        </div>

                        <div class="md:col-span-2">
                            <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-2">Availability</h3>
                            <p class="text-gray-900 text-lg bg-gray-50 p-3 rounded-md">{{ $mentor->availability }}</p>
                        </div>
                    </div>

                    @if(auth()->check() && auth()->user()->role === 'startup')
                        <div class="mt-10 pt-6 border-t">
                            @if($hasAcceptedRequest)
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">Book a Session</h3>
                                
                                @if(session('success'))
                                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                
                                @if(session('error'))
                                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                
                                @if($availableSlots->isEmpty())
                                    <p class="text-gray-500 bg-gray-50 p-4 rounded-md">This mentor has no available time slots at the moment. Please check back later.</p>
                                @else
                                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                                        @foreach($availableSlots as $slot)
                                            <div class="border rounded-lg p-4 bg-gray-50 flex flex-col justify-between">
                                                <div>
                                                    <p class="font-semibold text-gray-900">{{ $slot->date->format('l, M d, Y') }}</p>
                                                    <p class="text-sm text-gray-600 mt-1">
                                                        <svg class="inline-block w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                        {{ \Carbon\Carbon::parse($slot->start_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($slot->end_time)->format('h:i A') }}
                                                    </p>
                                                </div>
                                                <form action="{{ route('bookings.store', $slot) }}" method="POST" class="mt-4">
                                                    @csrf
                                                    <x-primary-button class="w-full justify-center py-2" onclick="return confirm('Are you sure you want to book this session?')">
                                                        {{ __('Book Slot') }}
                                                    </x-primary-button>
                                                </form>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            @else
                                <div class="flex justify-end">
                                    <a href="{{ route('startup.requests.create', $mentor) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        Request Mentorship
                                    </a>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
