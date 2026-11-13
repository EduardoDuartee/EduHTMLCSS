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

// 2. Cadastrar produto
if (isset($_POST["cadastrar"])) {
    $nome = $_POST["nome"];

    $sql = "INSERT INTO vendas (nome) VALUES ('$nome')";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
};

//3. atualizar produto

if (isset($_POST["atualizar"])){
    $id = $_POST["id"];
    $nome = $_POST["nome"];

    $sql = "UPDATE vendas  SET nome = '$nome' WHERE id = $id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
}

    //4. excluir produto

    if(isset($_POST["excluir"])){
        $id = $_POST["id"];
        $sql = "DELETE FROM vendas WHERE id = $id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
    }

    //5. buscar produto para edição
    $VendaEditar = NULL;

    if(isset($_GET["editar"])){
        $id = $_GET["editar"];
        $sql = "SELECT * FROM vendas WHERE id = $id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $VendaEditar = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    //6. Listar todos osproduto 
    $sql = "SELECT * FROM vendas ORDER BY id ASC";
    $stmt = $pdo->query($sql);
    $Vendas = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="atv3.css">
        <title>Vendas</title>
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
    
    </body>
    </html>