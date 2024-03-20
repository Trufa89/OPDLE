<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Bienvenido - Seleccione un Minijuego</title>
<!-- Enlace al archivo CSS de Bootstrap desde un CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<!-- Enlace al archivo CSS personalizado -->
<link rel="stylesheet" href="vista/css/styles.css">
</head>
<body class="background">
    <div class="container mt-auto">
        <!-- Botones para seleccionar los minijuegos -->
        <div class="row">
            <div class="col-4">
                <a href="vista/minigame1.php" class="w-100 fs-2 fw-bold border-3 btn btn-inicio btn-lg btn-block adivina-btn">¡Adivina el personaje!</a>
            </div>
            <div class="col-4">
                <a href="vista/minigame2.php" class="w-100 fs-2 fw-bold border-3 btn btn-inicio btn-lg btn-block higher-btn">Higher or Lower</a>
            </div>
            <div class="col-4">
                <a href="vista/minigame3.php" class="w-100 fs-2 fw-bold border-3 btn btn-inicio btn-lg btn-block quiz-btn">QUIZ</a>
            </div>
        </div>
    </div>   
</body>
</html>
