# Vital-Air

## Uso para dev

1. Ejecutar SQL en `localhost/phpmyadmin`:

```
CREATE DATABASE vital_air;

USE vital_air;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) UNIQUE NOT NULL,
    clave VARCHAR(255) NOT NULL,
    rol VARCHAR(100) NOT NULL
);

CREATE TABLE dispositivos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    empresa_id VARCHAR(255) NOT NULL,
    humedad INT NOT NULL,
    temperatura INT NOT NULL,
    densidad INT NOT NULL,
    distribucion INT NOT NULL,
    velocidad INT NOT NULL
);
```

2. Ingresar a `localhost/vital-air/login.php` con nombre `admin` y contraseña `password` para crear/eliminar usuarios