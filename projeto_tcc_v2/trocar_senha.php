<!DOCTYPE html>
<html>
<!-- http://ideiasdefimdesemana.com/wp-content/uploads/2010/06/lentilha.jpg

http://www.downloadswallpapers.com/wallpapers/2012/fevereiro/uva-verdes-no-prato-732.jpg
-->

    <head>
       <!--  <link rel="shortcut icon" href="imagens/favicon.ico" type="image/x-icon"> -->
        <meta http-equiv="Content-Type" content="text/html; charset=    utf-8" />
        <title>Perfil</title>
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


            <!-- CONTEUDO-->
            <div class="conteudo">
                               
                <!--DIV DO bloco_produto_categoria-->
               <div class="principal_trocar_senha">
                    <div class="meu_perfil  ">
                        <div class="menu_meu_perfil">
                            <div class="titulo_meu_perfil">
                                Menu
                            </div>
                            <p><a href="perfil.php">Detalhes do perfil</a></p>
                            <p><a href="trocar_senha.php">Trocar Senha</a></p>
                            <p><a href="pedidos_andamento.php">Pedidos em andamento</a></p>
                            <p><a href="pedidos_entregues.php">Pedidos entregues</a></p>
                            <p><a href="index.php?logout=1">Sair</a></p>
                        </div>
                        <?php 
                            include("cms/include_cms/include_conexao.php");
                            if(isset($_POST['btnSalvar'])){
                                $senha_antiga=$_POST['txtSenhaAntiga'];
                                $senha_nova=$_POST['txtSenhaNova'];
                                $senha_confirma=$_POST['txtSenhaConfirma'];
                                if($senha_nova==$senha_confirma){

                                    $sql="update cliente set senha_cliente=SHA1('".$senha_nova."') where senha_cliente=SHA1('".$senha_antiga."');";
                                    if(mysqli_query($con, $sql)){
                                        ?>
                                            <script type="text/javascript">
                                                $("#titulo").text("Senha alterada com sucesso");
                                                $("#notificao").fadeIn();
                                                window.setTimeout(function(){$("#notificao").hide()}, 1500)
                                            </script>
                                        <?php
                                    }else{
                                        ?>
                                            <script type="text/javascript">
                                                $("#titulo").text("Ocorreu um erro. Tente novamente mais tarde");
                                                $("#notificao").fadeIn();
                                                window.setTimeout(function(){$("#notificao").hide()}, 1500)
                                            </script>
                                        <?php
                                    }

                                }
                            }
                         ?>
                        <form name="frm_trocarSenha" action="trocar_senha.php" method="post">
                            <div class="propriedades_trocar_senha">
                                <div class="titulo_meu_perfil">
                                    Trocar senha
                                </div>  
                                <p> <input type="password" name="txtSenhaAntiga" placeholder="Insira senha antiga" required class="txtSenha_perfil">
                                    <input type="password" name="txtSenhaNova" placeholder="Insira nova senha" required class="txtSenha_perfil">
                                    <input type="password" name="txtSenhaConfirma" placeholder="Confirmar nova senha" required class="txtSenha_perfil"></p>

                                <p><input type="reset" name="btnLimpar" value="Cancelar" class="btnCancelar_perfil">
                                    <input type="submit" name="btnSalvar" value="Cadastrar" class="btnCadastrar_perfil"></p>
                            </div>
                        </form>
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
