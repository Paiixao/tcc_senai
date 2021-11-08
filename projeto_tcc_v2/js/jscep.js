 <script type="text/javascript" >
    
        function limpa_formulário_cep() {
               
                //Limpa valores do formulário de cep.
                $("input[name='txtRua_cliente']").val("");
                $("input[name='txtBairro_cliente']").val("");
                $("input[name='txtCidade_cliente']").val("");
                $("input[name='txtUf']").val("");             
        }

        function meu_callback(conteudo) {
            if (!("erro" in conteudo)) {
                //Atualiza os campos com os valores.
                $("input[name='txtRua_cliente']").val(conteudo.logradouro);
                $("input[name='txtBairro_cliente']").val(conteudo.bairro);
                $("input[name='txtCidade_cliente']").val(conteudo.localidade);
                
                $("select").children().each(function(){
                    if(this.text==conteudo.localidade){
                       $(this).attr("selected", "selected");
                    }
                });
                
                
                $("input[name='txtUf']").val(conteudo.uf);
            } //end if.
            else {
                //CEP não Encontrado.
                limpa_formulário_cep();
                alert("CEP não encontrado.");
            }
        }

        function pesquisacep(valor) {

            //Nova variável "cep" somente com dígitos.
            var cep = valor.replace(/\D/g, '');

            //Verifica se campo cep possui valor informado.
            if (cep != "") {

                //Expressão regular para validar o CEP.
                var validacep = /^[0-9]{8}$/;

                //Valida o formato do CEP.
                if(validacep.test(cep)) {

                    //Preenche os campos com "..." enquanto consulta webservice.
                    
                    $("input[name='txtRua_cliente']").val("...");
                    $("input[name='txtBairro_cliente']").val("...");
                    $("input[name='txtCidade_cliente']").val("...");
                    $("input[name='txtUf']").val("...");
                    //Cria um elemento javascript.
                    var script = document.createElement('script');

                    //Sincroniza com o callback.
                    script.src = '//viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

                    //Insere script no documento e carrega o conteúdo.
                    document.body.appendChild(script);

                } //end if.
                else {
                    //cep é inválido.
                    limpa_formulário_cep();
                    alert("Formato de CEP inválido.");
                }
            } //end if.
            else {
                //cep sem valor, limpa formulário.
                limpa_formulário_cep();
            }
        };

    </script>