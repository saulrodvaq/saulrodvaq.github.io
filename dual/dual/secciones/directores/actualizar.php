<?php
include("../../templates/conexion.php");
if(isset($_POST["idDirector"])) {
    // Obtener los valores actualizados de los campos de entrada del formulario
    $idDirector = $_POST["idDirector"];
    $tipo = $_POST["tipo"];
    $nombres = $_POST["nombres"];
    $apellidos = $_POST["apellidos"];
    $matricula = $_POST["matricula"];
    $usuario = $_POST["usuario"];
    $password = $_POST["password"];

    // Consulta para actualizar los datos del director correspondiente
    $query = "UPDATE directores SET 
            tipo = '$tipo', 
            nombres = '$nombres', 
            apellidos = '$apellidos', 
            usuario = '$usuario', 
            matricula = '$matricula', 
            password = '$password' 
            WHERE idDirector = $idDirector";
    mysqli_query($conn, $query);

    // Redirigir a la página de inicio
    header("Location: directores.php");
    exit();
}
?>