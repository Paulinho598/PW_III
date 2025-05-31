<?php
session_start();
include_once("./conexão.php");

// Verifica se foi passado um ID pela URL
if(isset($_GET['id'])) {
    $id_cliente = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    
    if($id_cliente) {
        try {
            $consulta = $pdo->prepare("SELECT * FROM cliente WHERE id = :id");
            $consulta->bindValue(":id", $id_cliente);
            $consulta->execute();
            
            if($consulta->rowCount() > 0) {
                $cliente = $consulta->fetch(PDO::FETCH_ASSOC);
                // Armazena na sessão
                $_SESSION['cliente'] = $cliente;
            } else {
                die("Cliente não encontrado");
            }
        } catch (PDOException $e) {
            die("Erro ao consultar cliente: " . $e->getMessage());
        }
    } else {
        die("ID inválido");
    }
}

if(!isset($_SESSION['cliente'])) {
    ?>
    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Dados do Cliente</title>
        <link rel="stylesheet" href="style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            .sem-dados {
                margin: 50px auto;
                padding: 30px;
                width: 80%;
                text-align: center;
                background-color: #ffebee;
                border: 2px solid #ef9a9a;
                border-radius: 10px;
                color: #c62828;
                font-size: 24px;
            }
            
            #Dados {
                margin: auto;
                display: flex;
                padding: 30px;
                width: fit-content;
                align-items: center;
                border-radius: 30px;
                flex-direction: column;
                justify-content: center;
                border: 2px solid black;
                background-color: lightblue;
            }

            #botão {
                color: white;
                padding: 10px;
                font-size: 20px;
                width: fit-content;
                margin-bottom: 10px; 
                border-radius: 50px;
                background-color: pink;
                border: 2px solid black;
            }

            #botão:hover {
                cursor: pointer;
                color: rgb(255,105,180);
                background-color: white;
            }
            
            .usuario-info {
                background-color: #e3f2fd;
                padding: 15px;
                border-radius: 10px;
                margin-bottom: 20px;
                text-align: center;
                border: 1px solid #90caf9;
            }
        </style>
    </head>
    <body>
        <div class="sem-dados">
            Nenhum dado de cliente encontrado. 
            <br><br>
            <a href="selecionar_cliente.php"><button id="botão">Selecionar Cliente</button></a>
            <a href="index.php"><button id="botão">Voltar para a página inicial</button></a>
        </div>
    </body>
    </html>
    <?php
    exit();
}

$cliente = $_SESSION['cliente'];
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Dados do Cliente</title>
        <link rel="stylesheet" href="style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            #Dados {
                margin: auto;
                display: flex;
                padding: 30px;
                width: fit-content;
                align-items: center;
                border-radius: 30px;
                flex-direction: column;
                justify-content: center;
                border: 2px solid black;
                background-color: lightblue;
            }

            #botão {
                color: white;
                padding: 10px;
                font-size: 20px;
                width: fit-content;
                margin-bottom: 10px; 
                border-radius: 50px;
                background-color: pink;
                border: 2px solid black;
            }

            #botão:hover {
                cursor: pointer;
                color: rgb(255,105,180);
                background-color: white;
            }
            
            .usuario-info {
                background-color: #e3f2fd;
                padding: 15px;
                border-radius: 10px;
                margin-bottom: 20px;
                text-align: center;
                border: 1px solid #90caf9;
                width: 100%;
                box-sizing: border-box;
            }
            
            .dados-container {
                width: 100%;
                margin-bottom: 15px;
            }
        </style>
    </head>
    <body>
        <h1>Dados do Cliente Cadastrado</h1>
        <div id="Dados">
            <div class="usuario-info">
                <h2>Visualizando dados de: <strong><?= htmlspecialchars($cliente['nome']) ?></strong></h2>
                <p>Email: <?= htmlspecialchars($cliente['email']) ?></p>
                <p>Cadastrado em: <?= htmlspecialchars($cliente['data_cadastro']) ?></p>
            </div>
            
            <div class="dados-container">
                <h2>Nome: <?= htmlspecialchars($cliente['nome'] ?? 'Não informado') ?></h2>
                <h2>Endereço: <?= htmlspecialchars($cliente['endereco'] ?? 'Não informado') ?></h2>
                <h2>Bairro: <?= htmlspecialchars($cliente['bairro'] ?? 'Não informado') ?></h2>
                <h2>Cidade: <?= htmlspecialchars($cliente['cidade'] ?? 'Não informado') ?></h2>
                <h2>UF: <?= htmlspecialchars($cliente['uf'] ?? 'Não informado') ?></h2>
                <h2>Email: <?= htmlspecialchars($cliente['email'] ?? 'Não informado') ?></h2>
                <h2>CEP: <?= htmlspecialchars($cliente['cep'] ?? 'Não informado') ?></h2>
                <h2>Celular: <?= htmlspecialchars($cliente['celular'] ?? 'Não informado') ?></h2>
                <h2>Data do Cadastro: <?= htmlspecialchars($cliente['data_cadastro'] ?? 'Não informado') ?></h2>
            </div>

            <a href="selecionar_cliente.php"><button id="botão">Ver outros clientes</button></a>
            <a href="deletar.php?id=<?= $cliente['id'] ?>" onclick="return confirm('Tem certeza que deseja deletar este cliente permanentemente?')">
                <button id="botão">Deletar os dados</button>
            </a>
            <a href="index.html"><button id="botão">Voltar</button></a>
        </div>
    </body>
</html>