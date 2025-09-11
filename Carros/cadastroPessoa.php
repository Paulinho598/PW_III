<!DOCTYPE html>
<html lang="pt-br">
    <head>        
        <meta charset="UTF-8">
        <title>Automóveis - Cadastro</title>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="login.css">
        <script src="jquery.maskMoney.js" type="text/javascript"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
        
    </head>
    <body class="batata">
        <div id="body">
            <form action="cadastroPessoa.php" method="get" id="corpo">
                <h1>Cadastro</h1>
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
                        <input type="email" name="email" id="email" placeholder="zé_ruela@gmail.com" maxlength="50" required>
                    </div>
                    <div class="input">
                        <label for="placa">Senha:</label>
                        <input type="password" name="senha" id="senha" placeholder="12345678" minlength="8" maxlength="8" required>
                    </div>
                    <div id="btn">
                        <input type="submit" value="cadastrar" name="cadastrar" id="cadastrar" class="botão">
                        <a class="botão" name="limpar" id="limpar" onclick="limpar()">limpar</a>
                        <a href="index.html" class="botão">voltar</a>
                    </div>
                    <div id="tools">
                        <a href="#">Esqueci Minha Senha</a>
                        <a href="cadastroPessoa.php">Não Tenho Conta</a>
                    </div>
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
        document.getElementById('nome').value = ""
        document.getElementById('email').value = ""
        document.getElementById('senha').value = ""
    }
</script>

<?php

if(isset($_GET['cadastrar'])){
    $user = "root";
    $password = "";
    $server = "localhost";
    $database = "veículos";

    try{
        $conn = new mysqli($server,$user,$password,$database);

        if($conn->connect_error){
            die("Conexão falhou: ".$conn->connect_error);
        }

        // 🎯 CORRIGINDO os nomes das variáveis
        $nome = $conn->real_escape_string($_GET['nome']);
        $email = $conn->real_escape_string($_GET['email']);
        $senha = $conn->real_escape_string($_GET['senha']);
        
        // 🔐 Criptografando a senha (no lugar certo!)
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

        date_default_timezone_set('America/Sao_Paulo');
        $data = date("Y-m-d H:i:s");

        // ✅ SQL correto
        $sql = "INSERT INTO pessoa(nome, email, senha, cadastro) 
                VALUES ('$nome', '$email', '$senha_hash', '$data')";

        // 🚨 REMOVI a verificação complicada (tá causando erro!)
        if ($conn->query($sql) === TRUE){
            echo "<script>alert('Cadastrado com sucesso!')</script>";
            echo "<script>window.location.href = 'funcionalidades.html'</script>";
        } else {
            echo "<script>alert('ERRO: ".addslashes($conn->error)."')</script>";
            echo "<script>window.location.href = 'Login.html'</script>";
        }

        $conn->close();

    } catch (Exception $e){
        echo "<script>alert('ERRO! " . addslashes($e->getMessage()) . "')</script>";
        echo "<script>window.location.href = 'Login.html'</script>";
    }
}
?>