<?php //Datos que vienen al momento de postularse ../../index.php
include("../../templates/conexion.php");
$idEmpresa=$_POST['idEmpresa'];
$nombreEmp=$_POST['nombreEmp'];
$colonia=$_POST['colonia'];
$municipio=$_POST['municipio'];
$calle=$_POST['calle'];
$numero=$_POST['numero'];
$cp=$_POST['cp'];
$giro=$_POST['giro'];
$parqueIndustrial=$_POST['parqueIndustrial'];
$nombreC=$_POST['nombreC'];
$telefono=$_POST['telefono'];
$correo=$_POST['correo'];
$puesto=$_POST['puesto'];

//Lenar registros a la tabla empresas.
$query="insert into empresas_postuladas values('','$nombreEmp','$colonia','$municipio','$calle','$numero','$cp','$giro','$parqueIndustrial','$nombreC','$telefono','$correo','$puesto');";
$respuesta=mysqli_query($conn,$query);

//Redirección una vez cuando que se llenen los datos.
mysqli_close($conn);
header("Location: ../../index.php");

?>