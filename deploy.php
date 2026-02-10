<?php
/**
 * AMI Auto-Deploy Script
 */
// Ejecuta el pull y captura la salida
$output = shell_exec('git pull origin master 2>&1');
echo "<pre>$output</pre>";
?>