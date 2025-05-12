<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Documents') }}
            </h2>
            @can('create', App\Models\Document::class)
            <button type="button" onclick="window.dispatchEvent(new CustomEvent('open-modal', { detail: 'upload-document-modal' }))" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-md shadow-md flex items-center transition-all duration-200 hover:shadow-lg" style="background-color: #10b981; color: white;">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                {{ __('Upload Document') }}
            </button>
            @endcan
        </div>
    </x-slot>

    @push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
    <style>
        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter,
        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_processing,
        .dataTables_wrapper .dataTables_paginate {
            margin-bottom: 10px;
            margin-top: 10px;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 0.25rem 0.5rem;
            margin-left: 2px;
            border-radius: 0.25rem;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background-color: #3b82f6 !important;
            border-color: #3b82f6 !important;
            color: white !important;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background-color: #93c5fd !important;
            border-color: #93c5fd !important;
            color: #1e40af !important;
        }
        table.dataTable tbody tr:hover {
            background-color: #f3f4f6;
        }
    </style>
    @endpush

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @can('create', App\Models\Document::class)
                    <div class="fixed bottom-8 right-8 z-10">
                        <button type="button" onclick="window.dispatchEvent(new CustomEvent('open-modal', { detail: 'upload-document-modal' }))" class="flex items-center justify-center h-16 w-16 rounded-full bg-green-500 text-white shadow-xl hover:bg-green-600 hover:shadow-2xl transform hover:scale-110 transition-all duration-300 focus:outline-none focus:ring-4 focus:ring-green-300 focus:ring-opacity-50" style="background-color: #10b981; color: white;">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                            </svg>
                            <span class="sr-only">{{ __('Upload Document') }}</span>
                        </button>
                    </div>
                    @endcan
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table id="documents-table" class="min-w-full bg-white stripe hover">
                            <thead>
                                <tr>
                                    <th class="py-3 px-4 border-b-2 border-gray-300 bg-gray-100 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">
                                        {{ __('File Name') }}
                                    </th>
                                    <th class="py-3 px-4 border-b-2 border-gray-300 bg-gray-100 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">
                                        {{ __('Type') }}
                                    </th>
                                    <th class="py-3 px-4 border-b-2 border-gray-300 bg-gray-100 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">
                                        {{ __('From') }}
                                    </th>
                                    <th class="py-3 px-4 border-b-2 border-gray-300 bg-gray-100 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">
                                        {{ __('To') }}
                                    </th>
                                    <th class="py-3 px-4 border-b-2 border-gray-300 bg-gray-100 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">
                                        {{ __('Status') }}
                                    </th>
                                    <th class="py-3 px-4 border-b-2 border-gray-300 bg-gray-100 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">
                                        {{ __('Date') }}
                                    </th>
                                    <th class="py-3 px-4 border-b-2 border-gray-300 bg-gray-100 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">
                                        {{ __('Actions') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($documents as $document)
                                    <tr>
                                        <td class="py-3 px-4 border-b border-gray-200">
                                            <div class="font-medium text-gray-900">{{ $document->original_file_name }}</div>
                                            @if($document->is_encrypted)
                                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-indigo-100 text-indigo-800">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                                    </svg>
                                                    {{ __('Encrypted') }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="py-3 px-4 border-b border-gray-200">
                                            <div class="text-gray-700">{{ $document->fileType->name }}</div>
                                        </td>
                                        <td class="py-3 px-4 border-b border-gray-200">
                                            <div class="text-gray-700">{{ $document->fromDepartment->getLocalizedName(app()->getLocale()) }}</div>
                                        </td>
                                        <td class="py-3 px-4 border-b border-gray-200">
                                            <div class="text-gray-700">{{ $document->toDepartment->getLocalizedName(app()->getLocale()) }}</div>
                                        </td>
                                        <td class="py-3 px-4 border-b border-gray-200">
                                            @if($document->status === 'pending')
                                                <button type="button" class="px-3 py-1 inline-flex items-center text-sm font-medium rounded-md bg-yellow-500 text-white border border-yellow-600 shadow-sm" style="background-color: #eab308; color: white;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                                    </svg>
                                                    {{ __('Pending') }}
                                                </button>
                                            @elseif($document->status === 'received')
                                                <button type="button" class="px-3 py-1 inline-flex items-center text-sm font-medium rounded-md bg-blue-500 text-white border border-blue-600 shadow-sm" style="background-color: #3b82f6; color: white;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                                        <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                                    </svg>
                                                    {{ __('Received') }}
                                                </button>
                                            @elseif($document->status === 'completed')
                                                <button type="button" class="px-3 py-1 inline-flex items-center text-sm font-medium rounded-md bg-green-500 text-white border border-green-600 shadow-sm" style="background-color: #10b981; color: white;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                    </svg>
                                                    {{ __('Completed') }}
                                                </button>
                                            @elseif($document->status === 'rejected')
                                                <button type="button" class="px-3 py-1 inline-flex items-center text-sm font-medium rounded-md bg-red-500 text-white border border-red-600 shadow-sm" style="background-color: #ef4444; color: white;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                                    </svg>
                                                    {{ __('Rejected') }}
                                                </button>
                                            @endif
                                        </td>
                                        <td class="py-3 px-4 border-b border-gray-200">
                                            <div class="text-gray-700">{{ $document->created_at->format('M d, Y') }}</div>
                                            <div class="text-xs text-gray-500">{{ $document->created_at->format('h:i A') }}</div>
                                        </td>
                                        <td class="py-3 px-4 border-b border-gray-200">
                                            <div class="flex flex-wrap items-center gap-3">
                                                <a href="{{ route('documents.show', $document) }}" class="inline-flex items-center px-3 py-2 border border-blue-300 text-sm font-medium rounded-md shadow-sm text-white bg-blue-500 hover:bg-blue-600 hover:shadow-md transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" style="background-color: #3b82f6; color: white;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" viewBox="0 0 20 20" fill="currentColor">
                                                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                                        <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                                    </svg>
                                                    {{ __('View') }}
                                                </a>

                                                @can('download', $document)
                                                <a href="{{ route('documents.download', $document) }}" class="inline-flex items-center px-3 py-2 border border-green-300 text-sm font-medium rounded-md shadow-sm text-white bg-green-500 hover:bg-green-600 hover:shadow-md transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500" style="background-color: #10b981; color: white;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                    </svg>
                                                    {{ __('Download') }}
                                                </a>
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="py-8 px-4 border-b border-gray-200">
                                            <div class="flex flex-col items-center justify-center text-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                                <p class="text-gray-500 text-lg font-medium">{{ __('No documents found.') }}</p>
                                                <p class="text-gray-400 mt-1">{{ __('Upload a new document to get started.') }}</p>
                                                @can('create', App\Models\Document::class)
                                                <button type="button" onclick="window.dispatchEvent(new CustomEvent('open-modal', { detail: 'upload-document-modal' }))" class="mt-4 inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-500 hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500" style="background-color: #10b981; color: white;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                                                    </svg>
                                                    {{ __('Upload Document') }}
                                                </button>
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $documents->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Upload Document Modal -->
    <x-modal-form id="upload-document-modal" :title="__('Upload Document')" :submit="route('documents.store')" enctype="multipart/form-data">
        <div class="space-y-4">
            <div>
                <x-input-label for="file" :value="__('Document File')" />
                <input id="file" name="file" type="file" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required />
                <x-input-error :messages="$errors->get('file')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="file_type_id" :value="__('Document Type')" />
                <select id="file_type_id" name="file_type_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                    <option value="">{{ __('Select Document Type') }}</option>
                    @foreach(\App\Models\FileType::where('is_active', true)->get() as $fileType)
                        <option value="{{ $fileType->id }}">{{ $fileType->getLocalizedName(app()->getLocale()) }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('file_type_id')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="from_department_id" :value="__('From Department')" />
                <select id="from_department_id" name="from_department_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                    <option value="">{{ __('Select Department') }}</option>
                    @foreach(\App\Models\Department::where('is_active', true)->get() as $department)
                        <option value="{{ $department->id }}">{{ $department->getLocalizedName(app()->getLocale()) }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('from_department_id')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="to_department_id" :value="__('To Department')" />
                <select id="to_department_id" name="to_department_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                    <option value="">{{ __('Select Department') }}</option>
                    @foreach(\App\Models\Department::where('is_active', true)->get() as $department)
                        <option value="{{ $department->id }}">{{ $department->getLocalizedName(app()->getLocale()) }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('to_department_id')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="description" :value="__('Description')" />
                <textarea id="description" name="description" rows="3" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"></textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="reference_number" :value="__('Reference Number')" />
                <x-text-input id="reference_number" name="reference_number" type="text" class="mt-1 block w-full" />
                <x-input-error :messages="$errors->get('reference_number')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="date" :value="__('Document Date')" />
                <x-text-input id="date" name="date" type="date" class="mt-1 block w-full" :value="date('Y-m-d')" required />
                <x-input-error :messages="$errors->get('date')" class="mt-2" />
            </div>

            <div class="flex items-center">
                <input id="is_encrypted" name="is_encrypted" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" value="1">
                <label for="is_encrypted" class="ml-2 block text-sm text-gray-900">{{ __('Encrypt Document') }}</label>
            </div>
        </div>
    </x-modal-form>

    @push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#documents-table').DataTable({
                responsive: true,
                paging: false, // Disable DataTables paging as we're using Laravel pagination
                language: {
                    search: "{{ __('Search') }}:",
                    info: "{{ __('Showing _START_ to _END_ of _TOTAL_ entries') }}",
                    infoEmpty: "{{ __('Showing 0 to 0 of 0 entries') }}",
                    infoFiltered: "{{ __('(filtered from _MAX_ total entries)') }}",
                },
                columnDefs: [
                    { orderable: false, targets: 6 } // Disable sorting on the actions column
                ]
            });

            // Debug modal functionality
            console.log('Documents index page loaded');

            // Add event listeners to debug modal events
            window.addEventListener('open-modal', function(event) {
                console.log('open-modal event triggered globally with detail:', event.detail);
            });
        });
    </script>
    @endpush
</x-app-layout>
