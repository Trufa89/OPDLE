<?php

// URL del archivo SQL alojado en GitHub
$sql_file_url = "one_piece.sql";

// Obtener el contenido del archivo SQL
$sql_content = file_get_contents($sql_file_url);

// Obtener la respuesta del usuario y el nombre de la imagen enviados por POST
$respuesta_usuario = $_POST['respuesta']; 
$nombre_imagen = $_POST['nombreImagen'];

// Buscar la respuesta del usuario en el contenido del archivo SQL
if (preg_match("/INSERT INTO tablapersonajes \(imagen, nombre\) VALUES \('.*?', '$nombre_imagen'\);/", $sql_content)) {
    // Si la respuesta del usuario coincide con el nombre de alguna imagen en el archivo SQL
    echo "Respuesta correcta";
} else {
    // Si la respuesta del usuario no coincide con ninguna imagen en el archivo SQL
    echo "Respuesta incorrecta";
}

?>
