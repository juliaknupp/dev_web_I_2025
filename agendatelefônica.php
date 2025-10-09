<?php
class AgendaTelefonica {
    private $contatos = [];

    public function adicionarContato($nome, $telefone) {
        $this->contatos[$nome] = $telefone;
        echo "Contato '$nome' adicionado com sucesso!<br>";
    }

    public function removerContato($nome) {
        if (isset($this->contatos[$nome])) {
            unset($this->contatos[$nome]);
            echo "Contato '$nome' removido com sucesso!<br>";
        } else {
            echo "Contato '$nome' não encontrado.<br>";
        }
    }
    public function buscarContato($nome) {
        if (isset($this->contatos[$nome])) {
            echo "Telefone de $nome: " . $this->contatos[$nome] . "<br>";
        } else {
            echo "Contato '$nome' não encontrado.<br>";
        }
    }

    public function listarContatos() {
        ksort($this->contatos);
        echo "<h3>Lista de Contatos:</h3>";
        foreach ($this->contatos as $nome => $telefone) {
            echo "$nome - $telefone<br>";
        }
    }
}

$agenda = new AgendaTelefonica();

$agenda->adicionarContato("Ana", "9999-1111");
$agenda->adicionarContato("Carlos", "9888-2222");
$agenda->adicionarContato("Bruna", "9777-3333");

$agenda->listarContatos();
echo "<br>";

$agenda->buscarContato("Carlos");
echo "<br>";

$agenda->removerContato("Ana");
echo "<br>";

$agenda->listarContatos();
?>
