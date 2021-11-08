$(function(){
	
	var liWidth=$("#slide ul li").outerWidth(),//Recebe o tamanho das li's
	speed=500,//Velocidade em que os slide passam
	rotate=setInterval(auto, speed);//Chama a funçao auto para fazer os slide automaticos
	
	
	//Essa funçao mostra os botoes ao passar o mouse nos slide
	$("#slide").hover(function(){
		//Ao passar o mouse nos slide o botao ira aparecer
		$("#botao").fadeIn();
		clearInterval(rotate);//Faz os slide pararem
	}, function(){
		//Ao tirar o mouse dos slide o botao ira desaparecer
		$("#botao").fadeOut();
		rotate=setInterval(auto, speed);//Faz os slide voltarem a ser automaticos
	});

	
	//Ao clicar no botão proximo ele ira passar a imagem para o proximo
	$("#proximo").click(function(e){
			
			
			e.preventDefault();//Remove o efeito do link
			
			$("#slide ul").css({'width':'999%'});//Muda o tamanho da ul para caber todas as imagens uma do lado da outra
			$("#slide ul").animate({left:-liWidth}, //Cria uma animação e move o li
				function(){
				$("#slide ul li").last().after($("#slide ul li").first());//Coloca o primeiro item como ultimo e o segundo como primeiro
				$(this).css({'left':'0', 'width':'auto'});//Retorna as configurações normais da li
			});
			
	});
	
	//Ao clicar no botão anterior ele ira passar a imagem para a imagem anterior
	$("#anterior").click(function(e){
			e.preventDefault();//Remove o efeito do link
			
			$("#slide ul li").first().before($("#slide ul li").last().css({'margin-left':-liWidth}));//Coloca o ultimo item como primeiro e move a li
			$("#slide ul").css({'width':'999%'});//Muda o tamanho da ul para caber todas as imagens uma do lado da outra
			$("#slide ul").animate({left:liWidth}, //Cria uma animação e move o li
				function(){
					$("#slide ul li").first().css({'margin-left':'0'});
					$(this).css({'left':'0', 'width':'auto'});//Retorna as configurações normais da li
			});
			
	});
	
	function auto(){//Coloca os slide em automatico
		$("#proximo").click();	
	}
});