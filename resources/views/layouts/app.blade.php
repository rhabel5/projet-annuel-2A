<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">


    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/chatbot.js', 'resources/js/dark-mode.js'])
</head>
<body class="font-sans antialiased transition duration-500 ease-in-out">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900 transition duration-500 ease-in-out">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white dark:bg-gray-800 shadow transition duration-500 ease-in-out">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main class="transition duration-500 ease-in-out">
            @yield('content')
        </main>
    </div>

    @include('layouts.chatbot')

    <footer class="bg-white dark:bg-gray-800 py-6 transition duration-500 ease-in-out">
        <div class="container mx-auto px-4 text-center text-gray-600 dark:text-gray-300">
            © {{ date('Y') }} Paris Caretaker Services. {{ __('messages.all_rights_reserved') }}
        </div>
    </footer>
</body>
</html>
