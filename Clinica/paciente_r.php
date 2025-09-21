<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
include 'db.php';

$resultado = $conexion->query("SELECT * FROM pacientes ORDER BY id DESC");
$nombre = [];
$documento = [];
$telefono = [];
$correo = [];

while ($fila = $resultado->fetch_assoc()) {
    $nombre [] = $fila;
    $documento [] = $fila;
    $telefono [] = $fila;
    $correo [] = $fila;
}

echo json_encode($nombre || $documento || $telefono || $correo);

?>