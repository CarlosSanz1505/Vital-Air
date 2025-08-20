<?php
$host = "db-vital-air4.cwoblbi6fart.us-east-1.rds.amazonaws.com";
$usuario = "admin";
$clave = "password";
$bd = "vital_air";

$conn = new mysqli($host, $usuario, $clave, $bd);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>
