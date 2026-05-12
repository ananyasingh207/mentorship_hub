<x-app-layout :hideNav="true">
    <div class="min-h-screen bg-gray-50/80">
        <x-startup-navbar />

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Welcome Header -->
            <div class="mb-10">
                <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight mb-2">Welcome back, {{ auth()->user()->name }}</h1>
                <p class="text-gray-500 font-medium text-lg">Here is the latest activity in your mentorship network.</p>
            </div>

            <!-- Overview Cards -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-12">
                <!-- Next Session Card -->
                <div class="bg-[#006B52] rounded-[2px] p-6 text-white shadow-lg relative overflow-hidden group hover:shadow-xl transition-all duration-300">
                    <div class="flex items-center gap-2 mb-8">
                        <span class="text-[10px] font-bold tracking-[0.2em] uppercase opacity-70">Next Mentorship Session</span>
                    </div>
                    
                    @php 
                        $nextSession = $recentSessions->where('status', 'scheduled')->first();
                    @endphp

                    @if($nextSession)
                        <div class="flex items-center gap-4 mb-8">
                            <div class="h-14 w-14 rounded-full bg-white/20 flex items-center justify-center overflow-hidden border-2 border-white/30 shadow-inner text-xl font-bold">
                                {{ substr($nextSession->mentor->name, 0, 1) }}
                            </div>
                            <div>
                                <h4 class="text-2xl font-bold tracking-tight">{{ $nextSession->mentor->name }}</h4>
                                <p class="text-white/70 text-sm font-medium">{{ $nextSession->mentor->mentorProfile->expertise ?? 'Mentor' }}</p>
                            </div>
                        </div>
                        
                        <div class="inline-flex items-center px-4 py-2 bg-white/10 rounded-[2px] backdrop-blur-md border border-white/20">
                            <span class="text-sm font-bold">
                                {{ $nextSession->timeSlot->date->isToday() ? 'Today' : $nextSession->timeSlot->date->format('M d') }}, 
                                {{ \Carbon\Carbon::parse($nextSession->timeSlot->start_time)->format('g:i A') }}
                            </span>
                        </div>
                    @else
                        <div class="flex flex-col items-center justify-center py-10 text-white/50 border border-dashed border-white/10 rounded-[2px]">
                            <p class="text-sm font-medium italic">No upcoming sessions scheduled</p>
                        </div>
                    @endif
                    
                    <div class="absolute -right-12 -bottom-12 w-40 h-40 bg-white/5 rounded-full blur-3xl"></div>
                </div>

                <!-- Progress Card -->
                <div class="bg-white rounded-[2px] p-6 shadow-sm border border-gray-100 flex flex-col justify-between hover:shadow-md transition-all duration-300">
                    <div>
                        <div class="flex items-center justify-between mb-8">
                            <span class="text-[10px] font-bold tracking-[0.2em] uppercase text-gray-400">Mentorship Progress</span>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-10 mb-8">
                            <div>
                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-2">Total Requests</p>
                                <p class="text-4xl font-extrabold text-gray-900 tracking-tighter">{{ $totalRequests }}</p>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-2">Accepted Mentors</p>
                                <p class="text-4xl font-extrabold text-[#006B52] tracking-tighter">{{ $acceptedMentors }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="pt-6 border-t border-gray-50">
                        <div class="flex justify-between items-center mb-4">
                            <span class="text-[10px] font-bold text-gray-500 uppercase tracking-wider">Sessions Completed</span>
                            <span class="text-sm font-bold text-[#006B52]">{{ $completedSessions }} Sessions</span>
                        </div>
                        <div class="h-2 w-full bg-gray-100 rounded-[2px] overflow-hidden">
                            @php 
                                $progress = $totalRequests > 0 ? ($completedSessions / $totalRequests) * 100 : 0;
                            @endphp
                            <div class="h-full bg-gradient-to-r from-[#006B52] to-[#008F6D] rounded-[2px] transition-all duration-1000 ease-out shadow-sm" 
                                 style="width: {{ min(100, $progress) }}%">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recommended Mentors Section -->
            <div class="mb-12">
                <div class="flex items-center justify-between mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Recommended Mentors</h2>
                    <a href="{{ route('mentors.index') }}" class="text-sm font-bold text-[#006B52] hover:underline flex items-center gap-1.5 transition-all">
                        View all
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
                    @forelse($recommendedMentors as $mentor)
                        <div class="bg-white border border-gray-100 rounded-[2px] p-6 shadow-sm hover:shadow-md transition-all duration-300 relative group">
                            <div class="flex justify-between items-start mb-6">
                                <div class="flex items-center gap-4">
                                    <div class="h-16 w-16 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-700 font-bold text-xl uppercase shadow-inner border-2 border-white">
                                        {{ substr($mentor->user->name, 0, 1) }}{{ str_contains($mentor->user->name, ' ') ? substr(explode(' ', $mentor->user->name)[1], 0, 1) : '' }}
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-bold text-gray-900 mb-0.5">{{ $mentor->user->name }}</h3>
                                        <p class="text-sm text-gray-500 font-medium line-clamp-1">Expert in {{ $mentor->expertise }}</p>
                                    </div>
                                </div>

                                <div class="relative h-14 w-14 flex items-center justify-center">
                                    <svg class="h-14 w-14 -rotate-90">
                                        <circle cx="28" cy="28" r="24" stroke="currentColor" stroke-width="4" fill="transparent" class="text-gray-100" />
                                        <circle cx="28" cy="28" r="24" stroke="currentColor" stroke-width="4" fill="transparent" 
                                            class="text-[#006B52]"
                                            stroke-dasharray="{{ 2 * pi() * 24 }}"
                                            stroke-dashoffset="{{ 2 * pi() * 24 * (1 - $mentor->match_score / 100) }}"
                                            stroke-linecap="round" />
                                    </svg>
                                    <span class="absolute text-[11px] font-black text-gray-900">{{ $mentor->match_score }}%</span>
                                </div>
                            </div>

                            <div class="flex flex-wrap gap-2 mb-8">
                                @foreach(explode(',', $mentor->expertise) as $tag)
                                    @if($loop->index < 3)
                                        <span class="px-3 py-1 bg-gray-50 text-gray-600 text-[10px] font-bold rounded-full border border-gray-100 uppercase tracking-widest">{{ trim($tag) }}</span>
                                    @endif
                                @endforeach
                            </div>

                            <a href="{{ route('mentors.show', $mentor) }}" class="block w-full py-2.5 text-center border-2 border-gray-100 rounded-[2px] text-xs font-bold text-gray-900 hover:bg-gray-50 hover:border-gray-200 transition-all uppercase tracking-[0.2em]">
                                View Profile
                            </a>
                        </div>
                    @empty
                        <div class="col-span-full py-12 text-center text-gray-400 italic bg-white rounded-[2px] border border-dashed border-gray-200">
                            No recommendations available.
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Third Row: Session Timeline & Sent Requests -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <!-- Session Timeline (Image Accurate) -->
                <div class="lg:col-span-2 bg-white rounded-[2px] shadow-sm border border-gray-100 p-8">
                    <div class="flex items-center justify-between mb-10">
                        <h3 class="text-2xl font-bold text-gray-900 tracking-tight">Session Timeline</h3>
                        <button class="text-gray-400 hover:text-gray-600">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 10c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm6 0c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zM6 10c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/></svg>
                        </button>
                    </div>

                    <div class="relative pl-8 border-l-2 border-gray-50 space-y-12">
                        @forelse($recentSessions as $session)
                            <div class="relative">
                                <!-- Timeline Icon -->
                                <div class="absolute -left-[41px] top-0 h-8 w-8 rounded-full border-4 border-white shadow-sm flex items-center justify-center {{ $session->status === 'scheduled' ? 'bg-[#006B52] text-white' : 'bg-indigo-50 text-indigo-500' }}">
                                    @if($session->status === 'scheduled')
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                    @else
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    @endif
                                </div>

                                <!-- Session Card -->
                                <div class="p-6 {{ $session->status === 'scheduled' ? 'bg-indigo-50/50 border border-indigo-100 rounded-[2px]' : '' }}">
                                    <div class="flex justify-between items-start mb-1">
                                        <h4 class="text-base font-bold text-gray-900 tracking-tight">{{ $session->status === 'scheduled' ? 'Mentorship Session' : 'Completed Session' }}</h4>
                                        <span class="text-[11px] font-bold {{ $session->status === 'scheduled' ? 'text-[#006B52]' : 'text-gray-400' }} uppercase tracking-widest">
                                            @if($session->timeSlot->date->isToday()) Today @elseif($session->timeSlot->date->isTomorrow()) Tomorrow @else {{ $session->timeSlot->date->format('M d') }} @endif,
                                            {{ \Carbon\Carbon::parse($session->timeSlot->start_time)->format('g A') }}
                                        </span>
                                    </div>
                                    <p class="text-sm text-gray-500 font-medium">with {{ $session->mentor->name }}</p>
                                </div>
                            </div>
                        @empty
                            <div class="py-10 text-center text-gray-400 italic">No timeline activity yet.</div>
                        @endforelse
                    </div>
                </div>

                <!-- Sent Requests (Image Accurate) -->
                <div class="bg-white rounded-[2px] shadow-sm border border-gray-100 p-8 flex flex-col">
                    <h3 class="text-2xl font-bold text-gray-900 tracking-tight mb-8">Sent Requests</h3>
                    
                    <div class="space-y-4 flex-grow">
                        @forelse($sentRequests as $request)
                            <div class="p-4 bg-indigo-50/30 border border-indigo-50 rounded-[2px] flex items-center justify-between group hover:bg-indigo-50 transition-all duration-300">
                                <div class="flex items-center gap-4">
                                    <div class="h-10 w-10 rounded-full overflow-hidden border-2 border-white shadow-sm bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold text-sm">
                                        {{ substr($request->mentor->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <h4 class="text-sm font-bold text-gray-900 leading-tight">{{ $request->mentor->name }}</h4>
                                        <p class="text-[10px] text-gray-500 font-medium mt-0.5">
                                            @if($request->status === 'accepted') Accepted today @else Sent {{ $request->created_at->diffForHumans() }} @endif
                                        </p>
                                    </div>
                                </div>
                                
                                <span class="px-3 py-1 text-[9px] font-bold rounded-full {{ $request->status === 'accepted' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }} uppercase tracking-widest">
                                    {{ ucfirst($request->status) }}
                                </span>
                            </div>
                        @empty
                            <div class="py-12 text-center text-gray-400 italic text-sm">No requests sent yet.</div>
                        @endforelse
                    </div>

                    <div class="mt-8 pt-6 border-t border-gray-50 text-center">
                        <a href="{{ route('startup.requests.index') }}" class="text-xs font-bold text-[#006B52] hover:underline uppercase tracking-widest">View All Requests &rarr;</a>
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
