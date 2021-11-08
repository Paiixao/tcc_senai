<div class="dados_parceiros">
    <div class="titulo_parceiros">
        <p>Parceiros</p>
    </div>

     <?php
    
        include('cms/include_cms/include_conexao.php');

        $sql="select * from parceiro order by id_parceiro desc limit 3;";
        $query = mysqli_query($con,$sql);

        while($conteudo = mysqli_fetch_array($query)){
            $imagem= $conteudo['logo_parceiro'];
            $conteudo= $conteudo['informacao']; 
    ?>
    
    <div class="conteudo_parceiros">

        <div class="logo_parceiros">
            <img src="cms/<?php echo($imagem); ?>" alt="" />
        </div>


        <div class="texto_parceiros">
        <p><?php echo(nl2br($conteudo)); ?></p>
        </div>
    </div>
    <?php } ?>
</div>