<form action="{{ route('properties.update', $property->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label for="title">Title:</label>
    <input type="text" name="title" value="{{ $property->title }}" required>

    <label for="description">Description:</label>
    <textarea name="description" required>{{ $property->description }}</textarea>

    <button type="submit">Update Property</button>
</form>