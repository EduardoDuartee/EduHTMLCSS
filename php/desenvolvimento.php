<?php 

$arquivo = __DIR__ . "/orcamento.json";

$orcamentos = [];

if(file_exists($arquivo)){
    $orcamentos = json_decode(file_get_contents($arquivo), true);
}

$arquivoProjetos = __DIR__ . "/projetos.json";

$projetos = [];

if(file_exists($arquivoProjetos)){
    $projetos = json_decode(file_get_contents($arquivoProjetos), true);
}
foreach($orcamentos as $orcamento){
    $encontrado = false;

    foreach($projetos as $projeto){
        if($projeto["nome"] == $orcamento["nome"]){
            $encontrado = true;
        }
    }

    if($encontrado == false){
        $orcamento["status"] = "pendente";
        $projetos[] = $orcamento;
    }
}

file_put_contents($arquivoProjetos, json_encode($projetos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));


if($_SERVER["REQUEST_METHOD"] == "POST"){

$indice = (int) $_POST["indice"];
$status = $_POST["status"];

if(count($orcamentos) > $indice && $indice >= 0){
    if($status == "pendente" || $status == "em desenvolvimento" || $status == "concluido"){
        $orcamentos[$indice]["status"] = $status;

        file_put_contents($arquivo, json_encode($orcamentos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    };

    $projetosConcluidos = __DIR__ . "/../concluidos.json";
    $concluidos = [];

    foreach($orcamentos as $orcamento){
        if($orcamento["status"] == "concluido"){
            $concluidos[] = $orcamento;
        }
    }

     file_put_contents($projetosConcluidos, json_encode($concluidos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));






}

$orcamentos = json_decode(file_get_contents($arquivo), true);
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/desenvolvimento.css">
    <title>Document</title>
</head>
<body>

        <div class="Nav-bar">
        <img src="../imgHtml/Gemini_Generated_Image_5kpxl15kpxl15kpx-removebg-preview.png" alt="">
        <a href="../index.php">INICIO</a>
        <a href="orcamento.php">ORÇAMENTO</a>
        <a href="financeiro.php">FINANCEIRO</a>
        <a href="juridico.php">JURIDICO</a>
        <a href="cliente.php">CLIENTES</a>
        <a href="desenvolvimento.php">DESENVOLVIMENTO</a>
    </div><!--Nav-bar-->
    
    <div class="desenvolver">
        <h1>PROJETOS EM DESENVOLVIMENTO</h1>
        <?php if(count($orcamentos) > 0) { ?>
        <?php foreach($orcamentos as $indice => $projeto) { ?>
        <div class="projetos">
            <h2><?= $projeto["nomeProjeto"] ?></h2>
            <p>Empresa:<?= $projeto["empresa"] ?></p>
            <p>Responsável:<?= $projeto["responsavel"] ?></p>
            <p>Descrição:<?= $projeto["projeto"] ?></p>
            <p>Prazo de entrega:<?= $projeto["prazo"] ?></p>
            <p>status atual:<?= $projeto["status"] ?? "pendente" ?></p>
            <form method="POST">
                <input type="hidden" name="indice" value="<?= $indice ?>">
                <label>Alterar status</label>
                <select name="status">
                    <option value="em desenvolvimento">
                        Em desenvolvimento
                    </option>
                    <option value="concluido">
                        Concluído
                    </option>
                </select>
                <button type="submit">Salvar status</button>
            </form>
        </div>
        <?php } ?>
        <?php } else { ?>
        <p>Nenhum projeto cadastrado</p>
        <?php } ?>
    </div>
</body>
</html>