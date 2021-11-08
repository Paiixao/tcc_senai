<?php 
	include("../include_cms/include_conexao.php");

	$id=$_GET['id'];

	$sql = "select  * from sub_categoria as sc inner join categoria_subCategoria as cs on(cs.id_subCategoria=sc.id_subCategoria) where cs.id_categoria = ".$id;
	$select = mysqli_query($con, $sql);
	$dados = [];

	while($rs=mysqli_fetch_array($select)){
		$dados[] = array("id_subCategoria" => $rs['id_subCategoria'],"nome_subCategoria" => $rs['nome_subCategoria']);
	}

	echo json_encode($dados);
 ?>