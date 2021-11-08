<?php 
	include('../cms/include_cms/include_conexao.php');

	$comentario=$_POST['txtComentario'];
	$nome_cliente=$_POST['txtNome_coment'];
	$email=$_POST['txtEmail_coment'];
	$id_prato=$_POST['id_prato'];

	$sql="insert into avaliacao_comentario(comentario, nome_cliente, email, id_prato) ";
	$sql.="values('".$comentario."', '".$nome_cliente."', '".$email."', '".$id_prato."');";

	if(!mysqli_query($con, $sql)) echo $sql;
	else{
		?>
			<script type="text/javascript">
				window.history.go(-1);
			</script>
		<?php
	}
?> 
