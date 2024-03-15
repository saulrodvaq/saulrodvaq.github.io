<?php
include("../../templates/conexion.php");
if(isset($_POST["idSubdirector"])) {
    // Obtener los valores actualizados de los campos de entrada del formulario
    $idSubdirector = $_POST["idSubdirector"];
    $tipo = $_POST["tipo"];
    $nombres = $_POST["nombres"];
    $apellidos = $_POST["apellidos"];
    $matricula = $_POST["matricula"];
    $carrera = $_POST["carrera"];
    $usuario = $_POST["usuario"];
    $password = $_POST["password"];

    // Consulta para actualizar los datos del subdirector correspondiente
    $query = "UPDATE subdirectores SET 
            tipo = '$tipo', 
            nombres = '$nombres', 
            apellidos = '$apellidos',
            carrera = '$carrera',
            usuario = '$usuario', 
            matricula = '$matricula', 
            password = '$password' 
            WHERE idSubdirector = $idSubdirector";
    mysqli_query($conn, $query);

    // Redirigir a la página de inicio
    header("Location: subdirectores.php");
    exit();
}
?>