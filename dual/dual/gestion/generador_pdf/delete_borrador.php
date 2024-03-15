<?php
   include("../../templates/conexion.php");
   
   if (isset($_POST['idBorrador'])) {
       $idBorrador = $_POST['idBorrador'];
   
       // Aquí realizas la lógica de eliminación del borrador en la base de datos
       // Puedes usar el ID recibido para construir tu consulta de eliminación y ejecutarla
   
       $query = "DELETE FROM borradores WHERE idBorrador = $idBorrador";
   
       if ($conn->query($query) === TRUE) {
           // La eliminación fue exitosa
           echo 'success';
       } else {
           // Ocurrió un error al eliminar el borrador
           echo 'error';
       }
   }
   
   $conn->close();
   
   
?>