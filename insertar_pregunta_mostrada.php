<?php

// Conexión a la base de datos.

$servername = "localhost";
$username = "root";
$password = "";
$database = "one piece";

// Creamos conexión.

$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("La conexión falló: " . $conn->connect_error);
}

// Obtenemos la pregunta mostrada.

$pregunta_mostrada_json = isset($_POST['pregunta']) ? $_POST['pregunta'] : null;

if ($pregunta_mostrada_json !== null) {
    
    // Decodificar la pregunta mostrada desde JSON.
    
    $pregunta_mostrada = json_decode($pregunta_mostrada_json);
    
    // Insertar la pregunta mostrada en la tabla preguntasmostradas.
    
    $sql_insert = "INSERT INTO preguntasmostradas (pregunta, respondida) VALUES ('$pregunta_mostrada', 0)";
    if ($conn->query($sql_insert) === TRUE) {
        echo json_encode(array("success" => "Pregunta mostrada insertada en la base de datos correctamente."));
    } else {
        echo json_encode(array("error" => "Error al insertar la pregunta mostrada en la base de datos: " . $conn->error));
    }
} else {
    echo json_encode(array("error" => "No se ha proporcionado una pregunta mostrada."));
}

// Cerrar conexión.

$conn->close();
?>
