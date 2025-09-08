<?php
    require_once("../../model/venda.class.php");

    function pegaVendaPeloId($id) {
        return Venda::pegaPorId($id);
    }

    function cadastrarVenda($cliente, $vendedor, $produtosVendidos, $quantidades, $valorTotal, $data, $pagamento, $desconto) {
        $venda = new Venda(null, $cliente, $vendedor, $produtosVendidos, $quantidades, $valorTotal, $data, $pagamento, $desconto);
        $venda->cadastrar();
    }

    function alterarVenda($id, $novoCliente, $novoVendedor, $novosProdutosVendidos, $novasQuantidades, $novoValorTotal, $novaData, $novoPagamento, $novoDesconto) {
        $venda = Venda::pegaPorId($id);
        if ($venda) {
            $venda->cliente = $novoCliente;
            $venda->vendedor = $novoVendedor;
            $venda->produtosVendidos = $novosProdutosVendidos;
            $venda->quantidades = $novasQuantidades;
            $venda->valorTotal = $novoValorTotal;
            $venda->data = $novaData;
            $venda->modoPagamento = $novoPagamento;
            $venda->desconto = $novoDesconto;
            $venda->alterar();
        }
    }

    function removerVenda($id) {
        $venda = Venda::pegaPorId($id);
        if ($venda) {
            $venda->remover();
        }
    }

    function listarVendas($filtroNome) {
        $vendas = Venda::listar($filtroNome);
        echo "<table><thead><tr><th>Cliente</th><th>Vendedor</th><th>Produtos (qtd)</th><th>Valor Total</th><th>Data</th><th>Modo de pagamento</th><th>Desconto</th>";
        echo "<th>Ações</th>";//NOVA LINHA
        echo "</tr></thead><tbody>";
        foreach($vendas as $venda) {
            $func = Funcionario::pegaPorId($venda->vendedor);
            $cliente = Cliente::pegaPorId($venda->cliente);
            echo "<tr><td>".$cliente->nome."</td>";
            echo "<td>".$func->nome."</td>";
            $produtosNomes = [];
            for ($i = 0; $i < count($venda->produtosVendidos); $i++) {
                $produto = $venda->produtosVendidos[$i];
                $qtd = isset($venda->quantidades[$i]) ? $venda->quantidades[$i] : 1;
                if ($produto && property_exists($produto, 'nome')) {
                    $produtosNomes[] = $produto->nome . " (" . $qtd . ")";
                }
            }
            echo "<td>".implode(', ', $produtosNomes)."</td>";
            echo "<td>R$".$venda->valorTotal."</td>";
            echo "<td>".$venda->data."</td>";
            echo "<td>".$venda->modoPagamento."</td>";
            echo "<td>".$venda->desconto."</td>";
            echo "<td><a href='http://localhost:81/padaria/telas/venda/cadastro_venda.php?acao=alterar&id=".$venda->id."'>Alterar</a> | <a href='http://localhost:81/padaria/telas/venda/executa_acao_venda.php?acao=remover&id=". $venda->id. "'>Remover</a></td>";
            echo "</tr>";
        }
        echo "</tbody></table>";
    }

function calcularTotal($arrayProdutos, $arrayQtd, $desconto) {
    $total = 0;
    if(is_array($arrayProdutos) && is_array($arrayQtd)) {
        for ($i = 0; $i < count($arrayProdutos); $i++) {
            $produto = Produto::pegaPorId($arrayProdutos[$i]);
            $qtd = isset($arrayQtd[$i]) ? $arrayQtd[$i] : 1;
            if ($produto) {
                $total += $produto->preco * $qtd;
            }
        }
    }
    if ($desconto > 0 && $desconto < 100) {
        $total = $total * ((100 - $desconto) / 100);
    }
    return $total;
}
?>
