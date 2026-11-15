<?php
require_once "../conexao.php";

$mensagem = "";

// 1. Registrar venda (Parte 7)
if (isset($_POST["vender"])) {
    $produto_id = (int) $_POST["produto_id"];
    $quantidade = (int) $_POST["quantidade"];

    // Impedir vendas com quantidade zero ou negativa
    if ($quantidade <= 0) {
        $mensagem = "Erro: A quantidade vendida deve ser maior que zero.";
    } else {
        // Consultar o produto selecionado no banco de dados
        $sql = "SELECT * FROM produtos WHERE id = $produto_id";
        $stmt = $pdo->query($sql);
        $produto = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verificar preço atual e quantidade disponível no estoque
        $preco = $produto["preco"];
        $estoque_atual = $produto["quantidade"];

        // Impedir a venda caso a quantidade seja maior que o estoque disponível
        if ($quantidade > $estoque_atual) {
            $mensagem = "Erro: Estoque insuficiente! Disponível: $estoque_atual unidades.";
        } else {
            // Calcular automaticamente o valor total da venda
            $valor_total = $preco * $quantidade;

            // Registrar a venda na tabela vendas
            $sqlVenda = "INSERT INTO vendas (produto_id, quantidade, valor_total, data_venda) 
                         VALUES ($produto_id, $quantidade, $valor_total, NOW())";
            $pdo->exec($sqlVenda);

            // Atualizar a quantidade disponível na tabela produtos
            $novo_estoque = $estoque_atual - $quantidade;
            $sqlEstoque = "UPDATE produtos SET quantidade = $novo_estoque WHERE id = $produto_id";
            $pdo->exec($sqlEstoque);

            // Mensagem informando que a venda foi realizada e o valor total
            $valor_formatado = number_format($valor_total, 2, ",", ".");
            $mensagem = "Venda realizada com sucesso! Valor total: R$ $valor_formatado";
        }
    }
}

// 2. Buscar produtos cadastrados para o formulário
$sqlProdutos = "SELECT * FROM produtos ORDER BY nome ASC";
$stmtProdutos = $pdo->query($sqlProdutos);
$produtos = $stmtProdutos->fetchAll(PDO::FETCH_ASSOC);

// 3. Buscar todas as vendas registradas para mostrar na tabela
$sqlVendas = "SELECT 
              vendas.id,
              produtos.nome,
              vendas.quantidade,
              vendas.valor_total,
              vendas.data_venda
              FROM vendas
              INNER JOIN produtos ON vendas.produto_id = produtos.id
              ORDER BY vendas.id DESC";
$stmtVendas = $pdo->query($sqlVendas);
$vendas = $stmtVendas->fetchAll(PDO::FETCH_ASSOC);
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
            <a href="index.php">Início</a>
            <a href="produtos.php">Produtos</a>
            <a href="categoria.php">Categorias</a>
            <a href="vendas.php">Vendas</a>
            <a href="relatorios.php">Relatórios</a>
        </nav>
    </header>

    <section class="dados-banco">
        <h1>Sistema de Vendas</h1>

        <?php if ($mensagem != "") { ?>
            <p><?= $mensagem ?></p>
        <?php } ?>

        <h2>Registrar Venda</h2>

        <form method="POST">
            <label>Produto:</label>
            <select name="produto_id" required>
                <option value="">Selecione um produto</option>
                <?php foreach ($produtos as $produto) { ?>
                    <option value="<?= $produto['id'] ?>">
                        <?= $produto['nome'] ?> - R$ <?= number_format($produto['preco'], 2, ",", ".") ?> (Estoque: <?= $produto['quantidade'] ?>)
                    </option>
                <?php } ?>
            </select>
            <br><br>

            <label>Quantidade:</label>
            <input type="number" name="quantidade" required>
            <br><br>

            <button type="submit" name="vender">Finalizar Venda</button>
        </form>

        <hr>

        <h2>Vendas Registradas</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Produto</th>
                <th>Quantidade</th>
                <th>Valor Total</th>
                <th>Data da Venda</th>
            </tr>

            <?php foreach ($vendas as $venda) { ?>
                <tr>
                    <td><?= $venda['id'] ?></td>
                    <td><?= $venda['nome'] ?></td>
                    <td><?= $venda['quantidade'] ?></td>
                    <td>R$ <?= number_format($venda['valor_total'], 2, ",", ".") ?></td>
                    <td><?= date('d/m/Y H:i', strtotime($venda['data_venda'])) ?></td>
                </tr>
            <?php } ?>
        </table>
    </section>

</body>
</html>