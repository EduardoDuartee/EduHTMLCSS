<?php
    //caminho do arquivo
    $arquivo = __DIR__. "../dados/teste.json";

    //1. ler o arquivo json
    $conteudo = file_get_contents($arquivo);

    //2. Transformar o json em array php
    $alunos = json_decode($conteudo, true);

    //3. percorrrer todos os alunos
    //para cada aluno dentro de alunos, guarde a posição dele em $posicao e os dados do $aluno
     foreach($alunos as $posicao =>$aluno){
        //4. procurar o nome de maria 
        if($aluno["nome"] == "maria"){
        //5. excuir o nome
        unset($aluno[$posicao]);
        }
    }

    //6. reogarnizar as posições do array

    //7. transformar em array dnv
    $json = json_encode($alunos,
    JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    //8. Salvar o arquivo
    file_put_contents($arquivo,$json);

    echo"Aluno Excluido"
?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>