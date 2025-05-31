<?php
session_start();
include_once("./conexão.php");

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
    $endereco = filter_input(INPUT_POST, 'endereco', FILTER_SANITIZE_STRING);
    $bairro = filter_input(INPUT_POST, 'bairro', FILTER_SANITIZE_STRING);
    $cidade = filter_input(INPUT_POST, 'cidade', FILTER_SANITIZE_STRING);
    $uf = filter_input(INPUT_POST, 'uf', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $cep = filter_input(INPUT_POST, 'cep', FILTER_SANITIZE_STRING);
    $celular = filter_input(INPUT_POST, 'celular', FILTER_SANITIZE_STRING);
    $id_cliente = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

    if(!$id_cliente) {
        die("ID do cliente inválido");
    }

    $_SESSION['cliente'] = [
        'nome' => $nome,
        'endereco' => $endereco,
        'bairro' => $bairro,
        'cidade' => $cidade,
        'uf' => $uf,
        'email' => $email,
        'cep' => $cep,
        'celular' => $celular,
        'data_cadastro' => date('d-m-Y H:i:s'),
        'id' => $id_cliente
    ];

    try{
        $verificar = $pdo->prepare("SELECT id FROM cliente WHERE id = :id");
        $verificar->bindValue(":id", $id_cliente);
        $verificar->execute();
        
        if($verificar->rowCount() > 0){
            $atualizar = $pdo->prepare("UPDATE cliente SET 
                nome = :nome, 
                Endereco = :endereco, 
                bairro = :bairro, 
                cidade = :cidade, 
                uf = :uf, 
                CEP = :cep, 
                celular = :celular, 
                email = :email, 
                alteracao = CURDATE(), 
                dataAlteracao = USER() 
                WHERE id = :id");
            
            $atualizar->execute([
                ':nome' => $nome,
                ':endereco' => $endereco,
                ':bairro' => $bairro,
                ':cidade' => $cidade,
                ':uf' => $uf,
                ':cep' => $cep,
                ':celular' => $celular,
                ':email' => $email,
                ':id' => $id_cliente
            ]);

            header("Location: Ler.php");
            exit();
        } else {
            echo "Cliente não encontrado";
        }
    } catch (PDOException $e) {
        echo "Erro no banco de dados: " . $e->getMessage();
    }
} else {
    echo "Acesso inválido";
}
?>