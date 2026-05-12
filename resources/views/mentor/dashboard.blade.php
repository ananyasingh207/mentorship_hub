<x-app-layout :hideNav="true">
    <div class="min-h-screen bg-gray-50/80">
        <x-mentor-navbar />

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

            <!-- New Overview Cards -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <!-- Next Session Card -->
                <div class="bg-[#006B52] rounded-[2px] p-5 text-white shadow-lg relative overflow-hidden group hover:shadow-xl transition-all duration-300">
                    <div class="flex items-center gap-2 mb-6">
                        <span class="text-[10px] font-bold tracking-[0.2em] uppercase opacity-70">Next Session</span>
                    </div>
                    
                    @if($nextSession)
                        <div class="flex items-center gap-4 mb-6">
                            <div class="h-12 w-12 rounded-full bg-white/20 flex items-center justify-center overflow-hidden border-2 border-white/30 shadow-inner">
                                @if(isset($nextSession->startup->profile_photo_path))
                                    <img src="{{ Storage::url($nextSession->startup->profile_photo_path) }}" alt="" class="h-full w-full object-cover">
                                @else
                                    <span class="text-lg font-bold text-white">{{ substr($nextSession->startup->name, 0, 1) }}</span>
                                @endif
                            </div>
                            <div>
                                <h4 class="text-xl font-semibold tracking-tight">{{ $nextSession->startup->name }}</h4>
                                <p class="text-white/70 text-xs font-medium">Mentorship Session</p>
                            </div>
                        </div>
                        
                        <div class="inline-flex items-center px-3 py-1.5 bg-white/10 rounded-[2px] backdrop-blur-md border border-white/20">
                            <span class="text-xs font-semibold">
                                {{ \Carbon\Carbon::parse($nextSession->timeSlot->date)->isToday() ? 'Today' : \Carbon\Carbon::parse($nextSession->timeSlot->date)->format('M d') }}, 
                                {{ \Carbon\Carbon::parse($nextSession->timeSlot->start_time)->format('g:i A') }}
                            </span>
                        </div>
                    @else
                        <div class="flex flex-col items-center justify-center py-6 text-white/50 border border-dashed border-white/10 rounded-[2px]">
                            <p class="text-xs font-medium italic">No upcoming sessions scheduled</p>
                        </div>
                    @endif
                    
                    <!-- Decorative Element -->
                    <div class="absolute -right-12 -bottom-12 w-32 h-32 bg-white/5 rounded-full blur-2xl"></div>
                </div>

                <!-- Mentorship Impact Card -->
                <div class="bg-white rounded-[2px] p-5 shadow-sm border border-gray-100 flex flex-col justify-between hover:shadow-md transition-all duration-300">
                    <div>
                        <div class="flex items-center justify-between mb-6">
                            <span class="text-[10px] font-bold tracking-[0.2em] uppercase text-gray-400">Mentorship Impact</span>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-8 mb-6">
                            <div>
                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">Active Mentees</p>
                                <p class="text-3xl font-extrabold text-gray-900 tracking-tight">{{ $activeMentees }}</p>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">Hours Mentored</p>
                                <p class="text-3xl font-extrabold text-gray-900 tracking-tight">{{ round($hoursMentored) }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="pt-4 border-t border-gray-50">
                        <div class="flex justify-between items-center mb-3">
                            <span class="text-[10px] font-bold text-gray-500 uppercase tracking-wider">Profile Completion</span>
                            <span class="text-xs font-bold text-[#006B52]">{{ round($profileCompletion) }}%</span>
                        </div>
                        <div class="h-1.5 w-full bg-gray-100 rounded-[2px] overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-[#006B52] to-[#008F6D] rounded-[2px] transition-all duration-1000 ease-out shadow-sm" 
                                 style="width: {{ $profileCompletion }}%">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Secondary Row: Incoming Requests & Upcoming -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                <!-- Incoming Requests Card -->
                <div class="lg:col-span-2 bg-white rounded-[2px] shadow-sm border border-gray-100 flex flex-col">
                    <div class="p-6 border-b border-gray-50 flex justify-between items-center">
                        <div class="flex items-center gap-3">
                            <h3 class="text-lg font-bold text-gray-900 tracking-tight">Incoming Requests</h3>
                            @if($incomingRequests > 0)
                                <span class="px-2 py-0.5 bg-indigo-50 text-indigo-600 text-[10px] font-bold rounded-full uppercase tracking-wider">{{ $incomingRequests }} New</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="flex-grow">
                        @forelse($recentRequests as $request)
                            <div class="p-6 flex items-center justify-between hover:bg-gray-50/50 transition-colors border-b border-gray-50 last:border-0">
                                <div class="flex items-center gap-4">
                                    <div class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold text-sm shadow-inner">
                                        {{ substr($request->startup->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <div class="flex items-center gap-2 mb-0.5">
                                            <span class="font-bold text-gray-900 text-sm">{{ $request->startup->name }}</span>
                                            @if($request->startup->startupProfile && $request->startup->startupProfile->industry)
                                                <span class="text-[9px] font-bold text-gray-400 uppercase tracking-widest">{{ $request->startup->startupProfile->industry }}</span>
                                            @endif
                                        </div>
                                        <p class="text-xs text-gray-500 line-clamp-1 max-w-md">{{ $request->message }}</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-center gap-3">
                                    <form action="{{ route('mentor.requests.reject', $request) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="p-2 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-full transition-all">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                        </button>
                                    </form>
                                    <form action="{{ route('mentor.requests.accept', $request) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="px-4 py-1.5 bg-[#006B52] text-white text-xs font-bold rounded-[2px] hover:bg-[#005a45] shadow-sm transition-all">
                                            Accept
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div class="p-12 text-center text-gray-400 italic text-sm">
                                No pending requests
                            </div>
                        @endforelse
                    </div>
                    
                    <div class="p-4 border-t border-gray-50 text-center">
                        <a href="{{ route('mentor.requests.index') }}" class="text-xs font-bold text-[#006B52] hover:underline inline-flex items-center gap-1">
                            View all requests
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                    </div>
                </div>

                <!-- Upcoming Card -->
                <div class="bg-white rounded-[2px] shadow-sm border border-gray-100 flex flex-col">
                    <div class="p-6 border-b border-gray-50 flex justify-between items-center">
                        <h3 class="text-lg font-bold text-gray-900 tracking-tight">Upcoming</h3>
                        <button class="text-gray-400 hover:text-gray-600 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM18 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </button>
                    </div>
                    
                    <div class="p-6 space-y-6 overflow-y-auto max-h-[400px]">
                        @forelse($upcomingSessions as $date => $sessions)
                            <div>
                                <h4 class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-4">
                                    {{ \Carbon\Carbon::parse($date)->isToday() ? 'Today' : (\Carbon\Carbon::parse($date)->isTomorrow() ? 'Tomorrow' : \Carbon\Carbon::parse($date)->format('l, M d')) }}
                                </h4>
                                
                                <div class="space-y-4">
                                    @foreach($sessions as $session)
                                        <div class="flex gap-4">
                                            <div class="text-[11px] font-bold text-gray-900 w-12 pt-1">
                                                {{ \Carbon\Carbon::parse($session->timeSlot->start_time)->format('g:i') }}
                                                <span class="text-[9px] text-gray-400 ml-0.5">{{ \Carbon\Carbon::parse($session->timeSlot->start_time)->format('A') }}</span>
                                            </div>
                                            <div class="relative flex-grow pl-4 border-l-2 border-indigo-500">
                                                <div class="p-3 bg-indigo-50/30 rounded-[2px] border border-indigo-50/50 hover:bg-indigo-50 transition-colors group cursor-default">
                                                    <h5 class="text-xs font-bold text-gray-900 mb-1 group-hover:text-indigo-700 transition-colors">Mentorship Session</h5>
                                                    <div class="flex items-center gap-1.5 text-[10px] text-gray-500">
                                                        <div class="h-4 w-4 rounded-full bg-white flex items-center justify-center text-[8px] font-bold text-indigo-600 shadow-sm border border-indigo-100">
                                                            {{ substr($session->startup->name, 0, 1) }}
                                                        </div>
                                                        with {{ $session->startup->name }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @empty
                            <div class="py-12 text-center text-gray-400 italic text-sm">
                                No upcoming sessions
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>


        <!-- Reviews & Ratings Section -->
        <div class="mt-12 bg-white border border-gray-200 rounded-[2px] p-8 shadow-sm">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 tracking-tight mb-1">My Reviews & Ratings</h2>
                    <p class="text-sm text-gray-500 font-medium">Overall feedback from your mentorship sessions</p>
                </div>
                
                <div class="mt-4 md:mt-0 flex items-center gap-6 bg-gray-50/80 border border-gray-100 rounded-[8px] p-5 px-8">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-gray-900 tracking-tighter">{{ number_format($averageRating, 1) }}</div>
                        <div class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-0.5">Rating</div>
                    </div>
                    <div class="h-10 w-px bg-gray-200"></div>
                    <div>
                        <div class="flex items-center gap-1 mb-1">
                            @for ($i = 1; $i <= 5; $i++)
                                <svg class="w-4 h-4 {{ $i <= round($averageRating) ? 'text-[#006B52]' : 'text-gray-300' }}" fill="{{ $i <= round($averageRating) ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.921-.755 1.688-1.54 1.118l-3.976-2.888a1 1 0 00-1.175 0l-3.976 2.888c-.784.57-1.838-.197-1.539-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                            @endfor
                        </div>
                        <div class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">{{ $reviewCount }} Verified Reviews</div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                @forelse($recentReviews as $review)
                    <div class="bg-indigo-50/30 border border-indigo-100/50 rounded-[8px] p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div class="flex items-center gap-3">
                                <div class="h-10 w-10 rounded-full bg-teal-100 flex items-center justify-center text-teal-700 font-bold text-sm uppercase">
                                    {{ substr($review->startup->name, 0, 1) }}{{ str_contains($review->startup->name, ' ') ? substr(explode(' ', $review->startup->name)[1], 0, 1) : '' }}
                                </div>
                                <div>
                                    <h4 class="text-sm font-bold text-gray-900 tracking-tight">{{ $review->startup->name }}</h4>
                                </div>
                            </div>
                            <div class="flex items-center gap-0.5">
                                @for ($i = 1; $i <= 5; $i++)
                                    <svg class="w-3.5 h-3.5 {{ $i <= $review->rating ? 'text-[#006B52]' : 'text-gray-300' }}" fill="{{ $i <= $review->rating ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.921-.755 1.688-1.54 1.118l-3.976-2.888a1 1 0 00-1.175 0l-3.976 2.888c-.784.57-1.838-.197-1.539-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                                @endfor
                            </div>
                        </div>
                        <p class="text-[13px] text-gray-600 italic font-medium leading-relaxed">
                            "{{ $review->review }}"
                        </p>
                    </div>
                @empty
                    <div class="col-span-2 py-12 text-center text-gray-400 italic text-sm">
                        No reviews yet.
                    </div>
                @endforelse
            </div>

            <div class="text-center">
                <a href="{{ route('mentor.reviews.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-[#006B52] hover:underline tracking-tight">
                    Read all reviews
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>
        </div>
    </div>
</div>
</x-app-layout>
