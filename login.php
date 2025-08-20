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

    $page = ($user['rol'] == 'admin') ? 'admin.php' : 'info.php';
    if ($user && password_verify($clave, $user["clave"])) {
        $_SESSION["nombre"] = $user["nombre"];
        header("Location: $page");
        exit();
    } else {
        $error = "Nombre o contraseña incorrectos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>VitalAir - Login</title>
<link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="login-container">
        <div class="login-box">
        <img src="logo.png" alt="VitalAir Logo" class="logo">
        <form method="POST" id="loginForm">
            <input type="text" name="nombre" placeholder="Username" required>
            <input type="password" name="clave" placeholder="Contraseña" required>
            <button type="submit">INICIAR SESIÓN</button>
        </form>
        </div>
    </div>
</body>
</html>
