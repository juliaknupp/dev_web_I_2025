<?php
    require_once("../../model/cliente.class.php");
    function cadastrarCliente($nome, $telefone) {
        $cliente = new Cliente(null, $nome, $telefone);
        $cliente->cadastrar();
    }

    function pegaClientePeloId($id) {
        return Cliente::pegaPorId($id);
    }

    function alterarCliente($id, $novoNome, $novoTelefone) {
        $cliente = Cliente::pegaPorId($id);
        if ($cliente) {
            $cliente->nome = $novoNome;
            $cliente->telefone = $novoTelefone;
            $cliente->alterar();
        }
    }

    function removerCliente($id) {
        $cliente = Cliente::pegaPorId($id);
        if ($cliente) {
            $cliente->remover();
        }
    }

    function listarCliente($filtroNome) {
        $clientes = Cliente::listar($filtroNome);
        echo "<table><thead><tr><th>Nome</th><th>Telefone</th>";
        echo "<th>Ações</th>";//NOVA LINHA
        echo "</tr></thead><tbody>";
        foreach($clientes as $cliente) {
            echo "<tr><td>".$cliente->nome."</td>";
            echo "<td>".$cliente->telefone."</td>";
            echo "<td><a href='http://localhost:81/padaria/telas/cliente/cadastro_cliente.php?acao=alterar&id=".$cliente->id."'>Alterar</a> | <a href='http://localhost:81/padaria/telas/cliente/executa_acao_cliente.php?acao=remover&id=". $cliente->id. "'>Remover</a></td>";
            echo "</tr>";
        }
        echo "</tbody></table>";

    }

    function listarTodosClientes() {
        return Cliente::listar("");
    }

?>
