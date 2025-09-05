<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Automóveis - Consulta</title>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="consulta.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body class="batata">
        <div id="body">
            <div id="corpo">
                <h1>Consulta</h1>
                <div id="dataContainer">
                    <label id="Data" name="Data">Data:<span id="ValorData"></span></label>
                </div>
                <div id="corContainer">
                    <span id="corLbl">Modifique a cor da página:</span>
                    <input type="color" id="corFundo" name="corFundo" oninput="Background(this)"/>
                </div>
                <table>
                    <thead>
                        <th>Modelo</th>
                        <th>Ano</th>
                        <th>Placa</th>
                        <th>Valor</th>
                        <th>Cor</th>
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

                                $sql = "select modelo, ano, placa, valor, cor from carros;";
                                $resultado = $conn->query($sql);

                                if ($resultado->num_rows>0){
                                    while ($linha = $resultado->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>".$linha["modelo"]."</td>";
                                        echo "<td>".$linha["ano"]."</td>";
                                        echo "<td>".$linha["placa"]."</td>";
                                        echo "<td>".$linha["valor"]."</td>";
                                        echo "<td>".$linha["cor"]."</td>";
                                        echo "</tr>";
                                    };
                                }else{
                                    echo "<tr><td colspan='5'>Nenhum Carro Cadastrado!</td></tr>";
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

    <script>
        function getDate(span){
            const hoje = new Date()
            const detalhes = {year: 'numeric', month: '2-digit', day: '2-digit' }
            return hoje.toLocaleDateString('pt-BR', detalhes)
        }

        document.getElementById("ValorData").textContent = getDate()

        function Background(input){
            const cor = input.value
            const page = document.getElementsByClassName('batata')

            if (page.length > 0){
                page[0].style.backgroundColor = cor
            }
        }
    </script>
</html>