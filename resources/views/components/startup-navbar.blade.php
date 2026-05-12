<nav class="bg-white border-b border-gray-200/80 sticky top-0 z-40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">
            <div class="flex items-center gap-x-8">
                <a href="{{ route('startup.dashboard') }}" class="flex items-center gap-3">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="Mentorship Hub" class="w-10 h-10 object-contain">
                    <span class="text-lg font-bold text-gray-900 tracking-tight">Mentorship Hub</span>
                </a>
                <div class="hidden md:flex items-center gap-x-4">
                    <a href="{{ route('startup.dashboard') }}" class="{{ request()->routeIs('startup.dashboard') ? 'bg-teal-50 text-teal-700' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50' }} px-3 py-2 rounded-sm text-sm font-medium transition-colors duration-150">
                        <span class="flex items-center gap-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                            Overview
                        </span>
                    </a>
                    <a href="{{ route('messages.index') }}" class="{{ request()->routeIs('messages.*') ? 'bg-teal-50 text-teal-700' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50' }} px-3 py-2 rounded-sm text-sm font-medium transition-colors duration-150">
                        <span class="flex items-center gap-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                            Messages
                        </span>
                    </a>
                    <a href="{{ route('mentors.index') }}" class="{{ request()->routeIs('mentors.index') ? 'bg-teal-50 text-teal-700' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50' }} px-3 py-2 rounded-sm text-sm font-medium transition-colors duration-150">
                        <span class="flex items-center gap-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/></svg>
                            Mentors
                        </span>
                    </a>
                    <a href="{{ route('startup.requests.index') }}" class="{{ request()->routeIs('startup.requests.*') ? 'bg-teal-50 text-teal-700' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50' }} px-3 py-2 rounded-sm text-sm font-medium transition-colors duration-150">
                        <span class="flex items-center gap-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            My Requests
                        </span>
                    </a>
                    <a href="{{ route('startup.bookings.index') }}" class="{{ request()->routeIs('startup.bookings.*') ? 'bg-teal-50 text-teal-700' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50' }} px-3 py-2 rounded-sm text-sm font-medium transition-colors duration-150">
                        <span class="flex items-center gap-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 00-2 2z"/></svg>
                            My Sessions
                        </span>
                    </a>
                </div>
            </div>
            {{-- Right: User Dropdown --}}
            <div class="flex items-center gap-3">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center gap-3 px-2 py-1.5 rounded-sm hover:bg-gray-50 transition-colors duration-150 focus:outline-none">
                            <div class="w-8 h-8 rounded-sm bg-indigo-600 flex items-center justify-center text-white font-semibold text-xs shadow-sm">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                            <div class="hidden sm:flex items-center gap-1">
                                <span class="text-sm font-bold text-gray-700 tracking-tight">{{ Auth::user()->name }}</span>
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')" class="text-sm font-medium text-gray-600">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();"
                                    class="text-sm font-medium text-red-600">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>
</nav>
