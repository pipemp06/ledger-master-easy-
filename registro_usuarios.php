<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "registro_usuarios");
if ($conexion->connect_error) {
    die("❌ Error de conexión: " . $conexion->connect_error);
}

// Verificar si se enviaron los datos del formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $tipo_documento = $_POST['tipo_documento'];
    $numero_documento = $_POST['numero_documento'];
    $numero_celular = $_POST['numero_celular'];

    $sql = "INSERT INTO usuarios (nombres, apellidos, fecha_nacimiento, tipo_documento, numero_documento, numero_celular)
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ssssss", $nombres, $apellidos, $fecha_nacimiento, $tipo_documento, $numero_documento, $numero_celular);
        if ($stmt->execute()) {
        header("Location: nuevo_usuario.html");
exit();

        } else {
            echo "❌ Error al registrar: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "❌ Error al preparar consulta: " . $conexion->error;
    }
}

$conexion->close();
?>
