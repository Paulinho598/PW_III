<?php
session_start();
include_once("./conexão.php");

// Verifica se é uma requisição POST
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Coleta os dados com segurança
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
    $endereco = filter_input(INPUT_POST, 'endereco', FILTER_SANITIZE_STRING);
    $bairro = filter_input(INPUT_POST, 'bairro', FILTER_SANITIZE_STRING);
    $cidade = filter_input(INPUT_POST, 'cidade', FILTER_SANITIZE_STRING);
    $uf = filter_input(INPUT_POST, 'uf', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $cep = filter_input(INPUT_POST, 'cep', FILTER_SANITIZE_STRING);
    $celular = filter_input(INPUT_POST, 'celular', FILTER_SANITIZE_STRING);

    // Armazena na sessão
    $_SESSION['cliente'] = [
        'nome' => $nome,
        'endereco' => $endereco,
        'bairro' => $bairro,
        'cidade' => $cidade,
        'uf' => $uf,
        'email' => $email,
        'cep' => $cep,
        'celular' => $celular,
        'data_cadastro' => date('d-m-Y H:i:s')
    ];

    try {
        $verificar = $pdo->prepare("SELECT id FROM cliente WHERE email = :email OR celular = :celular");
        $verificar->bindValue(":email", $email);
        $verificar->bindValue(":celular", $celular);
        $verificar->execute();
        
        if($verificar->rowCount() == 0){
            $inserir = $pdo->prepare("INSERT INTO cliente (nome, Endereco, bairro, cidade, uf, CEP, celular, email, cadastro, alteracao, dataCadastro, dataAlteracao) VALUES (:nome, :endereco, :bairro, :cidade, :uf, :cep, :celular, :email, CURDATE(), CURDATE(), USER(), USER())");
            
            $inserir->execute([
                ':nome' => $nome,
                ':endereco' => $endereco,
                ':bairro' => $bairro,
                ':cidade' => $cidade,
                ':uf' => $uf,
                ':cep' => $cep,
                ':celular' => $celular,
                ':email' => $email
            ]);

            header("Location: Ler.php");
            exit();
        } else {
            echo "Cliente já cadastrado";
        }
    } catch (PDOException $e) {
        echo "Erro no banco de dados: " . $e->getMessage();
    }
} else {
    echo "Acesso inválido";
}
?>