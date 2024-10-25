<?php

use PHPUnit\Framework\TestCase;

class BarberosTest extends TestCase
{
    protected $conexion;

    protected function setUp(): void
    {
        // Conexión con la base de datos
        include("C:/xampp/htdocs/PEOYECTO_SENA/comunes/BACKEND/conexion.php");
        $this->conexion = $conexion;
    }

    public function testBarberos()
    {
        // $nombre = readline("Ingrese su nombre: ");
        // $apellido = readline("Ingrese su apellido: ");
        // $ciudad = readline("Ingrese su ciudad: ");
        // $documento = readline("Ingrese su cedula: ");
        // $celular = readline("Ingrese su contacto: ");

        // Simular datos de entrada
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_POST['nombre'] = 'grey';
        $_POST['apellido'] = 'gamboa';
        $_POST['ciudad'] = 'Bogotá';
        $_POST['documento'] = '9999';
        $_POST['celular'] = '0909090';


        // Crear variables con datos del formulario
        //$nombre = $_POST['nombre'] ?? null;
        //$apellido = $_POST['apellido'] ?? null;
        //$ciudad = $_POST['cedula'] ?? null;
        //$documento = $_POST['documento'] ?? null;
        //$celular = $_POST['celular'] ?? null;

        // Captura de datos desde $_POST
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $ciudad = $_POST['ciudad'];
        $documento = $_POST['documento'];
        $celular = $_POST['celular'];

        // Preparar y ejecutar la consulta de inserción
        $stmt = $this->conexion->prepare("INSERT INTO barberos (nombre, apellido, ciudad, documento, celular) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $nombre, $apellido, $ciudad, $documento, $celular);

        // Ejecutar la consulta y verificar el resultado
        $this->assertTrue($stmt->execute(), "Error: " . $stmt->error);

        $stmt->close();
    }

    protected function tearDown(): void
    {
        // Aquí puedes limpiar la base de datos o cerrar conexiones si es necesario
        $this->conexion->close();
    }
}
