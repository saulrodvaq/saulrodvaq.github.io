<?php
include("../../templates/conexion.php");
if(isset($_POST["idAlumno"])) {
    // Obtener los valores actualizados de los campos de entrada del formulario
    $idAlumno = $_POST["idAlumno"];
    $nombres = $_POST["nombres"];
    $apellidos = $_POST["apellidos"];
    $matricula = $_POST["matricula"];
    $carrera = $_POST["carrera"];
    $cuatrimestre = $_POST["cuatrimestre"];
    $ingreso = $_POST['ingreso'];
    $fecha_fin = $_POST['fecha_fin'];
    $empresa = $_POST["empresa"];
    $usuario = $_POST["usuario"];
    $password = $_POST["password"];

    // Consulta para actualizar los datos del usuario correspondiente
    $query = "UPDATE alumnos SET 
            nombres= '$nombres',
            apellidos= '$apellidos',
            matricula= '$matricula',
            idEmpresa= '$empresa',
            carrera= '$carrera',
            cuatrimestre= '$cuatrimestre',
            ingreso= '$ingreso',
            fecha_fin= '$fecha_fin',
            usuario= '$usuario', 
            password= '$password'
            WHERE idAlumno = $idAlumno";
    mysqli_query($conn, $query);

    // Redirigir a la página de inicio
    header("Location: alumnos.php");
    exit();
}
?>