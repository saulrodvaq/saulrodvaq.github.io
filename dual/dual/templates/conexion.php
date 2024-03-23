<?php
$server = "db"; // Lugar donde está la base de datos.
$usuario = "mariadb"; // Nombre de usuario (suele ser root).
$password = "mariadb"; // Contraseña (casi siempre está vacía).
$bd = "mariadb"; // Nombre de la base de datos.

// Conexión a la base de datos utilizando MySQLi.
$conn = new mysqli($server, $usuario, $password, $bd);

// Verificar la conexión.
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
