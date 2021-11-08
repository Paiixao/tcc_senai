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
               <div class="principal_meu_perfil">
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

                    <div class="propriedades_meu_perfil">
                        <div class="titulo_meu_perfil">
                            Meu Perfil
                        </div>
                        <?php
                            include("cms/include_cms/include_conexao.php");
                            if(isset($_SESSION['cliente'])){
                                $sql="select * from cliente where id_cliente=".$_SESSION['cliente']['id_cliente'];
                                $select=mysqli_query($con, $sql);
                                $rs=mysqli_fetch_array($select);
                         ?>
                        <div class="detalhes_perfil">
                            <legend>Dados Pessoais</legend>
                            <hr>
                            <p>Nome completo: <?php echo($rs['nome_completo']); ?></p>
                            <p>Email: <?php echo($rs['email']); ?></p>
                            <p>Telefone: <?php echo($rs['telefone']); ?></p>
                            <p>Celular: <?php echo($rs['celular']); ?></p>
                            <p>Data de Nascimento: <?php echo($rs['dt_nasc']); ?></p>
                            <p>Registro Geral: <?php echo($rs['rg']); ?></p>
                            <p>CPF: <?php echo($rs['cpf']); ?></p>
                            
                            <a href="editar_dados.php?id=<?php echo($rs['id_cliente']); ?>">
                                <div class="btn_editar_perfil">Editar Dados</div>
                            </a>
                             
                            <?php
                                $sql_endereco="select * from endereco as e inner join cliente_endereco as ce on(e.id_endereco=ce.id_endereco) ";
                                $sql_endereco.="inner join cidade as c on(c.id_cidade=e.id_cidade) inner join estado as es on(es.id_estado=c.id_estado) ";
                                $sql_endereco.="where ce.id_cliente=".$_SESSION['cliente']['id_cliente'];
                                $select_endereco=mysqli_query($con, $sql_endereco);
                                $rs_endereco=mysqli_fetch_array($select_endereco);
                                
                            ?>
                            <legend>Endereço</legend>
                            <hr>
                            <p>Longradouro:<?php echo($rs_endereco['logradouro']); ?></p>
                            <p>Bairro:  <?php echo($rs_endereco['bairro']); ?></p>
                            <p>Cidade:  <?php echo($rs_endereco['nome_cidade']); ?></p>
                            <p>Estado:  <?php echo($rs_endereco['nome_estado']); ?></p>
                            <p>Número:  <?php echo($rs_endereco['num_endereco']); ?></p>
                            <p>Complemento: <?php echo($rs_endereco['complemento']); ?></p>
                            
                            <a href="editar_endereco.php?id=<?php echo($rs_endereco['id_endereco']); ?>&modo=editar">
                                <div class="btn_editar_endereco">Editar Endereço</div>
                            </a>
                            <a href="editar_endereco.php?modo=novo">   
                                <div class="btn_adc_endereco">Adicionar Endereço</div>
                            </a>
                        </div>
                        <?php } ?>
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
