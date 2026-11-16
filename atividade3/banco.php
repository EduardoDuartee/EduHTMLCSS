<?php
require_once "../conexao.php";

// Total de produtos cadastrados
$stmt = $pdo->query("SELECT COUNT(*) AS total FROM produtos");
$totalProdutos = $stmt->fetch(PDO::FETCH_ASSOC)["total"] ?? 0;

// Produtos com estoque baixo
$stmt = $pdo->query("SELECT COUNT(*) AS total FROM produtos WHERE quantidade <= estoque_minimo");
$estoqueBaixo = $stmt->fetch(PDO::FETCH_ASSOC)["total"] ?? 0;

// Total de vendas realizadas
$stmt = $pdo->query("SELECT COUNT(*) AS total FROM vendas");
$totalVendas = $stmt->fetch(PDO::FETCH_ASSOC)["total"] ?? 0;

// Faturamento total
$stmt = $pdo->query("SELECT SUM(valor_total) AS total FROM vendas");
$faturamento = (float) ($stmt->fetch(PDO::FETCH_ASSOC)["total"] ?? 0);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="atv3.css">
    <title>INFOTECH - Início</title>
</head>
<body>

    <header>
        <div class="logo">
            <h2>Eduardo <span>Augusto</span></h2>
        </div>
        <nav>
            <a href="index.php">Início</a>
            <a href="produtos.php">Produtos</a>
            <a href="categorias.php">Categorias</a>
            <a href="vendas.php">Vendas</a>
            <a href="relatorios.php">Relatórios</a>
        </nav>
    </header>

    <section class="dados-banco">
        <h1>Painel Inicial - Loja de Informática</h1>
        <h2>Resumo da Loja</h2>

        <table>
            <tr>
                <th>Indicador</th>
                <th>Valor</th>
            </tr>
            <tr>
                <td>Total de Produtos Cadastrados</td>
                <td><?= $totalProdutos ?></td>
            </tr>
            <tr>
                <td>Produtos com Estoque Baixo ou Esgotado</td>
                <td><?= $estoqueBaixo ?></td>
            </tr>
            <tr>
                <td>Total de Vendas Realizadas</td>
                <td><?= $totalVendas ?></td>
            </tr>
            <tr>
                <td>Faturamento Total</td>
                <td>R$ <?= number_format($faturamento, 2, ",", ".") ?></td>
            </tr>
        </table>
    </section>

</body>
</html>