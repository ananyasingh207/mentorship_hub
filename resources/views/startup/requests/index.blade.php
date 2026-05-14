<x-app-layout :hideNav="true">
    <div class="min-h-screen bg-gray-50/80">
        <x-startup-navbar />

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    @if (session('success'))
                        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <div class="flex items-center justify-between mb-10">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900 tracking-tight mb-1">My Mentorship Requests</h1>
                            <p class="text-sm text-gray-500 font-medium">Track the status of your mentorship applications</p>
                        </div>
                        @if(!$requests->isEmpty())
                            <a href="{{ route('mentors.index') }}" class="px-6 py-2 bg-[#006B52] text-white text-xs font-bold rounded-[2px] hover:bg-[#005a45] shadow-sm transition-all uppercase tracking-widest">
                                Find More Mentors
                            </a>
                        @endif
                    </div>

                    @if($requests->isEmpty())
                        <div class="text-center py-20 bg-gray-50/50 rounded-[2px] border border-dashed border-gray-200">
                            <div class="h-16 w-16 bg-white rounded-full flex items-center justify-center shadow-sm border border-gray-100 mx-auto mb-4">
                                <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            </div>
                            <p class="text-sm font-bold text-gray-400 tracking-tight mb-4">You haven't sent any requests yet</p>
                            <a href="{{ route('mentors.index') }}" class="text-sm font-bold text-[#006B52] hover:underline inline-flex items-center gap-1">
                                Browse mentors now
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </a>
                        </div>
                    @else
                        <div class="space-y-4">
                            @foreach($requests as $request)
                                <div class="bg-white border border-gray-200 rounded-[2px] p-6 flex items-center justify-between hover:shadow-md transition-all duration-300">
                                    <div class="flex items-center gap-6">
                                        <div class="h-14 w-14 rounded-full bg-indigo-100 flex-shrink-0 flex items-center justify-center text-indigo-700 font-bold text-base uppercase shadow-inner">
                                            {{ substr($request->mentor->name, 0, 1) }}{{ str_contains($request->mentor->name, ' ') ? substr(explode(' ', $request->mentor->name)[1], 0, 1) : '' }}
                                        </div>
                                        <div>
                                            <div class="flex items-center gap-3 mb-1.5">
                                                <h4 class="text-lg font-bold text-gray-900 tracking-tight">{{ $request->mentor->name }}</h4>
                                                @if($request->mentor->mentorProfile && $request->mentor->mentorProfile->expertise)
                                                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] bg-gray-50 px-2 py-0.5 rounded-full">{{ $request->mentor->mentorProfile->expertise }}</span>
                                                @endif
                                            </div>
                                            <p class="text-sm text-gray-500 max-w-2xl leading-relaxed italic">"{{ $request->message }}"</p>
                                            <div class="mt-4 flex items-center gap-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">
                                                <div class="flex items-center gap-1.5">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 00-2 2z"></path></svg>
                                                    Requested on {{ $request->created_at->format('M d, Y') }}
                                                </div>
                                                <span>•</span>
                                                <div class="flex items-center gap-1.5 {{ $request->status === 'pending' ? 'text-yellow-600' : ($request->status === 'accepted' ? 'text-green-600' : 'text-red-600') }}">
                                                    <span class="h-1.5 w-1.5 rounded-full {{ $request->status === 'pending' ? 'bg-yellow-600' : ($request->status === 'accepted' ? 'bg-green-600' : 'bg-red-600') }}"></span>
                                                    {{ ucfirst($request->status) }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex items-center gap-3">
                                        @if($request->status === 'accepted')
                                            <a href="{{ route('messages.show', $request->mentor_id) }}" class="flex items-center gap-2 px-5 py-2 bg-indigo-50 text-indigo-600 text-[10px] font-bold rounded-[2px] hover:bg-indigo-100 transition-all uppercase tracking-widest">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                                                Message
                                            </a>
                                        @endif

                                        <form action="{{ route('startup.requests.destroy', $request) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to {{ $request->status === 'pending' ? 'withdraw' : 'remove' }} this request?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="flex items-center gap-2 px-5 py-2 bg-red-50 text-red-600 text-[10px] font-bold rounded-[2px] hover:bg-red-100 transition-all uppercase tracking-widest">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                                {{ $request->status === 'pending' ? 'Withdraw' : 'Remove' }}
                                            </button>
                                        </form>
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
