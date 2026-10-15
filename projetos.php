<?php
    $jsonFile = 'projetos.json'; $projetos = [];

    if (file_exists($jsonFile)){
        $conteudo = file_get_contents($jsonFile);
        $projetos = json_decode($conteudo, true) ?? [];
    }

    //vagas do carrossel
    $totalCards =6;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/projetos.css">
    <title>Projetos</title>
</head>
<body>

        <div class="Nav-bar">
            <img src="../imgHtml/Gemini_Generated_Image_5kpxl15kpxl15kpx-removebg-preview.png" alt="">
            <a href="../index.php">INICIO</a>
            <a href="orcamento.php">ORÇAMENTO</a>
            <a href="financeiro.php">FINANCEIRO</a>
            <a href="juridico.php">JURIDICO</a>
            <a href="projetos.php">PROJETOS</a>
            <a href="desenvolvimento.php">DESENVOLVIMENTO</a>
        </div><!--Nav-bar-->


    <section id="projetos" class="projetos-secao">
        <div class="projetos">
            <?php for ($i = 0; $i < $totalCards; $i++): 
                $numeroFormatado = str_pad($i + 1, 2, '0', STR_PAD_LEFT);
                $temProjeto = isset($projetos[$i]);
            ?>
                <div class="card">
                    <div class="numero-projeto"><?= $numeroFormatado; ?></div>

                    <?php if ($temProjeto): ?>
                        <h3><?= htmlspecialchars($projetos[$i]['titulo'] ?? ''); ?></h3>
                        <p><?= htmlspecialchars($projetos[$i]['descricao'] ?? ''); ?></p>

                        <div class="tecnologias">
                            <?php if (!empty($projetos[$i]['tecnologias']) && is_array($projetos[$i]['tecnologias'])): ?>
                                <?php foreach($projetos[$i]['tecnologias'] as $tech): ?>
                                    <span><?= htmlspecialchars($tech); ?></span> 
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>

                        <a href="<?= htmlspecialchars($projetos[$i]['link'] ?? '#'); ?>">Ver Projeto</a>

                    <?php else: ?>
                        <h3>Faça Parte da Nossa História</h3>
                        <p>Seu projeto exibido aqui</p>

                        <div class="tecnologias">
                            <span>HTML</span>
                            <span>CSS</span>
                        </div>
                        <a href="dados-json.php">Ver Projetos</a>
                    <?php endif; ?>
                </div><!-- .card -->
            <?php endfor; ?>
        </div><!-- .projetos -->       
    </section>
     <script src="../projetos.js"></script> 
</body>
</html>