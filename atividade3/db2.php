<?php
    require_once "../conexao.php";
// 2. Criar Tabela

$sql = "CREATE TABLE IF NOT EXISTS produtos(
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(150) NOT NULL,
    categoria_id INT,
    preco DECIMAL(10,2) NOT NULL,
    quantidade INT NOT NULL,
    estoque_minimo INT NOT NULL
    FOREIGN KEY categorias_id REFERENCES categorias(id)
)";

$pdo->exec($sql);

// 2. Cadastrar produto
if (isset($_POST["cadastrar"])) {
    $nome = $_POST["nome"];
    $preco = $_POST["preco"];
    $quantidade = $_POST["quantidade"];

    $sql = "INSERT INTO produtos (nome, preco, quantidade) VALUES ('$nome', $preco, $quantidade)";

    $stmt = $pdo->prepare($sql);
    
    $stmt->execute();
};


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
        <a href="/atividade3/categoria.php">Produtos</a>
        <a href="/atividade3/vendas.php">vendas</a>
    </nav>

</body>
</html>