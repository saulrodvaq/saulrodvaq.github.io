<?php
//Datos que vienen al momento de postularse ../../index.php
include("../../templates/conexion.php");

$idEmpresa = $_POST['idEmpresa'];
$nombreEmp = $_POST['nombreEmp'];
$calle= $_POST['calle'];
$colonia = $_POST['colonia'];
$municipio = $_POST['municipio'];
$calle = $_POST['calle'];
$numero = $_POST['numero'];
$cp = $_POST['cp'];
$giro = $_POST['giro'];
$parqueIndustrial = $_POST['parqueIndustrial'];
$permite_imagenes = $_POST['permite_imagenes'];
$nombreC = $_POST['nombreC'];
$telefono = $_POST['telefono'];
$correo = $_POST['correo'];
$puesto = $_POST['puesto'];
$ingreso = date("Y-m-d H:i:s");

//Llenar registros a la tabla empresas.
$query = "INSERT INTO empresas (nombreEmp, colonia, municipio, calle, numero, cp, giro, parqueIndustrial, permite_imagenes, nombreC, telefono, correo, puesto, ingreso) VALUES ('$nombreEmp', '$colonia', '$municipio', '$calle', '$numero', '$cp', '$giro', '$parqueIndustrial', '$permite_imagenes', '$nombreC', '$telefono', '$correo', '$puesto', '$ingreso')";

$respuesta = mysqli_query($conn, $query);
if ($respuesta) {
    $msg = "Se agregó correctamente la empresa.";
} else {
    $msg = "Error... intente de nuevo.";
}

//Redirección una vez que se llenen los datos.
mysqli_close($conn);
header("Location: empresas.php?msg=$msg");
?>