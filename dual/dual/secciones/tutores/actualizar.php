<?php
include("../../templates/conexion.php");
if(isset($_POST["idTutor"])) {
    // Obtener los valores actualizados de los campos de entrada del formulario
    $idTutor = $_POST["idTutor"];
    $nombres = $_POST["nombres"];
    $apellidos = $_POST["apellidos"];
    $matricula = $_POST["matricula"];
    $usuario = $_POST["usuario"];
    $password = $_POST["password"];

    // Consulta para actualizar los datos del tutor correspondiente
    $query = "UPDATE tutores SET 
            nombres = '$nombres', 
            apellidos = '$apellidos', 
            usuario = '$usuario', 
            matricula = '$matricula', 
            password = '$password' 
            WHERE idTutor = $idTutor";
    mysqli_query($conn, $query);

    // Redirigir a la página de inicio
    header("Location: tutores.php");
    exit();
}
?>