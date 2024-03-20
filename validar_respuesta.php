<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "one piece";

$conexion = new mysqli($servername, $username, $password, $database);

// Verificar la conexión.

if ($conexion->connect_error) {
    die("La conexión falló: " . $conexion->connect_error);
}

header('Content-Type: application/json');


$respuesta_usuario = $_POST['respuesta']; 
$nombre_imagen = $_POST['nombreImagen'];

// Consulta SQL para verificar si la respuesta coincide con algún nombre de la tabla de personajes.

$query = "SELECT COUNT(*) AS count FROM tablapersonajes WHERE nombre = '$respuesta_usuario' AND nombre = '$nombre_imagen'";



$resultado = mysqli_query($conexion, $query);

// Verificar si se encontraron resultados.

if ($resultado) {
    $fila = mysqli_fetch_assoc($resultado);
    $count = $fila['count'];
    
    if ($count > 0) {
        echo "Respuesta correcta";
    } else {
        echo "Respuesta incorrecta";
    }
} else {
    echo "Error al verificar la respuesta";
}


$conexion->close();
?>
