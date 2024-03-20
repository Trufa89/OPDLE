<?php 
    require "layouts/layout.php"; 
?>

<body class="minigame2">
    <div class="container2 mb-0">
        <div class="image-container2 flex-wrap mb-0">
            <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "one piece";
                $conn = new mysqli($servername, $username, $password, $database);

                if ($conn->connect_error) {
                    die("La conexión falló: " . $conn->connect_error);
                }

                // Consulta para obtener los dos carteles de recompensa de la base de datos.
                
                $sql = "SELECT cartel_pixelado, cartel, nombrepirata, wanted FROM tablarecompensas ORDER BY RAND() LIMIT 2";
                $result = $conn->query($sql);

                if ($result->num_rows == 2) {
                    $images = array();
                    while($row = $result->fetch_assoc()) {
                        $images[] = $row;
                    }

                    echo '<div class="image-wrapper order-0 image-wanted mb-0">';
                    echo '<p class="nombre-pirata text-center">' . $images[0]["nombrepirata"] . '</p>';
                    echo '<img id="image-0" src="' . $images[0]["cartel_pixelado"] . '" data-cartel="' . $images[0]["cartel"] . '" data-wanted="' . $images[0]["wanted"] . '" alt="Imagen" class="old-image game-image">';
                    echo '</div>';

                    echo '<div class="image-wrapper order-2 image-wanted mb-1">';
                    echo '<p class="nombre-pirata text-center">' . $images[1]["nombrepirata"] . '</p>';
                    echo '<img id="image-1" src="' . $images[1]["cartel_pixelado"] . '" data-cartel="' . $images[1]["cartel"] . '" data-wanted="' . $images[1]["wanted"] . '" alt="Imagen" class="old-image game-image">';
                    echo '</div>';
                }

                $conn->close();
            ?>  
            <div class="order-1 mx-4"><img src="https://i.imgur.com/RpWHaZC.png" alt="Nueva Imagen"></div>            
        </div>
    </div> 
    <div class="button-container">
        <!-- Botón Next -->
        <div class="d-none" id="botonNext">
            <button class="border border-white btn btn-primary">
                <i class="fa-3x fa fa-arrow-right" aria-hidden="true"></i>
            </button>
        </div>
    
        <!-- Botón Reiniciar Página -->
        <div class="d-none" id="botonReiniciarPagina">
            <button class="border border-white btn btn-primary">
                <i class="fa-3x fa fa-refresh" aria-hidden="true"></i>
            </button>
        </div>  
    </div>
    <span id="contadorRachas" class="text-center form-control btn-primary fw-bold">Racha = <span id="rachas">0</span></span>
    <!-- Mensaje de respuestas correctas -->
    <div id="mensajeRespuesta3" class="text-center "></div>
    <div id="mensajeRespuesta2" class="text-center "></div>
    <img id="gifReiniciar" src="https://i.imgur.com/UShg299.gif" class="d-none" alt="GIF Reiniciar">
    <div id="overlay"></div>

    <script src="../controlador/minigame2.js"></script>
</body>
