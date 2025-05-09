<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
// Função para gerar o tabuleiro
function gerarTabuleiro() {
    $tabuleiro = [];
    
    // Preencher o tabuleiro com as peças
    for ($linha = 0; $linha < 8; $linha++) {
        for ($coluna = 0; $coluna < 8; $coluna++) {
            if (($linha + $coluna) % 2 == 0) {
                $tabuleiro[$linha][$coluna] = null; // Casa clara, sem peça
            } else {
                if ($linha < 3) {
                    $tabuleiro[$linha][$coluna] = 'P'; // Peça do jogador 1
                } elseif ($linha > 4) {
                    $tabuleiro[$linha][$coluna] = 'p'; // Peça do jogador 2
                } else {
                    $tabuleiro[$linha][$coluna] = null; // Casas do meio sem peças
                }
            }
        }
    }
    return $tabuleiro;
}

// Função para exibir o tabuleiro em uma tabela HTML
function exibirTabuleiro($tabuleiro) {
    echo "<table border='1' style='border-collapse: collapse; width: 320px; height: 320px;'>";

    for ($linha = 0; $linha < 8; $linha++) {
        echo "<tr>";
        for ($coluna = 0; $coluna < 8; $coluna++) {
            $cor = (($linha + $coluna) % 2 == 0) ? 'white' : 'black';
            $classe = 'empty'; // Padrão

            // Verifica se existe uma peça
            if ($tabuleiro[$linha][$coluna] != null) {
                $classe = $tabuleiro[$linha][$coluna] == 'P' ? 'player1' : 'player2';
            }

            // Definir as classes de cor da peça
            echo "<td class='$classe' style='width: 40px; height: 40px; background-color: $cor; text-align: center; vertical-align: middle;'>";
            echo $tabuleiro[$linha][$coluna] ? $tabuleiro[$linha][$coluna] : '';
            echo "</td>";
        }
        echo "</tr>";
    }

    echo "</table>";
}

// Gerar o tabuleiro
$tabuleiro = gerarTabuleiro();

// Exibir o tabuleiro
exibirTabuleiro($tabuleiro);
?>
</body>
</html>
