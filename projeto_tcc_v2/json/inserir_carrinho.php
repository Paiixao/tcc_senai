<?php
  include('../cms/include_cms/include_conexao.php');
  session_start();

  $res = "Erro: Não foi possivel encontrar o parametro id";

  if(isset($_GET['id'])){
    $id=$_GET['id'];
    $qtd=$_GET['qtd'];
    
    //Verificando se o carrinho já foi criado para esse cliente
    if($_SESSION['carrinho']==0){
      $sql="insert into carrinho(id_cliente) values('".$_SESSION['cliente']['id_cliente']."');";
      $select=mysqli_multi_query($con, $sql);
      $_SESSION['carrinho'] = 1;
    }else{
      $select=1;
    }

    //Se o carrinho de compras foi criado e relacionando ao cliente
    if($select){
      $sql="select * from carrinho where id_cliente = ".$_SESSION['cliente']['id_cliente'].";";
      $select=mysqli_query($con, $sql);

      //Se o select retornou algo
      if($select){
        $rs=mysqli_fetch_array($select);

        $sql_prato="select * from carrinho as c inner join carrinho_prato cp on(cp.id_carrinho=c.id_carrinho) ";
        $sql_prato.="where id_cliente = ".$_SESSION['cliente']['id_cliente'];
        $select_prato=mysqli_query($con, $sql_prato);

        $inserido=0;

        while($rs_prato=mysqli_fetch_array($select_prato)){
          if($rs_prato['id_prato']==$id) $inserido++;
        }

        //Se o prato já não foi inserido  
        if($inserido==0){
        
          $sql="insert into carrinho_prato(id_carrinho, id_prato, qtd) values('".$rs['id_carrinho']."', '".$id."', '".$qtd."');";

          //Se o prato foi inserido com sucesso
          if(mysqli_query($con, $sql)){
            $res="1";
          }else{
            $res="Registro não inserido. Query: ".$sql;
          }

        }else{
          $res="0";
        }
      
      }else{
        $res="Erro: ".$sql;
      }

    }else{
      $res="Erro: ".$sql;
    }
  }

  echo $res;

?>
