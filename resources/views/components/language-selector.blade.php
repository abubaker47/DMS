<div class="relative" x-data="{ open: false }">
    <button @click="open = !open" class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
        <div>{{ __('messages.language') }}</div>

        <div class="ml-1">
            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        </div>
    </button>

    <div x-show="open" @click.away="open = false" class="absolute z-50 mt-2 w-48 rounded-md shadow-lg origin-top-right right-0 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
        <div class="py-1" role="none">
            <form method="POST" action="{{ route('language.change') }}">
                @csrf
                <input type="hidden" name="language" value="en">
                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 {{ app()->getLocale() == 'en' ? 'bg-green-100' : '' }}" role="menuitem" tabindex="-1">
                    {{ __('messages.english') }}
                </button>
            </form>
            
            <form method="POST" action="{{ route('language.change') }}">
                @csrf
                <input type="hidden" name="language" value="dari">
                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 {{ app()->getLocale() == 'dari' ? 'bg-green-100' : '' }}" role="menuitem" tabindex="-1">
                    {{ __('messages.dari') }}
                </button>
            </form>
            
            <form method="POST" action="{{ route('language.change') }}">
                @csrf
                <input type="hidden" name="language" value="pashto">
                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 {{ app()->getLocale() == 'pashto' ? 'bg-green-100' : '' }}" role="menuitem" tabindex="-1">
                    {{ __('messages.pashto') }}
                </button>
            </form>
        </div>
    </div>
</div>
