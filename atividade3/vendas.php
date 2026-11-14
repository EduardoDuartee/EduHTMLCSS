<?php
 require_once "../conexao.php";


 
 $sql = "CREATE TABLE IF NOT EXISTS vendas(
    id INT AUTO_INCREMENT PRIMARY KEY,
    produto_id INT NOT NULL,
    quantidade INT NOT NULL,
    valor_total DECIMAL(10,2) NOT NULL,
    data_venda DATETIME NOT NULL,
    FOREIGN KEY (produto_id) REFERENCES produtos(id)
)";

$pdo->exec($sql);

// 2. Cadastrar produto
if (isset($_POST["cadastrar"])) {
    $produto_id = $_POST["produto"];
    $quantidade = $_POST["quantidade"];
    $valor_total = $_POST["valor_total"];
    $data_venda = $_POST["data_venda"];

    $sql = "INSERT INTO vendas (produto_id, quantidade, valor_total, data_venda)
    VALUES ($produto_id, $quantidade, $valor_total, '$data_venda')";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();
}

//3. atualizar produto

if (isset($_POST["atualizar"])) {
    $id = $_POST["id"];
    $produto_id = $_POST["produto"];
    $quantidade = $_POST["quantidade"];
    $valor_total = $_POST["valor_total"];
    $data_venda = $_POST["data_venda"];

    $sql = "UPDATE vendas SET produto_id = $produto_id, quantidade = $quantidade, valor_total = $valor_total, data_venda = '$data_venda' WHERE id = $id";

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
    $vendas = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
    <html lang="pt-br">
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
            <a href="produtos.php">Produtos</a>
            <a href="categorias.php">Categorias</a>
        </nav>
    </header>
    <section class="dados-banco">
    <h1>Sistema de Vendas</h1>
    <h2>
        <?php
        if($$vendaEditar){
            echo"Editar Venda";
        } else{
            echo "Cadastrar Venda";
        }
        ?>
    </h2>
        <form method="POST">
            <?php if($$vendaEditar){ ?>
                <input type="hidden" name="id" value="<?= $$vendaEditar['id'] ?>">
                <?php }?>
                <label>Nome do produto</label>
                <input type="text" name="nome" required maxlength="100" value="<?= htmlspecialchars($VendaEditar['produto_id'] ?? '') ?>"><br><br>
                <br><br>
                <label>Quantidade</label>
                <input type="number" name="categoria_id" required value="<?= $VendaEditar['quantidade'] ?? '' ?>">
                <br><br>
                <label>Valor_Total</label>
                <input type="number" name="categoria_id" required value="<?= $VendaEditar['valor_total'] ?? '' ?>">
                <br><br>
                <label>Data da Venda</label>
                <input type="number" name="categoria_id" required value="<?= $VendaEditar['data_venda'] ?? '' ?>">
                <br><br>
                <?php if($$vendaEditar){?>
                    <button type="submit" name="atualizar">Atualizar Categoria</button>
                    <?php } else { ?>
                        <button type="submit" name="cadastrar">Cadastrar Categoria</button>
                     <?php } ?>
        </form>
            <hr>
            <h2>Categoria Cadastrados</h2>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Produto ID</th>
                    <th>Quantidade</th>
                    <th>Valor_Total</th>
                    <th>data_venda</th>
                    <th>Ações</th>
                    </tr>
                    <?php foreach ($vendas as $venda) {?>
                        <tr>
                    <!--td | table data | cria uma celula de dados na tabela-->
                    <td><?= $venda['id'] ?></td>
                    <td><?= htmlspecialchars($venda["nome"]) ?></td>
                    <td>
                        <a href="vendas.php?editar=<?= $venda['id'] ?>">
                            Editar
                        </a>

                        <form method="POST" action="vendas.php" style="display:inline;">
                            <input type="hidden" name="id" value="<?= $categoria['id'] ?>">

                            <button type="submit" name="excluir"
                            onclick="return confirm('Deseja Excluir este Produto?')">
                                Excluir
                            </button>
                        </form>
                    </td>
                        </tr>
                    <?php } ?> 
            </table>
    
    </section>
    </body>
    </html>