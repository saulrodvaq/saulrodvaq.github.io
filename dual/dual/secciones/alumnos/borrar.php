<?php
include("../../templates/conexion.php");
$user=$_GET['idAlumno'];
$query="DELETE FROM alumnos WHERE idAlumno='$user'";
$respuesta=mysqli_query($conn,$query);
if ($respuesta)
{
    $msg="Se eliminó correctamente el registro.";
}
else
{
    $msg="Imposible eliminar... ocurrió un error!.";
}
mysqli_close($conn);
header("Location: alumnos.php?msg=$msg");
?>