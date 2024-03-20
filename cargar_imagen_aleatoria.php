<?php

// Conexión a la base de datos.

$servername = "localhost";
$username = "root";
$password = "";
$database = "one piece";

// Crear conexión.

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("La conexión falló: " . $conn->connect_error);
}

// Consulta para seleccionar una imagen aleatoria.

$sql = "SELECT imagen, nombre FROM tablapersonajes ORDER BY RAND() LIMIT 1";
$result = $conn->query($sql);

if ($result === false) {
    
    // Si hay un error en la consulta, imprime el error y termina el script.
    
    die("Error en la consulta SQL: " . $conn->error);
}

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $imagen = $row["imagen"];
    $nombre = $row["nombre"];
    $respuesta = array("imagen" => $imagen, "nombre" => $nombre);
    
    // Convertir el array a formato JSON y enviarlo como respuesta.
    
    echo json_encode($respuesta);
} else {
    echo "No se encontraron imágenes en la base de datos.";
}

// Cerrar la conexión.

$conn->close();
?>
