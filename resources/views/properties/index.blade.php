@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <div class="flex flex-wrap justify-between">
        @foreach ($properties as $property)
            <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 p-4">
                <div class="border border-gray-200 rounded-lg p-4">
                    <h2 class="font-bold text-lg">{{ $property->title }}</h2>
                    <p>{{ $property->description }}</p>
                    <a href="{{ route('properties.show', $property) }}" class="text-blue-500 hover:text-blue-700">View Details</a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection