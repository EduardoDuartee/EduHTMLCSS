<?php
require_once "funcoes.php";

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $nota1 = $_POST["nota1"];
    $nota2 = $_POST["nota2"];

    $media = calcularMedia($nota1, $nota2);

    $situacao = verificarStatus($media);
}



?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/funcoes.css">
    <title>Document</title>
</head>
<body>
    <header>
    <div class="logo">
        <h2>Eduardo <span>Augusto</span></h2>
    </div>
    <nav>
        <a href="../index.php">Inicio</a>
        <a href="../index.php">Sobre</a>
        <a href="../index.php">Projetos</a>
        <a href="../index.php">Contato</a>
        
    </nav>
    </header>

    <h1><?= $nomeEscola ?></h1>
    <h2><?= sadaucao()  ?></h2>
    <p><?= comprimentar("Eduardo") ?></p>


    <form method="POST">
        <label for="numero">Nota 1:</label>
        <input type="number" name="nota1" min="0" max="10" step="0.1" required>
        <label for="numero">Nota 2:</label>
        <input type="number" name="nota2" min="0" max="10" step="0.1" required>
        <p><?=  $media ?></p>
        <p><?= $situacao ?></p>
        <button>Calcular Media</button>
    </form>
</body>
</html>