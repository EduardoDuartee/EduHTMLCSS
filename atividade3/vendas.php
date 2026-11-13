<?php
 require_once "../conexao.php";


 
 $sql = "CREATE TABLE IF NOT EXISTS produtos(
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(150) NOT NULL,
    categoria_id INT, FOREIGN KEY,
    preco DECIMAL(10,2) NOT NULL,
    quantidade INT NOT NULL,
    estoque_minimo INT NOT NULL
)";

$pdo->exec($sql);

$sql = "CREATE TABLE IF NOT EXISTS vendas(
    id: INT, PRIMARY KEY AUTO_INCREMENT,
    produto_id INT FOREIGN KEY,
    quantidade INT NOT NULL,
    valor_total DECIMAL(10,2) NOT NULL,
    data_venda DATETIME NOT NULL
)";

?>