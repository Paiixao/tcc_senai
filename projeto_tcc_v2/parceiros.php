<!DOCTYPE html>
<html>
<!-- http://papermashup.com/demos/image-jquery/ -->

    <head>
       <!--  <link rel="shortcut icon" href="imagens/favicon.ico" type="image/x-icon"> -->
        <meta http-equiv="Content-Type" content="text/html; charset=    utf-8" />
        <title>Parceiros</title>
        <link rel="stylesheet" type="text/css" href="css/style_site.css">
        <?php include('include/include_script_css.php'); ?><link rel="stylesheet" type="text/css" href="css/style_site.css">

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
                
                <div class="bloco_parceiros">
                    <?php include('include/include_parceiro_pagina.php'); ?>
                </div>

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
