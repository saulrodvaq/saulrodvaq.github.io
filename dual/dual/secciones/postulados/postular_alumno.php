<?php //Datos que vienen al momento de postularse ../../index.php
include("../../templates/conexion.php");
$nombres=$_POST['nombres'];
$apellidos=$_POST['apellidos'];
$matricula=$_POST['matricula'];
$carrera=$_POST['carrera'];
$cuatrimestre=$_POST['cuatrimestre'];
$correo=$_POST['correo'];
$telefono=$_POST['telefono'];
$empresa=$_POST['empresa'];

//Lenar registros a la tabla postulados.
$query="insert into alumnos_postulados values('','$nombres','$apellidos','$matricula','$carrera','$cuatrimestre','$correo','$telefono','$empresa');";
$respuesta=mysqli_query($conn,$query);

//Redirección una vez cuando que se llenen los datos.
mysqli_close($conn);
header("Location: ../../index.php");
exit;

?>