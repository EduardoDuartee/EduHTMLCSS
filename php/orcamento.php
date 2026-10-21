<!--COMITADO POR JOSE-->

<?php
$enviado = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $responsavel = $_POST["responsavel"];
    $empresa = $_POST["empresa"];
    $telefone = $_POST["telefone"];
    $email = $_POST["email"];
    $projeto = $_POST["projeto"];
    $nomeProjeto = $_POST["nomeProjeto"];
    $prazo = $_POST["prazo"];
    $indice = 0;




    $novoOrcamento = [
        "responsavel" => $responsavel,
        "telefone" => $telefone,
        "email" => $email,
        "empresa" => $empresa,
        "nomeProjeto" => $nomeProjeto,
        "projeto" => $projeto,
        "prazo" => $prazo

    ];





    //abrir/ler arquivo json
    $conteudoJson = file_get_contents(__DIR__ . "/orcamento.json");

    $orcamentos = json_decode($conteudoJson, true);
    //adicionar cadastro
    $orcamentos[] = $novoOrcamento;

    //array php to json
    $jsonAtualizado = json_encode(
        $orcamentos,
        JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
    );

    //salvar em json
    file_put_contents(__DIR__ . "/orcamento.json", $jsonAtualizado);
    $enviado = true;
    header("Location: orcamento.php?enviado=1");
    exit;
}

//le o arquivo json
$conteudoJson = file_get_contents(__DIR__ . "/orcamento.json");
$orcamentos = json_decode($conteudoJson, true);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitaçao De Projeto</title>
    <link rel="stylesheet" href="../css/orcamento.css">
</head>

<body>

    <header>
        <div class="Nav-bar">
            <img src="../imgHtml/Gemini_Generated_Image_5kpxl15kpxl15kpx-removebg-preview.png" alt="">
            <a href="../index.php">INICIO</a>
            <a href="orcamento.php">ORÇAMENTO</a>
            <a href="financeiro.php">FINANCEIRO</a>
            <a href="juridico.php">JURIDICO</a>
            <a href="cliente.php">CLIENTES</a>
            <a href="desenvolvimento.php">DESENVOLVIMENTO</a>
        </div>
        <!--Nav-bar-->
    </header>

    <!--solicitacion de projecto-->

    <main>
        <section class="solicitacao">
            <div class="text">
                <h1>Solicitaçao De Projeto</h1>
                <h2>Preencha o formulario para <br> a Solicitaçao do Projeto</h2>
                <h4>(*)obrigatorio</h4>
            </div>

            <div class="card">
                <form method="POST">

                    <div class="linha">
                        <div class="item">
                            <label for="empresa" class="labelText">Empresa*</label>
                            <input type="text" class="inputs" name="empresa" required>
                        </div>

                        <div class="item">
                            <label for="email" class="labelText">Email*</label>
                            <input type="email" class="inputs" name="email" required>
                        </div>
                    </div>


                    <div class="linha">
                        <div class="item">
                            <label for="telefone" class="labelText">Numero de Telefone</label>
                            <input type="tel" class="inputs" name="telefone" required>
                        </div>

                        <div class="item">
                            <label for="responsavel" class="labelText">Responsavel*</label>
                            <input type="text" class="inputs" name="responsavel" required>
                        </div>
                    </div>

                    <div class="linha">
                        <div class="item">
                            <label for="prazo" class="labelText">Prazo/Deadline</label>
                            <input type="text" class="inputs" name="prazo" required>
                        </div>

                        <div class="item">
                            <label for="nomeProjeto" class="labelText">Nome Do Projeto*</label>
                            <input type="text" class="inputs" name="nomeProjeto" required>
                        </div>
                    </div>

                    <div class="item">
                        <label for="projeto" class="labelText">Descriçao do Projeto</label>
                        <textarea name="projeto" id="Projeto" class="pedido" required></textarea>
                    </div>

                    <button type="submit" class="form-button">ENVIAR SOLICITAÇÃO</button>
                </form>
            </div>

        </section>
        <!--solicitacao-->

        <section class="solicitacoes">

            <div class="solicitadas">
                <?php if (isset($_GET["enviado"]) && $_GET["enviado"] == "1") { ?>
                    <div class="resposta">
                        <p> SOLICITAÇÃO ENVIADA COM SUCESSO! </p>
                        <a href="desenvolvimento.php" class="button-solicitacao">VER SITUAÇÃO</a>
                    </div>
                <?php } ?>

            </div>

        </section>
    </main>

    <footer>
        <p>
            DESENVOLVIDO POR <a href="https://jose755.devlook.xyz">CINCO DEVS </a>
        </p>
        <p>
            HTML + CSS + PHP + JSON
        </p>
    </footer>


</body>

</html>