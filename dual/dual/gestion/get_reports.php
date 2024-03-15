<?php
session_start(); // Inicia la sesión

include '../templates/conexion.php'; // Asegúrate de que esta ruta es correcta

// Obtiene el idAlumno de la sesión actual
$idAlumno = $_SESSION['idAlumno'];

$query = "SELECT * FROM reportes WHERE idAlumno = ?";
if ($stmt = $conn->prepare($query)) {
    $stmt->bind_param('i', $idAlumno);
    $stmt->execute();

    $result = $stmt->get_result();
    $reports = $result->fetch_all(MYSQLI_ASSOC);

    header('Content-Type: application/json');
    echo json_encode($reports);
} else {
    echo "Error: " . $conn->error;
}
$conn->close();
?>