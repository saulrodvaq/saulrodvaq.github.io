<?php
include("../../templates/conexion.php");

if (isset($_GET['idEmpresa'])) {
    $idEmpresa = $_GET['idEmpresa'];

    // Actualizar el estatus_empresa a "Activo"
    $query = "UPDATE empresas SET estatus_empresa='Activo' WHERE idEmpresa='$idEmpresa'";
    $respuesta = mysqli_query($conn, $query);

    if ($respuesta) {
        $msg = "Se activó correctamente la empresa.";
    } else {
        $msg = "Error al activar la empresa. Intente nuevamente.";
    }

    header("Location: empresas_desvinculadas.php?msg=$msg");
    exit(); // Importante: asegúrate de salir del script después de redirigir
}
?>