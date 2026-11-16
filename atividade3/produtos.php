<?php
require_once "../conexao.php";

// 1. Criar tabela produtos
$sql = "CREATE TABLE IF NOT EXISTS produtos(
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(150) NOT NULL,
    categoria_id INT NOT NULL,
    preco DECIMAL(10,2) NOT NULL,
    quantidade INT NOT NULL,
    estoque_minimo INT NOT NULL,
    FOREIGN KEY (categoria_id) REFERENCES categorias(id)
)";
$pdo->exec($sql);

$mensagem = "";

// 2. Cadastrar produto 
if (isset($_POST["cadastrar"])) {
    $nome = trim($_POST["nome"]);
    $categoria_id = (int) $_POST["categoria_id"];
    $preco = (float) $_POST["preco"];
    $quantidade = (int) $_POST["quantidade"];
    $estoque_minimo = (int) $_POST["estoque_minimo"];

    if ($nome == "" || $categoria_id <= 0 || $preco <= 0 || $quantidade < 0 || $estoque_minimo < 0) {
        $mensagem = "Erro: Preencha todos os campos corretamente (preço maior que zero e quantidades não negativas).";
    } else {
        $nome = $pdo->quote($nome);
        $sql = "INSERT INTO produtos (nome, categoria_id, preco, quantidade, estoque_minimo) 
                VALUES ($nome, $categoria_id, $preco, $quantidade, $estoque_minimo)";
        $pdo->exec($sql);
        $mensagem = "Produto cadastrado com sucesso!";
    }
}

// 3. Atualizar produto 
if (isset($_POST["atualizar"])) {
    $id = (int) $_POST["id"];
    $nome = trim($_POST["nome"]);
    $categoria_id = (int) $_POST["categoria_id"];
    $preco = (float) $_POST["preco"];
    $quantidade = (int) $_POST["quantidade"];
    $estoque_minimo = (int) $_POST["estoque_minimo"];

    if ($nome == "" || $categoria_id <= 0 || $preco <= 0 || $quantidade < 0 || $estoque_minimo < 0) {
        $mensagem = "Erro: Dados inválidos para atualização.";
    } else {
        $nome = $pdo->quote($nome);
        $sql = "UPDATE produtos 
                SET nome = $nome, categoria_id = $categoria_id, preco = $preco, quantidade = $quantidade, estoque_minimo = $estoque_minimo 
                WHERE id = $id";
        $pdo->exec($sql);
        $mensagem = "Produto atualizado com sucesso!";
    }
}

// 4. Reposição de estoque 
if (isset($_POST["repor"])) {
    $produto_id = (int) $_POST["produto_id"];
    $qtd_adicionar = (int) $_POST["qtd_adicionar"];

    if ($produto_id <= 0 || $qtd_adicionar <= 0) {
        $mensagem = "Erro: Selecione um produto e informe uma quantidade maior que zero para repor.";
    } else {
        $sql = "UPDATE produtos SET quantidade = quantidade + $qtd_adicionar WHERE id = $produto_id";
        $pdo->exec($sql);
        $mensagem = "Estoque reposto com sucesso (+$qtd_adicionar unidades)!";
    }
}

// 5. Excluir produto com bloqueio se houver vendas 
if (isset($_POST["excluir"])) {
    $id = (int) $_POST["id"];

    $stmtVendas = $pdo->query("SELECT * FROM vendas WHERE produto_id = $id");
    $vendasProduto = $stmtVendas->fetchAll(PDO::FETCH_ASSOC);

    if (count($vendasProduto) > 0) {
        $mensagem = "Este produto possui vendas registradas e não pode ser removido!";
    } else {
        $sql = "DELETE FROM produtos WHERE id = $id";
        $pdo->exec($sql);
        $mensagem = "Produto excluído com sucesso!";
    }
}

// 6. Buscar produto para edição 
$produtoEditar = NULL;
if (isset($_GET["editar"])) {
    $id = (int) $_GET["editar"];
    $sql = "SELECT * FROM produtos WHERE id = $id";
    $stmt = $pdo->query($sql);
    $produtoEditar = $stmt->fetch(PDO::FETCH_ASSOC);
}

