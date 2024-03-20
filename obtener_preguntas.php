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

// Función para obtener una pregunta aleatoria.

function obtenerPregunta($conn, $dificultad) {
    $tabla = ($dificultad == 'facil') ? 'preguntasfaciles' : 'preguntasdificiles';
    $sql = "SELECT pregunta, respuesta_correcta, respuesta_incorrecta_1, respuesta_incorrecta_2, respuesta_incorrecta_3, imagenpregunta FROM $tabla ORDER BY RAND() LIMIT 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return false;
    }
}

// Obtener la dificultad seleccionada.

$dificultad = isset($_GET['dificultad']) ? $_GET['dificultad'] : null;

if ($dificultad !== null) {
    
    // Obtener pregunta aleatoria.
    
    $pregunta = obtenerPregunta($conn, $dificultad);
    
    // Verificar si se obtuvo una pregunta.
    
    if ($pregunta !== false) {
        // Renombrar el campo de la imagen
        $pregunta['imagen'] = $pregunta['imagenpregunta'];
        unset($pregunta['imagenpregunta']); // Eliminar el campo original de la imagen
        
        header('Content-Type: application/json');
        echo json_encode($pregunta);
    } else {
        echo json_encode(array("error" => "No se pudo obtener una pregunta para la dificultad especificada."));
    }
} else {
    echo json_encode(array("error" => "No se ha proporcionado una dificultad."));
}


?>
