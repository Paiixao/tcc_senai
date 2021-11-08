<?php 
    session_start();
    include("cms/include_cms/include_conexao.php");
    $valor_pedido=0.00;
    $sql=" select *, date_format(dt_compra, '%d/%m/%Y') as dt_compra from pedido as pe inner join pedido_prato as ppr on(ppr.id_pedido=pe.id_pedido) ";
    $sql.="inner join prato as p on(p.id_prato=ppr.id_prato) left join promocao_prato as pp on(pp.id_prato=p.id_prato) ";
    $sql.="left join promocao as pr on(pr.id_promocao=pp.id_promocao) ";
    $sql.="inner join imagem_prato as ip on(ip.id_prato=p.id_prato) where ip.img_principal = 1 ";
    $sql.="and p.status = 1 and pr.status = 1 and pe.id_cliente=".$_SESSION['cliente']['id_cliente'];
    $sql.=" and pe.id_pedido=".$_SESSION['pedido']['id_pedido'];
    $sql.=" ORDER BY p.click DESC limit 3";

    $select=mysqli_query($con, $sql);
    $rs=mysqli_fetch_array($select);

    $valor_total = $rs['preco']*$rs['qtd'];
    $valor_pedido=floatval($valor_pedido) + floatval($valor_total);

    $valor_pedido=number_format($valor_pedido, 2, ',', '.');
 ?>

