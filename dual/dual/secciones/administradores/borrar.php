<?php
include("../../templates/conexion.php");
$user=$_GET['idAdministrador'];
$query="delete from administradores where idAdministrador='$user'";
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
header("Location: administradores.php?msg=$msg");
?>