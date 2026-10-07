<?php
    //1caminho do arquivo
    $arquivo = __DIR__. "/dados/teste.json";

    //2. ler o arquivo json
    $conteudo = file_get_contents($arquivo);

    //3. Transformar o json em array php
    $alunos = json_decode($conteudo, true);

    //4. Percorrer os alunos
    foreach($alunos as $aluno){
        if($aluno["nome"] == "maria"){
    //5. alterar dados
            $aluno["idade"] = 15;
        }
    }
    //6. transforma arrayphp em json novamente
    $json = json_encode($alunos,
    JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    //7. Salvar no arquivo

    file_put_contents($arquivo, $json);
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