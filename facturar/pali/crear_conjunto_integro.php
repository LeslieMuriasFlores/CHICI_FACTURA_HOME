<?php
require('../conexion.php');

$aDeudores = array();
$conjunto_check_integro = '<input class="checkbox" name="integro[]" type="hidden"  value="0"  id="integro[]">';
if(!empty($_REQUEST['v'])){
        $propietario = isset($_REQUEST['v']) ? $_REQUEST['v'] : '';

        $sSql="SELECT nombre FROM participantes";
        $result=$conn->query($sSql);

        while($aRow = $result->fetch(PDO::FETCH_ASSOC)){
            if($aRow['nombre'] <> $propietario){
                array_push($aDeudores, $aRow['nombre']);
            }

        } 

}

if(!empty($aDeudores)){
    foreach($aDeudores as $item){
        $conjunto_check_integro .= $item.'<input class="checkbox" name="integro[]" type="checkbox"  value="'.$item.'"  id="integro[]">';
    }
    
    echo $conjunto_check_integro;
}



?>    
