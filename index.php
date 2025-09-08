<?php
    session_start();
    if (!isset($_SESSION["login"]) || $_SESSION["login"] == []) {
        header("Location: login.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Knupp & Co.</title>
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
    padding: 20px;
    line-height: 1.6;
}

h1 {
    color: #4e342e; 
    text-align: center;
    margin-bottom: 15px;
}


p {
    background-color: #d7ccc8; 
    color: #3e2723;
    padding: 10px 15px;
    border-radius: 8px;
    text-align: center;
    margin-bottom: 25px;
}


p a {
    margin-left: 10px;
    color: #6d4c41; 
    text-decoration: none;
    font-weight: bold;
}
p a:hover {
    color: #3e2723;
    text-decoration: underline;
}


h3 {
    color: #5d4037;
    margin-bottom: 10px;
}


ul {
    list-style: none;
    display: flex;
    flex-direction: column;
    gap: 12px;
    max-width: 300px;
    margin: auto;
}

ul li a {
    display: block;
    padding: 12px;
    background-color: #efebe9;
    color: #3e2723;
    border: 2px solid #a1887f; 
    border-radius: 8px;
    text-decoration: none;
    text-align: center;
    font-weight: bold;
    transition: all 0.3s ease;
}

ul li a:hover {
    background-color: #a1887f; 
    color: #fff;
    transform: scale(1.05);
    box-shadow: 0px 4px 8px rgba(0,0,0,0.2);
}
</style>
    <h1>Knupp & Co.</h1>
    <p>
        bem-vindo, <?php echo $_SESSION["login"]["nome"]; ?>!
        <a href="logout.php">Logout</a>
    </p>
    <h3>Informations:</h3>
    <ul>
        <li><a href="../funcionario/tabela_funcionario.php">Tabela Funcionários</a></li>
        <li><a href="../cliente/tabela_cliente.php">Tabela Clientes</a></li>
        <li><a href="../produtos/tabela_produtos.php">Tabela Produtos</a></li>
        <li><a href="../venda/tabela_venda.php">Tabela Vendas</a></li>
    </ul>
</body>
</html>