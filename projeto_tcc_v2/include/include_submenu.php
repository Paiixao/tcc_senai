<div class="sub_menu">
    <div class="titulo_categoria">
        Categorias
    </div>
    <div class="categorias">
        <div class="mCustomScrollbar" data-mcs-theme="dark">
            <?php
                include("cms/include_cms/include_conexao.php");
                $sql="select * from categoria";
                $select=mysqli_query($con, $sql);
                while($rs=mysqli_fetch_array($select)){
              ?>
                <div class="menu_categorias">
                  <?php echo($rs['nome_categoria']);?>

                  <ul class="menu_subCategorias">
                    <?php
                      $sql_sub="select * from sub_categoria as s inner join categoria_subCategoria as sc on(sc.id_subCategoria=s.id_subCategoria)";
                      $sql_sub.=" where sc.id_categoria = ".$rs['id_categoria'];
                      $select_sub=mysqli_query($con, $sql_sub);;

                      while($rs_sub=mysqli_fetch_array($select_sub)){
                    ?>
                    <li><a href="index.php?filtro=<?php echo($rs_sub['id_subCategoria']);?>&modo=filtrar"><?php echo($rs_sub['nome_subCategoria']);?></a></li>
                    <?php }?>
                  </ul>
                </div>
              <?php } ?>
        </div>
    </div>
</div>
