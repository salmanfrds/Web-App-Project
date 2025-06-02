@extends('layout')
@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="overflow-hidden rounded-lg bg-white shadow border-black border-2">
        <div class="bg-blue-600 px-4 py-3 text-white">
            <h2 class="font-medium">Activities List</h5>
        </div>
        <div class="px-4 py-5 sm:p-6">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-700">ID</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-700">Title</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-700">Description</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-700">Start Date</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-700">End Date</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-700">Status</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-700">Category</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @forelse ($john as $activity)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 font-medium text-gray-900">{{ $activity->activity_id }}</td>
                                <td class="px-6 py-4 text-gray-800">{{ $activity->title }}</td>
                                <td class="px-6 py-4 text-gray-800">{{ Str::limit($activity->description, 50) }}</td>
                                <td class="px-6 py-4"><span class="rounded-full bg-blue-100 px-2 py-1 text-xs font-semibold text-blue-800">{{ \Carbon\Carbon::parse($activity->start_date)->format('M d, Y') }}</span></td>
                                <td class="px-6 py-4"><span class="rounded-full bg-yellow-100 px-2 py-1 text-xs font-semibold text-yellow-800">{{ \Carbon\Carbon::parse($activity->end_date)->format('M d, Y') }}</span></td>
                                <td class="px-6 py-4">
                                    @if($activity->status == 'active')
                                        <span class="rounded-full bg-green-100 px-2 py-1 text-xs font-semibold text-green-800">Active</span>
                                    @elseif($activity->status == 'completed')
                                        <span class="rounded-full bg-gray-100 px-2 py-1 text-xs font-semibold text-gray-800">Completed</span>
                                    @else
                                        <span class="rounded-full bg-red-100 px-2 py-1 text-xs font-semibold text-red-800">{{ $activity->status }}</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4"><span class="rounded-full bg-blue-100 px-2 py-1 text-xs font-semibold text-blue-800">{{ $activity->category }}</span></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-4 text-center text-gray-500">No activities found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="fixed bottom-6 right-6">
                    <a href="/activities/add" class="flex items-center justify-center rounded-full bg-blue-600 p-3 text-white shadow-lg hover:bg-blue-700 transition duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    <span class="ml-2 mr-1">Add Activity</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
