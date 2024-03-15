<?php

include("../../templates/conexion.php");

$idReporte = $_GET['id'];

$sql = "SELECT * FROM reportes WHERE idReporte = '$idReporte'";
$resultado = $conn->query($sql);

if ($resultado->num_rows > 0) {
  $reporte = $resultado->fetch_assoc();
} else {
  echo "No se encontró el reporte.";
  exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Obtener los valores de los campos del formulario
  $idAlumno = $_POST['idAlumno'];
$matricula = $_POST["matricula"];
$nombres = $_POST["nombres"];
$apellidos = $_POST["apellidos"];
$carrera = $_POST["carrera"];
$idTutor = $_POST["idTutor"];
$idInstructor = $_POST["idInstructor"];
$empresa = $_POST["empresa"];
$resumen_L = $_POST["resumen_L"];
$resumen_M = $_POST["resumen_M"];
$resumen_Mi = $_POST["resumen_Mi"];
$resumen_J = $_POST["resumen_J"];
$resumen_V = $_POST["resumen_V"];
  
$imagenL = '';
$imagenM = ''; // Inicializar la variable imagen para el día martes
$imagenMi = ''; // Inicializar la variable imagen para el día miercoles
$imagenJ = ''; // Inicializar la variable imagen para el día jueves
$imagenV = ''; // Inicializar la variable imagen para el día viernes

if (isset($_FILES['img_L']) && is_uploaded_file($_FILES['img_L']['tmp_name'])) {
  $file_path = 'imagenes/reportes/' . $_FILES['img_L']['name']; // Ruta donde se almacenará la imagen
  $imagenL = $file_path; // Almacenar la ruta en la variable imagen
  move_uploaded_file($_FILES['img_L']['tmp_name'], $file_path); // Mover la imagen al directorio
}

if (isset($_FILES['img_M']) && is_uploaded_file($_FILES['img_M']['tmp_name'])) {
  $file_path = 'imagenes/reportes/' . $_FILES['img_M']['name']; // Ruta donde se almacenará la imagen
  $imagenM = $file_path; // Almacenar la ruta en la variable imagen
  move_uploaded_file($_FILES['img_M']['tmp_name'], $file_path); // Mover la imagen al directorio
}

if (isset($_FILES['img_Mi']) && is_uploaded_file($_FILES['img_Mi']['tmp_name'])) {
  $file_path = 'imagenes/reportes/' . $_FILES['img_Mi']['name']; // Ruta donde se almacenará la imagen
  $imagenMi = $file_path; // Almacenar la ruta en la variable imagen
  move_uploaded_file($_FILES['img_Mi']['tmp_name'], $file_path); // Mover la imagen al directorio
}

if (isset($_FILES['img_J']) && is_uploaded_file($_FILES['img_J']['tmp_name'])) {
  $file_path = 'imagenes/reportes/' . $_FILES['img_J']['name']; // Ruta donde se almacenará la imagen
  $imagenJ = $file_path; // Almacenar la ruta en la variable imagen
  move_uploaded_file($_FILES['img_J']['tmp_name'], $file_path); // Mover la imagen al directorio
}

if (isset($_FILES['img_V']) && is_uploaded_file($_FILES['img_V']['tmp_name'])) {
  $file_path = 'imagenes/reportes/' . $_FILES['img_V']['name']; // Ruta donde se almacenará la imagen
  $imagenV = $file_path; // Almacenar la ruta en la variable imagen
  move_uploaded_file($_FILES['img_V']['tmp_name'], $file_path); // Mover la imagen al directorio
}

  // Actualizar los valores en la tabla "reportes"
  $sql = "UPDATE reportes SET resumen_L = '$resumen_L', img_L = '$imagenL', resumen_M = '$resumen_M', img_M = '$imagenM', resumen_Mi = '$resumen_Mi', img_Mi = '$imagenMi', resumen_J = '$resumen_J', img_J = '$imagenJ', resumen_V = '$resumen_V', img_V = '$imagenV', estatus_tutor = 'sin_revisar', estatus_instructor = 'sin_revisar' WHERE idReporte = '$idReporte'";
  $resultado = $conn->query($sql);
  if ($resultado) {
    $_SESSION['success_message'] = "El reporte ha sido actualizado correctamente en la tabla 'reportes'.";
  } else {
    $_SESSION['error_message'] = "Error al actualizar el reporte en la tabla 'reportes': " . $conn->error;
  }

  // Insertar nuevo reporte en la tabla "edit_reportes" con el idReporteOriginal
  $sql = "INSERT INTO edit_reportes (
    idReporteOriginal,
    idAlumno,
    matricula, 
    nombres, 
    apellidos, 
    carrera, 
    empresa,
    idInstructor, 
    idTutor, 
    resumen_L,
    img_L,
    resumen_M,
    img_M, 
    resumen_Mi,
    img_Mi, 
    resumen_J,
    img_J,
    resumen_V,
    img_V

  ) VALUES (
    '$idReporte',
    '$idAlumno',
    '$matricula',
    '$nombres', 
    '$apellidos', 
    '$carrera', 
    '$empresa',
    '$idInstructor', 
    '$idTutor', 
    '$resumen_L',
    '$imagenL', 
    '$resumen_M',
    '$imagenM',
    '$resumen_Mi',
    '$imagenMi', 
    '$resumen_J',
    '$imagenJ', 
    '$resumen_V',
    '$imagenV'
  )";
  $resultado = $conn->query($sql);

  if ($resultado) {
    $_SESSION['success_message'] .= " El nuevo reporte también ha sido creado correctamente en la tabla 'edit_reportes'.";
  } else {
    $_SESSION['error_message'] .= " Error al crear el nuevo reporte en la tabla 'edit_reportes': " . $conn->error;
  }

  // Redirigir a la página de edición del reporte
  header("Location: ../../menu_alumnos.php");
  exit;
}
exit;
$conn->close();
?>