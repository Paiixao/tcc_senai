<?php 
    session_start();
    include('cms/include_cms/include_conexao.php');

    $nome = "";
    $email = "";
    $telefone = "";
    $celular = "";
    $dt_nasc = "";
    $rg = "";
    $cpf = "";

    if(isset($_GET['id'])){
        $sql="select * from cliente where id_cliente=".$_SESSION['cliente']['id_cliente'];
        $select=mysqli_query($con, $sql);
        $rs=mysqli_fetch_array($select);    

        $nome = $rs['nome_completo'];
        $email = $rs['email'];
        $telefone = $rs['telefone'];
        $celular = $rs['celular'];
        $dt_nasc = $rs['dt_nasc'];
        $rg = $rs['rg'];    
        $cpf = $rs['cpf'];
    }

    if(isset($_POST['btnEditar'])){
        $nome = $_POST['txtNome_cliente'];
        $email = $_POST['txEmail_cliente'];
        $telefone = $_POST['txtTelefone_cliente'];
        $celular = $_POST['txtCelular_cliente'];
        $dt_nasc = $_POST['dt_nascimento'];
        $rg = $_POST['txtRg_cliente'];    
        $cpf = $_POST['txCpf_cliente'];

        $sql="update cliente set nome_completo='".$nome."', email='".$email."', telefone='".$celular."', dt_nasc='".$dt_nasc."', rg='".$rg."', cpf='".$cpf."', celular='".$celular."' ";
        $sql.="where id_cliente=".$_SESSION['cliente']['id_cliente'];

        if(mysqli_query($con, $sql)){
         ?>
            <script> 
                alert('Edição realizado com sucesso');
                window.location="perfil.php";
            </script>
         <?php    
        }else{
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
                                <p> <input type="text" name="txtNome_cliente" placeholder="Nome completo" required class="txtCadastro" value="<?php echo($nome); ?>"></p>

                                <p><input type="email" name="txEmail_cliente" placeholder="Email de cadastro" required class="txtCadastro" value="<?php echo($email); ?>"></p>

                                <p>
                                    <input type="text" id="tel" name="txtTelefone_cliente" placeholder="Telefone para contato" required 
                                    maxlength="14" class="txtNumeroTelefone" id="tel" value="<?php echo($telefone); ?>">
                                    <input type="text" id="cel" name="txtCelular_cliente" placeholder="Celular para contato" required 
                                    maxlength="15" class="txtNumeroCelular" id="cel" value="<?php echo($celular); ?>">
                                </p>

                                <div class="dt_nasc_perfil">
                                    Data de nascimento: <input type="date" name="dt_nascimento" placeholder="Registro geral" required value="<?php echo($dt_nasc); ?>">
                                </div>

                                <p>
                                    <input type="text" id="rg" name="txtRg_cliente" placeholder="Registro geral" required class="txtNumeroTelefone" maxlength="12" id="rg" value="<?php echo($rg); ?>">
                                    <input id="cpf" type="text" name="txCpf_cliente" placeholder="CPF" required class="txtNumeroCelular" maxlength="14" id="cpf" value="<?php echo($cpf); ?>"></p>

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
