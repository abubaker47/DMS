<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <a href="{{ route('users.index') }}" class="text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                </a>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center space-x-3">
                    <span class="bg-blue-100 text-blue-800 p-2 rounded-full">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </span>
                    <span>{{ $user->name }}</span>
                </h2>
            </div>
            @can('update', $user)
            <button type="button" @click="$dispatch('open-modal', { id: 'edit-user-modal-{{ $user->id }}' })" 
                class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                {{ __('Edit Profile') }}
            </button>
            @endcan
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Main Info Card -->
                <div class="lg:col-span-2">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-6">
                                <h3 class="text-lg font-medium text-gray-900">{{ __('User Information') }}</h3>
                                <span class="px-3 py-1 {{ $user->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }} rounded-full text-sm font-medium">
                                    {{ $user->is_active ? __('Active') : __('Inactive') }}
                                </span>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="bg-gray-50 rounded-lg p-4 border border-gray-100">
                                    <div class="flex items-center space-x-3 mb-3">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                        <p class="text-sm font-medium text-gray-500">{{ __('Name') }}</p>
                                    </div>
                                    <p class="text-gray-900 font-medium">{{ $user->name }}</p>
                                </div>

                                <div class="bg-gray-50 rounded-lg p-4 border border-gray-100">
                                    <div class="flex items-center space-x-3 mb-3">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                        </svg>
                                        <p class="text-sm font-medium text-gray-500">{{ __('Email') }}</p>
                                    </div>
                                    <p class="text-gray-900 font-medium">{{ $user->email }}</p>
                                </div>

                                <div class="bg-gray-50 rounded-lg p-4 border border-gray-100">
                                    <div class="flex items-center space-x-3 mb-3">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                        </svg>
                                        <p class="text-sm font-medium text-gray-500">{{ __('Department') }}</p>
                                    </div>
                                    <p class="text-gray-900 font-medium">{{ $user->department->getLocalizedName(app()->getLocale()) }}</p>
                                </div>

                                <div class="bg-gray-50 rounded-lg p-4 border border-gray-100">
                                    <div class="flex items-center space-x-3 mb-3">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                        </svg>
                                        <p class="text-sm font-medium text-gray-500">{{ __('Role') }}</p>
                                    </div>
                                    <p class="text-gray-900 font-medium capitalize">{{ $user->role }}</p>
                                </div>

                                @if($user->position)
                                <div class="bg-gray-50 rounded-lg p-4 border border-gray-100">
                                    <div class="flex items-center space-x-3 mb-3">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                        </svg>
                                        <p class="text-sm font-medium text-gray-500">{{ __('Position') }}</p>
                                    </div>
                                    <p class="text-gray-900 font-medium">{{ $user->position }}</p>
                                </div>
                                @endif

                                @if($user->phone)
                                <div class="bg-gray-50 rounded-lg p-4 border border-gray-100">
                                    <div class="flex items-center space-x-3 mb-3">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                        </svg>
                                        <p class="text-sm font-medium text-gray-500">{{ __('Phone') }}</p>
                                    </div>
                                    <p class="text-gray-900 font-medium">{{ $user->phone }}</p>
                                </div>
                                @endif

                                <div class="bg-gray-50 rounded-lg p-4 border border-gray-100">
                                    <div class="flex items-center space-x-3 mb-3">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"/>
                                        </svg>
                                        <p class="text-sm font-medium text-gray-500">{{ __('Preferred Language') }}</p>
                                    </div>
                                    <p class="text-gray-900 font-medium">
                                        @if($user->preferred_language == 'en')
                                            {{ __('English') }}
                                        @elseif($user->preferred_language == 'dari')
                                            {{ __('Dari') }}
                                        @elseif($user->preferred_language == 'pashto')
                                            {{ __('Pashto') }}
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Stats Card -->
                <div class="lg:col-span-1">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-6">{{ __('User Statistics') }}</h3>
                            <div class="space-y-6">
                                <div class="bg-blue-50 rounded-lg p-6 border border-blue-100">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm font-medium text-blue-600">{{ __('Total Documents') }}</p>
                                            <p class="mt-2 text-3xl font-bold text-blue-900">{{ $user->documents()->count() }}</p>
                                        </div>
                                        <div class="bg-blue-100 rounded-full p-3">
                                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        <a href="{{ route('documents.index', ['user' => $user->id]) }}" class="text-sm font-medium text-blue-600 hover:text-blue-500">
                                            {{ __('View Documents') }} →
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit User Modal -->
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
</x-app-layout>
