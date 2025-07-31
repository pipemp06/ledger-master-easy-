<?php
$carpeta_destino = "uploads/";

if (!file_exists($carpeta_destino)) {
    mkdir($carpeta_destino, 0777, true);
}

foreach ($_FILES['archivos']['tmp_name'] as $key => $tmp_name) {
    $nombre_archivo = basename($_FILES['archivos']['name'][$key]);
    $ruta_destino = $carpeta_destino . $nombre_archivo;

    if (move_uploaded_file($tmp_name, $ruta_destino)) {
        // Opcional: puedes mostrar mensaje o registrar en log
    }
}

header("Location: ingreso.html");
exit();
?>
