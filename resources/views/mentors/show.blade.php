<x-app-layout :hideNav="true">
    <div class="min-h-screen bg-gray-50/80">
        @if(auth()->user()->role === 'admin')
            <x-admin-navbar />
        @elseif(auth()->user()->role === 'startup')
            <x-startup-navbar />
        @endif

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-8">
                <a href="{{ route('mentors.index') }}" class="inline-flex items-center text-[10px] font-bold text-gray-400 uppercase tracking-widest hover:text-[#006B52] transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Back to discovery
                </a>
            </div>

            <div class="bg-white border border-gray-100 shadow-xl shadow-gray-200/50 rounded-[2px] overflow-hidden">
                <!-- Header -->
                <div class="p-10 border-b border-gray-50 relative overflow-hidden">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 relative z-10">
                        <div class="flex items-center gap-6">
                            <div class="h-24 w-24 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-700 font-bold text-3xl uppercase shadow-inner border-4 border-white">
                                {{ substr($mentor->user->name, 0, 1) }}{{ str_contains($mentor->user->name, ' ') ? substr(explode(' ', $mentor->user->name)[1], 0, 1) : '' }}
                            </div>
                            <div>
                                <h1 class="text-4xl font-extrabold text-gray-900 tracking-tighter mb-1">{{ $mentor->user->name }}</h1>
                                <p class="text-sm font-bold text-gray-400 uppercase tracking-[0.2em]">Mentor since {{ $mentor->created_at->format('M Y') }}</p>
                            </div>
                        </div>
                        <div class="flex flex-col items-end">
                            <span class="px-4 py-1 bg-green-50 text-[#006B52] font-black text-[10px] rounded-full border border-green-100 uppercase tracking-widest mb-3">
                                {{ ucfirst($mentor->pricing) }}
                            </span>
                            @if(auth()->check() && auth()->user()->role === 'startup' && !$hasAcceptedRequest)
                                @if($requestStatus === 'no_request')
                                    <a href="{{ route('startup.requests.create', $mentor) }}" class="px-8 py-3 bg-[#006B52] text-white text-[11px] font-bold rounded-[2px] hover:bg-[#005a45] shadow-lg transition-all uppercase tracking-widest">
                                        Request Mentorship
                                    </a>
                                @else
                                    <span class="px-6 py-3 bg-gray-50 text-gray-400 text-[11px] font-bold rounded-[2px] border border-gray-100 uppercase tracking-widest">
                                        {{ str_replace('_', ' ', ucfirst($requestStatus)) }}
                                    </span>
                                @endif
                            @endif
                        </div>
                    </div>
                    <div class="absolute -right-16 -top-16 w-64 h-64 bg-indigo-50/30 rounded-full blur-3xl opacity-50"></div>
                </div>

                <div class="p-10">
                    <!-- Info Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-10 mb-12">
                        <div>
                            <h3 class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.3em] mb-4">Expertise</h3>
                            <div class="flex flex-wrap gap-2">
                                @foreach(explode(',', $mentor->expertise) as $tag)
                                    <span class="px-3 py-1.5 bg-gray-50 text-gray-600 text-[11px] font-bold rounded-[2px] border border-gray-100">{{ trim($tag) }}</span>
                                @endforeach
                            </div>
                        </div>

                        <div>
                            <h3 class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.3em] mb-4">Experience</h3>
                            <p class="text-2xl font-black text-gray-900 tracking-tighter">{{ $mentor->experience }} <span class="text-sm font-bold text-gray-400 uppercase tracking-widest ml-1">Years active</span></p>
                        </div>

                        <div class="md:col-span-2">
                            <h3 class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.3em] mb-4">Availability Overview</h3>
                            <p class="text-gray-600 leading-relaxed text-[15px] font-medium italic">"{{ $mentor->availability }}"</p>
                        </div>
                    </div>

                    <!-- Bookings Section -->
                    @if(auth()->check() && auth()->user()->role === 'startup' && $hasAcceptedRequest)
                        <div class="mt-12 pt-10 border-t border-gray-50">
                            <div class="flex items-center justify-between mb-8">
                                <h3 class="text-2xl font-bold text-gray-900 tracking-tight">Available Slots</h3>
                                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">{{ $availableSlots->count() }} Slots found</span>
                            </div>

                            @if($availableSlots->isEmpty())
                                <div class="p-10 text-center bg-gray-50/50 rounded-[2px] border border-dashed border-gray-200">
                                    <p class="text-sm font-bold text-gray-400 tracking-tight">No active slots available. Please check back later.</p>
                                </div>
                            @else
                                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                                    @foreach($availableSlots as $slot)
                                        <div class="bg-white border border-gray-100 rounded-[2px] p-5 shadow-sm hover:shadow-md transition-all group">
                                            <div class="mb-6">
                                                <div class="text-sm font-bold text-gray-900 mb-1">{{ $slot->date->format('D, M d') }}</div>
                                                <div class="flex items-center gap-1.5 text-[10px] font-bold text-[#006B52] uppercase tracking-widest">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                    {{ \Carbon\Carbon::parse($slot->start_time)->format('g:i A') }}
                                                </div>
                                            </div>
                                            <form action="{{ route('bookings.store', $slot) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="w-full py-2 bg-indigo-50 text-indigo-600 text-[10px] font-bold rounded-[2px] group-hover:bg-indigo-600 group-hover:text-white transition-all uppercase tracking-widest shadow-sm" onclick="return confirm('Confirm booking for this slot?')">
                                                    Book Now
                                                </button>
                                            </form>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endif

                    <!-- Reviews Section -->
                    <div class="mt-12 pt-10 border-t border-gray-50">
                        <div class="flex items-center justify-between mb-10">
                            <div>
                                <h3 class="text-2xl font-bold text-gray-900 tracking-tight mb-1">Reviews</h3>
                                <div class="flex items-center gap-2">
                                    <div class="flex items-center text-[#006B52]">
                                        <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                        <span class="text-sm font-black ml-1">{{ number_format($averageRating, 1) }}</span>
                                    </div>
                                    <span class="text-sm text-gray-400 font-medium">• {{ $reviewCount }} Feedback{{ $reviewCount != 1 ? 's' : '' }}</span>
                                </div>
                            </div>
                            @if(isset($canReview) && $canReview)
                                <a href="{{ route('reviews.create', $mentor) }}" class="px-6 py-2.5 border-2 border-[#006B52] text-[#006B52] text-[10px] font-bold rounded-[2px] hover:bg-[#006B52] hover:text-white transition-all uppercase tracking-widest">
                                    Write a Review
                                </a>
                            @endif
                        </div>

                        @if($reviews->isEmpty())
                            <p class="text-sm font-medium text-gray-400 italic bg-gray-50/50 p-6 rounded-[2px] border border-dashed border-gray-200 text-center">No reviews submitted for this mentor yet.</p>
                        @else
                            <div class="space-y-6">
                                @foreach($reviews as $review)
                                    <div class="bg-white border border-gray-100 rounded-[2px] p-6 hover:shadow-md transition-all">
                                        <div class="flex justify-between items-start mb-4">
                                            <div class="flex items-center gap-4">
                                                <div class="h-10 w-10 rounded-full bg-indigo-50 flex items-center justify-center text-indigo-600 font-bold text-xs shadow-inner">
                                                    {{ substr($review->startup->name, 0, 1) }}
                                                </div>
                                                <div>
                                                    <h4 class="text-sm font-bold text-gray-900 tracking-tight">{{ $review->startup->name }}</h4>
                                                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-0.5">{{ $review->created_at->format('M d, Y') }}</p>
                                                </div>
                                            </div>
                                            <div class="flex items-center gap-0.5 text-[#006B52]">
                                                @for($i=1; $i<=5; $i++)
                                                    <svg class="w-3 h-3 {{ $i <= $review->rating ? 'fill-current' : 'text-gray-200 fill-current' }}" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                                @endfor
                                            </div>
                                        </div>
                                        <p class="text-gray-600 text-sm leading-relaxed italic font-medium">"{{ $review->review }}"</p>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
