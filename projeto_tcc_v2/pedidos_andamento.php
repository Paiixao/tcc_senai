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
               <div class="principal_andamento">
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

                    <div class="propriedades_pedidos_andamento">
                        <div class="titulo_meu_perfil">
                            Pedidos em andamento
                        </div> 
                        <?php
                            include('cms/include_cms/include_conexao.php');

                            $sql="select *, date_format(p.dt_compra, '%Y-%m-%d') as dt_compra from pedido as p inner join cliente as c on(c.id_cliente=p.id_cliente) ";
                            $sql.="inner join pedido_prato as pp on(pp.id_pedido=p.id_pedido) ";
                            $sql.="inner join endereco as e on(e.id_endereco=p.id_enderecoEntrega) ";
                            $sql.="inner join cidade as ci on(ci.id_cidade=e.id_cidade) ";
                            $sql.="inner join estado as es on(es.id_estado=ci.id_estado) ";
                            $sql.="inner join tipo_endereco as tp on(tp.id_tipoEndereco=e.id_tipoEndereco) ";
                            $sql.="inner join status_pedido as sp on(sp.id_pedido=p.id_pedido) ";
                            $sql.="inner join status as s on(s.id_status=sp.id_status) ";
                            $sql.="where sp.id_pedido=p.id_pedido and sp.data = (select max(data) from status_pedido where id_pedido = sp.id_pedido)";
                            $sql.="and sp.id_status <> 5 and c.id_cliente = '".$_SESSION['cliente']['id_cliente']."' group by p.id_pedido "; 
                            $sql.="order by p.id_pedido desc";
                            $select=mysqli_query($con, $sql);

                            while($rs=mysqli_fetch_array($select)){
                                $preco=number_format($rs['valor_compra'], 2, ',', '.');

                                $dt_prevista = date_create($rs['dt_compra']);
                                $dt_compra = date_create($rs['dt_compra']);
                                $dt_compra = date_format($dt_compra, 'd/m/Y');
                                
                                date_add($dt_prevista, date_interval_create_from_date_string('7 days'));
                                $dt_prevista= date_format($dt_prevista, 'd/m/Y');

                        ?>
                            <div class="segurar_pedido">
                                <div class="img_produto_perfil"><img src="img_produtos/picadinho.jpg" alt=""></div>
                                <div class="propriedades_pedido">
                                    <p>Número do pedido: <?php echo($rs['id_pedido']); ?></p>
                                    <p>Status: <?php echo($rs['nome_status']); ?></p>
                                    <p>Data da Compra: <?php echo($dt_compra); ?></p>
                                    <p>Data estimada para entrega: <?php echo($dt_prevista); ?></p>
                                    <p>Valor total: R$: <?php echo($preco); ?></p>
                                    <p>Quantidade: <?php echo($rs['qtd']); ?></p>
                                    <a href="detalhes_pedidos.php?id=<?php echo($rs['id_pedido']); ?>">
                                        <div class="ver_mais">
                                            Mais...
                                       </div>
                                    </a>
                                </div>
                            </div>
                           <hr>
                        <?php } ?>
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
