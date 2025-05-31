<?php
$user = "root";
$password = "";

try{
    $pdo = new pdo('mysql:host=localhost; dbname=Loja', $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //echo("Conexão feita com sucesso :3");
}catch (PDOExecption $e){
    echo "ERRO! " . $e->getMessage();
}
?>