<x-app-layout :hideNav="true">
    <div class="min-h-screen bg-gray-50/80">
        <x-admin-navbar />

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            {{-- ── PAGE HEADER ── --}}
            <div class="mb-8">
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 tracking-tight">Admin Workspace</h1>
                <p class="mt-1 text-sm text-gray-500">Manage platform growth and user approvals.</p>
            </div>

            {{-- ── FLASH MESSAGES ── --}}
            @if (session('success'))
                <div class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-sm text-sm" role="alert">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-sm text-sm" role="alert">{{ session('error') }}</div>
            @endif

            {{-- ── ANALYTICS STAT CARDS ── --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 mb-10">
                {{-- Total Users --}}
                <div class="bg-white rounded-sm border border-gray-200/70 shadow-sm p-6 hover:shadow-md transition-shadow duration-200">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Total Users</span>
                        <div class="w-10 h-10 rounded-sm bg-teal-50 flex items-center justify-center">
                            <svg class="w-5 h-5 text-teal-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                    </div>
                    <div class="text-3xl font-bold text-gray-900">{{ $totalUsers }}</div>
                    <div class="mt-2 flex items-center gap-1.5 text-xs text-gray-400">
                        <span class="inline-flex items-center gap-0.5 text-emerald-600 font-medium">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
                            {{ $totalStartups + $totalMentors }}
                        </span>
                        registered accounts
                    </div>
                </div>

                {{-- Session Stats --}}
                <div class="bg-white rounded-sm border border-gray-200/70 shadow-sm p-6 hover:shadow-md transition-shadow duration-200">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Total Sessions</span>
                        <div class="w-10 h-10 rounded-sm bg-emerald-50 flex items-center justify-center">
                            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                    </div>
                    <div class="text-3xl font-bold text-gray-900">{{ $totalBookings }}</div>
                    <div class="mt-4 space-y-2">
                        <div class="flex items-center justify-between text-xs">
                            <span class="text-gray-500">Completed</span>
                            <span class="font-semibold text-emerald-600">{{ $completedSessions }}</span>
                        </div>
                        <div class="flex items-center justify-between text-xs">
                            <span class="text-gray-500">Scheduled</span>
                            <span class="font-semibold text-teal-600">{{ $scheduledSessions }}</span>
                        </div>
                        <div class="flex items-center justify-between text-xs">
                            <span class="text-gray-500">Cancelled</span>
                            <span class="font-semibold text-red-600">{{ $cancelledSessions }}</span>
                        </div>
                    </div>
                </div>

                {{-- Platform Split --}}
                <div class="bg-white rounded-sm border border-gray-200/70 shadow-sm p-6 hover:shadow-md transition-shadow duration-200 sm:col-span-2 lg:col-span-1">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Platform Split</span>
                        <div class="w-10 h-10 rounded-sm bg-violet-50 flex items-center justify-center">
                            <svg class="w-5 h-5 text-violet-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/><path stroke-linecap="round" stroke-linejoin="round" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/></svg>
                        </div>
                    </div>
                    <div class="space-y-3">
                        <div>
                            <div class="flex items-center justify-between text-sm mb-1">
                                <span class="text-gray-600 font-medium">Mentors</span>
                                <span class="text-gray-900 font-semibold">{{ $mentorPercentage }}%</span>
                            </div>
                            <div class="w-full h-2 bg-gray-100 rounded-full overflow-hidden">
                                <div class="h-full bg-gradient-to-r from-teal-400 to-teal-500 rounded-full transition-all duration-500" style="width: {{ $mentorPercentage }}%"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex items-center justify-between text-sm mb-1">
                                <span class="text-gray-600 font-medium">Startups</span>
                                <span class="text-gray-900 font-semibold">{{ $startupPercentage }}%</span>
                            </div>
                            <div class="w-full h-2 bg-gray-100 rounded-full overflow-hidden">
                                <div class="h-full bg-gradient-to-r from-violet-400 to-violet-500 rounded-full transition-all duration-500" style="width: {{ $startupPercentage }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ── PENDING MENTOR APPROVALS ── --}}
            <div class="mb-10">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-sm bg-white border border-gray-200 flex items-center justify-center shadow-sm">
                            <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-gray-900 tracking-tight">Pending Mentor Approvals</h2>
                            <p class="text-sm text-gray-500">{{ $pendingMentors->count() }} profiles awaiting review</p>
                        </div>
                    </div>
                    <a href="{{ route('admin.mentors.index') }}" class="text-sm font-semibold text-teal-600 hover:text-teal-700 transition-colors flex items-center gap-1.5 group">
                        View All
                        <svg class="w-4 h-4 transform group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>

                @if($pendingMentors->isEmpty())
                    <div class="bg-white rounded-sm border border-gray-200/70 shadow-sm p-12 text-center">
                        <div class="w-16 h-16 rounded-full bg-gray-50 flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <h3 class="text-gray-900 font-semibold text-lg">All caught up!</h3>
                        <p class="text-gray-500 mt-1 max-w-xs mx-auto">There are no new mentor applications to review at this moment.</p>
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
                        @foreach($pendingMentors->take(6) as $mentor)
                            <div class="bg-white rounded-sm border-t-4 border-teal-600 shadow-sm border-x border-b border-gray-200/70 p-6 flex flex-col hover:shadow-md transition-all duration-300">
                                <div class="flex items-start justify-between mb-4">
                                    <div class="flex items-center gap-4 min-w-0">
                                        <div class="w-14 h-14 rounded-full bg-gradient-to-br from-teal-100 to-emerald-100 flex-shrink-0 flex items-center justify-center border-2 border-white shadow-sm overflow-hidden">
                                            <div class="text-teal-700 font-bold text-lg">
                                                {{ strtoupper(substr($mentor->user->name, 0, 1)) }}
                                            </div>
                                        </div>
                                        <div class="min-w-0">
                                            <h3 class="text-base font-bold text-gray-900 truncate tracking-tight">{{ $mentor->user->name }}</h3>
                                            <p class="text-sm text-gray-500 truncate leading-relaxed">{{ $mentor->experience }} years</p>
                                        </div>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-[11px] font-semibold bg-blue-50 text-blue-600 border border-blue-100">
                                            {{ $mentor->created_at->diffForHumans(null, true) }} ago
                                        </span>
                                    </div>
                                </div>

                                <div class="flex flex-wrap gap-2 mb-6">
                                    @foreach(array_slice(explode(',', $mentor->expertise), 0, 3) as $tag)
                                        <span class="inline-block px-3 py-1 text-xs font-medium bg-gray-100 text-gray-600 rounded-full border border-gray-200/50">
                                            {{ trim($tag) }}
                                        </span>
                                    @endforeach
                                </div>

                                <div class="flex items-center gap-3 mt-auto">
                                    <form action="{{ route('admin.mentors.approve', $mentor->id) }}" method="POST" class="flex-1">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-3 text-sm font-bold text-white bg-[#00695C] hover:bg-[#004D40] rounded-sm transition-all duration-200 shadow-sm">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                            Approve
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.mentors.reject', $mentor->id) }}" method="POST" class="flex-1">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-3 text-sm font-bold text-gray-600 bg-white border border-gray-300 hover:bg-gray-50 hover:border-gray-400 rounded-sm transition-all duration-200">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                                            Reject
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- ── USER DIRECTORY TABLE ── --}}
            <div class="bg-white rounded-sm border border-gray-200/70 shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                    <div>
                        <h2 class="text-lg font-semibold text-gray-900">User Directory</h2>
                        <p class="text-sm text-gray-400 mt-0.5">{{ $totalUsers }} total users on the platform</p>
                    </div>
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
                                                {{ $user->role === 'admin' ? 'bg-gradient-to-br from-rose-400 to-pink-500' : ($user->role === 'mentor' ? 'bg-gradient-to-br from-teal-400 to-emerald-500' : 'bg-gradient-to-br from-violet-400 to-purple-500') }}">
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

                {{-- View All Button --}}
                <div class="px-6 py-4 border-t border-gray-100 flex justify-end">
                    <a href="{{ route('admin.users.index') }}" class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium text-teal-600 hover:text-teal-700 hover:bg-teal-50 rounded-lg transition-colors duration-150">
                        View All
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
