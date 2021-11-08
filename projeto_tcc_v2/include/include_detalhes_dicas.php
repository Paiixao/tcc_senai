<?php 
    include("cms/include_cms/include_conexao.php");

    if(isset($_POST['btnEnviar_coment'])){
        $nome=$_POST['txtNome_coment'];
        $email=$_POST['txtEmail_coment'];
        $comentario=$_POST['txtComentario'];

        $sql="insert into comentario(nome, email, comentario, id_dica) ";
        $sql.="values('".$nome."', '".$email."', '".$comentario."', '".$_SESSION['id']."')";

        if(mysqli_query($con, $sql)){
            ?>
            <script type="text/javascript">
                alert("Comentario enviado com sucesso");
            </script>
            <?php
        }else{
            ?><script type="text/javascript">alert("Ocorreu um erro! Tente novamente");</script><?php
        }
    }

    if(isset($_GET['id'])){
        $_SESSION['id']=$_GET['id'];

        $sql="select * from dica where id_dica = ".$_SESSION['id'];
        $select=mysqli_query($con, $sql);

        $rs=mysqli_fetch_array($select);
    }
    
 ?>


<div class="titulo_dicas_detalhes">
    <?php echo($rs['titulo']); ?>
</div>

<div class="dicas_detalhes_principal">

    <div class="img_detalhes_dicas" id="<?php echo($rs['id_dica']); ?>">
        <img src="cms/<?php echo("imagens/".$rs['img_dica']); ?>" alt=""/>
    </div>
    <div class="conteudo_dicas_detalhes_primeiro"><?php echo(nl2br($rs['conteudo'])); ?></div>
</div>

<div class="conteudo_dicas_detalhes_segundo">
    <!-- <p></p> -->
</div>
<div class="comentario_principal_detalhes">
            <div class="titulo_comentarios_detalhes">
                Comentários
            </div>
            <?php 
                $sql_comentario="select * from comentario where id_dica=".$_SESSION['id'];
                $select_comentario=mysqli_query($con, $sql_comentario);

                while($rs_comentario=mysqli_fetch_array($select_comentario)){
            ?>
             <div class="usuario_detalhes">
               <div class="img_usuario1">
                 <div class="img_usuario">
                   <img src="img_icones/goku.png">
                 </div>

                 <div class="name_usuario">
                   <b><?php echo($rs_comentario['nome']); ?></b>
                 </div>
               </div>

               <div class="comentario_usuario">
                 <br>
                    <?php echo($rs_comentario['comentario']); ?>
               </div>
            </div>
            <hr>
            <?php } ?>
        </div>
        
        <div class="area_comentar">
            <p class="titulo_comentario_sub">Mande-nos seu comentário sobre o produto abaixo</p>
            <form name="comentario_produto" method="post" action="detalhes_dicas.php?id=<?php echo($rs['id_dica']); ?>">
                
                <p><input type="text" name="txtNome_coment" placeholder="Insira Seu nome" required class="input_text_comentario"></p>
                <p><input type="text" name="txtEmail_coment" placeholder="Insira Seu email" required class="input_text_comentario"></p>
                <p><textarea name="txtComentario" placeholder="Insira seu comentário" class="textarea_text_comentario"></textarea></p>
                
                <p><input type="reset" name="btnLimpar" value="Limpar" class="btn_enviar_comentario">
                <input type="submit" name="btnEnviar_coment" value="Enviar" class="btn_enviar_comentario"></p>

            </form>
        </div>