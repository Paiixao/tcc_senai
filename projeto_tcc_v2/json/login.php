<?php 
    session_start();

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
           $sql="select * from cliente where email like '".$nome."';";
           $select = mysqli_query($con, $sql);
           $rs=mysqli_fetch_array($select);
           
           $_SESSION['cliente'] = $rs;
           $_SESSION['carrinho'] = 0;

           header("location: ../index.php");
        
        }elseif($rs['@resultado']==2){
            $sql="select * from usuario where nome_usuario like '".$nome."'";
            $select = mysqli_query($con, $sql);
            $rs=mysqli_fetch_array($select);
           
            $_SESSION['usuario_cms'] = $rs;
            
            header("location: ../cms/index.php");
        
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