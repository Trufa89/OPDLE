<?php

// URL del archivo SQL alojado en GitHub
$sql_file_url = "one_piece.sql";

// Obtener el contenido del archivo SQL
$sql_content = file_get_contents($sql_file_url);

// Obtener el nombre enviado por GET
$nombre = $_GET['nombre'];

// Inicializar un array para almacenar los nombres de los personajes que coinciden
$nombres = array();

// Buscar el nombre en el contenido del archivo SQL
preg_match_all("/INSERT INTO tablapersonajes \(imagen, nombre\) VALUES \('.*?', '($nombre.*?)'\);/", $sql_content, $matches);

// Agregar los nombres encontrados al array $nombres
if (!empty($matches[1])) {
    $nombres = $matches[1];
}

// Convertir el array a formato JSON y enviarlo como respuesta
echo json_encode($nombres);

?>
