<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paris Caretaker Services</title>
    @vite('resources/css/app.css')
    @vite('resources/js/dark-mode.js')
    @vite('resources/js/language-menu.js')
</head>
<body class="bg-gray-100 dark:bg-gray-900 font-sans">
    <header class="bg-white dark:bg-gray-800 shadow-md">
        <div class="container mx-auto px-4 py-6 flex justify-between items-center">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-10">
            <nav class="flex items-center">
                @guest
                    <a href="{{ route('login') }}" class="text-gray-700 dark:text-gray-300 font-semibold hover:text-gray-900 dark:hover:text-white mx-2">{{ __('messages.login') }}</a>
                    <a href="{{ route('register') }}" class="text-gray-700 dark:text-gray-300 font-semibold hover:text-gray-900 dark:hover:text-white mx-2">{{ __('messages.register') }}</a>
                @else
                    <span class="text-gray-700 dark:text-gray-300 mx-2">{{ __('messages.hello', ['name' => Auth::user()->name]) }}</span>
                    <div class="relative">
                        <img src="{{ Auth::user()->profile_photo_url }}" alt="Photo de profil" class="h-10 w-10 rounded-full cursor-pointer" id="profile-menu-button">
                        <div id="profile-menu" class="hidden absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 shadow-md rounded-md overflow-hidden z-20">
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">{{ __('messages.my_profile') }}</a>
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                               class="block px-4 py-2 text-red-500 dark:text-red-300 hover:bg-gray-100 dark:hover:bg-gray-700">{{ __('messages.logout') }}</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                @endguest
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

    <section class="bg-cover bg-center h-screen text-white flex items-center justify-center filter brightness-100 dark:brightness-50" style="background-image: url('{{ asset('images/exemple.webp') }}');">
        <div class="bg-black bg-opacity-50 p-8 rounded-lg">
            <h1 class="text-5xl font-bold mb-4">{{ __('messages.welcome') }}</h1>
            <p class="text-2xl">{{ __('messages.manage_properties') }}</p>
        </div>
    </section>

    <section class="container mx-auto px-4 py-16">
        <h2 class="text-3xl font-semibold text-center text-red-500 dark:text-red-300 mb-8">{{ __('messages.services') }}</h2>
        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold mb-2 text-gray-900 dark:text-gray-100">{{ __('messages.checkin_checkout') }}</h3>
                <p class="text-gray-700 dark:text-gray-300">{{ __('messages.checkin_checkout_desc') }}</p>
            </div>
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold mb-2 text-gray-900 dark:text-gray-100">{{ __('messages.cleaning') }}</h3>
                <p class="text-gray-700 dark:text-gray-300">{{ __('messages.cleaning_desc') }}</p>
            </div>
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold mb-2 text-gray-900 dark:text-gray-100">{{ __('messages.maintenance') }}</h3>
                <p class="text-gray-700 dark:text-gray-300">{{ __('messages.maintenance_desc') }}</p>
            </div>
        </div>
    </section>

    <section class="container mx-auto px-4 py-16">
        <h2 class="text-3xl font-semibold text-center text-red-500 dark:text-red-300 mb-8">{{ __('messages.our_properties') }}</h2>
        <div class="grid md:grid-cols-3 gap-8">
            @foreach($biens as $bien)
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                    <img src="{{ $bien->image_url }}" alt="Image du logement" class="h-40 w-full object-cover rounded-md mb-4">
                    <h3 class="text-xl font-semibold mb-2 text-gray-900 dark:text-gray-100">{{ $bien->titre }}</h3>
                    <p class="text-gray-700 dark:text-gray-300">{{ $bien->description }}</p>
                    <a href="{{ route('biens.show', $bien) }}" class="text-blue-500 dark:text-blue-300 hover:underline mt-4 inline-block">{{ __('messages.view_more') }}</a>
                </div>
            @endforeach
        </div>
    </section>

    <section class="bg-gray-50 dark:bg-gray-700 py-16">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-semibold text-red-500 dark:text-red-300 mb-4">{{ __('messages.estimate_income') }}</h2>
            <p class="text-gray-700 dark:text-gray-300 mb-8">{{ __('messages.use_simulator') }}</p>
            <a href="{{ route('simulation') }}" class="bg-blue-500 hover:bg-blue-700 dark:bg-blue-400 dark:hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">{{ __('messages.start_simulation') }}</a>
        </div>
    </section>

    <footer class="bg-white dark:bg-gray-800 py-6">
        <div class="container mx-auto px-4 text-center text-gray-600 dark:text-gray-300">
            © {{ date('Y') }} Paris Caretaker Services. {{ __('messages.all_rights_reserved') }}
        </div>
    </footer>
</body>
</html>
