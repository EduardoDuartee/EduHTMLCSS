<?php
    require_once "../conexao.php";

    $sql = "CREATE TABLE IF NOT EXISTS categorias(
       id INT, PRIMARY KEY AUTO_INCREMENT,
       nome: VARCHAR(100) NOT NULL
    )";

$pdo->exec($sql);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INFOTECH</title>
</head>
<body>
    <nav>
        <a href="/atividade3/categoria.php">Categorias</a>
        <a href="/atividade3/vendas.php">vendas</a>
    </nav>

</body>
</html>