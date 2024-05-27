<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paris Caretaker Services</title>
    @vite('resources/css/app.css')
    @vite('resources/js/dark-mode.js')
</head>
<body class="bg-gray-100 dark:bg-gray-900 font-sans">
    <header class="bg-white dark:bg-gray-800 shadow-md">
        <div class="container mx-auto px-4 py-6 flex justify-between items-center">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-10">
            <nav class="flex items-center">
                @guest
                    <a href="{{ route('login') }}" class="text-gray-700 dark:text-gray-300 font-semibold hover:text-gray-900 dark:hover:text-white mx-2">Se connecter</a>
                    <a href="{{ route('register') }}" class="text-gray-700 dark:text-gray-300 font-semibold hover:text-gray-900 dark:hover:text-white mx-2">Créer un compte</a>
                @else
                    <span class="text-gray-700 dark:text-gray-300 mx-2">Bonjour, {{ Auth::user()->name }}</span>
                    <div class="relative">
                        <img src="{{ Auth::user()->profile_photo_url }}" alt="Photo de profil" class="h-10 w-10 rounded-full cursor-pointer" id="profile-menu-button">
                        <div id="profile-menu" class="hidden absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 shadow-md rounded-md overflow-hidden z-20">
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">Mon profil</a>
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

    <section class="bg-cover bg-center h-screen text-white flex items-center justify-center filter brightness-100 dark:brightness-50" style="background-image: url('{{ asset('images/exemple.webp') }}');">
        <div class="bg-black bg-opacity-50 p-8 rounded-lg">
            <h1 class="text-5xl font-bold mb-4">Bienvenue chez Paris Caretaker Services</h1>
            <p class="text-2xl">Gestion complète de vos propriétés locatives.</p>
        </div>
    </section>

    <section class="container mx-auto px-4 py-16">
        <h2 class="text-3xl font-semibold text-center text-red-500 dark:text-red-300 mb-8">Nos Services</h2>
        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold mb-2 text-gray-900 dark:text-gray-100">Check-in / Check-out</h3>
                <p class="text-gray-700 dark:text-gray-300">Accueil et départ des clients avec la plus grande attention.</p>
            </div>
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold mb-2 text-gray-900 dark:text-gray-100">Nettoyage</h3>
                <p class="text-gray-700 dark:text-gray-300">Nettoyage professionnel avant et après chaque location.</p>
            </div>
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold mb-2 text-gray-900 dark:text-gray-100">Maintenance</h3>
                <p class="text-gray-700 dark:text-gray-300">Maintenance et petites réparations assurées rapidement.</p>
            </div>
        </div>
    </section>

    <section class="container mx-auto px-4 py-16">
        <h2 class="text-3xl font-semibold text-center text-red-500 dark:text-red-300 mb-8">Nos Logements</h2>
        <div class="grid md:grid-cols-3 gap-8">
            @foreach($biens as $bien)
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                    <img src="{{ $bien->image_url }}" alt="Image du logement" class="h-40 w-full object-cover rounded-md mb-4">
                    <h3 class="text-xl font-semibold mb-2 text-gray-900 dark:text-gray-100">{{ $bien->titre }}</h3>
                    <p class="text-gray-700 dark:text-gray-300">{{ $bien->description }}</p>
                    <a href="{{ route('biens.show', $bien) }}" class="text-blue-500 dark:text-blue-300 hover:underline mt-4 inline-block">Voir plus</a>
                </div>
            @endforeach
        </div>
    </section>

    <section class="bg-gray-50 dark:bg-gray-700 py-16">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-semibold text-red-500 dark:text-red-300 mb-4">Estimez vos revenus</h2>
            <p class="text-gray-700 dark:text-gray-300 mb-8">Utilisez notre simulateur pour estimer les revenus potentiels de votre propriété.</p>
            <a href="{{ route('simulation') }}" class="bg-blue-500 hover:bg-blue-700 dark:bg-blue-400 dark:hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Commencer la simulation</a>
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