<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

include ("db.php");

$datos = json_decode(file_get_contents("php://input"), true);
$fecha = trim($datos["nombre"]);
$hora = trim($datos["documento"]);
$odontologo = trim($datos["telefono"]);
$estado = trim($datos ["correo"]);
$paciente_id = trim($datos["paciente_id"]);

if (empty ($fecha || $hora || $odontologo || $estado || $paciente_id)){
    echo json_encode([
        "exito" => false,
        "mensaje" => "Ningún campo puede estar vacío"
    ]),
    exit;
}

$stmt = $conexion->prepare("INSERT INTO citas (fecha, hora, odontologo, estado, paciente_id) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $fecha, $hora, $odontologo, $estado, $paciente_id);

if ($stmt->execute()){
    echo json_encode([
        "exito" => true,
        "mensaje" => "Cita creada exitosamente"
    ]);
} else {
    echo json_encode([
        "exito" => false,
        "mensaje" => "Error al crear la cita
        
        : " . $conexion->error
    ]);
}

