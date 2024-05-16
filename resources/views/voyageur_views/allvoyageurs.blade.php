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
            <td>{{ $user->name }}</td>
            <td>{{ $user->surname }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->phone }}</td>
            <td>
                <!-- Bouton Modifier -->
                <button class="btn btn-alert" ><a href="{{ route('bailleur.edit', $user->id) }}">Modifier</a></button>
                <!-- Bouton Supprimer -->
                <form action="{{ route('bailleur.destroy', $user) }}" method="POST" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
            </td>
        </tr>
    @endforeach
        </tbody>
    </table>
</div>

<!--
A faire par Wakil - Ajouter des boutons pour supprimer,
modifier, ajouter, le nombre de biens, et voir tout les biens d'un bailleur
-->

