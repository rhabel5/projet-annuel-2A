@extends('layouts.app')

@section('content')
    <form action="/bien/ajout_image" method="POST" enctype="multipart/form-data">
        @csrf

        <div  class="flex justify-between items-center p-6 bg-gray-100">


        @for ($i = 0; $i < 5; $i++)
            <div class="w-[400px] relative border-2 border-gray-300 border-dashed rounded-lg p-6" id="dropzone{{$i}}">
                <input type="file" class="absolute inset-0 w-full h-full opacity-0 z-50" name="file-upload{{$i}}" id="file-upload{{$i}}" />
                <div class="text-center">
                    <img class="mx-auto h-12 w-12" src="https://www.svgrepo.com/show/357902/image-upload.svg" alt="">
                    <h3 class="mt-2 text-sm font-medium text-gray-900">
                        <label for="file-upload{{$i}}" class="relative cursor-pointer">
                            <span>Glissez et lachez pour </span>
                            <span class="text-indigo-600"> ajouter une image</span>
                            <span> à votre bien </span>
                        </label>
                    </h3>
                    <p class="mt-1 text-xs text-gray-500">PNG, JPG, GIF up to 10MB</p>
                </div>
                <img src="" class="mt-4 mx-auto max-h-40 hidden" id="preview{{$i}}">
            </div>
            <script>
                var dropzone = document.getElementById('dropzone{{$i}}');
                dropzone.addEventListener('dragover', e => {
                    e.preventDefault();
                    dropzone.classList.add('border-indigo-600');
                });
                dropzone.addEventListener('dragleave', e => {
                    e.preventDefault();
                    dropzone.classList.remove('border-indigo-600');
                });
                dropzone.addEventListener('drop', e => {
                    e.preventDefault();
                    dropzone.classList.remove('border-indigo-600');
                    var file = e.dataTransfer.files[0];
                    displayPreview(file, 'preview{{$i}}');
                });
                var input = document.getElementById('file-upload{{$i}}');
                input.addEventListener('change', e => {
                    var file = e.target.files[0];
                    displayPreview(file, 'preview{{$i}}');
                });
            </script>
        @endfor
        </div>
        <input type="hidden" name="id" id="{{Request::get('id')}}">
        <button type="submit" class="mt-4 bg-indigo-600 text-white px-6 py-2 rounded">Submit</button>
    </form>
    <script>
        function displayPreview(file, previewId) {
            var reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = () => {
                var preview = document.getElementById(previewId);
                preview.src = reader.result;
                preview.classList.remove('hidden');
            };
        }
    </script>
@endsection