// 7. Buscar categorias para o formulário e filtro
$stmtCat = $pdo->query("SELECT * FROM categorias ORDER BY nome ASC");
$categorias = $stmtCat->fetchAll(PDO::FETCH_ASSOC);

// 8. Buscar todos os produtos 
$stmtTodos = $pdo->query("SELECT * FROM produtos ORDER BY nome ASC");
$todosProdutos = $stmtTodos->fetchAll(PDO::FETCH_ASSOC);

// 9. Listar produtos, pesquisa e filtros 
$sql = "SELECT 
        produtos.id,
        produtos.nome,
        produtos.preco,
        produtos.quantidade,
        produtos.estoque_minimo,
        categorias.nome AS nome_categoria
        FROM produtos
        INNER JOIN categorias ON produtos.categoria_id = categorias.id
        WHERE 1=1";

if (isset($_GET["busca"]) && $_GET["busca"] != "") {
    $busca = $pdo->quote("%" . $_GET["busca"] . "%");
    $sql .= " AND produtos.nome LIKE $busca";
}

if (isset($_GET["categoria"]) && $_GET["categoria"] != "") {
    $catFiltro = (int) $_GET["categoria"];
    $sql .= " AND produtos.categoria_id = $catFiltro";
}

if (isset($_GET["estoque_baixo"])) {
    $sql .= " AND produtos.quantidade <= produtos.estoque_minimo";
}

if (isset($_GET["ordem"]) && $_GET["ordem"] == "menor") {
    $sql .= " ORDER BY produtos.preco ASC";
} elseif (isset($_GET["ordem"]) && $_GET["ordem"] == "maior") {
    $sql .= " ORDER BY produtos.preco DESC";
} else {
    $sql .= " ORDER BY produtos.id ASC";
}

$stmt = $pdo->query($sql);
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="atv3.css">
    <title>INFOTECH - Produtos</title>
