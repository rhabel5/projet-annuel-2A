@php

    use App\Models\Bien;
    use App\Models\ElementDevis;
    use App\Models\User;
    $presta = User::find($prestataire->id_prestataire);
    $bien = Bien::find($reservation->id_bien);
    $elements_devis = ElementDevis::where('devis_id', $offre->devis_id)->get();

@endphp

    <!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Proforma Invoice</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="font-sans bg-gray-100 p-8">
<div class="container mx-auto bg-white shadow-md rounded-lg p-6">
    <div class="flex justify-between items-center mb-8">
        <img src="{{ public_path('logo.png') }}" alt="GreenMotor Shop" class="w-32">
        <div class="text-right">
            <p class="font-bold">{{ $prestataire->nom_entreprise }}</p>
            <p>{{ $prestataire->adresse }}</p>
            <p>{{ $prestataire->code_postal . ' ' . $prestataire->ville }}</p>
            <p>TEL : {{ $presta->tel }}</p>
            <p>E-MAIL : {{ $presta->email }}</p>
            <p>SIRET : {{ $prestataire->siret }}</p>
        </div>
    </div>

    <div class="flex justify-between items-center mb-8">
        <div>
            <p class="font-bold">{{ $bailleur->firstname . ' ' . $bailleur->lastname }}</p>
            <p>{{ $bien->adresse }}</p>
            <p>{{ $bien->code_postal . ' ' . $bien->ville }} - FRANCE</p>
            <p>Tél : {{ $bailleur->phone }}</p>
        </div>
    </div>

    <table class="min-w-full bg-white border-collapse rounded-lg">
        <thead>
        <tr class="w-full bg-gray-200 text-left text-xs uppercase">
            <th class="px-4 py-2 border">DESIGNATION</th>
            <th class="px-4 py-2 border">PRIX UNITAIRE </th>
            <th class="px-4 py-2 border">QUANTITÉ</th>
            <th class="px-4 py-2 border">MONTANT</th>
        </tr>
        </thead>
        <tbody>
        @foreach($elements_devis as $item)
        <tr class="w-full border">
            <td class="px-4 py-2 border">{{ $item->designation }}</td>
            <td class="px-4 py-2 border">{{ $item->prixunite }}</td>
            <td class="px-4 py-2 border">{{ $item->quantite }}</td>
            <td class="px-4 py-2 border">{{ $item->prixtotal }}</td>
        </tr>
        @endforeach
        <!-- Ajoutez d'autres lignes si nécessaire -->
        </tbody>
    </table>

    <div class="mt-8 text-right">
        <p class="mb-2">TOTAL <span class="ml-4">{{ $offre->prix_total }} €</span></p>
    </div>
</div>

<div class="container mx-auto bg-white shadow-md rounded-lg p-6 mt-8">
    <div class="text-center font-bold mb-4">RELEVÉ D'IDENTITÉ BANCAIRE</div>
    <div class="text-center">
        <p>Titulaire du compte : {{$prestataire->nom_entreprise}}</p>
        <p>{{ $prestataire->adresse . ' ' . $prestataire->code_postal . ' ' . $prestataire->ville }}</p>
        <p>IBAN : {{ $prestataire->iban}}</p>
        <p>BIC : {{ $prestataire->bic}}</p>
        <p class="mt-4">Devis valable 1 mois</p>
    </div>
</div>
</body>
</html>

