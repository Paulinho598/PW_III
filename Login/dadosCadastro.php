<?php

$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$gênero = $_POST['gênero'];

$user = "root";
$password = "";
$bank = "Login";
$server = "localhost";

$conn = new mysqli($server, $user, $password, $bank);
if($conn->connect_error){
    die($conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="stylePHP.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <h1>Cadastrado com Sucesso</h1>
    </body>
</html>