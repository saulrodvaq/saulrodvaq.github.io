<?php
    session_start();
    include("../../templates/conexion.php");

    $idAlumno = $_SESSION['idAlumno'];
    
    $query = "SELECT COUNT(*) as total FROM borradores WHERE idAlumno = $idAlumno";
    $respuesta = mysqli_query($conn, $query);
    $total = mysqli_fetch_assoc($respuesta)['total'];

    echo $total; 

    $conn->close();
?>
