<div class="titulo_dica">
    <p>Dicas para o dia a dia</p>
</div>
     <?php
    
        include('cms/include_cms/include_conexao.php');

        $sql="select * from dica where tipo_dica = 1 order by id_dica desc limit 4;";
        $query = mysqli_query($con,$sql);

        while($conteudo = mysqli_fetch_array($query)){
            $imagem= $conteudo['img_dica'];
            $titulo= $conteudo['titulo'];
            $cont = $conteudo['conteudo'];
        
             if(strlen($conteudo['conteudo']) > 500){
                $cont = substr($conteudo['conteudo'], 0, 500)."...";
            }
            
    ?>
	<div class="conteudo_dia_dia">
            <div class="imagem_dica_dia">
                <img src="cms/<?php echo("imagens/".$imagem); ?>" alt="" />
            </div>
            
            <div class="conteudo_dica_dia">
            <p class="titulo_dica_mes"><?php echo($titulo); ?></p>

            <p><?php echo(nl2br($cont)); ?>

            <a href="detalhes_dicas.php?id=<?php echo($conteudo['id_dica']); ?>">
               <div class="ver_mais">
                    Ver mais...
               </div>
            </a>      
        </div>    
    </div>
<?php } ?>