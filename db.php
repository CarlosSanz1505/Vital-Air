<?php
$host = "localhost";
$usuario = "root";
$clave = "";
$bd = "vital air";

$conn = new mysqli($host, $usuario, $clave, $bd);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>