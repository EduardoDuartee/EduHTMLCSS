
<?php
require_once "../conexao.php";

// 1. Criar tabela

$sql = "CREATE TABLE IF NOT EXISTS vendas(
    id INT AUTO_INCREMENT PRIMARY KEY,
    produto_id INT NOT NULL,
    quantidade INT NOT NULL,
    valor_total DECIMAL(10,2) NOT NULL,
    data_venda DATETIME NOT NULL,
    FOREIGN KEY (produto_id) REFERENCES produtos(id)
)";

$pdo->exec($sql);


// 2. Cadastrar venda

if (isset($_POST["cadastrar"])) {

    $produto_id = $_POST["produto_id"];
    $quantidade = $_POST["quantidade"];
    $valor_total = $_POST["valor_total"];
    $data_venda = $_POST["data_venda"];
    $sql = "INSERT INTO vendas
    (produto_id, quantidade, valor_total, data_venda)
    VALUES ($produto_id, $quantidade, $valor_total, '$data_venda')";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
}


// 3. Atualizar venda

if (isset($_POST["atualizar"])) {

    $id = $_POST["id"];
    $produto_id = $_POST["produto_id"];
    $quantidade = $_POST["quantidade"];
    $valor_total = $_POST["valor_total"];
    $data_venda = $_POST["data_venda"];
    $sql = "UPDATE vendas SET
    produto_id = $produto_id,
    quantidade = $quantidade,
    valor_total = $valor_total,
    data_venda = '$data_venda'
    WHERE id = $id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
}


// 4. Excluir venda

if (isset($_POST["excluir"])) {
    $id = $_POST["id"];
    $sql = "DELETE FROM vendas WHERE id = $id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
}


// 5. Buscar venda para edição

$vendaEditar = NULL;

if (isset($_GET["editar"])) {
    $id = $_GET["editar"];
    $sql = "SELECT * FROM vendas WHERE id = $id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $vendaEditar = $stmt->fetch(PDO::FETCH_ASSOC);
}


// 6. Buscar produtos para o Dropdown
$sql = "SELECT * FROM produtos";
$stmt = $pdo->query($sql);
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);


// 7. Listar todas as vendas

$sql = "SELECT
    vendas.id,
    produtos.nome,
    vendas.quantidade,
    vendas.valor_total,
    vendas.data_venda

    FROM vendas
    INNER JOIN produtos
    ON vendas.produto_id = produtos.id
    ORDER BY vendas.id ASC";

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
        if ($vendaEditar) {
            echo "Editar Venda";
        } else {
            echo "Cadastrar Venda";
        }
        ?>
    </h2>


    <form method="POST">
        <?php if ($vendaEditar) { ?>
            <input type="hidden" name="id"
            value="<?= $vendaEditar['id'] ?>">
        <?php } ?>

         <label>Produto:</label>
        <select name="produto_id" required>
            <option value="">Selecione um Produto</option>
            <?php foreach ($produtos as $produto) { ?>

                <option value="<?= $produto['id'] ?>"
                <?= (
                    isset($vendaEditar['produto_id']) &&
                    $vendaEditar['produto_id'] == $produto['id']
                ) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($produto['nome']) ?>
                </option>
            <?php } ?>

        </select>
        <br><br>
        <label>Quantidade:</label>
        <input type="number" name="quantidade" required
        value="<?= $vendaEditar['quantidade'] ?? '' ?>">
        <br><br>
        <label>Valor Total:</label>
        <input type="number" name="valor_total"
        step="0.01" required
        value="<?= $vendaEditar['valor_total'] ?? '' ?>">
        <br><br>
        <label>Data da Venda:</label>
        <input type="datetime-local" name="data_venda" requiredvalue="<?= isset($vendaEditar['data_venda'])
        ? date('Y-m-d\TH:i', strtotime($vendaEditar['data_venda'])): '' ?>">

        <br><br>


        <?php if ($vendaEditar) { ?>

            <button type="submit" name="atualizar"> Atualizar Venda</button>
            <?php } else { ?>
            <button type="submit" name="cadastrar">Cadastrar Venda</button>
        <?php } ?>
    </form>
    <hr>
    <h2>Vendas Cadastradas</h2>
    <table>

        <tr>
            <th>ID</th>
            <th>Produto</th>
            <th>Quantidade</th>
            <th>Valor Total</th>
            <th>Data da Venda</th>
            <th>Ações</th>
        </tr>

        <?php foreach ($vendas as $venda) { ?>
            <tr>
                <td><?= $venda['id'] ?></td>
                <td><?= htmlspecialchars($venda['nome']) ?></td>
                <td><?= $venda['quantidade'] ?></td>
                <td>
                    R$ <?= number_format($venda['valor_total'], 2, ",", ".") ?>
                </td>

                <td>
                    <?= date('d/m/Y H:i',strtotime($venda['data_venda'])) ?>
                </td>

                <td>
                    <a href="vendas.php?editar=<?= $venda['id'] ?>">Editar</a>
                    <form method="POST" action="vendas.php"
                    style="display:inline;">
                        <input type="hidden" name="id"
                        value="<?= $venda['id'] ?>">
                        <button type="submit" name="excluir"
                        onclick="return confirm('Deseja excluir esta venda?')">Excluir</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </table>
</section>

</body>
</html>
