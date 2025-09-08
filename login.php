<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login-Knupp & Co.</title>
</head>
<body>
    <style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Segoe UI", Arial, sans-serif;
}

body {
    background-color: #fffaf5;
    color: #3e2723;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
}

h1 {
    color: #4e342e;
    margin-bottom: 20px;
}

form {
    background-color: #efebe9;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0px 4px 12px rgba(0,0,0,0.15);
    display: flex;
    flex-direction: column;
    gap: 15px;
    min-width: 280px;
}

label {
    font-weight: bold;
    color: #5d4037;
    margin-bottom: 4px;
    display: block;
}

input[type="email"],
input[type="text"] {
    padding: 10px;
    border: 2px solid #a1887f;
    border-radius: 8px;
    background-color: #fff;
    color: #3e2723;
    transition: border-color 0.3s ease;
    width: 100%;
}

input[type="email"]:focus,
input[type="text"]:focus {
    border-color: #6d4c41;
    outline: none;
}

button {
    padding: 12px;
    background-color: #6d4c41;
    color: #fff;
    font-weight: bold;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
}

button:hover {
    background-color: #4e342e;
    transform: scale(1.05);
}

p {
    margin-top: 15px;
    text-align: center;
}

p a {
    color: #6d4c41;
    text-decoration: none;
    font-weight: bold;
}

p a:hover {
    color: #3e2723;
    text-decoration: underline;
}

        </style>
    <h1>Login</h1>
    <form action="" method="post">
        <label>Email </label><input type="email" name="email">
        <label>Senha </label><input type="text" name="senha">
        <button>Logar</button>
    </form>
    <p><a href="../usuarios/cadastro_usuarios.php">Cadastre-se</a></p>
    <?php

        session_start();
        include("../../service/usuario.service.php");
        if (!isset($_SESSION["login"])) $_SESSION["login"] = [];
        $email = isset($_POST["email"]) ? $_POST["email"] : null;
        $senha = isset($_POST["senha"]) ? $_POST["senha"] : null;
        $array = arrayUsuario();
        foreach($array as $user) {
            if ($user->email == $email && $user->senha == $senha) {
                $_SESSION["login"]["email"] = $email;
                $_SESSION["login"]["senha"] = $senha;
                $_SESSION["login"]["nome"] = $user->nome;
                header('Location: index.php');
                exit;
            }
        }
    ?>
</body>
</html>