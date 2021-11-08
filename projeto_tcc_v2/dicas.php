<!DOCTYPE html>
<html>
<!-- http://papermashup.com/demos/image-jquery/ -->

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Dicas</title>
        <link rel="stylesheet" type="text/css" href="css/style_site.css">
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
               <div class="bloco_dica_categoria">
                    <!-- include DA CATEGORIA E SUBCATEGORIA -->
                    <?php include('include/include_submenu.php') ?>

                    <!-- DIV DA CATEGORIA E SUBCATEGORIA -->

                    <div class="dica_mes">
                        <?php include('include/include_dica_do_mes.php'); ?>
                   </div>
                   
                    <div class="dica_dia_dia">
                        <?php include('include/include_dica_dia.php'); ?>
                   </div>
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
