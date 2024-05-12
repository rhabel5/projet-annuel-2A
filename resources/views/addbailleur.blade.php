<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>Inscription</h1>
    <form action="/mala" method="post">
        @csrf
        <input type="text" name="prenom" placeholder="prenom" id="">
        <input type="text" name="nom" placeholder="nom" id="">
        <input type="date" name="naissance" placeholder="naissance" id="">
        <input type="text" name="email" placeholder="email" id="">
        <input type="text" name="tel" placeholder="tel" id="">
        <input type="password" name="password" placeholder="password" id="">
        <input type="hidden" name="role" value="bailleur">
        <input type="text" name="rib" placeholder="RIB" id="">
        <button type="submit">S'inscrire</button>
    </form>
</body>
</html>
<?php
