<?php

echo("Digite um valor:");
$valor = trim(fgets(STDIN));

$desconto = ($valor)-($valor*(27/100));

echo("O valor digitado com um desconto de 27% fica: ${desconto}");

?>