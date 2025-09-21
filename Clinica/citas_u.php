<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

include 'db.php';

$datos = json_decode(file_get_contents("php://input"), true);
$id = intval($datos['id']);
$estado = $datos['estado'] === 'pendiente' ? 'confirmada' : ($datos['estado'] === 'confirmada' ? 'cancelada' : 'pendiente');

$stmt = $conexion->prepare("INSERT INTO citas (estado) VALUES (?)");
$stmt->bind_param("s", $paciente_id);

if ($stmt->execute()){
    echo json_encode([
        "exito" => true,
        "mensaje" => "Tarea creada exitosamente"
    ]);
} else {
    echo json_encode([
        "exito" => false,
        "mensaje" => "Error al crear la tarea: " . $conexion->error
    ]);
}