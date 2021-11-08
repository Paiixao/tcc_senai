<div class="titulo_produto">
    Outros produtos
</div>

<?php
    if(isset($_GET['modo'])){
      $filtro=$_GET['filtro'];

      $sql = " select * from prato as p left join promocao_prato as pp on(pp.id_prato=p.id_prato)";
      $sql .=" left join promocao as pr on(pr.id_promocao=pp.id_promocao)";
      $sql .=" inner join sub_categoria as sc on(sc.id_subCategoria=p.id_subCategoria) ";
      $sql .=" inner join imagem_prato as ip on(ip.id_prato=p.id_prato) WHERE ip.img_principal = 1  AND p.status = 1 and p.id_subCategoria=".$filtro;
      $sql .=" GROUP BY p.id_prato order by rand()";
    
    }elseif(isset($_POST['btn_pesquisar'])){
      $pesquisa=$_POST['txt_pesquisa'];

      $sql = " select * from prato as p left join promocao_prato as pp on(pp.id_prato=p.id_prato)";
      $sql .=" left join promocao as pr on(pr.id_promocao=pp.id_promocao)";
      $sql .=" inner join imagem_prato as ip on(ip.id_prato=p.id_prato) WHERE ip.img_principal = 1  AND p.status = 1";
      $sql .=" and nome_prato like '".$pesquisa."%' GROUP BY p.id_prato order by rand();";
    }else{
      $sql = " select * from prato as p left join promocao_prato as pp on(pp.id_prato=p.id_prato)";
      $sql .=" left join promocao as pr on(pr.id_promocao=pp.id_promocao)";
      $sql .=" inner join imagem_prato as ip on(ip.id_prato=p.id_prato) WHERE ip.img_principal = 1  AND p.status = 1 GROUP BY p.id_prato ";
      $sql .=" order by rand();";
    }

    $select = mysqli_query($con, $sql);

   while ($rs = mysqli_fetch_array($select)) {
     if(!in_array($rs['id_prato'], $lst_id)){

        if($rs['id_promocao']==null){
          $preco=$rs['preco'];
          $display = "none";
        }else{
          $preco = $rs['preco'];
          $desconto = $rs['desconto'];
          $porcento = $preco / 100;
          $resultado = $porcento * $desconto;
          $preco = $preco - $resultado;
          $display = "block";
        }

      $preco=number_format($preco, 2, ',', '.');

        
     if(strlen($rs['descricao']) > 10) {
        $descricao = substr($rs['descricao'], 0, 60)."...";
      }
?>
   <div class="conteudo_produto_vendidos">
        <div class="imagem_produto_vendidos">
            <img alt="" src="<?php echo("cms/imagens/".$rs['imagem']); ?>" />
            <h1 class="faixa_promocoes" style="display: <?php echo($display); ?>"><?php echo ($rs['titulo_promocao']); ?></h1>
            <div class="overlay">
               <h2>Ver mais...</h2>
               <a class="info" id="<?php echo($rs['id_prato']);?>"><input type="submit" name="VER" value="<?php echo($btn); ?>" class="btn_info"></a>
            </div>
        </div>

        <div class="nome_produto_vendidos">
            <p><?php echo ($rs['nome_prato']); ?></p>
        </div>

        <div class="resumo_produto_vendidos">
            <p><?php echo ($descricao); ?></p>
        </div>

        <div class="preco_produto_vendidos">
            <p><b>R$</b>: <?php echo ($preco); ?></p>
            <p style="display:<?php echo($display); ?>">Desconto: <?php echo ($rs['desconto']); ?>%</p>
        </div>

        <div class="adc_carrinho_produto_vendidos">
            <div class="btn_mais_menos_vendidos" id="menos">
                <img alt="" src="img_icones/icon_menos.png" />
            </div>

            <div class="qtd_carrinho_vendidos">
                <input name="txt_qtd" type="text" value="1" class="txt_qtdCarrinho" readonly/>
            </div>

            <div class="btn_mais_menos_vendidos" id="mais">
                <img alt="" src="img_icones/icon_maiss.png" />
            </div>

            <div class="btn_adc_carrinho">
                <p>Adicionar ao carrinho</p>
            </div>

            <div class="btn_comprar">
                <p> Comprar</p>
            </div>
        </div>
    </div>
    <?php
        }
      }
    ?>
