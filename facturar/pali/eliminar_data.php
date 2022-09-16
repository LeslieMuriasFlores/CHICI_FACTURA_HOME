<?php
require('../conexion.php');

$bRegistros = isset($_REQUEST['r']) ? $_REQUEST['r'] : '';
$bFactura = isset($_REQUEST['f']) ? $_REQUEST['f'] : '';
$bOK = 0;

if($bRegistros == 1){
    $sSql="DELETE FROM participantes WHERE nombre <> '' ";
    $conn->query($sSql);
    $bOK = 1;
}
  
echo $bOK;

?>    
