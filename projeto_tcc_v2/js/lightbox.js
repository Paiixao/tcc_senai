$(document).ready(function(){
    $('.info').click(function(){ chamar_caixa($('.caixa_detalhes'), $('.background_detalhes')); });
    $('.close').click(function(){ fechar_caixa($('.caixa_detalhes'), $('.background_detalhes')); });
    $('.background_detalhes').click(function(){ fechar_caixa($('.caixa_detalhes'), $('.background_detalhes')); });
    
    $('.login').click(function(){ chamar_caixa($('.caixa_login'), $('.background_login')); });
    $('.close').click(function(){ fechar_caixa($('.caixa_login'), $('.background_login')); });
    $('.background_login').click(function(){ fechar_caixa($('.caixa_login'), $('.background_login')); });

    $('.botao_select_categoria').click(function(){ chamar_caixa($('.caixa_subcategorias'), $('.background_subcategorias')); });
    $('.close').click(function(){ fechar_caixa($('.caixa_subcategorias'), $('.background_subcategorias')); });
    $('.background_subcategorias').click(function(){ fechar_caixa($('.caixa_subcategorias'), $('.background_subcategorias')); });
    

});

function chamar_caixa(caixa, background){
    background.fadeIn();
    caixa.fadeIn();
}

function fechar_caixa(caixa, background){
    background.fadeOut();
    caixa.fadeOut();
}
