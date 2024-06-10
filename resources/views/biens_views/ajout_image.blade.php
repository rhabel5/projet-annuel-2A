<!DOCTYPE html>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@if(session('error'))
    <div class="alert alert-success">
        {{ session('error') }}
    </div>
@endif
<div class="flex justify-center mt-6">
    <form method="post" action="{{route('biens.image.post')}}" enctype="multipart/form-data" class="border p-6 rounded-md">
        @csrf
        <h2 class="text-lg mb-4">Upload des images</h2>
        <div class="space-y-4">
            <input class="w-full p-2" type="file" name="image1" id="file1">
            <input class="w-full p-2" type="file" name="image2" id="file2">
            <input class="w-full p-2" type="file" name="image3" id="file3">
            <input class="w-full p-2" type="file" name="image4" id="file4">
            <input class="w-full p-2" type="file" name="image5" id="file5">
            <input type="hidden" name="id_bien" value="{{ $id_bien }}">
        </div>
        <button class="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-center" type="submit">
            Envoyer
        </button>
    </form>

</div>
</body>

</html>
