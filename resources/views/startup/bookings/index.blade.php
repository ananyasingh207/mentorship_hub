<x-app-layout :hideNav="true">
    <div class="min-h-screen bg-gray-50/80">
        <x-startup-navbar />

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if (session('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex items-center justify-between mb-10">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900 tracking-tight mb-1">My Mentorship Sessions</h1>
                            <p class="text-sm text-gray-500 font-medium">Manage your scheduled and past sessions with mentors</p>
                        </div>
                        @if(!$bookings->isEmpty())
                            <span class="px-4 py-1.5 bg-indigo-50 text-indigo-600 text-[10px] font-bold rounded-full uppercase tracking-widest">{{ $bookings->count() }} Total</span>
                        @endif
                    </div>

                    @if($bookings->isEmpty())
                        <div class="text-center py-20 bg-gray-50/50 rounded-[2px] border border-dashed border-gray-200">
                            <div class="h-16 w-16 bg-white rounded-full flex items-center justify-center shadow-sm border border-gray-100 mx-auto mb-4">
                                <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 00-2 2z"></path></svg>
                            </div>
                            <p class="text-sm font-bold text-gray-400 tracking-tight mb-4">No sessions booked yet</p>
                            <a href="{{ route('mentors.index') }}" class="text-sm font-bold text-[#006B52] hover:underline inline-flex items-center gap-1">
                                Book a session with a mentor
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </a>
                        </div>
                    @else
                        <div class="space-y-4">
                            @foreach($bookings as $booking)
                                <div class="bg-white border border-gray-200 rounded-[2px] p-6 flex items-center justify-between hover:shadow-md transition-all duration-300">
                                    <div class="flex items-center gap-6">
                                        <div class="h-14 w-14 rounded-full bg-indigo-100 flex-shrink-0 flex items-center justify-center text-indigo-700 font-bold text-base uppercase shadow-inner">
                                            {{ substr($booking->mentor->name, 0, 1) }}{{ str_contains($booking->mentor->name, ' ') ? substr(explode(' ', $booking->mentor->name)[1], 0, 1) : '' }}
                                        </div>
                                        <div>
                                            <div class="flex items-center gap-3 mb-1.5">
                                                <h4 class="text-lg font-bold text-gray-900 tracking-tight">{{ $booking->mentor->name }}</h4>
                                                @if($booking->mentor->mentorProfile && $booking->mentor->mentorProfile->expertise)
                                                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] bg-gray-50 px-2 py-0.5 rounded-full">{{ $booking->mentor->mentorProfile->expertise }}</span>
                                                @endif
                                            </div>
                                            <div class="flex items-center gap-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">
                                                <div class="flex items-center gap-1.5">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 00-2 2z"></path></svg>
                                                    {{ $booking->timeSlot->date->format('M d, Y') }}
                                                </div>
                                                <span>•</span>
                                                <div class="flex items-center gap-1.5">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                    {{ \Carbon\Carbon::parse($booking->timeSlot->start_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($booking->timeSlot->end_time)->format('h:i A') }}
                                                </div>
                                            </div>
                                            <div class="flex items-center gap-1.5 {{ $booking->status === 'completed' ? 'text-green-600' : ($booking->status === 'cancelled' ? 'text-red-600' : 'text-blue-600') }} text-[10px] font-bold uppercase tracking-widest">
                                                <span class="h-1.5 w-1.5 rounded-full {{ $booking->status === 'completed' ? 'bg-green-600' : ($booking->status === 'cancelled' ? 'bg-red-600' : 'bg-blue-600') }}"></span>
                                                {{ ucfirst($booking->status) }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex items-center gap-4">
                                        @if($booking->status === 'scheduled')
                                            <form action="{{ route('startup.bookings.cancel', $booking) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="px-6 py-3 border border-red-200 text-red-600 text-[10px] font-bold rounded-[2px] hover:bg-red-50 transition-all uppercase tracking-widest" onclick="return confirm('Cancel this session?')">
                                                    Cancel
                                                </button>
                                            </form>
                                        @endif
                                        <a href="{{ route('messages.show', $booking->mentor_id) }}" class="px-6 py-3 bg-indigo-50 text-indigo-600 text-[10px] font-bold rounded-[2px] hover:bg-indigo-100 transition-all uppercase tracking-widest shadow-sm">
                                            Message
                                        </a>
                                        @if($booking->status === 'completed')
                                            <a href="{{ route('reviews.create', $booking->mentor_id) }}" class="px-6 py-3 bg-[#006B52] text-white text-[10px] font-bold rounded-[2px] hover:bg-[#005a45] transition-all uppercase tracking-widest shadow-sm">
                                                Review
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
