<?php 
	include('../cms/include_cms/include_conexao.php');
	$res=0;

	$avaliacao=$_GET['avaliacao'];
	$id_prato=$_GET['id_prato'];

	$sql="insert into avaliacao(avaliacao, id_prato) ";
	$sql.="values('".$avaliacao."', '".$id_prato."');";
	$res=$sql;
	if(mysqli_query($con, $sql)){
		$sql="select count(*) as likes from avaliacao where avaliacao = 1";
		$select=mysqli_query($con, $sql);
		$rs=mysqli_fetch_array($select);

		$res=$rs['likes'];
	}

	echo $res;
?> 

