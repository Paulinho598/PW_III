<?php

include_once("./conexão.php");

$nome = $_POST['nome'];
$endereco = $_POST['endereco'];
$bairro = $_POST['bairro'];
$cidade = $_POST['cidade'];
$uf = $_POST['uf'];
$email = $_POST['email'];
$cep = $_POST['cep'];
$celular = $_POST['celular'];

$verificar = $pdo->prepare("SELECT nome FROM cliente WHERE nome = :nome");
$verificar->bindValue(":nome", $nome);
$verificar->execute();
$count = $verificar->rowCount();

if($count == 0){
    $pdo->query("INSERT INTO cliente (nome, Endereco, bairro, cidade, uf, CEP, celular, email, cadastro, alteracao, dataCadastro, dataAlteracao) VALUES ('$nome','$endereco','$bairro','$cidade', '$uf', '$cep','$celular', '$email', curdate(), curdate(), user(), user())");

    echo"<br>Cadastro realizado com sucesso!";
    echo ("<br>INSERT INTO cliente (nome, endereco, bairro, cidade, uf, email, usuario_cad, usuario_alt, usuario_cad, usuario_alt) VALUES ('$nome','$endereco','$bairro','$cidade','$uf' '$email', curdate(), curdate(), user(), user())"); 
}
else{
    echo"Cliente ja cadastrado";
}

?>