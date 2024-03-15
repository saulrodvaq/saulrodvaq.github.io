<?php
include("../../templates/conexion.php");
$idCarrera=$_GET['idCarrera'];
$query="DELETE FROM carreras WHERE idCarrera='$idCarrera'";
$respuesta=mysqli_query($conn,$query);
if ($respuesta)
{
    $msg="Se eliminó correctamente la carrera.";
}
else
{
    $msg="Imposible eliminar... ocurrió un error!.";
}
mysqli_close($conn);
header("Location: catalogo.php?msg=$msg");
?>