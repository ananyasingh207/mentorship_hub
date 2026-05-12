<x-app-layout :hideNav="true">
    <div class="min-h-screen bg-gray-50/80">
        <x-startup-navbar />

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('startup.profile.store') }}">
                        @csrf

                        <!-- Startup Name -->
                        <div>
                            <x-input-label for="startup_name" :value="__('Startup Name')" />
                            <x-text-input id="startup_name" class="block mt-1 w-full" type="text" name="startup_name" :value="old('startup_name')" required autofocus />
                            <x-input-error :messages="$errors->get('startup_name')" class="mt-2" />
                        </div>

                        <!-- Industry -->
                        <div class="mt-4">
                            <x-input-label for="industry" :value="__('Industry')" />
                            <x-text-input id="industry" class="block mt-1 w-full" type="text" name="industry" :value="old('industry')" required />
                            <x-input-error :messages="$errors->get('industry')" class="mt-2" />
                        </div>

                        <!-- Stage -->
                        <div class="mt-4">
                            <x-input-label for="stage" :value="__('Current Stage')" />
                            <select id="stage" name="stage" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" required>
                                <option value="" disabled {{ old('stage') ? '' : 'selected' }}>{{ __('Select Stage') }}</option>
                                <option value="idea" {{ old('stage') === 'idea' ? 'selected' : '' }}>{{ __('Idea') }}</option>
                                <option value="mvp" {{ old('stage') === 'mvp' ? 'selected' : '' }}>{{ __('MVP') }}</option>
                                <option value="growth" {{ old('stage') === 'growth' ? 'selected' : '' }}>{{ __('Growth') }}</option>
                            </select>
                            <x-input-error :messages="$errors->get('stage')" class="mt-2" />
                        </div>

                        <!-- Problem -->
                        <div class="mt-4">
                            <x-input-label for="problem" :value="__('Problem You Are Solving')" />
                            <textarea id="problem" name="problem" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" required>{{ old('problem') }}</textarea>
                            <x-input-error :messages="$errors->get('problem')" class="mt-2" />
                        </div>

                        <!-- Help Needed -->
                        <div class="mt-4">
                            <x-input-label for="help_needed" :value="__('What help do you need?')" />
                            <textarea id="help_needed" name="help_needed" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" required>{{ old('help_needed') }}</textarea>
                            <x-input-error :messages="$errors->get('help_needed')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ms-4">
                                {{ __('Save Profile') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
