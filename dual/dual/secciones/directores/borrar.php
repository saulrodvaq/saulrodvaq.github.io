<?php
include("../../templates/conexion.php");
$user=$_GET['idDirector'];
$query="delete from directores where idDirector='$user'";
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
header("Location: directores.php?msg=$msg");
?>