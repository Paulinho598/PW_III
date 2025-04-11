<?php
session_start();

$nome = $_SESSION['nome'];
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="./style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <style>
            body{
                color: black;
            }

            #corpo{
                display: flex;
                align-items: center;
                flex-direction: column;
                justify-content: center;
            }
        </style>
    </head>
    <body>
        <div id="corpo">
            <h1>Olá <?php echo htmlspecialchars($nome); ?></h1>
            <button id="butãum"><a href="index.html" id="forgot">Sair</a></button>
        </div>
    </body>
</html>