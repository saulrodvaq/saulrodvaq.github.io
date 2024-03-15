<?php
include("../../templates/conexion.php");
if(isset($_POST["idAdministrador"])) {
    // Obtener los valores actualizados de los campos de entrada del formulario
    $idAdministrador = $_POST["idAdministrador"];
    $nombres = $_POST["nombres"];
    $apellidos = $_POST["apellidos"];
    $matricula = $_POST["matricula"];
    $usuario = $_POST["usuario"];
    $password = $_POST["password"];

    // Consulta para actualizar los datos del administrador correspondiente
    $query = "UPDATE administradores SET 
            nombres = '$nombres', 
            apellidos = '$apellidos', 
            usuario = '$usuario', 
            matricula = '$matricula', 
            password = '$password' 
            WHERE idAdministrador = $idAdministrador";
    mysqli_query($conn, $query);

    // Redirigir a la página de inicio
    header("Location: administradores.php");
    exit();
}
?>