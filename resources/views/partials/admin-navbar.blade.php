<header class="bg-gray-100 dark:bg-gray-900 text-gray-700 dark:text-gray-300 shadow-md transition duration-500 ease-in-out">
    <div class="container mx-auto px-4 py-6 flex justify-between items-center">
        <a href="{{ route('admin.dashboard') }}">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-10">
        </a>
        <nav class="flex items-center">
            <span class="text-gray-700 dark:text-gray-300 mx-2 transition duration-500 ease-in-out">Bonjour {{ Auth::user()->firstname }}</span>
            <div class="relative" x-data="{ open: false }">
                <img src="{{ Auth::user()->profile_photo_url }}" alt="Photo de profil" class="h-10 w-10 rounded-full cursor-pointer" @click="open = ! open">
                <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-gray-100 dark:bg-gray-900 shadow-md rounded-md overflow-hidden z-20 transition duration-500 ease-in-out">
                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-800 transition duration-500 ease-in-out">Mon Profil</a>
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                       class="block px-4 py-2 text-red-500 dark:text-red-300 hover:bg-gray-200 dark:hover:bg-gray-800 transition duration-500 ease-in-out">Déconnexion</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
            <div class="relative ml-4 flex items-center">
                <input type="checkbox" id="toggle-theme" class="toggle-checkbox sr-only">
                <label for="toggle-theme" class="toggle-checkbox-container">
                    <span class="toggle-checkbox-label">🌞</span>
                    <span class="toggle-checkbox-label hidden dark:block">🌜</span>
                </label>
            </div>
            <div class="relative ml-4" x-data="{ open: false }">
                @php
                    $currentLang = session('applocale', config('app.locale'));
                    $currentFlag = config('languages')[$currentLang]['flag'];
                    $languages = config('languages');
                @endphp
                <button @click="open = ! open" class="flex items-center focus:outline-none">
                    <img src="{{ asset('images/flags/' . $currentFlag) }}" alt="{{ $languages[$currentLang]['name'] }}" class="h-5 w-5 mr-2 transition duration-500 ease-in-out">
                    <span class="text-gray-700 dark:text-gray-300 transition duration-500 ease-in-out">{{ $languages[$currentLang]['name'] }}</span>
                    <svg class="h-5 w-5 ml-2 transition duration-500 ease-in-out" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-40 bg-gray-100 dark:bg-gray-900 shadow-md rounded-md overflow-hidden z-20 transition duration-500 ease-in-out">
                    @foreach ($languages as $lang => $language)
                        <a href="{{ route('lang.switch', $lang) }}" class="flex items-center px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-800 transition duration-500 ease-in-out">
                            <img src="{{ asset('images/flags/' . $language['flag']) }}" alt="{{ $language['name'] }}" class="h-5 w-5 mr-2 transition duration-500 ease-in-out">
                            <span>{{ $language['name'] }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </nav>
    </div>
</header>