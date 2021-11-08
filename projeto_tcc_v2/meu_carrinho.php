<?php 
    include('cms/include_cms/include_conexao.php');

    if(isset($_GET['id'])){
        $id=$_GET['id'];

        $sql="delete from carrinho_prato where id_prato = ".$id;
        
        if(mysqli_query($con, $sql)){
            ?>
                <script type="text/javascript">
                    alert("Prato removido com sucesso!");
                    window.setTimeout(function(){window.location="meu_carrinho.php";}, 500);
                </script>
            <?php
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
        <title>Meu carrinho</title>
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
               <div class="bloco_meu_carrinho">
                    <div class="titulo_meu_perfil">
                        Meu carrinho
                    </div>

                    <script type="text/javascript">
                        $(function(){
                            $(".comprar_tudo_carrinho").click(function(){
                                valor = $(".valor_total").attr("id");
                                valor = valor.replace(",",".");
                                lista = [];

                                $(".propriedades_meu_carrinho").each(function(){
                                    var obj = {id_prato:  $(this).attr("id"), qtd: $(this).attr("value")}
                                    lista.push(obj);
                                });
                                
                                $.ajax({
                                    url: "json/inserir_pedido.php",
                                    data: {valor: valor, lst_pratos: lista}
                                }).done(function(res){
                                    console.log(res);
                                    window.location="escolher_endereco.php";
                                });
                            });
                        });
                    </script>
                   
                   <?php
                        $valor_pedido=0.00;
                        if(isset($_SESSION['cliente'])){
                            $sql="select * from carrinho as c inner join carrinho_prato as cp on(cp.id_carrinho=c.id_carrinho)";
                            $sql.=" inner join prato as p on(p.id_prato=cp.id_prato) left join promocao_prato as pp on(pp.id_prato=p.id_prato)";
                            $sql.=" left join promocao as pr on(pr.id_promocao=pp.id_promocao)";
                            $sql.=" inner join imagem_prato as ip on(ip.id_prato=p.id_prato) where ip.img_principal = 1";
                            $sql.=" and p.status = 1 or pr.status = 1 and c.id_cliente=".$_SESSION['cliente']['id_cliente'];
                            $sql.=" GROUP BY p.id_prato ORDER BY p.click DESC limit 3";
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
                                $valor_pedido += floatval($valor_total);

                                $valor_unitario=number_format($preco, 2, ',', '.');
                                $valor_total=number_format($valor_total, 2, ',', '.');
                                $valor_pedido=number_format($valor_pedido, 2, ',', '.');

                    ?>

                    <div class="propriedades_meu_carrinho" id="<?php echo($rs['id_prato']); ?>" value="<?php echo($rs['qtd']); ?>">
                        <div class="foto_pedido_carrinho">
                            <img alt="" src="<?php echo("cms/imagens/".$rs['imagem']); ?>" />
                            <h1 class="faixa_promocoes" style="display: <?php echo($display); ?>"><?php echo ($rs['titulo_promocao']); ?></h1>
                        </div>
                        <div class="conteudo_carrinho">
                            <p>Nome do produto: <?php echo($rs['nome_prato']); ?></p>
                            <p>Quantidade:  <?php echo($rs['qtd']); ?></p>
                            <p>Valor unitário: R$ <?php echo($valor_unitario); ?></p>
                            <p>Valor Total: R$ <?php echo($valor_total); ?></p>
                        </div>
                        <a href="meu_carrinho.php?id=<?php echo($rs['id_prato']); ?>">
                            <div class="btn_remover_pedido">
                                Remover
                            </div>
                        </a>
                    </div>
                   <hr>
                   <?php }?>

                   <span class="valor_total" id="<?php echo($valor_pedido); ?>">Valor Total do pedido: R$ <?php echo($valor_pedido); ?></span>
                   
                   <div class="comprar_tudo_carrinho">
                        Finalizar Compra
                    </div>
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