<html>
<!--    https://suporte.scriptcase.com.br/index.php?/Knowledgebase/Article/View/289/0/exemplo-boleto-bancario-->
    <head>
        <title>Boleto</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/style_site.css">        
        <script type="text/javascript">print();</script>
    </head>

    <body>
        
        <div class="principal_boleto">
            <div class="cima_boleto">
                <div class="propriedades_cima_boleto">
                    <div class="titulo_propriedades_cima_boleto">
                        Nosso Número
                    </div>
                    <div class="valor_propriedades_cima_boleto">
                        10256
                    </div> 
                </div>
                
                <div class="propriedades_cima_boleto">
                    <div class="titulo_propriedades_cima_boleto">
                        Espécie
                    </div>
                    <div class="valor_propriedades_cima_boleto">
                        R$
                    </div> 
                </div>
                
                <div class="propriedades_cima_boleto">
                    <div class="titulo_propriedades_cima_boleto">
                        Quantidade
                    </div>
                    <div class="valor_propriedades_cima_boleto">
                        01
                    </div> 
                </div>
                
                <div class="propriedades_cima_boleto">
                    <div class="titulo_propriedades_cima_boleto">
                        Valor Documento
                    </div>
                    <div class="valor_propriedades_cima_boleto">
                        R$ <?php echo($valor_pedido); ?>
                    </div> 
                </div>
                
                <div class="propriedades_cima_boleto">
                    <div class="titulo_propriedades_cima_boleto">
                        Espécie Documento    
                    </div>
                    <div class="valor_propriedades_cima_boleto">
                        DM
                    </div> 
                </div>
                
                <div class="propriedades_cima_boleto">
                    <div class="titulo_propriedades_cima_boleto">
                        Agência / Código Cedente
                    </div>
                    <div class="valor_propriedades_cima_boleto">
                        0123/00-12345-6
                    </div> 
                </div>
            </div> 
            <div class="sacador_avalista">
                <p>Sacador / Avalista</p>
                <?php echo($_SESSION['cliente']['nome_completo']); ?>
            </div>
            
            <div class="linha_pontilhada"></div>
            
            <div class="agencia_boleto">
                <div class="propriedades_agencia_boleto_img">
                    <img src="itau.gif" alt="">
                </div>
                <div class="propriedades_agencia_boleto_num">
                   <p>237-2</p>
                </div>
                <div class="propriedades_agencia_boleto_codigo">
                    <p>23793.44308 90010.000041 33001.250001 3 52830000008091</p>
                </div>
            </div>
            
            <div class="propriedades">
                <div class="propriedades_resto_boleto">
                    <b>Local do Pagamento</b> <br />
                    Pagável em qualquer banco até a data de vencimento
                </div>
                <div class="propriedades_valores_boleto">
                    <b>Vencimento</b> <br />
                    <?php 
                         $date = date('d')+5; 
                         $date .= date('/m/'); 
                         $date .= date('Y');
                         echo $date; 
                    ?>
                </div>
            </div>
            
            <div class="propriedades">
                <div class="propriedades_resto_boleto">
                    <b>Cedente</b> <br />
                    Frozen fitness gourmet
                </div>
                <div class="propriedades_valores_boleto">
                    <b>Agência / Código do Cedente</b> <br />
                    0123/00-12345-6
                </div>
            </div>
            
            <div class="propriedades">
                <div class="propriedades_resto_boleto">
                    <div class="propriedades_resto_boleto_adc">
                        <b>Data Documento</b> <br />
                            <?php echo($rs['dt_compra']); ?>
                    </div>
                    <div class="linha_em_pe"></div  >
                    
                    <div class="propriedades_resto_boleto_adc">
                        <b> Número do Documento</b> <br />
                            123456789
                    </div>
                    <div class="linha_em_pe"></div  >
                    
                    <div class="propriedades_resto_boleto_adc">
                        <b>Espécie do Documento</b> <br />
                            DM
                    </div>
                    <div class="linha_em_pe"></div  >
                    
                    <div class="propriedades_resto_boleto_adc">
                        <b>Aceite</b> <br />
                            N
                    </div>
                    <div class="linha_em_pe"></div  >
                    
                    <div class="propriedades_resto_boleto_adc">
                        <b>Data Processamento</b> <br />
                            <?php echo($rs['dt_compra']); ?>
                    </div>
                </div>

                <div class="propriedades_valores_boleto">
                    <b>Nosso Número</b> <br />
                        10256
                </div>
            </div>
            
            <div class="propriedades">
                <div class="propriedades_resto_boleto">
                    <div class="propriedades_resto_boleto_adc">
                        <b>Uso Banco</b> <br />
                    </div>
                    <div class="linha_em_pe"></div  >
                    
                    <div class="propriedades_resto_boleto_adc">
                        <b>Carteira</b> <br />
                            05
                    </div>
                    <div class="linha_em_pe"></div  >
                    
                    <div class="propriedades_resto_boleto_adc">
                        <b>Espécie</b> <br />
                            R$
                    </div>
                    <div class="linha_em_pe"></div  >
                    
                    <div class="propriedades_resto_boleto_adc">
                        <b>Quantidade</b> <br />
                            1
                    </div>
                    <div class="linha_em_pe"></div  >
                    
                    <div class="propriedades_resto_boleto_adc">
                        <b>Valor</b> <br />  
                    </div>
                </div>
                
                <div class="propriedades_valores_boleto">
                    <b>Valor do Documento</b> <br />
                        <?php echo($valor_pedido); ?>
                </div>
            </div>
            
            <div class="propriedades_maiores">
                <div class="descricao_grande">
                    <b>Descrição do Pedido</b>
                    <br />
                    <br />

                    <?php
                        $sql_prato="select * from carrinho as c inner join carrinho_prato as cp on(cp.id_carrinho=c.id_carrinho)"; 
                        $sql_prato.=" inner join prato as p on(p.id_prato=cp.id_prato) left join promocao_prato as pp on(pp.id_prato=p.id_prato)";
                        $sql_prato.=" left join promocao as pr on(pr.id_promocao=pp.id_promocao)";
                        $sql_prato.=" inner join imagem_prato as ip on(ip.id_prato=p.id_prato) where ip.img_principal = 1";
                        $sql_prato.=" and p.status = 1 and pr.status = 1 and c.id_cliente=".$_SESSION['cliente']['id_cliente'];
                        $sql_prato.=" ORDER BY p.click DESC limit 3";

                        $select_prato=mysqli_query($con, $sql_prato);

                        while($rs_prato=mysqli_fetch_array($select_prato)){
                     ?>
                    <p><?php echo($rs_prato['nome_prato']); ?></p>                    
                    <?php } ?>         
                </div>
                
                <div class="resto_descricao">
                    <div class="descricao_lateral">
                        <b>(-)Desconto / Abatimento</b>
                    </div>
                    <div class="descricao_lateral">
                        <b>(-)Outras Deduções</b>
                    </div>
                    <div class="descricao_lateral">
                        <b>(+)Multa / Mora</b>
                    </div>
                    <div class="descricao_lateral">
                        <b>(+)Outros Acrécismos</b> <br />
                    </div>
                    <div class="descricao_lateral">
                        <b>(=)Valor Cobrado</b> <br />
                    </div> 
                </div>
            </div>
            
            <div class="grande_final_enfim">
                    <br />
                    <p><b>Sacado</b></p>                    
                    <p><?php echo($_SESSION['cliente']['nome_completo']); ?></p> 
                    <?php 
                        $sql="select * from endereco as e inner join pedido as p on(p.id_enderecoEntrega=e.id_endereco) ";
                        $sql.="inner join cidade as c on(c.id_cidade=e.id_cidade) inner join estado as es on(es.id_estado=c.id_estado) ";
                        $sql.="where p.id_pedido=".$rs['id_pedido'];

                        $select=mysqli_query($con, $sql);
                        $rs=mysqli_fetch_array($select); 
                     ?>                   
                    <p><?php echo($rs['logradouro']); ?></p>
                    <p><?php echo($rs['nome_cidade']); ?>/<?php echo($rs['uf_estado']); ?>
                    - CEP <?php echo($rs['cep']); ?></p>
            </div>
            <div class="codigo_barra">
                <img src="barcode.png" alt="" >
            </div>

        </div>
    
    </body>
</html>