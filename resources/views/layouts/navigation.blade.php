<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    @if(Auth::user()->role == 'admin')
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('dashboard') }}
                    </x-nav-link>
                    @endif

                    @can('viewAny', App\Models\Department::class)
                    <x-nav-link :href="route('departments.index')" :active="request()->routeIs('departments.*')">
                        {{ __('departments') }}
                    </x-nav-link>
                    @endcan

                    @can('viewAny', App\Models\User::class)
                    <x-nav-link :href="route('users.index')" :active="request()->routeIs('users.*')">
                        {{ __('users') }}
                    </x-nav-link>
                    @endcan

                    <x-nav-link :href="route('documents.index')" :active="request()->routeIs('documents.*')">
                        {{ __('documents') }}
                    </x-nav-link>

                    @can('viewAny', App\Models\FileType::class)
                    <x-nav-link :href="route('file-types.index')" :active="request()->routeIs('file-types.*')">
                        {{ __('file_types') }}
                    </x-nav-link>
                    @endcan
                </div>
            </div>

            <!-- Notifications Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6 mr-3">
            </div>

            <!-- Language Selector -->
            <div class="hidden sm:flex sm:items-center sm:ms-6 mr-3">
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-notification-dropdown />
                <x-language-selector />
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('logout') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @if(Auth::user()->role == 'admin')
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('dashboard') }}
            </x-responsive-nav-link>
            @endif

            @can('viewAny', App\Models\Department::class)
            <x-responsive-nav-link :href="route('departments.index')" :active="request()->routeIs('departments.*')">
                {{ __('departments') }}
            </x-responsive-nav-link>
            @endcan

            @can('viewAny', App\Models\User::class)
            <x-responsive-nav-link :href="route('users.index')" :active="request()->routeIs('users.*')">
                {{ __('users') }}
            </x-responsive-nav-link>
            @endcan

            <x-responsive-nav-link :href="route('documents.index')" :active="request()->routeIs('documents.*')">
                {{ __('documents') }}
            </x-responsive-nav-link>

            @can('viewAny', App\Models\FileType::class)
            <x-responsive-nav-link :href="route('file-types.index')" :active="request()->routeIs('file-types.*')">
                {{ __('file_types') }}
            </x-responsive-nav-link>
            @endcan
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('profile') }}
                </x-responsive-nav-link>

                <!-- Language Options -->
                <div class="px-4 py-2 text-sm text-gray-700">
                    {{ __('change_language') }}:
                </div>

                <form method="POST" action="{{ route('language.change') }}" class="px-4 py-1">
                    @csrf
                    <input type="hidden" name="language" value="en">
                    <button type="submit" class="w-full text-left text-sm text-gray-700 {{ app()->getLocale() == 'en' ? 'text-green-600 font-bold' : '' }}">
                        {{ __('english') }}
                    </button>
                </form>

                <form method="POST" action="{{ route('language.change') }}" class="px-4 py-1">
                    @csrf
                    <input type="hidden" name="language" value="dari">
                    <button type="submit" class="w-full text-left text-sm text-gray-700 {{ app()->getLocale() == 'dari' ? 'text-green-600 font-bold' : '' }}">
                        {{ __('dari') }}
                    </button>
                </form>

                <form method="POST" action="{{ route('language.change') }}" class="px-4 py-1">
                    @csrf
                    <input type="hidden" name="language" value="pashto">
                    <button type="submit" class="w-full text-left text-sm text-gray-700 {{ app()->getLocale() == 'pashto' ? 'text-green-600 font-bold' : '' }}">
                        {{ __('pashto') }}
                    </button>
                </form>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('logout') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
