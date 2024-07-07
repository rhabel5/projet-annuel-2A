<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire Modulable</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
<div class="bg-white p-8 rounded-lg shadow-md w-full max-w-4xl">
    <h1 class="text-2xl font-bold mb-6 text-center">Créer votre devis</h1>
    <form id="dynamicForm" class="space-y-4" action="{{ route('samba') }}" method="POST">
        <h2>Ajoutez ci dessous les différents éléments de votre devis. </h2>
        @csrf
        <div class="grid grid-cols-7 gap-4 mb-2">
            <label class="block text-sm font-medium text-gray-700 col-span-2">Désignation</label>
            <label class="block text-sm font-medium text-gray-700">Quantité</label>
            <label class="block text-sm font-medium text-gray-700">Prix Unitaire (€)</label>
        </div>
        <div id="formFields">
            <div class="form-field grid grid-cols-7 gap-4 mb-4">
                <input type="text" name="designation[]" placeholder="Désignation" class="col-span-2 p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <input type="number" name="quantite[]" placeholder="Quantité" class="p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <input type="number" name="prixunite[]" placeholder="Prix Unite" class="p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
        </div>
        <input type="hidden" name="prestation" value="{{ request()->route('prestation') }}">
        <button type="button" onclick="addField()" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Ajouter une ligne</button>
        <button type="submit" class="w-full bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Soumettre</button>
    </form>
</div>

<script>
    function addField() {
        const formFields = document.getElementById('formFields');

        const newFieldDiv = document.createElement('div');
        newFieldDiv.classList.add('form-field', 'grid', 'grid-cols-7', 'gap-4', 'mb-4');

        const fields = [
            { placeholder: 'Désignation', type: 'text', name: 'designation[]', span: 'col-span-2' },
            { placeholder: 'Quantité', type: 'number', name: 'quantite[]' },
            { placeholder: 'Prix Unité', type: 'number', step: '0.01', name: 'prixunite[]' },
        ];

        fields.forEach(field => {
            const input = document.createElement('input');
            input.setAttribute('type', field.type);
            input.setAttribute('placeholder', field.placeholder);
            input.setAttribute('name', field.name);
            input.classList.add('p-2', 'border', 'border-gray-300', 'rounded-md', 'shadow-sm', 'focus:ring-indigo-500', 'focus:border-indigo-500', 'sm:text-sm');
            if (field.step) input.setAttribute('step', field.step);
            if (field.span) input.classList.add(field.span);
            newFieldDiv.appendChild(input);
        });

        formFields.appendChild(newFieldDiv);
    }
</script>
</body>
</html>
