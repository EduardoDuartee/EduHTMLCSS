<?php
 require_once "../conexao.php";


 
 $sql = "CREATE TABLE IF NOT EXISTS vendas(
    id: INT, PRIMARY KEY AUTO_INCREMENT,
    produto_id INT,
    quantidade INT NOT NULL,
    valor_total DECIMAL(10,2) NOT NULL,
    data_venda DATETIME NOT NULL,
    FOREIGN KEY (produtos_id) REFERENCE produtos(id)
)";

$pdo->exec($sql);

?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="atv3.css">
        <title>categorias</title>
    </head>
    <body>
    <header>
        <div class="logo">
            <h2>Eduardo <span>Augusto</span></h2>
        </div>
        <nav>
            <a href="/atividade3/produtos.php">Produtos</a>
            <a href="/atividade3/categorias.php">Categorias</a>
        </nav>
    </header>