<?php

echo("Digite o comprimento:");
$comprimento = trim(fgets(STDIN));

echo("Digite a largura:");
$largura = trim(fgets(STDIN));

echo("Digite a altura:");
$altura = trim(fgets(STDIN));

$formula = $comprimento*$largura*$altura;

echo($formula);

?>