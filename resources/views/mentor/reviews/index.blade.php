<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Reviews') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Summary Stats -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-sm font-medium text-gray-500 uppercase tracking-wide">Average Rating</div>
                        <div class="mt-2 flex items-baseline">
                            <span class="text-4xl font-extrabold text-gray-900">{{ number_format($averageRating, 1) }}</span>
                            <span class="ml-2 text-xl text-gray-500">/ 5.0</span>
                        </div>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-sm font-medium text-gray-500 uppercase tracking-wide">Total Reviews</div>
                        <div class="mt-2">
                            <span class="text-4xl font-extrabold text-gray-900">{{ $reviewCount }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Reviews List -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">All Reviews</h3>
                    
                    @if($reviews->isEmpty())
                        <div class="text-center py-8 text-gray-500 bg-gray-50 rounded-lg">
                            You haven't received any reviews yet. Complete sessions to start collecting feedback!
                        </div>
                    @else
                        <div class="space-y-6">
                            @foreach($reviews as $review)
                                <div class="bg-gray-50 rounded-lg p-6 border border-gray-200 shadow-sm">
                                    <div class="flex flex-col sm:flex-row justify-between sm:items-center mb-4 border-b pb-4">
                                        <div>
                                            <div class="font-bold text-lg text-gray-900">{{ $review->startup->name }}</div>
                                            <div class="text-sm text-gray-500">{{ $review->created_at->format('F d, Y \a\t h:i A') }}</div>
                                        </div>
                                        <div class="mt-2 sm:mt-0 flex items-center bg-white px-3 py-1 rounded-full shadow-sm border">
                                            <span class="text-yellow-400 font-bold text-lg mr-2">★</span>
                                            <span class="font-bold text-gray-900">{{ $review->rating }} <span class="text-gray-400 font-normal">/ 5</span></span>
                                        </div>
                                    </div>
                                    <p class="text-gray-700 leading-relaxed whitespace-pre-wrap">{{ $review->review }}</p>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
