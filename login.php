<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "registro_usuarios"; // Cambia por el nombre real de tu base de datos

$conexion = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verifica si se recibieron los datos
$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];

// Preparar la consulta para evitar inyección SQL
$sql = "SELECT * FROM nuevo_usuario WHERE usuario = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("s", $usuario);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 1) {
    $fila = $resultado->fetch_assoc();
    
    if (password_verify($contrasena, $fila['contrasena'])) {
        // Inicio de sesión exitoso
        header("Location: ingreso.php"); // o la página principal de tu app
        exit();
    } else {
        header("Location: inicio-sesion.html?error=contrasena");
        exit();
    }
} else {
    header("Location: inicio-sesion.html?error=usuario");
    exit();
}
?>