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
    </tr>
    </thead>

    <tbody>
        @foreach($bailleurUsers as $user)
            <tr>
                <th scope="row">{{ $user->id }}</th>
                <td>{{ $user->nom }}</td>
                <td>{{ $user->prenom }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->tel }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<!--
A faire par Wakil - Ajouter des boutons pour supprimer,
modifier, ajouter, le nombre de biens, et voir tout les biens d'un bailleur
-->

