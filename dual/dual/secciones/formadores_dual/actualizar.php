<?php
include("../../templates/conexion.php");
if(isset($_POST["idFormador"])) {
    // Obtener los valores actualizados de los campos de entrada del formulario
    $idFormador = $_POST["idFormador"];
    $nombres = $_POST["nombres"];
    $apellidos = $_POST["apellidos"];
    $matricula = $_POST["matricula"];
    $empresa = $_POST["empresa"];
    $usuario = $_POST["usuario"];
    $password = $_POST["password"];

    // Consulta para actualizar los datos del formador correspondiente
    $query = "UPDATE formadores SET 
            nombres = '$nombres', 
            apellidos = '$apellidos', 
            usuario = '$usuario', 
            matricula = '$matricula',
            idEmpresa= '$empresa', 
            password = '$password' 
            WHERE idFormador = $idFormador";
    mysqli_query($conn, $query);

    // Redirigir a la página de inicio
    header("Location: formadores_dual.php");
    exit();
}
?>