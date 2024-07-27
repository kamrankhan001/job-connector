<nav class="bg-white border-gray-200 dark:bg-gray-900">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="{{ route('index') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="{{ asset('assets/logo.png') }}" class="h-8" alt="job connect Logo" />
            <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Job Connect</span>
        </a>
        <button data-collapse-toggle="navbar-default" type="button"
            class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
            aria-controls="navbar-default" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <x-heroicon-m-bars-4 class="w-5 h-5" />
        </button>
        <div class="hidden w-full md:block md:w-auto" id="navbar-default">
            <ul
                class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                {{-- <li>
                    <x-nav-link href="{{ route('index') }}" :active="request()->routeIs('index')">
                        Home
                    </x-nav-link>
                </li> --}}
                @if (Route::has('login'))
                    @auth
                        <x-nav-link href="{{ url('/dashboard') }}" :active="request()->routeIs('dashboard')">
                            Dashboard
                        </x-nav-link>
                    @else
                        <x-nav-link href="{{ route('login') }}" :active="request()->routeIs('login')">
                            Log in
                        </x-nav-link>

                        @if (Route::has('register'))
                            <x-nav-link href="{{ route('register') }}" :active="request()->routeIs('register')">
                                Register
                            </x-nav-link>
                        @endif
                    @endauth
                @endif

            </ul>
        </div>
    </div>
</nav>
