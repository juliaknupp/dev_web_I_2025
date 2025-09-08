<?php
    include_once("class_pai.class.php");
    include_once("cliente.class.php");
    include_once("funcionario.class.php");
    include_once("produto.class.php");
    class Venda extends ClassePai {
        public $cliente;
        public $vendedor;//tipo Funcionario
        public $produtosVendidos;
        public $quantidades;
        public $valorTotal;
        public $data;
        public $modoPagamento;
        public $desconto;

        function montaLinhaDados()
        {
            $idsProdutos = [];
            foreach($this->produtosVendidos as $produto) {
                if (is_object($produto) && property_exists($produto, 'id')) {
                    $idsProdutos[] = $produto->id;
                }
    
                else if (is_numeric($produto)) {
                    $idsProdutos[] = $produto;
                }
            }

            $linha =
                $this->id
                .self::SEPARADOR
                .$this->cliente
                .self::SEPARADOR
                .$this->vendedor
                .self::SEPARADOR
                .$this->valorTotal
                .self::SEPARADOR
                .$this->data
                .self::SEPARADOR
                .$this->modoPagamento
                .self::SEPARADOR
                .$this->desconto;

                foreach($idsProdutos as $idProd) {
                    $linha .= self::SEPARADOR . $idProd;
                }

                foreach($this->quantidades as $qtd) {
                    $linha .= self::SEPARADOR . $qtd;
                }

            return $linha;
        }

        public function __construct($id, $cliente, $vendedor, $produtosVendidos, $quantidades, $valorTotal, $data, $modoPagamento, $desconto) {
            parent::__construct($id, "../../db/venda.txt");
            $this->cliente = $cliente;
            $this->vendedor = $vendedor;
            $this->produtosVendidos = $produtosVendidos;
            $this->quantidades = $quantidades;
            $this->valorTotal = $valorTotal;
            $this->data = $data;
            $this->modoPagamento = $modoPagamento;
            $this->desconto = $desconto;
        }

        static public function pegaPorId($id) {
            $arquivo = fopen("../../db/venda.txt", "r");
            while(!feof($arquivo)){
                $linha = fgets($arquivo);
                if(empty($linha))
                    continue;
                $dados = explode(self::SEPARADOR, $linha);
                if($dados[0] == $id){
                    fclose($arquivo);
                    $numCamposFixos = 7;
                    $totalCampos = count($dados);
                    $numProdutos = ($totalCampos - $numCamposFixos) / 2;
                    $idsProdutos = array_slice($dados, $numCamposFixos, $numProdutos);
                    $quantidades = array_slice($dados, $numCamposFixos + $numProdutos, $numProdutos);
                    return new Venda($dados[0], Cliente::pegaPorId($dados[1]), Funcionario::pegaPorId($dados[2]), Produto::pegaPorIds($idsProdutos), $quantidades, $dados[3], $dados[4], $dados[5], $dados[6]);
                }
            }
            fclose($arquivo);
        }

        static public function listar($filtroNome) {
            $arquivo = fopen("../../db/venda.txt", "r");
            $retorno = [];
            while(!feof($arquivo)){
                $linha = fgets($arquivo);
                if(empty($linha))
                    continue;
                $dados = explode(self::SEPARADOR, $linha);
                if(str_contains($dados[1], $filtroNome)){
                    $numCamposFixos = 7;
                    $totalCampos = count($dados);
                    $numProdutos = ($totalCampos - $numCamposFixos) / 2;
                    $idsProdutos = array_slice($dados, $numCamposFixos, $numProdutos);
                    $quantidades = array_slice($dados, $numCamposFixos + $numProdutos, $numProdutos);
                    $produtos = Produto::pegaPorIds($idsProdutos);
                    array_push($retorno, new Venda($dados[0], $dados[1], $dados[2], $produtos, $quantidades, $dados[3], $dados[4], $dados[5], $dados[6]));
                }
                
            }
            return $retorno;
        }

        static function pegaPorIds($ids) {
            $retorno = [];
            foreach($ids as $id) {
                array_push($retorno, Produto::pegaPorId($id));
            }
            return $retorno;
        }
    }
?>
