<?php
include("../../templates/conexion.php");
$user=$_GET['idFormador'];
$query="delete from formadores where idFormador='$user'";
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
header("Location: formadores_dual.php?msg=$msg");
?>