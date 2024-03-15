<?php
include("../../templates/conexion.php");
if(isset($_POST["idEmpresa"])) {
    // Obtener los valores actualizados de los campos de entrada del formulario
    $idEmpresa = $_POST["idEmpresa"];
    $nombreEmp = $_POST["nombreEmp"];
    $calle= $_POST["calle"];
    $colonia = $_POST["colonia"];
    $municipio = $_POST["municipio"];
    $numero = $_POST["numero"];
    $cp = $_POST["cp"];
    $giro = $_POST["giro"];
    $parqueIndustrial = $_POST["parqueIndustrial"];
    $permite_imagenes = $_POST["permite_imagenes"];
    $nombreC = $_POST["nombreC"];
    $telefono = $_POST["telefono"];
    $correo = $_POST["correo"];
    $puesto = $_POST["puesto"];

    // Consulta para actualizar los datos de la empresa correspondiente
    $query = "UPDATE empresas SET 
            nombreEmp = '$nombreEmp',
            calle = '$calle', 
            colonia = '$colonia', 
            municipio = '$municipio', 
            numero = '$numero', 
            cp = '$cp', 
            giro = '$giro', 
            parqueIndustrial = '$parqueIndustrial',
            permite_imagenes = '$permite_imagenes',
            nombreC = '$nombreC',  
            telefono = '$telefono', 
            correo = '$correo',
            puesto = '$puesto' 
            WHERE idEmpresa = $idEmpresa";
    mysqli_query($conn, $query);

    // Redirigir a la página de inicio
    header("Location: empresas.php");
    exit();
}
?>