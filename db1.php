<?php
    require_once "conexao.php";
    // 1. criar tabela
    echo"erro ao começo se passar n e aqui";
    $sql = "CREATE TABLE IF NOT EXISTS produtos(
        id INT  AUTO_INCREMENT PIMARY KEY,
        nome VARCHAR(100) NOT NULL,
        preco DECIMAL(10,2) NOT NULL,
        quantidade INT NOT NULL
    )";

    echo"erro ao criar se passar n e aqui";

    $pdo->exec($sql);

    // 2. Cadastrar produto
    if (isset($_POST["cadastrar"])) {
        $nome = $_POST["nome"];
        $preco = $_POST["preco"];
        $quantidade = $_POST["quantidade"];

        $sql - "INSERT INTO produtos (nome, preco, quantidade) VALUES ('$nome', $preco, $quantidade)";

        $stmt = $pdo->prepare($sql);
        
        $stmt->execute();
    };
    echo"erro ao cadastrar se passar n e aqui";

    //3. atualizar produto

    if (isset($_POST["atualizar"])){
        $id = $_POST["id"];
        $nome = $_POST["nome"];
        $preco = $_POST["preco"];
        $quantidade = $_POST["quantidade"];

        $sql =- "UPDATE produtos  SET nome = '$nome', preco = $preco, quantidade = '$quantidade' WHERE id = $id";

        $stmt = $pdo->prepare($sql);

        $stmt->execute();
    }

    echo"erro ao atualizar se passar n e aqui";
    //4. excluir produto

    if(isset($_POST["excluir"])){
        $id = $_POST["id"];
        $sql = "DELETE FROM produtos WHERE id = $id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
    }
    echo"erro ao excluir se passar n e aqui";

    //5. buscar produto para edição
    $produtoEditar = NULL;

    if(isset($_GET["editar"])){
        $id = $_GET["editar"];
        $sql = "SELECT * FROM produtos WHERE id = $id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $produtoEditar = $stmt->fetch(PDO::FETCH_ASSOC);
    }
    echo"erro ao buscar se passar n e aqui";

    //6. Listar todos osproduto 
    $sql = "SELECT * FROM produtos ORDER BY id ASC";
    $stmt = $pdo->query($sql);
    $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo"erro ao listar se passar n e aqui";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
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
                <input type="text" name="nome" value="<?= $produtoEditar['nome'] ?? ''?>"> 
                <br><br>
                <label>Preço:</label>
                <input type="number" name="preco" step="0.01" min="0" required value="<?= $produtoEditar['preco'] ?? '' ?>">
                <br><br>
                <label>Quantidade:</label>
                <input type="number" name="quantidade" min="0" required value="<?= $produtoEditar['quantidade'] ?? '' ?>">
                <br><br>
                <?php if($produtoEditar){?>
                    <button type="submit" name="atualizar">Atualizar Produto</button>
                    <?php } else { ?>
                        <button type="submit" name="atualizar">Cadastrar Produto</button>
                     <?php } ?>
        </form>
            <hr>
            <h2>Produtos Cadastrados</h2>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Preço</th>
                    <th>Quantidade</th>
                    <th>Ações</th>
                    </tr>
                    <?php foreach ($produtos as $produto) {?>
                        <tr>
                    <!--td | table data | cria uma celula de dados na tabela-->
                            <td><?= $produto['id'] ?></td>
                            <td><?= htmlspecialchars($produto["nome"]) ?></td>
                            <td>R$ <?= number_format($produto["preço"], 2, ",", ",") ?></td>
                            <td><?= $produto["quantidade"] ?></td>
                            <td>
                                <!--Editar-->
                                <a href="index.php?editar=<?= $produto['id'] ?>">Editar</a>
                                <!--Excluir-->
                                <form method="POST" action="index.php" style="display:inline;">
                                    <input type="hidden" name="id" value="<?= $produto['id'] ?>">
                                    <button type="submit" name="excluir" onclick="return confirm('Deseja Excluir este Produto?')">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    <?php } ?> 
            </table>
    
</body>
</html>