<?php

use PHPUnit\Framework\TestCase;

class RegistroTest extends TestCase
{
    protected $conexion;

    protected function setUp(): void
    {
        // Conexión con la base de datos
        include("C:/xampp/htdocs/PEOYECTO_SENA/comunes/BACKEND/conexion.php");
        $this->conexion = $conexion;
    }

    public function testRegistroUsuario()
    {
        $nombre = readline("Ingrese su nombre: ");
        $apellido = readline("Ingrese su apellido: ");
        $cedula = readline("Ingrese su cédula: ");
        $contrasena = readline("Ingrese su contraseña: ");
        $confirmar_contrasena = readline("Confirme su contraseña: ");

        // Crear variables con datos del formulario
        //$nombre = $_POST['nombre'] ?? null;
        //$apellido = $_POST['apellido'] ?? null;
        //$cedula = $_POST['cedula'] ?? null;
        //$contrasena = $_POST['contrasena'] ?? null;
        //$confirmar_contrasena = $_POST['confirmar_contrasena'] ?? null;

        // Verificar que todos los campos requeridos estén presentes
        $this->assertNotEmpty($nombre);
        $this->assertNotEmpty($apellido);
        $this->assertNotEmpty($cedula);
        $this->assertNotEmpty($contrasena);
        $this->assertNotEmpty($confirmar_contrasena);

        // Comparar contraseñas
        $this->assertEquals($contrasena, $confirmar_contrasena);

        // Encriptar la contraseña
        $contrasenaUser = password_hash($contrasena, PASSWORD_DEFAULT);

        // Ingresar la información a la base de datos usando declaraciones preparadas
        $stmt = $this->conexion->prepare("INSERT INTO registro (Id_cliente, nombre, apellido, cedula, contrasena) VALUES (NULL,?,?,?,?)");

        // Enlazar los parámetros
        $stmt->bind_param("ssss", $nombre, $apellido, $cedula, $contrasenaUser);

        // Ejecutar la consulta
        $this->assertTrue($stmt->execute(), "Error al registrar: " . $stmt->error);

        // Cerrar la declaración
        $stmt->close();
    }

    protected function tearDown(): void
    {
        // Cerrar la conexión
        $this->conexion->close();
    }
}
