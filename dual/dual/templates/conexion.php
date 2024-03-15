<?php
$server="localhost"; //Lugar donde esta la base de datos.
$usuario="root"; //Nombre de usuario (suele ser root).
$password=""; //Contraseña (casi siempre esta vacía)
$bd="dual_bd"; //Nombre de la base de datos.
$conn=mysqli_connect($server,$usuario,$password,$bd); //Conectar la base de datos con las variables declaradas.
if (!$conn) {
  die("Conexión fallida: " . mysqli_connect_error());
}
?>