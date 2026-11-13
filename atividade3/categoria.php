<?php
require_once "../conexao.php";

$sql = "CREATE TABLE IF NOT EXISTS vendas(
    id: INT, PRIMARY KEY AUTO_INCREMENT,
    produto_id INT FOREIGN KEY,
    quantidade INT NOT NULL,
    valor_total DECIMAL(10,2) NOT NULL,
    data_venda DATETIME NOT NULL
)";

$pdo->exec($sql);
?>