<?php 
session_start();
require('../conexion.php');

//funciones
function crear_combo_propietario($sNombre,$nDefault,$conn)
{ 
        
        $sSql="select nombre from participantes order by nombre DESC";
        $result = $conn->query($sSql); 

        echo "<SELECT onchange='cambioOpcionesCheck()' name='$sNombre' id='$sNombre'>"; 
        echo "<option $sSelected value=''>-----</option>";

        while($aRow = $result->fetch(PDO::FETCH_ASSOC)){
            $sSelected="";
            if ($aRow['nombre']==$nDefault) $sSelected="selected";
           echo "<option $sSelected value='".$aRow['nombre']."'>".$aRow['nombre']."</option>";

        } 
        echo "</SELECT>";


        //poner el return de esta funcion....ojo.
    
        /*Se debe cerrar todo objeto que se crea*/
        //$result= null;
        /*CLOSE CONNECTION*/
        //$conn= null;
}
//---------------------------------------------------------------------------------------------------------------
$calcularR1x1  = isset($_REQUEST['R1x1']) ? $_REQUEST['R1x1'] : '';
$propietarioR1x1  = isset($_REQUEST['propietario_reporte1x1']) ? $_REQUEST['propietario_reporte1x1'] : '';
$deudorR1x1  = isset($_REQUEST['deudor_reporte1x1']) ? $_REQUEST['deudor_reporte1x1'] : '';
//----------------------------------------------------------------------------------

?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="estilos.css">

    <script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>

</head>
<body>
    <div class="container">
        <div class="lbl-menu">
            <label for="radio1">Reportes</label>
            <a href="index.php" style="color: white;" >Inicio</a> &nbsp;&nbsp;&nbsp;&nbsp;
            <a href="facturar.php" style="color: white;" >Facturar</a>
  
        </div>
        
        <div class="content"> 
            
            <input type="radio" name="radio" id="radio1" checked>
            <div class="tab1" style="background-color: transparent;">
                <p>Aqui se pone buena la talla ...aca va la logica y caculo muestra de los reportes</p>
                <form method="POST" action="?">
                    <label class="label">Propietario</label>
                    <?php 
                        crear_combo_propietario('propietario_reporte1x1',$propietarioR1x1,$conn);

                    ?>

                    <label class="label">Deudor</label>
                    <?php 
                        crear_combo_propietario('deudor_reporte1x1',$deudorR1x1,$conn);
                    ?>

                    <input class="" name="R1x1" type="submit"  value="Calcular">

                </form>
                <?php 

                    if(!empty($calcularR1x1)){

                        echo $propietarioR1x1."    ".$deudorR1x1;

                        echo '<iframe name="I22"  border="1" frameborder="0" src="reportes.php?p='.$propietarioR1x1.'&d='.$deudorR1x1.'" style="height: 600px; width:1000px"> El explorador no admite los marcos flotantes o no est&Atilde;&iexcl; configurado actualmente para mostrarlos.</iframe>';
                    }


                ?>
               
            </div>
            
        </div>
    </div>
    
</body>
<footer class="footer">
</footer>

<script src="index.js"></script>
</html>






