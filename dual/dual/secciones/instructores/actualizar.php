<?php
include("../../templates/conexion.php");
if(isset($_POST["idInstructor"])) {
    // Obtener los valores actualizados de los campos de entrada del formulario
    $idInstructor = $_POST["idInstructor"];
    $nombres = $_POST["nombres"];
    $apellidos = $_POST["apellidos"];
    $matricula = $_POST["matricula"];
    $empresa = $_POST["empresa"];
    $usuario = $_POST["usuario"];
    $password = $_POST["password"];

    // Consulta para actualizar los datos del instructor correspondiente
    $query = "UPDATE instructores SET 
            nombres = '$nombres', 
            apellidos = '$apellidos', 
            usuario = '$usuario', 
            matricula = '$matricula',
            idEmpresa= '$empresa', 
            password = '$password' 
            WHERE idInstructor = $idInstructor";
    mysqli_query($conn, $query);

    // Redirigir a la página de inicio
    header("Location: instructores.php");
    exit();
}
?>