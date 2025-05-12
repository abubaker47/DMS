<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Create Department') }}
            </h2>
            <a href="{{ route('departments.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                {{ __('Back to List') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('departments.store') }}">
                        @csrf

                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('English Information') }}</h3>
                            
                            <div class="mb-4">
                                <x-input-label for="name" :value="__('Name')" />
                                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <div class="mb-4">
                                <x-input-label for="description" :value="__('Description')" />
                                <textarea id="description" name="description" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" rows="3">{{ old('description') }}</textarea>
                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                            </div>
                        </div>

                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Dari Information') }}</h3>
                            
                            <div class="mb-4">
                                <x-input-label for="name_dari" :value="__('Name (Dari)')" />
                                <x-text-input id="name_dari" class="block mt-1 w-full" type="text" name="name_dari" :value="old('name_dari')" dir="rtl" />
                                <x-input-error :messages="$errors->get('name_dari')" class="mt-2" />
                            </div>

                            <div class="mb-4">
                                <x-input-label for="description_dari" :value="__('Description (Dari)')" />
                                <textarea id="description_dari" name="description_dari" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" rows="3" dir="rtl">{{ old('description_dari') }}</textarea>
                                <x-input-error :messages="$errors->get('description_dari')" class="mt-2" />
                            </div>
                        </div>

                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Pashto Information') }}</h3>
                            
                            <div class="mb-4">
                                <x-input-label for="name_pashto" :value="__('Name (Pashto)')" />
                                <x-text-input id="name_pashto" class="block mt-1 w-full" type="text" name="name_pashto" :value="old('name_pashto')" dir="rtl" />
                                <x-input-error :messages="$errors->get('name_pashto')" class="mt-2" />
                            </div>

                            <div class="mb-4">
                                <x-input-label for="description_pashto" :value="__('Description (Pashto)')" />
                                <textarea id="description_pashto" name="description_pashto" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" rows="3" dir="rtl">{{ old('description_pashto') }}</textarea>
                                <x-input-error :messages="$errors->get('description_pashto')" class="mt-2" />
                            </div>
                        </div>

                        <div class="mb-6">
                            <div class="flex items-center">
                                <input id="is_active" name="is_active" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" value="1" {{ old('is_active') ? 'checked' : 'checked' }}>
                                <label for="is_active" class="ml-2 block text-sm text-gray-900">{{ __('Active') }}</label>
                            </div>
                            <x-input-error :messages="$errors->get('is_active')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Create Department') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
