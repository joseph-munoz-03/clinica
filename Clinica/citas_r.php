<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
include 'db.php';

$resultado = $conexion->query("SELECT * FROM citas ORDER BY id DESC");
$fecha = [];
$hora = [];
$odontologo = [];
$estado = [];
$paciente_id = [];

while ($fila = $resultado->fetch_assoc()) {
    $fecha [] = $fila;
    $hora [] = $fila;
    $odontologo [] = $fila;
    $estado [] = $fila;
    $documento [] = $fila;
}

echo json_encode($fecha || $hora || $odontologo || $estado || $documento);

?>