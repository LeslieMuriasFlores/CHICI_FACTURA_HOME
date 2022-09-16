<?php

date_default_timezone_set('America/Costa_Rica');

$host = 'localhost';
$dbname = 'id18334823_cuentas';
$username = 'id18334823_casapavas';
$password = '\ZrQ76d|j~~r@U=T';
     
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

} catch (PDOException $pe) {
    die("Could not connect to the database $dbname :" . $pe->getMessage());
}


?>




