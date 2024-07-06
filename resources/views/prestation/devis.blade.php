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
    <h1 class="text-2xl font-bold mb-6 text-center">Formulaire de Facture Modulable</h1>
    <form id="dynamicForm" class="space-y-4" action="">
        @csrf
        <div id="formFields">
            <div class="form-field grid grid-cols-7 gap-4">
                <input type="text" placeholder="Désignation" class="col-span-2 p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <input type="number" placeholder="Quantité" class="p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <input type="number" step="0.01" placeholder="P.U. HT" class="p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <input type="number" step="0.01" placeholder="P.U. TTC" class="p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <input type="number" step="0.01" placeholder="%TVA" class="p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <input type="number" step="0.01" placeholder="Montant TTC" class="p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <input type="number" step="0.01" placeholder="TVA" class="p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
        </div>
        <button type="button" onclick="addField()" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Ajouter une ligne</button>
        <button type="submit" class="w-full bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Soumettre</button>
    </form>
</div>

<script>
    function addField() {
        const formFields = document.getElementById('formFields');

        const newFieldDiv = document.createElement('div');
        newFieldDiv.classList.add('form-field', 'grid', 'grid-cols-7', 'gap-4', 'mt-4');

        const fields = [
            { placeholder: 'Désignation', type: 'text', span: 'col-span-2' },
            { placeholder: 'Quantité', type: 'number' },
            { placeholder: 'P.U. HT', type: 'number', step: '0.01' },
            { placeholder: 'P.U. TTC', type: 'number', step: '0.01' },
            { placeholder: '%TVA', type: 'number', step: '0.01' },
            { placeholder: 'Montant TTC', type: 'number', step: '0.01' },
            { placeholder: 'TVA', type: 'number', step: '0.01' },
        ];

        fields.forEach(field => {
            const input = document.createElement('input');
            input.setAttribute('type', field.type);
            input.setAttribute('placeholder', field.placeholder);
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
