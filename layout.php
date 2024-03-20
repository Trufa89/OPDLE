<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido - Seleccione un Minijuego</title>
    <!-- Enlace al archivo CSS de Bootstrap desde un CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Enlace al archivo CSS personalizado -->
    <link rel="stylesheet" href="../vista/css/styles.css">
    <!-- Enlace al archivo JS de Bootstrap desde un CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- Enlace a jQuery desde un CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- Enlace al archivo CSS de Font Awesome desde un CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
</head>
<body>

<div class="dropdown position-absolute top-0 start-0">
    <button class="border border-white btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fa fa-2x fa-bars" aria-hidden="true"></i>
    </button>
    <ul class="border border-white dropdown-menu dropdown-menu-dark" style="min-width: 20px;" aria-labelledby="dropdownMenuButton1">
        <li><a class="dropdown-item" href="http://localhost/ONEPIECE/"><i class="fa-2x fa fa-home" aria-hidden="true"></i></a></li>
        <li><a class="dropdown-item" href="../vista/minigame1.php"><i class="fa-2x fa fa-search" aria-hidden="true"></i></a></li>
        <li><a class="dropdown-item" href="../vista/minigame2.php"><i class="fa-2x fa fa-exchange" aria-hidden="true"></i></a></li>
        <li><a class="dropdown-item" href="../vista/minigame3.php"><i class="fa-2x fa fa-question-circle" aria-hidden="true"></i></a></li>
    </ul>
</div>

</body>
</html>
