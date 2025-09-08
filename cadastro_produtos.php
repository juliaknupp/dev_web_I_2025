<?php
    session_start();
    if (!isset($_SESSION["login"]) || $_SESSION["login"] == []) {
        header("Location: ../index/login.php");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Produto</title>
    <script src="cadastro_produtos.js"></script>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<?php
  include("../../service/produto.service.php");
    $produto = "";
    if(isset($_GET["id"]))
        $produto = pegaProdutoPeloId($_GET["id"]);

?>
<h1>Cadastro de Produtos</h1>
    <form id="formCadastroProduto" action="executa_acao_produto.php" method="post">
        <input type="hidden" name="acao" value="<?php if(!empty($produto)) {
            echo "alterar";
        } else echo "cadastrar"; ?>"/>
        <input type="hidden" name="id" value="<?php echo isset($_GET["id"])?$_GET["id"]:"" ?>"/>
        <label for="nome">Nome: </label><input type="text" id="nome" name="nome" value="<?php if(!empty($produto)) 
            echo $produto->nome; ?>"/><br/>
        <label for="preco">Preço: </label><input type="text" id="preco" name="preco" value="<?php 
        
        if(!empty($produto)) 
            echo $produto->preco; 
        
        ?>"/>
        <button type="submit"><?php if(!empty($produto)) {
            echo "Alterar";
        } else echo "Cadastrar"; ?></button>
    </form>
</body>
</html>