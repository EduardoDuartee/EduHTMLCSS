<?php 
    $nome =  $_GET["nome"];
    $idade = $_GET["idade"];
    $resultado = "";

    if ($idade >= 18)
    {
        $resultado = "Acesso Permitido";
    }
    else{
        $resultado ="Acesso Não Permitido";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/idade.css">
    <title>idade</title>
</head>
<body>

<header>
    <div class="logo">
        <h2>Eduardo <span>Augusto</span></h2>
    </div>
    <nav>
        <a href="../index.php">inicio</a>
        <a href="../index.php">Sobre</a>
        <a href="../index.php">Projetos</a>
        <a href="../index.php">Contato</a>
        
    </nav>
    </header>
</body>

<main>
    <section class="cadastro">
    <h1>cadastro</h1>
    <form method="POST">
        <label> NOME :</label>
        <input type="text" class="nome" id="nome" name="nome"><br>
        <label> IDADE :</label>
        <input type="number" class="idade" id="idade" name="idade"><br>
        <button type="submit" class="botao"> cadastro</button>  
    </form>
    <p><?= $resultado?></p>
</section>
</main>
</html>