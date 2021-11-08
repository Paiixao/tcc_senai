<?php
  include('../cms/include_cms/include_conexao.php');
  $sql = " select * from prato as p left join promocao_prato as pp on(pp.id_prato=p.id_prato)";
  $sql .=" left join promocao as pr on(pr.id_promocao=pp.id_promocao)";
  $sql .=" inner join imagem_prato as ip on(ip.id_prato=p.id_prato) WHERE ip.img_principal = 1  AND p.status = 1";
  $sql .=" AND p.id_prato = ".$_GET['id']." GROUP BY p.id_prato";
  $select = mysqli_query($con, $sql);


  while($rs=mysqli_fetch_array($select)) {
    if(strlen($rs['descricao']) > 60){
      $rs['descricao']=substr($rs['descricao'], 0, 60);
    }
    
    $dados = array('id_prato' => $rs['id_prato'], 'nome_prato' => $rs['nome_prato'], 'qtd_calorias' => $rs['qtd_calorias'], 'descricao' => $rs['descricao'], 
    	'img_prato' => $rs['imagem'], 'preco' => $rs['preco'], 'desconto' => $rs['desconto']);
  }

  echo json_encode($dados);

?>
