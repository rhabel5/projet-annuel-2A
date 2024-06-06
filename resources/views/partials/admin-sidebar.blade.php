<div class="bg-gray-100 dark:bg-gray-900 text-gray-700 dark:text-gray-300 w-64 space-y-6 py-7 px-2 absolute inset-y-0 left-0 transform -translate-x-full md:relative md:translate-x-0 transition duration-500 ease-in-out">
    <div class="px-4 py-2">
        <img src="https://via.placeholder.com/150" alt="Logo" class="w-12 h-12">
        <h1 class="text-gray-700 dark:text-gray-300 text-2xl font-semibold mt-2 transition duration-500 ease-in-out">PCS Backoffice</h1>
    </div>
    <nav>
        <a href="{{ route('admin.users.index') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-200 dark:hover:bg-gray-800 transition duration-500 ease-in-out">Utilisateurs</a>
        <a href="{{ route('admin.biens.index') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-200 dark:hover:bg-gray-800 transition duration-500 ease-in-out">Biens</a>
        <a href="{{ route('admin.services.index') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-200 dark:hover:bg-gray-800 transition duration-500 ease-in-out">Commentaires</a>
        <a href="{{ route('admin.tickets.index') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-200 dark:hover:bg-gray-800 transition duration-500 ease-in-out">Tickets</a>
    </nav>
</div>