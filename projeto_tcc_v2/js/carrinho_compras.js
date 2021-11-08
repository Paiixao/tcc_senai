$(function(){
	carregar_qtdCarrinho();
	logado = $(".usuario_carrinho").attr("id");

	$(".btn_adc_carrinho").each(function(i){

		$(this).click(function(e){
			e.preventDefault();	
			id = 0;    
			qtd = 0;
			index = i;
			if(window.location.search.indexOf('id=') > -1){
			 	id= $.param('id');
			
			}else{
				$(".info").each(function(i){
					if(i==index) id =  $(this).attr("id");
				});

				$(".txt_qtdCarrinho").each(function(i){
					if(i==index) qtd = $(this).val();
				});
			}
			
			if(logado=="0"){
				$("#titulo").text("Você precisa estar logado para adicionar ao carrinho");
				$("#notificao").fadeIn();

				window.setTimeout(function(){
					$("#notificao").hide(500);
					chamar_caixa($('.caixa_login'), $('.background_login'));
				}, 1500);
			
			}else{
				$.ajax({
					url: "json/inserir_carrinho.php",
					data: {id: id, qtd: qtd}
				}).done(function(res){

					if(res=="1"){
						carregar_qtdCarrinho();
						$("#titulo").text("Prato adicionado ao carrinho com sucesso!");
						$("#notificao").fadeIn();
						
						window.setTimeout(function(){
							$("#notificao").hide(500);
						}, 1500);

					}else if(res=="0"){
						$("#titulo").text("Prato já adicionado ao carrinho!");
						$("#notificao").fadeIn();
						
						window.setTimeout(function(){
							$("#notificao").hide(500);
						}, 1500);
					}
				});

			}
		});
	});

	$(".btn_comprar").each(function(i){
		$(this).click(function(e){
			if(logado=="0"){
				$("#titulo").text("Você precisa estar logado para realizar uma compra");
				$("#notificao").fadeIn();

				window.setTimeout(function(){
					$("#notificao").hide(500);
					chamar_caixa($('.caixa_login'), $('.background_login'));
				}, 1500);
			
			}else{
				e.preventDefault();	
				id = 0;    
				qtd = 0;
				index = i;
			
				$(".info").each(function(i){
					if(i==index) id =  $(this).attr("id");
				});

				$(".txt_qtdCarrinho").each(function(i){
					if(i==index) qtd = $(this).val();
				});

				$.ajax({
					url: "json/inserir_carrinho.php",
					data: {id: id, qtd: qtd}
				}).done(function(res){
					carregar_qtdCarrinho();
					window.location="meu_carrinho.php";
				});
			}
		});
	});
});

function carregar_qtdCarrinho(){
	$.ajax({
		url: 'json/select_qtdCarrinho.php'
	}).done(function(qtd){
		$(".qtd").text(qtd);
	});
}