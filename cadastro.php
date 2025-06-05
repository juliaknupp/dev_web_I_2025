<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $aluno = [
        'nome' => $_POST['nome'],
        'genero' => $_POST['genero'],
        'idade' => $_POST['idade'],
        'objetivo' => $_POST['objetivo'],
        'frequencia' => $_POST['frequencia'],
        'plano' => $_POST['plano'],
        'mensalidade' => $_POST['mensalidade']
    ];
    
    $email_usuario = $_SESSION['usuario']['email'];
    
    if (!isset($_SESSION['alunos'][$email_usuario])) {
        $_SESSION['alunos'][$email_usuario] = [];
    }
    
    $_SESSION['alunos'][$email_usuario][] = $aluno;
    
    header('Location: listagem.php');
    exit();
} else {
    header('Location: cadastro.php');
    exit();
}
