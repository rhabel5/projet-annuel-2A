<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Backoffice - PCS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/dark-mode.js'])
</head>
<body class="bg-gray-50 dark:bg-gray-900 font-sans">
    <!-- Navbar -->
    <header class="bg-white dark:bg-gray-800 shadow-md">
        <div class="container mx-auto px-4 py-6 flex justify-between items-center">
            <a href="{{ route('admin.dashboard') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-10">
            </a>
            <nav class="flex items-center">
                <span class="text-gray-700 dark:text-gray-300 mx-2">Bonjour {{ Auth::user()->firstname }}</span>
                <div class="relative" x-data="{ open: false }">
                    <img src="{{ Auth::user()->profile_photo_url }}" alt="Photo de profil" class="h-10 w-10 rounded-full cursor-pointer" @click="open = ! open">
                    <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 shadow-md rounded-md overflow-hidden z-20">
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">Mon Profil</a>
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                           class="block px-4 py-2 text-red-500 dark:text-red-300 hover:bg-gray-100 dark:hover:bg-gray-700">Déconnexion</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
                <div class="relative ml-4">
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
                        <img src="{{ asset('images/flags/' . $currentFlag) }}" alt="{{ $languages[$currentLang]['name'] }}" class="h-5 w-5 mr-2">
                        <span class="text-gray-700 dark:text-gray-300">{{ $languages[$currentLang]['name'] }}</span>
                        <svg class="h-5 w-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-40 bg-white dark:bg-gray-800 shadow-md rounded-md overflow-hidden z-20">
                        @foreach ($languages as $lang => $language)
                            <a href="{{ route('lang.switch', $lang) }}" class="flex items-center px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                <img src="{{ asset('images/flags/' . $language['flag']) }}" alt="{{ $language['name'] }}" class="h-5 w-5 mr-2">
                                <span>{{ $language['name'] }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="bg-gray-800 text-white w-64 space-y-6 py-7 px-2 absolute inset-y-0 left-0 transform -translate-x-full md:relative md:translate-x-0 transition duration-200 ease-in-out">
            <h1 class="text-white text-2xl font-semibold mt-2 px-4">PCS Backoffice</h1>
            <nav class="px-4">
                <a href="{{ route('admin.users.index') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">Utilisateurs</a>
                <a href="{{ route('admin.biens.index') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">Biens</a>
                <a href="{{ route('admin.services.index') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">Commentaires</a>
                <a href="{{ route('admin.tickets.index') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">Tickets</a>
            </nav>
        </div>

        <!-- Content Area -->
        <div class="flex-1 p-10 text-gray-900 dark:text-gray-100">
            @yield('content')
        </div>
    </div>
</body>
</html>