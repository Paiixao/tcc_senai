<!DOCTYPE html>
<html>
<!-- http://ideiasdefimdesemana.com/wp-content/uploads/2010/06/lentilha.jpg

http://www.downloadswallpapers.com/wallpapers/2012/fevereiro/uva-verdes-no-prato-732.jpg
-->

    <head>
       <!--  <link rel="shortcut icon" href="imagens/favicon.ico" type="image/x-icon"> -->
        <meta http-equiv="Content-Type" content="text/html; charset=    utf-8" />
        <title>Cadastro</title>
        <link rel="stylesheet" type="text/css" href="css/style_site.css">
        <link rel="stylesheet" type="text/css" href="css/style_botaopesquisar.css">
        
        <?php include('include/include_script_css.php'); ?>

    </head>

    <body>
        

        <div id="principal">
            <!-- CABEÇALHO-->
            <div id="cabecalho">
                <!-- CONTEUDO DO CABEÇALHO -->
                <?php include('include/include_cabecalho.php') ?>
            </div>
            <!-- FIM_CABEÇALHO-->

            <!-- SLIDER-->
            <div class="slider">
                <?php include('include/include_slide.php'); ?>
            </div>
            <!-- FIM_SLIDER-->

            <!-- CONTEUDO-->
            <div class="conteudo">
                               
                <!--DIV DO bloco_produto_categoria-->
               <div class="bloco_cadastar">
                  
					<?php include('include/include_cadastrar.php'); ?>
                </div>
                <!--DIV DO bloco_produto_categoria-->


            </div>
            <!-- FIM_CONTEUDO-->

            <div class="parceiros">
                <?php include('include/include_parceiro.php'); ?>
            </div>

            <div class="rodape">
                <div class="dados_rodape">
                    <?php include('include/include_dados_rodape.php'); ?>
                </div>

                <div class="aviso_rodape">
                    <?php include('include/include_aviso.php'); ?>
                </div>
            </div>
        </div>
    </body>
</html>
