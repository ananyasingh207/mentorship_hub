<x-app-layout :hideNav="true">
    <div class="min-h-screen bg-gray-50/80">
        <x-startup-navbar />

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <!-- My Network Section -->
                <div class="mb-12">
                    <div class="mb-8">
                        <h2 class="text-2xl font-bold text-gray-900 tracking-tight">My Network</h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse($connectedMentors as $mentor)
                            <div
                                class="bg-white border border-gray-100 rounded-[2px] p-6 shadow-sm flex items-center justify-between group hover:shadow-md transition-all duration-300">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="h-14 w-14 rounded-full bg-indigo-50 flex items-center justify-center text-indigo-600 font-bold text-xl uppercase shadow-inner border-2 border-white">
                                        {{ substr($mentor->user->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <h4 class="text-base font-bold text-gray-900">{{ $mentor->user->name }}</h4>
                                        <p
                                            class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-0.5 line-clamp-1">
                                            {{ $mentor->expertise }}</p>
                                    </div>
                                </div>
                                <a href="{{ route('messages.show', $mentor->user_id) }}"
                                    class="px-5 py-2 bg-[#006B52] text-white text-[10px] font-bold rounded-[2px] hover:bg-[#005a45] transition-all uppercase tracking-widest shadow-sm">
                                    Message
                                </a>
                            </div>
                        @empty
                            <div
                                class="col-span-full py-8 text-center text-gray-400 italic bg-white/50 border border-dashed border-gray-200 rounded-[2px]">
                                You haven't connected with any mentors yet.
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Discover Mentors Section -->
                <div class="mb-12">
                    <div class="mb-8">
                        <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight mb-2">Discover Mentors</h2>
                        <p class="text-gray-500 font-medium text-lg">Based on your startup's current growth phase.</p>
                    </div>

                    <!-- Filter Bar -->
                    <form action="{{ route('mentors.index') }}" method="GET"
                        class="flex flex-wrap items-center gap-4 mb-10 bg-white p-4 rounded-[2px] border border-gray-100 shadow-sm">
                        <div class="flex-grow min-w-[300px] relative">
                            <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            <input type="text" name="expertise" value="{{ request('expertise') }}"
                                placeholder="Search by name or keyword"
                                class="w-full pl-12 pr-4 py-2.5 bg-gray-50/50 border-gray-100 focus:border-[#006B52] focus:ring-[#006B52] rounded-[2px] text-sm font-medium transition-all">
                        </div>

                        <div class="flex gap-2">
                            <button type="submit"
                                class="px-10 py-2.5 bg-[#006B52] text-white text-[10px] font-bold rounded-[2px] hover:bg-[#005a45] transition-all uppercase tracking-[0.2em] shadow-md">
                                Search
                            </button>
                        </div>
                    </form>

                    <!-- Mentor Cards Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @forelse($mentors as $mentor)
                            @if($loop->first && !request('expertise'))
                                <!-- Featured Card (Wide) -->
                                <div
                                    class="md:col-span-2 lg:col-span-2 bg-white border border-gray-100 rounded-[2px] overflow-hidden shadow-sm hover:shadow-md transition-all duration-300 flex flex-col md:flex-row">
                                    <div
                                        class="md:w-2/5 bg-gradient-to-br from-indigo-500 to-indigo-700 flex items-center justify-center p-12 text-white relative group overflow-hidden">
                                        <div
                                            class="text-8xl font-black opacity-20 group-hover:scale-110 transition-transform duration-500">
                                            {{ substr($mentor->user->name, 0, 1) }}</div>
                                        <div class="absolute inset-0 flex flex-col items-center justify-center">
                                            <div
                                                class="h-32 w-32 rounded-full border-8 border-white/20 flex items-center justify-center text-4xl font-bold bg-white/10 backdrop-blur-sm shadow-2xl">
                                                {{ substr($mentor->user->name, 0, 1) }}
                                            </div>
                                            <div
                                                class="mt-4 px-3 py-1 bg-white/20 backdrop-blur-md rounded-full text-[10px] font-bold uppercase tracking-[0.3em]">
                                                Verified Expert</div>
                                        </div>
                                    </div>
                                    <div class="p-8 md:w-3/5 flex flex-col justify-between">
                                        <div>
                                            <div class="flex justify-between items-start mb-4">
                                                <div>
                                                    <h3 class="text-3xl font-extrabold text-gray-900 tracking-tighter mb-1">
                                                        {{ $mentor->user->name }}</h3>
                                                    <div class="flex items-center gap-3">
                                                        <div class="flex items-center text-yellow-400">
                                                            <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                                                <path
                                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                            </svg>
                                                            <span
                                                                class="text-sm font-black ml-1 text-gray-900">{{ $mentor->avg_rating }}</span>
                                                        </div>
                                                        <span
                                                            class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">({{ $mentor->review_count }}
                                                            reviews)</span>
                                                    </div>
                                                </div>
                                                @if($mentor->match_score)
                                                    <div class="text-right">
                                                        <p class="text-2xl font-black text-[#006B52] tracking-tighter">
                                                            {{ $mentor->match_score }}%</p>
                                                        <p class="text-[9px] font-bold text-gray-400 uppercase tracking-widest">
                                                            Match</p>
                                                    </div>
                                                @endif
                                            </div>
                                            <p class="text-gray-500 text-sm leading-relaxed mb-6 line-clamp-3 italic">"Experienced professional with expertise in {{ $mentor->expertise }}. Focused on helping individuals and teams grow through guidance, strategy, and real world insights."</p>
                                            <div class="flex flex-wrap gap-2 mb-8">
                                                @foreach(explode(',', $mentor->expertise) as $tag)
                                                    <span
                                                        class="px-3 py-1 bg-indigo-50 text-indigo-600 text-[10px] font-bold rounded-[2px] uppercase tracking-widest">{{ trim($tag) }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                        <a href="{{ route('mentors.show', $mentor) }}"
                                            class="w-full py-4 bg-[#006B52] text-white text-center text-[11px] font-bold rounded-[2px] hover:bg-[#005a45] transition-all uppercase tracking-[0.3em] shadow-lg">
                                            View Full Profile
                                        </a>
                                    </div>
                                </div>
                            @else
                                <!-- Standard Card (Grid) -->
                                <div
                                    class="bg-white border border-gray-100 rounded-[2px] p-8 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col items-center text-center group">
                                    <div
                                        class="h-24 w-24 rounded-full bg-gray-50 flex items-center justify-center text-gray-300 font-bold text-3xl uppercase shadow-inner border-4 border-white mb-6 group-hover:border-indigo-100 group-hover:text-indigo-600 transition-all duration-500">
                                        {{ substr($mentor->user->name, 0, 1) }}
                                    </div>
                                    <h3 class="text-xl font-bold text-gray-900 tracking-tight mb-1">{{ $mentor->user->name }}
                                    </h3>
                                    <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4 line-clamp-1">
                                        Expert in {{ $mentor->expertise }}</p>

                                    <div class="flex items-center gap-3 mb-6">
                                        <div class="flex items-center text-yellow-400">
                                            <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 20 20">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                            <span class="text-xs font-black ml-1 text-gray-900">{{ $mentor->avg_rating }}</span>
                                        </div>
                                        @if($mentor->match_score)
                                            <span class="text-xs font-black text-[#006B52]">{{ $mentor->match_score }}% Match</span>
                                        @endif
                                    </div>

                                    <div class="flex flex-wrap justify-center gap-2 mb-8">
                                        @foreach(explode(',', $mentor->expertise) as $tag)
                                            @if($loop->index < 2)
                                                <span
                                                    class="px-2.5 py-1 bg-gray-50 text-gray-500 text-[9px] font-bold rounded-[2px] uppercase tracking-widest">{{ trim($tag) }}</span>
                                            @endif
                                        @endforeach
                                    </div>

                                    <a href="{{ route('mentors.show', $mentor) }}"
                                        class="w-full py-2.5 border-2 border-gray-100 text-gray-900 text-[10px] font-bold rounded-[2px] hover:bg-gray-50 hover:border-gray-200 transition-all uppercase tracking-widest">
                                        View Profile
                                    </a>
                                </div>
                            @endif
                        @empty
                            <div
                                class="col-span-full py-20 text-center bg-white rounded-[2px] border border-dashed border-gray-200">
                                <p class="text-gray-400 font-bold italic tracking-tight">No mentors found matching your
                                    criteria.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
</x-app-layout>