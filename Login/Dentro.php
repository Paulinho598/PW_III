<?php
session_start();

/*$nome = $_SESSION['nome'];
$senha = $_SESSION['senha']*/
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
            #btns{
                display: flex;
                flex-direction: row;
            }
        </style>
    </head>
    <body>
        <div id="corpo">
            <!--<h1>Olá <?php echo htmlspecialchars($nome); ?></h1>
            <h1>Sua senha: <?php echo htmlspecialchars($senha)?></h1>-->
            <h1><?php echo htmlspecialchars("BEM-VINDO AO SITE!")?></h1>
            <div id="btns">
                <button id="butãum"><a href="#">Cliente</a></button>
                <button id="butãum"><a href="#">Produto</a></button>
                <button id="butãum"><a href="index.html" id="forgot">Sair</a></button>
            </div>
        </div>
    </body>
</html>