<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Chat with ') . $user->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex flex-col h-[600px]">
                
                <!-- Chat History -->
                <div class="flex-1 p-6 overflow-y-auto bg-gray-50 flex flex-col space-y-4">
                    @if($messages->isEmpty())
                        <div class="text-center text-gray-500 my-auto">
                            No messages yet. Send a message to start the conversation!
                        </div>
                    @else
                        @foreach($messages as $message)
                            @if($message->sender_id === auth()->id())
                                <!-- Outgoing Message -->
                                <div class="flex justify-end">
                                    <div class="bg-blue-600 text-white rounded-lg py-2 px-4 max-w-[70%]">
                                        <div class="text-sm">{{ $message->message }}</div>
                                        <div class="text-[10px] text-blue-200 text-right mt-1">
                                            {{ $message->created_at->format('M d, H:i') }}
                                        </div>
                                    </div>
                                </div>
                            @else
                                <!-- Incoming Message -->
                                <div class="flex justify-start">
                                    <div class="bg-gray-200 text-gray-800 rounded-lg py-2 px-4 max-w-[70%]">
                                        <div class="text-sm font-semibold mb-1">{{ $user->name }}</div>
                                        <div class="text-sm">{{ $message->message }}</div>
                                        <div class="text-[10px] text-gray-500 mt-1">
                                            {{ $message->created_at->format('M d, H:i') }}
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endif
                </div>

                <!-- Message Input -->
                <div class="p-4 bg-white border-t border-gray-200">
                    <form action="{{ route('messages.store', $user->id) }}" method="POST" class="flex gap-4">
                        @csrf
                        <textarea 
                            name="message" 
                            class="flex-1 border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 resize-none"
                            rows="2" 
                            placeholder="Type your message here..."
                            required
                        ></textarea>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg shadow transition">
                            Send
                        </button>
                    </form>
                    @error('message')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

            </div>
            
            <div class="mt-4">
                <a href="{{ route('messages.index') }}" class="text-blue-600 hover:underline flex items-center">
                    &larr; Back to Conversations
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
