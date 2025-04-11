<?php
session_start();

$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$genero = $_POST['gênero'];

$senha_hash = password_hash($_POST['senha'], PASSWORD_DEFAULT);

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

    function novoDado($nome, $email, $senha_hash, $genero) {
        $stmt = $this->db->prepare("insert into Dados (nome, email, senha, genero) VALUES (?,?,?,?)");
        $stmt->bind_param("ssss", $nome, $email, $senha_hash, $genero);
        try{
           $stmt->execute();
        }catch (Exception $e){
            $e->getMessage();
        }
        $stmt->close();
    }
}

$dado = new Conexão($conn);
$dado->novoDado($nome,$email,$senha_hash,$genero);

header("Location:index.html");
?>