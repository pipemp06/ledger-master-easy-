<?php
$carpeta = 'uploads/'; // Ajusta si tu carpeta se llama diferente

if (is_dir($carpeta)) {
    $archivos = array_diff(scandir($carpeta), array('.', '..'));

    // Obtener la fecha de modificación de cada archivo
    $archivos_info = [];
    foreach ($archivos as $archivo) {
        $ruta = $carpeta . $archivo;
        $archivos_info[] = [
            'nombre' => $archivo,
            'fecha' => filemtime($ruta)
        ];
    }

    // Ordenar por fecha descendente (más reciente primero)
    usort($archivos_info, function ($a, $b) {
        return $b['fecha'] - $a['fecha'];
    });

    echo "<ul>";
    foreach ($archivos_info as $item) {
        echo "<li>{$item['nombre']} - " . date("d/m/Y H:i:s", $item['fecha']) . "</li>";
    }
    echo "</ul>";
} else {
    echo "📁 Carpeta no encontrada.";
}
?>
