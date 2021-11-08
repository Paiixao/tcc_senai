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
                    <script type="text/javascript">
                        $(function(){
                            $("#cpf").keyup(function(){mascara_cpf($(this).val())});
                        })
                    </script>
                    <?php 
                        include("cms/include_cms/include_conexao.php");
                        if(isset($_POST['btnSalvar'])){
                            $cpf=$_POST['txCpf_cliente'];
                            $senha_nova=$_POST['txtSenhaNova'];
                            $senha_confirma=$_POST['txtSenhaConfirma'];
                            if($senha_nova==$senha_confirma){

                                $sql="update cliente set senha_cliente=SHA1('".$senha_nova."') where cpf='".$cpf."';";
                                if(mysqli_query($con, $sql)){
                                    ?>
                                        <script type="text/javascript">
                                            $("#titulo").text("Senha alterada com sucesso");
                                            $("#notificao").fadeIn();
                                            window.setTimeout(function(){
                                                $("#notificao").hide();
                                                chamar_caixa($('.caixa_login'), $('.background_login'))
                                        }, 1500)
                                        </script>
                                    <?php
                                }else{
                                    ?>
                                        <script type="text/javascript">
                                            $("#titulo").text("Não foi possivel encontrar o CPF. Verifique se digitou corretamente");
                                            $("#notificao").fadeIn();
                                            window.setTimeout(function(){$("#notificao").hide()}, 1500)
                                        </script>
                                    <?php
                                }

                            }
                        }
                     ?>
                        <form name="frm_trocarSenha" action="esqueci_senha.php" method="post">
                            <div class="propriedades_trocar_senha">
                                <div class="titulo_meu_perfil">
                                    Trocar senha
                                </div>  
                                <p>  <input type="text" id="cpf" maxlength="14" name="txCpf_cliente" placeholder="CPF (Somente números)" 
                                required class="txtSenha_perfil"></p>
                                    <input type="password" name="txtSenhaNova" placeholder="Insira nova senha" required class="txtSenha_perfil">
                                    <input type="password" name="txtSenhaConfirma" placeholder="Confirmar nova senha" required class="txtSenha_perfil"></p>

                                <p><input type="reset" name="btnLimpar" value="Cancelar" class="btnCancelar_perfil">
                                    <input type="submit" name="btnSalvar" value="Salvar" class="btnCadastrar_perfil"></p>
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
