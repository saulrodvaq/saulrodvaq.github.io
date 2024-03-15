<?php
include("../../templates/conexion.php");
$user=$_GET['idTutor'];
$query="delete from tutores where idTutor='$user'";
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
header("Location: tutores.php?msg=$msg");
?>