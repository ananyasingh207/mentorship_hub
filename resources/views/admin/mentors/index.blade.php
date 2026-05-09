<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mentor Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if (session('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr>
                                <th class="border-b py-2 px-4 font-semibold text-gray-600">Name</th>
                                <th class="border-b py-2 px-4 font-semibold text-gray-600">Expertise</th>
                                <th class="border-b py-2 px-4 font-semibold text-gray-600">Pricing</th>
                                <th class="border-b py-2 px-4 font-semibold text-gray-600">Status</th>
                                <th class="border-b py-2 px-4 font-semibold text-gray-600">Created At</th>
                                <th class="border-b py-2 px-4 font-semibold text-gray-600">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($mentors as $mentor)
                                <tr class="hover:bg-gray-50">
                                    <td class="border-b py-2 px-4">{{ $mentor->user->name }}</td>
                                    <td class="border-b py-2 px-4">{{ $mentor->expertise }}</td>
                                    <td class="border-b py-2 px-4 capitalize">{{ $mentor->pricing }}</td>
                                    <td class="border-b py-2 px-4">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            {{ $mentor->status === 'approved' ? 'bg-green-100 text-green-800' : '' }}
                                            {{ $mentor->status === 'rejected' ? 'bg-red-100 text-red-800' : '' }}
                                            {{ $mentor->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}">
                                            {{ ucfirst($mentor->status) }}
                                        </span>
                                    </td>
                                    <td class="border-b py-2 px-4 text-sm text-gray-500">{{ $mentor->created_at->format('Y-m-d') }}</td>
                                    <td class="border-b py-2 px-4">
                                        <div class="flex space-x-2">
                                            @if($mentor->status !== 'approved')
                                                <form action="{{ route('admin.mentors.approve', $mentor->id) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="text-green-600 hover:text-green-900 text-sm font-medium">Approve</button>
                                                </form>
                                            @endif
                                            
                                            @if($mentor->status !== 'rejected')
                                                <form action="{{ route('admin.mentors.reject', $mentor->id) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="text-red-600 hover:text-red-900 text-sm font-medium">Reject</button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="border-b py-4 px-4 text-center text-gray-500">No mentor profiles found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
