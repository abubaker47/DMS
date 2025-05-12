<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('File Types') }}
            </h2>
            @can('create', App\Models\FileType::class)
            <button type="button" onclick="window.dispatchEvent(new CustomEvent('open-modal', { detail: 'create-file-type-modal' }))" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-md shadow-md flex items-center transition-all duration-200 hover:shadow-lg" style="background-color: #10b981; color: white;">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                {{ __('Create File Type') }}
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
                        <table id="file-types-table" class="min-w-full bg-white stripe hover">
                            <thead>
                                <tr>
                                    <th class="py-3 px-4 border-b-2 border-gray-300 bg-gray-100 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">
                                        {{ __('Name') }}
                                    </th>
                                    <th class="py-3 px-4 border-b-2 border-gray-300 bg-gray-100 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">
                                        {{ __('Extension') }}
                                    </th>
                                    <th class="py-3 px-4 border-b-2 border-gray-300 bg-gray-100 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">
                                        {{ __('MIME Type') }}
                                    </th>
                                    <th class="py-3 px-4 border-b-2 border-gray-300 bg-gray-100 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">
                                        {{ __('Status') }}
                                    </th>
                                    <th class="py-3 px-4 border-b-2 border-gray-300 bg-gray-100 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">
                                        {{ __('Actions') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($fileTypes as $fileType)
                                    <tr>
                                        <td class="py-3 px-4 border-b border-gray-200">
                                            <div class="font-medium text-gray-900">{{ $fileType->getLocalizedName(app()->getLocale()) }}</div>
                                        </td>
                                        <td class="py-3 px-4 border-b border-gray-200">
                                            <div class="text-gray-700 uppercase">.{{ $fileType->extension }}</div>
                                        </td>
                                        <td class="py-3 px-4 border-b border-gray-200">
                                            <div class="text-gray-700">{{ $fileType->mime_type }}</div>
                                        </td>
                                        <td class="py-3 px-4 border-b border-gray-200">
                                            @if($fileType->is_active)
                                                <button type="button" class="px-3 py-1 inline-flex items-center text-sm font-medium rounded-md bg-green-500 text-white border border-green-600 shadow-sm" style="background-color: #10b981; color: white;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                    </svg>
                                                    {{ __('Active') }}
                                                </button>
                                            @else
                                                <button type="button" class="px-3 py-1 inline-flex items-center text-sm font-medium rounded-md bg-red-500 text-white border border-red-600 shadow-sm" style="background-color: #ef4444; color: white;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                                    </svg>
                                                    {{ __('Inactive') }}
                                                </button>
                                            @endif
                                        </td>
                                        <td class="py-3 px-4 border-b border-gray-200">
                                            <div class="flex flex-wrap items-center gap-3">

                                                @can('update', $fileType)
                                                <button type="button" onclick="window.dispatchEvent(new CustomEvent('open-modal', { detail: 'edit-file-type-modal-{{ $fileType->id }}' }))" class="inline-flex items-center px-3 py-2 border border-yellow-300 text-sm font-medium rounded-md shadow-sm text-white bg-yellow-500 hover:bg-yellow-600 hover:shadow-md transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500" style="background-color: #eab308; color: white;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" viewBox="0 0 20 20" fill="currentColor">
                                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                                    </svg>
                                                </button>
                                                @endcan

                                                @can('delete', $fileType)
                                                <form action="{{ route('file-types.destroy', $fileType) }}" method="POST" class="inline delete-form" data-file-type-name="{{ $fileType->getLocalizedName(app()->getLocale()) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="inline-flex items-center px-3 py-2 border border-red-300 text-sm font-medium rounded-md shadow-sm text-white bg-red-500 hover:bg-red-600 hover:shadow-md transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500" style="background-color: #ef4444; color: white;">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" viewBox="0 0 20 20" fill="currentColor">
                                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                        </svg>
                                                    </button>
                                                </form>
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="py-8 px-4 border-b border-gray-200">
                                            <div class="flex flex-col items-center justify-center text-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                                <p class="text-gray-500 text-lg font-medium">{{ __('No file types found.') }}</p>
                                                <p class="text-gray-400 mt-1">{{ __('Create a new file type to get started.') }}</p>
                                                @can('create', App\Models\FileType::class)
                                                <button type="button" onclick="window.dispatchEvent(new CustomEvent('open-modal', { detail: 'create-file-type-modal' }))" class="mt-4 inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-500 hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500" style="background-color: #10b981; color: white;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                                                    </svg>
                                                    {{ __('Create File Type') }}
                                                </button>
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Create File Type Modal -->
    <x-modal-form id="create-file-type-modal" :title="__('Create File Type')" :submit="route('file-types.store')">
        <div class="space-y-4">
            <div>
                <x-input-label for="name_en" :value="__('Name (English)')" />
                <x-text-input id="name_en" name="name_en" type="text" class="mt-1 block w-full" required />
                <x-input-error :messages="$errors->get('name_en')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="name_dari" :value="__('Name (Dari)')" />
                <x-text-input id="name_dari" name="name_dari" type="text" class="mt-1 block w-full" required />
                <x-input-error :messages="$errors->get('name_dari')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="name_pashto" :value="__('Name (Pashto)')" />
                <x-text-input id="name_pashto" name="name_pashto" type="text" class="mt-1 block w-full" required />
                <x-input-error :messages="$errors->get('name_pashto')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="extension" :value="__('File Extension')" />
                <x-text-input id="extension" name="extension" type="text" class="mt-1 block w-full" required placeholder="pdf" />
                <x-input-error :messages="$errors->get('extension')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="mime_type" :value="__('MIME Type')" />
                <x-text-input id="mime_type" name="mime_type" type="text" class="mt-1 block w-full" required placeholder="application/pdf" />
                <x-input-error :messages="$errors->get('mime_type')" class="mt-2" />
            </div>

            <div class="flex items-center">
                <input id="is_active" name="is_active" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" value="1" checked>
                <label for="is_active" class="ml-2 block text-sm text-gray-900">{{ __('Active') }}</label>
            </div>
        </div>
    </x-modal-form>

    <!-- Edit File Type Modals -->
    @foreach($fileTypes as $fileType)
    <x-modal-form id="edit-file-type-modal-{{ $fileType->id }}" :title="__('Edit File Type')" :submit="route('file-types.update', $fileType)" method="PUT">
        <div class="space-y-4">
            <div>
                <x-input-label for="name_en-{{ $fileType->id }}" :value="__('Name (English)')" />
                <x-text-input id="name_en-{{ $fileType->id }}" name="name_en" type="text" class="mt-1 block w-full" :value="$fileType->getTranslation('name', 'en')" required />
                <x-input-error :messages="$errors->get('name_en')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="name_dari-{{ $fileType->id }}" :value="__('Name (Dari)')" />
                <x-text-input id="name_dari-{{ $fileType->id }}" name="name_dari" type="text" class="mt-1 block w-full" :value="$fileType->getTranslation('name', 'dari')" required />
                <x-input-error :messages="$errors->get('name_dari')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="name_pashto-{{ $fileType->id }}" :value="__('Name (Pashto)')" />
                <x-text-input id="name_pashto-{{ $fileType->id }}" name="name_pashto" type="text" class="mt-1 block w-full" :value="$fileType->getTranslation('name', 'pashto')" required />
                <x-input-error :messages="$errors->get('name_pashto')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="extension-{{ $fileType->id }}" :value="__('File Extension')" />
                <x-text-input id="extension-{{ $fileType->id }}" name="extension" type="text" class="mt-1 block w-full" :value="$fileType->extension" required />
                <x-input-error :messages="$errors->get('extension')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="mime_type-{{ $fileType->id }}" :value="__('MIME Type')" />
                <x-text-input id="mime_type-{{ $fileType->id }}" name="mime_type" type="text" class="mt-1 block w-full" :value="$fileType->mime_type" required />
                <x-input-error :messages="$errors->get('mime_type')" class="mt-2" />
            </div>

            <div class="flex items-center">
                <input id="is_active-{{ $fileType->id }}" name="is_active" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" value="1" {{ $fileType->is_active ? 'checked' : '' }}>
                <label for="is_active-{{ $fileType->id }}" class="ml-2 block text-sm text-gray-900">{{ __('Active') }}</label>
            </div>
        </div>
    </x-modal-form>
    @endforeach

    @push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#file-types-table').DataTable({
                responsive: true,
                language: {
                    search: "{{ __('Search') }}:",
                    lengthMenu: "{{ __('Show _MENU_ entries') }}",
                    info: "{{ __('Showing _START_ to _END_ of _TOTAL_ entries') }}",
                    infoEmpty: "{{ __('Showing 0 to 0 of 0 entries') }}",
                    infoFiltered: "{{ __('(filtered from _MAX_ total entries)') }}",
                    paginate: {
                        first: "{{ __('First') }}",
                        last: "{{ __('Last') }}",
                        next: "{{ __('Next') }}",
                        previous: "{{ __('Previous') }}"
                    }
                },
                columnDefs: [
                    { orderable: false, targets: 4 } // Disable sorting on the actions column
                ]
            });

            // Enhanced delete confirmation
            $('.delete-form').on('submit', function(e) {
                e.preventDefault();
                const form = $(this);
                const fileTypeName = form.data('file-type-name');

                if (confirm("{{ __('Are you sure you want to delete') }} " + fileTypeName + "?")) {
                    form.off('submit').submit();
                }
            });

            // Debug modal functionality
            console.log('File Types index page loaded');

            // Add event listeners to debug modal events
            window.addEventListener('open-modal', function(event) {
                console.log('open-modal event triggered globally with detail:', event.detail);
            });
        });
    </script>
    @endpush
</x-app-layout>
