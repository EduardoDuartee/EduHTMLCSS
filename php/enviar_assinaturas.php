<?php 
// RECEBER OS DADOS ENVIADOS VIA POST PELA ABA DE ORÇAMENTOS//
$cliente_nome = $_POST['cliente_nome'] ?? 'Não Informado';
$cliente_doc = $_POST['cliente_doc'] ?? 'Não informado';
$cliete_email = $_POST['cliente_email'] ?? 'exemplo123@gmail.com';
$cliente_telefone = $_POST['cliente_telefone'] ?? '';
$valor_orçamento = $_POST['valor_orçamento'] ?? '0,00';

// PREPARA O ENVIO AUTOMATICO DE E-MAIL //

$assunto = "Seu Contrato de Prestação de Serviços - 5 Devs e um sonho";
$mensagem_email = "Olá $clinete_nome, \n \n Seu contrato no valor de R$ $valor_orçamento foi gerado com sucesso. \nAcesse o site para conferir e assinar.";
$cabecalho = "From: amanda.orlatei.documentos@gmail.com";

// DISPARE O EMAIL EM SEGUNDO PLANO// 
@mail($cliente_email, $assunto, $mensagem_email, $cabecalho); 

// PREPARA O LINK PARA O WHATSAPP COM MESAGEM PRONTO //

$text_wpp = urlencode("Olá $cliente_nome, seu contrato no valor de R$$valor_orçamento foi gerado com sucesso. \nSegue o link para conferência e assinatura. ");
$text_whatsapp = "https://api.whatsapp.com/send?phone=$cliente_numerotext=$text_wpp";

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Visualização do Contrato Gerado</title>
</head>
<body style="font-family: arial, sans-serif; background-color: #f4f4f9; margin: 40px;">
    
    <h1><?= $cliente_doc ?></h1>
    <h1><?= $cliente_email?></h1>
    <h1><?= $cliente_nome ?></h1>
    <h1><?= $cliente_numerotext ?></h1>
    <h1><?= $cliente_telefone ?></h1>
    <h1><?= $cliente_numerotext ?></h1>
    <h1><?= $cliente_telefone ?></h1>


</body>
</html>