<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Job Applications') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <!-- "Add New Application" and "Download as Excel" Buttons Side by Side -->
                <div class="flex space-x-4 mb-6">
                    <a href="{{ route('job-applications.create') }}" class="flex items-center bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded transition">
                        <i class="fas fa-plus mr-2"></i>
                        Add New Application
                    </a>

                    <a href="{{ route('job-applications.export') }}" class="flex items-center bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition">
                        <i class="fas fa-file-excel mr-2"></i>
                        Download as Excel
                    </a>
                </div>

                <!-- Filtering Form -->
                <form method="GET" action="{{ route('job-applications.index') }}" class="mb-6">
                    <label for="search" class="block text-gray-700 mb-2">Search:</label>
                    <input type="text" name="search" id="search" class="form-control w-full mb-4" value="{{ request('search') }}">
                    <button type="submit" class="flex items-center bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        <i class="fas fa-search mr-2"></i>
                        Search
                    </button>
                </form>
                
                <form method="GET" action="{{ route('job-applications.index') }}" class="mb-6">
                    <label for="status" class="block text-gray-700 mb-2">Filter by Status:</label>
                    <select name="status" id="status" class="form-control w-full mb-4">
                        <option value="">All Applications</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="interview" {{ request('status') == 'interview' ? 'selected' : '' }}>Interview Scheduled</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        <option value="offered" {{ request('status') == 'offered' ? 'selected' : '' }}>Offer Received</option>
                    </select>
                    <button type="submit" class="flex items-center bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        <i class="fas fa-filter mr-2"></i>
                        Filter
                    </button>
                </form>

                <!-- Application List -->
                @if($applications->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto bg-white rounded-lg shadow" style="table-layout: fixed;">
                            <thead class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <tr>
                                    <th class="py-3 px-6 text-left" style="width: 25%;">
                                        <a href="{{ route('job-applications.index', array_merge(request()->query(), ['sort' => 'position', 'direction' => request()->query('sort') == 'position' && request()->query('direction') == 'asc' ? 'desc' : 'asc'])) }}" class="flex items-center group">
                                            Position
                                            <span class="ml-1">
                                                @if(request()->query('sort') == 'position')
                                                    <i class="fas fa-sort-{{ request()->query('direction') == 'asc' ? 'up' : 'down' }}"></i>
                                                @else
                                                    <i class="fas fa-sort text-gray-400 group-hover:text-gray-600"></i>
                                                @endif
                                            </span>
                                        </a>
                                    </th>
                                    <th class="py-3 px-6 text-left" style="width: 20%;">
                                        <a href="{{ route('job-applications.index', array_merge(request()->query(), ['sort' => 'company_name', 'direction' => request()->query('sort') == 'company_name' && request()->query('direction') == 'asc' ? 'desc' : 'asc'])) }}" class="flex items-center group">
                                            Company
                                            <span class="ml-1">
                                                @if(request()->query('sort') == 'company_name')
                                                    <i class="fas fa-sort-{{ request()->query('direction') == 'asc' ? 'up' : 'down' }}"></i>
                                                @else
                                                    <i class="fas fa-sort text-gray-400 group-hover:text-gray-600"></i>
                                                @endif
                                            </span>
                                        </a>
                                    </th>
                                    <th class="py-3 px-6 text-left" style="width: 20%;">
                                        <a href="{{ route('job-applications.index', array_merge(request()->query(), ['sort' => 'applied_at', 'direction' => request()->query('sort') == 'applied_at' && request()->query('direction') == 'asc' ? 'desc' : 'asc'])) }}" class="flex items-center group">
                                            Application Date
                                            <span class="ml-1">
                                                @if(request()->query('sort') == 'applied_at')
                                                    <i class="fas fa-sort-{{ request()->query('direction') == 'asc' ? 'up' : 'down' }}"></i>
                                                @else
                                                    <i class="fas fa-sort text-gray-400 group-hover:text-gray-600"></i>
                                                @endif
                                            </span>
                                        </a>
                                    </th>
                                    <th class="py-3 px-6 text-left" style="width: 20%;">
                                        <a href="{{ route('job-applications.index', array_merge(request()->query(), ['sort' => 'status', 'direction' => request()->query('sort') == 'status' && request()->query('direction') == 'asc' ? 'desc' : 'asc'])) }}" class="flex items-center group">
                                            Status
                                            <span class="ml-1">
                                                @if(request()->query('sort') == 'status')
                                                    <i class="fas fa-sort-{{ request()->query('direction') == 'asc' ? 'up' : 'down' }}"></i>
                                                @else
                                                    <i class="fas fa-sort text-gray-400 group-hover:text-gray-600"></i>
                                                @endif
                                            </span>
                                        </a>
                                    </th>
                                    <th class="py-3 px-6 text-left" style="width: 15%;">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-700 text-sm font-light">
                                @foreach($applications as $application)
                                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                                        <td class="py-3 px-6 text-left">{{ $application->position }}</td>
                                        <td class="py-3 px-6 text-left">{{ $application->company_name }}</td>
                                        <td class="py-3 px-6 text-left">{{ $application->applied_at }}</td>
                                        <td class="py-3 px-6 text-left">
                                            @if($application->status == 'pending')
                                                <span class="bg-yellow-200 text-yellow-800 px-2 py-1 rounded">Pending</span>
                                            @elseif($application->status == 'interview')
                                                <span class="bg-green-200 text-green-800 px-2 py-1 rounded">Interview Scheduled</span>
                                            @elseif($application->status == 'rejected')
                                                <span class="bg-red-200 text-red-800 px-2 py-1 rounded">Rejected</span>
                                            @elseif($application->status == 'offered')
                                                <span class="bg-blue-200 text-blue-800 px-2 py-1 rounded">Offer Received</span>
                                            @endif
                                        </td>
                                        <td class="py-3 px-6 text-left">
                                            <div class="relative inline-block">
                                                <a href="{{ route('job-applications.show', $application->id) }}" class="text-blue-500 hover:underline group" title="Details">
                                                    <i class="fas fa-eye"></i>
                                                    <span class="absolute left-1/2 transform -translate-x-1/2 -translate-y-full bg-gray-700 text-white text-xs rounded py-1 px-2 opacity-0 group-hover:opacity-100 transition-opacity duration-200">Details</span>
                                                </a>
                                            </div>
                                            <div class="relative inline-block">
                                                <a href="{{ route('job-applications.edit', $application->id) }}" class="text-yellow-500 hover:underline ml-4 group" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                    <span class="absolute left-1/2 transform -translate-x-1/2 -translate-y-full bg-gray-700 text-white text-xs rounded py-1 px-2 opacity-0 group-hover:opacity-100 transition-opacity duration-200">Edit</span>
                                                </a>
                                            </div>
                                            <div class="relative inline-block">
                                                <button onclick="openModal({{ $application->id }})" class="text-red-500 hover:underline ml-4 group" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                    <span class="absolute left-1/2 transform -translate-x-1/2 -translate-y-full bg-gray-700 text-white text-xs rounded py-1 px-2 opacity-0 group-hover:opacity-100 transition-opacity duration-200">Delete</span>
                                                </button>
                                            </div>
                                            <!-- Modal -->
                                            <div id="modal-{{ $application->id }}" class="fixed inset-0 flex items-center justify-center z-50 hidden">
                                                <div class="bg-black opacity-50 absolute inset-0"></div>
                                                <div class="bg-white rounded-lg p-6 z-10">
                                                    <h3 class="text-lg font-semibold mb-4">Confirm Deletion</h3>
                                                    <p>Are you sure you want to delete this application?</p>
                                                    <div class="mt-4">
                                                        <form action="{{ route('job-applications.destroy', $application->id) }}" method="POST" class="inline-block">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="bg-red-500 text-white font-bold py-2 px-4 rounded">Delete</button>
                                                        </form>
                                                        <button onclick="closeModal({{ $application->id }})" class="ml-4 bg-gray-300 text-gray-700 font-bold py-2 px-4 rounded">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <script>
                                                function openModal(id) {
                                                    document.getElementById('modal-' + id).classList.remove('hidden');
                                                }
                                                function closeModal(id) {
                                                    document.getElementById('modal-' + id).classList.add('hidden');
                                                }
                                            </script>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $applications->appends(request()->input())->links() }}
                    </div>
                @else
                    <p>No applications found.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>