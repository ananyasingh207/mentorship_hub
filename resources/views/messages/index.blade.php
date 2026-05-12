<x-app-layout :hideNav="true">
    <div class="min-h-screen bg-white flex flex-col">
        @if(auth()->user()->role === 'admin')
            <x-admin-navbar />
        @elseif(auth()->user()->role === 'startup')
            <x-startup-navbar />
        @elseif(auth()->user()->role === 'mentor')
            <x-mentor-navbar />
        @endif

        <div class="flex-grow flex overflow-hidden">
            <!-- Sidebar -->
            <div class="w-80 border-r border-gray-100 flex flex-col bg-white">
                <div class="p-6">
                    <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Messages</h1>
                </div>

                <div class="flex-grow overflow-y-auto">
                    @forelse($contacts as $contact)
                        <a href="{{ route('messages.show', $contact->id) }}" 
                           class="flex items-center gap-4 px-6 py-4 hover:bg-gray-50 transition-colors">
                            <div class="h-12 w-12 rounded-full bg-indigo-100 flex-shrink-0 flex items-center justify-center text-indigo-700 font-bold text-sm uppercase">
                                {{ substr($contact->name, 0, 1) }}{{ str_contains($contact->name, ' ') ? substr(explode(' ', $contact->name)[1], 0, 1) : '' }}
                            </div>
                            <div class="flex-grow min-w-0">
                                <div class="flex justify-between items-baseline mb-0.5">
                                    <h4 class="text-sm font-bold text-gray-900 truncate">{{ $contact->name }}</h4>
                                    @if($contact->latest_message)
                                        <span class="text-[10px] font-medium text-gray-400">
                                            {{ $contact->latest_message->created_at->isToday() ? $contact->latest_message->created_at->format('g:i A') : ($contact->latest_message->created_at->isYesterday() ? 'Yesterday' : $contact->latest_message->created_at->format('D')) }}
                                        </span>
                                    @endif
                                </div>
                                @if($contact->latest_message)
                                    <p class="text-xs text-gray-500 truncate leading-relaxed">
                                        @if($contact->latest_message->sender_id === auth()->id())
                                            <span class="text-gray-400">You: </span>
                                        @endif
                                        {{ $contact->latest_message->message }}
                                    </p>
                                @else
                                    <p class="text-xs text-gray-400 italic">No messages yet</p>
                                @endif
                            </div>
                        </a>
                    @empty
                        <div class="p-8 text-center text-gray-400 italic text-sm">
                            No conversations yet. Messages appear here after a mentorship request is accepted.
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Empty State Area -->
            <div class="flex-grow flex flex-col items-center justify-center bg-[#F8FAFC] text-center p-12">
                <div class="h-20 w-20 bg-white rounded-full flex items-center justify-center shadow-sm border border-gray-100 mb-6">
                    <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 tracking-tight mb-2">Select a Conversation</h3>
                <p class="text-sm text-gray-500 max-w-xs leading-relaxed">Choose a mentor or startup from the sidebar to start messaging.</p>
            </div>
        </div>
    </div>
</x-app-layout>
