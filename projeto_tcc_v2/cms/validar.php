<?php 

function validar_numero($valor){
    $reg='/^[a-zA-Z]/';
    return preg_match($reg, $valor);
}

function validar_tel($tel){
	$reg="/\([1-9]{2}\)[0-9]{4}\-[0-9]{4}/";
	return preg_match($reg, $tel);
}

function validar_email($email){
	$reg = '/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|';
	$reg .= '(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/';

	return preg_match($reg, $email);
}

function validar_tempo($tempo){
	$reg = '/([01]\d|2[0-3]):([0-5]\d)/';
	return preg_match($reg, $tempo);
}

function validar_data($data){
	$reg = '/(\d+)(-|\/)(\d+)(?:-|\/)(?:(\d+)\s+(\d+):(\d+)(?::(\d+))?(?:\.(\d+))?)?/';
	return preg_match($reg, $data);
}

 ?>