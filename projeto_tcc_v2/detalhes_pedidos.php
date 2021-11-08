<?php 
    include("cms/include_cms/include_conexao.php");
    
    $id=$_GET['id'];
    $valor_pedido=0.00;

    $sql="select *, date_format(p.dt_compra, '%d/%m/%Y') as dt_compra from pedido as p inner join cliente as c on(c.id_cliente=p.id_cliente)";
    $sql.=" inner join pedido_prato as pp on(pp.id_pedido=p.id_pedido) ";
    $sql.=" left join transportadora_pedido as trp on(trp.id_pedido=p.id_pedido) ";
    $sql.=" inner join prato as pr on(pr.id_prato=pp.id_prato) ";
    $sql.=" inner join endereco as e on(e.id_endereco=p.id_enderecoEntrega) ";
    $sql.=" inner join cidade as ci on(ci.id_cidade=e.id_cidade) ";
    $sql.=" inner join estado as es on(es.id_estado=ci.id_estado) ";
    $sql.=" inner join tipo_endereco as tp on(tp.id_tipoEndereco=e.id_tipoEndereco) ";
    $sql.=" inner join status_pedido as sp on(sp.id_pedido=p.id_pedido) ";
    $sql.=" inner join status as s on(s.id_status=sp.id_status) ";
    $sql.=" where p.id_pedido='".$id."' order by sp.id_status desc limit 1";

    $select=mysqli_query($con, $sql);
    $rs=mysqli_fetch_array($select);
    $valor_total = $rs['preco']*$rs['qtd'];
    $valor_pedido= $rs['valor_compra'];

    $valor_pedido=number_format($valor_pedido, 2, ',', '.');

    if($rs['id_transportadora']==null){
        $valor_frete="valor não definido";
    }else{
        $valor_frete=$rs['valor_frete'];
        $valor_frete=number_format($valor_frete, 2, ',', '.');

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
        <title>Detalhes do pedido</title>
        <?php include('include/include_script_css.php'); ?>

        <style type="text/css">
        </style>
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
                               
                <div class="principal_detalhes_pedidos">
                    <div class="titulo_meu_perfil">
                            Detalhes do Pedidos
                    </div>
                    <div class="img_pedido">
                        <img src="img_produtos/picadinho.jpg" alt="" >
                    </div>
                    <div class="propriedades_menores_dados">
                        <div class="detalhes_menores">
                            <p><b>Número do pedido:</b> <?php echo($rs['id_pedido']); ?></p>
                            <p><b>Data da Compra:</b> <?php echo($rs['dt_compra']); ?>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <p><b>Status do produto: </b><?php echo($rs['nome_status']); ?></p>
                        </div>
                    </div>
                    <hr class="hr_pedido">
                    <div class="detalhes_pessoais_pedido">
                            <p><b>Nome do comprador:</b> <?php echo($rs['nome_completo']); ?>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <b>CPF:</b> <?php echo($rs['cpf']); ?>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <b>RG:</b> <?php echo($rs['rg']); ?></p>
                    </div>
                    
                    <hr class="hr_pedido">
                    <div class="detalhes_pessoais_pedido">
                        <p><b>Endereço de Entrega:</b> <?php echo($rs['logradouro']); ?>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <b>Número:</b> <?php echo($rs['num_endereco']); ?>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <b>Bairro:</b> <?php echo($rs['bairro']); ?>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <b>Cidade:</b> <?php echo($rs['nome_cidade']); ?></p>
                            <p><b>CEP:</b> <?php echo($rs['cep']); ?>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <b>Dados do pagamento:</b>  Pagamento realizado em <?php echo($rs['forma_pagamento']); ?></p>
                    </div>

                    <p class="titulo_central_produtos">Produtos</p>
                    <hr class="hr_pedido">
                    <table class="table_produtos">
                        <tr>
                            <td><b>Nome do prato:</b></td>
                            <td><b>Valor por item</b></td>
                            <td><b>Quantidade:</b></td>
                            <td><b>Valor total:</b></td>
                        </tr>
                        
                        <?php 

                            $sql="select * from pedido as p ";
                            $sql.="inner join endereco as e on(e.id_endereco=p.id_enderecoEntrega) ";
                            $sql.="inner join cidade as ci on(ci.id_cidade=e.id_cidade) ";
                            $sql.="inner join estado as es on(es.id_estado=ci.id_estado) ";
                            $sql.="inner join tipo_endereco as tp on(tp.id_tipoEndereco=e.id_tipoEndereco) ";
                            $sql.="inner join (select * from status_pedido order by data desc limit 1) as sp on(sp.id_pedido=p.id_pedido)";
                            $sql.="inner join status as s on(s.id_status=sp.id_status) ";
                            $sql.="inner join pedido_prato as pp on(pp.id_pedido=p.id_pedido) ";
                            $sql.="inner join prato as pr on(pr.id_prato=pp.id_prato) where p.id_pedido = '".$id."' and ";
                            $sql.="p.id_cliente=".$_SESSION['cliente']['id_cliente'];

                            $select=mysqli_query($con, $sql);
                            while($rs_prato=mysqli_fetch_array($select)){ 
                                $valor_total = $rs_prato['preco']*$rs['qtd'];

                                $valor_unitario=number_format($rs_prato['preco'], 2, ',', '.');
                                $valor_total=number_format($valor_total, 2, ',', '.');
                        ?>
                            <tr>
                                <td><?php echo($rs_prato['nome_prato']) ?></td>
                                <td>R$ <?php echo($valor_unitario); ?></td>
                                <td><?php echo($rs['qtd']); ?></td>
                                <td><?php echo($valor_total); ?></td>
                            </tr>

                        <?php } ?>

                    </table>
                        <hr class="hr_pedido">
                    <div class="detalhes_pedidos_mais">
                        <p><b>Registro do pedido</b> </p>
                        <table class="table_produtos">
                             <tr>
                                <td><b>Status</b></td>
                                <td><b>Data</b></td>
                            </tr>

                            <?php
                                $sql=" select *, date_format(data, '%d/%m/%Y') as data from status_pedido as sp inner join status as s on(s.id_status=sp.id_status) ";
                                $sql.="where sp.id_pedido=".$id;

                                $select=mysqli_query($con, $sql);
                                while($rs=mysqli_fetch_array($select)){ 
                            ?>
                                <tr>
                                    <td><?php echo($rs['nome_status']) ?></td>
                                    <td><?php echo($rs['data']); ?></td>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                                         
                    <hr class="hr_pedido">
                    <div class="valor_total">
                        <p><b>Valor total do Pedido:</b> R$: <?php echo($valor_pedido); ?></p>
                        <p><b>Valor do frete:</b> <?php echo($valor_frete); ?></p>
                        <a href="pedidos_andamento.php">
                            <div class="voltar_pedidos">
                                Voltar
                            </div>
                        </a>
                    </div>
                </div>

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
