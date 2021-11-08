<?php

  $id=$_GET['id'];
  $sql_click="select click from prato where id_prato=".$id;
  $select_click=mysqli_query($con,$sql_click);
  
  $rs_click=mysqli_fetch_array($select_click);

  $_SESSION['click']=$rs_click['click'] + 1;

  $sql_click="update prato set click=".$_SESSION['click']." where id_prato=".$id;
  mysqli_query($con, $sql_click);

  $sql = " select * from prato as p left join promocao_prato as pp on(pp.id_prato=p.id_prato)";
  $sql .=" left join promocao as pr on(pr.id_promocao=pp.id_promocao)";
  $sql .=" inner join imagem_prato as ip on(ip.id_prato=p.id_prato) WHERE ip.img_principal = 1  AND p.status = 1";
  $sql .=" AND p.id_prato = ".$id." GROUP BY p.id_prato";
  $conexao = mysqli_query($con, $sql);

  while ($rs = mysqli_fetch_array($conexao)) {

    $ingredientes = $rs['ingredientes'];
    $array_ingredientes = preg_split('/;/', $ingredientes, -1, PREG_SPLIT_OFFSET_CAPTURE);
    $id=$rs['id_prato'];
    $modo_preparo = $rs['modo_preparo'];
    $array_modo_preparo = preg_split('/;/', $modo_preparo, -1, PREG_SPLIT_OFFSET_CAPTURE);

    if($rs['id_promocao']==null){
      $preco=$rs['preco'];
      $display="none";
    }else{
      $preco = $rs['preco'];
      $desconto = $rs['desconto'];
      $porcento = $preco / 100;
      $resultado = $porcento * $desconto;
      $preco = $preco - $resultado;
      $display="block";
    }

    $preco=number_format($preco, 2, ',', '.');
 ?>
<div class="principal_detalhes">
        <div class="titulo_produto">
            Detalhes
        </div>

        <div class="mais_imagem_principal_detalhes">
            <div class="imagem_mais_detalhes_pagina">
                <img id="img_principal" alt="" src="<?php echo("cms/imagens/".$rs['imagem']); ?>" />
            </div>

        </div>

        <script type="text/javascript">
          $(function(){
            $(".img").click(function(){
                var src = $(this).attr("src");
                $("#img_principal").attr("src", src);
              });
          });
        </script>

        <div class="mais_imagem">
          <?php 
              $sql_img = "SELECT * FROM imagem_prato WHERE id_prato =".$id." limit 4";
              $select_img = mysqli_query($con, $sql_img);

              while($rs_img=mysqli_fetch_array($select_img)){
           ?>
            <div class="mais_imagem_adc"><img alt="" src="<?php echo("cms/imagens/".$rs_img['imagem']); ?>" / class="img"></div>
            <?php } ?>
        </div>
        <div class="detalhes_nome_produto"> <p><?php echo ($rs['nome_prato']); ?></p> </div>

       <div class="detalhes_resumo_produto">
            <p><?php echo (nl2br($rs['descricao'])); ?></p>
            <p>Preço: R$ <?php echo ($preco); ?></p>
            <p style="display:<?php echo($display); ?>">Desconto: <?php echo ($rs['desconto']); ?>%</p>
       </div>

        <div class="ingredientes_produto">
            <div class="titulos_detalhes">
                <span id="titulo_ingredientes_detalhes">Ingredientes</span>
                                    |
                <span id="titulo_modoPreparo_detalhes">Modo de Preparo</span>
            </div>

            <ul id="ingredientes">

              <?php

                $count = count($array_ingredientes);

                  for($i=0; $i < $count ; $i++){ ?>

                      <li><?php print_r ($array_ingredientes[$i][0]);?></li><br>
              <?php } ?>

            </ul>

            <div id="modo_preparo">
                <ol>
                  <?php

                    $count = count($array_modo_preparo);

                      for($i=0; $i < $count ; $i++){ ?>

                          <li><?php print_r ($array_modo_preparo[$i][0]);?></li><br>
                  <?php } ?>
                </ol>
            </div>
        </div>
        <?php } ?>
        <div class="adc_comprar_detalhes">

          <?php

            $sql_like = "SELECT count(avaliacao) as avaliacao FROM avaliacao WHERE avaliacao = 1";
            $select_like = mysqli_query($con, $sql_like);
            $rs_like = mysqli_fetch_array($select_like);

            $sql_dislike = "SELECT count(avaliacao) as avaliacao FROM avaliacao WHERE avaliacao = 0";
            $select_dislike = mysqli_query($con, $sql_dislike);
            $rs_dislike = mysqli_fetch_array($select_dislike);

            $like = $rs_like['avaliacao'];
            $dislike = $rs_dislike['avaliacao'];
           ?>

           <script type="text/javascript">
              $(function(){
                id_prato= window.location.search.replace("?id=", "");

                $(".like_detalhes").click(function(){
                    if($(".usuario_carrinho").attr("id")==1){
                      $.ajax({
                        url: "json/inserir_like.php",
                        data: {avaliacao: 1, id_prato: id_prato}
                      }).done(function(likes){
                          $(".qtd_like_detalhes").text(likes);
                          $(".dislike_detalhes").attr("disabled", true);
                          $(".qtd_like_detalhes").attr("disabled", true);
                      });
                    }else{
                      $("#titulo").text("Você precisa estar logado para avaliar o produto");
                      $("#notificao").fadeIn();

                      window.setTimeout(function(){
                        $("#notificao").hide(500);
                        chamar_caixa($('.caixa_login'), $('.background_login'));
                      }, 1500);
                    }
                });

                $(".dislike_detalhes").click(function(){
                  if($(".usuario_carrinho").attr("id")==1){
                    $.ajax({
                      url: "json/inserir_like.php",
                      data: {avaliacao: 0, id_prato: id_prato}
                    }).done(function(dislikes){
                        $(".qtd_dislike_detalhes").text(dislikes);
                        $(".dislike_detalhes").attr("disabled", true);
                        $(".like_detalhes").attr("disabled", true);
                    });
                  }else{
                    $("#titulo").text("Você precisa estar logado para avaliar o produto");
                    $("#notificao").fadeIn();

                    window.setTimeout(function(){
                      $("#notificao").hide(500);
                      chamar_caixa($('.caixa_login'), $('.background_login'));
                    }, 1500);
                  }
                });

              })
           </script>

            <div class="like_dislike_detalhes">
                <div id="like_dislike_detalhes">
                    <button values="" name="" class="like_detalhes"><img src="img_icones/like.png" alt=""></button>
                    <div class="like_detalhes qtd_like_detalhes"><?php echo ($like); ?></div>
                    <button values="" name="" class="dislike_detalhes"><img src="img_icones/dislike.png" alt=""></button>
                    <div class="dislike_detalhes qtd_dislike_detalhes"><?php echo ($dislike); ?></div>
                </div>
            </div>

            <div class="adc_carrinho_produto_detalhes">
                <div class="btn_mais_menos" id="menos">
                <img alt="" src="img_icones/icon_menos.png" />
                </div>

                <div class="qtd_carrinho">
                    <input name="txt_qtd" type="text" value="1" class="txt_qtdCarrinho" readonly/>
                </div>

                <div class="btn_mais_menos" id="mais">
                    <img alt="" src="img_icones/icon_maiss.png" />
                </div>

                <div class="btn_adc_carrinho">
                    <p>Adicionar ao carrinho</p>
                </div>

                <div class="btn_comprar_detalhes">
                    <p> Comprar</p>
                </div>
            </div>
        </div>

        <div class="comentario_principal_detalhes">
            <div class="titulo_comentarios_detalhes">
                Comentários
            </div>
            <?php
              $nome = "";
              $email = "";
              $readonly="";

              if(isset($_SESSION['cliente'])){
                $nome=$_SESSION['cliente']['nome_completo'];
                $email=$_SESSION['cliente']['email'];
                $editar="readonly";
              }


              $sql_coment = "SELECT * FROM avaliacao_comentario where id_prato = ".$id;
              $select_coment = mysqli_query($con, $sql_coment);
              while ($rs_coment = mysqli_fetch_array($select_coment)) {
            ?>
             <div class="usuario_detalhes">
               <div class="img_usuario1">
                 <div class="img_usuario">
                   <img src="img_icones/goku.png">
                 </div>

                 <div class="name_usuario">
                   <b><?php echo($rs_coment['nome_cliente']); ?></b>
                 </div>
               </div>

               <div class="comentario_usuario">
                 <br>
                    "<?php echo ($rs_coment['comentario']); ?>"
               </div>
            </div>
            <hr>
            <?php } ?>
        </div>

      <form action="json/avaliar_produto.php" method="post" name="frm_comentario">
        <div class="area_comentar">
            <p class="titulo_comentario_sub">Mande-nos seu comentário sobre o produto abaixo</p>
                <p><input type="text" <?php echo("editar"); ?> value="<?php echo($nome); ?>" name="txtNome_coment" placeholder="Insira Seu nome" required class="input_text_comentario"></p>
                <p><input type="text" <?php echo("editar"); ?> value="<?php echo($email); ?>" name="txtEmail_coment" placeholder="Insira Seu email" required class="input_text_comentario"></p>
                <p><input type="hidden" name="id_prato" value="<?php echo($id); ?>"></p>
                <p><textarea name="txtComentario" placeholder="Insira seu comentário" class="textarea_text_comentario"></textarea></p>

                <p><input type="reset" name="btnLimpar" value="Limpar" class="btn_enviar_comentario">
                <input type="submit" name="btnEnviar_coment" value="Enviar" class="btn_enviar_comentario"></p>

            </form>
        </div>
    </div>
