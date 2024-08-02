<?php include('config.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contacto</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="/biblioteca/css/style.css" rel="stylesheet">
    <link rel="icon" href="./img/icono.png" type="image/x-icon"> 
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/biblioteca/index.php">Biblioteca</a>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="/biblioteca/autor/listar.php">Autores</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/biblioteca/libro/listar.php">Libros</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/biblioteca/contacto.php">Contacto</a>
            </li>
        </ul>
    </div>
</nav>
<div class="container mt-4">
    <h2 class="text-center">Formulario de Contacto</h2>
    <form action="contacto.php" method="post">
        <div class="form-group">
            <label for="correo">Correo</label>
            <input type="email" class="form-control" id="correo" name="correo" required>
        </div>
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <div class="form-group">
            <label for="asunto">Asunto</label>
            <input type="text" class="form-control" id="asunto" name="asunto" required>
        </div>
        <div class="form-group">
            <label for="comentario">Comentario</label>
            <textarea class="form-control" id="comentario" name="comentario" rows="5" required></textarea>
        </div>
        <div class="d-flex justify-content-between">
                <button type="submit" name="update" class="btn btn-primary">Actualizar</button>
                <a href="./index.php" class="btn btn-secondary">Volver atrás</a>
            </div>
            </form>
</div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $conn->real_escape_string($_POST['correo']);
    $nombre = $conn->real_escape_string($_POST['nombre']);
    $asunto = $conn->real_escape_string($_POST['asunto']);
    $comentario = $conn->real_escape_string($_POST['comentario']);
    $fecha = date('Y-m-d H:i:s');

    $sql = "INSERT INTO contacto (fecha, correo, nombre, asunto, comentario) 
            VALUES ('$fecha', '$correo', '$nombre', '$asunto', '$comentario')";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success text-center'>Mensaje enviado correctamente</div>";
    } else {
        echo "<div class='alert alert-danger text-center'>Error: " . $conn->error . "</div>";
    }
}
?>
</body>
</html>
