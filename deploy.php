<?php
/**
 * AMI Auto-Deploy Script
 */
// 1. Ejecuta el pull
$output = "Attempting GIT PULL...\n";
$output .= shell_exec('git pull origin master 2>&1');

// 2. Limpia la caché (CRITICAL)
$output .= "\nAttempting DRUSH CR...\n";
$output .= shell_exec('vendor/bin/drush cr 2>&1');

// 3. Actualizaciones de Base de Datos (Seguridad)
$output .= "\nAttempting DRUSH UPDB...\n";
$output .= shell_exec('vendor/bin/drush updb -y 2>&1');

// 4. Asegura que el tema esté activo
$output .= "\nAttempting THEME ENABLE...\n";
$output .= shell_exec('vendor/bin/drush theme:enable ami_medic 2>&1');
$output .= shell_exec('vendor/bin/drush config-set system.theme default ami_medic -y 2>&1');

// 5. Intenta importar configuración (Opcional pero recomendado para "construir" desde código)
// $output .= "\nAttempting CONFIG IMPORT...\n";
// $output .= shell_exec('vendor/bin/drush cim -y 2>&1');
echo "<pre>$output</pre>";
?>