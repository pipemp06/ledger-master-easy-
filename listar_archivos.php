<?php
$carpeta = 'uploads/';

function obtenerIcono($archivo) {
  $ext = strtolower(pathinfo($archivo, PATHINFO_EXTENSION));
  return match ($ext) {
    'pdf' => '📄', 'doc', 'docx' => '📝',
    'xls', 'xlsx' => '📊', 'jpg', 'jpeg', 'png', 'gif' => '🖼️',
    'zip', 'rar' => '🗜️', 'mp4', 'mov' => '🎞️', 'mp3' => '🎵',
    default => '📁'
  };
}

if (is_dir($carpeta)) {
  $archivos = array_diff(scandir($carpeta), ['.', '..']);

  if (count($archivos)) {
    echo "<table>
      <thead><tr><th>Icono</th><th>Nombre</th><th>Ver</th><th>Fecha</th></tr></thead><tbody>";

    foreach ($archivos as $archivo) {
      $ruta = $carpeta . $archivo;
      $icono = obtenerIcono($archivo);
      $fecha = date("d/m/Y H:i", filemtime($ruta));

      echo "<tr>
              <td style='text-align:center;'>$icono</td>
              <td>$archivo</td>
              <td><a href='$ruta' target='_blank'>Abrir</a></td>
              <td>$fecha</td>
            </tr>";
    }

    echo "</tbody></table>";
  } else {
    echo "<p>No hay archivos subidos todavía.</p>";
  }
} else {
  echo "<p>❌ Carpeta 'uploads/' no encontrada.</p>";
}
?>
