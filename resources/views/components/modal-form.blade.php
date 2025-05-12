@props(['id', 'maxWidth', 'title', 'submit'])

<x-modal :name="$id" :maxWidth="$maxWidth ?? '2xl'">
    <div class="px-6 py-4 bg-gray-100 border-b">
        <div class="flex items-center justify-between">
            <h3 class="text-lg font-medium text-gray-900">
                {{ $title }}
            </h3>
            <button type="button" onclick="window.dispatchEvent(new CustomEvent('close-modal', { detail: '{{ $id }}' }))" class="text-gray-400 hover:text-gray-500">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <form id="{{ $id }}-form" method="POST" action="{{ $submit }}" {{ $attributes }}>
        @csrf
        @if(isset($method) && $method !== 'POST')
            @method($method)
        @endif

        <div class="p-6">
            {{ $slot }}
        </div>

        <div class="px-6 py-4 bg-gray-100 border-t text-right">
            <button type="button" onclick="window.dispatchEvent(new CustomEvent('close-modal', { detail: '{{ $id }}' }))" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                {{ __('Cancel') }}
            </button>

            <button type="submit" class="ml-3 inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150" style="background-color: #10b981; color: white;">
                {{ $submitLabel ?? __('Save') }}
            </button>
        </div>
    </form>
</x-modal>
