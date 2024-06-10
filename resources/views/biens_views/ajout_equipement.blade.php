
<head>

    <!-- Ajoutez cette ligne pour inclure le CSS de Bootstrap -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">

</head>

            Cree un equipement
        </div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <strong>{{ $message }}</strong>
            </div>
        @endif
        <form action="{{ route('equipements.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700">Nom:</label>
                <input type="text" name="nom" required class="w-full mt-2 mb-6 px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-green-500" placeholder="Nom"/>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Image:</label>
                <input type="file" name="image" required class="w-full mt-2 mb-6 px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-green-500" placeholder="Image"/>
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                Valider
            </button>
        </form>
    </div>
</div>
</body>
</html>
