<?php
include("../../templates/conexion.php");
$user=$_GET['idInstructor'];
$query="delete from instructores where idInstructor='$user'";
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
header("Location: instructores.php?msg=$msg");
?>