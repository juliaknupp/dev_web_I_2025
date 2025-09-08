<?php
  include("../../service/venda.service.php");
  $acao = $_POST['acao'];
  $cliente = isset($_POST['cliente'])?$_POST['cliente']:null;
  $func = isset($_POST['funcionario'])?$_POST['funcionario']:null;
  $produtos = isset($_POST['produtos_hidden'])?explode(',', $_POST['produtos_hidden']):null;
  $qtd = isset($_POST['qtd'])?explode(',', $_POST['qtd']):null;
  $data = isset($_POST['data'])?$_POST['data']:null;
  $pagamento = isset($_POST['pagamento'])?$_POST['pagamento']:null;
  $desconto = isset($_POST['desconto'])?$_POST['desconto']:null;
  $id = isset($_POST['id'])?$_POST['id']:null;

  if($acao=="cadastrar") {
    $valorTotal = calcularTotal($produtos, $qtd, $desconto);
    cadastrarVenda($cliente, $func, $produtos, $qtd, $valorTotal, $data, $pagamento, $desconto);
    echo "Cadastrado com sucesso";
  }
  else if($acao=="alterar") {
    $valorTotal = calcularTotal($produtos, $qtd, $desconto);
    alterarVenda($cliente, $func, $produtos, $qtd, $valorTotal, $data, $pagamento, $desconto);
    echo "Alterado com sucesso";
  }
  else if($acao=="remover") {
    removerVenda($id);
    echo "Removido com sucesso";
  }
  else {
    echo "Ação inválida";
  }
?>