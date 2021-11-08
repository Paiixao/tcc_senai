<div class="titulo_produto_promocoes">
    Promoções do mês
</div>

<?php
    $btn = "VER";

    $sql = "SELECT * FROM promocao_prato AS prop INNER JOIN prato AS p ON(p.id_prato = prop.id_prato) ";
    $sql .="INNER JOIN promocao AS pro ON(pro.id_promocao = prop.id_promocao) ";
    $sql .="INNER JOIN imagem_prato AS ip ON(ip.id_prato = p.id_prato) WHERE MONTH(pro.dt_inicio) = ".date('n')." AND pro.status = 1 LIMIT 1;";
    $select = mysqli_query($con, $sql);

    while ($rs = mysqli_fetch_array($select)) {

      date_default_timezone_set("America/Sao_Paulo");
      $hoje = new DateTime (date("Y-m-d"));
      $dt_final = new DateTime($rs['dt_final']);

      if($hoje == $dt_final){
          $sql = "update promocao set status = 0 where id_promocao =".$rs['id_promocao'];
          mysqli_query($con, $sql);  
      } 

      $lst_id[] = $rs['id_prato'];

      $preco = $rs['preco'];
      $desconto = $rs['desconto'];
      $porcento = $preco / 100;
      $resultado = $porcento * $desconto;
      $preco_real = $preco - $resultado;
      
      $preco_real=number_format($preco_real, 2, ',', '.');

        if(strlen($rs['descricao']) > 10) {
            $descricao = substr($rs['descricao'], 0, 60)."...";
?>

<div class="conteudo_produto_promocoes_do_mes">
    <div class="imagem_produto_promocoes_do_mes">
        <img src="<?php echo("cms/imagens/".$rs['imagem']); ?>" alt="" >
        <h1 class="faixa_promocoes"><?php echo($rs["titulo_promocao"]);?></h1>
        <div class="overlay">
           <h2>Ver mais...</h2>
           <a class="info" id="<?php echo($rs['id_prato']);?>"><input type="submit" name="VER" value="<?php echo($btn); ?>" class="btn_info"></a>
        </div>
    </div>

    <div class="nome_produto_promocoes_do_mes">
        <p><?php echo ($rs['nome_prato']); ?></p>
    </div>

    <div class="resumo_produto_promocoes_do_mes">
        <p><?php echo ($descricao); ?>...</p>
    </div>

    <div class="preco_produto_promocoes_do_mes">
        <p><b>R$</b>: <?php echo ($preco_real); ?></p>
    </div>

    <div class="adc_carrinho_promocoes_do_mes">
        <div class="btn_mais_menos_promocoes_do_mes">
            <img alt="" src="img_icones/icon_menos.png" />
        </div>

        <div class="qtd_carrinho_promocoes_do_mes">
            <p>4</p>
        </div>

        <div class="btn_mais_menos_promocoes_do_mes">
            <img alt="" src="img_icones/icon_maiss.png" />
        </div>

        <div class="btn_adc_carrinho_promocoes_do_mes">
            <p>Adicionar ao carrinho</p>
        </div>

        <div class="btn_comprar_promocoes_do_mes">
            <p> Comprar</p>
        </div>
    </div>
</div>
<?php
    }
  }

  include("include/include_lightbox.php");
?>
