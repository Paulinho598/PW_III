<?php
session_start();
header('Content-Type: text/plain; charset=utf-8');

$email = $_POST['email'];
$senha = password_hash($_POST['nSenha'], PASSWORD_DEFAULT);

$user = "root";
$password = "";
$database = "Login";
$server = "localhost";

$conn = new mysqli($server, $user, $password, $database);
if($conn->connect_error){
    die("Erro de conexão: " . $conn->connect_error);
}

class Conexao {
    private $db;

    function __construct($db) {
        $this->db = $db;
    }

    function mudarSenha($email, $senha) {
        $stmt = $this->db->prepare("SELECT senha FROM Dados WHERE email = ?");
        $stmt->bind_param("s", $email);
        
        try {
            $stmt->execute();
            $resultado = $stmt->get_result();
            
            if($resultado->num_rows === 0) {
                return "Usuário não encontrado.";
            }

            $stmt->close();
            
            $stmt = $this->db->prepare("UPDATE Dados SET senha = ? WHERE email = ?");
            $stmt->bind_param("ss", $senha, $email);
            
            if($stmt->execute()) {
                return "Senha alterada com sucesso!";
            } else {
                return "Erro ao alterar senha: " . $stmt->error;
            }
            
        } catch (Exception $e) {
            return "Erro: " . $e->getMessage();
        } finally {
            if(isset($stmt)) {
                $stmt->close();
                header("Location:index.html");
            }
        }
    }
}

$dado = new Conexao($conn);
$resultado = $dado->mudarSenha($email, $senha);
echo $resultado;

$conn->close();
?>