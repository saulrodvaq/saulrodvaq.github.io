<?php
include("../templates/conexion.php");

// Obtener los datos enviados por la solicitud AJAX
$data = json_decode(file_get_contents("php://input"), true);
$id = $data['id'];
$retro = $data['retro'];
$estatus = $data['estatus'];

// Verificar si no se proporcionó retroalimentación y asignar "Sin retroalimentación"
if (empty($retro)) {
    $retro = "Sin retroalimentación.";
}

// Actualizar los campos 'retro_instructor' y 'estatus_instructor' en la base de datos para el ID correspondiente
$sql = "UPDATE reportes SET retro_instructor = '$retro', estatus_instructor = '$estatus' WHERE idReporte = '$id'";
if ($conn->query($sql) === TRUE) {
    // La actualización fue exitosa
    $response = array('success' => true);
    echo json_encode($response);
} else {
    // Hubo un error en la actualización
    $response = array('success' => false, 'message' => 'Error al guardar la retroalimentación');
    echo json_encode($response);
}

$conn->close();
?>