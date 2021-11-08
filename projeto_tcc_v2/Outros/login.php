<?php 
    include('../cms/include_cms/include_conexao.php');

    if(isset($_POST['btnLogin'])){

        $nome=$_POST['txtUsuario'];
        $senha=$_POST['txtSenha'];
        $ip=$_SERVER['SERVER_ADDR'];

        $sql = "call login('".$nome."', '".$senha."', '".$ip."', @resultado)";
        mysqli_query($con, $sql);

        $sql = "select @resultado";
        $select = mysqli_query($con, $sql);
        $rs = mysqli_fetch_array($select);

        if($rs['@resultado']==1){
           ?><script type="text/javascript">alert("Cliente");</script><?php
        
        }elseif($rs['@resultado']==2){
            $sql="select * from usuario as u inner join nivel as n on(n.id_nivel=u.id_nivel)"; 
            $sql.="inner join nivel_pagina as np on(np.id_nivel=n.id_nivel) inner join pagina as p on (p.id_pagina=np.id_pagina) ";
            $sql.="where nome_usuario = '".$nome."';";
            $select = mysqli_query($con, $sql);
            $rs=mysqli_fetch_array($select);
           
                $_SESSION['usuario_cms'] = $rs;
                // echo json_encode($rs);
            
            header("location:../cms/");
        
        }else{
            ?>
                <script type="text/javascript">
                    alert("Usuario ou senha incorretos! Por favor, tente novamente");
                    window.history.go(-1);
                </script>
            <?php
        }
    }



 ?>