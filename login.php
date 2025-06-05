<?php
session_start();

// Array de usuários pré-definidos
$usuarios = [
    [
        'email' => 'admin@academia.com',
        'nome' => 'Administrador',
        'senha' => 'admin123',
        'data_nascimento' => '1980-01-01'
    ],
    [
        'email' => 'instrutor@academia.com',
        'nome' => 'Instrutor',
        'senha' => 'instrutor123',
        'data_nascimento' => '1990-05-15'
    ],
    [
        'email' => 'recepcao@academia.com',
        'nome' => 'Recepcionista',
        'senha' => 'recepcao123',
        'data_nascimento' => '1995-10-20'
    ]
];

$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';
$data_nascimento = $_POST['data_nascimento'] ?? '';

$usuario_encontrado = null;

foreach ($usuarios as $usuario) {
    if ($usuario['email'] === $email && 
        $usuario['senha'] === $senha && 
        $usuario['data_nascimento'] === $data_nascimento) {
        $usuario_encontrado = $usuario;
        break;
    }
}

if ($usuario_encontrado) {
    // Calcula a idade
    $data_nasc = new DateTime($usuario_encontrado['data_nascimento']);
    $hoje = new DateTime();
    $idade = $hoje->diff($data_nasc)->y;
    
    // Armazena na sessão
    $_SESSION['usuario'] = [
        'nome' => $usuario_encontrado['nome'],
        'email' => $usuario_encontrado['email'],
        'idade' => $idade
    ];
    
    // Inicializa array de alunos se não existir
    if (!isset($_SESSION['alunos'])) {
        $_SESSION['alunos'] = [];
    }
    
    // Redireciona para listagem
    header('Location: listagem.php');
    exit();
} else {
    header('Location: index.php?erro=Credenciais inválidas');
    exit();
}
