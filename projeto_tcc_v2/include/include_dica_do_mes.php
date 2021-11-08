
    <div class="titulo_dica">
        <p>Dica do mês</p>
    </div>

    <?php
    
        include('cms/include_cms/include_conexao.php');

        $sql="select * from dica as d inner join dica_prato as dp on(dp.id_dica=d.id_dica) where d.tipo_dica = 0 order by d.id_dica desc limit 1;";
        $query = mysqli_query($con,$sql);

        while($conteudo = mysqli_fetch_array($query)){
            $imagem= $conteudo['img_dica'];
            $titulo= $conteudo['titulo'];
            $cont = $conteudo['conteudo'];
        
            if(strlen($conteudo['conteudo']) > 800){
               $cont = substr($conteudo['conteudo'], 0, 600)."...";
            }
            
    ?>
    <div class="conteudo_dica_mes">
        <div class="imagem_dica">
          <img src="cms/<?php echo("imagens/".$imagem); ?>" alt="" />
        </div>
        <div class="texto_dica">
            
        <p class="titulo_dica_mes"><?php echo($titulo); ?></p>

            <p><?php echo(nl2br(nl2br($cont))); ?></p>
        </div>
        
        
        <div class="associados_dica">
          <div class="fonte_dica">
              <p>Por: Frozen fitness gourmet</p>
          </div>

            <div class="fonte_dica">
                <p><a href="detalhes.php?id=<?php echo($conteudo['id_prato']); ?>">Ver produto</a></p>
              </div>
            <div class="fonte_dica">
                <a href="detalhes_dicas.php?id=<?php echo($conteudo['id_dica']); ?>">
                      <p>Comentários</p>
                </a>
            </div>
            
        </div>
        <a href="detalhes_dicas.php?id=<?php echo($conteudo['id_dica']); ?>">
            <div class="ver_mais">
                Ver mais...
            </div>
        </a>
    </div>
<?php } ?>