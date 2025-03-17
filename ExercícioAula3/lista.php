<?php
require 'file.php';

$animais = $animalManager->listarAnimais();
?>

<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <title>Lista de Animais</title>
        <link rel="stylesheet" href="lista.css">
    </head>
    <body>
        <div class="corpo">
            <h1>Animais Cadastrados</h1>

            <table class="tabela" border="1">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Espécie</th>
                    <th>Data de Nascimento</th>
                    <th>Ações</th>
                </tr>
                <?php foreach ($animais as $animal): ?>
                    <tr>
                        <td><?php echo $animal['id']; ?></td>
                        <td><?php echo htmlspecialchars($animal['nome']); ?></td>
                        <td><?php echo htmlspecialchars($animal['espécie']); ?></td>
                        <td><?php echo $animal['dataNascimento'] ?? 'N/A'; ?></td>
                        <td>
                            <a href="file.php?remover=<?php echo $animal['id']; ?>">Remover</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>

            <a href="index.php">Voltar ao formulário</a>
        </div>
    </body>
</html>