<?php
$cliente_nome = isset($_GET['cliente']) ? htmlspecialchars($_GET['cliente']) : "Selecione o Cliente no Orçamento";
$cliente_doc = isset($_GET['doc']) ? htmlspecialchars($_GET['doc']) : "CPF/CNPJ não informado";
$valor_orçamento = isset($_GET['valor']) ? htmlspecialchars($_GET['valor']) : "R$0,00";

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informações Jurídicas & Termos de Serviço | Nossa Empresa de Software</title>
    <link rel="stylesheet" href="../css/juridico.css">
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

    <!-- Cabeçalho Principal -->
    <header class="legal-header">
        <div class="container">
            <span class="badge">Transparência & Conformidade</span>
            <h1>Central Jurídica & Termos de Serviço</h1>
            <p>Conheça nossas diretrizes contratuais, segurança da informação e compromisso com nossos clientes.</p>
        </div>
    </header>

    <main class="container main-content">
        <!-- Estrutura de Abas em CSS Puro -->
        <div class="tab-container">
            <input type="radio" name="tabs" id="tab1" checked>
            <input type="radio" name="tabs" id="tab2">
            <input type="radio" name="tabs" id="tab3">

            <nav class="tab-menu">
                <label for="tab1">Termos de Prestação de Serviços</label>
                <label for="tab2">Privacidade & Proteção de Dados (LGPD)</label>
                <label for="tab3">Cláusulas & Modelo de Contrato</label>
            </nav>

            <div class="tab-content">
                
                <!-- ABA 1: TERMOS DE PRESTAÇÃO DE SERVIÇOS -->
                <section id="content1" class="tab-pane">
                    <h2>1. Condições Gerais de Prestação de Serviços</h2>
                    <p class="updated-date">Última atualização: Setembro de 2026</p>

                    <h3>1.1. Escopo dos Serviços</h3>
                    <p>Nossa empresa é especializada no desenvolvimento de software, aplicações web, aplicativos móveis e soluções de tecnologia sob medida.</p>

                    <h3>1.2. Metodologia de Trabalho e Entregas</h3>
                    <p>Todos os serviços prestados seguem rigorosamente a Proposta Comercial aprovada e a Ordem de Serviço (OS) vinculada ao contrato inicial.</p>

                    <h3>1.3. Responsabilidades do Cliente</h3>
                    <ul>
                        <li>Fornecer as informações técnicas, conteúdos e acessos necessários em tempo hábil para o avanço das etapas.</li>
                        <li>Realizar os testes e aprovações das entregas dentro do prazo acordado para evitar atrasos na homologação final.</li>
                        <li>Funcionalidades ou requisitos não previstos expressamente no escopo inicial não estão inclusos na execução padrão e dependerão de orçamento específico.</li>
                    </ul>
                </section>

                <!-- ABA 2: PRIVACIDADE E LGPD -->
                <section id="content2" class="tab-pane">
                    <h2>2. Política de Privacidade & Segurança (LGPD)</h2>
                    <p class="updated-date">Em conformidade com a Lei Geral de Proteção de Dados (Lei nº 13.709/2018)</p>

                    <h3>2.1. Tratamento de Dados do Cliente</h3>
                    <p>Coletamos e armazenamos exclusivamente os dados pessoais e corporativos estritamente essenciais para a execução do contrato, emissão de notas fiscais, cumprimento de obrigações legais e comunicação direta sobre o progresso das entregas.</p>

                    <h3>2.2. Confidencialidade e NDA (Non-Disclosure Agreement)</h3>
                    <p>Garantimos sigilo absoluto sobre ideias, regras de negócio, dados de banco de dados e arquivos aos quais tivermos acesso durante o projeto. Nossos desenvolvedores e parceiros assinam acordos estritos de confidencialidade.</p>

                    <h3>2.3. Armazenamento e Segurança da Informação</h3>
                    <p>Utilizamos servidores em nuvem com criptografia de ponta a ponta e controle de acesso rigoroso para proteger o código-fonte e as informações tratadas.</p>
                </section>

                <!-- ABA 3: MODELO DE CONTRATO BASE -->
                <section id="content3" class="tab-pane">
                    <h2>3. Minuta Padrão de Contrato de Desenvolvimento</h2>
                    <p>Confira a estrutura base do contrato formalizado com nossos clientes na contratação de projetos.</p>

                    <div class="contract-preview">
                        <h4>CONTRATO DE PRESTAÇÃO DE SERVIÇOS DE DESENVOLVIMENTO DE SOFTWARE</h4>
                        <p><strong>CONTRATADA:</strong> Five Devs e um Sonho, inscrita no CNPJ sob o nº [00.000.000/0001-00].</p>
                        <p><strong>CONTRATANTE:</strong><span style="color: blue;"><?php echo $cliente_nome;?></span>, inscrito(a) no CPF/CNPJ sob o nº <span style="color: blue;"><?php echo $cliente_doc; ?></span></p> 
                         <p> <strong>VALOR TOTAL:</strong><span style="color: blue"> <php echo $valor_orçamento; ?></span></p>
                        <h5>CLÁUSULA DE PROPRIEDADE INTELECTUAL</h5>
                        <p>Após a liquidação integral dos valores ajustados na proposta comercial, todos os direitos patrimoniais e sobre o código-fonte desenvolvido sob medida serão transferidos integralmente ao CONTRATANTE.</p>

                        <h5>CLÁUSULA DE GARANTIA E SUPORTE</h5>
                        <p>A CONTRATADA oferece garantia técnica de 30 (trinta) dias após a entrega final para correção de eventuais erros (bugs) sem custos adicionais, desde que não sejam causados por intervenção de terceiros ou alteração no escopo.</p>
                        <!--- BOTÃO E FORMULARIO DE ENVIO PARA ASSINATURA-->
                        <form action="enviar_assinatura.php" method="post" style="margin-top:20px; border-top: 1px solid #ccc; padding-top:15px;">
                            <input type="hidden" name="cliente_nome" value="<?php echo $cliente_nome;?>">
                            <input type="hidden" name="cliente_doc" value="<?php echo $cliente_doc;?>"> 
                            <input type="hidden" name="valor_orçamento" value="<?php echo $valor_orçamento;?>">
                            
                            <button type="submit" style="background-color: #28a745; color: white; padding: 10px 15px; border: nome; border-radius: 4px; cursor: pointer">
                                Enviar Contrato para Assinatura
                            </button>
                            
                        </form>
                    </div>
                </section>

            </div>
        </div>
    </main>

    <footer class="legal-footer">
        <div class="container">
            <p>&copy; 2026 5 Devs e Um Sonho. Todos os direitos reservados. Projeto Acadêmico - Técnico em Desenvolvimento de Sistemas. Realizado por Amanda Orlatei.</p>
        </div>
    </footer>

</body>
</html>