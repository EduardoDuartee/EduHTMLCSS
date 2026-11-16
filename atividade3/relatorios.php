<?php
require_once "../conexao.php";

$stmt = $pdo->query("SELECT COUNT(*) AS total FROM produtos");
$totalProdutos = $stmt->fetch(PDO::FETCH_ASSOC)["total"] ?? 0;


$stmt = $pdo->query("SELECT SUM(quantidade) AS total FROM produtos");
$totalUnidades = $stmt->fetch(PDO::FETCH_ASSOC)["total"] ?? 0;


$stmt = $pdo->query("SELECT SUM(preco * quantidade) AS total FROM produtos");
$valorEstoque = $stmt->fetch(PDO::FETCH_ASSOC)["total"] ?? 0;


$stmt = $pdo->query("SELECT COUNT(*) AS total FROM produtos WHERE quantidade <= estoque_minimo");
$estoqueBaixo = $stmt->fetch(PDO::FETCH_ASSOC)["total"] ?? 0;


$stmt = $pdo->query("SELECT COUNT(*) AS total FROM vendas");
$totalVendas = $stmt->fetch(PDO::FETCH_ASSOC)["total"] ?? 0;

$stmt = $pdo->query("SELECT SUM(valor_total) AS total FROM vendas");
$faturamentoTotal = $stmt->fetch(PDO::FETCH_ASSOC)["total"] ?? 0;


$sqlRanking = "SELECT 
               produtos.nome,
               SUM(vendas.quantidade) AS total_vendido
               FROM vendas
               INNER JOIN produtos ON vendas.produto_id = produtos.id
               GROUP BY produtos.id, produtos.nome
               ORDER BY total_vendido DESC
               LIMIT 5";
$stmtRanking = $pdo->query($sqlRanking);
$maisVendidos = $stmtRanking->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="atv3.css">
    <title>Relatórios</title>
</head>
<body>

    <header>
        <div class="logo">
            <h2>Eduardo <span>Augusto</span></h2>
        </div>
        <nav>
            <a href="../index.php">Início</a>
            <a href="produtos.php">Produtos</a>
            <a href="categoria.php">Categorias</a>
            <a href="vendas.php">Vendas</a>
            <a href="relatorios.php">Relatórios</a>
        </nav>
    </header>

    <section class="dados-banco">
        <h1>Relatórios da Loja</h1>

        <h2>Resumo Geral</h2>
        <table>
            <tr>
                <th>Descrição</th>
                <th>Resultado</th>
            </tr>
            <tr>
                <td>Produtos diferentes cadastrados</td>
                <td><?= $totalProdutos ?></td>
            </tr>
            <tr>
                <td>Total de unidades em estoque</td>
                <td><?= $totalUnidades ?></td>
            </tr>
            <tr>
                <td>Valor financeiro total do estoque</td>
                <td>R$ <?= number_format($valorEstoque, 2, ",", ".") ?></td>
            </tr>
            <tr>
                <td>Produtos com estoque baixo</td>
                <td><?= $estoqueBaixo ?></td>
            </tr>
            <tr>
                <td>Total de vendas realizadas</td>
                <td><?= $totalVendas ?></td>
            </tr>
            <tr>
                <td>Valor total faturado</td>
                <td>R$ <?= number_format($faturamentoTotal, 2, ",", ".") ?></td>
            </tr>
        </table>

        <hr>

        <h2>Top 5 Produtos Mais Vendidos</h2>
        <table>
            <tr>
                <th>Posição</th>
                <th>Produto</th>
                <th>Unidades Vendidas</th>
            </tr>
            <?php
            $posicao = 1;
            foreach ($maisVendidos as $item) {
            ?>
                <tr>
                    <td><?= $posicao ?>º</td>
                    <td><?= $item['nome'] ?></td>
                    <td><?= $item['total_vendido'] ?></td>
                </tr>
            <?php
                $posicao++;
            }
            ?>
        </table>
    </section>

</body>
</html>