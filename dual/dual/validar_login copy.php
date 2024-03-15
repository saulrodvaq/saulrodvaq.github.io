<?php
include("templates/conexion.php");

if ($conn->connect_error) {
  die("Conexión fallida: " . $conn->connect_error);
}

$user = $_POST['usuario'];
$pass = $_POST['password'];

// Intentar buscar en la tabla alumnos
$query = "SELECT * FROM alumnos WHERE usuario = '$user' AND password = '$pass'";
$result = $conn->query($query);

if ($result->num_rows == 1) {
  session_start();
  $_SESSION["usuario"] = $user;
  $userType = "alumnos";
  echo json_encode(["success" => true, "user_type" => $userType]);
  exit;
}

// Intentar buscar en la tabla directores
$query = "SELECT * FROM directores WHERE usuario = '$user' AND password = '$pass'";
$result = $conn->query($query);

if ($result->num_rows == 1) {
  session_start();
  $_SESSION["usuario"] = $user;
  $userType = "directores";
  echo json_encode(["success" => true, "user_type" => $userType]);
  exit;
}

// Intentar buscar en la tabla subdirectores
$query = "SELECT * FROM subdirectores WHERE usuario = '$user' AND password = '$pass'";
$result = $conn->query($query);

if ($result->num_rows == 1) {
  session_start();
  $_SESSION["usuario"] = $user;
  $userType = "subdirectores";
  echo json_encode(["success" => true, "user_type" => $userType]);
  exit;
}

// Intentar buscar en la tabla formadores
$query = "SELECT * FROM formadores WHERE usuario = '$user' AND password = '$pass'";
$result = $conn->query($query);

if ($result->num_rows == 1) {
  session_start();
  $_SESSION["usuario"] = $user;
  $userType = "formadores";
  echo json_encode(["success" => true, "user_type" => $userType]);
  exit;
}

// Intentar buscar en la tabla administradores
$query = "SELECT * FROM administradores WHERE usuario = '$user' AND password = '$pass'";
$result = $conn->query($query);

if ($result->num_rows == 1) {
  session_start();
  $_SESSION["usuario"] = $user;
  $userType = "administradores";
  echo json_encode(["success" => true, "user_type" => $userType]);
  exit;
}

// Intentar buscar en la tabla tutores
$query = "SELECT * FROM tutores WHERE usuario = '$user' AND password = '$pass'";
$result = $conn->query($query);

if ($result->num_rows == 1) {
  session_start();
  $_SESSION["usuario"] = $user;
  $userType = "tutores";
  echo json_encode(["success" => true, "user_type" => $userType]);
  exit;
}

// Intentar buscar en la tabla instructores
$query = "SELECT * FROM instructores WHERE usuario = '$user' AND password = '$pass'";
$result = $conn->query($query);

if ($result->num_rows == 1) {
  session_start();
  $_SESSION["usuario"] = $user;
  $userType = "instructores";
  echo json_encode(["success" => true, "user_type" => $userType]);
  exit;
}

// Intentar buscar en la tabla docentes
$query = "SELECT * FROM docentes WHERE usuario = '$user' AND password = '$pass'";
$result = $conn->query($query);

if ($result->num_rows == 1) {
  session_start();
  $_SESSION["usuario"] = $user;
  $userType = "docentes";
  echo json_encode(["success" => true, "user_type" => $userType]);
  exit;
}

echo json_encode(["success" => false, "message" => "Usuario o contraseña incorrectos"]);

$conn->close();
?>