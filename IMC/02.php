<?php

$peso = $_GET['peso'];
$altura = $_GET['altura'];
$gênero = $_GET['gênero'];
$idade = $_GET['idade'];

$pesoInt = floatval($peso);
$alturaInt = floatval($altura);

$imc = ((($pesoInt)/($alturaInt**2))*10000);
$IMC = round($imc,3);

if($IMC<19.1){
    echo("Seu IMC é:".$IMC);
    echo("\nVocê está abaixo do peso.");
}else if($IMC>19.1 && $IMC<25.8){
    echo("Seu IMC é:".$IMC);
    echo("\nVocê tem um peso normal.");
}else if($IMC>25.9 && $IMC<27.3){
    echo("Seu IMC é:".$IMC);
    echo("\nVocê está pouco acima do peso.");
}else if($IMC>27.4 && $IMC<32.3){
    echo("Seu IMC é:".$IMC);
    echo("\nVocê está acima do peso.");
}else if($IMC>32.4){
    echo("Seu IMC é:".$IMC);
    echo("\nVocê está obeso.");
}

?>