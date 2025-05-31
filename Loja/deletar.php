<?php
session_start();
include_once("./conexão.php");

if(isset($_GET['id'])) {
    $id_cliente = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    
    if($id_cliente) {
        try {
            // Deleta do banco de dados
            $deletar = $pdo->prepare("DELETE FROM cliente WHERE id = :id");
            $deletar->bindValue(":id", $id_cliente);
            $deletar->execute();
            
            // Remove da sessão se for o mesmo cliente
            if(isset($_SESSION['cliente']) && $_SESSION['cliente']['id'] == $id_cliente) {
                unset($_SESSION['cliente']);
            }
            
            header("Location: selecionar_cliente.php?success=cliente_deletado");
            exit();
        } catch (PDOException $e) {
            header("Location: selecionar_cliente.php?error=erro_deletar");
            exit();
        }
    }
}

header("Location: selecionar_cliente.php");
exit();
?>