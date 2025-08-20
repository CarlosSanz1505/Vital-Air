<?php
session_start();
include("db.php");

$clave = password_hash('password', PASSWORD_DEFAULT);

$sql = "INSERT INTO usuarios (nombre, clave, rol) VALUES ('admin', '$clave', 'admin');";

if ($conn->query($sql) === TRUE) {
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Admin</title>
</head>
<body>
    Admin creado: <?php echo htmlspecialchars($clave) ?>
</body>
</html>