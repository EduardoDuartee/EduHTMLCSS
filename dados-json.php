<?php
    if($_SERVER["REQUEST_METHOD"] =="POST"){ //verifica se o formulario foi enviado usando metodo post
        $nome = $_POST["nome"];
        $idade = $_POST["idade"];
     
        // Recebe as Notas  portugues
        $portugues_prova1 =  $_POST["Portugues_prova1"];
        $portugues_prova2 =  $_POST["Portugues_prova2"];
        $portugues_prova3 =  $_POST["Portugues_prova3"];
     
        // Recebe as Notas matematica
        $matematica_prova1 =  $_POST["matematica_prova1"];
        $matematica_prova2 =  $_POST["matematica_prova2"];
        $matematica_prova3 =  $_POST["matematica_prova3"];
     
        // Recebe as Notas historia
        $historia_prova1 =  $_POST["historia_prova1"];
        $historia_prova2 =  $_POST["historia_prova2"];
        $historia_prova3 =  $_POST["historia_prova3"];








        echo"<h2>Dados recebidos</h2>";
        echo"Nome:" .$nome. "<br>";
        echo"Idade:".$idade. "<br><br>";

        echo "<stong>Portugues:</stong><br>";
        echo "Prova1:" . $portugues_prova1 . "<br>";
        echo "Prova2:" . $portugues_prova2 . "<br>";
        echo "Prova3:" . $portugues_prova3 .
        "<br><br>";

        echo "<stong>Matematica:</stong><br>";
        echo "Prova1:" . $matematica_prova1 . "<br>";
        echo "Prova2:" . $matematica_prova2 . "<br>";
        echo "Prova3:" . $matematica_prova3 .
        "<br><br>";

        echo "<stong>Historia:</stong><br>";
        echo "Prova1:" . $historia_prova1 . "<br>";
        echo "Prova2:" . $historia_prova2 . "<br>";
        echo "Prova3:" . $historia_prova3 .
        "<br><br>";
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>json</title>
</head>

<header>
    <div class="logo">
        <h2>Eduardo <span>Augusto</span></h2>
    </div>
    <nav>
        <a href=" index.php">inicio</a>
        <a href="#sobre">Sobre</a>
        <a href="#projetos">Projetos</a>
        <a href="#contato">Contato</a>
        
    </nav>
    </header>

<body>
    <h1>Cadstro de Notas</h1>
    <form method="POST">
        <label for="Nome">Nome:</label>
        <input type="text" name="nome" required>
        <br><br>

        <label for="idade">Idade</label>
        <input type="number" name="idade" required>
<!--==========================================================================================-->
        <h2>Portugues</h2>
        <label>Prova 01:</label>
        <input type="number" name="Portugues_Prova1" min="0" max="10" step="0.1" required>
        <br><br>
        <label>Prova 02:</label>
        <input type="number" name="Portugues_Prova2" min="0" max="10" step="0.1" required>
        <br><br>
        <label>Prova 03:</label>
        <input type="number" name="portugues_Prova3" min="0" max="10" step="0.1" required>
        <br><br>
<!--==========================================================================================-->
        <h2>Matematica</h2>
        <label>Prova 01:</label>
        <input type="number" name="matematica_Prova1" min="0" max="10" step="0.1" required>
        <br><br>
        <label>Prova 02:</label>
        <input type="number" name="matematica_Prova2" min="0" max="10" step="0.1" required>
        <br><br>
        <label>Prova 03:</label>
        <input type="number" name="matematica_Prova3" min="0" max="10" step="0.1" required>
        <br><br>
<!--==========================================================================================-->
        <h2>Historia</h2>
        <label>Prova 01:</label>
        <input type="number" name="historia_Prova1" min="0" max="10" step="0.1" required>
        <br><br>
        <label>Prova 02:</label>
        <input type="number" name="historia_Prova2" min="0" max="10" step="0.1" required>
        <br><br>
        <label>Prova 03:</label>
        <input type="number" name="historia_Prova3" min="0" max="10" step="0.1" required>
        <br><br>
            <button type="submit" class="botao"> cadastro</button>  
    </form>
</body>
</html>