</head>
<body>

    <header>
        <div class="logo">
            <h2>Eduardo <span>Augusto</span></h2>
        </div>
        <nav>
            <a href="../index.php">Início</a>
            <a href="produtos.php">Produtos</a>
            <a href="categorias.php">Categorias</a>
            <a href="vendas.php">Vendas</a>
            <a href="relatorios.php">Relatórios</a>
        </nav>
    </header>

    <section class="dados-banco">
        <h1>Sistema de Cadastro de Produtos</h1>

        <?php if ($mensagem != "") { ?>
            <p><?= $mensagem ?></p>
        <?php } ?>

        <h2>
            <?php
            if ($produtoEditar) {
                echo "Editar Produto";
            } else {
                echo "Cadastrar Produto";
            }
            ?>
        </h2>

        <form method="POST">
            <?php if ($produtoEditar) { ?>
                <input type="hidden" name="id" value="<?= $produtoEditar['id'] ?>">
            <?php } ?>

            <label>Nome do Produto:</label>
            <input type="text" name="nome" required maxlength="150" value="<?= htmlspecialchars($produtoEditar['nome'] ?? '') ?>">
            <br><br>

            <label>Categoria:</label>
            <select name="categoria_id" required>
                <option value="">Selecione uma categoria</option>
                <?php foreach ($categorias as $cat) { ?>
                    <option value="<?= $cat['id'] ?>" <?php if ($produtoEditar && $produtoEditar['categoria_id'] == $cat['id']) echo "selected"; ?>>
                        <?= htmlspecialchars($cat['nome']) ?>
                    </option>
                <?php } ?>
            </select>
            <br><br>

            <label>Preço:</label>
            <input type="number" name="preco" step="0.01" min="0.01" required value="<?= $produtoEditar['preco'] ?? '' ?>">
            <br><br>

            <label>Quantidade:</label>
            <input type="number" name="quantidade" min="0" required value="<?= $produtoEditar['quantidade'] ?? '' ?>">
            <br><br>

            <label>Estoque Mínimo:</label>
            <input type="number" name="estoque_minimo" min="0" required value="<?= $produtoEditar['estoque_minimo'] ?? '' ?>">
            <br><br>

            <?php if ($produtoEditar) { ?>
                <button type="submit" name="atualizar">Atualizar Produto</button>
                <a href="produtos.php">Cancelar Edição</a>
            <?php } else { ?>
                <button type="submit" name="cadastrar">Cadastrar Produto</button>
            <?php } ?>
        </form>

        <hr>

        <h2>Reposição de Estoque</h2>
        <form method="POST">
            <label>Produto:</label>
            <select name="produto_id" required>
                <option value="">Selecione um produto</option>
                <?php foreach ($todosProdutos as $item) { ?>
                    <option value="<?= $item['id'] ?>">
                        <?= htmlspecialchars($item['nome']) ?> (Atual: <?= $item['quantidade'] ?>)
                    </option>
                <?php } ?>
            </select>
            <br><br>

            <label>Unidades a adicionar:</label>
            <input type="number" name="qtd_adicionar" min="1" required>
            <br><br>

            <button type="submit" name="repor">Adicionar ao Estoque</button>
        </form>

        <hr>

        <h2>Pesquisar e Filtrar</h2>
        <form method="GET">
            <label>Nome do Produto:</label>
            <input type="text" name="busca" value="<?= htmlspecialchars($_GET['busca'] ?? '') ?>">
            <br><br>

            <label>Categoria:</label>
            <select name="categoria">
                <option value="">Todas</option>
                <?php foreach ($categorias as $cat) { ?>
                    <option value="<?= $cat['id'] ?>" <?php if (isset($_GET['categoria']) && $_GET['categoria'] == $cat['id']) echo "selected"; ?>>
                        <?= htmlspecialchars($cat['nome']) ?>
                    </option>
                <?php } ?>
            </select>
            <br><br>

            <label>Ordenar por preço:</label>
            <select name="ordem">
                <option value="">Padrão</option>
                <option value="menor" <?php if (isset($_GET['ordem']) && $_GET['ordem'] == 'menor') echo "selected"; ?>>Menor preço</option>
                <option value="maior" <?php if (isset($_GET['ordem']) && $_GET['ordem'] == 'maior') echo "selected"; ?>>Maior preço</option>
            </select>
            <br><br>

            <label>Somente estoque baixo:</label>
            <input type="checkbox" name="estoque_baixo" <?php if (isset($_GET['estoque_baixo'])) echo "checked"; ?>>
            <br><br>

            <button type="submit">Filtrar</button>
            <a href="produtos.php">Limpar Filtros</a>
        </form>

        <hr>

        <h2>Produtos Cadastrados</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Categoria</th>
                <th>Preço</th>
                <th>Quantidade</th>
                <th>Estoque Mínimo</th>
                <th>Situação</th>
                <th>Ações</th>
            </tr>
            <?php foreach ($produtos as $produto) { ?>
                <tr>
                    <td><?= $produto['id'] ?></td>
                    <td><?= htmlspecialchars($produto["nome"]) ?></td>
                    <td><?= htmlspecialchars($produto["nome_categoria"]) ?></td>
                    <td>R$ <?= number_format($produto["preco"], 2, ",", ".") ?></td>
                    <td><?= $produto["quantidade"] ?></td>
                    <td><?= $produto["estoque_minimo"] ?></td>
                    <td>
                        <?php
                        if ($produto["quantidade"] == 0) {
                            echo "ESGOTADO";
                        } elseif ($produto["quantidade"] <= $produto["estoque_minimo"]) {
                            echo "ESTOQUE BAIXO";
                        } else {
                            echo "DISPONÍVEL";
                        }
                        ?>
                    </td>
                    <td>
                        <a href="produtos.php?editar=<?= $produto['id'] ?>">Editar</a>

                        <form method="POST" action="produtos.php">
                            <input type="hidden" name="id" value="<?= $produto['id'] ?>">
                            <button type="submit" name="excluir" onclick="return confirm('Deseja excluir este produto?')">
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