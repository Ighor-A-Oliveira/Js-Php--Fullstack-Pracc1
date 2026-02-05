<?php
header('Content-Type: text/html; charset=utf-8');

echo '<script>';
echo 'console.log("TESTE PHP: Cheguei aqui!");';
echo 'console.log("Hora no servidor: ' . date('H:i:s') . '");';
echo 'console.log("POST recebido:", ' . json_encode($_POST) . ');';
echo '</script>';

file_put_contents('php_debug.log', "Acesso em " . date('Y-m-d H:i:s') . "\n" . print_r($_POST, true) . "\n---\n", FILE_APPEND);