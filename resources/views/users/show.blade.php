<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('User Details') }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('users.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    {{ __('Back to List') }}
                </a>
                @can('update', $user)
                <button type="button" @click="$dispatch('open-modal', { id: 'edit-user-modal-{{ $user->id }}' })" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                    {{ __('Edit') }}
                </button>
                @endcan
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900">{{ __('User Information') }}</h3>
                        <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm font-medium text-gray-500">{{ __('Name') }}</p>
                                <p class="mt-1">{{ $user->name }}</p>
                            </div>
                            
                            <div>
                                <p class="text-sm font-medium text-gray-500">{{ __('Email') }}</p>
                                <p class="mt-1">{{ $user->email }}</p>
                            </div>
                            
                            <div>
                                <p class="text-sm font-medium text-gray-500">{{ __('Department') }}</p>
                                <p class="mt-1">{{ $user->department->getLocalizedName(app()->getLocale()) }}</p>
                            </div>
                            
                            <div>
                                <p class="text-sm font-medium text-gray-500">{{ __('Role') }}</p>
                                <p class="mt-1 capitalize">{{ $user->role }}</p>
                            </div>
                            
                            @if($user->position)
                            <div>
                                <p class="text-sm font-medium text-gray-500">{{ __('Position') }}</p>
                                <p class="mt-1">{{ $user->position }}</p>
                            </div>
                            @endif
                            
                            @if($user->phone)
                            <div>
                                <p class="text-sm font-medium text-gray-500">{{ __('Phone') }}</p>
                                <p class="mt-1">{{ $user->phone }}</p>
                            </div>
                            @endif
                            
                            <div>
                                <p class="text-sm font-medium text-gray-500">{{ __('Preferred Language') }}</p>
                                <p class="mt-1">
                                    @if($user->preferred_language == 'en')
                                        {{ __('English') }}
                                    @elseif($user->preferred_language == 'dari')
                                        {{ __('Dari') }}
                                    @elseif($user->preferred_language == 'pashto')
                                        {{ __('Pashto') }}
                                    @endif
                                </p>
                            </div>
                            
                            <div>
                                <p class="text-sm font-medium text-gray-500">{{ __('Status') }}</p>
                                <p class="mt-1">
                                    @if($user->is_active)
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            {{ __('Active') }}
                                        </span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            {{ __('Inactive') }}
                                        </span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-8">
                        <h3 class="text-lg font-medium text-gray-900">{{ __('User Statistics') }}</h3>
                        <div class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="bg-blue-50 p-4 rounded-lg">
                                <p class="text-sm font-medium text-blue-800">{{ __('Created Documents') }}</p>
                                <p class="mt-1 text-2xl font-semibold">{{ $user->documents()->count() }}</p>
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
