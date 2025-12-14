<?php
require_once __DIR__ . "/classe_pai.php";
class Livro extends ClassePai {

    public $titulo;
    public $autor;
    public $editora;
    public $anoPublicacao;
    public $genero;
    public $localizacao;
    public $ISSN;

    public function toEntity($dados){
        return new Livro(
            $dados[0],
            $dados[1],
            $dados[2],
            $dados[3],
            $dados[4],
            $dados[5],
            $dados[6],
            $dados[7]
        );
    }

    public function cadastrar($conn){
        $SQL = "INSERT INTO livro (titulo, autor, editora, anoPublicacao, genero, localizacao, ISSN) VALUES (
            '$this->titulo',
            '$this->autor',
            '$this->editora',
            '$this->anoPublicacao',
            '$this->genero',
            '$this->localizacao',
            '$this->ISSN'
        )";
        $resultado = $conn->query($SQL);
        if($resultado){
            $this->id = $conn->insert_id;
        }
    }

    public function alterar($conn){
        $SQL = "UPDATE livro SET 
            titulo = '$this->titulo',
            autor = '$this->autor',
            editora = '$this->editora',
            anoPublicacao = '$this->anoPublicacao',
            genero = '$this->genero',
            localizacao = '$this->localizacao',
            ISSN = '$this->ISSN'
        WHERE idliv = $this->id";
        $conn->query($SQL);
    }
    static public function pegaPorId($id, $conn) {
        $SQL = "SELECT * FROM livro WHERE idliv = $id";
        $resultado = $conn->mysql_query($SQL);
        if($resultado){
            $dados = $conn->fetch_array($resultado);
            return new Livro(
                $dados['idliv'],
                $dados['titulo'],
                $dados['autor'],
                $dados['editora'],
                $dados['anoPublicacao'],
                $dados['genero'],
                $dados['localizacao'],
                $dados['ISSN']
            );
        }
        /*$arquivo = fopen("database/livros.txt"
        , "r");
        while(!feof($arquivo)){
            $linha = fgets($arquivo);
            if(empty($linha))
                continue;
            $dados = explode(self::SEPARADOR, $linha);
            if($dados[0] == $id){
                fclose($arquivo);
                return $this->toEntity($dados);
            }
        }
        fclose($arquivo);*/
    }

    public function __construct($id, $titulo, $autor, $editora, $anoPublicacao, $genero, $localizacao, $ISSN) {
        parent::__construct($id, "database/livros.txt");
        $this->titulo = $titulo;
        $this->autor = $autor;
        $this->editora = $editora;
        $this->anoPublicacao = $anoPublicacao;
        $this->genero = $genero;
        $this->localizacao = $localizacao;
        $this->ISSN = $ISSN;
    }

    static public function listar($filtroNome, $conn) {
        /*
            $arquivo = fopen("database/livros.txt", "r");
            $retorno = [];
            while(!feof($arquivo)){
                $linha = fgets($arquivo);
                if(empty($linha))
                    continue;
                $dados = explode(self::SEPARADOR, $linha);
                if(str_contains($dados[1], $filtroNome)){
                    array_push($retorno,$this->toEntity($dados));
                }
                
            }
            return $retorno;
            */
        $SQL = "SELECT * FROM livro WHERE titulo LIKE '%$filtroNome%'";
        $resultado = $conn->query($SQL);
        $retorno = [];
        while($dados = $resultado->fetch_array()){
            $livro = new Livro(
                $dados['idliv'],
                $dados['titulo'],
                $dados['autor'],
                $dados['editora'],
                $dados['anoPublicacao'],
                $dados['genero'],
                $dados['localizacao'],
                $dados['ISSN']
            );
            array_push($retorno, $livro);
        }
        return $retorno;
    }

    function montaLinhaDados()
    {
        return $this->id.self::SEPARADOR.
               $this->titulo.self::SEPARADOR.
               $this->autor.self::SEPARADOR.
               $this->editora.self::SEPARADOR.
               $this->anoPublicacao.self::SEPARADOR.
               $this->genero.self::SEPARADOR.
               $this->localizacao.self::SEPARADOR.
               $this->ISSN;
    }
}
?>
