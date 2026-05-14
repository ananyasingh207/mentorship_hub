<x-app-layout :hideNav="true">
    <div class="min-h-screen bg-gray-50/80">
        <x-mentor-navbar />

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
            
            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <!-- Create New Slot -->
            <div class="bg-white border border-gray-200 rounded-[2px] shadow-sm overflow-hidden mb-8">
                <div class="p-6">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="h-8 w-8 bg-[#006B52] rounded-[2px] flex items-center justify-center text-white shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 tracking-tight">Create Availability Slot</h3>
                    </div>
                    
                    <form action="{{ route('mentor.slots.store') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-end">
                            <div>
                                <label for="date" class="block text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-2">Date</label>
                                <input type="date" id="date" name="date" class="w-full bg-gray-50 {{ $errors->has('date') ? 'border-red-500' : 'border-gray-200' }} rounded-[2px] text-sm px-4 py-3 focus:border-[#006B52] focus:ring-[#006B52] transition-colors" value="{{ old('date') }}" required>
                                @error('date')
                                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="start_time" class="block text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-2">Start Time</label>
                                <input type="time" id="start_time" name="start_time" class="w-full bg-gray-50 {{ $errors->has('start_time') ? 'border-red-500' : 'border-gray-200' }} rounded-[2px] text-sm px-4 py-3 focus:border-[#006B52] focus:ring-[#006B52] transition-colors" value="{{ old('start_time') }}" required>
                                @error('start_time')
                                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="end_time" class="block text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-2">End Time</label>
                                <input type="time" id="end_time" name="end_time" class="w-full bg-gray-50 {{ $errors->has('end_time') ? 'border-red-500' : 'border-gray-200' }} rounded-[2px] text-sm px-4 py-3 focus:border-[#006B52] focus:ring-[#006B52] transition-colors" value="{{ old('end_time') }}" required>
                                @error('end_time')
                                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-6 flex justify-end">
                            <button type="submit" class="bg-[#006B52] text-white px-8 py-2.5 rounded-[2px] text-sm font-bold hover:bg-[#005a45] transition-all shadow-sm uppercase tracking-widest text-[10px]">
                                Add Slot
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Combined Sessions & Slots Table -->
            <div class="bg-white border border-gray-200 rounded-[2px] shadow-sm overflow-hidden">
                <div class="p-6 border-b border-gray-50 flex justify-between items-center">
                    <div>
                        <h3 class="text-lg font-bold text-gray-900 tracking-tight">Sessions & Availability</h3>
                        <p class="text-xs text-gray-500 font-medium mt-1">Manage your booked sessions and open availability slots in one place.</p>
                    </div>
                </div>
                
                @if($slots->isEmpty())
                    <div class="p-12 text-center text-gray-400 italic text-sm">
                        No slots or sessions found.
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="bg-gray-50 border-b border-gray-100">
                                <tr>
                                    <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Date & Time</th>
                                    <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest text-center">Status</th>
                                    <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Attendee</th>
                                    <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                @foreach($slots as $slot)
                                    <tr class="hover:bg-gray-50/50 transition-colors group">
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-900 font-bold tracking-tight">{{ $slot->date->format('M d, Y') }}</div>
                                            <div class="text-[10px] text-gray-400 font-bold uppercase tracking-tight mt-0.5">
                                                {{ \Carbon\Carbon::parse($slot->start_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($slot->end_time)->format('h:i A') }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            @if($slot->booking)
                                                @if($slot->booking->status === 'completed')
                                                    <span class="px-2.5 py-1 text-[9px] font-bold rounded-full bg-green-50 text-green-600 uppercase tracking-widest border border-green-100">Completed</span>
                                                @elseif($slot->booking->status === 'cancelled')
                                                    <span class="px-2.5 py-1 text-[9px] font-bold rounded-full bg-red-50 text-red-600 uppercase tracking-widest border border-red-100">Cancelled</span>
                                                @else
                                                    <span class="px-2.5 py-1 text-[9px] font-bold rounded-full bg-blue-50 text-blue-600 uppercase tracking-widest border border-blue-100">Booked</span>
                                                @endif
                                            @else
                                                <span class="px-2.5 py-1 text-[9px] font-bold rounded-full bg-gray-50 text-gray-400 uppercase tracking-widest border border-gray-100">Available</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            @if($slot->booking)
                                                <div class="flex items-center gap-3">
                                                    <div class="h-8 w-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-700 font-bold text-[10px] uppercase shadow-inner">
                                                        {{ substr($slot->booking->startup->name, 0, 1) }}{{ str_contains($slot->booking->startup->name, ' ') ? substr(explode(' ', $slot->booking->startup->name)[1], 0, 1) : '' }}
                                                    </div>
                                                    <span class="text-sm font-bold text-gray-900 tracking-tight">{{ $slot->booking->startup->name }}</span>
                                                </div>
                                            @else
                                                <span class="text-xs text-gray-300 italic">—</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            @if($slot->booking && $slot->booking->status === 'scheduled')
                                                <form action="{{ route('mentor.bookings.complete', $slot->booking) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="text-[10px] font-bold text-[#006B52] hover:bg-[#006B52] hover:text-white px-4 py-2 border border-[#006B52] rounded-[2px] transition-all uppercase tracking-widest shadow-sm" onclick="return confirm('Mark this session as completed?')">
                                                        Complete
                                                    </button>
                                                </form>
                                            @elseif(!$slot->booking)
                                                <span class="text-[10px] font-bold text-gray-300 uppercase tracking-widest">No session yet</span>
                                            @else
                                                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Finalized</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
