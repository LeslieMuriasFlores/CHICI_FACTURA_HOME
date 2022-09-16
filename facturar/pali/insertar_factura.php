<?php 

require('../conexion.php');

$insertado = 0;
$no_factura    = $_REQUEST['n'];
$detalle       = $_REQUEST['d'];
$propietario   = $_REQUEST['p'];
$fecha         = $_REQUEST['f'];
$gestor        = $_REQUEST['g'];


$sSql="INSERT INTO factura (no_factura,detalle,propietario,fecha,gestor ) VALUE ( '$no_factura','$detalle','$propietario','$fecha','$gestor')";
	$bOK=$conn->prepare($sSql);
	$bOK->execute();

	$count = $bOK->rowCount();

	if($count > 0){
		$insertado=1;
	}

	echo $insertado;




?>