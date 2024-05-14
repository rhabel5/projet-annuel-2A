<head>

    <!-- Ajoutez cette ligne pour inclure le CSS de Bootstrap -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">

</head>

<h1>Utilisateurs</h1>

<!-- Ajouter 'table' en tant que classe pour styliser le tableau avec Bootstrap -->
<table class="table">
    <thead>
    <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Email</th>
        <th>Numéro de Téléphone</th>
        <th>Role</th>
    </tr>
    </thead>

    <tbody>
    @foreach ($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->nom }}</td>
            <td>{{ $user->prenom }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->tel }}</td>
            <td>{{ $user->role }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
