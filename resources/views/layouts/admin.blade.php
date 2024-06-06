<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Backoffice - PCS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/dark-mode.js', 'resources/js/language-menu.js'])
</head>
<body class="bg-gray-50 dark:bg-gray-900 font-sans transition duration-500 ease-in-out">
    <!-- Navbar -->
    @include('partials.admin-navbar')

    <div class="flex h-screen">
        <!-- Sidebar -->
        @include('partials.admin-sidebar')

        <!-- Content Area -->
        <div class="flex-1 p-10 text-gray-900 dark:text-gray-100 transition duration-500 ease-in-out">
            @yield('content')
        </div>
    </div>
</body>
</html>