<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paris Caretaker Services</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50">
    <div class="container mx-auto px-4">
        <header class="flex flex-col items-center justify-between py-6">
            <h1 class="text-3xl font-bold text-gray-800">Bienvenue chez Paris Caretaker Services</h1>
            <p class="text-gray-600">Gestion complète de vos propriétés locatives.</p>
            <nav>
                @guest
                    <a href="{{ route('login') }}" class="text-blue-500 hover:text-blue-700">Se connecter</a>
                    <a href="{{ route('register') }}" class="ml-4 text-blue-500 hover:text-blue-700">Créer un compte</a>
                @else
                    <span>Bonjour, {{ Auth::user()->name }}</span>
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                       class="text-red-500 hover:text-red-700">Déconnexion</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @endguest
            </nav>
        </header>

        <section>
            <h2 class="text-2xl font-semibold text-red-500 mb-6">Nos Services</h2>
            <div class="grid grid-cols-3 gap-4">
                <div class="p-6 shadow-lg rounded-lg bg-white">
                    <h3 class="font-semibold text-lg">Check-in / Check-out</h3>
                    <p class="text-gray-600">Accueil et départ des clients avec la plus grande attention.</p>
                </div>
                <div class="p-6 shadow-lg rounded-lg bg-white">
                    <h3 class="font-semibold text-lg">Nettoyage</h3>
                    <p class="text-gray-600">Nettoyage professionnel avant et après chaque location.</p>
                </div>
                <div class="p-6 shadow-lg rounded-lg bg-white">
                    <h3 class="font-semibold text-lg">Maintenance</h3>
                    <p class="text-gray-600">Maintenance et petites réparations assurées rapidement.</p>
                </div>
            </div>
        </section>

        <section class="text-center my-12">
            <h2 class="text-2xl font-semibold text-red-500 mb-3">Estimez vos revenus</h2>
            <p class="text-gray-600 mb-6">Utilisez notre simulateur pour estimer les revenus potentiels de votre propriété.</p>
            <a href="{{ route('simulation') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Commencer la simulation</a>
        </section>

        <footer class="py-4 text-center text-gray-600">
            © {{ date('Y') }} Paris Caretaker Services. Tous droits réservés.
        </footer>
    </div>
</body>
</html>