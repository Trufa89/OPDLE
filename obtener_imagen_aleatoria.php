<?php

$servername = "localhost";
$username = "root"; 
$password = ""; 
$database = "one piece"; 

// Crear conexión.

$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión.

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta para obtener una imagen aleatoria.

$sql = "SELECT `imagen` FROM tablapersonajes ORDER BY RAND() LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $ruta_imagen = $row["imagen"];
        echo json_encode(array("imagen" => $ruta_imagen));
    }
} else {
    echo json_encode(array("error" => "No se encontraron imágenes en la base de datos."));
}



$conn->close();
?>
