$(document).ready(function() {
    var correctImageId = null;
    var rachas = 0;
    var gifs = [
		"https://i.imgur.com/F3PIS2K.gif",
		"https://i.imgur.com/80IAU63.gif",
		"https://i.imgur.com/IVOE9b5.gif",
		"https://i.imgur.com/6INBDYy.gif",
		"https://i.imgur.com/IRdqWkL.gif",
		"https://i.imgur.com/UShg299.gif",
	];

	// Función para obtener un número aleatorio entre 0 y el tamaño de la lista de GIFs.
	function getRandomIndex() {
    	return Math.floor(Math.random() * gifs.length);
	}

	// Función para mostrar un GIF aleatorio.
	function showRandomGIF() {
    	var randomIndex = getRandomIndex();
    	// Obtener el GIF correspondiente al índice aleatorio.
    	var randomGIF = gifs[randomIndex];
   		 // Mostrar el GIF en la página.
    	$('#gifReiniciar').attr('src', randomGIF);
    	$('#gifReiniciar').removeClass('d-none');
    	$('#overlay').fadeIn();
	}
	
	// Función para ocultar el GIF y el overlay.
	function hideGIF() {
    	$('#gifReiniciar').addClass('d-none');
    	$('#overlay').fadeOut();
}

    // Esta función agrega el controlador de eventos para el clic en las imágenes.
    function addClickHandler() {
        $('.game-image').on("click", function() {
            createImageReplacementHandler($(this));
        });
    }

    // Esta función elimina el controlador de eventos para el clic en las imágenes.
    function removeClickHandler() {
        $('.game-image').off("click");
    }

    // Llama a esta función para agregar el controlador de eventos al inicio.
    addClickHandler();
    // Controlador de evento para el botón siguiente.
    $('#botonNext').on("click", function() {
		var incorrectImage
		if (document.getElementsByClassName('old-image').length > 1){
			document.getElementById(correctImageId).classList.add("old-image")
            incorrectImage = $('#image-' + (correctImageId === 'image-0' ? '1' : '0'));
				
		} else {
			incorrectImage = $(".old-image")
        }
        document.querySelectorAll('.game-image').forEach(el=>el.classList.add('old-image'));
        getRandomCartel(incorrectImage);
        $('#mensajeRespuesta2').addClass('d-none').text(''); // Oculta y vacía el mensaje.
        $('#mensajeRespuesta3').addClass('d-none').text(''); 
        $(this).addClass('d-none');
        addClickHandler(); // Vuelve a agregar el controlador de eventos para clic en las imágenes.
    
    });
    
    // Controlador de evento para el botón reiniciar página.
    $('#botonReiniciarPagina').on("click", function() {
        location.reload(); // Recarga la página.
        hideGIF();
        
    });

    function createImageReplacementHandler(clickedImage) {
        var image1 = document.querySelector('#image-0');
        var image2 = document.querySelector('#image-1');
        var wantedValue1 = parseInt(image1.dataset.wanted);
        var wantedValue2 = parseInt(image2.dataset.wanted); 
        if (wantedValue1 === wantedValue2) {
	        $('#mensajeRespuesta2').text('Correcto').removeClass('d-none');
	        $('#botonNext').removeClass('d-none');
	        removeClickHandler(); // Quita el controlador de eventos de clic en las imágenes.
	        rachas++;
			$('#contadorRachas').text(rachas);
			$('#contadorRachas').text('Racha de aciertos = ' + rachas).removeClass('d-none');
	        // Cambiar la imagen no actualizada por su versión asociada.
	        if (clickedImage.attr('id') === 'image-0') {
	            $('#image-1').attr('src', image2.dataset.cartel);
	        } else {
	            $('#image-0').attr('src', image1.dataset.cartel);
	        }

	        return;
	    }

        if (clickedImage.attr('id') === 'image-0') {
            if (wantedValue1 > wantedValue2) {
                $('#mensajeRespuesta2').text('Correcto').removeClass('d-none');
                $('#botonNext').removeClass('d-none');
                removeClickHandler(); 
                correctImageId = 'image-0';
                rachas++;
				$('#contadorRachas').text(rachas);
				$('#contadorRachas').text('Racha de aciertos = ' + rachas).removeClass('d-none');
            } else {
				$('#mensajeRespuesta3').text('No es correcto...').removeClass('d-none');
                $('#contadorRachas').text('Racha de aciertos = ' + rachas).removeClass('d-none');
                removeClickHandler();
                $('#botonReiniciarPagina').removeClass('d-none');
                showRandomGIF();
                correctImageId = 'image-1';
            }
        } else {
            if (wantedValue2 > wantedValue1) {
                $('#mensajeRespuesta2').text('Correcto').removeClass('d-none');
                $('#botonNext').removeClass('d-none');
                removeClickHandler(); 
                correctImageId = 'image-1';
                rachas++;
				$('#contadorRachas').text(rachas);
				$('#contadorRachas').text('Racha de aciertos = ' + rachas).removeClass('d-none');
            } else {
				$('#mensajeRespuesta3').text('No es correcto...').removeClass('d-none');
                $('#contadorRachas').text('Racha de aciertos = ' + rachas).removeClass('d-none');
                $('#botonReiniciarPagina').removeClass('d-none');
                showRandomGIF();
                removeClickHandler();
                correctImageId = 'image-0';
            }
        }

        image1.src = image1.dataset.cartel;
        image2.src = image2.dataset.cartel;
    };

    function getRandomCartel(incorrectImage) {
        $.ajax({
            url: '../controlador/obtener_imagenes.php',
            type: 'GET',
            success: function(response) {
                var respuesta = JSON.parse(response);
                incorrectImage.attr('src', respuesta.pixelado);
                incorrectImage.attr('data-cartel', respuesta.cartel);
                incorrectImage.attr('data-wanted', respuesta.wanted);
                incorrectImage.siblings('.nombre-pirata').text(respuesta.nombrepirata);
                incorrectImage.siblings('.nombre-pirata').removeClass("d-none");
                try{
					incorrectImage[0].classList.remove("old-image")
				}catch(error){
					console.log(incorrectImage[0].classList)
				};
            },
        });
    }
});
