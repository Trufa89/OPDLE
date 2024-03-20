<?php require "layouts/layout.php"; ?>

<body class="minigame3">
	<div class="mensajeContainer">
    	<div class="mensajeDificultad btn-primary px-4">Selecciona una dificultad</div>
		<div class="botonesContainer">
    		<div class="row mt-3 justify-content-center">
        		<div class="col-auto">
            		<button type="button" class="btn btn-primary btn-lg botonFacil boton-facil">Fácil</button>
        		</div>
        		<div class="col-auto">
            		<button type="button" class="btn btn-primary btn-lg botonDificil boton-dificil">Difícil</button>
        		</div>
    		</div>
		</div>
		<div id="contadorPreguntas"></div>
        <div id="preguntaContainer" class="pregunta-container">
        	<h2 id="pregunta" class="pregunta btn-primary px-4"></h2>
            <div id="opcionesContainer"></div>
        </div>
	</div>
	
	<div id="contenedorImagen">
		<img id="imagenPregunta" src="" alt="Imagen de la pregunta" style="display: none;">
	</div>
	
	<div class="tablaContainerFacil">
    <!-- Contenedor de la tabla de resultados -->
    <div id="tablaResultadoFacil" style="display: none;">
        <table>
            <tbody>
                <tr class="table-primera">
                    <td>Bandido de montaña</td>
                    <td>1</td>
                </tr>
                <tr class="table-segunda">
                    <td>Pirata del East Blue</td>
                    <td>2</td>
                </tr>
                <tr class="table-tercera">
                    <td>Vicecapitán del East Blue</td>
                    <td>3</td>
                </tr>
                <tr class="table-cuarta">
                    <td>Capitán del Eastblue</td>
                    <td>4</td>
                </tr>
                <tr class="table-quinta">
                    <td>Pirata del Grand Line</td>
                    <td>5</td>
                </tr>
                <tr class="table-sexta">
                    <td>Vicecapitán del Grand line</td>
                    <td>6</td>
                </tr>
                <tr class="table-septima">
                    <td>Capitán del Grand Line</td>
                    <td>7</td>
                </tr>
                <tr class="table-octava">
                    <td>Futura promesa del Nuevo Mundo</td>
                    <td>8</td>
                </tr>
                <tr class="table-novena">
                    <td>Capitán del Nuevo Mundo</td>
                    <td>9</td>
                </tr>
                <tr class="table-decima">
                    <td>Shichibukai</td>
                    <td>10</td>
                </tr>
            </tbody>
        </table>
    </div>
	</div>
        

<div class="tablaContainerDificil">
    <!-- Contenedor de la tabla de resultados -->
    <div id="tablaResultadoDificil" style="display: none;">
        <table>
            <tbody>
                <tr class="table-primera">
                    <td>Vicecapitán del East Blue</td>
                    <td>1</td>
                </tr>
                <tr class="table-segunda">
                    <td>Capitán del East Blue</td>
                    <td>2</td>
                </tr>
                <tr class="table-tercera">
                    <td>Vicecapitán del Grand Line</td>
                    <td>3</td>
                </tr>
                <tr class="table-cuarta">
                    <td>Capitán del Grand Line</td>
                    <td>4</td>
                </tr>
                <tr class="table-quinta">
                    <td>Futura promesa del Nuevo Mundo</td>
                    <td>5</td>
                </tr>
                <tr class="table-sexta">
                    <td>Capitán del Nuevo Mundo</td>
                    <td>6</td>
                </tr>
                <tr class="table-septima">
                    <td>Shichibukai</td>
                    <td>7</td>
                </tr>
                <tr class="table-octava">
                    <td>Comandante Yonkou</td>
                    <td>8</td>
                </tr>
                <tr class="table-novena">
                    <td>Yonkou</td>
                    <td>9</td>
                </tr>
                <tr class="table-decima">
                    <td>¡El Rey de los Piratas!</td>
                    <td>10</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="d-none" id="botonReiniciarPagina2">
    <button class="border border-white btn btn-primary">
        <i class="fa-3x fa fa-refresh" aria-hidden="true"></i>
    </button>
	</div>    
</div>
  
<script src="../controlador/minigame3.js"></script>
</body>
    
    
   
    
    
	


    
  
