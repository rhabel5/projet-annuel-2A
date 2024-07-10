@extends('layouts.app')

@php

@endphp

@section('content')
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
            <h2 class="text-2xl font-bold mb-4 text-gray-900 text-center">Compte rendu intervention</h2>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Success!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <form action="{{ route('ficheintervention.post') }}" method="POST">
                @csrf

                <input type="hidden" name="id_prestataire" value="{{ $prestation->id_prestataire}}">
                <input type="hidden" name="id_prestation" value="{{  $prestation->id }}">
                <input type="hidden" name="id_bien" value="{{  $prestation->id_bien }}">
                <input type="hidden" name="id_bailleur" value="{{  $prestation->id_bailleur }}">

                <div class="mb-4">
                    <label for="description" class="block text-gray-700">Description</label>
                    <textarea class="form-textarea mt-1 block w-full rounded-md shadow-sm border-gray-300" id="description" name="description" rows="3" required>{{ old('description') }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="problemes" class="block text-gray-700">Problèmes</label>
                    <textarea class="form-textarea mt-1 block w-full rounded-md shadow-sm border-gray-300" id="problemes" name="problemes" rows="3" required>{{ old('problemes') }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="realisee" class="block text-gray-700">Actions Réalisées</label>
                    <textarea class="form-textarea mt-1 block w-full rounded-md shadow-sm border-gray-300" id="realisee" name="realisee" rows="3" required>{{ old('realisee') }}</textarea>
                </div>

                <button type="submit" class="w-full bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-700">Valider</button>
            </form>
        </div>
    </div>
@endsection
