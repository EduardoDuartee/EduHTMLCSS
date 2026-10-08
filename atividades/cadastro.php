<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $nome = $_POST["nome"];
        $categoria = $_POST["categoria"];
        $marca = $_POST["marca"];
        $preco = $_POST["preco"];
        $quantidade = $_POST["quantidade"];
        $fabricanteNome = $_POST["fabricanteNome"];
        $pais = $_POST["pais"];

        $novoProduto = [
            "nome" => $nome,
            "categoria" => $categoria,
            "marca" => $marca,
            "preco" => $preco,
            "quantidade" => $quantidade,
            "fabricante" =>[
                "fabricanteNome" => $fabricanteNome,
                "pais" => $pais
            ]

            ];
            //abrir ler arquivo
            $conteudoJson = file_get_contents(__DIR__ . "../dados/cadastro-de-produtos.json");

            $produtos = json_decode($conteudoJson, true);
            //adiconar cadastro
            $produtos[] = $novoProduto;

            //array php json

            $jsonAtualizado = json_encode(
                $produtos,
                JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
            );

            //Salvando em json
            file_put_contents(__DIR__ . "/dados/cadastro-de-produtos.json", $jsonAtualizado);

            //ler  os arquivos json
            $conteudoJson = file_get_contents(__DIR__ . "../dados/cadastro-de-produtos.json");
            $produtos = json_decode($conteudoJson, true);

    }
            $conteudoJson = file_get_contents(__DIR__ . "../dados/cadastro-de-produtos.json");
            $produtos = json_decode($conteudoJson, true);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/cad.css">
    <title>Cadastro produtos</title>
</head>
<body>
    <header>
        <div class="logo">
            <h2>Eduardo <span>Augusto</span></h2>
        </div>
        <nav>
            <a href="../index.php">Inicio</a>
        <a href="../index.php#sobre">Sobre</a>
        <a href="../index.php#projetos">Projetos</a>
        <a href="../index.php#contatos">Contato</a>
        </nav>
    </header>
    <main>

        <!--CADASTRAR-->

        <section class="intro-form">
            <div class="intro">
                <h2>FORMULARIO DE CADASTRO</h2>
            </div>
            <div class="formulario">
                <form method="POST">
                    <div class="card-container">
                        <div class="form-card">
                            <label>NOME:</label>
                            <input type="text" name="nome" class="boxes">
                            <label>CATEGORIA:</label>
                            <input type="text" name="categoria" class="boxes">
                            <label>MARCA:</label>
                            <input type="text" name="marca" class="boxes">
                        </div>
                        <div class="form-card">
                            <label>PREÇO:</label>
                            <input type="number" name="preco" step="0.1" class="boxes">
                            <label>QUANTIDADE:</label>
                            <input type="number" name="quantidade" class="boxes">
                            <label>NOME DO FABRICANTE:</label>
                            <input type="text" name="fabricanteNome" class="boxes">
                            <label>PAIS:</label>
                            <input type="text" name="pais" class="boxes">
                        </div>
                    </div>

                    <button type="submit" class="boton">FINALIZAR CADASTRO</button>
                </form>
            </div>
        </section> <!--introform section-->

        <!--CADASTRADOS-->

        <section class="cadastrados">
            <div class="intro-cadastrados">
                <h1>PRODUTOS CADASTRADOS</h1>
            </div>
            <div class="cards">
                <?php foreach ($produtos as $produto) {  ?>
                    <div class="card-produto">
                        <h2>PRODUTO:</h2>
                        <h2>Nome: <?= $produto["nome"] ?> </h2>
                        <p>Categoria: <?= $produto["categoria"] ?> </p>
                        <p>Marca: <?= $produto["marca"] ?> </p>
                        <p>Preço: <?= $produto["preco"] ?> </p>
                        <p>Quantidade; <?= $produto["quantidade"] ?> </p>
                        <h3>FABRICANTE:</h3>
                        <p>Fabricante: <?= $produto["fabricante"]["fabricanteNome"] ?> </p>
                        <p>Pais: <?= $produto["fabricante"]["pais"] ?> </p>
                        <h3> VALOR NO ESTOQUE: </h3>
                        <p>Valor:<?= (float)$produto["preco"] * (int)$produto["quantidade"] ?> </p>
                    </div>
            </div>
        <?php } ?>
        </section>
    </main>
</body>
</html>