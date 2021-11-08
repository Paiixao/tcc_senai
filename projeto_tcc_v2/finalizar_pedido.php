<!DOCTYPE html>
<html>
<!-- http://ideiasdefimdesemana.com/wp-content/uploads/2010/06/lentilha.jpg

http://www.downloadswallpapers.com/wallpapers/2012/fevereiro/uva-verdes-no-prato-732.jpg
-->
    <head>
       <!--  <link rel="shortcut icon" href="imagens/favicon.ico" type="image/x-icon"> -->
        <title>Finalizar pedido</title>
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
                <script type="text/javascript">
                	$(function(){
    					var pagamento = $.param('pagamento');

                        if(pagamento=="Boleto"){
                            $(".btn_imprimir").css("display", "none");
                        }
                	});
                </script>
                <!--DIV DO bloco_produto_categoria-->
               <div class="bloco_meu_carrinho">
                    <div class="titulo_meu_perfil">
                        Obrigado pela compra. Volte sempre!
                    </div>

                    <div class="num_pedido">
                        Protocolo do pedido : <?php echo($_SESSION['pedido']['id_pedido']); ?>
                    </div>


                    <a href="detalhes_pedidos.php?id=<?php echo($_SESSION['pedido']['id_pedido']); ?>" target="_blank">
                        <div class="btn_acompanhar">Acompanhar pedido</div>
                    </a>

                    <a href="boleto.php" target="_blank">
                        <div class="btn_imprimir" >Imprimir boleto</div>
                    </a>
                    <div class="titulo_meu_perfil">
                        Resumo do pedido
                    </div>

                    <?php
                        include("cms/include_cms/include_conexao.php");
                        $valor_pedido=0.00;
                        if(isset($_SESSION['cliente'])){
                            $sql="select * from prato as p left join promocao_prato as ppr on(ppr.id_prato=p.id_prato) ";
                            $sql.="left join promocao as pp on(pp.id_promocao=ppr.id_promocao) ";
                            $sql.="inner join imagem_prato as ip on(ip.id_prato=p.id_prato) ";
                            $sql.="inner join pedido_prato as pr on(pr.id_prato=p.id_prato) ";
                            $sql.="inner join pedido as pe on(pe.id_pedido=pr.id_pedido) ";
                            $sql.="where pe.id_pedido = ".$_SESSION['pedido']['id_pedido']." ";
                            $sql.="and img_principal=1";

                            $select=mysqli_query($con, $sql);
                            while($rs=mysqli_fetch_array($select)){ 
                               if($rs['id_promocao']==null){
                                  $preco=$rs['preco'];
                                  $display = "none";
                                }else{
                                  $preco = $rs['preco'];
                                  $desconto = $rs['desconto'];
                                  $porcento = $preco / 100;
                                  $resultado = $porcento * $desconto;
                                  $preco = $preco - $resultado;
                                  $display = "block";
                                }

                                $valor_total = $preco*$rs['qtd'];
                                $valor_pedido=floatval($valor_pedido) + floatval($valor_total);

                                $valor_unitario=number_format($preco, 2, ',', '.');
                                $valor_total=number_format($valor_total, 2, ',', '.');
                                $valor_pedido=number_format($valor_pedido, 2, ',', '.');

                    ?>

                    <div class="propriedades_meu_carrinho" id="<?php echo($rs['id_prato']); ?>" value="<?php echo($rs['qtd']); ?>">
                        <div class="foto_pedido_carrinho">
                            <img alt="" src="<?php echo("cms/imagens/".$rs['imagem']); ?>" />
                        </div>
                        <div class="conteudo_carrinho">
                            <p>Nome do produto: <?php echo($rs['nome_prato']); ?></p>
                            <p>Quantidade:  <?php echo($rs['qtd']); ?></p>
                            <p>Valor unitário: R$ <?php echo($valor_unitario); ?></p>
                            <p>Valor Total: R$ <?php echo($valor_total); ?></p>
                        </div>
                    </div>

                    <?php } }?>
                    <span class="valor_total" id="<?php echo($valor_pedido); ?>">Valor Total do pedido: R$ <?php echo($valor_pedido); ?></span>
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
