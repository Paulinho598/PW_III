<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Automóveis - Cadastro</title>
        <link rel="stylesheet" href="cadastro.css">
        <script src="jquery.maskMoney.js" type="text/javascript"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
        
    </head>
    <body>
        <div id="body">
            <form action="cadastro.php" method="get" id="corpo">
                <h1>Cadastro de Automóvel</h1>
                <div id="form">
                    <div class="input">
                        <label for="modelo">Modelo:</label>
                        <input type="text" name="modelo" id="modelo" placeholder="Fiat">
                    </div>
                    <div class="input">
                        <label for="ano">Ano:</label>
                        <input type="number" name="ano" id="ano" placeholder="2000">
                    </div>
                    <div class="input">
                        <label for="placa">Placa:</label>
                        <input type="text" name="placa" id="placa" placeholder="ABC12D3">
                    </div>
                    <div class="input">
                        <label for="valor">Valor:</label>
                        <input type="text" name="valor" id="valor" placeholder="$20,00" onfocus="formatarDinheiro(this)">
                    </div>
                    <div class="input">
                        <label for="cor">Cor:</label>
                        <input type="text" name="cor" id="cor" placeholder="azul goiaba">
                    </div>
                    <div id="btn">
                        <input type="submit" value="gravar" name="gravar" id="gravar" class="botão">
                        <a class="botão" name="limpar" id="limpar" onclick="limpar()">limpar</a>
                        <a href="início.html" class="botão">voltar</a>
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
        document.getElementById('valor').value = ""
        document.getElementById('cor').value = ""
    }

    $(document).ready(function(){
            $('#valor').maskMoney({
                prefix: 'R$',
                thousands: '.',
                decimal: ',',
                allowZero: true,
                allowNegative: false
            })

            window.formatarDinheiro = function(input){
                $(input).maskMoney('mask')
            }
        }
    )
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
        $cor = $conn->real_escape_string($_GET['cor']);


        $valor = $conn->real_escape_string($_GET['valor']);
        $valorFinal = str_replace(['R$','.',','], ['','','.'], $_GET['valor']);

        date_default_timezone_set('America/Sao_Paulo');
        $data = date("Y-m-d H:i:s");

        $sql = "insert into carros(modelo,ano,placa,valor,cor,cadastro) values('$modelo','$ano','$placa', '$valorFinal', '$cor','$data');";
        $resultado = "select placa from carros;";

        if ($conn->query($sql) && $resultado->num_rows == 0){
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