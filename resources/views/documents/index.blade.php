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
                        <div id="success-alert" class="flex items-center p-4 mb-4 text-green-800 border-t-4 border-green-500 bg-green-50 rounded-lg shadow-md animate-fade-in" role="alert">
                            <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-600 bg-green-100 rounded-lg">
                                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                                </svg>
                                <span class="sr-only">Success icon</span>
                            </div>
                            <div class="ml-3 text-sm font-medium">
                                {{ session('success') }}
                            </div>
                            <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#success-alert" aria-label="Close" onclick="this.parentElement.remove()">
                                <span class="sr-only">Close</span>
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                            </button>
                        </div>

                        <style>
                            @keyframes fadeIn {
                                from { opacity: 0; transform: translateY(-10px); }
                                to { opacity: 1; transform: translateY(0); }
                            }
                            .animate-fade-in {
                                animation: fadeIn 0.3s ease-out forwards;
                            }
                        </style>

                        <script>
                            // Auto-dismiss the alert after 5 seconds
                            setTimeout(function() {
                                const alert = document.getElementById('success-alert');
                                if (alert) {
                                    alert.style.opacity = '0';
                                    alert.style.transform = 'translateY(-10px)';
                                    alert.style.transition = 'opacity 0.3s ease-out, transform 0.3s ease-out';
                                    setTimeout(function() {
                                        if (alert.parentNode) {
                                            alert.parentNode.removeChild(alert);
                                        }
                                    }, 300);
                                }
                            }, 5000);
                        </script>
                    @endif

                    @if(session('error'))
                        <div id="error-alert" class="flex items-center p-4 mb-4 text-red-800 border-t-4 border-red-500 bg-red-50 rounded-lg shadow-md animate-fade-in" role="alert">
                            <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-red-600 bg-red-100 rounded-lg">
                                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z"/>
                                </svg>
                                <span class="sr-only">Error icon</span>
                            </div>
                            <div class="ml-3 text-sm font-medium">
                                {{ session('error') }}
                            </div>
                            <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#error-alert" aria-label="Close" onclick="this.parentElement.remove()">
                                <span class="sr-only">Close</span>
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                            </button>
                        </div>

                        <script>
                            // Auto-dismiss the error alert after 5 seconds
                            setTimeout(function() {
                                const alert = document.getElementById('error-alert');
                                if (alert) {
                                    alert.style.opacity = '0';
                                    alert.style.transform = 'translateY(-10px)';
                                    alert.style.transition = 'opacity 0.3s ease-out, transform 0.3s ease-out';
                                    setTimeout(function() {
                                        if (alert.parentNode) {
                                            alert.parentNode.removeChild(alert);
                                        }
                                    }, 300);
                                }
                            }, 5000);
                        </script>
                    @endif

                    <div class="overflow-x-auto">
                        <table id="documents-table" class="min-w-full bg-white stripe hover w-full">
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
                                                <button type="button" onclick="openDocumentModal({{ $document->id }})" class="inline-flex items-center px-3 py-2 border border-blue-300 text-sm font-medium rounded-md shadow-sm text-white bg-blue-500 hover:bg-blue-600 hover:shadow-md transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" style="background-color: #3b82f6; color: white;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" viewBox="0 0 20 20" fill="currentColor">
                                                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                                        <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                                    </svg>
                                                    {{ __('View') }}
                                                </button>

                                                <button type="button" onclick="openFilePreviewModal({{ $document->id }})" class="inline-flex items-center px-3 py-2 border border-purple-300 text-sm font-medium rounded-md shadow-sm text-white bg-purple-500 hover:bg-purple-600 hover:shadow-md transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500" style="background-color: #8b5cf6; color: white;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
                                                    </svg>
                                                    {{ __('Preview File') }}
                                                </button>

                                                @can('download', $document)
                                                <a href="{{ route('documents.download', $document) }}" class="inline-flex items-center px-3 py-2 border border-green-300 text-sm font-medium rounded-md shadow-sm text-white bg-green-500 hover:bg-green-600 hover:shadow-md transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500" style="background-color: #10b981; color: white;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                    </svg>
                                                    {{ __('Download') }}
                                                </a>
                                                @endcan

                                                @can('delete', $document)
                                                <button type="button" onclick="deleteDocument({{ $document->id }})" class="inline-flex items-center px-3 py-2 border border-red-300 text-sm font-medium rounded-md shadow-sm text-white bg-red-500 hover:bg-red-600 hover:shadow-md transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500" style="background-color: #ef4444; color: white;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                    </svg>
                                                    {{ __('Delete') }}
                                                </button>
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="no-data-row">
                                        <td colspan="7" class="py-8 px-4 border-b border-gray-200">
                                            <div class="flex flex-col items-center justify-center text-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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

    <!-- Document View Modal -->
    <x-modal name="document-view-modal" maxWidth="2xl">
        <div class="px-6 py-4 bg-gray-100 border-b">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-medium text-gray-900" id="document-modal-title">
                    {{ __('Document Details') }}
                </h3>
                <button type="button" onclick="window.dispatchEvent(new CustomEvent('close-modal', { detail: 'document-view-modal' }))" class="text-gray-400 hover:text-gray-500">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <div class="p-6">
            <div id="document-loading" class="flex justify-center items-center py-8">
                <svg class="animate-spin h-10 w-10 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span class="ml-3 text-gray-600">{{ __('Loading document details...') }}</span>
            </div>

            <div id="document-content" class="hidden">
                <div class="mb-6">
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <span class="block text-sm font-medium text-gray-500">{{ __('File Name') }}</span>
                            <span id="document-filename" class="block mt-1 text-gray-900"></span>
                        </div>
                        <div>
                            <span class="block text-sm font-medium text-gray-500">{{ __('File Type') }}</span>
                            <span id="document-filetype" class="block mt-1 text-gray-900"></span>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <span class="block text-sm font-medium text-gray-500">{{ __('Status') }}</span>
                            <span id="document-status" class="block mt-1"></span>
                        </div>
                        <div>
                            <span class="block text-sm font-medium text-gray-500">{{ __('Encrypted') }}</span>
                            <span id="document-encrypted" class="block mt-1 text-gray-900"></span>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <span class="block text-sm font-medium text-gray-500">{{ __('From Department') }}</span>
                            <span id="document-from" class="block mt-1 text-gray-900"></span>
                        </div>
                        <div>
                            <span class="block text-sm font-medium text-gray-500">{{ __('To Department') }}</span>
                            <span id="document-to" class="block mt-1 text-gray-900"></span>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <span class="block text-sm font-medium text-gray-500">{{ __('Created By') }}</span>
                            <span id="document-creator" class="block mt-1 text-gray-900"></span>
                        </div>
                        <div>
                            <span class="block text-sm font-medium text-gray-500">{{ __('Created Date') }}</span>
                            <span id="document-created" class="block mt-1 text-gray-900"></span>
                        </div>
                    </div>
                </div>

                <div class="mb-6">
                    <h4 class="text-lg font-semibold text-gray-700 mb-4">{{ __('Description') }}</h4>
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                        <p id="document-description" class="text-gray-700 whitespace-pre-line"></p>
                    </div>
                </div>

                <div class="mb-4">
                    <h4 class="text-lg font-semibold text-gray-700 mb-2">{{ __('Document History') }}</h4>
                    <div class="overflow-x-auto max-h-40 overflow-y-auto border border-gray-200 rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50 sticky top-0">
                                <tr>
                                    <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Date') }}</th>
                                    <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('User') }}</th>
                                    <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody id="document-history" class="bg-white divide-y divide-gray-200">
                                <!-- History items will be inserted here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div id="document-error" class="hidden">
                <div class="bg-red-50 border-l-4 border-red-400 p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-red-700" id="document-error-message">
                                {{ __('Error loading document details.') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="px-6 py-4 bg-gray-100 border-t flex justify-between">
            <div>
                <button id="document-status-btn" type="button" class="hidden items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150">
                    {{ __('Update Status') }}
                </button>
            </div>
            <div>
                <button type="button" onclick="window.dispatchEvent(new CustomEvent('close-modal', { detail: 'document-view-modal' }))" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                    {{ __('Close') }}
                </button>
                <a id="document-download-btn" href="#" class="hidden ml-3 items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150" style="background-color: #10b981; color: white;">
                    {{ __('Download') }}
                </a>
            </div>
        </div>
    </x-modal>

    <!-- File Preview Modal -->
    <x-modal name="file-preview-modal" maxWidth="xl">
        <div class="px-4 py-3 bg-gray-100 border-b">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-medium text-gray-900" id="file-preview-title">
                    {{ __('File Preview') }}
                </h3>
                <button type="button" onclick="window.dispatchEvent(new CustomEvent('close-modal', { detail: 'file-preview-modal' }))" class="text-gray-400 hover:text-gray-500">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <div class="p-4">
            <div id="file-preview-loading" class="flex justify-center items-center py-6">
                <svg class="animate-spin h-8 w-8 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span class="ml-3 text-gray-600">{{ __('Loading file preview...') }}</span>
            </div>

            <div id="file-preview-content" class="hidden">
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="relative" style="height: 40vh; max-height: 400px;">
                        <iframe id="file-preview-iframe" src="" class="absolute inset-0 w-full h-full border-0" allowfullscreen></iframe>
                    </div>
                </div>
            </div>

            <div id="file-preview-error" class="hidden">
                <div class="bg-red-50 border-l-4 border-red-400 p-3">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-4 w-4 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-2">
                            <p class="text-xs text-red-700" id="file-preview-error-message">
                                {{ __('Error loading file preview.') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="px-4 py-3 bg-gray-100 border-t flex justify-end">
            <button type="button" onclick="window.dispatchEvent(new CustomEvent('close-modal', { detail: 'file-preview-modal' }))" class="inline-flex items-center px-3 py-1.5 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition-all duration-150">
                {{ __('Close') }}
            </button>
            <a id="file-preview-download-btn" href="#" class="ml-2 inline-flex items-center px-3 py-1.5 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-all duration-150" style="background-color: #10b981; color: white;">
                {{ __('Download') }}
            </a>
        </div>
    </x-modal>

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
        // Function to open file preview modal
        function openFilePreviewModal(documentId) {
            // Show loading state
            $('#file-preview-loading').removeClass('hidden');
            $('#file-preview-content').addClass('hidden');
            $('#file-preview-error').addClass('hidden');

            // Set the iframe src to empty initially
            $('#file-preview-iframe').attr('src', '');

            // Open the modal
            window.dispatchEvent(new CustomEvent('open-modal', { detail: 'file-preview-modal' }));

            // Set the iframe source to the preview URL
            const previewUrl = '/documents/' + documentId + '/preview';

            // Update the title
            $('#file-preview-title').text('{{ __("File Preview") }}');

            // Set download button URL
            $('#file-preview-download-btn').attr('href', '/documents/' + documentId + '/download');

            // Wait a moment for the modal to open, then load the file
            setTimeout(function() {
                // Set the iframe source
                $('#file-preview-iframe').attr('src', previewUrl);

                // Handle iframe load events
                $('#file-preview-iframe').on('load', function() {
                    // Success - iframe loaded, hide loading indicator
                    $('#file-preview-loading').addClass('hidden');
                    $('#file-preview-content').removeClass('hidden');
                }).on('error', function() {
                    // Error loading iframe
                    $('#file-preview-loading').addClass('hidden');
                    $('#file-preview-error').removeClass('hidden');
                    $('#file-preview-error-message').text('{{ __("Error loading file preview.") }}');
                });

                // Set a timeout to show content even if load event doesn't fire
                setTimeout(function() {
                    if ($('#file-preview-loading').is(':visible')) {
                        $('#file-preview-loading').addClass('hidden');
                        $('#file-preview-content').removeClass('hidden');
                    }
                }, 2000);
            }, 300);
        }

        // Function to open document modal and load document details
        function openDocumentModal(documentId) {
            // Show loading state
            $('#document-loading').removeClass('hidden');
            $('#document-content').addClass('hidden');
            $('#document-error').addClass('hidden');

            // Reset download button
            $('#document-download-btn').addClass('hidden');

            // Open the modal
            window.dispatchEvent(new CustomEvent('open-modal', { detail: 'document-view-modal' }));

            // Fetch document details via AJAX
            $.ajax({
                url: '/documents/' + documentId,
                type: 'GET',
                dataType: 'json',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                success: function(response) {
                    // Hide loading, show content
                    $('#document-loading').addClass('hidden');
                    $('#document-content').removeClass('hidden');

                    // Populate document details
                    const document = response.document;

                    // Basic info
                    $('#document-modal-title').text('{{ __("Document") }}: ' + document.original_file_name);
                    $('#document-filename').text(document.original_file_name);
                    $('#document-filetype').text(document.file_type.name);

                    // Status with appropriate styling
                    let statusHtml = '';
                    switch(document.status) {
                        case 'pending':
                            statusHtml = '<span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">{{ __("Pending") }}</span>';
                            break;
                        case 'received':
                            statusHtml = '<span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">{{ __("Received") }}</span>';
                            break;
                        case 'completed':
                            statusHtml = '<span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">{{ __("Completed") }}</span>';
                            break;
                        case 'rejected':
                            statusHtml = '<span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">{{ __("Rejected") }}</span>';
                            break;
                    }
                    $('#document-status').html(statusHtml);

                    // Encryption status
                    $('#document-encrypted').text(document.is_encrypted ? '{{ __("Yes") }}' : '{{ __("No") }}');

                    // Dates
                    $('#document-created').text(new Date(document.created_at).toLocaleString());
                    $('#document-viewed').text(document.viewed_at ? new Date(document.viewed_at).toLocaleString() : '{{ __("Not viewed yet") }}');

                    // Routing info
                    $('#document-from').text(document.from_department.name);
                    $('#document-to').text(document.to_department.name);
                    $('#document-creator').text(document.creator ? document.creator.name : '{{ __("Unknown") }}');
                    $('#document-reference').text(document.reference_number || '{{ __("None") }}');

                    // Description
                    $('#document-description').text(document.description || '{{ __("No description provided") }}');

                    // History
                    const historyContainer = $('#document-history');
                    historyContainer.empty();

                    if (response.histories && response.histories.length > 0) {
                        response.histories.forEach(function(history) {
                            const row = $('<tr>');

                            // Date
                            row.append($('<td class="px-3 py-2 whitespace-nowrap text-xs text-gray-500">').text(
                                new Date(history.created_at).toLocaleString()
                            ));

                            // User
                            row.append($('<td class="px-3 py-2 whitespace-nowrap text-xs font-medium text-gray-900">').text(
                                history.user ? history.user.name : '{{ __("System") }}'
                            ));

                            // Action
                            let actionText = '';
                            switch(history.action) {
                                case 'created':
                                    actionText = '{{ __("Created") }}';
                                    break;
                                case 'viewed':
                                    actionText = '{{ __("Viewed") }}';
                                    break;
                                case 'downloaded':
                                    actionText = '{{ __("Downloaded") }}';
                                    break;
                                case 'status_updated':
                                    actionText = '{{ __("Status Updated") }}';
                                    break;
                                default:
                                    actionText = history.action;
                            }
                            row.append($('<td class="px-3 py-2 whitespace-nowrap text-xs text-gray-500">').text(actionText));

                            historyContainer.append(row);
                        });
                    } else {
                        const emptyRow = $('<tr>');
                        emptyRow.append($('<td colspan="3" class="px-3 py-2 text-center text-xs text-gray-500">').text('{{ __("No history available") }}'));
                        historyContainer.append(emptyRow);
                    }

                    // Show download button if user can download
                    if (response.can_download) {
                        $('#document-download-btn')
                            .removeClass('hidden')
                            .addClass('inline-flex')
                            .attr('href', '/documents/' + document.id + '/download');
                    }

                    // Show status update button if user can update status
                    if (response.can_update_status) {
                        $('#document-status-btn')
                            .removeClass('hidden')
                            .addClass('inline-flex')
                            .on('click', function() {
                                // You can implement status update functionality here
                                alert('Status update functionality to be implemented');
                            });

                        // Set button color based on current status
                        switch(document.status) {
                            case 'pending':
                                $('#document-status-btn').addClass('bg-blue-600 hover:bg-blue-700 focus:ring-blue-500');
                                $('#document-status-btn').text('{{ __("Mark as Received") }}');
                                break;
                            case 'received':
                                $('#document-status-btn').addClass('bg-green-600 hover:bg-green-700 focus:ring-green-500');
                                $('#document-status-btn').text('{{ __("Mark as Completed") }}');
                                break;
                            default:
                                $('#document-status-btn').addClass('hidden').removeClass('inline-flex');
                        }
                    }
                },
                error: function(xhr, status, error) {
                    // Hide loading, show error
                    $('#document-loading').addClass('hidden');
                    $('#document-error').removeClass('hidden');

                    // Set error message
                    let errorMessage = '{{ __("Error loading document details.") }}';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    }
                    $('#document-error-message').text(errorMessage);

                    console.error('Error fetching document:', error);
                }
            });
        }

        // Function to delete a document
        function deleteDocument(documentId) {
            if (confirm('{{ __("Are you sure you want to delete this document? This action cannot be undone.") }}')) {
                // Send AJAX request to delete the document
                $.ajax({
                    url: '/documents/' + documentId,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        // Show success message
                        const alertHtml = `
                            <div id="delete-success-alert" class="flex items-center p-4 mb-4 text-green-800 border-t-4 border-green-500 bg-green-50 rounded-lg shadow-md animate-fade-in" role="alert">
                                <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-600 bg-green-100 rounded-lg">
                                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                                    </svg>
                                    <span class="sr-only">Success icon</span>
                                </div>
                                <div class="ml-3 text-sm font-medium">
                                    ${response.message}
                                </div>
                                <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#delete-success-alert" aria-label="Close" onclick="this.parentElement.remove()">
                                    <span class="sr-only">Close</span>
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                    </svg>
                                </button>
                            </div>
                        `;

                        // Add the alert to the page
                        $('.p-6.text-gray-900').prepend(alertHtml);

                        // Reload the page after a short delay
                        setTimeout(function() {
                            window.location.reload();
                        }, 1500);
                    },
                    error: function(xhr, status, error) {
                        // Show error message
                        let errorMessage = '{{ __("Error deleting document.") }}';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }

                        const alertHtml = `
                            <div id="delete-error-alert" class="flex items-center p-4 mb-4 text-red-800 border-t-4 border-red-500 bg-red-50 rounded-lg shadow-md animate-fade-in" role="alert">
                                <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-red-600 bg-red-100 rounded-lg">
                                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z"/>
                                    </svg>
                                    <span class="sr-only">Error icon</span>
                                </div>
                                <div class="ml-3 text-sm font-medium">
                                    ${errorMessage}
                                </div>
                                <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#delete-error-alert" aria-label="Close" onclick="this.parentElement.remove()">
                                    <span class="sr-only">Close</span>
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                    </svg>
                                </button>
                            </div>
                        `;

                        // Add the alert to the page
                        $('.p-6.text-gray-900').prepend(alertHtml);
                    }
                });
            }
        }

        $(document).ready(function() {
            // Debug modal functionality
            console.log('Documents index page loaded');

            // Add event listeners to debug modal events
            window.addEventListener('open-modal', function(event) {
                console.log('open-modal event triggered globally with detail:', event.detail);
            });

            // Modal will only open when the view button is clicked

            // Only initialize DataTables if we have actual data rows and not just the empty state
            // This prevents the column count mismatch error
            if ($('#documents-table tbody tr').length > 0 && !$('#documents-table tbody tr.no-data-row').length) {
                try {
                    console.log('Initializing DataTable with data rows');
                    $('#documents-table').DataTable({
                        responsive: true,
                        paging: false, // Disable DataTables paging as we're using Laravel pagination
                        ordering: true,
                        searching: true,
                        info: true,
                        language: {
                            search: "{{ __('Search') }}:",
                            info: "{{ __('Showing _START_ to _END_ of _TOTAL_ entries') }}",
                            infoEmpty: "{{ __('Showing 0 to 0 of 0 entries') }}",
                            infoFiltered: "{{ __('(filtered from _MAX_ total entries)') }}",
                            emptyTable: "{{ __('No data available in table') }}"
                        },
                        columnDefs: [
                            { orderable: false, targets: 6 } // Disable sorting on the actions column (index 6)
                        ],
                        drawCallback: function() {
                            // Hide pagination controls from DataTables as we're using Laravel's
                            $('.dataTables_paginate, .dataTables_info').hide();
                        }
                    });
                    console.log('DataTable initialized successfully');
                } catch (error) {
                    console.error('Error initializing DataTable:', error);
                }
            } else {
                console.log('No data rows found or empty state with colspan detected - skipping DataTable initialization');
            }
        });
    </script>
    @endpush
</x-app-layout>
