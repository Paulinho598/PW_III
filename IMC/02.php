<?php

$peso = $_GET['peso'];
$altura = $_GET['altura'];
$gênero = $_GET['gênero'];
$idade = $_GET['idade'];

$pesoInt = floatval($peso);
$alturaInt = floatval($altura);

$imc = ((($pesoInt)/($alturaInt**2))*10000);
$IMC = round($imc,3);

echo("Seu IMC é:".$IMC);


?>