$(function(){
    $(".edit_select_categoria").change(function(){
        $(".edit_select_categoria option:selected").each(function(){
            var id_categoria = $(this).val();

            //Metodo AJAX para selecionar as subcategorias da categoria selecionada
            $.ajax({
                url: "json/select_subCategoria.php",
                data: {id: id_categoria}
              }).done(function(dados){
                var lista = $.parseJSON(dados);

                $(".edit_select_subcategoria option").remove("option");

                //Percorrendo a lista e criando as options
                for(x in lista){
                    var op = document.createElement("option");
                    $(op).attr("value", lista[x].id_subCategoria);
                    $(op).text(lista[x].nome_subCategoria);

                    $(".edit_select_subcategoria").append(op);
                }
              });
        });
    });
});