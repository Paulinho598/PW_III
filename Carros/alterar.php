<!DOCTYPE html>
<html lang="pt-br">
    <head>
        
        <meta charset="UTF-8">
        <title>Automóveis - Alterar Valor</title>
        <link rel="stylesheet" href="alterar.css">
        <script src="jquery.maskMoney.js" type="text/javascript"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
        
    </head>
    <body>
        <div id="body">
            <form action="cadastro.php" method="get" id="corpo">
                <h1>Alterar o Valor do Automóvel</h1>
                <div id="form">
                    <div class="input">
                        <label for="placa">Placa:</label>
                        <input type="text" name="placa" id="placa" placeholder="ABC12D3" minlength="7" maxlength="7" required>
                    </div>
                    <div class="input">
                        <label for="valor">Valor:</label>
                        <input type="text" name="valor" id="valor" placeholder="$20,00" onfocus="formatarDinheiro(this)" required>
                    </div>
                    <div id="btn">
                        <input type="submit" value="alterar" name="alterar" id="alterar" class="botão">
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
        document.getElementById('placa').value = ""
        document.getElementById('valor').value = ""
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
if(isset($_GET['alterar'])){
    $user = "root";
    $password = "";
    $server = "localhost";
    $database = "veículos";

    try{
        $conn = new mysqli($server,$user,$password,$database);

        if($conn->connect_error){
            die("Conexão falhou:".$conn->connect_error);
        }
        $placa = $conn->real_escape_string($_GET['placa']);

        $valor = $conn->real_escape_string($_GET['valor']);
        $valorFinal = str_replace(['R$','.',','], ['','','.'], $_GET['valor']);

        date_default_timezone_set('America/Sao_Paulo');
        $dataAlteracao = date("Y-m-d H:i:s");

        $resultado = $conn->query("select placa from carros where placa = '$placa'");

        if ($resultado && $resultado->num_rows == 1){
            $sql = "update carros set valor = '$valorFinal', alteracaoValor = '$dataAlteracao' where placa = '$placa'";

            if ($conn->query($sql) === TRUE){
                echo "<script>alert('Valor Alterado com Sucesso!')</script>";
                echo "<script>window.location.href = 'início.html'</script>";
            } else{
                echo "<script>alert('ERRO! " . addslashes($conn->error) . "')</script>";
            }
        }else{
            echo "<script>alert('Placa não encontrada!')</script>";
        }

        $conn->close();

    } catch (Exception $e){
        echo "<script>alert('ERRO! " . addslashes($e->getMessage()) . "')</script>";
    }
}
?>