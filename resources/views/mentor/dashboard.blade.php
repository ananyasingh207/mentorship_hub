<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mentor Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in as a Mentor!") }}

                    @if(auth()->user()->mentorProfile && auth()->user()->mentorProfile->status === 'pending')
                        <div class="mt-4 p-4 mb-4 text-sm text-yellow-800 rounded-lg bg-yellow-50" role="alert">
                            <span class="font-medium">Notice!</span> Your mentor profile is under admin review.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
