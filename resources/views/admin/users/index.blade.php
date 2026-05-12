<x-app-layout :hideNav="true">
    <div class="min-h-screen bg-gray-50/80">

        <x-admin-navbar />

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            {{-- Page Header --}}
            <div class="mb-8">
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 tracking-tight">User Directory</h1>
                <p class="mt-1 text-sm text-gray-500">Browse and manage all registered users on the platform.</p>
            </div>

            {{-- User Table --}}
            <div class="bg-white rounded-sm border border-gray-200/70 shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-100 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <p class="text-sm text-gray-400">{{ $users->total() }} total users</p>
                    </div>
                    
                    {{-- Search Bar --}}
                    <form action="{{ route('admin.users.index') }}" method="GET" class="relative w-full md:w-80">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none h-full">
                            <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}" 
                               class="block w-full pl-10 pr-10 py-2.5 border border-gray-200 rounded-sm leading-5 bg-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 text-sm transition-all duration-150" 
                               placeholder="Search by name or email...">
                        @if(request('search'))
                            <a href="{{ route('admin.users.index') }}" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 h-full">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                            </a>
                        @endif
                    </form>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="border-b border-gray-100">
                                <th class="px-6 py-3.5 text-xs font-semibold text-gray-400 uppercase tracking-wider">User</th>
                                <th class="px-6 py-3.5 text-xs font-semibold text-gray-400 uppercase tracking-wider">Role</th>
                                <th class="px-6 py-3.5 text-xs font-semibold text-gray-400 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3.5 text-xs font-semibold text-gray-400 uppercase tracking-wider">Joined</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($users as $user)
                                <tr class="hover:bg-gray-50/50 transition-colors duration-100">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-9 h-9 rounded-full flex-shrink-0 flex items-center justify-center text-white font-semibold text-xs
                                                {{ $user->role === 'admin' ? 'bg-rose-500' : ($user->role === 'mentor' ? 'bg-teal-500' : 'bg-violet-500') }}">
                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                            </div>
                                            <div class="min-w-0">
                                                <p class="text-sm font-medium text-gray-900 truncate">{{ $user->name }}</p>
                                                <p class="text-xs text-gray-400 truncate">{{ $user->email }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium capitalize
                                            {{ $user->role === 'admin' ? 'bg-rose-50 text-rose-700' : ($user->role === 'mentor' ? 'bg-teal-50 text-teal-700' : 'bg-violet-50 text-violet-700') }}">
                                            {{ $user->role }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        @php
                                            $status = 'Active';
                                            $statusClass = 'bg-emerald-50 text-emerald-700';
                                            if ($user->role === 'mentor' && $user->mentorProfile) {
                                                if ($user->mentorProfile->status === 'pending') {
                                                    $status = 'Pending';
                                                    $statusClass = 'bg-amber-50 text-amber-700';
                                                } elseif ($user->mentorProfile->status === 'rejected') {
                                                    $status = 'Rejected';
                                                    $statusClass = 'bg-red-50 text-red-700';
                                                }
                                            }
                                        @endphp
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-md text-xs font-medium {{ $statusClass }}">
                                            <span class="w-1.5 h-1.5 rounded-full {{ $status === 'Active' ? 'bg-emerald-500' : ($status === 'Pending' ? 'bg-amber-500' : 'bg-red-500') }}"></span>
                                            {{ $status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500">{{ $user->created_at->format('M d, Y') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-10 text-center text-sm text-gray-400">No users found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                @if($users->hasPages())
                    <div class="px-6 py-4 border-t border-gray-100">
                        {{ $users->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
