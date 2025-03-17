<?php

class Dados {
    private $pdo;
    private $host = "localhost";
    private $user = "root";
    private $dbname = "Zoológico";
    private $password = "";

    public function __construct() {
        try {
            $this->pdo = new PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->user, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erro ao conectar ao banco de dados: " . $e->getMessage());
        }
    }

    public function conectar() {
        return $this->pdo;
    }
}

class Animal {
    private $db;

    public function __construct(Dados $db) {
        $this->db = $db;
    }

    public function adicionarAnimal($nome, $especie, $dataNascimento = null) {
        $codigo = "INSERT INTO Animais (nome, espécie, dataNascimento) VALUES (:nome, :especie, :dataNascimento)";
        $stmt = $this->db->conectar()->prepare($codigo);
        $stmt->execute([
            'nome' => $nome,
            'especie' => $especie,
            'dataNascimento' => $dataNascimento
        ]);
    }

    public function listarAnimais() {
        $codigo = "SELECT * FROM Animais";
        $stmt = $this->db->conectar()->query($codigo);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function removerAnimal($id) {
        $codigo = "DELETE FROM Animais WHERE id = :id";
        $stmt = $this->db->conectar()->prepare($codigo);
        $stmt->execute(['id' => $id]);
    }
}

$database = new Dados();
$animalManager = new Animal($database);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['nome']) && !empty($_POST['especie'])) {
    $nome = $_POST['nome'];
    $especie = $_POST['especie'];
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