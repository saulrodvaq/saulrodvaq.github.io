<?php
include("../../templates/conexion.php");
$user=$_GET['idSubdirector'];
$query="delete from subdirectores where idSubdirector='$user'";
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
header("Location: subdirectores.php?msg=$msg");
?>