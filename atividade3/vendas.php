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