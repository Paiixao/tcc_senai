<?php 
	include("../cms/include_cms/include_conexao.php");
	session_start();

	$res="";

	if(isset($_GET['valor'])){
		$valor=$_GET['valor'];
		$arr_pratos=$_GET['lst_pratos'];
		$_SESSION['pedido']=array('valor' => $valor, 'lst_pratos' => $arr_pratos);

		$res="Fase 1: OK";
	}

	if(isset($_GET['id_endereco'])){
		$endereco=$_GET['id_endereco'];
		$_SESSION['pedido']['endereco']=$endereco;
		
		$res="Fase 2: OK";
	}


	if(isset($_GET['forma_pagamento'])){

		$formas_pagamento=$_GET['forma_pagamento'];
		$_SESSION['pedido']['formas_pagamento']=$formas_pagamento;
		
		$sql="insert into pedido(id_cliente, valor_compra, id_enderecoEntrega, forma_pagamento) ";
		$sql.="values('".$_SESSION['cliente']['id_cliente']."', '".$_SESSION['pedido']['valor']."', '".$_SESSION['pedido']['endereco']."', ";
		$sql.="'".$_SESSION['pedido']['formas_pagamento']."');";
		$select=mysqli_query($con, $sql);

		if($select){
			$sql="select last_insert_id() as id_pedido;";
			$select=mysqli_query($con, $sql);
			$rs=mysqli_fetch_array($select);
			$arr_pratos=$_SESSION['pedido']['lst_pratos'];

			$_SESSION['pedido']['id_pedido']=$rs['id_pedido'];
			$sql="";

			foreach ($arr_pratos as $key => $item) {
				$sql.= "insert into pedido_prato(id_pedido, id_prato, qtd) ";
				$sql.="values('".$rs['id_pedido']."', '".$item['id_prato']."', '".$item['qtd']."');";
				$sql.="delete from carrinho_prato where id_prato=".$item['id_prato'].";";
			}

			if(mysqli_multi_query($con, $sql)) $res="Fase 3: Ok";
			else $res = $sql;
		}
	}

	echo json_encode($res);
 ?>