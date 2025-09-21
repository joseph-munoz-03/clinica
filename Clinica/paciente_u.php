<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

include ("db.php");

$datos = json_decode(file_get_contents("php://input"), true);
$nombre = trim($datos["nombre"]);
$telefono = trim($datos["telefono"]);
$correo = trim($datos ["correo"]);
$id = intval($datos['id']);

if (empty ($nombre || $telefono || $correo || $id)){
    echo json_encode([
        "exito" => false,
        "mensaje" => "Ningún campo puede estar vacío"
    ]),
    exit;
}

$stmt = $conexion->prepare("UPDATE pacientes (nombre, telefono, correo) VALUES (?, ?, ?) FROM id = ?");
$stmt->bind_param("ssss", $nombre, $telefono, $correo, $id);

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

