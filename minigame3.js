$(document).ready(function() {
    $('#opcionesContainer').hide();
    $('#pregunta').hide();

    // Array para almacenar las preguntas mostradas
    var preguntasMostradas = [];

    // Variable global para contar las preguntas respondidas en la dificultad fácil
    var preguntasRespondidasFacil = 0;
    // Variable global para contar las preguntas respondidas en la dificultad difícil
    var preguntasRespondidasDificil = 0;
    
    function ocultarElementos() {
        $('.botonFacil, .botonDificil, .mensajeDificultad').hide();
    }

    function mostrarOpciones() {
        $('#opcionesContainer').show();
    }

    $('.botonFacil').click(function() {
        ocultarElementos();
        mostrarOpciones();
        cargarPregunta('facil');
    });

    $('.botonDificil').click(function() {
        ocultarElementos();
        mostrarOpciones();
        cargarPregunta('dificil');
    });
    
    // Evento click para el botón reiniciar página
	$('#botonReiniciarPagina2 button').click(function() {
    location.reload(); // Recargar la página
	});

    // Función para cargar una pregunta de la dificultad especificada
    function cargarPregunta(dificultad) {
         // Verificar si ya se han respondido 20 preguntas en la dificultad específica
    	var preguntasRespondidas = dificultad === 'facil' ? preguntasRespondidasFacil : preguntasRespondidasDificil;
   		if (preguntasRespondidas >= 20) {
	        // Ocultar el contenedor de la última pregunta
	        $('#preguntaContainer').hide();
	        console.log('Has respondido las 20 preguntas justas. ¡Felicidades!');
	        return;
        }

        $('#pregunta').show();
        // Hacer la solicitud AJAX para obtener preguntas
        $.ajax({
            url: '../controlador/obtener_preguntas.php',
            type: 'GET',
            data: { dificultad: dificultad },
            success: function (data) {
                if (typeof data === 'object') {
                    // Verificar si la pregunta ya ha sido mostrada
                    if (!preguntasMostradas.includes(data.pregunta)) {
                        // Mostrar la pregunta
                        mostrarPregunta(data, dificultad);
                        // Agregar la pregunta mostrada al array
                        preguntasMostradas.push(data.pregunta);
	                    // Mostrar el contador de preguntas
	                    mostrarContadorPreguntas();
                    } else {
                        // Si la pregunta ya ha sido mostrada, cargar otra
                        cargarPregunta(dificultad);
                        console.log('Pregunta repetida. Cargando otra pregunta.');
                    }
                } else {
                    console.error('Error al obtener pregunta: No se recibió un objeto JSON.');
                }
            },
            error: function (xhr, status, error) {
                console.error('Error al obtener pregunta: ' + error);
            }
        });
    }
	
	// Función para mostrar el contador de preguntas
	function mostrarContadorPreguntas() {
    var totalPreguntas = preguntasRespondidasFacil + preguntasRespondidasDificil;
    $('#contadorPreguntas').text(totalPreguntas + '/20');
	}
	
    // Función para mostrar una pregunta y configurar las respuestas
    function mostrarPregunta(pregunta, dificultad) {
        var preguntaElement = $('#pregunta');
        var opcionesElement = $('#opcionesContainer');
        var imagenElement = $('#imagenPregunta');

    	// Ocultar la imagen al cargar una nueva pregunta
    	imagenElement.hide();

        preguntaElement.text(pregunta.pregunta);
        opcionesElement.empty();

        // Agregar opciones como botones
        var opciones = [
            pregunta.respuesta_correcta,
            pregunta.respuesta_incorrecta_1,
            pregunta.respuesta_incorrecta_2,
            pregunta.respuesta_incorrecta_3
        ];
        opciones = shuffle(opciones); // Barajar opciones

        opciones.forEach(function (opcion, index) {
            var button = $('<button></button>').text(opcion).addClass('opcion btn btn-primary-spacing col-6 opcion-' + (index + 1)); // Asignando clases opcion-1, opcion-2, etc
            button.click(function() {
                validarRespuesta(opcion, pregunta.respuesta_correcta, dificultad, pregunta);
                
                ActivarEventosClickOpciones();
            });
            opcionesElement.append(button);
        });

        $('#preguntaContainer').css('display', 'block');
        
    }

    // Variable global para almacenar el puntaje total
    var puntajeTotal = 0;

    // Función para validar la respuesta seleccionada
    function validarRespuesta(respuestaSeleccionada, respuestaCorrecta, dificultad, pregunta) {
        // Buscar el botón de la respuesta correcta y el botón seleccionado
        var botonRespuestaCorrecta = $("button:contains('" + respuestaCorrecta + "')");
        var botonSeleccionado = $("button:contains('" + respuestaSeleccionada + "')");
        desactivarEventosClickOpciones();

        // Verificar si la respuesta es correcta
        var respuestaCorrecta = respuestaSeleccionada === respuestaCorrecta;

        // Incrementar el contador de preguntas respondidas
        if (dificultad === 'facil') {
            preguntasRespondidasFacil++;
        } else {
            preguntasRespondidasDificil++;
        }

        if (respuestaCorrecta) {
            // Sumar puntaje por respuesta correcta
            puntajeTotal += 0.5;

            // Cambiar el estilo del botón de respuesta correcta a verde
            botonRespuestaCorrecta.removeClass('btn-primary').addClass('btn-success').css('background-color', 'green');

            // Mostrar mensaje de respuesta correcta
            console.log('Respuesta correcta.');
        } else {
            // Cambiar el estilo del botón seleccionado a rojo
            botonSeleccionado.removeClass('btn-primary').addClass('btn-danger').css('background-color', '#DA3C35');

            // Cambiar el estilo del botón de respuesta correcta a verde
            botonRespuestaCorrecta.removeClass('btn-primary').addClass('btn-success').css('background-color', 'green');

            // Mostrar mensaje de respuesta incorrecta
            console.log('Respuesta incorrecta. La respuesta correcta era: ' + pregunta.respuesta_correcta);
        }

        // Verificar si se han respondido las 20 preguntas
        if (preguntasRespondidasFacil + preguntasRespondidasDificil >= 20) {
			// Mostrar la imagen después de responder la última pregunta
            var imagenElement = $('#imagenPregunta');
	        imagenElement.attr('src', pregunta.imagen);
	        imagenElement.show();
	        
            // Ocultar el contenedor de la última pregunta después de 3 segundos
            setTimeout(function() {
                $('#preguntaContainer').hide();
                mostrarTablaResultados();
            }, 3000);
            
            console.log('Has respondido las 20 preguntas justas. ¡Felicidades!');
            console.log('Puntaje total: ' + puntajeTotal);

            puntajeTotal = Math.floor(puntajeTotal);

            return;
        }

        // Si aún no se han respondido 20 preguntas, cargar la siguiente
        setTimeout(function() {
            cargarPregunta(dificultad);
        }, 3000); // Retraso de 1 segundo en milisegundos 
        
        // Mostrar la imagen después de responder la pregunta
	    var imagenElement = $('#imagenPregunta');
	    imagenElement.attr('src', pregunta.imagen);
	    setTimeout(function() {
	    	imagenElement.show();
		}, 200);
	   
    }

    // Función para barajar un array
    function shuffle(array) {
        var currentIndex = array.length,
            temporaryValue, randomIndex;
        while (0 !== currentIndex) {
            randomIndex = Math.floor(Math.random() * currentIndex);
            currentIndex -= 1;
            temporaryValue = array[currentIndex];
            array[currentIndex] = array[randomIndex];
            array[randomIndex] = temporaryValue;
        }
        return array;
    }

    // Función para resaltar la fila que coincide con el puntaje total obtenido
    function resaltarFilaPorPuntaje(puntaje, tablaId) {
        // Obtener todas las filas de la tabla
        var filas = $(tablaId + ' tbody tr');

        // Iterar sobre las filas para encontrar la que coincide con el puntaje
        filas.each(function() {
            var fila = $(this);
            var valor = parseFloat(fila.find('td:eq(1)').text()); // Obtener el valor de la columna de puntaje

            // Verificar si el valor de la fila coincide con el puntaje total
            if (valor === puntaje) {
                fila.addClass('resaltado'); // Aplicar clase CSS para resaltar la fila
            } else {
                fila.removeClass('resaltado'); // Remover clase CSS de otras filas
            }
        });
    }
    
    function desactivarEventosClickOpciones() {
        $('.opcion').off('click');
        }
        
    function ActivarEventosClickOpciones() {
		$('.opcion').on('click');
	}    
        
    function mostrarTablaResultados() {
		$('#contadorPreguntas').hide();
		// Ocultar la imagen de la pregunta 20
        $('#imagenPregunta').hide();
        // Mostrar siempre el botón de reiniciar página
        $('#botonReiniciarPagina2').removeClass('d-none');
        if (preguntasRespondidasFacil >= 20) {
            $('#tablaResultadoFacil').show();
            resaltarFilaPorPuntaje(puntajeTotal, '#tablaResultadoFacil');
        } else if (preguntasRespondidasDificil >= 20) {
			
            $('#tablaResultadoDificil').show();
            resaltarFilaPorPuntaje(puntajeTotal, '#tablaResultadoDificil');
        }    
    }
        
});
