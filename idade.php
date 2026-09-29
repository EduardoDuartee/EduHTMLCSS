<?php 
    $nome =  $_POST ["nome"];
    $idade = $_POST ["idade"];
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
    <link rel="stylesheet" href="idade.css">
    <title>idade</title>
</head>
<body>

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
</body>

<main>
    <section class="cadastro">
    </h1>cadastro</h1>
    <form method="POST">
        <label> name :</label>
        <input type="text" class="nome" id="nome" name="nome">
        <label> idade</label>
        <input type="number" class="idade" id="idade" name="idade">
        <button type="submit"> cadastro</button>  
    </form>
    <p><?= $resultado?></p>
</section>
</main>
</html>