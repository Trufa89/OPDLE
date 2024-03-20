$(document).ready(function() {
    // Define la variable intentosIncorrectos e inicialízala en 0.
    var intentosIncorrectos = 0;
    
    // Guardamos un array de imagenes mostradas para impedir la repetición de imagenes.
    var imagenesMostradas = [];
    
    // Obtenemos el contador de respuestas correctas.
    var contadorRespuestasCorrectas = $('#contadorRespuestasCorrectas');

    // Actualimos el mensaje.
    var mensajeRespuestasCorrectas = $('#mensajeRespuestasCorrectas');
    mensajeRespuestasCorrectas.text('Tu racha de respuestas correctas ha sido de: ' + contadorRespuestasCorrectas.text());

    // Definimos la función mostrarCoincidencias.
    function mostrarCoincidencias(nombres) {
        var coincidencias = $('#coincidencias');
        coincidencias.empty();
        
        nombres.forEach(function(nombre) {
            var option = $('<div></div>').addClass('list-group-item list-group-item-action').text(nombre);
            coincidencias.append(option);
        });
    }
	
	// Popover para el botón pista.
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
    var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl);
    });

    // Establecer el filtro de desenfoque inicial.
    $('#imagenPersonaje').css({'filter': 'blur(25px)'});
      
    $('#inputNombreBuscar').on('input', function() {
        var inputText = $(this).val().trim();
        var xhr = new XMLHttpRequest();
        if (inputText !== '') {
            xhr.open('GET', 'buscar_personaje.php' + inputText, true);
            xhr.onload = function() {
                if (xhr.status >= 200 && xhr.status < 300) {
                    var nombres = JSON.parse(xhr.responseText);
                    mostrarCoincidencias(nombres);
                }
            };
            xhr.send();
        } else {
            mostrarCoincidencias([]);
        }
    });

    // Event listener para el contenedor de coincidencias
    $('#coincidencias').on('click', '.list-group-item', function() {
        var selectedText = $(this).text();
        $('#inputNombreBuscar').val(selectedText);
        $('#coincidencias').empty();
    });

    // Función para ocultar el botón de pista cuando solo queda un intento.
    function actualizarVisibilidadBotonPista() {
        if (intentosIncorrectos === $('#oportunidades img').length - 1) {
            $('#botonPista').removeClass('d-none');
        } else {
            $('#botonPista').addClass('d-none');
        }
    }

    function ocultarImagenOportunidad() {
        // Seleccionamos todas las imágenes dentro del div de oportunidades.
        var imagenesOportunidad = $('#oportunidades img');
        // Verificamos que todavía haya imágenes visibles y que haya intentos fallidos restantes.
        if (intentosIncorrectos < imagenesOportunidad.length) {
            // Ocultamos la imagen correspondiente al intento fallido actual.
            imagenesOportunidad.eq(intentosIncorrectos).hide();
            // Incrementamos el contador de intentos fallidos.
            intentosIncorrectos++;
            // Calculamos el nuevo valor de desenfoque.
            var blurValue = Math.max(0, 25 - (5 * intentosIncorrectos));
            $('#imagenPersonaje').css({'filter': 'blur(' + blurValue + 'px)'});
            actualizarVisibilidadBotonPista();   
        } else {
            // Si ya no quedan imágenes visibles, no hace nada más.
            return;
        }
    }

    var respuestasCorrectas = 0;
  
    // Función para incrementar el contador de respuestas correctas.
    function incrementarRespuestasCorrectas() {
        respuestasCorrectas++;
        actualizarRespuestasCorrectas(); // Actualizamos la interfaz con el nuevo valor del contador.
    }

    // Función para actualizar la interfaz con el nuevo valor del contador de respuestas correctas.
    function actualizarRespuestasCorrectas() {
        $('#contadorRespuestasCorrectas').text(respuestasCorrectas);
        $('#mensajeRespuestasCorrectas').text('Tu racha de respuestas correctas ha sido de: ' + respuestasCorrectas);
    }

    // Función para validar la respuesta del usuario.
    function validarRespuesta() {
        // Obtenemos el nombre asociado a la imagen.
        var nombreImagen = $('#nombreImagen').val();
        // Obtenemos la respuesta del usuario.
        var respuesta = $('#inputNombreBuscar').val().trim();
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'validar_respuesta.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status >= 200 && xhr.status < 300) {
                // Verificamos si la respuesta coincide con el nombre de la base de datos.
                if (xhr.responseText === 'Respuesta correcta') {
                    $('#formulario01').addClass('d-none');
                    $('#mensajeNombrePersonaje').removeClass('d-none border-danger text-danger').addClass("border-success text-success").text('Correcto! : El personaje es: ' + nombreImagen);
                    $('#oportunidadesRestantes').html(5);
                    $('#imagenPersonaje').css({'filter': 'none'});
                    $('#botonNext').removeClass('d-none');
                    $('#oportunidades').addClass('d-none');
                    $('#mensajeRespuesta').text('');
                    $('#botonIndex').removeClass('d-none');
                    $('#botonReiniciarPagina').addClass('d-none'); // Oculta el botón de reiniciar página.
                    $('#botonPista').addClass('d-none'); // Oculta el boton pista al acertar el personaje.
                    incrementarRespuestasCorrectas(); // Aquí se incrementa el contador de respuestas correctas.
                    actualizarRespuestasCorrectas(); // Actualiza el número de respuestas correctas en la interfaz.
                    
                } else {
                    mostrarMensaje('Respuesta incorrecta');
                    $('#oportunidadesRestantes').html(4 - intentosIncorrectos);
                    if (intentosIncorrectos >= 4) {
                        $('#formulario01').addClass('d-none');
                        $('#mensajeNombrePersonaje').removeClass('d-none border-sucess text-success').addClass("border-danger text-danger").text('Lo siento T.T : El personaje era: ' + nombreImagen);
                        $('#imagenPersonaje').css({'filter': 'none'});
                        $('#botonNext').removeClass('d-none');
                        intentosIncorrectos = 0;
                        $('#oportunidadesRestantes').html(4);
                        $('#oportunidades').addClass('d-none');
                        $('#botonNext').addClass('d-none'); // Oculta el botón siguiente.
                        $('#botonIndex').removeClass('d-none'); // Muestra el botón Index.
                        $('#botonReiniciarPagina').removeClass('d-none'); // Muestra el botón de reiniciar página.
                        // Muestra el mensaje de respuestas correctas.
                        var mensajeRespuestasCorrectas = document.getElementById('mensajeRespuestasCorrectas');
                        mensajeRespuestasCorrectas.style.display = 'block'; // Muesstra el mensaje.
                        mostrarMensaje('');
                    } else {
                        $('#inputNombreBuscar').val('');
                        // Llama a la función para ocultar una imagen de oportunidad.
                        ocultarImagenOportunidad();
                        
                    }
                }
            }
        };
                 
        xhr.send('respuesta=' + encodeURIComponent(respuesta) + '&nombreImagen=' + encodeURIComponent(nombreImagen));
        $('#coincidencias').empty();
    }

    $('#botonReiniciarPagina').on('click', function() {
        location.reload(); // Recarga la página.
    });

    // Event listener para el botón 'Validar Respuesta'
    $('#validarRespuesta').on('click', function(event) {
        event.preventDefault(); // Prevenir el comportamiento predeterminado del formulario.
        $("[data-bs-toggle='popover']").popover("hide");
        validarRespuesta();
    });

    // Event listener para el campo de texto inputNombreBuscar.
    $('#inputNombreBuscar').on('keypress', function(event) {
        // Verificar si la tecla presionada es Enter (código de tecla 13).
        if (event.which === 13) {
            event.preventDefault(); // Prevenimos el comportamiento predeterminado del formulario.
            validarRespuesta();
        }
    });
    
    // Función para mostrar mensajes de respuesta.
    function mostrarMensaje(resultado) {
        $('#mensajeRespuesta').text(resultado);
    }

    // Función para cargar una nueva imagen aleatoria.
    function cargarNuevaImagen() {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'cargar_imagen_aleatoria.php', true);
        xhr.onload = function() {
            if (xhr.status >= 200 && xhr.status < 300) {
                var respuesta = JSON.parse(xhr.responseText);
                var nuevaImagen = respuesta.imagen;
                var nombreAsociado = respuesta.nombre;
                // Verificar si la imagen ya ha sido mostrada previamente
            	if (imagenesMostradas.includes(nuevaImagen)) {
	                console.log("Imagen repetida. Cargando otra...");
	                cargarNuevaImagen(); // Cargar otra imagen recursivamente
	                return;
           		 }
           		// Agregar la nueva imagen al array de imágenes mostradas
            	imagenesMostradas.push(nuevaImagen);
                $('#imagenPersonaje').attr('src', nuevaImagen);
                $('#nombreImagen').val(nombreAsociado);
                $('#inputNombreBuscar').val('');
                $('#formulario01').removeClass('d-none');
                $('#mensajeNombrePersonaje').addClass('d-none');
                $('#imagenPersonaje').css({'filter': 'blur(25px)'});
                $('#oportunidades').removeClass('d-none');
                $('#botonNext').addClass('d-none');
                $('#botonIndex').addClass('d-none');
                $('[data-bs-toggle="popover"]').attr('data-bs-content', nombreAsociado.replace(/\B[a-z]/g, "-")); // añade el texto del mensaje de la pista
                new bootstrap.Popover($('[data-bs-toggle="popover"]')[0]).update();
                // Reiniciar los intentos incorrectos.
                intentosIncorrectos = 0;
                $('#oportunidadesRestantes').html(5);
                // Restablecemos todas las imágenes de oportunidades.
                $('#oportunidades img').show();
               
            }
        };
        xhr.send();
    }

    // Controlador de eventos para el botón siguiente.
    $('#botonNext').on('click', function() {
        cargarNuevaImagen();
    });
});
