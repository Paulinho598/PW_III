<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Gerenciamento de Animais</title>
    <link rel="stylesheet" href="style.css">
</head>
    <body>
        <div id="contêiner">
            <h1>Gerenciamento de Animais do Zoológico</h1>

            <form method="POST" action="file.php">
                <h2>Adicionar Animal</h2>
                <input type="text" name="nome" placeholder="Nome" required>
                <input type="text" name="especie" placeholder="Espécie" required>
                <input type="date" name="dataNascimento" placeholder="Data de Nascimento">
                <button type="submit">Adicionar</button>
            </form> 
        </div>
    </body>
</html>