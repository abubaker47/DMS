<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Users') }}
            </h2>
            @can('create', App\Models\User::class)
            <button type="button" onclick="window.dispatchEvent(new CustomEvent('open-modal', { detail: 'create-user-modal' }))" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-md shadow-md flex items-center transition-all duration-200 hover:shadow-lg" style="background-color: #10b981; color: white;">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                {{ __('Create User') }}
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
                        <table id="users-table" class="min-w-full bg-white stripe hover">
                            <thead>
                                <tr>
                                    <th class="py-3 px-4 border-b-2 border-gray-300 bg-gray-100 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">
                                        {{ __('Name') }}
                                    </th>
                                    <th class="py-3 px-4 border-b-2 border-gray-300 bg-gray-100 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">
                                        {{ __('Email') }}
                                    </th>
                                    <th class="py-3 px-4 border-b-2 border-gray-300 bg-gray-100 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">
                                        {{ __('Department') }}
                                    </th>
                                    <th class="py-3 px-4 border-b-2 border-gray-300 bg-gray-100 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">
                                        {{ __('Role') }}
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
                                @forelse($users as $user)
                                    <tr>
                                        <td class="py-3 px-4 border-b border-gray-200">
                                            <div class="font-medium text-gray-900">{{ $user->name }}</div>
                                        </td>
                                        <td class="py-3 px-4 border-b border-gray-200">
                                            <div class="text-gray-700">{{ $user->email }}</div>
                                        </td>
                                        <td class="py-3 px-4 border-b border-gray-200">
                                            <div class="text-gray-700">{{ $user->department->getLocalizedName(app()->getLocale()) }}</div>
                                        </td>
                                        <td class="py-3 px-4 border-b border-gray-200">
                                            <div class="text-gray-700 capitalize">{{ $user->role }}</div>
                                        </td>
                                        <td class="py-3 px-4 border-b border-gray-200">
                                            @if($user->is_active)
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
                                                <a href="{{ route('users.show', $user) }}" class="inline-flex items-center px-3 py-2 border border-blue-300 text-sm font-medium rounded-md shadow-sm text-white bg-blue-500 hover:bg-blue-600 hover:shadow-md transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" style="background-color: #3b82f6; color: white;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" viewBox="0 0 20 20" fill="currentColor">
                                                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                                        <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                                    </svg>
                                                    {{ __('View') }}
                                                </a>

                                                @can('update', $user)
                                                <button type="button" onclick="window.dispatchEvent(new CustomEvent('open-modal', { detail: 'edit-user-modal-{{ $user->id }}' }))" class="inline-flex items-center px-3 py-2 border border-yellow-300 text-sm font-medium rounded-md shadow-sm text-white bg-yellow-500 hover:bg-yellow-600 hover:shadow-md transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500" style="background-color: #eab308; color: white;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" viewBox="0 0 20 20" fill="currentColor">
                                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                                    </svg>
                                                    {{ __('Edit') }}
                                                </button>
                                                @endcan

                                                @can('delete', $user)
                                                <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline delete-form" data-user-name="{{ $user->name }}">
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
                                        <td colspan="6" class="py-8 px-4 border-b border-gray-200">
                                            <div class="flex flex-col items-center justify-center text-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                </svg>
                                                <p class="text-gray-500 text-lg font-medium">{{ __('No users found.') }}</p>
                                                <p class="text-gray-400 mt-1">{{ __('Create a new user to get started.') }}</p>
                                                @can('create', App\Models\User::class)
                                                <button type="button" onclick="window.dispatchEvent(new CustomEvent('open-modal', { detail: 'create-user-modal' }))" class="mt-4 inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-500 hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500" style="background-color: #10b981; color: white;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                                                    </svg>
                                                    {{ __('Create User') }}
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

    <!-- Create User Modal -->
    <x-modal-form id="create-user-modal" :title="__('Create User')" :submit="route('users.store')" enctype="multipart/form-data">
        <div class="space-y-4">
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" required />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" required />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" required />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" required />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="department_id" :value="__('Department')" />
                <select id="department_id" name="department_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                    <option value="">{{ __('Select Department') }}</option>
                    @foreach(\App\Models\Department::where('is_active', true)->get() as $department)
                        <option value="{{ $department->id }}">{{ $department->getLocalizedName(app()->getLocale()) }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('department_id')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="role" :value="__('Role')" />
                <select id="role" name="role" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                    <option value="">{{ __('Select Role') }}</option>
                    <option value="admin">{{ __('Admin') }}</option>
                    <option value="user">{{ __('User') }}</option>
                </select>
                <x-input-error :messages="$errors->get('role')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="position" :value="__('Position')" />
                <x-text-input id="position" name="position" type="text" class="mt-1 block w-full" />
                <x-input-error :messages="$errors->get('position')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="phone" :value="__('Phone')" />
                <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" />
                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="preferred_language" :value="__('Preferred Language')" />
                <select id="preferred_language" name="preferred_language" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                    <option value="en">{{ __('English') }}</option>
                    <option value="dari">{{ __('Dari') }}</option>
                    <option value="pashto">{{ __('Pashto') }}</option>
                </select>
                <x-input-error :messages="$errors->get('preferred_language')" class="mt-2" />
            </div>

            <div class="flex items-center">
                <input id="is_active" name="is_active" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" value="1" checked>
                <label for="is_active" class="ml-2 block text-sm text-gray-900">{{ __('Active') }}</label>
            </div>
        </div>
    </x-modal-form>

    <!-- Edit User Modals -->
    @foreach($users as $user)
    <x-modal-form id="edit-user-modal-{{ $user->id }}" :title="__('Edit User')" :submit="route('users.update', $user)" method="PUT" enctype="multipart/form-data">
        <div class="space-y-4">
            <div>
                <x-input-label for="name-{{ $user->id }}" :value="__('Name')" />
                <x-text-input id="name-{{ $user->id }}" name="name" type="text" class="mt-1 block w-full" :value="$user->name" required />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="email-{{ $user->id }}" :value="__('Email')" />
                <x-text-input id="email-{{ $user->id }}" name="email" type="email" class="mt-1 block w-full" :value="$user->email" required />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="password-{{ $user->id }}" :value="__('Password (leave blank to keep current)')" />
                <x-text-input id="password-{{ $user->id }}" name="password" type="password" class="mt-1 block w-full" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="password_confirmation-{{ $user->id }}" :value="__('Confirm Password')" />
                <x-text-input id="password_confirmation-{{ $user->id }}" name="password_confirmation" type="password" class="mt-1 block w-full" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="department_id-{{ $user->id }}" :value="__('Department')" />
                <select id="department_id-{{ $user->id }}" name="department_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                    <option value="">{{ __('Select Department') }}</option>
                    @foreach(\App\Models\Department::where('is_active', true)->get() as $department)
                        <option value="{{ $department->id }}" {{ $user->department_id == $department->id ? 'selected' : '' }}>
                            {{ $department->getLocalizedName(app()->getLocale()) }}
                        </option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('department_id')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="role-{{ $user->id }}" :value="__('Role')" />
                <select id="role-{{ $user->id }}" name="role" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                    <option value="">{{ __('Select Role') }}</option>
                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>{{ __('Admin') }}</option>
                    <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>{{ __('User') }}</option>
                </select>
                <x-input-error :messages="$errors->get('role')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="position-{{ $user->id }}" :value="__('Position')" />
                <x-text-input id="position-{{ $user->id }}" name="position" type="text" class="mt-1 block w-full" :value="$user->position" />
                <x-input-error :messages="$errors->get('position')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="phone-{{ $user->id }}" :value="__('Phone')" />
                <x-text-input id="phone-{{ $user->id }}" name="phone" type="text" class="mt-1 block w-full" :value="$user->phone" />
                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="preferred_language-{{ $user->id }}" :value="__('Preferred Language')" />
                <select id="preferred_language-{{ $user->id }}" name="preferred_language" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                    <option value="en" {{ $user->preferred_language == 'en' ? 'selected' : '' }}>{{ __('English') }}</option>
                    <option value="dari" {{ $user->preferred_language == 'dari' ? 'selected' : '' }}>{{ __('Dari') }}</option>
                    <option value="pashto" {{ $user->preferred_language == 'pashto' ? 'selected' : '' }}>{{ __('Pashto') }}</option>
                </select>
                <x-input-error :messages="$errors->get('preferred_language')" class="mt-2" />
            </div>

            <div class="flex items-center">
                <input id="is_active-{{ $user->id }}" name="is_active" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" value="1" {{ $user->is_active ? 'checked' : '' }}>
                <label for="is_active-{{ $user->id }}" class="ml-2 block text-sm text-gray-900">{{ __('Active') }}</label>
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
            $('#users-table').DataTable({
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
                    { orderable: false, targets: 5 } // Disable sorting on the actions column
                ]
            });

            // Enhanced delete confirmation
            $('.delete-form').on('submit', function(e) {
                e.preventDefault();
                const form = $(this);
                const userName = form.data('user-name');

                if (confirm("{{ __('Are you sure you want to delete') }} " + userName + "?")) {
                    form.off('submit').submit();
                }
            });

            // Debug modal functionality
            console.log('Users index page loaded');

            // Add event listeners to debug modal events
            window.addEventListener('open-modal', function(event) {
                console.log('open-modal event triggered globally with detail:', event.detail);
            });
        });
    </script>
    @endpush
</x-app-layout>
