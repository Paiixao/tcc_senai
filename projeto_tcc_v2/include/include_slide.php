<div class="flexslider">
                
    <ul class="slides">
        <?php 
            include('cms/include_cms/include_conexao.php');
            $sql="select * from slide";
            $select=mysqli_query($con, $sql);

            while($rs=mysqli_fetch_array($select)){
        ?>
        <li>
            <img src="<?php echo('cms/'.$rs['img_slide']); ?>" alt="">
            <section class="flex-caption">
            </section>
        </li>

        <?php } ?>    
    </ul>
</div>
