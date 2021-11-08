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
               <div class="principal_editar_endereco">
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
                            Endereco
                        </div>

                        <div class="detalhes_perfil">
                            <form name="editar_endereco" method="post" action="editar_endereco.php">
                                <p><input type="text" name="txtCep_cliente" placeholder="CEP" value="" required class="txtCep" onblur="pesquisacep(this.value)"; id="cep">
                                    <input type="text" name="txtRua_cliente" placeholder="Logradouro" readonly required class="txtRua"></p>

                                <p><input type="text" name="txtBairro_cliente" placeholder="Bairro" readonly class="txtBairro">
                                    <input type="text" name="txtNumeroCasa_cliente" placeholder="Número" required class="txtNumCom">
                                    <input type="text" name="txtComplemento_cliente" placeholder="Complemento" class="txtNumCom"></p>

                                <p><select name="slc_cidade"  class="select_city"  readonly="readonly" tabindex="-1">
                                    <option value="0">Cidade</option>

                                        <?php
                                            $sql="select * from cidade";
                                            $select=mysqli_query($con, $sql);

                                            while($rs=mysqli_fetch_array($select)){
                                        ?>
                                        <option class="opcao" value="<?php echo($rs['id_cidade']); ?>"> <?php echo($rs['nome_cidade']); ?> </option>    

                                        <?php }?>
                                    </select>
                                <input type="text" name="txtUf" placeholder="UF" required readonly class="txtUf">

                                <select name="slc_tipoEndereco" class="select_tipo" required>
                                    <option value="0">Tipo de endereço</option>

                                    <?php 
                                        $sql="select * from tipo_endereco";
                                        $select= mysqli_query($con, $sql);

                                            while($rs= mysqli_fetch_array($select)){

                                                ?> <option value="<?php echo($rs['id_tipoEndereco']);?>"><?php echo($rs['nome_tipoEndereco']);?> <?php

                                            }
                                    ?>
                                </select>
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
