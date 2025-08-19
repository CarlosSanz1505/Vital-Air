<?php
session_start();
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $clave = $_POST["clave"];

    $nombre = mysqli_real_escape_string($conn, $nombre);
    $clave = mysqli_real_escape_string($conn, $clave);

    $query = "SELECT * FROM usuarios WHERE nombre='$nombre'";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($clave, $user["clave"])) {
        $_SESSION["nombre"] = $user["nombre"];
        header("Location: info.php");
        exit();
    } else {
        $error = "Nombre o contraseña incorrectos.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
</head>
<body>
    <form action="" method="post">
        <input type="text" name="nombre" required>
        <input type="text" name="clave" required>
        <button type="submit">Ingresar</button>
    </form>
</body>
</html>