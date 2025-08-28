<?php
    include("../model/cliente.class.php");
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
            echo "<td><a href='cadastro_cliente.php?id=".$cliente->id."'>Alterar</a></td>";
            echo "</tr>";
        }
        echo "</tbody></table>";

    }

?>
cliente.service
<?php
    include("class_pai.class.php");
    class Cliente extends ClassePai {
        public $nome;
        public $telefone;

        public function __construct($id, $nome, $telefone) {
            parent::__construct($id, "../db/cliente.txt");
            $this->nome = $nome;
            $this->telefone = $telefone;
        }

        function montaLinhaDados()
        {
            return $this->id.self::SEPARADOR.$this->nome.self::SEPARADOR.$this->telefone;
        }

        static public function listar($filtroNome) {
            $arquivo = fopen("../db/cliente.txt", "r");
            $retorno = [];
            while(!feof($arquivo)){
                $linha = fgets($arquivo);
                if(empty($linha))
                    continue;
                $dados = explode(self::SEPARADOR, $linha);
                if(str_contains($dados[1], $filtroNome)){
                    array_push($retorno, new Cliente($dados[0], $dados[1], $dados[2]));
                }
                
            }
            return $retorno;
        }
        
        static public function pegaPorId($id) {
            $arquivo = fopen("../db/cliente.txt", "r");
            while(!feof($arquivo)) {
                $linha = fgets($arquivo);
                if(empty($linha))
                    continue;
                $dados = explode(self::SEPARADOR, $linha);
                if($dados[0] == $id) {
                    return new Cliente($dados[0], $dados[1], $dados[2]);
                }
            }
        }
    }
    
?>
