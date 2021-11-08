<div class="titulo_produto_promocoes">
    Mais Promoções
</div>

<?php
    setlocale(LC_MONETARY,"pt_BR", "ptb");

    $sql = "SELECT * FROM promocao_prato AS prop INNER JOIN prato AS p ON(p.id_prato = prop.id_prato) ";
    $sql .="INNER JOIN promocao AS pro ON(pro.id_promocao = prop.id_promocao) ";
    $sql .="INNER JOIN imagem_prato AS ip ON(ip.id_prato = p.id_prato) WHERE pro.status = 1 GROUP BY p.id_prato ;";
    $select = mysqli_query($con, $sql);


    while ($rs=mysqli_fetch_array($select)) {

      date_default_timezone_set("America/Sao_Paulo");
      $hoje = new DateTime (date("Y-m-d"));
      $dt_final = new DateTime($rs['dt_final']);

      if($hoje == $dt_final){
          $sql = "update promocao set status = 0 where id_promocao =".$rs['id_promocao'];
          mysqli_query($con, $sql);  
      } 

      $preco = $rs['preco'];
      $desconto = $rs['desconto'];
      $porcento = $preco / 100;
      $resultado = $porcento * $desconto;
      $preco_real = $preco - $resultado;

      $preco_real=number_format($preco_real, 2, ',', '.');

      if(!in_array($rs['id_prato'], $lst_id)){
?>
<div class="conteudo_mais_promocoes">
     <div class="imagem_mais_promocoes">
         <img src="<?php echo("cms/imagens/".$rs['imagem']); ?>" alt="" >
         <h1 class="faixa_promocoes"><?php echo ($rs['titulo_promocao']); ?></h1>
         <div class="overlay">
            <h2>Ver mais...</h2>
            <a class="info" id="<?php echo($rs['id_prato']);?>"><input type="submit" name="VER" value="<?php echo($btn); ?>" class="btn_info"></a>
         </div>
     </div>

     <div class="nome_mais_promocoes">
         <p><?php echo ($rs['nome_prato']); ?></p>
     </div>

     <div class="resumo_mais_promocoes">
         <p><?php echo ($rs['descricao']); ?>...</p>
     </div>

     <div class="preco_mais_promocoes">
         <p><b>R$</b>: <?php echo ($preco_real); ?></p>
     </div>

     <div class="adc_carrinho_mais_promocoes">
         <div class="btn_mais_menos_mais_promocoes">
             <img alt="" src="img_icones/icon_menos.png" />
         </div>

         <div class="qtd_carrinho_mais_promocoes">
             <p>4</p>
         </div>

         <div class="btn_mais_menos_mais_promocoes">
             <img alt="" src="img_icones/icon_maiss.png" />
         </div>

         <div class="btn_adc_carrinho_mais_promocoes">
             <p>Adicionar ao carrinho</p>
         </div>

         <div class="btn_comprar_mais_promocoes">
             <p> Comprar</p>
         </div>
     </div>

 </div>
    <?php
        }
      }
    ?>