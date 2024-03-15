<?php
include("../../templates/conexion.php");

if(isset($_POST["idAlumno"]) && isset($_POST["idDocente"])) {
    // Obtener los valores de idAlumno y idDocente
    $idAlumno = $_POST["idAlumno"];
    $idDocente = $_POST["idDocente"];

    // Verificar si ya existe una asignación para el alumno y el docente
    $query_verificar = "SELECT * FROM alumnos_docentes WHERE idAlumno = $idAlumno AND idDocente = $idDocente";
    $resultado_verificar = mysqli_query($conn, $query_verificar);
    $num_filas = mysqli_num_rows($resultado_verificar);

    if ($num_filas > 0) {
        // La asignación ya existe, enviar una respuesta con un mensaje de error
        $response = array(
            "success" => false,
            "message" => "El alumno ya está asignado a este docente."
        );
        echo json_encode($response);
        exit;
    } else {
        // Insertar la asignación en la tabla alumnos_docentes
        $query_insertar = "INSERT INTO alumnos_docentes (idAlumno, idDocente) VALUES ($idAlumno, $idDocente)";
        $resultado_insertar = mysqli_query($conn, $query_insertar);

        if ($resultado_insertar) {
            // La asignación se insertó correctamente en la tabla alumnos_docentes
            // Insertar la asignación en el historial_docentes
            $query_insertar_historial = "INSERT INTO historial_docentes (idAlumno, idDocente, fecha_asignacion) VALUES ($idAlumno, $idDocente, NOW())";
            $resultado_insertar_historial = mysqli_query($conn, $query_insertar_historial);

            if ($resultado_insertar_historial) {
                // La asignación se insertó correctamente en el historial_docentes
                $response = array(
                    "success" => true,
                    "message" => "El alumno ha sido asignado correctamente al docente.",
                    "reload" => true // Recargar la página después de mostrar la alerta
                );
                echo json_encode($response);
                exit;
            } else {
                // Hubo un error al insertar la asignación en el historial_docentes, eliminar la asignación en la tabla alumnos_docentes
                $query_eliminar = "DELETE FROM alumnos_docentes WHERE idAlumno = $idAlumno AND idDocente = $idDocente";
                $resultado_eliminar = mysqli_query($conn, $query_eliminar);

                $response = array(
                    "success" => false,
                    "message" => "Hubo un error al asignar el alumno al docente. Por favor, inténtalo de nuevo."
                );
                echo json_encode($response);
                exit;
            }
        } else {
            // Hubo un error al insertar la asignación en la tabla alumnos_docentes
            $response = array(
                "success" => false,
                "message" => "Hubo un error al asignar el alumno al docente. Por favor, inténtalo de nuevo."
            );
            echo json_encode($response);
            exit;
        }
    }
} else {
    // Los valores de idAlumno y idDocente no están definidos, enviar una respuesta con un mensaje de error
    $response = array(
        "success" => false,
        "message" => "No se proporcionaron los datos necesarios para asignar el alumno al docente."
    );
    echo json_encode($response);
    exit;
}
?>