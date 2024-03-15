<?php
include("../../templates/conexion.php");

// Obtener los parámetros de la solicitud
$puestoId = $_GET['puestoId'];
$asignaturaIndex = $_GET['asignaturaIndex'];
$cumple = $_GET['cumple'];

// Verificar si ya existe una fila correspondiente en la tabla "puestos_asignaturas"
$query = "SELECT idPuestoAsignatura FROM puestos_asignaturas WHERE idPuesto = ? AND idAsignatura = ?";
$stmt = $conn->prepare($query);

if ($stmt) {
  $stmt->bind_param("ii", $puestoId, $asignaturaIndex);
  $stmt->execute();
  $stmt->store_result();
  
  if ($stmt->num_rows > 0) {
    // Actualizar el campo "cumple" en la fila existente
    $updateQuery = "UPDATE puestos_asignaturas SET cumple = ? WHERE idPuesto = ? AND idAsignatura = ?";
    $updateStmt = $conn->prepare($updateQuery);
    
    if ($updateStmt) {
      $updateStmt->bind_param("iii", $cumple, $puestoId, $asignaturaIndex);
      $updateStmt->execute();
      $updateStmt->close();
      
      // Responder con un código de estado exitoso
      http_response_code(200);
    } else {
      // Responder con un código de error
      http_response_code(500);
      die("Error en la preparación de la consulta de actualización: " . $conn->error);
    }
  } else {
    // Insertar una nueva fila
    $insertQuery = "INSERT INTO puestos_asignaturas (idPuesto, idAsignatura, cumple) VALUES (?, ?, ?)";
    $insertStmt = $conn->prepare($insertQuery);
    
    if ($insertStmt) {
      $insertStmt->bind_param("iii", $puestoId, $asignaturaIndex, $cumple);
      $insertStmt->execute();
      $insertStmt->close();
      
      // Responder con un código de estado exitoso
      http_response_code(200);
    } else {
      // Responder con un código de error
      http_response_code(500);
      die("Error en la preparación de la consulta de inserción: " . $conn->error);
    }
  }
  
  $stmt->close();
} else {
  // Responder con un código de error
  http_response_code(500);
  die("Error en la preparación de la consulta de verificación: " . $conn->error);
}

// Cerrar conexión
$conn->close();
?>