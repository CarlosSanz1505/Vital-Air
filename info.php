<?php
session_start();
if (!isset($_SESSION['nombre'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>VitalAir</title>
<link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="app">
    <aside class="sidebar">
    <div class="logo">
        <img src="logo.png" alt="VitalAir">
        <h2>VitalAir</h2>
    </div>
    <ul class="menu">
        <li class="item green">Bodega 1</li>
        <li class="item red">Bodega 2</li>
        <li class="item green">Dispositivo A</li>
        <li class="item green">Bodega 3</li>
        <li class="item orange">Dispositivo B</li>
    </ul>
    </aside>

    <main class="content">
        <h1><?php echo htmlspecialchars($_SESSION['nombre'])?></h1>

        <header class="header">
            <h2>Bodega 1 <span class="edit">✎</span></h2>
            <p class="id">ID: A127823SDFJ-X</p>
            <button id="menuBtn" class="menu-btn">⋮</button>
        </header>

        <section class="params">
            <h3>Parámetros</h3>
            <ul>
            <li>Humedad: relativa</li>
            <li>Temperatura: °C</li>
            <li>Densidad de partículas suspendidas: g/m³</li>
            <li>Distribución de tamaño de partículas: media y desviación</li>
            <li>Velocidad de aire: m/s</li>
            </ul>
        </section>

        <section class="status">
            <h3>Estado: <span class="badge stable">ESTABLE</span></h3>
        </section>

        <section class="recommendations">
            <h3>Recomendaciones</h3>
            <div class="box">
            No hay medidas correctivas necesarias por el momento.
            </div>
        </section>
    </main>
</div>

<!-- Modal Gestionar cuenta -->
<div id="accountModal" class="modal">
    <div class="modal-content">
    <h2>Gestionar cuenta</h2>
    <div class="form-box">
        <div class="field">
        <label for="direccion"><b>Dirección:</b></label>
        <input type="text" id="direccion" placeholder="Cll xx-xx #xx">
        <span class="edit">✎</span>
        </div>

        <div class="field">
        <label for="username"><b>Username:</b></label>
        <input type="text" id="username" placeholder="Cliente 2123">
        <span class="edit">✎</span>
        </div>

        <!-- Botón que abre el modal de contraseña -->
        <button id="openPasswordModal" class="btn">Cambiar contraseña</button>
    </div>
    <button id="closeAccountModal" class="close-btn">Cerrar</button>
    </div>
</div>


<!-- Modal Cambiar contraseña -->
<div id="passwordModal" class="modal">
<div class="modal-content">
    <h2>Cambiar contraseña</h2>
    <div class="form-box">
    <div class="field"> 
        <label>Nueva:</label>
        <input type="password" id="newPass" placeholder="Ingrese nueva contraseña">
    </div>
    <div class="field">
        <label>Confirmar:</label>
        <input type="password" id="confirmPass" placeholder="Repita la contraseña">
    </div>
    </div>
    <div class="btn-row">
    <button id="cancelPassword" class="btn-gray">Cancelar</button>
    <button id="savePassword" class="btn-blue">Guardar</button>
    </div>
    <button id="closePasswordModal" class="close-btn">Cerrar</button>
</div>
</div>

<script src="script.js"></script>
</body>
</html>
