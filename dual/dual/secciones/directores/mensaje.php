<?php //Datos que vienen al momento de postularse ../../index.php
include("../../templates/conexion.php");
$idDirector=$_POST['idDirector'];
$tipo=$_POST['tipo'];
$matricula=$_POST['matricula'];
$nombres=$_POST['nombres'];
$apellidos=$_POST['apellidos'];
$usuario=$_POST['matricula'];
$password=$_POST['password'];

//Llenar registros a la tabla usuarios.
$query="insert into directores values('','$tipo','$matricula','$nombres','$apellidos','$usuario','$password');"; //Llenar registros de tablas de la base de datos usuarios
$respuesta=mysqli_query($conn,$query);
if ($respuesta)
{
    $msg="Se agregó correctamente el director.";
}
else
{
    $msg="Error... intente de nuevo!.";
}
//Redirección una vez cuando que se llenen los datos.
mysqli_close($conn);
header("Location: directores.php?msg=$msg");


?>