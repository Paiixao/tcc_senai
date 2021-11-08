<div class="titulo_contato">
    Fale Conosco
</div>

<script type="text/javascript">
    $(function(){
        $(".opcao").click(function(){
            var op = $(".opcao").val();
            if(op==1){
                $(".input_text_cod").css("display", "block");
            } 
        });
        
         $(".esconder").click(function(){
            var op2 = $(".esconder").val();
            if(op2==0){
                $(".input_text_cod").css("display", "none");
            } 
        });
    });
</script>

<div class="contato">
    <form name="fale_conosco" method="post" action="contato.php">
        <?php
            $nome = "";
            $email = "";
            $readonly="";

            if(isset($_SESSION['cliente'])){
                $nome=$_SESSION['cliente']['nome_completo'];
                $email=$_SESSION['cliente']['email'];
                $editar="readonly";
            }
         ?>
        <p><input type="text" <?php echo($readonly); ?> value="<?php echo($nome); ?>" name="txtNome_contato" placeholder="Insira seu nome" required class="input_text"></p>
        <p><input type="email" <?php echo($readonly); ?> value="<?php echo($email); ?>" name="txtEmail_contato" placeholder="Insira seu email" required class="input_text"></p>
        
        <div class="edit_check_base">    
            <div class="edit_check">
                 <input type="radio" name="rdoOpcao" value="0" checked class="esconder"> Sugestão
            </div>
            <div class="edit_check">
                <input type="radio" name="rdoOpcao" value="1" class="opcao"> Critica
            </div>
        </div>
        
        <p><input type="text" name="txtCodProduto" placeholder="Insira o codigo do produto" class="input_text_cod" maxlength="20"></p>
        
        <p><textarea name="txtComentario" placeholder="Insira seu comentário" class="textarea_text"></textarea></p>
        <p><input type="reset" name="btnLimpar" value="Limpar" class="btn_enviar">
        <input type="submit" name="btnEnviar" value="Enviar" class="btn_enviar"></p>
        
    </form>

</div>