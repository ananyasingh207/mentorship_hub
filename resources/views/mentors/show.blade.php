<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mentor Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4">
                <a href="{{ route('mentors.index') }}" class="inline-flex items-center text-sm text-gray-600 hover:text-gray-900">
                    &larr; Back to Mentors
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8">
                    <div class="flex items-center justify-between border-b pb-6 mb-6">
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900">{{ $mentor->user->name }}</h1>
                            <p class="text-gray-500 mt-1">Mentor since {{ $mentor->created_at->format('F Y') }}</p>
                        </div>
                        <div class="text-right">
                            <span class="inline-block px-3 py-1 bg-indigo-100 text-indigo-800 font-semibold rounded-full text-sm">
                                {{ ucfirst($mentor->pricing) }}
                            </span>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-2">Expertise</h3>
                            <p class="text-gray-900 text-lg bg-gray-50 p-3 rounded-md">{{ $mentor->expertise }}</p>
                        </div>

                        <div>
                            <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-2">Experience</h3>
                            <p class="text-gray-900 text-lg bg-gray-50 p-3 rounded-md">{{ $mentor->experience }} years</p>
                        </div>

                        <div class="md:col-span-2">
                            <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-2">Availability</h3>
                            <p class="text-gray-900 text-lg bg-gray-50 p-3 rounded-md">{{ $mentor->availability }}</p>
                        </div>
                    </div>

                    <div class="mt-10 pt-6 border-t flex justify-end">
                        <!-- Request functionality will go here in Phase 5 -->
                        <button disabled class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150 cursor-not-allowed" title="Coming soon">
                            Request Mentorship
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
