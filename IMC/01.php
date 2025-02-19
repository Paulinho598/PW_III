<!DOCTYPE html>
<html>
    <head>
        <title>01</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div id="formulário">
            <form action="02.php" method="get">
                <div>
                    <label for="altura" class="txt">Digite a sua altura:</label>
                    <input type="text" name="altura" id="altura">
                </div>
                <div>
                    <label for="peso" class="txt">Digite o seu peso:</label>
                    <input type="text" name="peso" id="peso">
                </div>
                <div>
                    <label for="gênero" class="txt">Selecione o seu gênero:</label>
                    <input type="radio" name="gênero" id="masculino" value="masculino">
                    <label for="masculino">Masculino</label>
                    <input type="radio" name="gênero" id="feminino" value="feminino">
                    <label for="feminino">Feminino</label>
                </div>
                <div>
                    <label for="idade" class="txt">Digite a sua idade:</label>
                    <input type="text" name="idade" id="idade">
                </div>
                <input type="submit" value="Enviar">
            </form>
        </div>
    </body>
</html>