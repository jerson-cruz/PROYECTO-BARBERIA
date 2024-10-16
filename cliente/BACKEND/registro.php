<?php
// Conexión con la base de datos
include("C:/xampp/htdocs/PEOYECTO_SENA/comunes/BACKEND/conexion.php");

// Creando variables
// Crear variables con datos del formulario
$nombre = $_POST['nombre'] ?? null;
$apellido = $_POST['apellido'] ?? null;
$cedula = $_POST['cedula'] ?? null;
$contrasena = $_POST['contrasena'] ?? null;
$confirmar_contrasena = $_POST['confirmar_contrasena'] ?? null;

// Verificar que todos los campos requeridos estén presentes
if (empty($nombre) || empty($apellido) || empty($cedula) || empty($contrasena) || empty($confirmar_contrasena)) {
    die("ya puedes ingresar.");
}

// Comparar contraseñas
if ($contrasena !== $confirmar_contrasena) {
    die("Las contraseñas no coinciden.");
}

// Encriptar la contraseña
$contrasenaUser = password_hash($contrasena, PASSWORD_DEFAULT);

// Ingresar la información a la base de datos usando declaraciones preparadas
$stmt = $conexion->prepare("INSERT INTO registro (Id_cliente, nombre, apellido, cedula, contrasena) VALUES (NULL,?,?,?,?)");

// Enlazar los parámetros
$stmt->bind_param("ssss", $nombre, $apellido, $cedula, $contrasenaUser);

// Ejecutar la consulta
if ($stmt->execute()) {
    echo "Registrado con éxito";
} else {
    echo "Error al registrar: " . $stmt->error;
}

// Cerrar la declaración y la conexión
$stmt->close();
$conexion->close();
