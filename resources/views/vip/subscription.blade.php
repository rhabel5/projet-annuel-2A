<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Devenir VIP</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6">Devenir VIP</h1>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-semibold mb-4">Formule d'abonnement VIP</h2>
            <p class="mb-4">Profitez de nombreux avantages en devenant membre VIP :</p>
            <ul class="list-disc list-inside mb-4">
                <li>Accès prioritaire aux nouvelles offres</li>
                <li>Réductions exclusives</li>
                <li>Support client dédié</li>
            </ul>
            <form action="{{ route('vip.subscribe') }}" method="POST">
                @csrf
                <button type="submit" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">S'abonner</button>
            </form>
        </div>
    </div>
</body>
</html>