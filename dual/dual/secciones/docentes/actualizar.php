<?php
include("../../templates/conexion.php");
if(isset($_POST["idDocente"])) {
    // Obtener los valores actualizados de los campos de entrada del formulario
    $idDocente = $_POST["idDocente"];
    $nombres = $_POST["nombres"];
    $apellidos = $_POST["apellidos"];
    $matricula = $_POST["matricula"];
    $usuario = $_POST["usuario"];
    $password = $_POST["password"];

    // Consulta para actualizar los datos del docente correspondiente
    $query = "UPDATE docentes SET 
            nombres = '$nombres', 
            apellidos = '$apellidos', 
            usuario = '$usuario', 
            matricula = '$matricula', 
            password = '$password' 
            WHERE idDocente = $idDocente";
    mysqli_query($conn, $query);

    // Redirigir a la página de inicio
    header("Location: docentes.php");
    exit();
}
?>