<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "one piece";

// Crear conexión.

$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión.

if ($conn->connect_error) {
    die("La conexión falló: " . $conn->connect_error);
}

// Consulta para seleccionar una imagen aleatoria.

$sql = "SELECT cartel_pixelado, cartel, nombrepirata, wanted FROM tablarecompensas ORDER BY RAND() LIMIT 1";
$result = $conn->query($sql);

// Verificar si se encontraron resultados.

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $image = array("pixelado" => $row["cartel_pixelado"], "cartel" => $row["cartel"], "wanted" => $row["wanted"], "nombrepirata" => $row["nombrepirata"]);
    }
    
    // Devolver las imágenes en formato JSON.
    
    echo json_encode($image);
} else {
    echo "No se encontraron imágenes en la base de datos.";
}

// Cerrar conexión.

$conn->close();
?>
