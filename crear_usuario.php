<?php
$conexion = new mysqli("localhost", "root", "", "registro_usuarios");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];

if (empty($usuario) || empty($contrasena)) {
    die("⚠️ Usuario o contraseña vacíos.");
}

// Verificar si el usuario ya existe
$sql_check = "SELECT * FROM nuevo_usuario WHERE usuario = ?";
$stmt_check = $conexion->prepare($sql_check);

if (!$stmt_check) {
    die("❌ Error en prepare (verificación): " . $conexion->error);
}

$stmt_check->bind_param("s", $usuario);
$stmt_check->execute();
$resultado = $stmt_check->get_result();

if ($resultado && $resultado->num_rows > 0) {
    echo "❌ El usuario ya existe.";
} else {
    // Encriptar contraseña
    $clave_encriptada = password_hash($contrasena, PASSWORD_DEFAULT);
    $sql_insert = "INSERT INTO nuevo_usuario (usuario, contrasena) VALUES (?, ?)";
    $stmt_insert = $conexion->prepare($sql_insert);

    if (!$stmt_insert) {
        die("❌ Error en prepare (registro): " . $conexion->error);
    }

    $stmt_insert->bind_param("ss", $usuario, $clave_encriptada);

    if ($stmt_insert->execute()) {
        header("Location: inicio-sesion.html");
exit();
    } else {
        echo "❌ Error al registrar: " . $stmt_insert->error;
    }

    $stmt_insert->close();
}

$stmt_check->close();
$conexion->close();
?>



