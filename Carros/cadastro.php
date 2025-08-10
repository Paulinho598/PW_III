<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Automóveis - Cadastro</title>
        <link rel="stylesheet" href="cadastro.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div id="body">
            <form action="cadastro.php" method="get" id="corpo">
                <h1>Cadastro de Automóvel</h1>
                <div id="form">
                    <div class="input">
                        <label for="modelo">Modelo:</label>
                        <input type="text" name="modelo" id="modelo">
                    </div>
                    <div class="input">
                        <label for="ano">Ano:</label>
                        <input type="text" name="ano" id="ano">
                    </div>
                    <div class="input">
                        <label for="placa">Placa:</label>
                        <input type="text" name="placa" id="placa">
                    </div>
                    <div id="btn">
                        <input type="submit" value="gravar" name="gravar" id="gravar" class="botão">
                        <button type="button" class="botão" name="limpar" id="limpar" class="botão" onclick="limpar()">limpar</button>
                        <a href="início.html" class="botão">voltar</a>
                        <!--
                        -->
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>

<script>
    function limpar(){
        document.getElementById('modelo').value = ""
        document.getElementById('ano').value = ""
        document.getElementById('placa').value = ""
    }
</script>

<?php
if(isset($_GET['gravar'])){
    $user = "root";
    $password = "";
    $server = "localhost";
    $database = "veículos";

    try{
        $conn = new mysqli($server,$user,$password,$database);

        if($conn->connect_error){
            die("Conexão falhou:".$conn->connect_error);
        }

        $modelo = $conn->real_escape_string($_GET['modelo']);
        $ano = $conn->real_escape_string($_GET['ano']);
        $placa = $conn->real_escape_string($_GET['placa']);

        date_default_timezone_set('America/Sao_Paulo');
        $data = date("Y-m-d H:i:s");

        $sql = "insert into carros(modelo,ano,placa,cadastro) values('$modelo','$ano','$placa','$data');";

        if ($conn->query($sql)) {
            echo "<script>alert('Cadastrado!')</script>";
            echo "<script>window.location.href = 'início.html'</script>";
        }else{
            echo "<script>alert('ERRO! ".addcslashes($e->getMessage())."')</script>";
        }

        $conn->close();

    } catch (Exception $e){
        echo "<script>alert('ERRO! " . addslashes($e->getMessage()) . "')</script>";
    }
}
?>