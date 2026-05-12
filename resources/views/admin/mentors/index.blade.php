<x-app-layout :hideNav="true">
    <div class="min-h-screen bg-gray-50/80">

        <x-admin-navbar />

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            {{-- ── PAGE HEADER ── --}}
            <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 tracking-tight">Mentor Management</h1>
                    <p class="mt-1 text-sm text-gray-500">Review and manage mentor applications and statuses.</p>
                </div>
            </div>

            {{-- ── FLASH MESSAGES ── --}}
            @if (session('success'))
                <div class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-sm text-sm flex items-center gap-2" role="alert">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-sm text-sm flex items-center gap-2" role="alert">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                    {{ session('error') }}
                </div>
            @endif

            {{-- ── MENTOR TABLE ── --}}
            <div class="bg-white rounded-sm border border-gray-200/70 shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-100">
                    <p class="text-sm text-gray-400">{{ $mentors->total() }} total mentor profiles</p>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="border-b border-gray-100">
                                <th class="px-6 py-3.5 text-xs font-semibold text-gray-400 uppercase tracking-wider">Mentor</th>
                                <th class="px-6 py-3.5 text-xs font-semibold text-gray-400 uppercase tracking-wider">Expertise</th>
                                <th class="px-6 py-3.5 text-xs font-semibold text-gray-400 uppercase tracking-wider">Pricing</th>
                                <th class="px-6 py-3.5 text-xs font-semibold text-gray-400 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3.5 text-xs font-semibold text-gray-400 uppercase tracking-wider">Created</th>
                                <th class="px-6 py-3.5 text-xs font-semibold text-gray-400 uppercase tracking-wider text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($mentors as $mentor)
                                <tr class="hover:bg-gray-50/50 transition-colors duration-100">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-9 h-9 rounded-full bg-gradient-to-br from-teal-400 to-emerald-500 flex-shrink-0 flex items-center justify-center text-white font-semibold text-xs">
                                                {{ strtoupper(substr($mentor->user->name, 0, 1)) }}
                                            </div>
                                            <div class="min-w-0">
                                                <p class="text-sm font-medium text-gray-900 truncate">{{ $mentor->user->name }}</p>
                                                <p class="text-xs text-gray-400 truncate">{{ $mentor->experience }} years</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-wrap gap-1">
                                            @foreach(array_slice(explode(',', $mentor->expertise), 0, 2) as $tag)
                                                <span class="inline-block px-2 py-0.5 text-[10px] font-medium bg-gray-100 text-gray-600 rounded-sm">{{ trim($tag) }}</span>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="text-sm font-medium text-gray-700 capitalize">{{ $mentor->pricing }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        @php
                                            $statusClass = [
                                                'approved' => 'bg-emerald-50 text-emerald-700',
                                                'pending' => 'bg-amber-50 text-amber-700',
                                                'rejected' => 'bg-red-50 text-red-700',
                                            ][$mentor->status] ?? 'bg-gray-50 text-gray-700';
                                            
                                            $dotClass = [
                                                'approved' => 'bg-emerald-500',
                                                'pending' => 'bg-amber-500',
                                                'rejected' => 'bg-red-500',
                                            ][$mentor->status] ?? 'bg-gray-500';
                                        @endphp
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-sm text-xs font-medium {{ $statusClass }}">
                                            <span class="w-1.5 h-1.5 rounded-full {{ $dotClass }}"></span>
                                            {{ ucfirst($mentor->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500">
                                        {{ $mentor->created_at->format('M d, Y') }}
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            @if($mentor->status !== 'approved')
                                                <form action="{{ route('admin.mentors.approve', $mentor->id) }}" method="POST">
                                                    @csrf @method('PATCH')
                                                    <button type="submit" class="p-1.5 text-emerald-600 hover:bg-emerald-50 rounded-sm transition-colors" title="Approve">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                                    </button>
                                                </form>
                                            @endif
                                            
                                            @if($mentor->status !== 'rejected')
                                                <form action="{{ route('admin.mentors.reject', $mentor->id) }}" method="POST">
                                                    @csrf @method('PATCH')
                                                    <button type="submit" class="p-1.5 text-red-600 hover:bg-red-50 rounded-sm transition-colors" title="Reject">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-10 text-center text-sm text-gray-400">No mentor profiles found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                @if($mentors->hasPages())
                    <div class="px-6 py-4 border-t border-gray-100">
                        {{ $mentors->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
