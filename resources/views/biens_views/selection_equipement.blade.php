<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sélection d'Équipements</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <style>
        .selected {
            background-color: rgba(0, 0, 0, 0.3);
        }
    </style>
</head>
<body class="bg-gray-100">
<div class="container mx-auto p-6">
    <div class="breadcrumb mb-4 text-gray-600">
        <span>Sélection d'Équipements</span>
    </div>
    <form id="equipment-form" action="{{route('equipements.postselect')}}" method="POST">
        @csrf
        <div class="grid grid-cols-3 gap-4">
            @foreach(\App\Models\Equipements::all() as $equipment)
                <div class="icon-container p-4 border rounded cursor-pointer text-center" data-equipment="{{ $equipment->nom }}">
                    <input type="hidden" name="equipment[{{ $equipment->nom }}]" value="0">
                    <img src="{{asset($equipment->image_url)  }}" alt="{{ $equipment->nom }}" class="mx-auto mb-2">
                    <span class="block text-gray-700">{{ ucfirst($equipment->nom) }}</span>
                </div>
            @endforeach
                <input type="hidden" name="id_bien" value="{{ request()->get('id') }}">
        </div>
        <button type="submit" class="mt-6 px-4 py-2 bg-blue-500 text-white rounded">Terminer</button>
    </form>
</div>
<script>
    document.querySelectorAll('.icon-container').forEach(container => {
        container.addEventListener('click', () => {
            const input = container.querySelector('input[type="hidden"]');
            const selected = input.value === '1';
            input.value = selected ? '0' : '1';
            container.classList.toggle('selected', !selected);
        });
    });
</script>
</body>
</html>
