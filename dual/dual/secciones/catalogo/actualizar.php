<?php
include("../../templates/conexion.php");
if(isset($_POST["idAsignatura"])) {
    // Obtener los valores actualizados de los campos de entrada del formulario
$nombre = $_POST['nombre'];
$competencia = $_POST['competencia'];
$idCuatrimestre = $_POST['idCuatrimestre'];
$idCarrera = $_POST['idCarrera'];

    // Consulta para actualizar los datos del usuario correspondiente
    $query = "UPDATE asignaturas SET 
            nombre= '$nombre',
            idCuatrimestre= '$idCuatrimestre',
            competencia= '$competencia',
            idCarrera= '$idCarrera',
            WHERE idAsignatura = $idAsignatura";
    mysqli_query($conn, $query);

    // Redirigir a la página de inicio
    header("Location: ver_asignaturas.php?idCarrera=$idCarrera");
    exit();
}
?>