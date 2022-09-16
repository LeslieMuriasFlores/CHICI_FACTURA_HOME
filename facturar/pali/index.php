<?php 
session_start();
require('../conexion.php');

if(empty($_SESSION['usr_id'])){
    echo "<script languaje='JavaScript'>";
    echo "location.href='login/login.html'";
    echo "</script>";
}

$gestor = $_SESSION['usr_nombre'];

$alerta = '';
$bElim = '';

$dHoy  = isset($_REQUEST['fp']) ? $_REQUEST['fp'] : date("Y-m-d");
$cant_participantes = isset($_REQUEST['np']) ? $_REQUEST['np'] : '';
$boton_cantidad_participantes = isset($_REQUEST['BP']) ? $_REQUEST['BP'] : '';

//insertando valores en tabla participantes
$boton_participantes = isset($_REQUEST['GN']) ? $_REQUEST['GN'] : '';

//eliminar participantes
$bEliminar_participantes = isset($_REQUEST['EP']) ? $_REQUEST['EP'] : '';
if(!empty($bEliminar_participantes)){
    $sSql="DELETE FROM participantes WHERE nombre <> '' ";
    $conn->query($sSql);
}
  

if(!empty($boton_participantes)){

    $nombre = $_REQUEST['nombre_participante'];
    //print_r($nombre);
    foreach ($nombre as $participante) {
        $sSql="INSERT INTO participantes (nombre,fecha,gestor) VALUE ( '$participante','$dHoy','$gestor' )";
        $bOK=$conn->prepare($sSql);
        $bOK->execute();
    }


    $alerta = "<h2><span style='color: green'><i>Estamos listos para FACTURAR, <a href='facturar.php'>vamos.. !</a></i><span></h2>";
}

//si hay registros en tabla -participantes..mostrar alerta de comenzar .
$sSql="select nombre from participantes where gestor='".$gestor."' order by nombre DESC";
$result = $conn->query($sSql);
$bRegistro_participantes = $result->rowCount();
//$result = null;
//$conn = null;

if($bRegistro_participantes > 0)
    $alerta = "<h2><span style='color: green'><i>Estamos listos para FACTURAR, <a href='facturar.php'>vamos.. !</a></i><span></h2>";
//-----------------------------------------------------------------------------------



?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>FACTURANDO V-1.0</title>
    <link rel="stylesheet" href="estilos.css">
    <script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>

</head>
<body>

    <div class="container">
        <div class="lbl-menu">
            <label for="radio1">Registro</label>
            <label class="extremaD" ><?php echo " Qué Bolá! : ".$_SESSION['usr_nombre']; ?></label>
        </div>
        
        <div class="content">
           
            <input type="radio" name="radio" id="radio1" checked>
            <div class="tab1" style="background-color: transparent;">
                <h1><span style="color:red;"><i> ¡ Se FoRMó 'EL' TiTiNGó !</i></span></h1>

                        <form name="form1" id="from1">

                            <?php 
                            if($bRegistro_participantes == 0){
                                if(empty($boton_participantes)){
                                    echo '
                                        <label class="label">Cantidad participantes</label>
                                        <input class="input" name="np" id="np" size="3" type="text" autocomplete="off" value="'.$cant_participantes.'">

                                        <label class="label">Fecha</label>
                                        <input class="input" name="fp" id="fp" type="date" value="'.$dHoy.'">
                                        <input class="" name="BP" type="submit"  value="Continuar">';
                                }    
                            }

                            ?>
                            
                        </form>
                     
                            <br>
                            <br>

                            <?php

                            echo '<form method="POST" action="?" name="form2" id="from2">';
                            if(!empty($boton_cantidad_participantes)){
                                for($i=1;$i<=$cant_participantes;$i++){
                                    echo '
                                        <label class="label">Nombre : </label>
                                        <input class="input" name="nombre_participante[]" id="nombre_participante[]" type="text" placeholder="Pipo - '.$i.'" autocomplete="off" value=""><br>';
                                }
                                echo '<input class="" name="GN" type="submit"  value="Continuar">';
                            }
                            
                            echo '</form>';
                            echo $alerta;
                            ?>

                            <br>
                            <br>

                            <form name="form3" id="from3">
                            <?php
                                if($bRegistro_participantes <> 0){
                                   echo '<center><input class="" name="EP" type="submit"  value="Eliminar Registro Participantes"></center>';
                                }
                                
                            ?> 
                            </form>

                            

                                                                                                        
            </div>   
            
        </div>

    </div>


</body>

<footer class="footer">
</footer>

<script src="index.js"></script>




</html>






