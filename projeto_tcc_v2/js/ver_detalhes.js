$(function(){
  $(".info").click(function(){
    var id_prato = $(this).attr("id");
    
    $.ajax({
      url: 'json/select_lightbox.php',
      data: {id: id_prato}
    }).done(function(dados){
        var lista = $.parseJSON(dados);
        $("#nome_prato").text(lista.nome_prato);
        $('#descricao').text(lista.descricao);
        $('#preco').text(lista.preco);
        $('#img').attr('src', "cms/imagens/"+lista.img_prato);
        $('#link_detalhes').attr('href', "detalhes.php?id="+id_prato);

        if(lista.desconto!=undefined)  $('#desconto').text("Desconto: "+ lista.desconto + "%");
        else console.log("desc" + lista.desconto);

         $.ajax({
            url: 'json/select_img.php',
            data: {id: id_prato}
          }).done(function(dados){
              var lista = $.parseJSON(dados);
              $(".mais_imagem_adc").remove();

              for(x in lista){
                var item = lista[x];

                var img_prato = document.createElement("div");
                $(img_prato).attr("class", "mais_imagem_adc");
                var img = document.createElement("img");
                $(img).attr("src", "cms/imagens/"+item.imagem);
                
                $(img).click(function(){
                  var src = $(this).attr("src");
                  $("#img").attr("src", src);
                });

                $(img_prato).append(img);
                $(".mais_imagem").append(img_prato);
              }
        });
    });
  });

  $(".txt_qtdCarrinho").each(function(){
    var elemento = $(this);
    var mais = $(this).parent().parent().children("#mais");
    var menos = $(this).parent().parent().children("#menos");
      
    mais.click(function(){
      var val = parseInt($(elemento).val());
      val++;
      
      $(elemento).val(val);
    });

    menos.click(function(){
      var val = parseInt($(elemento).val());
      if(val > 1) val--;
      $(elemento).val(val);
    });
  });


});
