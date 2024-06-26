<?php require "layout.php"; ?>

<body class='container my-0 justify-content-start flex-column minigame1'>
    
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
    
        // Mostrar la imagen
        echo '<div class="image-container my-2">'; 
        echo '<img src="' . $imagen . '" alt="Imagen aleatoria" class="rounded-3" id="imagenPersonaje" style="filter: blur(25px);">';
        echo '</div>';
        // Establecer el valor del campo oculto con el nombre asociado a la imagen.
        echo '<input type="hidden" id="nombreImagen" value="' . $nombre . '">';
    } else {
        echo "No se encontraron imágenes en el archivo SQL.";
    }
    ?>
    
     <!-- Imagenes de las oportunidades -->
     
    <div id="oportunidades" class='d-flex gap-5 mb-2 flex-row-reverse'>
        <img src="https://i.imgur.com/69Gc5fJ.png" width="50" height="50">
        <img src="https://i.imgur.com/69Gc5fJ.png" width="50" height="50">
        <img src="https://i.imgur.com/69Gc5fJ.png" width="50" height="50">
        <img src="https://i.imgur.com/69Gc5fJ.png" width="50" height="50">
        <img src="https://i.imgur.com/vj7VGfj.png" width="50" height="50">
    </div>
    <div id="mensajeRespuesta"></div>
    <!-- Formulario para ingresar el nombre del personaje junto al botón pista y validar respuesta -->
    <form id="formulario01" action="validar_respuesta.php" method="POST">
        <div class="input-group align-items-center">
            <div class="input-group">
                <span class="input-group-text border-white bg-primary fw-bold text-success">
                    Racha: &nbsp;<span id="contadorRespuestasCorrectas">0</span>
                </span>   
                <input type="text" id="inputNombreBuscar" class="form-control border-white btn-primary" placeholder="Ingresa el nombre del personaje" autocomplete="off">
                <button type="button" id="botonPista" class="border-white text-warning btn btn-primary boton-pista d-none" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="<?php echo preg_replace('/\B[a-z]/', '-' , $nombreImagen); ?>">
                    <i class="fa-2x fa fa-star" aria-hidden="true"></i>
                </button>
                <button type="button" id="validarRespuesta" class="border-white text-success btn btn-primary">
                    <i class="fa-2x fa fa-check align-middle" aria-hidden="true"></i>
                </button>
            </div>
        </div>
    </form>
    
    <!-- Mostrar las coincidencias -->
    
    <div id="coincidencias" class="list-group"></div>
    <div class="lupa"></div> 
    <!-- Mensaje para mostrar el nombre del personaje -->
    <div id="mensajeNombrePersonaje" class="border fw-bold h3 alert d-none" style="font-weight: 300;"></div>
    <div class="row">
        <div class="col text-center">
            <!-- Botón Next -->
            <div class="d-none" id="botonNext">
                <button class="border border-white btn btn-primary">
                    <i class="fa-3x fa fa-arrow-right" aria-hidden="true"></i>
                </button>
            </div>
        </div>
        <div class="col text-center">
            <!-- Botón Reiniciar Página -->
            <div class="d-none" id="botonReiniciarPagina">
                <button class="border border-white btn btn-primary">
                    <i class="fa-3x fa fa-refresh" aria-hidden="true"></i>
                </button>
            </div>
        </div>
    </div>
    <!-- Mensaje de respuestas correctas -->
    <div id="mensajeRespuestasCorrectas" class="text-center form-control btn-primary border-success text-success fw-bold mt-3 mb-3" style="max-width: 370px; margin: 0 auto;"></div>
    
    <script src="minigame1.js"></script>
</body>
