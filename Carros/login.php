<!DOCTYPE html>
<html lang="pt-br">
    <head>
        
        <meta charset="UTF-8">
        <title>Automóveis - Login</title>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="login.css">
        <script src="jquery.maskMoney.js" type="text/javascript"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
        
    </head>
    <body class="batata">
        <div id="body">
            <form action="cadastro.php" method="get" id="corpo">
                <h1>Login</h1>
                <div id="features">
                    <div id="dataContainer">
                        <label id="Data" name="Data">Data:<span id="ValorData"></span></label>
                    </div>
                    <div id="corContainer">
                        <span id="corLbl">Modifique a cor da página:</span>
                        <input type="color" id="corFundo" name="corFundo" oninput="Background(this)"/>
                    </div>
                </div>
                <div id="form">
                    <div class="input">
                        <label for="modelo">Nome:</label>
                        <input type="text" name="nome" id="nome" placeholder="Zé Ruela da Silva" maxlength="50" required>
                    </div>
                    <div class="input">
                        <label for="ano">E-mail:</label>
                        <input type="email" name="email" id="email" placeholder="zeruela@gmail.com" minlength="17" required>
                    </div>
                    <div class="input">
                        <label for="placa">Senha:</label>
                        <input type="password" name="senha" id="senha" placeholder="12345678" minlength="8" maxlength="8" required>
                    </div>
                    <div id="btn">
                        <input type="submit" value="gravar" name="gravar" id="gravar" class="botão">
                        <a class="botão" name="limpar" id="limpar" onclick="limpar()">limpar</a>
                        <a href="funcionalidades.html" class="botão">voltar</a>
                    </div>
                    <a href="#" class="botão">Esqueci Minha Senha</a>
                </div>
            </form>
        </div>
    </body>
</html>

<script>
    function getDate(span){
        const hoje = new Date()
        const detalhes = {year: 'numeric', month: '2-digit', day: '2-digit' }
        return hoje.toLocaleDateString('pt-BR', detalhes)
    }

    document.getElementById("ValorData").textContent = getDate()

    function Background(input){
        const cor = input.value
        const page = document.getElementsByClassName('batata')

        if (page.length > 0){
            page[0].style.backgroundColor = cor
        }
    }

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

        $seguro = isset($_GET['Seguro']) ? $conn->real_escape_string($_GET['Seguro']) : 'Não';
        $bloqueio = isset($_GET['Bloqueio']) ? $conn->real_escape_string($_GET['Bloqueio']) : 'Desbloqueado';

        $sql = "insert into carros(modelo,ano,placa,valor,cor,cadastro, seguro, bloqueio) values('$modelo','$ano','$placa', '$valorFinal', '$cor','$data', '$seguro', '$bloqueio');";
        $resultado = "select placa from carros;";

        if ($conn->query($sql) && $resultado->num_rows == 0){
            echo "<script>alert('Cadastrado!')</script>";
            echo "<script>window.location.href = 'funcionalidades.html'</script>";
        }else{
            echo "<script>alert('ERRO! ".addcslashes($e->getMessage())."')</script>";
        }

        $conn->close();

    } catch (Exception $e){
        echo "<script>alert('ERRO! " . addslashes($e->getMessage()) . "')</script>";
    }
}
?>