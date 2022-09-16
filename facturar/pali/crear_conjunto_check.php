<?php
require('../conexion.php');

$aDeudores = array();
$conjunto_check = '<input class="checkbox" name="dividir[]" type="hidden"  value="0"  id="dividir[]">';
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
        $conjunto_check .= $item.'<input class="checkbox" name="dividir[]" type="checkbox"  value="'.$item.'"  id="dividir[]">';
    }
    
    echo $conjunto_check;
}



?>    
