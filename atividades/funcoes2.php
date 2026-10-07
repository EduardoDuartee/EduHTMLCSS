<?php
require_once "08-funcoes.php"
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1><?= $nomeEscola ?></h1>
    <h2><?= sadaucao()  ?></h2>
    <p><?= comprimentar("Eduardo") ?>?></p>
    <p>
        resultado da soma:
        <?= somar(10, 5) ?>
    </p>
</body>
</html>