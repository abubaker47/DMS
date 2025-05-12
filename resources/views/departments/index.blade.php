<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Departments') }}
            </h2>
            @can('create', App\Models\Department::class)
            <button type="button" onclick="window.dispatchEvent(new CustomEvent('open-modal', { detail: 'create-department-modal' }))" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-md shadow-md flex items-center transition-all duration-200 hover:shadow-lg" style="background-color: #10b981; color: white;">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                {{ __('Create Department') }}
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
                        <table id="departments-table" class="min-w-full bg-white stripe hover">
                            <thead>
                                <tr>
                                    <th class="py-3 px-4 border-b-2 border-gray-300 bg-gray-100 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">
                                        {{ __('Name') }}
                                    </th>
                                    <th class="py-3 px-4 border-b-2 border-gray-300 bg-gray-100 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">
                                        {{ __('Description') }}
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
                                @forelse($departments as $department)
                                    <tr>
                                        <td class="py-3 px-4 border-b border-gray-200">
                                            <div class="font-medium text-gray-900">{{ $department->getLocalizedName(app()->getLocale()) }}</div>
                                        </td>
                                        <td class="py-3 px-4 border-b border-gray-200">
                                            <div class="text-gray-700">{{ $department->getLocalizedDescription(app()->getLocale()) }}</div>
                                        </td>
                                        <td class="py-3 px-4 border-b border-gray-200">
                                            @if($department->is_active)
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
                                                <a href="{{ route('departments.show', $department) }}" class="inline-flex items-center px-3 py-2 border border-blue-300 text-sm font-medium rounded-md shadow-sm text-white bg-blue-500 hover:bg-blue-600 hover:shadow-md transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" style="background-color: #3b82f6; color: white;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" viewBox="0 0 20 20" fill="currentColor">
                                                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                                        <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                                    </svg>
                                                    {{ __('View') }}
                                                </a>

                                                @can('update', $department)
                                                <button type="button" onclick="window.dispatchEvent(new CustomEvent('open-modal', { detail: 'edit-department-modal-{{ $department->id }}' }))" class="inline-flex items-center px-3 py-2 border border-yellow-300 text-sm font-medium rounded-md shadow-sm text-white bg-yellow-500 hover:bg-yellow-600 hover:shadow-md transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500" style="background-color: #eab308; color: white;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" viewBox="0 0 20 20" fill="currentColor">
                                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                                    </svg>
                                                    {{ __('Edit') }}
                                                </button>
                                                @endcan

                                                @can('delete', $department)
                                                <form action="{{ route('departments.destroy', $department) }}" method="POST" class="inline delete-form" data-department-name="{{ $department->getLocalizedName(app()->getLocale()) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="inline-flex items-center px-3 py-2 border border-red-300 text-sm font-medium rounded-md shadow-sm text-white bg-red-500 hover:bg-red-600 hover:shadow-md transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500" style="background-color: #ef4444; color: white;">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" viewBox="0 0 20 20" fill="currentColor">
                                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                        </svg>
                                                        {{ __('Delete') }}
                                                    </button>
                                                </form>
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="py-8 px-4 border-b border-gray-200">
                                            <div class="flex flex-col items-center justify-center text-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                                </svg>
                                                <p class="text-gray-500 text-lg font-medium">{{ __('No departments found.') }}</p>
                                                <p class="text-gray-400 mt-1">{{ __('Create a new department to get started.') }}</p>
                                                @can('create', App\Models\Department::class)
                                                <button type="button" onclick="window.dispatchEvent(new CustomEvent('open-modal', { detail: 'create-department-modal' }))" class="mt-4 inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-500 hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500" style="background-color: #10b981; color: white;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                                                    </svg>
                                                    {{ __('Create Department') }}
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

    <!-- Create Department Modal -->
    <x-modal-form id="create-department-modal" :title="__('Create Department')" :submit="route('departments.store')">
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
                <x-input-label for="description_en" :value="__('Description (English)')" />
                <textarea id="description_en" name="description_en" rows="3" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"></textarea>
                <x-input-error :messages="$errors->get('description_en')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="description_dari" :value="__('Description (Dari)')" />
                <textarea id="description_dari" name="description_dari" rows="3" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"></textarea>
                <x-input-error :messages="$errors->get('description_dari')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="description_pashto" :value="__('Description (Pashto)')" />
                <textarea id="description_pashto" name="description_pashto" rows="3" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"></textarea>
                <x-input-error :messages="$errors->get('description_pashto')" class="mt-2" />
            </div>

            <div class="flex items-center">
                <input id="is_active" name="is_active" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" value="1" checked>
                <label for="is_active" class="ml-2 block text-sm text-gray-900">{{ __('Active') }}</label>
            </div>
        </div>
    </x-modal-form>

    <!-- Edit Department Modals -->
    @foreach($departments as $department)
    <x-modal-form id="edit-department-modal-{{ $department->id }}" :title="__('Edit Department')" :submit="route('departments.update', $department)" method="PUT">
        <div class="space-y-4">
            <div>
                <x-input-label for="name_en-{{ $department->id }}" :value="__('Name (English)')" />
                <x-text-input id="name_en-{{ $department->id }}" name="name_en" type="text" class="mt-1 block w-full" :value="$department->getTranslation('name', 'en')" required />
                <x-input-error :messages="$errors->get('name_en')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="name_dari-{{ $department->id }}" :value="__('Name (Dari)')" />
                <x-text-input id="name_dari-{{ $department->id }}" name="name_dari" type="text" class="mt-1 block w-full" :value="$department->getTranslation('name', 'dari')" required />
                <x-input-error :messages="$errors->get('name_dari')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="name_pashto-{{ $department->id }}" :value="__('Name (Pashto)')" />
                <x-text-input id="name_pashto-{{ $department->id }}" name="name_pashto" type="text" class="mt-1 block w-full" :value="$department->getTranslation('name', 'pashto')" required />
                <x-input-error :messages="$errors->get('name_pashto')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="description_en-{{ $department->id }}" :value="__('Description (English)')" />
                <textarea id="description_en-{{ $department->id }}" name="description_en" rows="3" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ $department->getTranslation('description', 'en') }}</textarea>
                <x-input-error :messages="$errors->get('description_en')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="description_dari-{{ $department->id }}" :value="__('Description (Dari)')" />
                <textarea id="description_dari-{{ $department->id }}" name="description_dari" rows="3" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ $department->getTranslation('description', 'dari') }}</textarea>
                <x-input-error :messages="$errors->get('description_dari')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="description_pashto-{{ $department->id }}" :value="__('Description (Pashto)')" />
                <textarea id="description_pashto-{{ $department->id }}" name="description_pashto" rows="3" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ $department->getTranslation('description', 'pashto') }}</textarea>
                <x-input-error :messages="$errors->get('description_pashto')" class="mt-2" />
            </div>

            <div class="flex items-center">
                <input id="is_active-{{ $department->id }}" name="is_active" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" value="1" {{ $department->is_active ? 'checked' : '' }}>
                <label for="is_active-{{ $department->id }}" class="ml-2 block text-sm text-gray-900">{{ __('Active') }}</label>
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
            $('#departments-table').DataTable({
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
                    { orderable: false, targets: 3 } // Disable sorting on the actions column
                ]
            });

            // Enhanced delete confirmation
            $('.delete-form').on('submit', function(e) {
                e.preventDefault();
                const form = $(this);
                const departmentName = form.data('department-name');

                if (confirm("{{ __('Are you sure you want to delete') }} " + departmentName + "?")) {
                    form.off('submit').submit();
                }
            });

            // Debug modal functionality
            console.log('Department index page loaded');

            // Add test button for direct modal opening
            const testButton = document.createElement('button');
            testButton.textContent = 'Test Modal';
            testButton.style.position = 'fixed';
            testButton.style.top = '10px';
            testButton.style.right = '10px';
            testButton.style.zIndex = '9999';
            testButton.style.padding = '5px 10px';
            testButton.style.backgroundColor = 'blue';
            testButton.style.color = 'white';
            testButton.style.border = 'none';
            testButton.style.borderRadius = '4px';

            testButton.addEventListener('click', function() {
                console.log('Test button clicked');
                window.dispatchEvent(new CustomEvent('open-modal', { detail: 'create-department-modal' }));
            });

            document.body.appendChild(testButton);

            // Add direct event listeners to debug modal events
            window.addEventListener('open-modal', function(event) {
                console.log('open-modal event triggered globally with detail:', event.detail);
            });
        });
    </script>
    @endpush
</x-app-layout>
