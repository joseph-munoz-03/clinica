<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
include 'db.php';

$datos = json_decode(file_get_contents("php://input"), true);
$id = intval($datos['id']);

if ($id <= 0) {
    echo json_encode([
        "exito" => false,
        "mensaje" => "ID de tarea inválido"
    ]);
    exit;
}

$stmt = "DELETE FROM pacientes WHERE id = $id";
if ($conexion->query($stmt)) {
    echo json_encode([
        "exito" => true,
        "mensaje" => "Paciente eliminado exitosamente"
    ]);

} else {
    echo json_encode([
         "exito" => false,
          "mensaje" => "Error al eliminar al paciente: " . $conexion->error
    ]);    
}


?>

