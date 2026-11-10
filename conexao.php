<?php
// php: linguagem que execulta as regras do sistema.
// mysql: SGDB
// PDO: Interface doPHP que permite conversa com banco de dados por meio de drive

// host = 'localhost' = 194.61.238.119
$host = 'localhost';
$db = 'eduardoa755_db1';
$user = 'eduardoa755';
$pass = '755!@#';
$charset = 'utf8mb4';

try{
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=$charset",
    $user,
    $pass
);

$pdo->setAttribute(
    PDO::ATTR_ERRMODE,
    PDO::ERRMODE_EXCEPTION

);

    echo "BANCO DE DADOS CONECTADO COM SUCESSO";

}catch (PDOException $e) {
    echo "ERROR AO CONECTAR AO BANCO DE DADOS.:\n";
    echo $e->getMessage();
}
?>