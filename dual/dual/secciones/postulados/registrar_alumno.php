<?php
include("../../templates/conexion.php");

$idPostulado = $_GET['idPostulado'];

// Obtener los datos del postulado
$query = "SELECT nombres, apellidos, matricula, carrera, cuatrimestre FROM alumnos_postulados WHERE idPostulado = $idPostulado";
$resultado = mysqli_query($conn, $query);
$postulado = mysqli_fetch_assoc($resultado);

// Generar una contraseña aleatoria de 10 caracteres
$password = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 6);

// Obtener la fecha y hora actual en formato "YYYY-MM-DD HH:MM:SS"
$fecha_ingreso = date("Y-m-d H:i:s");

// Insertar los datos del postulado como nuevo usuario en la tabla alumnos
$queryInsert = "INSERT INTO alumnos (nombres, apellidos, matricula, carrera, cuatrimestre, usuario, password)
        VALUES ('" . $postulado['nombres'] . "', '" . $postulado['apellidos'] . "', '" . $postulado['matricula'] . "', '" . $postulado['carrera'] . "', '". $postulado['cuatrimestre'] . "', '" . $postulado['matricula'] . "', '" . $password . "')";

$resultadoInsert = mysqli_query($conn, $queryInsert);

if ($resultadoInsert) {
    // Eliminar el registro del postulado de la tabla postulados
    $queryDelete = "DELETE FROM alumnos_postulados WHERE idPostulado = $idPostulado";
    $resultadoDelete = mysqli_query($conn, $queryDelete);

    if ($resultadoDelete) {
        $msg = "El alumno se ha dado de alta exitosamente.";
    } else {
        $msg = "Ha ocurrido un error al eliminar el registro del postulado.";
    }
} else {
    $msg = "Ha ocurrido un error al dar de alta al alumno.";
}

header("Location: alumnos_postulados.php?msg=$msg");
exit();
?>