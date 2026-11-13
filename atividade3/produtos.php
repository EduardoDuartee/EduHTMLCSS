<?php
    require_once "../conexao.php";
// 2. Criar Tabela

$sql = "CREATE TABLE IF NOT EXISTS produtos(
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(150) NOT NULL,
    categoria_id INT,
    preco DECIMAL(10,2) NOT NULL,
    quantidade INT NOT NULL,
    estoque_minimo INT NOT NULL,
    FOREIGN KEY (categoria_id) REFERENCES categorias(id)
)";

$pdo->exec($sql);

// 2. Cadastrar produto
if (isset($_POST["cadastrar"])) {
    $nome = $_POST["nome"];
    $categoria_id = $_POST["categorias_id"];
    $preco = $_POST["preco"];
    $quantidade = $_POST["quantidade"];
    $estoque_minimo = $_POST["estoque_minimo"];

    $sql = "INSERT INTO produtos (nome, categoria_id, preco, quantidade, estoque_minimo) VALUES ('$nome', $categoria_id, $preco, $quantidade, $estoque_minimo)";

    $stmt = $pdo->prepare($sql);
    
    $stmt->execute();
};

//3. atualizar produto

if (isset($_POST["atualizar"])){
    $id = $_POST["id"];
    $nome = $_POST["nome"];
    $categoria_id = $_POST["categorias_id"];
    $preco = $_POST["preco"];
    $quantidade = $_POST["quantidade"];
    $estoque_minimo = $_POST["estoque_minimo"];

    $sql = "UPDATE produtos  SET nome = '$nome',categoria_id = $categoria_id, preco = $preco, quantidade = '$quantidade', estoque_minimo = $estoque_minimo WHERE id = $id";

    $stmt = $pdo->prepare($sql);

    $stmt->execute();
}

    //4. excluir produto

    if(isset($_POST["excluir"])){
        $id = $_POST["id"];
        $sql = "DELETE FROM produtos WHERE id = $id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
    }

    //5. buscar produto para edição
    $produtoEditar = NULL;

    if(isset($_GET["editar"])){
        $id = $_GET["editar"];
        $sql = "SELECT * FROM produtos WHERE id = $id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $produtoEditar = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    //6. Listar todos osproduto 
    $sql = "SELECT * FROM produtos ORDER BY id ASC";
    $stmt = $pdo->query($sql);
    $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="atv3.css">
    <title>INFOTECH</title>
</head>
<body>

    <header>
        <div class="logo">
            <h2>Eduardo <span>Augusto</span></h2>
        </div>
        <nav>
            <a href="/atividade3/categoria.php">categorias</a>
            <a href="/atividade3/vendas.php">vendas</a>
        </nav>
    </header>


    <section class="dados-banco">
    <h1>Sistema de Cadastro de Produtos</h1>
    <h2>
        <?php
        if($produtoEditar){
            echo"Editar produto";
        } else{
            echo "Cadastrar Produto";
        }
        ?>
    </h2>
        <form method="POST">
            <?php if($produtoEditar){ ?>
                <input type="hidden" name="id" value="<?= $produtoEditar['id'] ?>">
                <?php }?>
                <label>Nome dos Produtos</label>
                <input type="text" name="nome" required maxlength="150" required value="<?= htmlspecialchars($produtoEditar['nome'] ?? '') ?>">
                <br><br>
                <input type="number" name="categoria_id" required value="<?= $produtoEditar['categoria_id'] ?? '' ?>">
                <br><br>
                <label>Preço:</label>
                <input type="number" name="preco" step="0.01" min="0" required value="<?= $produtoEditar['preco'] ?? '' ?>">
                <br><br>
                <label>Quantidade:</label>
                <input type="number" name="quantidade" min="0" required value="<?= $produtoEditar['quantidade'] ?? '' ?>">
                <br><br>
                <label>Estoque mínimo:</label>
                <input type="number" name="estoque_minimo" min="0" required value="<?= $produtoEditar['estoque_minimo'] ?? '' ?>">
                <br><br>
                <?php if($produtoEditar){?>
                    <button type="submit" name="atualizar">Atualizar Produto</button>
                    <?php } else { ?>
                        <button type="submit" name="cadastrar">Cadastrar Produto</button>
                     <?php } ?>
        </form>
            <hr>
            <h2>Produtos Cadastrados</h2>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>categoria</th>
                    <th>Preço</th>
                    <th>Quantidade</th>
                    <th>Estoque_minimo</th>
                    <th>Ações</th>
                    </tr>
                    <?php foreach ($produtos as $produto) {?>
                        <tr>
                    <!--td | table data | cria uma celula de dados na tabela-->
                    <td><?= $produto['id'] ?></td>
                    <td><?= htmlspecialchars($produto["nome"]) ?></td>
                    <td><?= $produto["categoria_id"] ?></td>
                    <td>R$ <?= number_format($produto["preco"], 2, ",", ".") ?></td>
                    <td><?= $produto["quantidade"] ?></td>
                    <td><?= $produto["estoque_minimo"] ?></td>

                    <td>
                        <a href="db2.php?editar=<?= $produto['id'] ?>">
                            Editar
                        </a>

                        <form method="POST" action="produtos.php" style="display:inline;">
                            <input type="hidden" name="id" value="<?= $produto['id'] ?>">

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