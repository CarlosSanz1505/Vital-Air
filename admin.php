<?php
session_start();
include("db.php");

if (!isset($_SESSION['nombre'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    switch ($_POST['for']) {
        // Crear usuario
        case 'create-user':
            $nombre = $_POST["nombre"];
            $clave = password_hash($_POST["clave"], PASSWORD_DEFAULT);

            $sql = "INSERT INTO usuarios (nombre, clave, rol) VALUES ('$nombre', '$clave', 'empresa');";

            if ($conn->query($sql) === TRUE) {
                header("Location: admin.php");
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            break;
        case 'add-device':
            break;
        case 'delete-user':
            $nombre = $_POST["nombre"];

            $sql = "DELETE FROM usuarios WHERE nombre='$nombre';";

            if ($conn->query($sql) === TRUE) {
                header("Location: admin.php");
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            break;
    }
}

$sql = 'SELECT nombre FROM usuarios WHERE rol = "empresa";';
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin - Usuarios</title>
<link rel="stylesheet" href="stylesAdmin.css">
</head>
<body>
    <header>
        <h1>Panel de Administración</h1>
    </header>

    <div class="container">
        <h2>Usuarios Registrados</h2>
        <button class="btn btn-primary" onclick="openModal('createModal')">+ Crear cuenta</button>
        
        <table>
            <thead>
                <tr>
                <th>Username</th>
                <th>Dispositivos</th>
                <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result && $result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $nombre = $row['nombre'];
                        $countQuery = "SELECT COUNT(*) as device_count FROM dispositivos WHERE empresa_id = ?";
                        $stmt = $conn->prepare($countQuery);
                        $stmt->bind_param("s", $nombre);
                        $stmt->execute();
                        $countResult = $stmt->get_result();
                        $countRow = $countResult->fetch_assoc();
                        $deviceCount = $countRow['device_count'];
                        
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['nombre']) . "</td>";
                        echo "<td>" . htmlspecialchars($deviceCount) . "</td>";
                        echo "<td><button class=\"btn btn-secondary\" onclick=\"openModal('deviceModal')\">➕ Dispositivo</button>";
                        echo "<form method=\"POST\"><input type=\"hidden\" name=\"for\" value=\"delete-user\">";
                        echo "<input type=\"hidden\" name=\"nombre\" value=\"" . htmlspecialchars($nombre) . "\">";
                        echo "<button type=\"submit\" class=\"btn btn-danger\">❌ Eliminar</button></td>";
                        echo "</form>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Modal Crear Cuenta -->
    <div id="createModal" class="modal">
        <div class="modal-content">
            <button class="close-btn" onclick="closeModal('createModal')">X</button>
            <h3>Crear Nueva Cuenta</h3>
            <form method="post">
                <input type="hidden" name="for" value="create-user">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="nombre" placeholder="Ingrese username">
                </div>
                <div class="form-group">
                    <label>Contraseña</label>
                    <input type="password" name="clave" placeholder="Ingrese contraseña">
                </div>
                <button type="submit" class="btn btn-primary">Crear</button>
            </form>
        </div>
    </div>

    <!-- Modal Añadir Dispositivo -->
    <div id="deviceModal" class="modal">
        <div class="modal-content">
        <button class="close-btn" onclick="closeModal('deviceModal')">X</button>
        <h3>Añadir Dispositivo</h3>
        <input type="hidden" name="for" value="add-device">
        <div class="form-group">
            <label>Nombre del dispositivo</label>
            <input type="text" name="nombre" placeholder="Ej: Sensor Temp #1">
        </div>
        <button type="submit" class="btn btn-secondary">Añadir</button>
        </div>
    </div>

    <script>
        function openModal(id) {
        document.getElementById(id).style.display = "flex";
        }

        function closeModal(id) {
        document.getElementById(id).style.display = "none";
        }
    </script>
</body>
</html>
