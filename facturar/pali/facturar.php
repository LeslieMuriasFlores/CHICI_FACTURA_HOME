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
//-------------------------------------------------------------------------------------------------

$propietario  = isset($_REQUEST['p']) ? $_REQUEST['p'] : '';
$gestor = '';

$marcar_descuento = '';
$marcar_descuento2 ='';
$bDescuento = isset($_POST['descuento']) ? $_POST['descuento'] : 0;
if($bDescuento == 0){
    $marcar_descuento = "checked";
}else{
    $marcar_descuento2 = "checked";
}


//eliminar facturas
$bEliminar_factura = isset($_REQUEST['EF']) ? $_REQUEST['EF'] : '';
if(!empty($bEliminar_factura)){
    $sSql="DELETE FROM factura WHERE id <> '' ";
    $conn->query($sSql);

    echo "Facturas Eliminadas con exito...";
}

//si hay registros en tabla -facturas..mostrar boton eliminar facturas .
$sSqlfactura="select id from factura order by id DESC";
$result1 = $conn->query($sSqlfactura);
$bRegistro_facturas = $result1->rowCount();
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

    <div id="jsonDiv"></div>
    <div class="container">
        <div class="lbl-menu">
            <label for="radio1">Factura</label>
            <a href="index.php" style="color: white;" >Inicio</a> &nbsp;&nbsp;&nbsp;&nbsp;
            <a href="report.php" style="color: white;" >Reportes</a>
            <label class="extremaD" ><?php echo " Qué Bolá! : ".$_SESSION['usr_nombre']; ?></label>
        </div>
        
        <div class="content">            
            <input type="radio" name="radio" id="radio1" checked>
            <div class="tab1" style="background-color: transparent;">
                <center>
                    <h1 class="title has-text-centered"><span style="color:red;">CHICHI !! y la Factura ? ...</span></h1>
                    <small><i>¡TOMA CHOCOLATE Y PAGA LO QUE DEBES!</i></small>
                </center>

                
                
                <br><br>
                <h3><span style="color:red;"><i> FACTURA </i></span></h3>

                        <label class="label">ID Factura
                            <input class="input" name="n" id="n" type="text" placeholder="ID.." autocomplete="off" value="">
                        </label>
                        <br>
        

                        <label class="label">Propietario</label>
                        <?php 
                            crear_combo_propietario('p',$propietario,$conn);

                        ?>

                        <br>
                        <label class="label">Fecha
                            <input class="input" name="f" id="f" type="date" value="">
                        </label>

                        <br>
                        <label class="label" >Gestor: </label>
                            <input type="text" name="gestor" id="gestor"  value= <?php echo $_SESSION['usr_nombre']; ?> readonly >
                        <br>
                        <br>
       
                <form action="" id="frmUsers">
                    <fieldset>
                        <legend>DETALLE PRODUCTOS</legend>
                        <label class="label">Producto o Servicio
                            <input class="input" name="producto" type="text" placeholder="" autocomplete="off">
                       </label>
          
      
                        <label class="label">Precio Unitario
                            <input class="input" name="precio" type="text" placeholder="" autocomplete="off">
                        </label>
        
                        <br>
                        <label class="label">ALTO QUIEN VA ? : </label>
                        <label id="divCheck"></label>

                        <br>

                        <label class="label">Está LA MADRINA del PALI ?:
                        <label class="label">Si 
                        <input type="radio" name="descuento" id="descuento"  value="1"  <?php echo $marcar_descuento;?>></label>
                        <label class="label">No
                        <input type="radio" name="descuento" id="descuento"  value="0"  <?php echo $marcar_descuento2;?>></label>
                        </label>

                        <br>
                        <label class="label">Integro : </label>
                        <label id="divCheck_integro"></label>

                        <br>
                        <button id="btnAdd" type="button">
                            <span >
                                Add Producto
                            </span>
                        </button>

                    </fieldset>
                <br>
                        <center>
                            <button id="btnSave" type="button" >
                                Guardar Factura
                            </button>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                        </center>
                </form> 

            </div>
            
        </div>
    </div>
    
</body>
<footer class="footer">
    <center>
    <div id="divElements"></div>

    <div id="divAlertas"></div>
</footer>
</center>

<script src="index.js"></script>
</html>






