<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body {
            display: flex;
            justify-content:center;
            align-items: center;
            height: 100vh;
            background: #F2F2F2;
        }

        form {
            background: #fff;
            box-shadow: 0px 0px 25px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 4px;
        }

        h1 {
            margin-bottom: 10px;
            text-align: center;
        }

        input[type="text"],
        input[type="password"],
        input[type="date"] {
            display: block;
            border: 1px solid #ccc;
            border-radius: 4px;
            padding: 10px;
            width: 100%;
            margin-bottom: 10px;
        }

        button[type="submit"] {
            background: #007BFF;
            color: #fff;
            border: 0;
            border-radius: 4px;
            padding: 10px;
            width: 100%;
            cursor: pointer;
        }

        .flash-message {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            border: 1px solid;
            padding: 10px;
            border-radius: 4px;
        }
        .flash-message.success {
            color: green;
            border-color: green;
        }
        .flash-message.error {
            color: red;
            border-color: red;
        }

        button[type="submit"]:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
@if (session('success'))
    <div class="flash-message success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="flash-message error">
        {{ session('error') }}
    </div>
@endif
<form action="{{ route('users.store') }}" method="POST">
    @csrf
    <h1>Inscription</h1>
    <input type="text" name="name" placeholder="Prénom">
    <input type="text" name="surname" placeholder="Nom">
    <input type="date" name="birth_date" placeholder="Date de Naissance">
    <input type="text" name="email" placeholder="Email">
    <input type="text" name="phone" placeholder="Numéro de téléphone">
    <input type="password" name="password" placeholder="Mot de passe">
    <input type="hidden" name="role" value="prestataire">
    <input type="text" name="availability" placeholder="Disponibilités"> <!--pour les disponibilité faire comme staffme-->
    <input type="text" name="rib" placeholder="Relevé d'identité bancaire">
    <button type="submit">S'inscrire</button>
</form>

<script>
    // If you want flash message to auto-dismiss after few seconds
    setTimeout(function() {
        const flashMessageEl = document.querySelector('.flash-message');
        if (flashMessageEl) {
            flashMessageEl.style.display = "none";
        }
    }, 3000);
</script>

</body>
</html>
