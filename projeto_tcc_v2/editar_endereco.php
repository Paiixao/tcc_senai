<?php 
    include('cms/include_cms/include_conexao.php');
    session_start();

    $cidade="";
    $tipoEndereco="";
    $logradouro="";
    $num_endereco="";
    $complemento="";
    $bairro="";
    $cep="";
    $uf="";
    $btn_salvar="Salvar";

    if(isset($_GET['id'])){
        $_SESSION['id']=$_GET['id'];

        $sql="select * from endereco as e inner join cliente_endereco as ce on(e.id_endereco=ce.id_endereco) ";
        $sql.="inner join cidade as c on(c.id_cidade=e.id_cidade) inner join estado as es on(es.id_estado=c.id_estado) ";
        $sql.="where ce.id_cliente=".$_SESSION['id'];
        $select=mysqli_query($con, $sql);
        $rs=mysqli_fetch_array($select);    

        $cidade=$rs['id_cidade'];
        $tipoEndereco=$rs['id_tipoEndereco'];
        $logradouro=$rs['logradouro'];
        $num_endereco=$rs['num_endereco'];
        $complemento=$rs['complemento'];
        $bairro=$rs['bairro'];
        $cep=$rs['cep'];
        $uf=$rs['uf_estado'];
        $btn_salvar="Editar";
    }

    if(isset($_POST['btnEditar'])){
        $bairro = $_POST['txtBairro_cliente'];
        $numero_casa = $_POST['txtNumeroCasa_cliente'];
        $complemento = $_POST['txtComplemento_cliente'];
        $cep = $_POST['txtCep_cliente'];
        $rua = $_POST['txtRua_cliente'];
        $cidade = $_POST['slc_cidade'];
        $tipo= $_POST['slc_tipoEndereco'];
        $uf = $_POST['txtUf'];

        $btn_salvar=$_POST['btnEditar'];

        if($btn_salvar=="Salvar"){
            $sql="insert into endereco(cep, logradouro, bairro, num_endereco, complemento, id_cidade, id_tipoEndereco) ";
            $sql.="values('".$cep."', '".$rua."', '".$bairro."', '".$numero_casa."', '".$complemento."', '".$cidade."', '".$tipo."');";
            $sql.="insert into cliente_endereco(id_cliente, id_endereco) values ('".$_SESSION['cliente']['id_cliente']  ."', last_insert_id());";
        }elseif($btn_salvar=="Editar"){
            $sql="update endereco cep='".$cep."', logradouro='".$rua."', bairro='".$bairro."', num_endereco='".$numero_casa."', complemento='".$complemento."', id_cidade='".$cidade."', ";
            $sql.=" id_tipoEndereco= '".$tipo."' where id_endereco =".$_SESSION['id'];
        }

        if(mysqli_multi_query($con, $sql)){
         ?>
            <script> 
                alert('Ação realizada com sucesso');
                if(window.location.search.indexOf('compra=') > -1){
                    window.location="perfil.php";    
                }else{
                    window.location="escolher_endereco.php"; 
                }
                
            </script>
         <?php    
        }else{
            echo $sql;
            ?><script> alert('Aconteuceu algo errado. Por favor tente novamente.'); </script><?php
        }
    }
?>
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
                <?php include('js/jscep.js') ?>               
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
                                <p><input type="text" name="txtCep_cliente" placeholder="CEP" value="<?php echo($cep); ?>" required class="txtCep" onblur="pesquisacep(this.value)"; id="cep">
                                    <input type="text" name="txtRua_cliente" placeholder="Logradouro" readonly required class="txtRua" value="<?php echo($logradouro); ?>"></p>

                                <p><input type="text" name="txtBairro_cliente" placeholder="Bairro" readonly class="txtBairro" value="<?php echo($bairro); ?>">
                                    <input type="text" name="txtNumeroCasa_cliente" placeholder="Número" required class="txtNumCom" value="<?php echo($num_endereco); ?>">
                                    <input type="text" name="txtComplemento_cliente" placeholder="Complemento" class="txtNumCom" value="<?php echo($complemento); ?>"></p>

                                <p><select name="slc_cidade"  class="select_city"  readonly="readonly" tabindex="-1">
                                    <option value="0">Cidade</option>

                                        <?php
                                            $sql="select * from cidade";
                                            $select=mysqli_query($con, $sql);

                                            while($rs=mysqli_fetch_array($select)){
                                                if($cidade==$rs['id_cidade']){
                                                    $selected="selected";
                                                }else{
                                                    $selected="";
                                                }
                                        ?>
                                        <option class="opcao" <?php echo($selected); ?> value="<?php echo($rs['id_cidade']); ?>"> <?php echo($rs['nome_cidade']); ?> </option>    

                                        <?php }?>
                                    </select>
                                <input type="text" name="txtUf" placeholder="UF" required readonly class="txtUf" value="<?php echo($uf); ?>">

                                <select name="slc_tipoEndereco" class="select_tipo" required>
                                    <option value="0">Tipo de endereço</option>

                                    <?php 
                                        $sql="select * from tipo_endereco";
                                        $select= mysqli_query($con, $sql);

                                            while($rs= mysqli_fetch_array($select)){
                                                if($tipoEndereco==$rs['id_tipoEndereco']){
                                                    $selected="selected";
                                                }else{
                                                    $selected="";
                                                }

                                                ?> <option value="<?php echo($rs['id_tipoEndereco']);?>" <?php echo($selected); ?> ><?php echo($rs['nome_tipoEndereco']);?> <?php

                                            }
                                    ?>
                                </select>
                                    <p><input type="reset" name="btnLimpar" value="Cancelar" class="btnCancelar_perfil2">
                                    <input type="submit" name="btnEditar"  value="<?php echo($btn_salvar); ?>" class="btnCadastrar_perfil"></p>
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
