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
                    @foreach($contacts as $contact)
                        <a href="{{ route('messages.show', $contact->id) }}" 
                           class="flex items-center gap-4 px-6 py-4 hover:bg-gray-50 transition-colors {{ $user->id === $contact->id ? 'bg-indigo-50/50' : '' }}">
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
                    @endforeach
                </div>
            </div>

            <!-- Chat Area -->
            <div class="flex-grow flex flex-col bg-[#F8FAFC]">
                <!-- Chat Header -->
                <div class="h-16 px-6 bg-white border-b border-gray-100 flex items-center gap-4">
                    <div class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-700 font-bold text-xs uppercase">
                        {{ substr($user->name, 0, 1) }}{{ str_contains($user->name, ' ') ? substr(explode(' ', $user->name)[1], 0, 1) : '' }}
                    </div>
                    <h2 class="text-sm font-bold text-gray-900 tracking-tight">{{ $user->name }}</h2>
                </div>

                <!-- Messages -->
                <div class="flex-grow overflow-y-auto p-8 space-y-8" id="message-container">
                    @php $lastDate = null; @endphp
                    @foreach($messages as $message)
                        @php 
                            $messageDate = $message->created_at->format('Y-m-d');
                        @endphp
                        
                        @if($lastDate !== $messageDate)
                            <div class="flex justify-center my-4">
                                <span class="px-4 py-1 bg-gray-200/50 text-[10px] font-bold text-gray-500 rounded-full uppercase tracking-widest">
                                    {{ $message->created_at->isToday() ? 'Today' : ($message->created_at->isYesterday() ? 'Yesterday' : $message->created_at->format('M d, Y')) }}, {{ $message->created_at->format('g:i A') }}
                                </span>
                            </div>
                            @php $lastDate = $messageDate; @endphp
                        @endif

                        @if($message->sender_id !== auth()->id())
                            <!-- Incoming Message -->
                            <div class="flex items-start gap-4 max-w-[80%]">
                                <div class="h-8 w-8 rounded-full bg-indigo-100 flex-shrink-0 flex items-center justify-center text-indigo-700 font-bold text-[10px] uppercase mt-1">
                                    {{ substr($user->name, 0, 1) }}{{ str_contains($user->name, ' ') ? substr(explode(' ', $user->name)[1], 0, 1) : '' }}
                                </div>
                                <div class="space-y-1">
                                    <div class="bg-[#E8F0FE] text-gray-800 p-4 rounded-2xl rounded-tl-none shadow-sm text-[13px] leading-relaxed">
                                        {{ $message->message }}
                                    </div>
                                    <div class="text-[10px] font-bold text-gray-400 uppercase tracking-tighter ml-1">
                                        {{ $message->created_at->format('g:i A') }}
                                    </div>
                                </div>
                            </div>
                        @else
                            <!-- Outgoing Message -->
                            <div class="flex flex-col items-end gap-1 ml-auto max-w-[80%]">
                                <div class="bg-[#006B52] text-white p-4 rounded-2xl rounded-br-none shadow-sm text-[13px] leading-relaxed">
                                    {{ $message->message }}
                                </div>
                                <div class="text-[10px] font-bold text-gray-400 uppercase tracking-tighter mr-1">
                                    {{ $message->created_at->format('g:i A') }}
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>

                <!-- Chat Footer -->
                <div class="p-6 bg-white border-t border-gray-100">
                    <form action="{{ route('messages.store', $user) }}" method="POST" class="flex gap-4">
                        @csrf
                        <div class="flex-grow">
                            <input type="text" name="message" placeholder="Type your message here..." required autocomplete="off"
                                   class="w-full bg-gray-50 border-0 focus:ring-2 focus:outline-none focus:ring-1 focus:ring-[#006B52]/50 focus:shadow-[0_0_12px_rgba(0,107,82,0.15)] rounded-[2px] px-4 py-3 text-sm placeholder-gray-400">
                        </div>
                        <button type="submit" 
                                class="px-8 py-3 bg-[#006B52] text-white font-bold text-sm rounded-[2px] hover:bg-[#005a45] shadow-sm transition-all">
                            Send
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('message-container');
            container.scrollTop = container.scrollHeight;
        });
    </script>
</x-app-layout>
