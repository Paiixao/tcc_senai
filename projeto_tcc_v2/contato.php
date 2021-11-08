<?php
    
     include('cms/include_cms/include_conexao.php');

    if (isset($_POST['btnEnviar'])){
        
        $nome = $_POST['txtNome_contato'];
        $email = $_POST['txtEmail_contato'];
        $rdo = $_POST['rdoOpcao'];
        $codProduto = $_POST['txtCodProduto'];
        $comentario = $_POST['txtComentario'];
        
        //Definido a variavel com nulo para cadastrar no banco
        if($codProduto=="") $codProduto= "null";
        
        $sql = " insert into fale_conosco (nome_contato, email, numero_protocolo, tipo_contato, comentario) values('".$nome."', '".$email."', ".$codProduto.", '".$rdo."', '".$comentario."');";    

        mysqli_query($con, $sql);
        header("location:contato.php");
    }
?>


<!DOCTYPE html>
<html>
<!-- http://papermashup.com/demos/image-jquery/ -->

    <head>
       <!--  <link rel="shortcut icon" href="imagens/favicon.ico" type="image/x-icon"> -->
        <meta http-equiv="Content-Type" content="text/html; charset=    utf-8" />
        <title>Contato</title>
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

                    
                
                <!--DIV DO bloco_fale_conosco-->
               <div class="bloco_fale_conosco">

                    <!-- DIV DA CATEGORIA E SUBCATEGORIA -->

                    <div class="fale_conosco">
                        <?php include('include/include_fale_conosco.php'); ?>
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
