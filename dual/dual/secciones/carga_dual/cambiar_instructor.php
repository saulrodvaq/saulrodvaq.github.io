<?php
include("../../templates/conexion.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $alumnoId = $_POST['alumnoId'];
    $nuevoInstructor = $_POST['nuevoInstructor'];

    // Obtener la fecha actual
    $fechaAsignacion = date('Y-m-d');

    // Actualizar el instructor del alumno en la base de datos
    $updateQuery = "UPDATE alumnos SET idInstructor = $nuevoInstructor WHERE idAlumno = $alumnoId";
    $success = mysqli_query($conn, $updateQuery);

    if ($success) {
        // Insertar un registro en la tabla historial_instructores
        $insertQuery = "INSERT INTO historial_instructores (idAlumno, idInstructor, fecha_asignacion) 
                        VALUES ($alumnoId, $nuevoInstructor, '$fechaAsignacion')";
        $insertSuccess = mysqli_query($conn, $insertQuery);

        if ($insertSuccess) {
            // El instructor se asignó correctamente y se registró en el historial
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        } else {
            // No se pudo insertar en el historial de instructores
            echo "No se pudo insertar en el historial de instructores. Por favor, intenta nuevamente.";
        }
    } else {
        // No se pudo actualizar el instructor
        echo "No se pudo actualizar el instructor. Por favor, intenta nuevamente.";
    }
} else {
    // Método de solicitud inválido
    echo "Método de solicitud inválido. Por favor, intenta nuevamente.";
}
?>