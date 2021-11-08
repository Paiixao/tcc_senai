<?php 
	include('../cms/include_cms/include_conexao.php');
	$sql_img = "SELECT * FROM imagem_prato WHERE id_prato =".$_GET['id']." limit 4";
  	$select_img = mysqli_query($con, $sql_img);
  	$imagens = [];

  	while($rs=mysqli_fetch_array($select_img)) {
  		$imagens[] = array('imagem' => $rs['imagem']);
  	}

  	echo json_encode($imagens);
?> 
