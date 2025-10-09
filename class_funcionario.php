<?php
// Classe abstrata Funcionário
abstract class Funcionario {
    protected $nome;
    protected $salario;

    public function __construct($nome, $salario) {
        $this->nome = $nome;
        $this->salario = $salario;
    }

    // Método abstrato (obrigatório nas classes filhas)
    abstract public function calcularBonus();

    public function getNome() {
        return $this->nome;
    }
}

// Classe Gerente (herda de Funcionário)
class Gerente extends Funcionario {
    public function calcularBonus() {
        return $this->salario * 0.20; // 20% de bônus
    }
}

// Classe Desenvolvedor (herda de Funcionário)
class Desenvolvedor extends Funcionario {
    public function calcularBonus() {
        return $this->salario * 0.10; // 10% de bônus
    }
}

// Criando o array de funcionários
$funcionarios = [
    new Gerente("Marcos Silva", 10000),
    new Desenvolvedor("Ana Paula", 7000),
    new Desenvolvedor("Carlos Souza", 8500),
    new Gerente("Fernanda Lima", 12000),
    new Desenvolvedor("Juliana Torres", 9000)
];

// Exibindo nome e bônus de cada funcionário
foreach ($funcionarios as $funcionario) {
    echo "Funcionário: " . $funcionario->getNome() . " | Bônus: R$ " . number_format($funcionario->calcularBonus(), 2, ',', '.') . "<br>";
}
?>
