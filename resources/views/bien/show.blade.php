<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $bien->nom_bien }}</title>
    @vite('resources/css/app.css')
    @vite('resources/js/dark-mode.js')
</head>
<body class="bg-gray-100 dark:bg-gray-900 font-sans">
    <header class="bg-white dark:bg-gray-800 shadow-md">
        <div class="container mx-auto px-4 py-6 flex justify-between items-center">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-10">
            <nav class="flex items-center">
                <a href="{{ route('home') }}" class="text-gray-700 dark:text-gray-300 font-semibold hover:text-gray-900 dark:hover:text-white mx-2">Accueil</a>
                @guest
                    <a href="{{ route('login') }}" class="text-gray-700 dark:text-gray-300 font-semibold hover:text-gray-900 dark:hover:text-white mx-2">Se connecter</a>
                    <a href="{{ route('register') }}" class="text-gray-700 dark:text-gray-300 font-semibold hover:text-gray-900 dark:hover:text-white mx-2">Créer un compte</a>
                @else
                    <span class="text-gray-700 dark:text-gray-300 mx-2">Bonjour, {{ Auth::user()->name }}</span>
                    <div class="relative">
                        <img src="{{ Auth::user()->profile_photo_url }}" alt="Photo de profil" class="h-10 w-10 rounded-full cursor-pointer" id="profile-menu-button">
                        <div id="profile-menu" class="hidden absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 shadow-md rounded-md overflow-hidden z-20">
                            <a href="{{ route('profile') }}" class="block px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">Mon profil</a>
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                               class="block px-4 py-2 text-red-500 dark:text-red-300 hover:bg-gray-100 dark:hover:bg-gray-700">Déconnexion</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                @endguest
                <div class="ml-4">
                    <label for="toggle-theme" class="inline-flex relative items-center cursor-pointer">
                        <input type="checkbox" id="toggle-theme" class="sr-only">
                        <div class="w-11 h-6 bg-gray-200 dark:bg-gray-700 rounded-full peer dark:border-gray-600 peer-checked:bg-blue-600 after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all after:duration-300 peer-checked:after:translate-x-full"></div>
                    </label>
                </div>
            </nav>
        </div>
    </header>

    <section class="container mx-auto px-4 py-16">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
            <h1 class="text-3xl font-semibold mb-4 text-gray-900 dark:text-gray-100">{{ $bien->nom_bien }}</h1>
            <img src="{{ $bien->image_url }}" alt="Image du logement" class="h-60 w-full object-cover rounded-md mb-4">
            <p class="text-gray-700 dark:text-gray-300 mb-4">{{ $bien->description }}</p>
            <p class="text-gray-700 dark:text-gray-300 mb-4"><strong>Ville :</strong> {{ $bien->ville }}</p>
            <p class="text-gray-700 dark:text-gray-300 mb-4"><strong>Adresse :</strong> {{ $bien->adresse }}</p>
            <p class="text-gray-700 dark:text-gray-300 mb-4"><strong>Prix adulte :</strong> {{ $bien->prix_adulte }} €</p>
            <p class="text-gray-700 dark:text-gray-300 mb-4"><strong>Prix enfant :</strong> {{ $bien->prix_enfant }} €</p>
            <p class="text-gray-700 dark:text-gray-300 mb-4"><strong>Prix animaux :</strong> {{ $bien->prix_animaux }} €</p>
        </div>
    </section>

    <footer class="bg-white dark:bg-gray-800 py-6">
        <div class="container mx-auto px-4 text-center text-gray-600 dark:text-gray-300">
            © {{ date('Y') }} Paris Caretaker Services. Tous droits réservés.
        </div>
    </footer>

    <script>
        document.getElementById('profile-menu-button').addEventListener('click', function() {
            document.getElementById('profile-menu').classList.toggle('hidden');
        });
    </script>
</body>
</html>