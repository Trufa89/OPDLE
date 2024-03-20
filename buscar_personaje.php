<?php

// Conexión a la base de datos.

$servername = "localhost";
$username = "root";
$password = "";
$database = "one piece";

// Crear conexión.

$conexion = new mysqli($servername, $username, $password, $database);

// Verificar la conexión.

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

$nombre = $_GET['nombre'];

$query = "SELECT nombre FROM tablapersonajes WHERE nombre LIKE '%$nombre%'";
$resultado = mysqli_query($conexion, $query);

$nombres = array();
while ($fila = mysqli_fetch_assoc($resultado)) {
    $nombres[] = $fila['nombre'];
}

// Convertimos a formato JSON.

echo json_encode($nombres);
?>
