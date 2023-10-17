<nav x-data="{ open: false }" class="border-b bg-phonska-900 dark:bg-zinc-800 border-phonska-100 dark:border-zinc-700">

    <!-- Primary Navigation Menu -->
    <div class="flex justify-between h-16 px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex space-x-6">
            <!-- Logo -->
            <div class="flex items-center shrink-0">
                <a href="{{ route('landing') }}">
                    <x-application-logo class="font-extrabold text-white dark:text-zinc-200" />
                </a>
            </div>

            <!-- Guest Navigation Links -->
            @guest
                <div class="hidden sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('rekanans.index')" :active="request()->routeIs('rekanans.*')">
                        {{ __('Absensi') }}
                    </x-nav-link>
                </div>
            @endguest

            <!-- User Navigation Links -->
            @role('user')
                <div class="hidden sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('absens.index')" :active="request()->routeIs('absens.*')">
                        {{ __('Absensi') }}
                    </x-nav-link>
                </div>

                <div class="hidden sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('rekaps.index')" :active="request()->routeIs('rekaps.*')">
                        {{ __('Riwayat') }}
                    </x-nav-link>
                </div>
            @endrole

            <!-- Admin Navigation Links -->
            @role('admin')
                <div class="hidden sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link href="{{ route('admin.dashboard') }}" :active="request()->routeIs('admin.dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </div>

                <div class="hidden sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link href="{{ route('admin.tknos.index') }}" :active="request()->routeIs('admin.tknos.*')">
                        {{ __('TKNO') }}
                    </x-nav-link>
                </div>

                <div class="hidden sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link href="{{ route('admin.users.index') }}" :active="request()->routeIs('admin.users.*')">
                        {{ __('Users') }}
                    </x-nav-link>
                </div>

                <div class="hidden sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link href="{{ route('admin.rekanans.index') }}" :active="request()->routeIs('admin.rekanans.*')">
                        {{ __('Rekanan') }}
                    </x-nav-link>
                </div>
            @endrole
        </div>

        <div class="flex items-center justify-end space-x-4">

            <!-- Theme Toggle -->
            <div class="flex items-center sm:-my-px">
                <x-theme-toggle />
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden space-x-6 sm:flex sm:items-center">
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <span
                                class="inline-flex items-center text-sm font-medium transition duration-150 ease-in-out bg-transparent cursor-pointer text-zinc-50 dark:text-zinc-400 hover:text-zinc-300 dark:hover:text-zinc-300 focus:outline-none">
                                {{ Auth::user()->name }}

                                <div class="ml-1">
                                    <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </span>
                        </x-slot>

                        <x-slot name="content">
                            @role('user')
                                <x-dropdown-link :href="route('profile.index')">
                                    {{ __('Profile') }}
                                </x-dropdown-link>
                            @endrole

                            @role('admin')
                                <x-dropdown-link :href="route('admin.profile.edit')">
                                    {{ __('Profile') }}
                                </x-dropdown-link>
                            @endrole

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="flex items-center -mr-2 space-x-4 sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center text-sm font-medium transition duration-150 ease-in-out bg-transparent text-zinc-50 dark:text-zinc-400 hover:text-zinc-300 dark:hover:text-zinc-300 focus:outline-none">

                    <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div>
            <!-- Guest Navigation Links -->
            @guest
                <x-responsive-nav-link :href="route('rekanans.index')" :active="request()->routeIs('rekanans.*')">
                    {{ __('Absensi') }}
                </x-responsive-nav-link>
            @endguest

            <!-- User Navigation Links -->
            @role('user')
                <x-responsive-nav-link :href="route('absens.index')" :active="request()->routeIs('absens.*')">
                    {{ __('Absensi') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('rekaps.index')" :active="request()->routeIs('rekaps.*')">
                    {{ __('Riwayat') }}
                </x-responsive-nav-link>
            @endrole

            <!-- Admin Navigation Links -->
            @role('admin')
                <x-responsive-nav-link href="{{ route('admin.dashboard') }}" :active="request()->routeIs('admin.dashboard')">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link href="{{ route('admin.tknos.index') }}" :active="request()->routeIs('admin.tknos.*')">
                    {{ __('TKNO') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link href="{{ route('admin.users.index') }}" :active="request()->routeIs('admin.users.*')">
                    {{ __('Users') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link href="{{ route('admin.rekanans.index') }}" :active="request()->routeIs('admin.rekanans.*')">
                    {{ __('Rekanan') }}
                </x-responsive-nav-link>
            @endrole
        </div>

        <!-- Responsive Settings Options -->
        @auth
            <div class="pt-4 border-zinc-200 dark:border-zinc-600">
                <div class="px-4 text-sm">
                    <div class="font-medium text-zinc-100 dark:text-zinc-200">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-zinc-300">{{ Auth::user()->email }}</div>
                </div>
                <div class="mt-3 space-y-1">
                    @role('user')
                        <x-responsive-nav-link :href="route('profile.index')">
                            {{ __('Profile') }}
                        </x-responsive-nav-link>
                    @endrole

                    @role('admin')
                        <x-responsive-nav-link :href="route('admin.profile.edit')">
                            {{ __('Profile') }}
                        </x-responsive-nav-link>
                    @endrole

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @endauth
    </div>
</nav>
