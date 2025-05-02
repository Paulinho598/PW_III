<?php
session_start();

$nome = $_SESSION['nome'];
$email = $_SESSION['email'];
$genero = $_SESSION['genero'];
$senha = $_SESSION['senha'];
?>


<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Perfil do Usuário</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <style>
            h2{
                color: rgb(160,0,153);
                padding: 30px;
                text-align: center;
                border: 2px solid black;
                background-color: lightpink;
            }

            #corpo{
                display: flex;
                align-items: center;
                justify-content:center;
            }
        </style>
    </head>
    <body>
        <h1>Perfil do Usuário</h1>
        <div id="corpo">
            <h2 id="info">
                <?php 
                echo(
                    "Nome:${nome}<br/>
                    Email:${email} <br/>
                    Gênero:${genero} <br/>
                    Senha:${senha}."
                    )
                ?>
            </h2>
        </div>
        <div id="btns">
            <button id="butãum"><a href="Dentro.php" id="forgot">Voltar</a></button>
        </div>
    </body>
</html>