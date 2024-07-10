@php use Illuminate\Support\Facades\Auth; @endphp
<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700 transition duration-500 ease-in-out">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 transition duration-500 ease-in-out">
        <div class="flex justify-between h-16 transition duration-500 ease-in-out">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="block h-9 w-auto transition duration-500 ease-in-out" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="transition duration-500 ease-in-out">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link :href="route('biens.index')" :active="request()->routeIs('biens.index')" class="transition duration-500 ease-in-out">
                        {{ __('Nos Biens') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                @php
                    $estBailleur = \App\Models\Role_user::where('user_id', Auth::id())->where('role_id', 3)->first();
                    $estPresta = \App\Models\Role_user::where('user_id', Auth::id())->where('role_id', 4)->first();

                @endphp

                @if($estBailleur)
                    <a href="{{ route('mesbiens') }}" class="text-gray-700 dark:text-gray-300 font-semibold hover:text-gray-900 dark:hover:text-white mx-2 transition duration-500 ease-in-out">Mes Biens</a>
                    <a href="{{ route('mesreservations') }}" class="text-gray-700 dark:text-gray-300 font-semibold hover:text-gray-900 dark:hover:text-white mx-2 transition duration-500 ease-in-out">Mes Reservations</a>
                    <a href="{{ route('mesoffresprestations') }}" class="text-gray-700 dark:text-gray-300 font-semibold hover:text-gray-900 dark:hover:text-white mx-2 transition duration-500 ease-in-out">Mes Prestations</a>
                @else
                    <a href="{{ route('biens.create_view') }}" class="text-gray-700 dark:text-gray-300 font-semibold hover:text-gray-900 dark:hover:text-white mx-2 transition duration-500 ease-in-out">Devenir Bailleur</a>
                @endif
                <!-- Theme Toggle -->

                <!-- Bailleur -->
                <div class="relative ml-4 transition duration-500 ease-in-out">
                    <input type="checkbox" id="toggle-theme" class="toggle-checkbox sr-only">
                    <label for="toggle-theme" class="toggle-checkbox-container"></label>
                </div>

                <!-- Voyageurs VIP -->
                <div class="relative ml-4 transition duration-500 ease-in-out">
                    <a href="{{ route('vip.subscription') }}" class="text-gray-700 dark:text-gray-300 font-semibold hover:text-gray-9000 dark:hover:text-white mx-2 transition duration-500 ease-in-out">Devenir VIP</a>
                </div>

                <!-- Language Switcher -->
                <div class="relative ml-4 transition duration-500 ease-in-out">
                    @php
                        $currentLang = session('applocale', config('app.locale'));
                        $currentFlag = config('languages')[$currentLang]['flag'];
                        $languages = config('languages');
                    @endphp
                    <button class="flex items-center focus:outline-none" id="language-menu-button">
                        <img src="{{ asset('images/flags/' . $currentFlag) }}" alt="{{ $languages[$currentLang]['name'] }}" class="h-5 w-5 mr-2 transition duration-500 ease-in-out">
                        <span class="text-gray-700 dark:text-gray-300 transition duration-500 ease-in-out">{{ $languages[$currentLang]['name'] }}</span>
                        <svg class="h-5 w-5 ml-2 transition duration-500 ease-in-out" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div id="language-menu" class="hidden absolute right-0 mt-2 w-40 bg-white dark:bg-gray-800 shadow-md rounded-md overflow-hidden z-20 transition duration-500 ease-in-out">
                        @foreach ($languages as $lang => $language)
                            <a href="{{ route('lang.switch', $lang) }}" class="flex items-center px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition duration-500 ease-in-out">
                                <img src="{{ asset('images/flags/' . $language['flag']) }}" alt="{{ $language['name'] }}" class="h-5 w-5 mr-2 transition duration-500 ease-in-out">
                                <span>{{ $language['name'] }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>

                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>

                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 011.414 0L10 10.586l3.293-3.293a1 1 111.414 1.414l-4 4a1 1 01-1.414 0l-4-4a1 1 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('voyageur.dashboard')" class="transition duration-500 ease-in-out">
                                {{ __('Profile') }}
                            </x-dropdown-link>
                            @if(!$estPresta)
                            <x-dropdown-link :href="route('prestataire.inscription')" class="transition duration-500 ease-in-out">
                                {{ __('Devenir Prestataire') }}
                            </x-dropdown-link>
                            @else
                                <x-dropdown-link :href="route('prestation.offres')" class="transition duration-500 ease-in-out">
                                    {{ __('Offres de prestations') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('prestation.mesprestations')" class="transition duration-500 ease-in-out">
                                    {{ __('Mes prestations') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('prestation.mestypesprestations')" class="transition duration-500 ease-in-out">
                                    {{ __('Mes types de prestation') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('devisenattente')" class="transition duration-500 ease-in-out">
                                    {{ __('Mes devis en attente') }}
                                </x-dropdown-link>
                            @endif

                            <x-dropdown-link :href="route('tickets.index')" class="transition duration-500 ease-in-out">
                                {{ __('Help Center') }}
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();" class="transition duration-500 ease-in-out">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <a href="{{ route('login') }}" class="text-gray-700 dark:text-gray-300 font-semibold hover:text-gray-900 dark:hover:text-white mx-2 transition duration-500 ease-in-out">{{ __('Se connecter') }}</a>
                    <a href="{{ route('register') }}" class="text-gray-700 dark:text-gray-300 font-semibold hover:text-gray-900 dark:hover:text-white mx-2 transition duration-500 ease-in-out">{{ __('Créer un compte') }}</a>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6 transition duration-500 ease-in-out" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex transition duration-500 ease-in-out" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden transition duration-500 ease-in-out" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden transition duration-500 ease-in-out">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="transition duration-500 ease-in-out">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600 transition duration-500 ease-in-out">
            <div class="px-4">
                @auth
                    <div class="font-medium text-base text-gray-800 dark:text-gray-200 transition duration-500 ease-in-out">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500 transition duration-500 ease-in-out">{{ Auth::user()->email }}</div>
                @else
                    <div class="font-medium text-base text-gray-800 dark:text-gray-200 transition duration-500 ease-in-out">Guest</div>
                    <div class="font-medium text-sm text-gray-500 transition duration-500 ease-in-out">Please log in</div>
                @endauth
            </div>

            <div class="mt-3 space-y-1 transition duration-500 ease-in-out">
                @auth
                    <x-responsive-nav-link :href="route('voyageur.dashboard')" class="transition duration-500 ease-in-out">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <x-responsive-nav-link :href="route('tickets.index')" class="transition duration-500 ease-in-out">
                        {{ __('Help Center') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')" class="transition duration-500 ease-in-out"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                @else
                    <x-responsive-nav-link :href="route('login')" class="transition duration-500 ease-in-out">
                        {{ __('Log in') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('register')" class="transition duration-500 ease-in-out">
                        {{ __('Register') }}
                    </x-responsive-nav-link>
                @endauth
            </div>
        </div>
    </div>
</nav>
