<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Automóveis - Consulta</title>
        <link rel="stylesheet" href="consulta.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div id="body">
            <div id="corpo">
                <h1>Consulta</h1>
                <table>
                    <thead>
                        <th>Modelo</th>
                        <th>Ano</th>
                        <th>Placa</th>
                    </thead>
                    <tbody>
                        <?php
                            $user = 'root';
                            $password = '';
                            $dbname = 'veículos';
                            $server = 'localhost';

                            try {
                                $conn = new mysqli($server,$user,$password,$dbname);

                                if($conn->connect_error){
                                    die("Conexão falhou:".$conn->connect_error);
                                }

                                $sql = "select modelo, ano, placa from carros;";
                                $resultado = $conn->query($sql);

                                if ($resultado->num_rows>0){
                                    while ($linha = $resultado->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>".$linha["modelo"]."</td>";
                                        echo "<td>".$linha["ano"]."</td>";
                                        echo "<td>".$linha["placa"]."</td>";
                                        echo "</tr>";
                                    };
                                }else{
                                    echo "<tr><td colspan='3'>Nenhum Carro Cadastrado!</td></tr>";
                                };
                            } catch (Exception $e) {
                                echo "<script>alert('ERRO! " . addslashes($e->getMessage()) . "')</script>";
                            }
                        ?>
                    </tbody>
                </table>
                <div id="btn">
                    <a href="início.html" class="botão">voltar</a>
                </div>
            </div>
        </div>
    </body>
</html>