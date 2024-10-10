<?php
include 'conexion.php'; // Incluir el archivo de conexión

// Manejar la solicitud para agregar un barbero (POST)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['agregar'])) {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $ciudad = $_POST['ciudad'];
    $documento = $_POST['documento'];
    $celular = $_POST['celular'];

    $sql = "INSERT INTO barberos (nombre, apellido, ciudad, documento, celular) VALUES ('$nombre', '$apellido', '$ciudad', '$documento', '$celular')";
    if ($conn->query($sql) === TRUE) {
        echo "Barbero agregado exitosamente.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Manejar la solicitud para editar un barbero (PUT/PATCH)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['editar'])) {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $ciudad = $_POST['ciudad'];
    $documento = $_POST['documento'];
    $celular = $_POST['celular'];

    $sql = "UPDATE barberos SET nombre='$nombre', apellido='$apellido', ciudad='$ciudad', documento='$documento', celular='$celular' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Barbero actualizado exitosamente.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Manejar la solicitud para eliminar un barbero (DELETE)
if (isset($_GET['eliminar'])) {
    $id = $_GET['eliminar'];
    $sql = "DELETE FROM barberos WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Barbero eliminado exitosamente.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Consulta para obtener la lista de barberos
$sql = "SELECT id, nombre, apellido, ciudad, documento, celular FROM barberos";
$result = $conn->query($sql);

// Manejar la solicitud de edición (cargar datos en el formulario)
if (isset($_GET['editar'])) {
    $id = $_GET['editar'];
    $sql = "SELECT nombre, apellido, ciudad, documento, celular FROM barberos WHERE id=$id";
    $result = $conn->query($sql);
    $barbero = $result->fetch_assoc();
    $nombreEdicion = $barbero['nombre'];
    $apellidoEdicion = $barbero['apellido'];
    $ciudadEdicion = $barbero['ciudad'];
    $documentoEdicion = $barbero['documento'];
    $celularEdicion = $barbero['celular'];
} else {
    $nombreEdicion = '';
    $apellidoEdicion = '';
    $ciudadEdicion = '';
    $documentoEdicion = '';
    $celularEdicion = '';
}
