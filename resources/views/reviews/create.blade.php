<x-app-layout :hideNav="true">
    <div class="min-h-screen bg-gray-50/80">
        <x-startup-navbar />

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8 text-gray-900">
                    <form action="{{ route('reviews.store', $mentor) }}" method="POST">
                        @csrf

                        <!-- Rating -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Rating (1 to 5)</label>
                            <div class="flex items-center space-x-4">
                                @for($i = 1; $i <= 5; $i++)
                                    <label class="flex flex-col items-center cursor-pointer">
                                        <input type="radio" name="rating" value="{{ $i }}" class="form-radio h-5 w-5 text-indigo-600 border-gray-300 focus:ring-indigo-500" required>
                                        <span class="mt-1 text-sm text-gray-600">{{ $i }}</span>
                                    </label>
                                @endfor
                            </div>
                            @error('rating')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Review Text -->
                        <div class="mb-6">
                            <label for="review" class="block text-sm font-medium text-gray-700 mb-2">Your Review</label>
                            <textarea id="review" name="review" rows="5" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" required placeholder="Share your experience with this mentor..."></textarea>
                            @error('review')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex justify-end space-x-3">
                            <a href="{{ route('mentors.show', $mentor) }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Cancel
                            </a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Submit Review
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
