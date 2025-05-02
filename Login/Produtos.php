<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Produtos</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            body{
                display: flex;
                align-items: center;
                flex-direction: column;
            }

            #corpo{
                gap: 50px;
                display: flex;
                width: 1800px;
                height: 800px;
                flex-wrap: wrap;    
                border-radius: 10px;
                align-items: center;
                justify-content: center;
                border: 3px solid black;
                background-color:lightpink;
            }

            .produto{
                display: flex;
                width: 400px;
                height: 500px;
                border-radius: 10%;
                align-items: center;
                flex-direction: column;
                justify-content: center;
                border: 2px solid black;
                background-color: lightblue;
            }

            .produto label{
                font-size: 25px;
                text-align: center;
                margin-bottom: 20px;
            }

            .produto .preço{
                width: 100%;
                height: 1px;
                display: flex;
                align-items: bottom;
                justify-content: center;
                border-top: 2px solid black;
            }
            
        </style>
    </head>
    <body>
        <h1>Produtos</h1>
        <div id="corpo">
            <div class="produto">
                <label>BLAHAJ</label>
                <img src="produtos/blahaj.png" alt="Item 1">
                <div class="preço">
                    <label>£25</label>
                </div>
            </div>
            <div class="produto">
                <label>DJUNGELSKOG</label>
                <img src="produtos/djungelskog.png" alt="Item 2">
                <div class="preço">
                    <label>£25</label>
                </div>
            </div>
        </div>
        <div id="btns">
            <button id="butãum"><a href="Dentro.php" id="forgot">Voltar</a></button>
        </div>
    </body>
</html>