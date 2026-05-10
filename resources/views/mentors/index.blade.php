<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Discover Mentors') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Filter Form -->
            <div class="mb-6 bg-white p-4 rounded-lg shadow-sm">
                <form method="GET" action="{{ route('mentors.index') }}" class="flex items-end space-x-4">
                    <div class="flex-grow max-w-md">
                        <x-input-label for="expertise" :value="__('Filter by Expertise')" />
                        <x-text-input id="expertise" class="block mt-1 w-full" type="text" name="expertise" :value="request('expertise')" placeholder="e.g. Marketing, Tech..." />
                    </div>
                    <div>
                        <x-primary-button>
                            {{ __('Search') }}
                        </x-primary-button>
                        @if(request('expertise'))
                            <a href="{{ route('mentors.index') }}" class="ml-2 text-sm text-gray-600 hover:text-gray-900 underline">Clear</a>
                        @endif
                    </div>
                </form>
            </div>

            <!-- Mentor Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($mentors as $mentor)
                    <div class="bg-white overflow-hidden shadow-sm rounded-lg border border-gray-100 hover:shadow-md transition-shadow">
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h3 class="text-lg font-bold text-gray-900">{{ $mentor->user->name }}</h3>
                                    <p class="text-sm text-gray-500">Joined {{ $mentor->created_at->diffForHumans() }}</p>
                                </div>
                                <span class="px-2 py-1 bg-indigo-100 text-indigo-800 text-xs font-semibold rounded-full">
                                    {{ ucfirst($mentor->pricing) }}
                                </span>
                            </div>
                            
                            <div class="mb-4">
                                <span class="inline-block bg-gray-100 text-gray-700 rounded-full px-3 py-1 text-sm font-medium mr-2 mb-2">
                                    {{ $mentor->expertise }}
                                </span>
                            </div>
                            
                            <p class="text-gray-600 text-sm mb-6">
                                <span class="font-semibold">Experience:</span> {{ $mentor->experience }} years
                            </p>
                            
                            <div class="mt-auto flex flex-col space-y-2">
                                <a href="{{ route('mentors.show', $mentor->id) }}" class="w-full inline-flex justify-center items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    View Profile
                                </a>
                                <a href="{{ route('startup.requests.create', $mentor) }}" class="w-full inline-flex justify-center items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest shadow-sm hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Request Mentorship
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full bg-white p-8 text-center rounded-lg shadow-sm">
                        <p class="text-gray-500 text-lg">No mentors found matching your criteria.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
