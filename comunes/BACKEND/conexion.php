<?php

$host = "localhost"; // Dirección del servidor
$user = "root";      // Usuario de la base de datos
$pass = "";          // Contraseña del usuario
$db = "proyecto";    // Nombre de la base de datos

// Establecer la conexión
$conexion = mysqli_connect($host, $user, $pass, $db);

// Verificar la conexión
if (!$conexion) {
    die("Conexión fallida: " . mysqli_connect_error());
}

// Si la conexión es exitosa
echo "Conexión exitosa. Bienvenido!";
// Resto del código...
