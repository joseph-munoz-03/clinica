<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

include ("db.php");

$datos = json_decode(file_get_contents("php://input"), true);
$nombre = trim($datos["nombre"]);
$documento = trim($datos["documento"]);
$telefono = trim($datos["telefono"]);
$correo = trim($datos ["correo"]);

if (empty ($nombre || $documento || $telefono || $correo)){
    echo json_encode([
        "exito" => false,
        "mensaje" => "Ningún campo puede estar vacío"
    ]),
    exit;
}

$stmt = $conexion->prepare("INSERT INTO pacientes (nombre, documento, telefono, correo) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $nombre, $documento, $telefono, $correo);

if ($stmt->execute()){
    echo json_encode([
        "exito" => true,
        "mensaje" => "Paciente creado exitosamente"
    ]);
} else {
    echo json_encode([
        "exito" => false,
        "mensaje" => "Error al crear al paciente: " . $conexion->error
    ]);
}

