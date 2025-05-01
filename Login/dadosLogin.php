<?php
    session_start();
    header('Content-Type: text/plain; charset=utf-8');

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $user = "root";
    $password = "";
    $database = "Login";
    $server = "localhost";

    $conn = new mysqli($server, $user, $password, $database);
    if($conn->connect_error){
        die($conn->connect_error);
    }

    class Conexão{
        private $db;

        function __construct($db) {
            $this->db = $db;
        }

        function entrar($email, $senha) {
            $stmt = $this->db->prepare("select nome,email,senha,genero from Dados where email = ?");
            $stmt->bind_param("s", $email);
            
            try{
                $stmt->execute();
            }catch (Exception $e){
                $e->getMessage();
            }

            $resultado = $stmt->get_result();

            if($resultado->num_rows === 0){
                header("Location:erro.php");
            }else{
                $pessoa = $resultado->fetch_assoc();

                error_log("Stored hash: " . $pessoa['senha']);

                if(password_verify($senha,$pessoa['senha'])){
                    $_SESSION['nome'] = $pessoa['nome'];
                    $_SESSION['email'] = $pessoa['email'];
                    $_SESSION['gênero'] = $pessoa['gênero'];
                    $_SESSION['senha'] = $senha;

                    header("Location:Dentro.php");
                    exit();
                }else{
                    echo "Senha Incorreta. Senha fornecida: $senha, Senha armazenada: " . $pessoa['senha'];
                }
            }

            $stmt->close();
        }
    }

    $dado = new Conexão($conn);
    $dado->entrar($email,$senha);

    $conn->close();
    ?>