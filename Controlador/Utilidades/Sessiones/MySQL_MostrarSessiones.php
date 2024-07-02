<?php
// Iniciamos sesión para recuperar los datos
session_start();

// Directorio donde se almacenan las sesiones (puede variar según la configuración del servidor)
$sessionsDir = ini_get('session.save_path');
echo "Directorio de sesiones: " . htmlspecialchars($sessionsDir) . "<br>";

// Verificamos si el directorio de sesiones existe
if ($sessionsDir && is_dir($sessionsDir)) {
    echo "El directorio de sesiones existe.<br>";
    
    // Abrimos el directorio de sesiones
    $sessionFiles = scandir($sessionsDir);
    
    // Filtramos los archivos de sesión válidos
    $sessions = array_filter($sessionFiles, function($file) use ($sessionsDir) {
        return is_file($sessionsDir . DIRECTORY_SEPARATOR . $file) && strpos($file, 'sess_') === 0;
    });
    
    echo '<table border="1">';
    echo '<tr><th>Session ID</th><th>Session Data</th></tr>';
    
    // Iteramos sobre los archivos de sesión
    foreach ($sessions as $sessionFile) {
        // Obtenemos el ID de sesión
        $sessionId = str_replace('sess_', '', $sessionFile);
        
        // Intentamos leer los datos de la sesión
        $sessionFilePath = $sessionsDir . DIRECTORY_SEPARATOR . $sessionFile;
        if (is_readable($sessionFilePath)) {
            $sessionData = file_get_contents($sessionFilePath);
            if ($sessionData !== false) {
                // Decodificamos los datos de la sesión (puede variar según la configuración)
                $sessionArray = session_decode($sessionData);
                
                // Mostramos los datos en la tabla
                echo '<tr>';
                echo '<td>' . htmlspecialchars($sessionId) . '</td>';
                echo '<td>' . htmlspecialchars(print_r($sessionArray, true)) . '</td>';
                echo '</tr>';
            } else {
                echo '<tr><td colspan="2">Error al leer los datos de la sesión para el archivo: ' . htmlspecialchars($sessionFile) . '</td></tr>';
            }
        } else {
            echo '<tr><td colspan="2">Permiso denegado al intentar leer el archivo de sesión: ' . htmlspecialchars($sessionFile) . '</td></tr>';
        }
    }
    
    echo '</table>';
} else {
    echo 'No se pudo acceder al directorio de sesiones.';
}
?>
