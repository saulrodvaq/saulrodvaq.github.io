<?php
include("conexion.php"); //Conectar a la base de datos.

$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$matricula = $_POST['matricula'];
$carrera = $_POST['carrera'];
$empresa = $_POST['empresa'];
$cuatrimestre = $_POST['cuatrimestre'];
$tutor = ""; //Asumimos que este campo es opcional y lo dejamos vacío.
$usuario = ""; //Asumimos que este campo es opcional y lo dejamos vacío.
$password = ""; //Asumimos que este campo es opcional y lo dejamos vacío.
$telefono = $_POST['telefono'];
$correo = $_POST['correo'];

//Insertar registros en la tabla usuarios.
$query = "INSERT INTO alumnos (nombres, apellidos, matricula, carrera, empresa, cuatrimestre, tutor, usuario, password, telefono, correo) VALUES ('$nombres','$apellidos','$matricula','$carrera','$empresa','$cuatrimestre','$tutor','$usuario','$password','$telefono','$correo')";

$respuesta = mysqli_query($conn, $query);
if ($respuesta) {
    $msg = "Se agregó correctamente el usuario!!!";
} else {
    $msg = "Error... intente de nuevo!!!";
}

//Redirección una vez que se llenen los datos.
mysqli_close($conn);
header("Location: Menu_Admin.php?msg=$msg");
exit();
?>