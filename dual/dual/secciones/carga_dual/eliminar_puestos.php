<?php
include("../../templates/conexion.php");
// Verificar si se reciben los parámetros esperados
if (isset($_GET['idEmpresa']) && isset($_POST['puesto'])) {
    $idEmpresa = $_GET['idEmpresa'];
    $puestoId = $_POST['puesto'];

    // Primero, elimina las asignaturas asociadas a este puesto en la tabla puestos_asignaturas
    $stmtAsignaturas = $conn->prepare("DELETE FROM puestos_asignaturas WHERE idPuesto = ?");
    $stmtAsignaturas->bind_param("i", $puestoId); // "i" indica que se espera un valor entero para el parámetro

    // Ejecuta la consulta
    if ($stmtAsignaturas->execute()) {
        // La eliminación de las asignaturas asociadas al puesto fue exitosa
    } else {
        // Ocurrió un error al eliminar las asignaturas asociadas al puesto
        $response = array(
            'status' => 'error',
            'message' => 'Error al eliminar las asignaturas asociadas al puesto'
        );
        echo json_encode($response);
        exit();
    }

    // Ahora procede a eliminar el puesto en la tabla puestos
    $stmt = $conn->prepare("DELETE FROM puestos WHERE idPuesto = ?");
    $stmt->bind_param("i", $puestoId);

    // Ejecuta la consulta
    if ($stmt->execute()) {
        // La eliminación del puesto fue exitosa
        $response = array(
            'status' => 'success',
            'message' => 'Puesto eliminado correctamente'
        );
        echo json_encode($response);
    } else {
        // Ocurrió un error al eliminar el puesto
        $response = array(
            'status' => 'error',
            'message' => 'Error al eliminar el puesto'
        );
        echo json_encode($response);
    }

    exit();
}
?>