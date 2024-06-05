<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            @yield('content')
        </main>
    </div>

    <footer class="bg-white dark:bg-gray-800 py-6">
        <div class="container mx-auto px-4 text-center text-gray-600 dark:text-gray-300">
            © {{ date('Y') }} Paris Caretaker Services. {{ __('messages.all_rights_reserved') }}
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var profileMenuButton = document.getElementById('profile-menu-button');
            var languageMenuButton = document.getElementById('language-menu-button');

            if (profileMenuButton) {
                profileMenuButton.addEventListener('click', function() {
                    document.getElementById('profile-menu').classList.toggle('hidden');
                });
            }

            if (languageMenuButton) {
                languageMenuButton.addEventListener('click', function() {
                    document.getElementById('language-menu').classList.toggle('hidden');
                });

                document.addEventListener('click', function(event) {
                    var isClickInsideLanguageMenu = languageMenuButton.contains(event.target) || document.getElementById('language-menu').contains(event.target);
                    if (!isClickInsideLanguageMenu) {
                        document.getElementById('language-menu').classList.add('hidden');
                    }

                    if (profileMenuButton) {
                        var isClickInsideProfileMenu = profileMenuButton.contains(event.target) || document.getElementById('profile-menu').contains(event.target);
                        if (!isClickInsideProfileMenu) {
                            document.getElementById('profile-menu').classList.add('hidden');
                        }
                    }
                });
            }
        });
    </script>
</body>
</html>