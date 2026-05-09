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

                    @if(auth()->user()->mentorProfile)
                        @if(auth()->user()->mentorProfile->status === 'pending')
                            <div class="mt-4 p-4 mb-4 text-sm text-yellow-800 rounded-lg bg-yellow-50" role="alert">
                                <span class="font-medium">Notice!</span> Your profile is under admin review.
                            </div>
                        @elseif(auth()->user()->mentorProfile->status === 'approved')
                            <div class="mt-4 p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50" role="alert">
                                <span class="font-medium">Success!</span> Your profile has been approved.
                            </div>
                        @elseif(auth()->user()->mentorProfile->status === 'rejected')
                            <div class="mt-4 p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
                                <span class="font-medium">Alert!</span> Your profile has been rejected.
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
