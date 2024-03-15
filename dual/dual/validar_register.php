<?php
include("templates/conexion.php");

$response = ["success" => false, "message" => "Error al registrar usuario como administrador."];

if ($conn->connect_error) {
  $response["message"] = "Conexión fallida: " . $conn->connect_error;
} else {
  $email = $_POST['email'];
  $pass = $_POST['password'];
  $fullname = $_POST['fullname'];

  $options = [
    'cost' => 12,
  ];
  
  $salt = password_hash($pass, PASSWORD_BCRYPT, $options);

  $query = "INSERT INTO usuario (email, password, fullname, role_id) VALUES (?, ?, ?, ?)";
  $stmt = $conn->prepare($query);

  $role_id = 1;
  $stmt->bind_param("sssi", $email, $salt, $fullname, $role_id);

  if ($stmt->execute()) {
    $response = ["success" => true, "message" => "Usuario registrado como administrador correctamente."];
  } else {
    $response["message"] = "Error al registrar usuario como administrador: " . $stmt->error;
  }
}

echo json_encode($response);
$conn->close();
?>