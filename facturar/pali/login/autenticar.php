<?php
session_start();
require('../../conexion.php');


$user = isset($_REQUEST['nombre']) ? $_REQUEST['nombre'] : '';
$pass = isset($_REQUEST['password']) ? $_REQUEST['password'] : '';
$_SESSION['usr_id']="";


if(!empty($user) && !empty($pass)){
    $sSql="SELECT id,usr,privilegio FROM usuarios WHERE usr='".$user."' and clave='".$pass."' ";
    $result = $conn->prepare($sSql);
    $result->execute();
}

if(!empty($result)){
	$n=1;
	while($aRow = $result->fetch(PDO::FETCH_ASSOC)){
		$_SESSION['usr_nombre']= $aRow['usr'];
		$_SESSION['usr_id']= $aRow['id'];
		$_SESSION['usr_privilegio']= $aRow['privilegio'];


	}
}


if(!empty($_SESSION['usr_id'])){

	echo "<script languaje='JavaScript'>";
	echo "location.href='../index.php'";
	echo "</script>";


}else{
	
	echo "<script languaje='JavaScript'>";
	echo "location.href='login.html'";
	echo "</script>";

}


?>