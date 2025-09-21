<?php

$Servidor = 'localhost';
$Usuario = 'root';
$Contraseña = '' ;
$Bd = 'clinica_db';

$conexion = new mysqli ($Servidor, $Usuario, $Contraseña, $Bd);

if ($conexion->connect_error) {
    die("La conexión falló: " . $conexion->connect_error);

}



?>


