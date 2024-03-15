<?php
include("../../templates/conexion.php");
$user=$_GET['idEmpresa'];
$query="delete from empresas where idEmpresa='$user'";
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
header("Location: empresas.php?msg=$msg");
?>