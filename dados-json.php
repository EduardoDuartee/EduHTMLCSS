<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){ //verifica se o formulario foi enviado usando metodo post
        $nome = $_POST["nome"];
        $idade = $_POST["idade"];
     
        // Recebe as Notas  portugues
        $portugues_prova1 =  $_POST["portugues_prova1"];
        $portugues_prova2 =  $_POST["portugues_prova2"];
        $portugues_prova3 =  $_POST["portugues_prova3"];
     
        // Recebe as Notas matematica
        $matematica_prova1 =  $_POST["matematica_prova1"];
        $matematica_prova2 =  $_POST["matematica_prova2"];
        $matematica_prova3 =  $_POST["matematica_prova3"];
     
        // Recebe as Notas historia
        $historia_prova1 =  $_POST["historia_prova1"];
        $historia_prova2 =  $_POST["historia_prova2"];
        $historia_prova3 =  $_POST["historia_prova3"];
        //==========================================================
        //organizar dados em uma array
        //==========================================================
        $novoAluno = [
            "nome" => $nome,
            "idade" =>$idade,

            "notas" => [
                "portugues" =>[
                    "prova1"=> $portugues_prova1,
                    "prova2"=> $portugues_prova2,
                    "prova3"=> $portugues_prova3,
                ],
                "matematica" =>[
                    "prova1"=> $matematica_prova1,
                    "prova2"=> $matematica_prova2,
                    "prova3"=> $matematica_prova3,
                ],
                "historia" =>[
                    "prova1"=> $historia_prova1,
                    "prova2"=> $historia_prova2,
                    "prova3"=> $historia_prova3,
                ],
            ]
        ];

        //serve para ler/abrir arqui json

        $conteudoJson =file_get_contents(__DIR__ . "/dados/intro.json");

        //serve para converte json para array php
        // o true serve para converter o json em array associativo para o php ler

        $alunos = json_decode($conteudoJson, true);

        //adicionar o novo aluno no armazenamento

        $alunos[] = $novoAluno;

        //converter o array php para json

        $jsonAtualizado = json_encode(
            $alunos,
            JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
            //formata a ambientação  | 
        );

        //salvar no arquivo json

        file_put_contents(__DIR__ . "/dados/intro.json", $jsonAtualizado);
    }

    //leitura dos dados para exibição
    $conteudoJson = file_get_contents(__DIR__ . "/dados/intro.json");

    //converte json para array php

    $alunos = json_decode($conteudoJson, true);

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dados.css">
    <title>json</title>
</head>

<header>
    <div class="logo">
        <h2>Eduardo <span>Augusto</span></h2>
    </div>
    <nav>
        <a href=" index.php">inicio</a>
        <a href="#sobre">Sobre</a>
        <a href="#projetos">Projetos</a>
        <a href="#contato">Contato</a>
        
    </nav>
    </header>

<body>
    <section class="dados">
    <h1>Cadastro de Notas</h1>
    <form method="POST">
        <label for="Nome">Nome:</label>
        <input type="text" name="nome" required>
        <br><br>

        <label for="idade">Idade</label>
        <input type="number" name="idade" required>
<!--==========================================================================================-->
        <h2>Portugues</h2>
        <label>Prova 01:</label>
        <input type="number" name="portugues_Prova1" min="0" max="10" step="0.1" required>
        <br><br>
        <label>Prova 02:</label>
        <input type="number" name="portugues_Prova2" min="0" max="10" step="0.1" required>
        <br><br>
        <label>Prova 03:</label>
        <input type="number" name="portugues_Prova3" min="0" max="10" step="0.1" required>
        <br><br>
<!--==========================================================================================-->
        <h2>Matematica</h2>
        <label>Prova 01:</label>
        <input type="number" name="matematica_Prova1" min="0" max="10" step="0.1" required>
        <br><br>
        <label>Prova 02:</label>
        <input type="number" name="matematica_Prova2" min="0" max="10" step="0.1" required>
        <br><br>
        <label>Prova 03:</label>
        <input type="number" name="matematica_Prova3" min="0" max="10" step="0.1" required>
        <br><br>
<!--==========================================================================================-->
        <h2>Historia</h2>
        <label>Prova 01:</label>
        <input type="number" name="historia_Prova1" min="0" max="10" step="0.1" required>
        <br><br>
        <label>Prova 02:</label>
        <input type="number" name="historia_Prova2" min="0" max="10" step="0.1" required>
        <br><br>
        <label>Prova 03:</label>
        <input type="number" name="historia_Prova3" min="0" max="10" step="0.1" required>
        <br><br>
            <button type="submit" class="botao"> cadastro</button>  
    </form>
    </section>

    <h1>ALUNOS CADASTRADOS</h1>
        <?php foreach ($alunos as $aluno) { ?>
            <h2> <? $aluno["nome"] ?> </h2>
            <p>idade: <?$aluno["idade"] ?></p>

        <!-- portugues-->
         <h2>Portugues</h2>
         <p>PROVA01: <?=  $aluno ["notas"]["portugues"]["prova1"] ?></p>
         <p>PROVA02: <?=  $aluno ["notas"]["portugues"]["prova2"] ?></p>
         <p>PROVA03: <?=  $aluno ["notas"]["portugues"]["prova3"] ?></p>


         <!-- matematica-->
         <h2>Matematica</h2>
         <p>PROVA01: <?=  $aluno ["notas"]["matematica"]["prova1"] ?></p>
         <p>PROVA02: <?=  $aluno ["notas"]["matematica"]["prova2"] ?></p>
         <p>PROVA03: <?=  $aluno ["notas"]["matematica"]["prova3"] ?></p>


         <!-- Historia-->
         <h2>Historia</h2>
         <p>PROVA01: <?=  $aluno ["notas"]["historia"]["prova1"] ?></p>
         <p>PROVA02: <?=  $aluno ["notas"]["historia"]["prova2"] ?></p>
         <p>PROVA03: <?=  $aluno ["notas"]["historia"]["prova3"] ?></p>









        <?php } ?>
    
    
</body>
</html>