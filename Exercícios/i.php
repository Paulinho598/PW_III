<?php

echo("Digite um valor:");
$valor = trim(fgets(STDIN));

$parcela = (($valor)+($valor*(16/100)))/10;

echo("O valor da parcela é: ${parcela}");

?>