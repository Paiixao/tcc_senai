<?php
    include('../cms/include_cms/include_conexao.php');

    $nome=$_GET['usuario'];
    $senha=$_GET['senha'];
    $ip=$_SERVER['SERVER_ADDR'];
    $res = null;

    $sql = "call login('".$nome."', '".$senha."', '".$ip."', @resultado)";
    mysqli_query($con, $sql);

    $sql = "select @resultado";
    $select = mysqli_query($con, $sql);
    $rs = mysqli_fetch_array($select);

    if($rs['@resultado'] == 1){
       $sql="select * from cliente where email like '".$nome."';";
       $select = mysqli_query($con, $sql);
       $rs=mysqli_fetch_array($select);

       $res = $rs;

    }

    if($res!=null) echo json_encode($res);
    else echo null;
?>
