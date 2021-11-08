<!DOCTYPE html>
<html>
<!-- http://ideiasdefimdesemana.com/wp-content/uploads/2010/06/lentilha.jpg

http://www.downloadswallpapers.com/wallpapers/2012/fevereiro/uva-verdes-no-prato-732.jpg
-->
    <head>
       <!--  <link rel="shortcut icon" href="imagens/favicon.ico" type="image/x-icon"> -->
        <title>Escolhe forma de pagamento</title>
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
    					$("#boleto").css("display", "block");
                        $("#boleto").attr("value", "Boleto");
                        
                        $(".tipo_pagamento").each(function(i){
                            $(this).click(function(){
                                if(i==0){
                                    $("#boleto").css("display", "block");
                                    $("#cartao").css("display", "none");
                                    $("#boleto").attr("value", "Boleto");
                                
                                }else if(i==1){
                                    $("#boleto").css("display", "none");
                                    $("#cartao").css("display", "block");
                                    $("#cartao").attr("value", "Crédito");
                                
                                }else if(i==2){
                                    $("#boleto").css("display", "none");
                                    $("#cartao").attr("value", "Débito");
                                    $("#cartao").css("display", "block");
                                }
                			});
                		});

                        $(".btn_finalizarCompra").each(function(){
                            $(this).click(function(){
                                var forma_pagamento = $(".forma_pagamento").attr("value");
                                $.ajax({
                                    url: "json/inserir_pedido.php",
                                    data: {forma_pagamento: forma_pagamento}
                                }).done(function(res){
                                    console.log(res);
                                    window.location="finalizar_pedido.php?pagamento="+forma_pagamento;
                                });
                            });
                        });
                	});
                </script>
                <!--DIV DO bloco_produto_categoria-->
               <div class="bloco_meu_carrinho">
                    <div class="titulo_meu_perfil">
                        Escolha a forma de pagamento
                    </div>
                    <div class="formas_pagamento">
                    	<div class="tipo_pagamento">Boleto</div>
                    	<div class="tipo_pagamento">Cartão de crédito</div>
                    	<div class="tipo_pagamento">Cartão de débito</div>

                    	<div class="forma_pagamento" id="boleto">
                    		<div class="aviso">
                    			<span class="icone_aviso"><img src="img_icones/aviso.png"></span>
                    			<span class="texto_aviso"><strong>IMPORTANTE:</strong> só emitimos boletos do Banco do Brasil. Confira os dados antes de pagá-lo.</span>
                    		</div>
                    		<span class="img_instrucao"><img src="img_icones/imprimir.png" alt=""></span>
                    		<span class="instrucao">Imprima o boleto e pague no banco</span>

                    		<span class="img_instrucao"><img src="img_icones/computado.png" alt=""></span>
                    		<span class="instrucao">ou pague pela internet utilizando o código de barras do boleto</span>

							<span class="img_instrucao"><img src="img_icones/calendario.png" alt=""></span>
                    		<span class="instrucao">o prazo de validade do boleto é de 1 dia útil</span>

                			<div class="btn_finalizarCompra">Finalizar pedido</div>
                    	</div>

                    	<div class="forma_pagamento" id="cartao">
                    			<input type="text" name="txt_numCartao" class="txtCampoCartao" placeholder="Número do cartão">
                    			<input type="text" name="txt_nomeCartao" class="txtCampoCartao" placeholder="Nome impreso no cartão">
                    			<select name="sl_mes" class="select">
                    				<option value="">Mes</option>
                    				<?php 
                    					$mes = 01;
                    					
                    					while($mes<=12){
                   					
                    				?>
                    					<option><?php echo($mes) ?></option>
                    				<?php  $mes++;} ?>
                    			</select>

                    			<select name="sl_ano" class="select">
                    				<option value="">Ano</option>
                    				<?php 
                    					$ano = 2016;
                    					
                    					while($ano<=2030){
                   					
                    				?>
                    					<option><?php echo($ano) ?></option>
                    				<?php  $ano++;} ?>
                    			</select>
                    			<input type="text" name="txtCodigo_seguranca" class="txtCampoCartao" placeholder="Código de seguranca">
                    			<input type="number" name="txt_parcela" min="1" class="txtCampoCartao" placeholder="Parcelas">

                    			<button name="btn_finalizarComprar" class="btn_finalizarCompra">Finalizar pedido</button>
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
