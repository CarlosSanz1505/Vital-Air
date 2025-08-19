<?php
session_start();
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $clave = password_hash($_POST["clave"], PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (nombre, clave) VALUES ('$nombre', '$clave');";

    if ($conn->query($sql) === TRUE) {
        header("Location: login.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>
</head>
<body>
    <form action="" method="post">
        <input type="text" name="nombre" required>
        <input type="text" name="clave" required>
        <button type="submit">Crear usuario</button>
    </form>
</body>
</html>