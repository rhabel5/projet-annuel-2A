<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PCS Backoffice</title>
    @vite('resources/css/app.css')
    @vite('resources/js/dark-mode.js')
    @vite('resources/js/language-menu.js')
</head>
<body class="bg-gray-100 dark:bg-gray-900 font-sans">
    <!-- Navbar -->
    <header class="bg-white dark:bg-gray-800 shadow-md">
        <div class="container mx-auto px-4 py-6 flex justify-between items-center">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-10">
            <nav class="flex items-center">
                <span class="text-gray-700 dark:text-gray-300 mx-2">Bonjour {{ Auth::user()->firstname }}</span>
                <div class="relative">
                    <img src="{{ Auth::user()->profile_photo_url }}" alt="Photo de profil" class="h-10 w-10 rounded-full cursor-pointer" id="profile-menu-button">
                    <div id="profile-menu" class="hidden absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 shadow-md rounded-md overflow-hidden z-20">
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
                    <label for="toggle-theme" class="toggle-checkbox-container"></label>
                </div>
                <div class="relative ml-4">
                    @php
                        $currentLang = session('applocale', config('app.locale'));
                        $currentFlag = config('languages')[$currentLang]['flag'];
                        $languages = config('languages');
                    @endphp
                    <button class="flex items-center focus:outline-none" id="language-menu-button">
                        <img src="{{ asset('images/flags/' . $currentFlag) }}" alt="{{ $languages[$currentLang]['name'] }}" class="h-5 w-5 mr-2">
                        <span class="text-gray-700 dark:text-gray-300">{{ $languages[$currentLang]['name'] }}</span>
                        <svg class="h-5 w-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div id="language-menu" class="hidden absolute right-0 mt-2 w-40 bg-white dark:bg-gray-800 shadow-md rounded-md overflow-hidden z-20">
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
            <div class="px-4 py-2">
                <img src="https://via.placeholder.com/150" alt="Logo" class="w-12 h-12">
                <h1 class="text-white text-2xl font-semibold mt-2">PCS Backoffice</h1>
            </div>
            <nav>
                <a href="{{ route('admin.users.index') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">Utilisateurs</a>
                <a href="{{ route('admin.biens.index') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">Biens</a>
                <a href="{{ route('admin.services.index') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">Commentaires</a>
                <a href="{{ route('admin.tickets.index') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">Tickets</a>
            </nav>
        </div>

        <!-- Content Area -->
        <div class="flex-1 p-10">
            <div class="grid grid-cols-4 gap-4 mb-4">
                <div class="bg-red-500 text-white p-4 rounded-lg shadow">
                    <h2 class="text-xl font-semibold">Erreurs PHP</h2>
                    <p class="text-3xl">3</p>
                    <button class="mt-4 px-4 py-2 bg-red-700 rounded">Détails</button>
                </div>
                <div class="bg-green-500 text-white p-4 rounded-lg shadow">
                    <h2 class="text-xl font-semibold">Mails Systèmes</h2>
                    <p class="text-3xl">0</p>
                    <button class="mt-4 px-4 py-2 bg-green-700 rounded">Détails</button>
                </div>
                <div class="bg-orange-500 text-white p-4 rounded-lg shadow">
                    <h2 class="text-xl font-semibold">Failles Potentielles</h2>
                    <p class="text-3xl">964</p>
                    <button class="mt-4 px-4 py-2 bg-orange-700 rounded">Détails</button>
                </div>
                <div class="bg-blue-500 text-white p-4 rounded-lg shadow">
                    <h2 class="text-xl font-semibold">Contrôles Opérationnels</h2>
                    <p class="text-3xl">100%</p>
                    <button class="mt-4 px-4 py-2 bg-blue-700 rounded">Détails</button>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-white p-4 rounded-lg shadow">
                    <h3 class="text-xl font-semibold text-gray-800">Tickets à Traiter</h3>
                    <p class="text-3xl text-red-500">1</p>
                    <button class="mt-4 px-4 py-2 bg-red-700 text-white rounded">Détails</button>
                </div>
                <div class="bg-white p-4 rounded-lg shadow">
                    <h3 class="text-xl font-semibold text-gray-800">Alarms Actives</h3>
                    <p class="text-3xl text-red-500">13</p>
                    <button class="mt-4 px-4 py-2 bg-red-700 text-white rounded">Détails</button>
                </div>
            </div>
            <div class="bg-white p-4 mt-4 rounded-lg shadow">
                <h3 class="text-xl font-semibold text-gray-800">Messages Systèmes</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="py-2 px-4 border-b">Serveur</th>
                                <th class="py-2 px-4 border-b">Source</th>
                                <th class="py-2 px-4 border-b">Horodatage</th>
                                <th class="py-2 px-4 border-b">Détails</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Exemples de lignes -->
                            <tr>
                                <td class="py-2 px-4 border-b">HELENE</td>
                                <td class="py-2 px-4 border-b">CONSOLE</td>
                                <td class="py-2 px-4 border-b">2024-12-31 01:04:15</td>
                                <td class="py-2 px-4 border-b">Erreur de connexion à la base de données</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>