<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: index.php');
    exit();
}

$usuario = $_SESSION['usuario'];
$email_usuario = $usuario['email'];
$alunos = isset($_SESSION['alunos'][$email_usuario]) ? $_SESSION['alunos'][$email_usuario] : [];

// Filtro por objetivo (opcional)
$filtro_objetivo = $_GET['objetivo'] ?? null;

// Aplicando array_filter se houver filtro
if ($filtro_objetivo) {
    $alunos = array_filter($alunos, function($aluno) use ($filtro_objetivo) {
        return $aluno['objetivo'] === $filtro_objetivo;
    });
}

// Usando array_map para formatar os dados dos alunos
$alunos_formatados = array_map(function($aluno) {
    // Calcula desconto
    $desconto = 0;
    switch ($aluno['plano']) {
        case 'Trimestral': $desconto = $aluno['mensalidade'] * 0.05; break;
        case 'Semestral': $desconto = $aluno['mensalidade'] * 0.10; break;
        case 'Anual': $desconto = $aluno['mensalidade'] * 0.20; break;
    }
    
    // Formata valores monetários
    $mensalidade_formatada = 'R$ ' . number_format($aluno['mensalidade'], 2, ',', '.');
    $desconto_formatado = 'R$ ' . number_format($desconto, 2, ',', '.');
    
    return [
        'nome' => htmlspecialchars($aluno['nome']),
        'objetivo' => htmlspecialchars($aluno['objetivo']),
        'plano' => htmlspecialchars($aluno['plano']),
        'mensalidade' => $mensalidade_formatada,
        'desconto' => $desconto_formatado
    ];
}, $alunos);

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Listagem de Alunos - Academia</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 800px; margin: 0 auto; padding: 20px; }
        .user-info { background-color: #f0f0f0; padding: 10px; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .menu { margin-top: 20px; }
        .filtros { margin-bottom: 20px; padding: 10px; background-color: #f8f8f8; }
    </style>
</head>
<body>
    <div class="user-info">
        <p>Usuário: <?php echo htmlspecialchars($usuario['nome']); ?></p>
        <p>E-mail: <?php echo htmlspecialchars($usuario['email']); ?></p>
        <p>Idade: <?php echo htmlspecialchars($usuario['idade']); ?> anos</p>
    </div>
    
    <h1>Listagem de Alunos</h1>
    
    <div class="filtros">
        <h3>Filtrar por Objetivo:</h3>
        <a href="listagem.php">Todos</a> |
        <a href="listagem.php?objetivo=Emagrecimento">Emagrecimento</a> |
        <a href="listagem.php?objetivo=Hipertrofia">Hipertrofia</a> |
        <a href="listagem.php?objetivo=Condicionamento">Condicionamento</a> |
        <a href="listagem.php?objetivo=Reabilitação">Reabilitação</a> |
        <a href="listagem.php?objetivo=Outros">Outros</a>
    </div>
    
    <?php if (empty($alunos_formatados)): ?>
        <p>Nenhum aluno encontrado.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Objetivo</th>
                    <th>Plano</th>
                    <th>Mensalidade</th>
                    <th>Desconto</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($alunos_formatados as $aluno): ?>
                    <tr>
                        <td><?php echo $aluno['nome']; ?></td>
                        <td><?php echo $aluno['objetivo']; ?></td>
                        <td><?php echo $aluno['plano']; ?></td>
                        <td><?php echo $aluno['mensalidade']; ?></td>
                        <td><?php echo $aluno['desconto']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
    
    <div class="menu">
        <a href="cadastro.php">Cadastrar Novo Aluno</a> | 
        <a href="logout.php">Sair</a>
    </div>
</body>
</html>
