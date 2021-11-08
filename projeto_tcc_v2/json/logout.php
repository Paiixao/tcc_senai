<?php 
	if(isset($_GET['logout']) && isset($_SESSION['cliente'])){
        $sql="delete from carrinho where id_cliente=".$_SESSION['cliente']['id_cliente'];
        mysqli_query($con, $sql);

        session_destroy();
        ?><script type="text/javascript">window.location="index.php";</script><?php
    }
 ?>