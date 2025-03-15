<?php

class Dados{
    private $pdo;

    public function __construct(){
        $host = 'localhost';
        $user = 'root';
        $dbname = 'Zoológico';
        $password = '';

        try {
            $this->pdo = new PDO("$host, $dbname, $user, $password");
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erro ao conectar ao banco de dados: " . $e->getMessage());
        }
    }
    public function conectar(){
        return $this->pdo;
    }
}

class Animal{
    private $db;

    public function __construct(Dados $db){
        $this->db = $db;
    }

    public function adicionarAnimal($nome, $especie, $dataNascimento = null) {
        $código = "INSERT INTO Animais (nome, espécie, dataNascimento) VALUES (:nome, :especie, :dataNascimento)";
        $stmt = $this->db->conectar()->prepare($código);
        $stmt->execute([
            'nome' => $nome,
            'espécie' => $especie,
            'dataNascimento' => $dataNascimento
        ]);
    }

    public function listarAnimais() {
        $código = "SELECT * FROM Animais";
        $stmt = $this->db->conectar()->query($código);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function removerAnimal($id){
        $código = "DELETE FROM Animais WHERE id = :id";
        $stmt = $this->db->conectar()->prepare($código);
        $stmt->execute(['id' => $id]);
    }
}

$database = new Dados();
$animalManager = new Animal($database);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['nome']) && !empty($_POST['espécie'])) {
    $nome = $_POST['nome'];
    $especie = $_POST['espécie'];
    $dataNascimento = $_POST['dataNascimento'] ?? null;
    $animalManager->adicionarAnimal($nome, $especie, $dataNascimento);
    header("Location: lista.php");
    exit();
}

if (isset($_GET['remover'])) {
    $id = $_GET['remover'];
    $animalManager->removerAnimal($id);
    header("Location: lista.php");
    exit();
}

$animais = $animalManager->listarAnimais();

?>