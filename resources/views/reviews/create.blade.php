<x-app-layout :hideNav="true">
    <div class="min-h-screen bg-gray-50/80">
        <x-startup-navbar />

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-8">
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tighter mb-2">Share Your Experience</h1>
                <p class="text-gray-500 font-medium">Your feedback helps {{ $mentor->user->name }} and other startups in the community.</p>
            </div>

            <div class="bg-white border border-gray-100 shadow-xl shadow-gray-200/50 rounded-[2px] overflow-hidden">
                <div class="p-10 text-gray-900">
                    <form action="{{ route('reviews.store', $mentor->user_id) }}" method="POST">
                        @csrf

                        <!-- Rating -->
                        <div class="mb-10">
                            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-[0.3em] mb-4">Rating (1 to 5)</label>
                            <div class="grid grid-cols-5 gap-3">
                                @for($i = 1; $i <= 5; $i++)
                                    <label class="relative group cursor-pointer">
                                        <input type="radio" name="rating" value="{{ $i }}" class="peer sr-only" required>
                                        <div class="h-12 flex items-center justify-center border-2 border-gray-100 rounded-[2px] text-gray-400 group-hover:border-[#006B52] peer-checked:border-[#006B52] peer-checked:bg-[#006B52] peer-checked:text-white transition-all duration-300">
                                            <span class="text-sm font-black">{{ $i }}</span>
                                        </div>
                                    </label>
                                @endfor
                            </div>
                            @error('rating')
                                <p class="text-red-500 text-[10px] font-bold uppercase tracking-widest mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Review Text -->
                        <div class="mb-10">
                            <label for="review" class="block text-[10px] font-bold text-gray-400 uppercase tracking-[0.3em] mb-4">Detailed Review</label>
                            <textarea id="review" name="review" rows="6" 
                                class="w-full bg-gray-50/50 border-gray-100 px-4 py-3 focus:border-[#006B52] focus:outline-none focus:ring-1 focus:ring-[#006B52]/50 focus:shadow-[0_0_12px_rgba(0,107,82,0.15)] rounded-[2px] shadow-sm text-sm font-medium placeholder-gray-300 transition-all duration-300" 
                                required placeholder="Describe your mentorship experience..."></textarea>
                            @error('review')
                                <p class="text-red-500 text-[10px] font-bold uppercase tracking-widest mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between gap-4">
                            <a href="{{ route('mentors.show', $mentor) }}" class="text-[10px] font-bold text-gray-400 uppercase tracking-widest hover:text-gray-600 transition-colors">
                                Cancel
                            </a>
                            <button type="submit" class="px-10 py-3 bg-[#006B52] text-white text-[11px] font-bold rounded-[2px] hover:bg-[#005a45] shadow-lg transition-all uppercase tracking-widest">
                                Submit Feedback
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
