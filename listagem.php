<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: index.php');
    exit();
}

$usuario = $_SESSION['usuario'];
$email_usuario = $usuario['email'];
$alunos = isset($_SESSION['alunos'][$email_usuario]) ? $_SESSION['alunos'][$email_usuario] : [];
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
    </style>
</head>
<body>
    <div class="user-info">
        <p>Usuário: <?php echo htmlspecialchars($usuario['nome']); ?></p>
        <p>E-mail: <?php echo htmlspecialchars($usuario['email']); ?></p>
        <p>Idade: <?php echo htmlspecialchars($usuario['idade']); ?> anos</p>
    </div>
    
    <h1>Listagem de Alunos</h1>
    
    <?php if (empty($alunos)): ?>
        <p>Nenhum aluno cadastrado ainda.</p>
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
                <?php foreach ($alunos as $aluno): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($aluno['nome']); ?></td>
                        <td><?php echo htmlspecialchars($aluno['objetivo']); ?></td>
                        <td><?php echo htmlspecialchars($aluno['plano']); ?></td>
                        <td>R$ <?php echo number_format($aluno['mensalidade'], 2, ',', '.'); ?></td>
                        <td>
                            <?php
                            $desconto = 0;
                            switch ($aluno['plano']) {
                                case 'Trimestral':
                                    $desconto = $aluno['mensalidade'] * 0.05;
                                    break;
                                case 'Semestral':
                                    $desconto = $aluno['mensalidade'] * 0.10;
                                    break;
                                case 'Anual':
                                    $desconto = $aluno['mensalidade'] * 0.20;
                                    break;
                            }
                            echo 'R$ ' . number_format($desconto, 2, ',', '.');
                            ?>
                        </td>
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

// array map 
<?php
$alunos_formatados = array_map(function($aluno) {
    // Cálculos e formatações aqui
    return [
        'nome' => htmlspecialchars($aluno['nome']),
        // outros campos formatados...
    ];
}, $alunos);
?>

//array filter 
<?php
$filtro_objetivo = $_GET['objetivo'] ?? null;

if ($filtro_objetivo) {
    $alunos = array_filter($alunos, function($aluno) use ($filtro_objetivo) {
        return $aluno['objetivo'] === $filtro_objetivo;
    });
}
?>
