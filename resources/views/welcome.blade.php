<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paris Caretaker Services</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 font-sans">
    <header class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-6 flex justify-between items-center">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-10">
            <nav>
                @guest
                    <a href="{{ route('login') }}" class="text-gray-700 font-semibold hover:text-gray-900 mx-2">Se connecter</a>
                    <a href="{{ route('register') }}" class="text-gray-700 font-semibold hover:text-gray-900 mx-2">Créer un compte</a>
                @else
                    <span class="text-gray-700 mx-2">Bonjour, {{ Auth::user()->name }}</span>
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                       class="text-red-500 font-semibold hover:text-red-700 mx-2">Déconnexion</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @endguest
            </nav>
        </div>
    </header>

    <section class="bg-cover bg-center h-screen text-white flex items-center justify-center" style="background-image: url('{{ asset('images/exemple.webp') }}');">
        <div class="bg-black bg-opacity-50 p-8 rounded-lg">
            <h1 class="text-5xl font-bold mb-4">Bienvenue chez Paris Caretaker Services</h1>
            <p class="text-2xl">Gestion complète de vos propriétés locatives.</p>
        </div>
    </section>

    <section class="container mx-auto px-4 py-16">
        <h2 class="text-3xl font-semibold text-center text-red-500 mb-8">Nos Services</h2>
        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold mb-2">Check-in / Check-out</h3>
                <p class="text-gray-700">Accueil et départ des clients avec la plus grande attention.</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold mb-2">Nettoyage</h3>
                <p class="text-gray-700">Nettoyage professionnel avant et après chaque location.</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold mb-2">Maintenance</h3>
                <p class="text-gray-700">Maintenance et petites réparations assurées rapidement.</p>
            </div>
        </div>
    </section>

    <section class="bg-gray-50 py-16">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-semibold text-red-500 mb-4">Estimez vos revenus</h2>
            <p class="text-gray-700 mb-8">Utilisez notre simulateur pour estimer les revenus potentiels de votre propriété.</p>
            <a href="{{ route('simulation') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Commencer la simulation</a>
        </div>
    </section>

    <footer class="bg-white py-6">
        <div class="container mx-auto px-4 text-center text-gray-600">
            © {{ date('Y') }} Paris Caretaker Services. Tous droits réservés.
        </div>
    </footer>
</body>
</html>