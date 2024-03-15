<?php
include("../../templates/conexion.php");
$idEmpresaPostulada = $_GET['idEmpresaPostulada'];

// Obtener los datos del postulado
$query = "SELECT nombreEmp, colonia, municipio, calle, numero, cp, giro, parqueIndustrial, nombreC, telefono, correo, puesto FROM empresas_postuladas WHERE idEmpresaPostulada = $idEmpresaPostulada";
$resultado = mysqli_query($conn, $query);
$postulado = mysqli_fetch_assoc($resultado);

// Obtener la fecha y hora actual en formato "YYYY-MM-DD HH:MM:SS"
$fecha_ingreso = date("Y-m-d H:i:s");

// Insertar los datos del postulado como nuevo usuario en la tabla empresas
$queryInsert = "INSERT INTO empresas (nombreEmp, colonia, municipio, calle, numero, cp, giro, parqueIndustrial, nombreC, telefono, correo, puesto, ingreso) VALUES ('" . $postulado['nombreEmp'] . "', '" . $postulado['colonia'] . "', '" . $postulado['municipio'] . "', '" . $postulado['calle'] . "', '" . $postulado['numero'] . "', '" . $postulado['cp'] . "', '" . $postulado['giro'] . "', '" . $postulado['parqueIndustrial'] . "', '" . $postulado['nombreC'] . "', '" . $postulado['telefono'] . "', '" . $postulado['correo'] . "', '" . $postulado['puesto'] . "', '" . $fecha_ingreso . "')";

$resultadoInsert = mysqli_query($conn, $queryInsert);

if ($resultadoInsert) {
    // Eliminar el registro del postulado de la tabla postulados
    $queryDelete = "DELETE FROM empresas_postuladas WHERE idEmpresaPostulada = $idEmpresaPostulada";
    $resultadoDelete = mysqli_query($conn, $queryDelete);

    if ($resultadoDelete) {
        $msg = "La empresa se ha dado de alta exitosamente";
    } else {
        $msg = "Ha ocurrido un error al eliminar el registro del postulado.";
    }
} else {
    $msg = "Ha ocurrido un error al dar de alta a la empresa.";
}

header("Location: empresas_postuladas.php?msg=$msg");
exit();
?>