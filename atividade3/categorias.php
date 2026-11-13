<?php
require_once "../conexao.php";


$sql = "CREATE TABLE IF NOT EXISTS categorias(
    id INT, PRIMARY KEY AUTO_INCREMENT,
    nome: VARCHAR(100) NOT NULL
 )";

 
$pdo->exec($sql);

?>