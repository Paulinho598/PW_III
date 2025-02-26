<?php

echo("Digite o total de quilometros rodados:");
$kmRodados = trim(fgets(STDIN));

echo("Digite o total de quilometros rodados:");
$combustivelUsado = trim(fgets(STDIN));

$consumoMedio = $kmRodados/$combustivelUsado;

echo("O consumo medio de combustivel pra fazer o percurso fora de:${consumoMedio}");

?>