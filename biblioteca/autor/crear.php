<?php include('../config.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Crear Autor</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <link rel="icon" href="../img/icono.png" type="image/x-icon"> 
</head>
<body>
<div class="container mt-4">
    <h2 class="text-center">Crear Autor</h2>
    <form action="crear.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="id_autor">ID Autor</label>
            <input type="text" class="form-control" id="id_autor" name="id_autor" required>
        </div>
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <div class="form-group">
            <label for="apellido">Apellido</label>
            <input type="text" class="form-control" id="apellido" name="apellido" required>
        </div>
        <div class="form-group">
            <label for="telefono">Teléfono</label>
            <input type="text" class="form-control" id="telefono" name="telefono" required>
        </div>
        <div class="form-group">
            <label for="direccion">Dirección</label>
            <input type="text" class="form-control" id="direccion" name="direccion" required>
        </div>
        <div class="form-group">
            <label for="ciudad">Ciudad</label>
            <input type="text" class="form-control" id="ciudad" name="ciudad" required>
        </div>
        <div class="form-group">
            <label for="estado">Estado</label>
            <input type="text" class="form-control" id="estado" name="estado" required>
        </div>
        <div class="form-group">
            <label for="pais">País</label>
            <input type="text" class="form-control" id="pais" name="pais" required>
        </div>
        <div class="form-group">
            <label for="cod_postal">Código Postal</label>
            <input type="number" class="form-control" id="cod_postal" name="cod_postal" required>
        </div>
        <div class="form-group">
            <label for="biografia">Biografía</label>
            <textarea class="form-control" id="biografia" name="biografia" rows="3" required></textarea>
        </div>
      
        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="listar.php" class="btn btn-secondary">Volver atrás</a>
        </div>
    </form>
</div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_autor = $conn->real_escape_string($_POST['id_autor']);
    $nombre = $conn->real_escape_string($_POST['nombre']);
    $apellido = $conn->real_escape_string($_POST['apellido']);
    $telefono = $conn->real_escape_string($_POST['telefono']);
    $direccion = $conn->real_escape_string($_POST['direccion']);
    $ciudad = $conn->real_escape_string($_POST['ciudad']);
    $estado = $conn->real_escape_string($_POST['estado']);
    $pais = $conn->real_escape_string($_POST['pais']);
    $cod_postal = intval($_POST['cod_postal']);
    $biografia = $conn->real_escape_string($_POST['biografia']);

    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $check = getimagesize($_FILES["imagen"]["tmp_name"]);
    if($check !== false) {
        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $target_file)) {

       $sql_autor = "INSERT INTO autores (id_autor, apellido, nombre, telefono, direccion, ciudad, estado, pais, cod_postal) 
                          VALUES ('$id_autor', '$apellido', '$nombre', '$telefono', '$direccion', '$ciudad', '$estado', '$pais', '$cod_postal')";
            $sql_biografia = "INSERT INTO biografias (id_autor, biografia) VALUES ('$id_autor', '$biografia')";
            $sql_imagen = "INSERT INTO fotografias (id_autor, fotografia) VALUES ('$id_autor', '$imagen')";
            
            if ($conn->query($sql_autor) === TRUE && $conn->query($sql_biografia) === TRUE && $conn->query($sql_imagen) === TRUE) {
                echo "<div class='alert alert-success text-center'>Nuevo autor creado correctamente</div>";
            } else {
                echo "<div class='alert alert-danger text-center'>Error: " . $conn->error . "</div>";
            }
        } else {
            echo "<div class='alert alert-danger text-center'>Error al subir la imagen.</div>";
        }
    } else {
        echo "<div class='alert alert-danger text-center'>El archivo no es una imagen válida.</div>";
    }
}
?>
</body>
</html>
