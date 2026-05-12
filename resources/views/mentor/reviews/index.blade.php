<x-app-layout :hideNav="true">
    <div class="min-h-screen bg-gray-50/80">
        <x-mentor-navbar />

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="flex items-center justify-between mb-10">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900 tracking-tight mb-1">Reviews & Feedback</h1>
                            <p class="text-sm text-gray-500 font-medium">Hear what startups are saying about your mentorship</p>
                        </div>
                        <div class="flex items-center gap-6 bg-white border border-gray-100 rounded-[2px] p-4 px-8 shadow-sm">
                            <div class="text-center">
                                <div class="text-2xl font-bold text-gray-900 tracking-tighter">{{ number_format($averageRating, 1) }}</div>
                                <div class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-0.5">Avg Rating</div>
                            </div>
                            <div class="h-8 w-px bg-gray-100"></div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-gray-900 tracking-tighter">{{ $reviewCount }}</div>
                                <div class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-0.5">Reviews</div>
                            </div>
                        </div>
                    </div>

                    @if($reviews->isEmpty())
                        <div class="text-center py-20 bg-gray-50/50 rounded-[2px] border border-dashed border-gray-200">
                            <div class="h-16 w-16 bg-white rounded-full flex items-center justify-center shadow-sm border border-gray-100 mx-auto mb-4">
                                <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.921-.755 1.688-1.54 1.118l-3.976-2.888a1 1 0 00-1.175 0l-3.976 2.888c-.784.57-1.838-.197-1.539-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                            </div>
                            <p class="text-sm font-bold text-gray-400 tracking-tight">No reviews received yet</p>
                        </div>
                    @else
                        <div class="grid grid-cols-1 gap-6">
                            @foreach($reviews as $review)
                                <div class="bg-white border border-gray-200 rounded-[2px] p-8 hover:shadow-md transition-all duration-300 relative group">
                                    <div class="flex flex-col md:flex-row justify-between gap-6">
                                        <div class="flex gap-5">
                                            <div class="h-14 w-14 rounded-full bg-indigo-100 flex-shrink-0 flex items-center justify-center text-indigo-700 font-bold text-lg uppercase shadow-inner">
                                                {{ substr($review->startup->name, 0, 1) }}{{ str_contains($review->startup->name, ' ') ? substr(explode(' ', $review->startup->name)[1], 0, 1) : '' }}
                                            </div>
                                            <div>
                                                <div class="flex items-center gap-3 mb-1.5">
                                                    <h4 class="text-lg font-bold text-gray-900 tracking-tight">{{ $review->startup->name }}</h4>
                                                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">{{ $review->created_at->format('M d, Y') }}</span>
                                                </div>
                                                <div class="flex items-center gap-0.5 mb-4">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <svg class="w-4 h-4 {{ $i <= $review->rating ? 'text-[#006B52]' : 'text-gray-200' }}" fill="{{ $i <= $review->rating ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.921-.755 1.688-1.54 1.118l-3.976-2.888a1 1 0 00-1.175 0l-3.976 2.888c-.784.57-1.838-.197-1.539-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                                                    @endfor
                                                </div>
                                                <p class="text-gray-600 leading-relaxed italic text-[15px]">
                                                    "{{ $review->review }}"
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Decorative Accent -->
                                    <div class="absolute top-0 right-0 p-4 opacity-0 group-hover:opacity-100 transition-opacity">
                                        <svg class="w-8 h-8 text-gray-50" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21L14.017 18C14.017 16.8954 14.9124 16 16.017 16H19.017V14H17.017C15.9124 14 15.017 13.1046 15.017 12V10C15.017 8.89543 15.9124 8 17.017 8H19.017V6C19.017 4.89543 18.1216 4 17.017 4H14.017V2H17.017C19.2261 2 21.017 3.79086 21.017 6V12C21.017 14.2091 19.2261 16 17.017 16H17.017V18C17.017 19.6569 15.6739 21 14.017 21ZM3.017 21L3.017 18C3.017 16.8954 3.91241 16 5.017 16H8.017V14H6.017C4.91241 14 4.017 13.1046 4.017 12V10C4.017 8.89543 4.91241 8 6.017 8H8.017V6C8.017 4.89543 7.12157 4 6.017 4H3.017V2H6.017C8.22614 2 10.017 3.79086 10.017 6V12C10.017 14.2091 8.22614 16 6.017 16H6.017V18C6.017 19.6569 4.67391 21 3.017 21Z"></path></svg>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
        </div>
    </div>
</x-app-layout>
