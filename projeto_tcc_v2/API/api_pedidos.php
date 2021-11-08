<?php

	include('../cms/include_cms/include_conexao.php');

	$id=$_GET['id'];

	$sql="select *, date_format(p.dt_compra, '%Y-%m-%d') as dt_compra from pedido as p inner join cliente as c on(c.id_cliente=p.id_cliente) ";
    $sql.="inner join pedido_prato as pp on(pp.id_pedido=p.id_pedido) ";
    $sql.="inner join endereco as e on(e.id_endereco=p.id_enderecoEntrega) ";
    $sql.="inner join cidade as ci on(ci.id_cidade=e.id_cidade) ";
    $sql.="inner join estado as es on(es.id_estado=ci.id_estado) ";
    $sql.="inner join tipo_endereco as tp on(tp.id_tipoEndereco=e.id_tipoEndereco) ";
    $sql.="inner join status_pedido as sp on(sp.id_pedido=p.id_pedido) ";
    $sql.="inner join status as s on(s.id_status=sp.id_status) ";
    $sql.="where sp.id_pedido=p.id_pedido and sp.data = (select max(data) from status_pedido where id_pedido = sp.id_pedido)";
    $sql.="and sp.id_status = 5 and c.id_cliente = '".$id."' group by p.id_pedido "; 
    $sql.="order by p.id_pedido desc";
    $select=mysqli_query($con, $sql);

    $res = null;

    while($rs=mysqli_fetch_array($select)) $res[] = $rs;
 	
 	if($res!= null) echo json_encode($res);
    else echo null;
?>
