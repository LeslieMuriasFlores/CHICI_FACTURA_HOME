<?php
session_start();
require('../conexion.php');

$sTabla_reporte_productos = '';
$suma_precios_total = 0;
$gestor = $_SESSION['usr_nombre'];

//echo "***".$gestor;

//uno participante a (propietario) con respecto a otro (deudor)
$deuda  = 0;
$propietario  = isset($_REQUEST['p']) ? $_REQUEST['p'] : '';
//$gestor  = isset($_REQUEST['g']) ? $_REQUEST['g'] : '';
$deudor  = isset($_REQUEST['d']) ? $_REQUEST['d'] : '';

$WP = "WHERE propietario='".$propietario."' AND gestor='".$gestor."' ";
$sSql="SELECT id,no_factura,detalle,propietario,fecha FROM factura ".$WP;

//echo "<pre>$sSql</pre>";


$result=$conn->query($sSql);




$n=1;
while($aRow = $result->fetch(PDO::FETCH_ASSOC)){

    $id              = $aRow['id'];
    $no_factura      = $aRow['no_factura'];
    $propietario     = $aRow['propietario'];
    $fecha           = $aRow['fecha'];

    $detalle = $aRow['detalle'];

/*    echo "<pre>";
    print_r(json_decode($detalle, true)) ; 
    echo "</pre>";*/


    $aDetalle = json_decode($detalle,true);
/*
    echo "<pre>";
    print_r($aDetalle);
    echo "</pre>";*/

    //recorrer el array de detalles..
    foreach ($aDetalle as $producto) {//para cada producto.
        $aDeudores = explode(",", $producto['deudor']);
        foreach($aDeudores as $item){//recorriendo el array de deudores de ese producto de turno
            if($item==$deudor){//suma monto a pagar por deudor seleccionado (request d)

                $sProducto = $producto['producto'];
                $nPrecio = $producto['precio'];
                $nMonto = $producto['monto'];
                $sDeudores = $producto['deudor'];

                $sTabla_reporte_productos .= "
                    <tr>
                        <td>".$n."</td>
                        <td>".$sProducto."</td>
                        <td>".$nPrecio."</td>
                        <td>".$nMonto."</td>
                        <td>".$sDeudores."</td>
                    </tr>";

                    //echo "<br>".$nPrecio."<br>";
                $suma_precios_total +=  $nPrecio;
                $deuda += $nMonto;  

            }


        }

    }

    
    $n++;
}

$sTitulo= "<center><span style='color:red;'>REPORTE 1x1 FULANO: $deudor le debe a MENGANO: $propietario -- ".$deuda."</span></center>";

$sResumen_totales='
<div>
    <center><h4><span style="color:red;">TOTAL PRECIOS: '.$suma_precios_total.' ********  TOTAL A PAGAR: '.$deuda.'</span></h4></center>
</div>';



?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>FACTURANDO V-1.0</title>
    <!--<link rel="stylesheet" href="styles.css">-->
    <link rel="stylesheet" href="estilos.css">

    <script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>

    <link rel="stylesheet" type="text/css" href="jquery/Paginador.css"> 
    <script type="text/javascript" src="jquery/jquery.min.js"></script>
    <script type="text/javascript" src="jquery/Paginador.js"></script>

</head>
<body>

    <div class="container">
        <div class="container-fluid">

            <h3><?php  echo $sTitulo; ?><h3>

                <BR>
                <BR>
            <table id="tbInfo" name="tbInfo" class="display">

                <thead class="bg-dark">
                    <tr>
                       <!-- columnas -->
                        <th>#</th>
                        <th>PRODUCTO</th>
                        <th>PRECIO</th>
                        <th>MONTO</th>
                        <th>DEUDORES</th>
                    </tr>
                </thead>
                <tbody class="example">
                    <?php echo $sTabla_reporte_productos; ?>
                </tbody>
            </table>   

            <?php echo $sResumen_totales; ?>         
        </div>
    </div>

    <script src="index.js"></script>
    <script>
    $(document).ready(function () {
        $('#tbInfo').DataTable(
            {
                "language": {
                    "url": "jquery/Spanish.json"
                }
            });
    })
</script> 
</body>
</html>