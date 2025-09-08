<?php
session_start();
if(!isset($_SESSION["login"]) || $_SESSION["login"] == []) {
    header("Location: ../index/login.php");
    exit;
}

include("../../service/venda.service.php");
include("../../service/cliente.service.php");
include("../../service/funcionario.service.php");
include("../../service/produto.service.php");

$venda = null;
if(isset($_GET["id"])) {
    $venda = pegaVendaPeloId($_GET["id"]);
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Cadastro de Venda</title>
<link rel="stylesheet" href="../css/style.css">
<script src="cadastro_venda.js" defer></script>
</head>
<body>
<h1>Cadastro de Venda</h1>
<form id="formCadastroVenda" action="executa_acao_venda.php" method="post">
    <input type="hidden" name="acao" value="<?= !empty($venda) ? "alterar" : "cadastrar" ?>">
    <input type="hidden" name="id" value="<?= $venda ? $venda->id : "" ?>">

    
    <label>Cliente:</label>
    <select name="cliente" id="cliente" required>
        <?php
        $clientes = listarTodosClientes();
        foreach($clientes as $cliente){
            $selected = $venda && $venda->cliente->id == $cliente->id ? "selected" : "";
            echo "<option value='{$cliente->id}' {$selected}>{$cliente->nome}</option>";
        }
        ?>
    </select>
    
    <label>Data:</label><input type="date" name="data" id="data">
    <label>Forma de pagamento:</label>
    <select name="pagamento" id="paga">
        <option value="PIX">PIX</option>
        <option value="Débito">Débito</option>
        <option value="Crédito">Crédito</option>
        <option value="Dinheiro">Dinheiro</option>
    </select>

    <label>Funcionário:</label>
    <select name="funcionario" id="funcionario" required>
        <?php
        $funcionarios = listarTodosFuncionarios();
        foreach($funcionarios as $funcionario){
            $selected = $venda && $venda->vendedor->id == $funcionario->id ? "selected" : "";
            echo "<option value='{$funcionario->id}' {$selected}>{$funcionario->nome}</option>";
        }
        ?>
    </select>

    <label>Desconto (%):</label>
    <input type="number" name="desconto" id="desconto">

    <label>Produto:</label><button type="button" id="add">+</button>
    <div id="display">
        <select name="produtos" id="produtos" required>
            <?php
            $produtos = listarTodosProdutos();
            foreach($produtos as $produto){
                echo "<option value='{$produto->id}' {$selected}>{$produto->nome} - R$ {$produto->preco}</option>";
            }
            ?>
        </select>
        <table>
            <thead>
                <th>Produto</th>
                <th>Qtd.</th>
            </thead>
            <tbody id="selecao">

            </tbody>
        </table>
    </div>

    <input type="hidden" name="produtos_hidden" id="produtos_hidden" required>
    <input type="hidden" name="qtd" id="qtd" required>

    <button type="submit"><?= !empty($venda) ? "Alterar" : "Cadastrar" ?></button>
</form>
</body>
</html>