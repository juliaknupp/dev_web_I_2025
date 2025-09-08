<?php
  require_once("../../model/produto.class.php");
  function cadastrarProduto($nome, $preco) {
      $produto = new Produto(null, $nome, $preco);
      $produto->cadastrar();

  }

   function pegaProdutoPeloId($id) {
    return Produto::pegaPorId($id);
  }

  function alterarProduto($id, $novoNome, $novoPreco) {
      $produto = Produto::pegaPorId($id);
      if ($produto) {
          $produto->nome = $novoNome;
          $produto->preco = $novoPreco;
          $produto->alterar();
      }
  }

  function removerProduto($id) {
    $produto = Produto::pegaPorId($id);
      if ($produto) {
          $produto->remover();
      }
  }

  function listarProduto($filtroNome) {
      $produtos = Produto::listar($filtroNome);
      echo "<table><thead><tr><th>Nome</th><th>Preço</th>";
      echo "<th>Ações</th>";//NOVA LINHA
      echo "</tr></thead><tbody>";
      foreach($produtos as $produto) {
          echo "<tr><td>".$produto->nome."</td>";
          echo "<td>".$produto->preco."</td>";
          echo "<td><a href='http://localhost:81/padaria/telas/produtos/cadastro_produtos.php?acao=alterar&id=".$produto->id."'>Alterar</a> | <a href='http://localhost:81/padaria/telas/produtos/executa_acao_produto.php?acao=remover&id=". $produto->id. "'>Remover</a></td>";
          echo "</tr>";
      }
      echo "</tbody></table>";

  }

  function listarTodosProdutos() {
        return Produto::listar("");
    }
?>
