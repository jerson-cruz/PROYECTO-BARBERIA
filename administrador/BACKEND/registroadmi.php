<?php
// Conexión con la base de datos
include("../cliente/conexion.php");
// Creando variables
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$cedula = $_POST['cedula'];
$contrasena = $_POST['contrasena'];
$confirmar_contrasena = $_POST['confirmar_contrasena'];

// Comparar las contraseñas
if ($contrasena != $confirmar_contrasena) {
    echo "<script>
            alert('Las contraseñas no coinciden. Verifique.');
            window.location.href = 'registro.html';
          </script>";
    exit(); // Detener el resto del código
}

// Encriptar la contraseña
$contrasenaUser = password_hash($contrasena, PASSWORD_DEFAULT);

// Ingresar la información a la base de datos usando declaraciones preparadas
$stmt = $conexion->prepare("INSERT INTO administradorregistro (Id, nombre, apellido, cedula, contrasena) VALUES 
(NULL,?,?,?,?)");

// Enlazar los parámetros
$stmt->bind_param("ssss", $nombre, $apellido, $cedula, $contrasenaUser);

// Ejecutar la consulta
if ($stmt->execute()) {
    // Mostrar el alert y luego redirigir
    echo "<script>
            alert('Registrado con exito');
            window.location.href = 'ingreso.html';
          </script>";
} else {
    echo "INCORRECTO: " . $stmt->error;
}

// Cerrar la declaración y la conexión
$stmt->close();
$conexion->close();
