<x-app-layout :hideNav="true">
    <div class="min-h-screen bg-gray-50/80">
        @if(auth()->user()->role === 'admin')
            <x-admin-navbar />
        @elseif(auth()->user()->role === 'startup')
            <x-startup-navbar />
        @elseif(auth()->user()->role === 'mentor')
            <x-mentor-navbar />
        @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
