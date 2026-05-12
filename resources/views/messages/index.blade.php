<x-app-layout :hideNav="true">
    <div class="min-h-screen bg-gray-50/80">
        @if(auth()->user()->role === 'admin')
            <x-admin-navbar />
        @elseif(auth()->user()->role === 'startup')
            <x-startup-navbar />
        @elseif(auth()->user()->role === 'mentor')
            <x-mentor-navbar />
        @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    @if($contacts->isEmpty())
                        <p class="text-gray-500">You don't have any conversations yet. Messages can only be sent once a mentorship request is accepted.</p>
                    @else
                        <div class="space-y-4">
                            @foreach($contacts as $contact)
                                <a href="{{ route('messages.show', $contact->id) }}" class="block p-4 border rounded-lg hover:bg-gray-50 transition">
                                    <div class="flex justify-between items-center">
                                        <div class="font-semibold text-lg">{{ $contact->name }}</div>
                                        @if($contact->latest_message)
                                            <div class="text-xs text-gray-500">
                                                {{ $contact->latest_message->created_at->diffForHumans() }}
                                            </div>
                                        @endif
                                    </div>
                                    @if($contact->latest_message)
                                        <div class="text-sm text-gray-600 mt-1 truncate">
                                            @if($contact->latest_message->sender_id === auth()->id())
                                                <span class="font-medium text-gray-400">You: </span>
                                            @endif
                                            {{ $contact->latest_message->message }}
                                        </div>
                                    @else
                                        <div class="text-sm text-gray-400 mt-1 italic">
                                            No messages yet. Start the conversation!
                                        </div>
                                    @endif
                                </a>
                            @endforeach
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
