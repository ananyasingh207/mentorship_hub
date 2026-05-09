<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Complete Your Mentor Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('mentor.profile.store') }}">
                        @csrf

                        <!-- Expertise -->
                        <div>
                            <x-input-label for="expertise" :value="__('Area of Expertise')" />
                            <x-text-input id="expertise" class="block mt-1 w-full" type="text" name="expertise" :value="old('expertise')" required autofocus />
                            <x-input-error :messages="$errors->get('expertise')" class="mt-2" />
                        </div>

                        <!-- Experience -->
                        <div class="mt-4">
                            <x-input-label for="experience" :value="__('Years of Experience')" />
                            <x-text-input id="experience" class="block mt-1 w-full" type="number" name="experience" :value="old('experience')" required min="0" />
                            <x-input-error :messages="$errors->get('experience')" class="mt-2" />
                        </div>

                        <!-- Availability -->
                        <div class="mt-4">
                            <x-input-label for="availability" :value="__('Availability (e.g., 5 hours/week)')" />
                            <x-text-input id="availability" class="block mt-1 w-full" type="text" name="availability" :value="old('availability')" required />
                            <x-input-error :messages="$errors->get('availability')" class="mt-2" />
                        </div>

                        <!-- Pricing -->
                        <div class="mt-4">
                            <x-input-label for="pricing" :value="__('Pricing Structure')" />
                            <select id="pricing" name="pricing" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" required>
                                <option value="" disabled {{ old('pricing') ? '' : 'selected' }}>{{ __('Select Pricing') }}</option>
                                <option value="free" {{ old('pricing') === 'free' ? 'selected' : '' }}>{{ __('Free') }}</option>
                                <option value="paid" {{ old('pricing') === 'paid' ? 'selected' : '' }}>{{ __('Paid') }}</option>
                            </select>
                            <x-input-error :messages="$errors->get('pricing')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ms-4">
                                {{ __('Submit for Review') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
