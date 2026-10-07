<?php
require_once "08-funcoes.php"
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="funcoes.css">
    <title>Document</title>
</head>
<body>
    <header>
    <div class="logo">
        <h2>Eduardo <span>Augusto</span></h2>
    </div>
    <nav>
        <a href="#inicio">Inicio</a>
        <a href="#sobre">Sobre</a>
        <a href="#projetos">Projetos</a>
        <a href="#contato">Contato</a>
        
    </nav>
    </header>
    <h1><?= $nomeEscola ?></h1>
    <h2><?= sadaucao()  ?></h2>
    <p><?= comprimentar("Eduardo") ?>?></p>
    <p>
        resultado da soma:
        <?= somar(10, 5) ?>
    </p>
</body>
</html>