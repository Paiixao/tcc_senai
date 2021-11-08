<?php 
  include('../cms/include_cms/include_conexao.php');
  session_start();
  $qtd = 0;
  
  if(isset($_SESSION['cliente'])){
    $sql="select count(*) as qtde from carrinho as c inner join carrinho_prato cp on(cp.id_carrinho=c.id_carrinho) ";
    $sql.="where id_cliente = ".$_SESSION['cliente']['id_cliente'];
    $query = mysqli_query($con, $sql);
    $rs=mysqli_fetch_array($query);
    $qtd=$rs['qtde'];    
  }

  echo $qtd;
?> 
