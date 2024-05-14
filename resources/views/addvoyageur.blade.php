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

        button[type="submit"]:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
<form action="/registervoyageur" method="post">
    @csrf
    <h1>Inscription</h1>
    <input type="text" name="prenom" placeholder="prenom">
    <input type="text" name="nom" placeholder="nom">
    <input type="date" name="naissance" placeholder="naissance">
    <input type="text" name="email" placeholder="email">
    <input type="text" name="tel" placeholder="tel">
    <input type="password" name="password" placeholder="password">
    <input type="hidden" name="role" value="bailleur">
    <input type="text" name="rib" placeholder="RIB">
    <button type="submit">S'inscrire</button>
</form>
</body>
</html>
