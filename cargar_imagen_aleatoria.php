<?php

// URL del archivo SQL alojado en GitHub
$sql_file_url = "one_piece.sql";

// Obtener el contenido del archivo SQL
$sql_content = file_get_contents($sql_file_url);

// Buscar líneas que contengan INSERT INTO para extraer las imágenes
preg_match_all('/INSERT INTO tablapersonajes \(imagen, nombre\) VALUES \(\'(.*?)\', \'(.*?)\'\);/', $sql_content, $matches);

// Verificar si se encontraron resultados
if (!empty($matches[1])) {
    // Elegir una imagen aleatoria
    $random_index = array_rand($matches[1]);
    $imagen = $matches[1][$random_index];
    $nombre = $matches[2][$random_index];
    $respuesta = array("imagen" => $imagen, "nombre" => $nombre);
    
    // Convertir el array a formato JSON y enviarlo como respuesta
    echo json_encode($respuesta);
} else {
    echo "No se encontraron imágenes en el archivo SQL.";
}

?>
