 $(function(){
    $("#tel").keyup(function(){$(this).val(mascara_tel($(this).val()));});
    $("#cel").keyup(function(){$(this).val(mascara_cel($(this).val()));});
    $("#rg").keyup(function(){$(this).val(mascara_rg($(this).val()));});
    $("#cpf").keyup(function(){$(this).val(mascara_cpf($(this).val()));});
   
    $("#confimar").keyup(function(){
        $("#certo").text("");
        var senha_confirma = $(this).val();
        var senha = $(".txtSenha").val();

        window.setTimeout(function(){
            if(senha!=senha_confirma){
                $("#certo").text("ihh");
                $("#certo").attr("class", "0");
            }else if(senha==senha_confirma){
                $("#certo").text("ok");
                $("#certo").attr("class", "1");
            }
        }, 500);
    });

    $(".checkAceito").click(function(){
        if($(this).prop("checked")==true && $("#certo").attr("class")==1){
            $(".btnCadastrar").attr("disabled", false);
            $(".btnCadastrar").css("background-color", "#980000");
        }
    });
});