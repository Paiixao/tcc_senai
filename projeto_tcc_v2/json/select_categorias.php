<?php 
	include('../cms/include_cms/include_conexao.php');
	 $sql="SELECT * FROM categoria_subcategoria AS csb INNER JOIN categoria AS c ON(c.id_categoria = csb.id_categoria)";
   $sql.=" INNER JOIN sub_categoria AS sb ON (sb.id_subCategoria = csb.id_subCategoria) order by csb.id_categoria desc;";
   $query = mysqli_query($con, $sql);
	 $categorias = [];

  	while($rs=mysqli_fetch_array($query)) {
  		$categorias[] = array('id_categoria' => $rs['id_categoria'], 'nome_categoria' => $rs['nome_categoria'],
  			'id_subCategoria' => $rs['id_subCategoria'], 'nome_subCategoria' => $rs['nome_subCategoria']);
  	}

  	echo json_encode($categorias);
?> 
