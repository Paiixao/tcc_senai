<!DOCTYPE html>
<html>
<!-- http://ideiasdefimdesemana.com/wp-content/uploads/2010/06/lentilha.jpg

http://www.downloadswallpapers.com/wallpapers/2012/fevereiro/uva-verdes-no-prato-732.jpg
-->

    <head>
       <!--  <link rel="shortcut icon" href="imagens/favicon.ico" type="image/x-icon"> -->
        <meta http-equiv="Content-Type" content="text/html; charset=    utf-8" />
        <title>Editar dados</title>
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
               <div class="principal_editar_dados">
                    <div class="menu_meu_perfil">
                        <div class="titulo_meu_perfil">
                            Menu
                        </div>
                        <p><a href="perfil.php">Detalhes do perfil</a></p>
                        <p><a href="trocar_senha.php">Trocar Senha</a></p>
                        <p><a href="pedidos_andamento.php">Pedidos em andamento</a></p>
                        <p><a href="pedidos_entregues.php">Pedidos entregues</a></p>
                        <p>Sair</p>
                    </div>

                    <div class="propriedades_meu_perfil">
                        <div class="titulo_meu_perfil">
                            Dados
                        </div>

                        <div class="detalhes_perfil">
                            <form name="editar_perfil" method="post" action="editar_dados.php">
                                <p> <input type="text" name="txtNome_cliente" placeholder="Nome completo" required class="txtCadastro" maxlength="60"></p>

                                <p><input type="email" name="txEmail_cliente" placeholder="Email de cadastro" required class="txtCadastro" maxlength="50"></p>

                                <p><input type="text" name="txtTelefone_cliente" placeholder="Telefone para contato" required class="txtNumeroTelefone" id="tel">
                                    <input type="text" name="txtCelular_cliente" placeholder="Celular para contato" required class="txtNumeroCelular" id="cel"></p>

                                <div class="dt_nasc_perfil">
                                    Data de nascimento: <input type="date" name="dt_nascimento" placeholder="Registro geral" required>
                                </div>

                                <p><input type="text" name="txtRg_cliente" placeholder="Registro geral" required class="txtNumeroTelefone" maxlength="9" id="rg">
                                    <input type="text" name="txCpf_cliente" placeholder="CPF" required class="txtNumeroCelular" maxlength="11" id="cpf"></p>

                                <p><input type="reset" name="btnLimpar" value="Cancelar" class="btnCancelar_perfil2">
                                    <input type="submit" name="btnEditar"  value="Salvar" class="btnCadastrar_perfil"></p>
                            </form>
                        </div>
                        
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
