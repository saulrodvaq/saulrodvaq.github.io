<?php
session_start(); // Inicia la sesión si no ha sido iniciada antes
include("../../templates/conexion.php");

// Recopilar los datos del formulario
$idAlumno = $_SESSION["idAlumno"];
$matricula = $_POST["matricula"];
$nombres = $_POST["nombres"];
$apellidos = $_POST["apellidos"];
$carrera = $_POST["carrera"];
$idTutor = $_POST["idTutor"];
$idInstructor = $_POST["idInstructor"];
$empresa = $_POST["empresa"];
$semana = $_POST["semana"];
$f_Inicio = $_POST["f_Inicio"];
$f_Fin = $_POST["f_Fin"];
$cuatrimestre = $_POST["cuatrimestre"];


// Calcular las fechas de los días de la semana (Lunes a Viernes) basándose en la fecha de finalización (Viernes)
$timestamp_f_Fin = strtotime($f_Fin); // Convertir la fecha de finalización a un timestamp
$numero_dia_f_Fin = date("N", $timestamp_f_Fin); // Obtener el número de día de la semana correspondiente a la fecha de finalización

$timestamp_f_Inicio = $timestamp_f_Fin - (($numero_dia_f_Fin - 1) * 24 * 60 * 60); // Calcular la fecha de inicio de semana (Lunes)

$fecha_L = date("d-m-Y", $timestamp_f_Inicio);
$fecha_M = date("d-m-Y", $timestamp_f_Inicio + (24 * 60 * 60));
$fecha_Mi = date("d-m-Y", $timestamp_f_Inicio + (2 * 24 * 60 * 60));
$fecha_J = date("d-m-Y", $timestamp_f_Inicio + (3 * 24 * 60 * 60));
$fecha_V = date("d-m-Y", $timestamp_f_Fin);

$resumen_L = $_POST["resumen_L"];
$resumen_M = $_POST["resumen_M"];
$resumen_Mi = $_POST["resumen_Mi"];
$resumen_J = $_POST["resumen_J"];
$resumen_V = $_POST["resumen_V"];

$imagenL = ''; // Inicializar la variable imagen para el día lunes
$imagenM = ''; // Inicializar la variable imagen para el día martes
$imagenMi = ''; // Inicializar la variable imagen para el día miercoles
$imagenJ = ''; // Inicializar la variable imagen para el día jueves
$imagenV = ''; // Inicializar la variable imagen para el día viernes

if (isset($_FILES['img_L']) && is_uploaded_file($_FILES['img_L']['tmp_name'])) {
  $file_path = 'imagenes/borradores/' . $_FILES['img_L']['name']; // Ruta donde se almacenará la imagen
  $imagenL = $file_path; // Almacenar la ruta en la variable imagen
  move_uploaded_file($_FILES['img_L']['tmp_name'], $file_path); // Mover la imagen al directorio
}

if (isset($_FILES['img_M']) && is_uploaded_file($_FILES['img_M']['tmp_name'])) {
  $file_path = 'imagenes/borradores/' . $_FILES['img_M']['name']; // Ruta donde se almacenará la imagen
  $imagenM = $file_path; // Almacenar la ruta en la variable imagen
  move_uploaded_file($_FILES['img_M']['tmp_name'], $file_path); // Mover la imagen al directorio
}

if (isset($_FILES['img_Mi']) && is_uploaded_file($_FILES['img_Mi']['tmp_name'])) {
  $file_path = 'imagenes/borradores/' . $_FILES['img_Mi']['name']; // Ruta donde se almacenará la imagen
  $imagenMi = $file_path; // Almacenar la ruta en la variable imagen
  move_uploaded_file($_FILES['img_Mi']['tmp_name'], $file_path); // Mover la imagen al directorio
}

if (isset($_FILES['img_J']) && is_uploaded_file($_FILES['img_J']['tmp_name'])) {
  $file_path = 'imagenes/borradores/' . $_FILES['img_J']['name']; // Ruta donde se almacenará la imagen
  $imagenJ = $file_path; // Almacenar la ruta en la variable imagen
  move_uploaded_file($_FILES['img_J']['tmp_name'], $file_path); // Mover la imagen al directorio
}

if (isset($_FILES['img_V']) && is_uploaded_file($_FILES['img_V']['tmp_name'])) {
  $file_path = 'imagenes/borradores/' . $_FILES['img_V']['name']; // Ruta donde se almacenará la imagen
  $imagenV = $file_path; // Almacenar la ruta en la variable imagen
  move_uploaded_file($_FILES['img_V']['tmp_name'], $file_path); // Mover la imagen al directorio
}

// Insertar los datos en la base de datos
$sql = "INSERT INTO borradores (idAlumno, matricula, nombres, apellidos, carrera, empresa, idTutor, idInstructor, semana, f_Inicio, f_Fin, cuatrimestre, fecha_L, resumen_L, img_L, fecha_M, resumen_M, img_M, fecha_Mi, resumen_Mi, img_Mi, fecha_J, resumen_J, img_J, fecha_V, resumen_V, img_V) VALUES ('$idAlumno','$matricula', '$nombres', '$apellidos', '$carrera', '$empresa','$idTutor', '$idInstructor', '$semana', '$f_Inicio', '$f_Fin', '$cuatrimestre', '$fecha_L', '$resumen_L','$imagenL', '$fecha_M', '$resumen_M', '$imagenM', '$fecha_Mi', '$resumen_Mi', '$imagenMi', '$fecha_J', '$resumen_J', '$imagenJ', '$fecha_V', '$resumen_V', '$imagenV')";
if ($conn->query($sql) == TRUE) {
  // Obten el ID del último informe insertado
  $last_id = $conn->insert_id;
  
  // Redirecciona a invoice.php con el id del informe como parámetro GET
  header("Location: edit_borrador.php?id=" . $last_id); 
} else {
  echo "Error al guardar los datos: " . $conn->error;
}


$conn->close();
?>
