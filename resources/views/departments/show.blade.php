<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Department Details') }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('departments.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    {{ __('Back to List') }}
                </a>
                @can('update', $department)
                <a href="{{ route('departments.edit', $department) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                    {{ __('Edit') }}
                </a>
                @endcan
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900">{{ __('Department Information') }}</h3>
                        <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm font-medium text-gray-500">{{ __('Name (English)') }}</p>
                                <p class="mt-1">{{ $department->name }}</p>
                            </div>

                            <div>
                                <p class="text-sm font-medium text-gray-500">{{ __('Status') }}</p>
                                <p class="mt-1">
                                    @if($department->is_active)
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

                            @if($department->name_dari)
                            <div>
                                <p class="text-sm font-medium text-gray-500">{{ __('Name (Dari)') }}</p>
                                <p class="mt-1">{{ $department->name_dari }}</p>
                            </div>
                            @endif

                            @if($department->name_pashto)
                            <div>
                                <p class="text-sm font-medium text-gray-500">{{ __('Name (Pashto)') }}</p>
                                <p class="mt-1">{{ $department->name_pashto }}</p>
                            </div>
                            @endif

                            @if($department->description)
                            <div class="col-span-1 md:col-span-2">
                                <p class="text-sm font-medium text-gray-500">{{ __('Description (English)') }}</p>
                                <p class="mt-1">{{ $department->description }}</p>
                            </div>
                            @endif

                            @if($department->description_dari)
                            <div class="col-span-1 md:col-span-2">
                                <p class="text-sm font-medium text-gray-500">{{ __('Description (Dari)') }}</p>
                                <p class="mt-1">{{ $department->description_dari }}</p>
                            </div>
                            @endif

                            @if($department->description_pashto)
                            <div class="col-span-1 md:col-span-2">
                                <p class="text-sm font-medium text-gray-500">{{ __('Description (Pashto)') }}</p>
                                <p class="mt-1">{{ $department->description_pashto }}</p>
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="mt-8">
                        <h3 class="text-lg font-medium text-gray-900">{{ __('Department Statistics') }}</h3>
                        <div class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="bg-blue-50 p-4 rounded-lg">
                                <p class="text-sm font-medium text-blue-800">{{ __('Users') }}</p>
                                <p class="mt-1 text-2xl font-semibold">{{ $department->users()->count() }}</p>
                            </div>

                            <div class="bg-green-50 p-4 rounded-lg">
                                <p class="text-sm font-medium text-green-800">{{ __('Sent Documents') }}</p>
                                <p class="mt-1 text-2xl font-semibold">{{ $department->sentDocuments()->count() }}</p>
                            </div>

                            <div class="bg-purple-50 p-4 rounded-lg">
                                <p class="text-sm font-medium text-purple-800">{{ __('Received Documents') }}</p>
                                <p class="mt-1 text-2xl font-semibold">{{ $department->receivedDocuments()->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
