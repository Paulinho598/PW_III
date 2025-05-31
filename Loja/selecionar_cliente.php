<?php
session_start();
include_once("./conexão.php");

try {
    $consulta = $pdo->query("SELECT id, nome, email FROM cliente ORDER BY nome");
    $clientes = $consulta->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erro ao consultar clientes: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Selecionar Cliente</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            background-color:lightpink;
            font-family: Arial, sans-serif;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .lista-clientes {
            max-width: 600px;
            margin: 20px auto;
        }
        .cliente-item {
            background-color: lightblue;
            padding: 15px;
            margin: 10px;
            border-radius: 30px;
            border: 2px solid black;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .btn-visualizar {
            color: white;
            padding: 8px 15px;
            font-size: 16px;
            border-radius: 50px;
            background-color: pink;
            border: 2px solid black;
            text-decoration: none;
        }
        .btn-visualizar:hover {
            cursor: pointer;
            color: rgb(255,105,180);
            background-color: white;
        }
        .btn-voltar {
            display: block;
            width: fit-content;
            margin: 20px auto;
            color: white;
            padding: 10px;
            font-size: 18px;
            border-radius: 50px;
            background-color: pink;
            border: 2px solid black;
            text-align: center;
            text-decoration: none;
        }
        .btn-voltar:hover {
            cursor: pointer;
            color: rgb(255,105,180);
            background-color: white;
        }
        .sem-clientes {
            text-align: center;
            padding: 20px;
            font-size: 18px;
        }
    </style>
</head>
<body>
    <h1>Selecione um Cliente</h1>
    
    <div class="lista-clientes">
        <?php if (count($clientes) > 0): ?>
            <?php foreach ($clientes as $cliente): ?>
                <div class="cliente-item">
                    <span><?= htmlspecialchars($cliente['nome']) ?></span>
                    <a href="ler.php?id=<?= $cliente['id'] ?>" class="btn-visualizar">Visualizar</a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="sem-clientes">Nenhum cliente cadastrado ainda!</div>
        <?php endif; ?>
    </div>
    
    <a href="index.html" class="btn-voltar">Voltar</a>
</body>
</html>